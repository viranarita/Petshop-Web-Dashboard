<div class="min-h-screen bg-[#f8fafc] pb-24">

    {{-- ── HERO HEADER ── --}}
    <div class="max-w-5xl mx-auto px-6 pt-14 pb-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">Booking Sesi Grooming</h1>
        <p class="mt-2 text-gray-500 text-sm">Ikuti langkah di bawah ini untuk menjadwalkan sesi perawatan hewan peliharaan Anda.</p>
    </div>

    {{-- ── STEPPER ── --}}
    <div class="max-w-5xl mx-auto px-6 mb-10">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-8 py-5 flex items-center gap-3">

            {{-- Step 1 --}}
            <div class="flex items-center gap-2.5 flex-shrink-0">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-black
                    {{ $currentStep >= 1 ? 'bg-teal-custom text-white' : 'bg-gray-100 text-gray-400' }}">
                    @if($currentStep > 1) <i class="fas fa-check text-[10px]"></i> @else 1 @endif
                </span>
                <span class="text-xs font-black uppercase tracking-widest leading-tight
                    {{ $currentStep === 1 ? 'text-teal-custom' : ($currentStep > 1 ? 'text-gray-400' : 'text-gray-300') }}">
                    Pilih Layanan<br>&amp; Cabang
                </span>
            </div>

            <div class="step-connector {{ $currentStep > 1 ? 'done' : '' }}"></div>

            {{-- Step 2 --}}
            <div class="flex items-center gap-2.5 flex-shrink-0">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-black
                    {{ $currentStep >= 2 ? 'bg-teal-custom text-white' : 'bg-gray-100 text-gray-400' }}">
                    @if($currentStep > 2) <i class="fas fa-check text-[10px]"></i> @else 2 @endif
                </span>
                <span class="text-xs font-black uppercase tracking-widest leading-tight
                    {{ $currentStep === 2 ? 'text-teal-custom' : ($currentStep > 2 ? 'text-gray-400' : 'text-gray-300') }}">
                    Pilih<br>Tanggal
                </span>
            </div>

            <div class="step-connector {{ $currentStep > 2 ? 'done' : '' }}"></div>

            {{-- Step 3 --}}
            <div class="flex items-center gap-2.5 flex-shrink-0">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-black
                    {{ $currentStep >= 3 ? 'bg-teal-custom text-white' : 'bg-gray-100 text-gray-400' }}">
                    @if($currentStep > 3) <i class="fas fa-check text-[10px]"></i> @else 3 @endif
                </span>
                <span class="text-xs font-black uppercase tracking-widest leading-tight
                    {{ $currentStep === 3 ? 'text-teal-custom' : ($currentStep > 3 ? 'text-gray-400' : 'text-gray-300') }}">
                    Konfirmasi<br>&amp; Bayar
                </span>
            </div>

            <div class="step-connector {{ $currentStep > 3 ? 'done' : '' }}"></div>

            {{-- Step 4 --}}
            <div class="flex items-center gap-2.5 flex-shrink-0">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-xs font-black
                    {{ $currentStep >= 4 ? 'bg-teal-custom text-white' : 'bg-gray-100 text-gray-400' }}">
                    4
                </span>
                <span class="text-xs font-black uppercase tracking-widest leading-tight
                    {{ $currentStep === 4 ? 'text-teal-custom' : 'text-gray-300' }}">
                    Selesai
                </span>
            </div>

        </div>
    </div>

    {{-- ── STEP CONTENT ── --}}
    <div class="max-w-5xl mx-auto px-6">

        {{-- ─────────────── STEP 1: Pilih Layanan & Tempat ─────────────── --}}
        @if($currentStep === 1)
        <div class="step-panel grid lg:grid-cols-5 gap-6">

            {{-- Left: Service + Location --}}
            <div class="lg:col-span-3 space-y-6">

                {{-- Pilih Cabang --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="font-bold text-lg mb-5 flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-teal-custom text-base"></i>
                        Pilih Cabang &amp; Layanan
                    </h3>

                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Cabang Terdekat</p>
                    <select wire:model="selectedLocation"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm font-semibold focus:outline-none focus:border-teal-custom mb-6">
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}">{{ $loc }}</option>
                        @endforeach
                    </select>

                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Pilih Layanan</p>
                    <div class="grid md:grid-cols-2 gap-4">
                        @forelse($services as $service)
                        <div wire:click="selectService({{ $service->id }})"
                             class="p-5 border-2 rounded-2xl cursor-pointer transition-all group
                                    {{ $selectedServiceId === $service->id ? 'border-teal-custom bg-[#f0fdfa]' : 'border-gray-100 hover:border-teal-custom/50' }}">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="font-bold text-sm">{{ $service->name }}</h4>
                                @if($selectedServiceId === $service->id)
                                <div class="w-5 h-5 rounded-full bg-teal-custom flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white text-[8px]"></i>
                                </div>
                                @endif
                            </div>
                            <p class="text-xs text-gray-400 mb-3">{{ $service->description ?? 'Perawatan profesional untuk hewan kesayangan Anda.' }}</p>
                            <p class="text-sm font-black text-gray-900">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                        </div>
                        @empty
                        <div class="col-span-2 text-center py-10 text-gray-400 text-sm">
                            Belum ada layanan tersedia.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Right: Ringkasan --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sticky top-24">
                    <h3 class="font-bold text-lg mb-6">Ringkasan Booking</h3>

                    <div class="space-y-4 text-sm mb-6">
                        <div class="flex gap-3">
                            <div class="w-8 h-8 bg-teal-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-store text-teal-custom text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Cabang</p>
                                <p class="font-bold text-xs leading-snug mt-0.5">{{ $selectedLocation }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 bg-teal-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-paw text-teal-custom text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Layanan</p>
                                <p class="font-bold text-xs leading-snug mt-0.5">
                                    {{ $selectedService ? $selectedService->name : '—' }}
                                </p>
                                @if($selectedService)
                                <p class="text-[10px] text-gray-400">Durasi: ~2 jam</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 bg-teal-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-calendar text-teal-custom text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal &amp; Waktu</p>
                                <p class="font-bold text-xs leading-snug mt-0.5 text-gray-400">Pilih tanggal...</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-2 text-sm">
                        <div class="flex justify-between text-gray-500">
                            <span>Subtotal</span>
                            <span>Rp {{ $selectedService ? number_format($selectedService->price, 0, ',', '.') : '0' }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Pajak (11%)</span>
                            <span>Rp {{ $selectedService ? number_format($selectedService->price * 0.11, 0, ',', '.') : '0' }}</span>
                        </div>
                        <div class="flex justify-between font-black text-base pt-2">
                            <span>Total</span>
                            <span class="text-teal-custom">Rp {{ $selectedService ? number_format($selectedService->price * 1.11, 0, ',', '.') : '0' }}</span>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button disabled class="flex-1 px-4 py-3 border border-gray-200 rounded-xl text-sm font-bold text-gray-400 cursor-not-allowed">
                            Kembali
                        </button>
                        <button wire:click="nextStep"
                                @class(['flex-1 px-4 py-3 rounded-xl text-sm font-bold transition', 'bg-teal-custom text-white hover:bg-[#0d9488] shadow-teal-soft' => $selectedServiceId, 'bg-gray-100 text-gray-400 cursor-not-allowed' => !$selectedServiceId])
                                {{ !$selectedServiceId ? 'disabled' : '' }}>
                            Lanjut →
                        </button>
                    </div>
                </div>
            </div>

        </div>
        @endif

        {{-- ─────────────── STEP 2: Pilih Tanggal ─────────────── --}}
        @if($currentStep === 2)
        <div class="step-panel grid lg:grid-cols-5 gap-6">
            <div class="lg:col-span-3 bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h3 class="font-bold text-lg mb-6 flex items-center gap-2">
                    <i class="fas fa-calendar-alt text-teal-custom"></i>
                    Pilih Tanggal
                </h3>

                {{-- Calendar --}}
                @php
                    $fullMonths = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                    $days = ['MIN','SEN','SEL','RAB','KAM','JUM','SAB'];
                    $calYear = 2026;
                    $calMonth = 3; // Maret 2026
                    $firstDow = \Carbon\Carbon::create($calYear, $calMonth, 1)->dayOfWeek;
                    $daysInMonth = \Carbon\Carbon::create($calYear, $calMonth)->daysInMonth;
                @endphp

                <div class="flex items-center justify-between mb-5">
                    <h4 class="font-bold text-base">{{ $fullMonths[$calMonth] }} {{ $calYear }}</h4>
                    <div class="flex gap-2">
                        <button class="w-8 h-8 rounded-xl border border-gray-200 flex items-center justify-center text-gray-400 hover:border-teal-custom hover:text-teal-custom transition">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </button>
                        <button class="w-8 h-8 rounded-xl border border-gray-200 flex items-center justify-center text-gray-400 hover:border-teal-custom hover:text-teal-custom transition">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-7 gap-1 mb-3">
                    @foreach($days as $d)
                    <div class="text-center text-[10px] font-black text-gray-400 uppercase py-1">{{ $d }}</div>
                    @endforeach
                </div>

                <div class="grid grid-cols-7 gap-1">
                    @for($blank = 0; $blank < $firstDow; $blank++)
                    <div class="cal-day empty"></div>
                    @endfor

                    @for($day = 1; $day <= $daysInMonth; $day++)
                    @php $dateStr = sprintf('%04d-%02d-%02d', $calYear, $calMonth, $day); @endphp
                    <div wire:click="selectDate('{{ $dateStr }}')"
                         class="cal-day {{ $bookingDate === $dateStr ? 'selected' : '' }}">
                        {{ $day }}
                    </div>
                    @endfor
                </div>

                {{-- Time slots --}}
                @if($bookingDate)
                <div class="mt-8">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">
                        Tersedia pada {{ \Carbon\Carbon::parse($bookingDate)->format('j M') }}
                    </p>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach(['09:00','10:30','13:00','14:30','15:30','16:00'] as $t)
                        <button wire:click="selectTime('{{ $t }}')"
                                class="py-3 border-2 rounded-xl text-sm font-bold transition
                                       {{ $bookingTime === $t ? 'border-teal-custom bg-teal-custom text-white' : 'border-gray-100 hover:border-teal-custom hover:text-teal-custom' }}">
                            {{ $t }} WIB
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Right: Ringkasan --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sticky top-24">
                    <h3 class="font-bold text-lg mb-6">Ringkasan Booking</h3>

                    <div class="space-y-4 text-sm mb-6">
                        <div class="flex gap-3">
                            <div class="w-8 h-8 bg-teal-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-store text-teal-custom text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Cabang</p>
                                <p class="font-bold text-xs leading-snug mt-0.5">{{ $selectedLocation }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 bg-teal-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-paw text-teal-custom text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Layanan</p>
                                <p class="font-bold text-xs leading-snug mt-0.5">{{ $selectedService->name ?? '—' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-8 h-8 bg-teal-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-calendar text-teal-custom text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal &amp; Waktu</p>
                                <p class="font-bold text-xs leading-snug mt-0.5">
                                    {{ $bookingDate ? \Carbon\Carbon::parse($bookingDate)->translatedFormat('d F Y') : '—' }}
                                    {{ $bookingTime ? '· ' . $bookingTime . ' WIB' : '' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-2 text-sm">
                        <div class="flex justify-between text-gray-500">
                            <span>Subtotal</span>
                            <span>Rp {{ $selectedService ? number_format($selectedService->price, 0, ',', '.') : '0' }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Pajak (11%)</span>
                            <span>Rp {{ $selectedService ? number_format($selectedService->price * 0.11, 0, ',', '.') : '0' }}</span>
                        </div>
                        <div class="flex justify-between font-black text-base pt-2">
                            <span>Total</span>
                            <span class="text-teal-custom">Rp {{ $selectedService ? number_format($selectedService->price * 1.11, 0, ',', '.') : '0' }}</span>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button wire:click="prevStep" class="flex-1 px-4 py-3 border border-gray-200 rounded-xl text-sm font-bold text-gray-600 hover:border-gray-400 transition">
                            Kembali
                        </button>
                        <button wire:click="nextStep"
                                @class(['flex-1 px-4 py-3 rounded-xl text-sm font-bold transition', 'bg-teal-custom text-white hover:bg-[#0d9488] shadow-teal-soft' => ($bookingDate && $bookingTime), 'bg-gray-100 text-gray-400 cursor-not-allowed' => !($bookingDate && $bookingTime)])
                                {{ !($bookingDate && $bookingTime) ? 'disabled' : '' }}>
                            Lanjut →
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- ─────────────── STEP 3: Konfirmasi & Pembayaran ─────────────── --}}
        @if($currentStep === 3)
        <div class="step-panel grid lg:grid-cols-5 gap-6">
            <div class="lg:col-span-3 space-y-5">

                {{-- Detail Order --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="font-bold text-lg mb-5 flex items-center gap-2">
                        <i class="fas fa-receipt text-teal-custom"></i>
                        Detail Order
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between py-3 border-b border-gray-50">
                            <span class="text-gray-500">Layanan</span>
                            <span class="font-bold">{{ $selectedService->name ?? '—' }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-50">
                            <span class="text-gray-500">Cabang</span>
                            <span class="font-bold text-right max-w-[200px]">{{ $selectedLocation }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-50">
                            <span class="text-gray-500">Tanggal</span>
                            <span class="font-bold">{{ $bookingDate ? \Carbon\Carbon::parse($bookingDate)->translatedFormat('d F Y') : '—' }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-50">
                            <span class="text-gray-500">Jam</span>
                            <span class="font-bold">{{ $bookingTime }} WIB</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-50">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-bold">Rp {{ $selectedService ? number_format($selectedService->price, 0, ',', '.') : '0' }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-50">
                            <span class="text-gray-500">Pajak (11%)</span>
                            <span class="font-bold">Rp {{ $selectedService ? number_format($selectedService->price * 0.11, 0, ',', '.') : '0' }}</span>
                        </div>
                        <div class="flex justify-between py-3 text-base font-black">
                            <span>Total Pembayaran</span>
                            <span class="text-teal-custom">Rp {{ $selectedService ? number_format($selectedService->price * 1.11, 0, ',', '.') : '0' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="font-bold text-lg mb-5 flex items-center gap-2">
                        <i class="fas fa-credit-card text-teal-custom"></i>
                        Metode Pembayaran
                    </h3>

                    <div class="space-y-3 mb-6">
                        {{-- Virtual Account --}}
                        <div wire:click="setPaymentMethod('virtual_account')"
                             class="pay-card {{ $paymentMethod === 'virtual_account' ? 'active' : '' }}">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                                <i class="fas fa-university text-blue-500"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-sm">Virtual Account Bank</p>
                                <p class="text-xs text-gray-400">BCA, BNI, BRI, Mandiri, BSI</p>
                            </div>
                            <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center
                                        {{ $paymentMethod === 'virtual_account' ? 'border-teal-custom bg-teal-custom' : 'border-gray-200' }}">
                                @if($paymentMethod === 'virtual_account')
                                <div class="w-2 h-2 rounded-full bg-white"></div>
                                @endif
                            </div>
                        </div>

                        {{-- QRIS --}}
                        <div wire:click="setPaymentMethod('qris')"
                             class="pay-card {{ $paymentMethod === 'qris' ? 'active' : '' }}">
                            <div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center">
                                <i class="fas fa-qrcode text-orange-500"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-sm">QRIS</p>
                                <p class="text-xs text-gray-400">Scan & bayar dengan semua e-wallet</p>
                            </div>
                            <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center
                                        {{ $paymentMethod === 'qris' ? 'border-teal-custom bg-teal-custom' : 'border-gray-200' }}">
                                @if($paymentMethod === 'qris')
                                <div class="w-2 h-2 rounded-full bg-white"></div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- VA Bank Selector --}}
                    @if($paymentMethod === 'virtual_account')
                    <div>
                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Pilih Bank</p>
                        <div class="grid grid-cols-3 gap-3">
                            @foreach([
                                ['id'=>'bca',  'name'=>'BCA',     'color'=>'#003087'],
                                ['id'=>'bni',  'name'=>'BNI',     'color'=>'#f15a2c'],
                                ['id'=>'bri',  'name'=>'BRI',     'color'=>'#005bac'],
                                ['id'=>'mandiri','name'=>'Mandiri','color'=>'#003087'],
                                ['id'=>'bsi',  'name'=>'BSI',     'color'=>'#007b4f'],
                                ['id'=>'cimb', 'name'=>'CIMB',    'color'=>'#d31145'],
                            ] as $bank)
                            <button wire:click="setBank('{{ $bank['id'] }}')"
                                    class="py-3 px-2 border-2 rounded-xl text-xs font-black transition
                                           {{ $selectedBank === $bank['id'] ? 'border-teal-custom bg-teal-custom/10 text-teal-custom' : 'border-gray-100 text-gray-600 hover:border-teal-custom/50' }}">
                                {{ $bank['name'] }}
                            </button>
                            @endforeach
                        </div>

                        {{-- Dummy VA number --}}
                        @if($selectedBank)
                        <div class="mt-5 bg-gray-50 rounded-2xl p-5">
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Nomor Virtual Account</p>
                            <div class="flex items-center justify-between">
                                <p class="text-xl font-black tracking-widest text-gray-900">
                                    {!! match($selectedBank) {
                                        'bca'     => '741 7000 1234 5678',
                                        'bni'     => '889 8000 9876 5432',
                                        'bri'     => '002 1000 2222 3333',
                                        'mandiri' => '891 1000 5555 6666',
                                        'bsi'     => '451 7777 8888 9999',
                                        'cimb'    => '800 3111 2222 3333',
                                        default   => '000 0000 0000 0000',
                                    } !!}
                                </p>
                                <button onclick="this.innerText='✓ Tersalin'" class="text-xs font-bold text-teal-custom hover:underline">
                                    Salin
                                </button>
                            </div>
                            <p class="text-xs text-gray-400 mt-2">Berlaku selama <span class="font-bold text-gray-700">24 jam</span></p>
                        </div>
                        @endif
                    </div>
                    @endif

                    {{-- QRIS Code --}}
                    @if($paymentMethod === 'qris')
                    <div class="flex flex-col items-center py-6 bg-gray-50 rounded-2xl">
                        <div class="w-48 h-48 bg-white border-2 border-gray-200 rounded-2xl flex items-center justify-center mb-4">
                            {{-- Fake QR grid --}}
                            <div class="grid grid-cols-10 gap-0.5 p-2">
                                @php
                                    $pattern = [1,1,1,1,1,1,1,0,1,0,1,0,0,0,0,0,0,1,0,1,1,0,1,1,1,0,1,0,1,0,
                                                1,0,1,1,1,0,1,0,0,1,1,0,1,1,1,0,1,1,0,0,1,1,1,1,1,1,1,0,1,1,
                                                0,0,0,0,0,0,0,0,1,0,1,1,0,1,1,0,0,1,0,1,0,0,1,0,1,1,0,1,1,0,
                                                0,1,0,0,1,0,1,1,0,0];
                                @endphp
                                @foreach($pattern as $bit)
                                <div class="w-1.5 h-1.5 {{ $bit ? 'bg-gray-900' : 'bg-white' }} rounded-[1px]"></div>
                                @endforeach
                            </div>
                        </div>
                        <p class="text-xs font-bold text-gray-500">Scan dengan aplikasi e-wallet Anda</p>
                        <p class="text-xs text-gray-400 mt-1">GoPay · OVO · Dana · ShopeePay · LinkAja</p>
                    </div>
                    @endif
                </div>

            </div>

            {{-- Right: Summary --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sticky top-24">
                    <h3 class="font-bold text-lg mb-4">Ringkasan</h3>

                    <div class="bg-teal-50 rounded-2xl p-4 mb-5 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Layanan</span>
                            <span class="font-bold text-right">{{ $selectedService->name ?? '—' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tanggal</span>
                            <span class="font-bold">{{ $bookingDate ? \Carbon\Carbon::parse($bookingDate)->format('d/m/Y') : '—' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jam</span>
                            <span class="font-bold">{{ $bookingTime }} WIB</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-2 text-sm">
                        <div class="flex justify-between text-gray-500">
                            <span>Subtotal</span>
                            <span>Rp {{ $selectedService ? number_format($selectedService->price, 0, ',', '.') : '0' }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Pajak (11%)</span>
                            <span>Rp {{ $selectedService ? number_format($selectedService->price * 0.11, 0, ',', '.') : '0' }}</span>
                        </div>
                        <div class="flex justify-between font-black text-base pt-2">
                            <span>Total</span>
                            <span class="text-teal-custom">Rp {{ $selectedService ? number_format($selectedService->price * 1.11, 0, ',', '.') : '0' }}</span>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <button wire:click="prevStep" class="flex-1 px-4 py-3 border border-gray-200 rounded-xl text-sm font-bold text-gray-600 hover:border-gray-400 transition">
                            Kembali
                        </button>
                        <button wire:click="nextStep"
                                class="flex-1 px-4 py-3 rounded-xl text-sm font-bold bg-teal-custom text-white hover:bg-[#0d9488] shadow-teal-soft transition">
                            Bayar Sekarang
                        </button>
                    </div>

                    <p class="text-[10px] text-gray-400 text-center mt-3">
                        <i class="fas fa-lock mr-1"></i> Transaksi aman &amp; terenkripsi
                    </p>
                </div>
            </div>
        </div>
        @endif

        {{-- ─────────────── STEP 4: Sukses ─────────────── --}}
        @if($currentStep === 4)
        <div class="step-panel flex flex-col items-center justify-center py-10">

            {{-- Confetti particles --}}
            <div class="relative mb-8" style="width:100%; max-width:520px">
                <div class="absolute inset-0 overflow-hidden pointer-events-none" style="height:200px">
                    @foreach([
                        ['left:15%','background:#14b8a6','animation-delay:0s'],
                        ['left:30%','background:#fbbf24','animation-delay:0.1s'],
                        ['left:50%','background:#818cf8','animation-delay:0.2s'],
                        ['left:65%','background:#f43f5e','animation-delay:0.05s'],
                        ['left:80%','background:#34d399','animation-delay:0.15s'],
                        ['left:45%','background:#f97316','animation-delay:0.25s'],
                        ['left:22%','background:#60a5fa','animation-delay:0.3s'],
                        ['left:72%','background:#a78bfa','animation-delay:0.12s'],
                    ] as $c)
                    <div class="confetti-piece" style="{{ $c[0] }};top:0;{{ $c[1] }};{{ $c[2] }}"></div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-10 max-w-xl w-full text-center">

                {{-- Animated check --}}
                <div class="w-24 h-24 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-6 animate-pop">
                    <div class="w-16 h-16 bg-teal-custom rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-2xl"></i>
                    </div>
                </div>

                <h2 class="text-3xl font-extrabold mb-2 text-gray-900">Booking Berhasil!</h2>
                <p class="text-gray-500 text-sm mb-1">
                    Sesi perawatan untuk <span class="font-bold text-gray-900">hewan peliharaan Anda</span> telah dijadwalkan.
                </p>
                <p class="text-gray-400 text-xs mb-8">Kami telah mengirimkan konfirmasi ke email Anda.</p>

                <div class="inline-flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 text-xs font-bold px-4 py-2.5 rounded-full mb-8">
                    <i class="fab fa-whatsapp text-base"></i>
                    Notifikasi WhatsApp Terkirim
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 mb-8 text-left space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">ID Booking</span>
                        <span class="font-black text-lg text-gray-900">#{{ $bookingCode }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">Layanan</span>
                        <span class="font-bold text-gray-800">{{ $selectedService->name ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">Jadwal</span>
                        <span class="font-bold text-gray-800">
                            {{ $bookingDate ? \Carbon\Carbon::parse($bookingDate)->format('d/m/Y') : '' }} · {{ $bookingTime }} WIB
                        </span>
                    </div>
                    <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
                        <span class="text-sm font-bold">Total Dibayar</span>
                        <span class="text-teal-custom text-xl font-black">
                            Rp {{ $selectedService ? number_format($selectedService->price * 1.11, 0, ',', '.') : '0' }}
                        </span>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button wire:click="resetBooking"
                            class="flex-1 px-6 py-3.5 border-2 border-gray-200 rounded-2xl text-sm font-bold text-gray-700 hover:border-gray-400 transition">
                        Booking Lagi
                    </button>
                    <button class="flex-1 px-6 py-3.5 bg-gray-900 text-white rounded-2xl text-sm font-bold hover:bg-gray-700 transition">
                        Lihat Booking Saya
                    </button>
                </div>
            </div>
        </div>
        @endif

    </div>{{-- /max-w-5xl --}}
</div>