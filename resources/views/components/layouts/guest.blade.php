<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Petshop Management' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0">
        {{ $slot }}
    </div>

    <x-toaster-hub />
</body>
</html>
