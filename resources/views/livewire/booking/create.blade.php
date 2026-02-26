<div class="bg-white min-h-screen font-sans pb-20">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-teal-custom { background-color: #00ebd4; }
        .text-teal-custom { color: #00ebd4; }
        .border-teal-custom { border-color: #00ebd4; }
    </style>

    <main class="max-w-7xl mx-auto px-6 py-12">

        {{-- STEP INDICATOR --}}
        <div class="flex items-center justify-center mb-12 gap-4">
            {{-- Step 1 --}}
            <div class="flex items-center gap-2 {{ $currentStep == 1 ? 'bg-[#e0fffb] border-teal-custom' : 'opacity-30' }} px-5 py-2.5 rounded-xl border">
                <span class="bg-teal-custom text-white w-6 h-6 rounded-lg flex items-center justify-center text-[10px] font-black">1</span>
                <span class="text-teal-custom text-[10px] font-black uppercase tracking-widest">Layanan</span>
            </div>

            <div class="w-10 h-px bg-gray-100"></div>

            {{-- Step 2 --}}
            <div class="flex items-center gap-2 {{ $currentStep == 2 ? 'bg-[#e0fffb] border-teal-custom' : 'opacity-30' }} px-5 py-2.5 rounded-xl border">
                <span class="{{ $currentStep >= 2 ? 'bg-teal-custom' : 'bg-gray-100' }} text-white w-6 h-6 rounded-lg flex items-center justify-center text-[10px] font-black">2</span>
                <span class="text-gray-900 text-[10px] font-black uppercase tracking-widest">Tanggal</span>
            </div>

            <div class="w-10 h-px bg-gray-100"></div>

            {{-- Step 3 --}}
            <div class="flex items-center gap-2 {{ $currentStep == 3 ? 'bg-[#e0fffb] border-teal-custom' : 'opacity-30' }} px-5 py-2.5 rounded-xl border">
                <span class="{{ $currentStep == 3 ? 'bg-teal-custom' : 'bg-gray-100' }} text-white w-6 h-6 rounded-lg flex items-center justify-center text-[10px] font-black">3</span>
                <span class="text-gray-900 text-[10px] font-black uppercase tracking-widest">Selesai</span>
            </div>
        </div>

        {{-- STEP 1 --}}
        @if($currentStep == 1)
            <div class="grid lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2 bg-white p-10 rounded-3xl shadow border">
                    <h3 class="font-bold mb-8">Pilih Layanan</h3>
                    <div class="grid md:grid-cols-2 gap-5">
                        @foreach($services as $service)
                            <div wire:click="selectService({{ $service->id }})"
                                class="p-6 border-2 rounded-2xl cursor-pointer transition-all {{ $selectedServiceId == $service->id ? 'border-teal-custom bg-[#f0fdfa]' : 'border-gray-100' }}">
                                <h4 class="font-bold">{{ $service->name }}</h4>
                                <p class="mt-2 text-sm font-bold">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow border sticky top-20">
                    <h3 class="font-bold mb-6">Ringkasan</h3>
                    <div class="flex justify-between text-sm">
                        <span>Subtotal</span>
                        <span>Rp {{ $selectedService ? number_format($selectedService->price, 0, ',', '.') : '0' }}</span>
                    </div>
                    <div class="mt-6 border-t pt-4 flex justify-between font-bold">
                        <span>Total</span>
                        <span class="text-teal-custom text-xl">Rp {{ $selectedService ? number_format($selectedService->price, 0, ',', '.') : '0' }}</span>
                    </div>
                </div>
            </div>

        {{-- STEP 2 --}}
        @elseif($currentStep == 2)
            <div class="bg-white p-10 rounded-3xl shadow border max-w-4xl mx-auto">
                <h3 class="font-bold mb-6 text-center">Pilih Tanggal & Waktu</h3>
                <div class="grid grid-cols-7 gap-2 mb-8">
                    @for($i = 1; $i <= 14; $i++)
                        @php $dateStr = "2026-03-" . str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                        <button wire:click="selectDate('{{ $dateStr }}')"
                            class="p-4 rounded-xl border font-bold transition-all {{ $bookingDate == $dateStr ? 'bg-teal-custom text-white border-teal-custom shadow-lg shadow-teal-100' : 'hover:border-teal-custom' }}">
                            {{ $i }}
                        </button>
                    @endfor
                </div>

                @if($bookingDate)
                    <h3 class="font-bold mb-4 text-sm text-gray-400">JAM TERSEDIA</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <button wire:click="selectTime('10:30')" class="p-4 border-2 rounded-xl font-bold {{ $bookingTime == '10:30' ? 'border-teal-custom text-teal-custom bg-[#f0fdfa]' : 'border-gray-50' }}">10:30 WIB</button>
                        <button wire:click="selectTime('14:30')" class="p-4 border-2 rounded-xl font-bold {{ $bookingTime == '14:30' ? 'border-teal-custom text-teal-custom bg-[#f0fdfa]' : 'border-gray-50' }}">14:30 WIB</button>
                    </div>
                @endif
            </div>

        {{-- STEP 3 --}}
        @elseif($currentStep == 3)
            <div class="max-w-2xl mx-auto text-center py-16 bg-white rounded-3xl shadow border">
                <div class="text-5xl text-teal-custom mb-6"><i class="fas fa-check-circle"></i></div>
                <h2 class="text-3xl font-bold mb-4">Booking Berhasil!</h2>
                <div class="bg-gray-50 p-8 rounded-2xl mb-8 mx-10">
                    <div class="flex justify-between mb-4">
                        <span class="text-gray-500 italic">ID Booking</span>
                        <span class="font-black text-xl">{{ $bookingCode }}</span>
                    </div>
                    <div class="flex justify-between font-bold">
                        <span>Total Bayar</span>
                        <span class="text-teal-custom text-xl">Rp {{ $selectedService ? number_format($selectedService->price, 0, ',', '.') : '0' }}</span>
                    </div>
                </div>
                <button wire:click="resetBooking" class="px-10 py-3 bg-black text-white rounded-xl font-bold">Booking Lagi</button>
            </div>
        @endif

    </main>
</div>