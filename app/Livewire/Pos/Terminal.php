<?php

namespace App\Livewire\Pos;

use App\Models\Product;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Terminal extends Component
{
    public $search = '';
    public $cart = [];
    public $paymentMethod = 'cash';
    public $amountPaid = 0;

    public function addToCart($type, $id)
    {
        $item = $type === 'service' ? Service::find($id) : Product::find($id);
        
        if (!$item) return;

        $cartKey = $type . '_' . $id;

        if (isset($this->cart[$cartKey])) {
            $this->cart[$cartKey]['quantity']++;
        } else {
            $this->cart[$cartKey] = [
                'type' => $type, // 'service' or 'product' (for logic, but morph map uses model class)
                'model_type' => $type === 'service' ? Service::class : Product::class,
                'id' => $id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1,
            ];
        }
    }

    public function removeFromCart($key)
    {
        unset($this->cart[$key]);
    }

    public function updateQuantity($key, $qty)
    {
        if ($qty > 0) {
            $this->cart[$key]['quantity'] = $qty;
        } else {
            $this->removeFromCart($key);
        }
    }

    public function getTotalProperty()
    {
        return array_reduce($this->cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function checkout()
    {
        if (empty($this->cart)) {
            Toaster::error('Cart is empty!');
            return;
        }

        $total = $this->getTotalProperty();

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'payment_method' => $this->paymentMethod,
            'status' => 'paid',
        ]);

        foreach ($this->cart as $item) {
            $transaction->items()->create([
                'payable_type' => $item['model_type'], // polymorphic type
                'payable_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['price'] * $item['quantity'],
            ]);
            
            // Decrease stock if product
            if ($item['type'] === 'product') {
                $product = Product::find($item['id']);
                if ($product) {
                    $product->decrement('stock', $item['quantity']);
                }
            }
        }

        $this->cart = [];
        $this->amountPaid = 0;
        Toaster::success('Transaction completed successfully!');
    }

    public function render()
    {
        $services = Service::where('name', 'like', '%' . $this->search . '%')->get();
        $products = Product::where('name', 'like', '%' . $this->search . '%')->get();

        return view('livewire.pos.terminal', [
            'services' => $services,
            'products' => $products,
        ])->layout('components.layouts.app');
    }
}
