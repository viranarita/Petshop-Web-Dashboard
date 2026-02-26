<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPamper - Perawatan Profesional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }

        /* Soft Teal */
        .bg-teal-custom { background-color: #14b8a6; }
        .text-teal-custom { color: #14b8a6; }
        .border-teal-custom { border-color: #14b8a6; }

        .shadow-teal-soft { box-shadow: 0 10px 25px rgba(20,184,166,0.18); }
    </style>
</head>
<body class="bg-white text-gray-800 m-0 p-0">

<nav class="bg-white/80 backdrop-blur-md py-5 px-10 flex justify-between items-center sticky top-0 z-50 shadow-sm border-b border-gray-100">
    <div class="flex items-center gap-2">
        <div class="bg-teal-custom p-2 rounded-xl text-white shadow-teal-soft">
            <i class="fas fa-paw"></i>
        </div>
        <span class="text-xl font-extrabold tracking-tight text-gray-900">PetPamper</span>
    </div>
    
    <div class="hidden md:flex gap-10 text-sm font-bold text-gray-400">
        <a href="{{ url('/') }}" class="text-gray-900 border-b-2 border-teal-custom pb-1">Beranda</a>
        <a href="{{ route('booking') }}" class="hover:text-gray-900 transition-colors">Layanan</a>
        <a href="#toko" class="hover:text-gray-900 transition-colors">Toko</a>
        <a href="#" class="hover:text-gray-900 transition-colors">Tentang Kami</a>
        <a href="#" class="hover:text-gray-900 transition-colors">Artikel</a>
    </div>

    <div class="flex gap-3">
        @auth
            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 text-sm font-bold text-teal-custom border border-teal-custom rounded-full hover:bg-teal-50 transition">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-teal-custom border border-teal-custom rounded-full hover:bg-teal-50 transition">Masuk</a>
            <a href="#" class="px-6 py-2.5 text-sm font-bold text-white bg-teal-custom hover:bg-[#0d9488] rounded-full shadow-teal-soft transition">Daftar</a>
        @endauth
    </div>
</nav>

<main class="max-w-7xl mx-auto px-6">

<div class="relative rounded-[3rem] overflow-hidden bg-cover bg-center h-[550px] mt-4 shadow-xl"
style="background-image: url('https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?q=80&w=1200');">
    <div class="absolute inset-0 bg-black/30 flex flex-col justify-center px-16 text-white">
        <span class="text-[10px] font-black uppercase bg-yellow-400 text-black w-fit px-4 py-1.5 rounded-full mb-6 tracking-widest italic">
            ⭐ PLATFORM GROOMING #1 INDONESIA
        </span>
        <h1 class="text-6xl font-extrabold leading-[1.1] mb-6 tracking-tight">
            Manjakan Hewan<br>Peliharaan dengan<br>
            <span class="text-[#5eead4]">Perawatan Profesional</span>
        </h1>
        <p class="max-w-lg text-gray-100 mb-10 text-lg leading-relaxed font-medium">
            Layanan grooming terbaik dan perlengkapan premium untuk anabul kesayangan Anda.
        </p>
        <div class="flex gap-4">
            <a href="{{ route('booking') }}"
               class="px-10 py-4 bg-teal-custom hover:bg-[#0d9488] text-white rounded-2xl font-bold flex items-center gap-3 shadow-teal-soft hover:scale-105 transition duration-300">
                <i class="fas fa-calendar-check text-xl"></i> Booking Sekarang
            </a>
            <a href="#toko"
               class="px-10 py-4 bg-white/20 backdrop-blur-md border border-white/40 rounded-2xl font-bold flex items-center gap-3 hover:bg-white/30 transition">
                <i class="fas fa-shopping-bag text-xl"></i> Belanja Produk
            </a>
        </div>
    </div>
</div>

</main>

</body>
</html>
