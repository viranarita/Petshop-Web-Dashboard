<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;

class Calendar extends Component
{
    public function getEventsProperty()
    {
        return Booking::with(['pet', 'service', 'customer'])->get()->map(function ($booking) {
            return [
                'id' => $booking->id,
                'title' => $booking->customer->name . ' - ' . $booking->service->name,
                'start' => $booking->scheduled_at->toIso8601String(),
                'color' => $this->getStatusColor($booking->status),
                'extendedProps' => [
                    'pet' => $booking->pet->name,
                    'notes' => $booking->notes,
                ]
            ];
        });
    }

    private function getStatusColor($status)
    {
        return match ($status) {
            'confirmed' => '#10B981', // green
            'pending' => '#F59E0B', // yellow
            'cancelled' => '#EF4444', // red
            'completed' => '#3B82F6', // blue
            default => '#6B7280',
        };
    }

    public function render()
    {
        return view('livewire.calendar')->layout('components.layouts.app');
    }
}
