<?php

namespace App\Livewire\Booking;

use Livewire\Component;
use App\Models\Service;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;

class Create extends Component
{
    // Pastikan ini PUBLIC dan penulisan S besar (camelCase)
    public $currentStep = 1;
    public $selectedServiceId;
    public $bookingDate;
    public $bookingTime;
    public $bookingCode;

    protected $rules = [
        'selectedServiceId' => 'required|exists:services,id',
        'bookingDate' => 'required|date',
        'bookingTime' => 'required|string',
    ];

    #[Computed]
    public function selectedService()
    {
        return Service::find($this->selectedServiceId);
    }

    public function selectService($id)
    {
        $this->selectedServiceId = $id;
        $this->currentStep = 2;
    }

    public function selectDate($date)
    {
        $this->bookingDate = $date;
    }

    public function selectTime($time)
    {
        $this->bookingTime = $time;
        $this->confirmBooking();
    }

    public function confirmBooking()
    {
        $this->validate();

        $scheduledAt = Carbon::parse($this->bookingDate . ' ' . $this->bookingTime);
        $this->bookingCode = 'PG-' . strtoupper(Str::random(6));

        Booking::create([
            'service_id' => $this->selectedServiceId,
            'scheduled_at' => $scheduledAt,
            'booking_code' => $this->bookingCode,
        ]);

        $this->currentStep = 3;
    }

    public function resetBooking()
    {
        $this->reset(['selectedServiceId', 'bookingDate', 'bookingTime', 'bookingCode']);
        $this->currentStep = 1;
    }

    public function render()
    {
        return view('livewire.booking.create', [
            'services' => Service::all(),
            // Mengirim variabel secara eksplisit untuk mencegah "Undefined Variable"
            'currentStep' => $this->currentStep,
        ])->layout('components.layouts.app');
    }
}