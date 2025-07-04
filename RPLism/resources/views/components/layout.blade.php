<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:300,400,500,600,600i,700,700i|montserrat:200,300,400,500,600,700,800" rel="stylesheet" />
    <script>
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const profileButton = document.getElementById('profileButton');
            
            if (!profileButton.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    <style>
        .font-logo {
            font-family: 'Cormorant Garamond', serif;
        }
        .font-body {
            font-family: 'Montserrat', sans-serif;
        }
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .bg-color {
            background-color: #7F1D1D;
        }
        .bg-body {
            background-color: #FAF5E5
        }

    </style>
</head>
<body class="min-h-screen bg-body">
    <!-- Header -->
    <header class="bg-color shadow-lg">
        <div class="flex justify-between items-center px-20 py-6">
            <nav class="hidden md:flex space-x-8 flex-1">
                <a href="{{ route('homepage') }}" class="text-white font-body hover:text-yellow-400 transition">Home</a>
                <a href="{{ route('shop') }}" class="text-white font-body hover:text-yellow-400 transition">Shop</a>
                <a href="{{ route('about') }}" class="text-white font-body hover:text-yellow-400 transition">About Us</a>
                <a href="{{ route('contact') }}" class="text-white font-body hover:text-yellow-400 transition">Contact Us</a>
            </nav>
            <div class="flex items-center justify-center flex-1">
                <div class="w-20 h-15">
                    <img src="{{ asset('img/logo-miinacci.png') }}" alt="MINACCI Logo" class="w-full h-full object-contain">
                </div>
            </div>
            <div class="flex items-center gap-4 justify-end flex-1">
            <!-- Add Product Icon Button (admin only) -->
                @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="relative">
                    <a href="{{ route('addproduct') }}" class="text-white hover:text-yellow-400 transition" title="Add Product">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </a>
                </div>
                @endif
                <!-- Shopping Cart -->
                <div class="relative">
                    <a href="{{ route('cart') }}" class="text-white hover:text-yellow-400 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </a>
                </div>
                <!-- Profile Dropdown -->
                <div class="relative">
                    <button id="profileButton" onclick="toggleProfileDropdown()" class="text-white hover:text-yellow-400 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50 ">
                        <div class="py-2">
                            @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('adminorders') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-yellow-100 hover:text-red-900 font-body hover:font-medium">
                                <svg class="w-5 h-5 mr-3 text-gray-500  hover:text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Orders
                            </a>
                            @else
                            <a href="{{ route('orderhistory') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-yellow-100 hover:text-red-900 font-body hover:font-medium">
                                <svg class="w-5 h-5 mr-3 text-gray-500  hover:text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Order History
                            </a>
                            @endif
                            <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-yellow-100 hover:text-red-900 font-body hover:font-medium">
                                <svg class="w-5 h-5 mr-3 text-gray-500  hover:text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                Wishlist
                            </a>
                            <a href="{{ route('profile') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-yellow-100 hover:text-red-900 font-body hover:font-medium">
                                <svg class="w-5 h-5 mr-3 text-gray-500  hover:text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('products.myproducts') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-yellow-100 hover:text-yellow-700 font-body hover:font-bold">
                                <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                My Products
                            </a>
                            @endif
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-3 text-gray-700 hover:bg-yellow-100 hover:text-red-900 font-body hover:font-medium">
                                    <svg class="w-5 h-5 mr-3 text-gray-500  hover:text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Log-out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area - Di sinilah $slot akan dimasukkan -->
    <main class="container mx-auto">
        {{ $slot }}
    </main>

    <footer class="bg-black text-white py-16">
        <div class="container mx-auto px-8">
            <div class="flex flex-col md:flex-row justify-between items-start">
                <div class="mb-8 md:mb-0">
                    <h3 class="font-logo text-2xl font-bold mb-4">Contact Detail</h3>
                    <div class="space-y-2 font-body">
                        <p class="flex items-center"><span class="mr-2">📞</span> +62 87654321</p>
                        <p class="flex items-center"><span class="mr-2">✉️</span> miinacci@gmail.com</p>
                        <p class="flex items-center"><span class="mr-2">📍</span> 123 Fifth Avenue, New York, NY 10160</p>
                    </div>
                </div>
                <div class="w-32 h-20">
                    <img src="{{ asset('img/logo2.png') }}" alt="MINACCI Logo" class="w-full h-full object-contain opacity-80">
                </div>
            </div>
            <div class="border-t border-gray-700 mt-12 pt-8 text-center font-body text-sm text-gray-400">
                <p>Copyright © 2025 Minacci Accessories | Powered by Laravel</p>
            </div>
        </div>
    </footer>
</body>
</html>