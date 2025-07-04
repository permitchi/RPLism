<head>
    <title>Shopping Cart - MIINACCI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .cart-item-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .quantity-input {
            @apply w-20 text-center border border-gray-300 rounded py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500;
        }
        .item-row {
            transition: all 0.2s ease;
        }
        .item-row.selected {
            background-color: rgba(255, 193, 7, 0.1);
            border-left: 4px solid #fbbf24;
        }
        .item-checkbox:checked + .item-row {
            background-color: rgba(255, 193, 7, 0.1);
        }
    </style>
</head>

<x-layout>
    <div class="container mx-auto px-4 lg:px-20 py-8">
        <!-- Page Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-logo font-bold text-gray-800 mb-2">Shopping Cart</h1>
        </div>

        @if(!empty($cart) && count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg cart-item-card p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-4">
                                <input type="checkbox" id="selectAll" onclick="toggleSelectAll()" class="w-4 h-4 text-yellow-600 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 focus:ring-2">
                                <h2 class="text-2xl font-logo font-semibold text-gray-800">Cart Items ({{ count($cart) }})</h2>
                            </div>
                            <button onclick="clearCart()" class="text-red-600 hover:text-red-800 text-sm transition duration-300">
                                Clear All
                            </button>
                        </div>
                        
                        <!-- Cart Items List -->
                        <div id="cartItems">
                            @foreach($cart as $productId => $item)
                                <div class="item-row flex items-center space-x-4 py-6 border-b border-gray-200" 
                                     data-product-id="{{ $productId }}" 
                                     data-price="{{ $item['price'] }}" 
                                     data-quantity="{{ $item['quantity'] }}">
                                    <!-- Checkbox -->
                                    <input type="checkbox" class="item-checkbox w-4 h-4 text-yellow-600 bg-gray-100 border-gray-300 rounded focus:ring-yellow-500 focus:ring-2" 
                                           data-product-id="{{ $productId }}" 
                                           onchange="updateCheckboxes()" 
                                           checked>
                                    
                                    <!-- Product Image -->
                                    <div class="w-20 h-16 bg-gradient-to-br from-pink-100 to-pink-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                        @if($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-12 object-contain rounded">
                                        @else
                                            <span class="text-xl">💎</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Product Details -->
                                    <div class="flex-1">
                                        <h3 class="font-body font-semibold text-gray-800">{{ $item['name'] }}</h3>
                                        <p class="text-yellow-600 font-bold">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        <p class="text-sm text-gray-600">Stock: {{ $item['stock'] }} available</p>
                                    </div>
                                    
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center space-x-2">
                                        <input type="number" 
                                               value="{{ $item['quantity'] }}" 
                                               min="1" 
                                               max="{{ $item['stock'] }}"
                                               class="quantity-input w-20 text-center border border-gray-300 rounded py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500" 
                                               onchange="updateQuantity({{ $productId }}, this.value)"
                                               data-product-id="{{ $productId }}">
                                    </div>
                                    
                                    <!-- Item Total -->
                                    <div class="text-right">
                                        <p class="font-bold text-gray-800" id="itemTotal{{ $productId }}">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                                    </div>
                                    
                                    <!-- Remove Button -->
                                    <button onclick="removeFromCart({{ $productId }})" class="text-red-600 hover:text-red-800 p-2 transition duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg cart-item-card p-6">
                        <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-6">Order Summary</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold" id="subtotal">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-semibold">Free</span>
                            </div>
                            <hr class="my-4">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span class="text-yellow-600" id="total">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <button type="button" id="checkoutBtn" class="w-full bg-yellow-600 hover:bg-yellow-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-bold py-3 px-6 rounded-lg text-center block transition duration-300">
                            Checkout
                        </button>
                        
                        <a href="{{ route('shop') }}" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg text-center block mt-3 transition duration-300">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-8">
                        <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5-6m0 0h-.5a1 1 0 00-1 1v1a1 1 0 001 1h1.5M7 13v6a1 1 0 001 1h8a1 1 0 001-1v-6"/>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-logo font-bold text-gray-800 mb-4">Your Cart is Empty</h2>
                    <p class="text-gray-600 font-body mb-8">Add some beautiful jewelry pieces to your cart!</p>
                    <a href="{{ route('shop') }}" 
                       class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-8 rounded-lg font-body font-medium transition duration-300">
                        Start Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>

    <script>
        // Initialize cart state
        let selectedItems = new Set();
        
        // Initialize all items as selected on page load
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const selectAllCheckbox = document.getElementById('selectAll');
            const checkoutBtn = document.getElementById('checkoutBtn');
            
            // Add checkout button event listener
            if (checkoutBtn) {
                checkoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    proceedToCheckout();
                });
            }
            
            // Clear and rebuild selected items
            selectedItems.clear();
            
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedItems.add(checkbox.dataset.productId);
                }
            });
            
            // Set select all checkbox state
            if (selectedItems.size === checkboxes.length && checkboxes.length > 0) {
                selectAllCheckbox.checked = true;
            }
            
            // Initial calculation
            updateOrderSummary();
            
            console.log('Cart initialized with', selectedItems.size, 'selected items');
        });

        // Toggle select all functionality
        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            
            selectedItems.clear();
            
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
                if (selectAllCheckbox.checked) {
                    selectedItems.add(checkbox.dataset.productId);
                }
            });
            
            updateOrderSummary();
        }

        // Update checkboxes and summary
        function updateCheckboxes() {
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            const selectAllCheckbox = document.getElementById('selectAll');
            
            selectedItems.clear();
            
            // Update selected items set
            itemCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedItems.add(checkbox.dataset.productId);
                }
            });
            
            // Update select all checkbox state
            const checkedCount = selectedItems.size;
            const totalCount = itemCheckboxes.length;
            
            if (checkedCount === 0) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            } else if (checkedCount === totalCount) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = true;
            } else {
                selectAllCheckbox.indeterminate = true;
                selectAllCheckbox.checked = false;
            }
            
            updateOrderSummary();
        }

        // Update order summary based on selected items
        function updateOrderSummary() {
            let subtotal = 0;
            let totalQuantity = 0;
            
            selectedItems.forEach(productId => {
                const row = document.querySelector(`[data-product-id="${productId}"]`);
                if (row) {
                    // Use data attributes for more reliable calculation
                    const price = parseInt(row.getAttribute('data-price')) || 0;
                    const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
                    
                    if (price > 0 && quantity > 0) {
                        subtotal += price * quantity;
                        totalQuantity += quantity;
                    }
                }
            });
            
            // Update display with proper formatting
            const formattedSubtotal = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('subtotal').textContent = formattedSubtotal;
            document.getElementById('total').textContent = formattedSubtotal;
            
            // Update checkout button
            const checkoutBtn = document.getElementById('checkoutBtn');
            if (selectedItems.size > 0) {
                checkoutBtn.disabled = false;
                checkoutBtn.textContent = `Checkout (${totalQuantity} items)`;
            } else {
                checkoutBtn.disabled = true;
                checkoutBtn.textContent = 'Select items to checkout';
            }
        }

        // Proceed to checkout with selected items
        function proceedToCheckout() {
            console.log('proceedToCheckout called');
            console.log('selectedItems:', selectedItems);
            
            if (selectedItems.size === 0) {
                alert('Please select at least one item to checkout.');
                return;
            }
            
            try {
                // Collect selected item data for checkout
                const selectedItemsData = [];
                selectedItems.forEach(productId => {
                    const row = document.querySelector(`[data-product-id="${productId}"]`);
                    if (row) {
                        const price = parseInt(row.getAttribute('data-price')) || 0;
                        const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
                        const name = row.querySelector('.text-gray-800').textContent;
                        
                        selectedItemsData.push({
                            id: productId,
                            name: name,
                            price: price,
                            quantity: quantity
                        });
                    }
                });
                
                console.log('selectedItemsData:', selectedItemsData);
                
                // Store selected items in localStorage for checkout page
                localStorage.setItem('selectedCartItems', JSON.stringify(selectedItemsData));
                
                console.log('About to redirect to checkout');
                
                // Use a small delay to ensure localStorage is set
                setTimeout(() => {
                    // Redirect to checkout page using GET
                    window.location.href = '/checkout';
                }, 100);
            } catch (error) {
                console.error('Error in proceedToCheckout:', error);
                alert('An error occurred while proceeding to checkout. Please try again.');
            }
        }

        // Update quantity function
        function updateQuantity(productId, newQuantity) {
            if (newQuantity < 1) return;
            
            // Update the data attribute immediately for local calculation
            const row = document.querySelector(`[data-product-id="${productId}"]`);
            if (row) {
                row.setAttribute('data-quantity', newQuantity);
                row.querySelector('.quantity-input').value = newQuantity;
                
                // Update the item total display
                const price = parseInt(row.getAttribute('data-price')) || 0;
                const total = price * newQuantity;
                const itemTotalElement = document.getElementById(`itemTotal${productId}`);
                if (itemTotalElement) {
                    itemTotalElement.textContent = 'Rp ' + total.toLocaleString('id-ID');
                }
                
                // Update order summary
                updateOrderSummary();
            }
            
            fetch('/cart/update', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: parseInt(newQuantity)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert(data.message || 'Error updating quantity');
                    // Reload on error to reset state
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating quantity');
                location.reload();
            });
        }

        // Remove from cart function
        function removeFromCart(productId) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                fetch('/cart/remove', {
                    method: 'DELETE',
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
                        location.reload(); // Reload to update the display
                    } else {
                        alert('Error removing item from cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error removing item from cart');
                });
            }
        }

        // Clear entire cart
        function clearCart() {
            if (confirm('Are you sure you want to clear your entire cart?')) {
                fetch('/cart/clear', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload to update the display
                    } else {
                        alert('Error clearing cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error clearing cart');
                });
            }
        }
    </script>
</x-layout>
