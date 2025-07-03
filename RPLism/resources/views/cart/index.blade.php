<head>
    <title>Shopping Cart - MIINACCI</title>
    <style>
        .cart-item-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .quantity-btn {
            @apply w-8 h-8 flex items-center justify-center border border-gray-300 text-gray-600 hover:bg-gray-100 transition-colors;
        }
        .quantity-input {
            @apply w-16 text-center border-t border-b border-gray-300 py-1;
        }
        .item-row {
            transition: all 0.2s ease;
        }
        /* .item-row.selected {
            background-color: rgba(127, 29, 29, 0.05);
        } */
        /* .item-checkbox:checked + .item-content {
            opacity: 1;
        }
        .item-checkbox:not(:checked) + .item-content {
            opacity: 1;
        } */
    </style>
</head>

<x-layout>
    <div class="container mx-auto px-4 lg:px-20 py-8">
        <!-- Page Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-logo font-bold text-gray-800 mb-2">Shopping Cart</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg cart-item-card p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-logo font-semibold text-gray-800">Cart Items</h2>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="checkbox" id="selectAll" class="mr-2 text-red-800 focus:ring-red-800" onchange="toggleSelectAll()">
                                <span class="text-sm text-gray-700">Select All</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Cart Item 1 -->
                    <div class="item-row selected flex items-center space-x-4 py-6 border-b border-gray-200">
                        <input type="checkbox" class="item-checkbox text-red-800 focus:ring-red-800" data-item-id="1" onchange="updateCheckboxes()" checked>
                        <div class="item-content flex items-center space-x-4 flex-1">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=120&h=120&fit=crop" alt="Premium Headphones" class="w-24 h-24 object-cover rounded-lg">
                            
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800">Premium Headphones</h3>
                                <p class="text-gray-600 text-sm">Wireless noise-cancelling headphones</p>
                                <p class="text-red-800 font-semibold text-lg">Rp 1,500,000</p>
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <button class="quantity-btn rounded-l-md" onclick="decreaseQuantity(1)">-</button>
                                <input type="number" id="qty-1" value="1" min="1" class="quantity-input" readonly>
                                <button class="quantity-btn rounded-r-md" onclick="increaseQuantity(1)">+</button>
                            </div>
                            
                            <button class="text-red-500 hover:text-red-700 transition-colors" onclick="removeItem(1)">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Cart Item 2 -->
                    <div class="item-row selected flex items-center space-x-4 py-6 border-b border-gray-200">
                        <input type="checkbox" class="item-checkbox text-red-800 focus:ring-red-800" data-item-id="2" onchange="updateCheckboxes()" checked>
                        <div class="item-content flex items-center space-x-4 flex-1">
                            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=120&h=120&fit=crop" alt="Smart Watch" class="w-24 h-24 object-cover rounded-lg">
                            
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-800">Smart Watch</h3>
                                <p class="text-gray-600 text-sm">Health and fitness tracking watch</p>
                                <p class="text-red-800 font-semibold text-lg">Rp 1,500,000</p>
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <button class="quantity-btn rounded-l-md" onclick="decreaseQuantity(2)">-</button>
                                <input type="number" id="qty-2" value="2" min="1" class="quantity-input" readonly>
                                <button class="quantity-btn rounded-r-md" onclick="increaseQuantity(2)">+</button>
                            </div>
                            
                            <button class="text-red-500 hover:text-red-700 transition-colors" onclick="removeItem(2)">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Continue Shopping -->
                    <div class="pt-6">
                        <a href="{{ route('shop') }}" class="inline-flex items-center text-red-800 hover:text-red-900 font-semibold transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg cart-item-card p-6 sticky top-4">
                    <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-6">Order Summary</h2>
                    
                    <!-- Summary Details -->
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-700">
                            <span id="itemCount">Subtotal (3 items)</span>
                            <span id="subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Shipping</span>
                            <span class="text-green-600 font-semibold">Free</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex justify-between text-xl font-bold text-gray-800">
                            <span>Total</span>
                            <span id="total">Rp 0</span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <button id="checkoutBtn" onclick="proceedToCheckout()" class="block w-full bg-red-800 text-white text-center py-4 rounded-lg font-semibold text-lg hover:bg-red-900 transition-colors mb-4 disabled:bg-gray-400 disabled:cursor-not-allowed">
                        Checkout
                    </button>
                </div>
            </div>
        </div>

        <!-- Empty Cart State (hidden by default) -->
        <div id="emptyCart" class="hidden text-center py-16">
            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-4">Your cart is empty</h2>
            <a href="{{ route('shop') }}" class="inline-block bg-red-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-900 transition-colors">
                Start Shopping
            </a>
        </div>
    </div>

    <script>
        let cartItems = [
            { id: 1, name: 'Premium Headphones', price: 1500000, quantity: 1, selected: true },
            { id: 2, name: 'Smart Watch', price: 1500000, quantity: 2, selected: true }
        ];

        function updateCartSummary() {
            let subtotal = 0;
            let totalItems = 0;
            let selectedItems = 0;
            
            cartItems.forEach(item => {
                if (item.selected) {
                    subtotal += item.price * item.quantity;
                    selectedItems += item.quantity;
                }
                totalItems += item.quantity;
            });
        
            const total = subtotal;
            
            document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');
            
            // Update items count
            document.getElementById('itemCount').textContent = `Subtotal`;
            
            // Update checkout button state
            const checkoutBtn = document.getElementById('checkoutBtn');
            if (selectedItems > 0) {
                checkoutBtn.disabled = false;
                checkoutBtn.textContent = `Checkout (${selectedItems})`;
            } else {
                checkoutBtn.disabled = true;
                checkoutBtn.textContent = 'Select items to checkout';
            }
        }

        function toggleSelectAll() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
                const itemId = parseInt(checkbox.dataset.itemId);
                const item = cartItems.find(item => item.id === itemId);
                const itemRow = checkbox.closest('.item-row');
                
                if (item) {
                    item.selected = selectAllCheckbox.checked;
                }
                
                // Update visual styling
                if (selectAllCheckbox.checked) {
                    itemRow.classList.add('selected');
                } else {
                    itemRow.classList.remove('selected');
                }
            });
            
            updateCartSummary();
        }

        function updateCheckboxes() {
            const itemCheckboxes = document.querySelectorAll('.item-checkbox');
            const selectAllCheckbox = document.getElementById('selectAll');
            
            // Update cart items selection state and visual styling
            itemCheckboxes.forEach(checkbox => {
                const itemId = parseInt(checkbox.dataset.itemId);
                const item = cartItems.find(item => item.id === itemId);
                // const itemRow = checkbox.closest('.item-row');
                
                if (item) {
                    item.selected = checkbox.checked;
                }
                
                // // Update visual styling
                // if (checkbox.checked) {
                //     itemRow.classList.add('selected');
                // } else {
                //     itemRow.classList.remove('selected');
                // }
            });
            
            // Update select all checkbox state
            const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
            if (checkedBoxes.length === 0) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = false;
            } else if (checkedBoxes.length === itemCheckboxes.length) {
                selectAllCheckbox.indeterminate = false;
                selectAllCheckbox.checked = true;
            } else {
                selectAllCheckbox.indeterminate = true;
            }
            
            updateCartSummary();
        }

        function proceedToCheckout() {
            const selectedItems = cartItems.filter(item => item.selected);
            
            if (selectedItems.length === 0) {
                alert('Please select at least one item to checkout.');
                return;
            }
            
            // Store selected items in localStorage for checkout page
            localStorage.setItem('selectedCartItems', JSON.stringify(selectedItems));
            
            // Redirect to checkout
            window.location.href = '{{ route("checkout") }}';
        }

        function increaseQuantity(itemId) {
            const qtyInput = document.getElementById(`qty-${itemId}`);
            const item = cartItems.find(item => item.id === itemId);
            
            if (item) {
                item.quantity++;
                qtyInput.value = item.quantity;
                updateCartSummary();
            }
        }

        function decreaseQuantity(itemId) {
            const qtyInput = document.getElementById(`qty-${itemId}`);
            const item = cartItems.find(item => item.id === itemId);
            
            if (item && item.quantity > 1) {
                item.quantity--;
                qtyInput.value = item.quantity;
                updateCartSummary();
            }
        }

        function removeItem(itemId) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                cartItems = cartItems.filter(item => item.id !== itemId);
                
                // Remove the item from DOM
                const itemElement = document.getElementById(`qty-${itemId}`).closest('.flex.items-center.space-x-4.py-6');
                itemElement.remove();
                
                updateCheckboxes();
                updateCartSummary();
                
                // Show empty cart if no items left
                if (cartItems.length === 0) {
                    document.querySelector('.grid').style.display = 'none';
                    document.getElementById('emptyCart').classList.remove('hidden');
                }
            }
        }

        // Initialize cart summary on page load
        updateCartSummary();
        updateCheckboxes();
    </script>
</x-layout>
