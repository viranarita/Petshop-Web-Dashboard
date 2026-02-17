<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Transaction;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'todayBookings' => Booking::whereDate('scheduled_at', today())->count(),
            'todaySales' => Transaction::whereDate('created_at', today())->sum('total_amount'),
            'totalCustomers' => Customer::count(),
        ])->layout('components.layouts.app');
    }
}
