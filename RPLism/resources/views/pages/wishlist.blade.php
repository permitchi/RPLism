<head>
    <title>Wishlist - MIINACCI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .wishlist-card {
            height: 500px; /* Fixed height for all cards */
            display: flex;
            flex-direction: column;
        }
        .wishlist-card .card-image {
            height: 250px; /* Fixed height for image section */
        }
        .wishlist-card .card-content {
            height: 250px; /* Fixed height for content section */
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<x-layout>
    <div class="container mx-auto px-4 md:px-20 py-12">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="text-2xl md:text-4xl font-logo font-bold text-yellow-600 mb-4">My Wishlist</h1>
            <p class="text-gray-600 font-body text-lg">Your favorite jewelry pieces, saved for later</p>
        </div>

        @auth
            @if(isset($wishlists) && $wishlists->count() > 0)
                <!-- Wishlist Items Count -->
                <div class="flex justify-between items-center mb-8">
                    <div class="font-body text-gray-700">
                        <span class="text-xl font-semibold">{{ $wishlists->count() }}</span> 
                        <span class="text-gray-600">{{ $wishlists->count() === 1 ? 'item' : 'items' }} in your wishlist</span>
                    </div>
                    <button onclick="clearWishlist()" class="text-red-600 hover:text-red-800 font-body text-sm transition duration-300">
                        Clear All
                    </button>
                </div>

                <!-- Wishlist Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($wishlists as $wishlist)
                        @php $item = $wishlist->product; @endphp
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300 relative group wishlist-card">
                            <!-- Remove from Wishlist Button -->
                            <button onclick="removeFromWishlist({{ $item->id }})" 
                                    class="absolute top-4 right-4 z-10 bg-white rounded-full p-2 shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 hover:bg-red-50">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>

                            <!-- Product Image -->
                            <div class="card-image bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" 
                                         alt="{{ $item->name }}" 
                                         class="w-full h-full object-cover" />
                                @else
                                    <div class="w-full h-full bg-pink-300 flex items-center justify-center">
                                        <span class="text-6xl">💎</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="card-content p-6">
                                <h3 class="font-body font-semibold text-gray-800 mb-2 text-lg line-clamp-2 flex-shrink-0">{{ $item->name }}</h3>
                                <div class="flex justify-between items-center mb-2 flex-shrink-0">
                                    <p class="font-body text-yellow-600 font-bold text-xl">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                @if($item->description)
                                    <p class="font-body text-gray-600 text-sm mb-3 line-clamp-3 flex-grow">{{ $item->description }}</p>
                                @else
                                    <div class="flex-grow"></div>
                                @endif
                                <div class="flex-shrink-0">
                                    @if($item->stock > 0)
                                        <span class="text-green-600 text-sm font-body">In Stock</span>
                                    @else
                                        <span class="text-red-600 text-sm font-body">Out of Stock</span>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-2 mt-4 flex-shrink-0">
                                    <a href="{{ route('products.show', $item->id) }}" 
                                       class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-4 rounded-lg transition duration-300 text-center">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            @else
                <!-- Empty Wishlist State -->
                <div class="text-center py-8">
                    <div class="max-w-md mx-auto">
                        <div class="mb-8">
                            <div class="w-32 h-32 bg-gradient-to-br from-pink-100 to-pink-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-2xl font-logo font-bold text-gray-800 mb-4">Your Wishlist is Empty</h2>
                        <p class="text-gray-600 font-body mb-8">Start adding your favorite items to your wishlist!</p>
                        <a href="{{ route('shop') }}" 
                           class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-8 rounded-lg font-body font-medium transition duration-300">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            @endif

        @else
            <!-- Not Logged In State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-8">
                        <div class="w-32 h-32 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-16 h-16 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-logo font-bold text-gray-800 mb-4">Login to View Your Wishlist</h2>
                    <p class="text-gray-600 font-body mb-8">Please log in to save and view your favorite jewelry pieces.</p>
                    <div class="flex gap-4 justify-center">
                        <a href="{{ route('login') }}" 
                           class="bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-8 rounded-lg font-body font-medium transition duration-300">
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 px-8 rounded-lg font-body font-medium transition duration-300">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        @endauth

        <!-- Recommended Products Section -->
        @if(isset($recommendedProducts) && $recommendedProducts->count() > 0)
            <div class="mt-16 border-t pt-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-logo font-bold text-gray-800 mb-4">You Might Also Like</h2>
                    <p class="text-gray-600 font-body">Discover more beautiful jewelry pieces</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($recommendedProducts as $product)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                            <div class="aspect-square bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover" />
                                @else
                                    <div class="w-full h-full bg-pink-300 flex items-center justify-center">
                                        <span class="text-6xl">💎</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4 h-32 flex flex-col">
                                <h3 class="font-body font-semibold text-gray-800 mb-2 line-clamp-2 flex-grow">{{ $product->name }}</h3>
                                <p class="font-body text-yellow-600 font-bold flex-shrink-0">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <button onclick="addToWishlist({{ $product->id }})" 
                                        class="mt-3 w-full bg-gray-100 hover:bg-yellow-100 text-gray-700 py-2 rounded-lg font-body text-sm transition duration-300 flex-shrink-0">
                                    Add to Wishlist
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- JavaScript for Wishlist Actions -->
    <script>
        function removeFromWishlist(productId) {
            if (confirm('Are you sure you want to remove this item from your wishlist?')) {
                // Send AJAX request to remove item
                fetch(`/wishlist/remove/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload page to update the wishlist
                    } else {
                        alert('Error removing item from wishlist');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error removing item from wishlist');
                });
            }
        }

        function addToCart(productId) {
            // Send AJAX request to add item to cart
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Item added to cart successfully!');
                } else {
                    alert('Error adding item to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error adding item to cart');
            });
        }

        function addToWishlist(productId) {
            // Send AJAX request to add item to wishlist
            fetch('/wishlist/add', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Item added to wishlist successfully!');
                } else {
                    alert('Error adding item to wishlist');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error adding item to wishlist');
            });
        }

        function clearWishlist() {
            if (confirm('Are you sure you want to clear your entire wishlist?')) {
                // Send AJAX request to clear wishlist
                fetch('/wishlist/clear', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload page to update the wishlist
                    } else {
                        alert('Error clearing wishlist');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error clearing wishlist');
                });
            }
        }
    </script>
</x-layout>