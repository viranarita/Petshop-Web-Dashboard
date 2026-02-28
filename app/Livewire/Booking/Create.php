<?php

namespace App\Livewire\Booking;

use App\Models\Service;
use Livewire\Component;

class Create extends Component
{
    public int $currentStep = 1;

    // Step 1: Service & Location
    public ?int $selectedServiceId = null;
    public $selectedService = null;
    public string $selectedLocation = 'Downtown Pet Spa - Jl. Jendral Sudirman No. 123';

    // Step 2: Date & Time
    public ?string $bookingDate = null;
    public ?string $bookingTime = null;

    // Step 3: Payment
    public string $paymentMethod = 'virtual_account'; // 'virtual_account' | 'qris'
    public string $selectedBank = 'bca';

    // Step 4: Success
    public string $bookingCode = '';

    public array $locations = [
        'Downtown Pet Spa - Jl. Jendral Sudirman No. 123',
        'Uptown Grooming - Jl. Kemang Raya No. 45',
        'PetPamper Selatan - Jl. TB Simatupang No. 12',
    ];

    public function selectService(int $serviceId): void
    {
        $this->selectedServiceId = $serviceId;
        $this->selectedService = Service::find($serviceId);
    }

    public function selectDate(string $date): void
    {
        $this->bookingDate = $date;
    }

    public function selectTime(string $time): void
    {
        $this->bookingTime = $time;
    }

    public function setPaymentMethod(string $method): void
    {
        $this->paymentMethod = $method;
    }

    public function setBank(string $bank): void
    {
        $this->selectedBank = $bank;
    }

    public function nextStep(): void
    {
        if ($this->currentStep === 1 && $this->selectedServiceId) {
            $this->currentStep = 2;
        } elseif ($this->currentStep === 2 && $this->bookingDate && $this->bookingTime) {
            $this->currentStep = 3;
        } elseif ($this->currentStep === 3) {
            $this->submitBooking();
        }
    }

    public function prevStep(): void
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function submitBooking(): void
    {
        $this->bookingCode = 'PG-' . strtoupper(substr(md5(uniqid()), 0, 6));
        $this->currentStep = 4;
    }

    public function resetBooking(): void
    {
        $this->reset([
            'currentStep', 'selectedService', 'selectedServiceId',
            'bookingDate', 'bookingTime', 'paymentMethod', 'selectedBank', 'bookingCode',
        ]);
        $this->currentStep = 1;
        $this->paymentMethod = 'virtual_account';
        $this->selectedBank = 'bca';
        $this->selectedLocation = 'Downtown Pet Spa - Jl. Jendral Sudirman No. 123';
    }

    public function getTotalProperty(): int
    {
        if (!$this->selectedService) return 0;
        return (int) ($this->selectedService->price * 1.11);
    }

    public function render()
    {
        return view('livewire.booking.create', [
            'services' => Service::all(),
        ])->layout('components.layouts.booking');
    }
}
