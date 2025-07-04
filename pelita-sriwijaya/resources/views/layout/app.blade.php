<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelita Sriwijaya</title>
    <link rel="icon" href="assets/image/logo.png" type="image/png" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Header -->
    <header class="bg-white shadow-md" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo & Title -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('assets/image/logo.png') }}" alt="Pelita Sriwijaya Logo" class="h-12 w-auto">
                <h1 class="text-2xl md:text-3xl font-bold text-blue-800">Pelita Sriwijaya</h1>
            </div>

            <!-- Desktop Navbar -->
            <nav class="hidden md:block">
                <ul class="flex space-x-6 text-lg font-medium">
                    <li><a href="/" class="text-gray-700 hover:text-blue-600 transition duration-200">Home</a>
                    </li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-600 transition duration-200">About</a>
                    </li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-600 transition duration-200">Services</a>
                    </li>
                    <li><a href="/contact" class="text-gray-700 hover:text-blue-600 transition duration-200">Contact</a>
                    </li>
                </ul>
            </nav>

            <!-- Hamburger Icon (Mobile) -->
            <div class="md:hidden">
                <button class="text-gray-700 focus:outline-none" @click="open = !open" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden px-4 pb-4" x-show="open" x-transition>
            <ul class="flex flex-col space-y-2 text-base font-medium">
                <li><a href="/" class="text-gray-700 hover:text-blue-600">Home</a></li>
                <li><a href="#" class="text-gray-700 hover:text-blue-600">About</a></li>
                <li><a href="#" class="text-gray-700 hover:text-blue-600">Services</a></li>
                <li><a href="/contact" class="text-gray-700 hover:text-blue-600">Contact</a></li>
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('main-content')
    </main>
    {{-- footer --}}
    <footer class="bg-white mt-8 items-center text-center py-4">
        &copy; 2025 Pelita Sriwijaya. All rights reserved.
    </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</html>
