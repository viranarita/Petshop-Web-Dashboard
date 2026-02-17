<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Book an Appointment</h2>

        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-3xl">
        <h2 class="text-center text-3xl font-extrabold text-gray-900 tracking-tight mb-8">
            Book an Appointment
        </h2>
        
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-between relative">
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 -z-10 rounded-full"></div>
                
                @foreach (range(1, 4) as $s)
                    <div class="flex flex-col items-center bg-gray-50 px-2">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all duration-300 {{ $step >= $s ? 'bg-primary-600 text-white shadow-lg shadow-primary-500/30 ring-4 ring-primary-50' : 'bg-white text-gray-400 border border-gray-200' }}">
                            {{ $s }}
                        </div>
                        <span class="text-xs font-semibold mt-2 {{ $step >= $s ? 'text-primary-700' : 'text-gray-400' }}">
                            {{ $s === 1 ? 'Service' : ($s === 2 ? 'Date' : ($s === 3 ? 'Details' : 'Confirm')) }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white py-8 px-4 shadow-xl shadow-gray-200/50 sm:rounded-2xl sm:px-10 border border-gray-100">
            <!-- Step 1: Select Service -->
            @if ($step === 1)
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 text-primary-600 flex items-center justify-center text-sm">1</span>
                        Select a Service
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($services as $service)
                            <div wire:click="selectService({{ $service->id }})" 
                                 class="relative rounded-xl border p-5 cursor-pointer transition-all duration-200 flex flex-col justify-between h-full group
                                 {{ $selectedServiceId === $service->id 
                                    ? 'border-primary-500 ring-2 ring-primary-500 bg-primary-50' 
                                    : 'border-gray-200 hover:border-primary-300 hover:shadow-md bg-white' }}">
                                <div>
                                    <div class="font-bold text-gray-900 text-lg">{{ $service->name }}</div>
                                    <p class="text-sm text-gray-500 mt-1">{{ $service->description }}</p>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-500 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $service->duration_minutes }} mins
                                    </span>
                                    <span class="text-lg font-bold text-primary-600">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Step 2: Select Date & Time -->
            @if ($step === 2)
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                         <span class="w-8 h-8 rounded-lg bg-primary-100 text-primary-600 flex items-center justify-center text-sm">2</span>
                        Select Date & Time
                    </h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Date</label>
                            <input wire:model.live="date" type="date" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 px-4 text-base" min="{{ date('Y-m-d') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Time Slot</label>
                            @if ($date)
                                <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                                    @foreach ($timeSlots as $slot)
                                        <button wire:click="selectTime('{{ $slot }}')" 
                                                class="py-2 px-4 rounded-lg text-sm font-semibold transition-all duration-200
                                                {{ $time === $slot 
                                                    ? 'bg-primary-600 text-white shadow-lg shadow-primary-500/30' 
                                                    : 'bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-gray-300' }}">
                                            {{ $slot }}
                                        </button>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500 italic">Please select a date first.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Step 3: Customer & Pet Details -->
            @if ($step === 3)
                <div>
                     <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                         <span class="w-8 h-8 rounded-lg bg-primary-100 text-primary-600 flex items-center justify-center text-sm">3</span>
                        Your Details
                    </h3>
                    
                    <div class="space-y-6">
                        <h4 class="font-bold text-lg text-gray-800 border-b pb-2">Customer Information</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
                                <input wire:model="customerName" type="text" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 h-10 px-3">
                                @error('customerName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <input wire:model="customerEmail" type="email" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 h-10 px-3">
                                @error('customerEmail') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Phone</label>
                                <input wire:model="customerPhone" type="text" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 h-10 px-3">
                                @error('customerPhone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <h4 class="font-bold text-lg text-gray-800 border-b pb-2 pt-4">Pet Information</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Pet Name</label>
                                <input wire:model="petName" type="text" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 h-10 px-3">
                                @error('petName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Type</label>
                                <select wire:model="petType" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 h-10 px-3">
                                    <option value="dog">Dog</option>
                                    <option value="cat">Cat</option>
                                    <option value="bird">Bird</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Button Navigation -->
            <div class="mt-8 flex justify-between pt-6 border-t border-gray-100">
                @if ($step > 1)
                    <button wire:click="previousStep" class="px-6 py-2 border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors">
                        Back
                    </button>
                    <!-- Spacer if only Back button exists (though usually there's a next/submit) -->
                @else
                    <div></div> 
                @endif

                @if ($step < 3)
                    <button wire:click="nextStep" class="px-6 py-2 bg-primary-600 text-white rounded-xl text-sm font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 shadow-lg shadow-primary-500/30 transition-all transform hover:-translate-y-0.5">
                        Next Step
                    </button>
                @else
                    <button wire:click="submit" class="px-8 py-3 bg-primary-600 text-white rounded-xl text-base font-bold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 shadow-lg shadow-primary-500/30 transition-all transform hover:-translate-y-0.5">
                        Confirm Booking
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>f ($step === 4)
            <div class="text-center py-10">
                <svg class="h-16 w-16 text-green-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Booking Confirmed!</h3>
                <p class="text-gray-600 mb-6">Your appointment has been scheduled successfully. We look forward to seeing you!</p>
                <a href="{{ route('booking') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Book Another</a>
            </div>
        @endif
    </div>
</div>
