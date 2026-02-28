<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Layanan – PetPamper' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        *, body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-teal-custom   { background-color: #14b8a6; }
        .text-teal-custom { color: #14b8a6; }
        .border-teal-custom { border-color: #14b8a6; }
        .shadow-teal-soft { box-shadow: 0 10px 25px rgba(20,184,166,0.18); }
        .ring-teal { outline: 2px solid #14b8a6; outline-offset: 2px; }

        /* Step connector line */
        .step-connector { flex: 1; height: 2px; background: #e2e8f0; border-radius: 9999px; }
        .step-connector.done { background: #14b8a6; }

        /* Calendar grid */
        .cal-day {
            aspect-ratio: 1;
            display: flex; align-items: center; justify-content: center;
            border-radius: 0.75rem; font-size: 0.85rem; font-weight: 700;
            cursor: pointer; transition: all .15s;
        }
        .cal-day:hover:not(.selected):not(.empty)  { background: #f0fdfa; color: #14b8a6; }
        .cal-day.selected { background: #14b8a6; color: #fff; }
        .cal-day.empty    { cursor: default; }

        /* Payment card */
        .pay-card { border: 2px solid #e2e8f0; border-radius: 1rem; padding: 1.25rem 1.5rem;
                    display: flex; align-items: center; gap: 1rem; cursor: pointer; transition: all .15s; }
        .pay-card:hover { border-color: #14b8a6; }
        .pay-card.active { border-color: #14b8a6; background: #f0fdfa; }

        /* Success animation */
        @keyframes pop-in {
            0%   { transform: scale(0.3); opacity: 0; }
            60%  { transform: scale(1.15); }
            80%  { transform: scale(0.95); }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-pop { animation: pop-in 0.65s cubic-bezier(.22,.68,0,1.2) forwards; }

        @keyframes confetti-fall {
            0%   { transform: translateY(-20px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(200px) rotate(720deg); opacity: 0; }
        }
        .confetti-piece {
            position: absolute; width: 10px; height: 10px; border-radius: 2px;
            animation: confetti-fall 1.2s ease forwards;
        }

        /* Fade step transition */
        .step-panel { animation: fadeUp .3s ease forwards; }
        @keyframes fadeUp {
            from { opacity:0; transform: translateY(12px); }
            to   { opacity:1; transform: translateY(0); }
        }
    </style>
    @livewireStyles
</head>
<body class="bg-[#f8fafc] text-gray-800 m-0 p-0">

{{-- ── NAVBAR ── --}}
<nav class="bg-white/80 backdrop-blur-md py-5 px-10 flex justify-between items-center sticky top-0 z-50 shadow-sm border-b border-gray-100">
    <div class="flex items-center gap-2">
        <div class="bg-teal-custom p-2 rounded-xl text-white shadow-teal-soft">
            <i class="fas fa-paw"></i>
        </div>
        <span class="text-xl font-extrabold tracking-tight text-gray-900">PetPamper</span>
    </div>

    <div class="hidden md:flex gap-10 text-sm font-bold text-gray-400">
        <a href="{{ url('/') }}" class="hover:text-gray-900 transition-colors">Beranda</a>
        <a href="{{ route('booking') }}" class="text-gray-900 border-b-2 border-teal-custom pb-1">Layanan</a>
        <a href="#" class="hover:text-gray-900 transition-colors">Toko</a>
        <a href="#" class="hover:text-gray-900 transition-colors">Tentang Kami</a>
        <a href="#" class="hover:text-gray-900 transition-colors">Artikel</a>
    </div>

    <div class="flex gap-3">
        @auth
            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 text-sm font-bold text-teal-custom border border-teal-custom rounded-full hover:bg-teal-50 transition">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-teal-custom border border-teal-custom rounded-full hover:bg-teal-50 transition">Masuk</a>
            <a href="#"              class="px-6 py-2.5 text-sm font-bold text-white bg-teal-custom hover:bg-[#0d9488] rounded-full shadow-teal-soft transition">Daftar</a>
        @endauth
    </div>
</nav>

{{ $slot }}

<footer class="text-center text-xs text-gray-400 py-10">© 2025 PetPamper. Hak cipta dilindungi.</footer>

<x-toaster-hub />
@livewireScripts
</body>
</html>
