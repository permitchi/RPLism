<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - MINACCI</title>
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
        /* Font untuk logo dan heading */
        .font-logo {
            font-family: 'Cormorant Garamond', serif;
        }
        .font-body {
            font-family: 'Montserrat', sans-serif;
        }
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .hero-bg {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1469334031218-e382a71b716b?ixlib=rb-4.0.3') center/cover;
            min-height: 100vh;
        }
        .search-input {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Hero Section -->
    <div class="hero-bg relative">
        <!-- Header -->
        <header class="flex justify-between items-center px-20 py-6">
            <div class="flex items-center flex-1">
                <div class="w-20 h-15">
                    <img src="{{ asset('img/logo2.png') }}" alt="MINACCI Logo" class="w-full h-full object-contain">
                </div>
            </div>
            <nav class="hidden md:flex space-x-8 flex-1 justify-center">
                <a href="{{ route('homepage') }}" class="text-white font-body hover:text-yellow-400 transition">Home</a>
                <a href="{{ route('shop') }}" class="text-white font-body hover:text-yellow-400 transition">Shop</a>
                <a href="{{ route('about') }}" class="text-white font-body hover:text-yellow-400 transition">About Us</a>
                <a href="{{ route('contact') }}" class="text-white font-body hover:text-yellow-400 transition">Contact Us</a>
            </nav>
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
                    <button>
                        <a href="{{ route('cart') }}" class="text-white hover:text-yellow-400 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </a>
                    </button>
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
                            <a href="{{ route('orderhistory') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-yellow-100 hover:text-red-900 font-body hover:font-medium">
                                <svg class="w-5 h-5 mr-3 text-gray-500  hover:text-red-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Order History
                            </a>
                            <a href="{{ route('wishlist') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-yellow-100 hover:text-red-900 font-body hover:font-medium">
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
        </header>

        <!-- Hero Content -->
        <div class="flex items-center justify-center min-h-screen px-8 relative z-10">
            <div class="text-center max-w-4xl">
                <h1 class="font-logo text-6xl md:text-7xl font-bold text-white mb-6 leading-tight italic">
                    Every detail tells a story, <br> a glory story
                </h1>
                <p class="font-body text-sm text-white opacity-90 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Uncover the perfect accessory that doesn't just complement your look, but tells your unique story. Each
                    exquisite piece is carefully curated to add a touch of elegance and individuality to your everyday,
                    transforming simple moments into memorable statements. Don't just follow trends; create your own
                    narrative, starting today.
                </p>
                
                <!-- Search Bar -->
                <form action="{{ route('products.search') }}" method="GET" class="flex max-w-md mx-auto">
                    <input type="text" name="q" placeholder="Search An Item" class="search-input flex-1 px-6 py-4 rounded-l-full font-body text-gray-700 border-none focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 px-8 py-4 rounded-r-full transition duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-8">
            <div class="text-center mb-16">
                <h2 class="font-logo text-5xl font-bold text-yellow-600 mb-4">Featured Products</h2>
                <p class="font-body text-gray-600 max-w-2xl mx-auto">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tristique nunc et molestie faucibus. Nunc auctor consectetur elit, quis pulvinar.
                </p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
                @forelse($products as $product)
                    <a href="{{ route('products.show', $product->id) }}" class="block bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                        <div class="aspect-square bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg" />
                            @else
                                <div class="w-full h-full bg-pink-300 rounded-lg flex items-center justify-center">
                                    <span class="text-2xl">💎</span>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-body font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="font-body text-yellow-600 font-bold">Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-4 text-center text-gray-500">No products found.</div>
                @endforelse
            </div>
        </div>
    </section>

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
