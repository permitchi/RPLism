<x-layout>
    <div class="container mx-auto py-12">
        <!-- Back Button -->
        <div class="mb-6">
            @php
                $adminPages = [
                    route('addproduct', [], false),
                    route('products.myproducts', [], false),
                    route('editproduct', ['id' => $product->id], false)
                ];
                $previous = url()->previous();
                $current = url()->current();
                $backUrl = route('shop');
                if ($previous !== $current && !Str::contains($previous, $adminPages)) {
                    $backUrl = $previous;
                }
            @endphp
            <a href="{{ $backUrl }}" class="inline-flex items-center px-4 py-2 text-red-500 rounded-full font-body font-medium transition mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Shop
            </a>
        </div>
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-1/2 flex items-center justify-center p-8">
                <div class="w-full aspect-square max-w-[32rem]">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-2xl shadow-lg" />
                    @else
                        <div class="w-full h-full bg-pink-300 rounded-2xl flex items-center justify-center">
                            <span class="text-6xl">💎</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="md:w-1/2 p-8 flex flex-col justify-center">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-3xl font-bold">{{ $product->name }}</h2>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('editproduct', ['id' => $product->id]) }}" class="ml-2 text-black hover:text-gray-700" title="Edit Product">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-2.828 0L9 13zm-6 6h6" />
                            </svg>
                        </a>
                    @endif
                </div>
                <div class="mb-4 flex items-center gap-2">
                    @if($product->is_featured)
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                            Featured Product
                        </span>
                    @endif
                </div>
                <p class="text-2xl text-yellow-600 font-bold mb-4">Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                <p class="text-lg text-gray-700 mb-4">{{ $product->description }}</p>
                <div class="mb-4 text-gray-500 text-sm">Added on: {{ $product->created_at->format('Y-m-d') }}</div>
                
                <!-- Stock Information -->
                <div class="mb-4">
                    @if($product->stock > 0)
                        <p class="text-green-600 font-semibold">In Stock: {{ $product->stock }} items available</p>
                    @else
                        <p class="text-red-600 font-semibold">Out of Stock</p>
                    @endif
                </div>

                <!-- Quantity Selector -->
                <div class="mb-6">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity:</label>
                    <div class="flex items-center">
                        <button type="button" id="decreaseBtn" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-3 rounded-l">-</button>
                        <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-16 text-center border-t border-b border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <button type="button" id="increaseBtn" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-3 rounded-r">+</button>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <div class="flex gap-3">
                    <button id="addToCartBtn" 
                            class="flex-1 bg-yellow-500 hover:bg-yellow-600 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-bold py-3 px-8 rounded text-lg transition duration-300"
                            {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <span id="cartBtnText">Add to Cart</span>
                        <svg id="cartBtnLoader" class="hidden animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                    
                    <!-- Add to Wishlist Button -->
                    <button id="addToWishlistBtn" 
                            class="bg-white border-2 border-yellow-500 text-yellow-500 hover:bg-yellow-50 font-bold py-3 px-4 rounded transition duration-300"
                            title="Add to Wishlist">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add CSRF meta tag for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // Quantity controls
        const quantityInput = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');
        const addToCartBtn = document.getElementById('addToCartBtn');
        const addToWishlistBtn = document.getElementById('addToWishlistBtn');
        const maxStock = {{ $product->stock }};

        // Decrease quantity
        decreaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        // Increase quantity
        increaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue < maxStock) {
                quantityInput.value = currentValue + 1;
            }
        });

        // Validate quantity input
        quantityInput.addEventListener('input', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > maxStock) {
                this.value = maxStock;
            }
        });

        // Add to Cart functionality
        addToCartBtn.addEventListener('click', function() {
            const quantity = parseInt(quantityInput.value);
            const productId = {{ $product->id }};
            
            // Show loading state
            const btnText = document.getElementById('cartBtnText');
            const btnLoader = document.getElementById('cartBtnLoader');
            
            btnText.textContent = 'Adding...';
            btnLoader.classList.remove('hidden');
            btnLoader.classList.add('inline');
            this.disabled = true;

            // Send AJAX request
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    showMessage('Product added to cart successfully!', 'success');
                    
                    // Update button state
                    btnText.textContent = 'Added to Cart';
                    btnLoader.classList.add('hidden');
                    btnLoader.classList.remove('inline');
                    
                    // Reset button after 2 seconds
                    setTimeout(() => {
                        btnText.textContent = 'Add to Cart';
                        this.disabled = false;
                    }, 2000);
                } else {
                    throw new Error(data.message || 'Failed to add product to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage(error.message || 'Error adding product to cart', 'error');
                
                // Reset button state
                btnText.textContent = 'Add to Cart';
                btnLoader.classList.add('hidden');
                btnLoader.classList.remove('inline');
                this.disabled = false;
            });
        });

        // Add to Wishlist functionality
        addToWishlistBtn.addEventListener('click', function() {
            const productId = {{ $product->id }};
            
            // Send AJAX request
            fetch('/wishlist/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage('Product added to wishlist!', 'success');
                    
                    // Change button appearance to indicate it's added
                    this.classList.add('bg-yellow-500', 'text-white');
                    this.classList.remove('bg-white', 'text-yellow-500');
                    this.innerHTML = '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>';
                } else {
                    throw new Error(data.message || 'Failed to add product to wishlist');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage(error.message || 'Error adding product to wishlist', 'error');
            });
        });

        // Show message function
        function showMessage(message, type = 'success') {
            // Create message container if it doesn't exist
            let messageContainer = document.getElementById('messageContainer');
            if (!messageContainer) {
                messageContainer = document.createElement('div');
                messageContainer.id = 'messageContainer';
                messageContainer.className = 'fixed top-4 right-4 z-50 space-y-2';
                document.body.appendChild(messageContainer);
            }
            
            const messageDiv = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            messageDiv.className = `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full`;
            messageDiv.textContent = message;
            
            messageContainer.appendChild(messageDiv);
            
            // Animate in
            setTimeout(() => {
                messageDiv.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                messageDiv.classList.add('translate-x-full');
                setTimeout(() => {
                    if (messageContainer.contains(messageDiv)) {
                        messageContainer.removeChild(messageDiv);
                    }
                }, 300);
            }, 3000);
        }
    </script>
</x-layout>
