<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $customers = Customer::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('phone', 'like', '%' . $this->search . '%')
            ->withCount('pets')
            ->latest()
            ->paginate(10);

        return view('livewire.customer.index', [
            'customers' => $customers,
        ])->layout('components.layouts.app');
    }
}
