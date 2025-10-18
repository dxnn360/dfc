<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DFC UMP</title>

    <link rel="icon" type="image/png" href="{{ asset('images/headerdfc.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gradient-to-br from-neutral-100 to-neutral-200 text-neutral-900 antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-5xl mx-auto bg-white rounded-3xl overflow-hidden shadow-xl flex flex-col md:flex-row">

        <!-- Left: White Background with Image -->
        <div class="hidden md:flex md:w-1/2 bg-white p-12 flex-col justify-between relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-neutral-100 opacity-50 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-neutral-100 opacity-50 rounded-full -ml-24 -mb-24"></div>
            
            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-8">
                    <div class="w-10 h-10 bg-neutral-900 rounded-lg flex items-center justify-center">
                        <span class="text-white text-lg font-bold">D</span>
                    </div>
                    <span class="text-neutral-900 text-xl font-semibold">DFC UMP</span>
                </div>
                <h2 class="text-3xl font-bold text-neutral-900 mb-4">Digital Forensics Center</h2>
                <p class="text-neutral-600 text-sm leading-relaxed">Secure access to advanced digital forensics tools and case management systems.</p>
            </div>

            <div class="relative z-10 flex items-center justify-center">
                <img src="/images/login.png" alt="Login Illustration" class="w-full max-w-sm h-auto">
            </div>

            <div class="relative z-10 text-neutral-400 text-xs">
                © 2025 Digital Forensics Center UMP. All rights reserved.
            </div>
        </div>

        <!-- Right: Dark Form Side -->
        <div class="w-full md:w-1/2 p-8 py-12 md:p-12 lg:p-16 flex items-center justify-center bg-gradient-to-br from-neutral-100 to-neutral-200">
            <div class="w-full max-w-sm">
                {{ $slot }}
            </div>
        </div>

    </div>

</body>
</html>