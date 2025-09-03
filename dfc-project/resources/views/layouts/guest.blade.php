<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts (ganti Figtree → Poppins kalau mau default Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-blue-500 text-gray-900 antialiased min-h-screen flex items-center justify-center">

    <div class="w-full max-w-5xl mx-auto bg-white shadow-lg rounded-2xl overflow-hidden flex flex-col md:flex-row">

        <!-- Left: Image -->
        <div class="hidden md:flex md:w-1/2 items-center justify-center p-8">
            <img src="/images/login.png" alt="Login Illustration" class="w-80 h-auto">
        </div>

        <!-- Right: Form -->
        <div class="w-full md:w-1/2 p-8 py-12 md:p-12">
            <div>
                {{ $slot }}
            </div>
        </div>

    </div>

</body>
</html>
