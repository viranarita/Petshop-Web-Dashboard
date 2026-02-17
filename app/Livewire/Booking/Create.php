<?php

namespace App\Livewire\Booking;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Service;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public $step = 1;
    
    // Step 1: Service
    public $selectedService = null;

    // Step 2: Date
    public $date;
    public $time;

    // Step 3: Details
    public $customerName;
    public $customerEmail;
    public $customerPhone;
    public $petName;
    public $petType = 'dog';
    public $petBreed;
    public $notes;

    public function selectService($serviceId)
    {
        $this->selectedService = Service::find($serviceId);
        $this->step = 2;
    }

    public function selectDate()
    {
        $this->validate([
            'date' => 'required|date|after:today',
            'time' => 'required',
        ]);
        $this->step = 3;
    }

    public function submitBooking()
    {
        $this->validate([
            'customerName' => 'required|string',
            'customerEmail' => 'required|email',
            'customerPhone' => 'required',
            'petName' => 'required',
            'petType' => 'required',
        ]);

        // Find or create customer
        $customer = Customer::firstOrCreate(
            ['email' => $this->customerEmail],
            [
                'name' => $this->customerName,
                'phone' => $this->customerPhone,
            ]
        );

        // Create pet
        $pet = $customer->pets()->create([
            'name' => $this->petName,
            'type' => $this->petType,
            'breed' => $this->petBreed,
        ]);

        // Create booking
        Booking::create([
            'customer_id' => $customer->id,
            'pet_id' => $pet->id,
            'service_id' => $this->selectedService->id,
            'scheduled_at' => $this->date . ' ' . $this->time,
            'notes' => $this->notes,
            'status' => 'pending',
        ]);

        Toaster::success('Booking submitted successfully!');
        
        $this->step = 4; // Success step
    }

    public function render()
    {
        return view('livewire.booking.create', [
            'services' => Service::all(),
        ])->layout('components.layouts.guest');
    }
}
