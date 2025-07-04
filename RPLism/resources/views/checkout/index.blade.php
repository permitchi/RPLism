<head>
    <title>Checkout - MIINACCI</title>
    <style>
        .checkout-step {
            @apply flex items-center text-sm;
        }
        .checkout-step.active {
            @apply text-red-800 font-semibold;
        }
        .checkout-step.completed {
            @apply text-green-600;
        }
        .form-input {
            @apply w-full px-4 py-3 border-2 border-gray-400 rounded-lg focus:ring-2 focus:ring-red-800 focus:border-red-800 transition-all;
        }
        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-2;
        }
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .payment-qr-section {
            @apply mt-4 transition-all duration-300;
        }
        .payment-qr-section.hidden {
            @apply hidden;
        }
    </style>
</head>

<x-layout>
    <div class="container mx-auto px-4 lg:px-20 py-8">
        <!-- Page Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-logo font-bold text-gray-800 mb-2">Checkout</h1>
            <p class="text-gray-600 font-body">Complete your purchase</p>
        </div>



        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Checkout Form -->
            <div class="lg:col-span-2">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <strong>Please correct the following errors:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="checkoutForm" method="POST" action="{{ route('checkout.process') }}">
                    @csrf
                    <input type="hidden" name="order_total" id="orderTotalInput" value="0">
                    
                    <!-- Shipping Information -->
                    <div class="bg-white rounded-lg card-shadow p-6 mb-6">
                        <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-6">Shipping Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="form-label">First Name *</label>
                                <input type="text" name="first_name" class="form-input border-2 border-black" style="box-sizing:border-box;" value="{{ old('first_name', $user->first_name ?? '') }}" required>
                            </div>
                            <div>
                                <label class="form-label">Last Name *</label>
                                <input type="text" name="last_name" class="form-input border-2 border-black" style="box-sizing:border-box;" value="{{ old('last_name', $user->last_name ?? '') }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-input border-2 border-black" style="box-sizing:border-box;" value="{{ old('email', $user->email ?? '') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" class="form-input border-2 border-black" style="box-sizing:border-box;" value="{{ old('phone', $user->phone_num ?? '') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Street Address *</label>
                            <input type="text" name="address" class="form-input border-2 border-black" style="box-sizing:border-box;" placeholder="Street address, apartment, suite, etc." value="{{ old('address', $user->street_address ?? '') }}" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="form-label">City *</label>
                                <input type="text" name="city" class="form-input border-2 border-black" style="box-sizing:border-box;" value="{{ old('city', $user->city ?? '') }}" required>
                            </div>
                            <div>
                                <label class="form-label">State/Province *</label>
                                <select name="state" class="form-input border-2 border-black" style="box-sizing:border-box;" required>
                                    <option value="">Select State</option>
                                    <option value="DKI Jakarta" {{ old('state', $user->state ?? '') == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                                    <option value="Jawa Barat" {{ old('state', $user->state ?? '') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                                    <option value="Jawa Tengah" {{ old('state', $user->state ?? '') == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                                    <option value="Jawa Timur" {{ old('state', $user->state ?? '') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                                    <option value="Banten" {{ old('state', $user->state ?? '') == 'Banten' ? 'selected' : '' }}>Banten</option>
                                    <option value="Yogyakarta" {{ old('state', $user->state ?? '') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                                    <!-- Add more states as needed -->
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Postal Code *</label>
                                <input type="text" name="postal_code" class="form-input border-2 border-black" style="box-sizing:border-box;" value="{{ old('postal_code', $user->postal_code ?? '') }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Country *</label>
                            <select name="country" class="form-input border-2 border-black" style="box-sizing:border-box;" required>
                                <option value="Indonesia" {{ old('country', $user->country ?? 'Indonesia') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="Malaysia" {{ old('country', $user->country ?? '') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                <option value="Singapore" {{ old('country', $user->country ?? '') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                <!-- Add more countries as needed -->
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="save_info" class="mr-2 text-red-800 focus:ring-red-800">
                                <span class="text-sm text-gray-700">Save this information for next time</span>
                            </label>
                        </div>
                    </div>

                    <!-- Shipping Method -->
                    <div class="bg-white rounded-lg card-shadow p-6 mb-6">
                        <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-6">Shipping Method</h2>
                        
                        <div class="space-y-4">
                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="shipping_method" value="standard" class="mr-3 text-red-800 focus:ring-red-800" checked>
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800">Standard Shipping</div>
                                    <div class="text-sm text-gray-600">5-7 business days</div>
                                </div>
                                <div class="text-lg font-semibold text-gray-800">Free</div>
                            </label>

                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="shipping_method" value="express" class="mr-3 text-red-800 focus:ring-red-800">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800">Express Shipping</div>
                                    <div class="text-sm text-gray-600">2-3 business days</div>
                                </div>
                                <div class="text-lg font-semibold text-gray-800">Rp 50,000</div>
                            </label>

                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="shipping_method" value="overnight" class="mr-3 text-red-800 focus:ring-red-800">
                                <div class="flex-1">
                                    <div class="font-semibold text-gray-800">Overnight Shipping</div>
                                    <div class="text-sm text-gray-600">Next business day</div>
                                </div>
                                <div class="text-lg font-semibold text-gray-800">Rp 100,000</div>
                            </label>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="bg-white rounded-lg card-shadow p-6 mb-6">
                        <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-6">Payment Information</h2>
                        
                        <div class="space-y-4 mb-6">
                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="bank_transfer" class="mr-3 text-red-800 focus:ring-red-800" checked>
                                <div class="flex items-center">
                                    <svg class="w-8 h-6 mr-3" viewBox="0 0 32 24" fill="none">
                                        <rect width="32" height="24" rx="3" fill="#00AA45"/>
                                        <text x="16" y="15" text-anchor="middle" fill="white" font-size="8" font-weight="bold">BANK</text>
                                    </svg>
                                    <span class="font-semibold text-gray-800">Bank Transfer</span>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="e_wallet" class="mr-3 text-red-800 focus:ring-red-800">
                                <div class="flex items-center">
                                    <svg class="w-8 h-6 mr-3" viewBox="0 0 32 24" fill="none">
                                        <rect width="32" height="24" rx="3" fill="#FF6B35"/>
                                        <circle cx="16" cy="12" r="6" fill="white"/>
                                        <text x="16" y="15" text-anchor="middle" fill="#FF6B35" font-size="6" font-weight="bold">e</text>
                                    </svg>
                                    <span class="font-semibold text-gray-800">E-Wallet (GoPay, OVO, Dana)</span>
                                </div>
                            </label>
                        </div>

                        <!-- Bank Transfer QR Code -->
                        <div id="bankTransferQR" class="payment-qr-section">
                            <div class="bg-gray-50 rounded-lg p-6 text-center">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Bank Transfer - BCA</h3>
                                <div class="bg-white p-4 rounded-lg inline-block shadow-sm">
                                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDE1MCAxNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxNTAiIGhlaWdodD0iMTUwIiBmaWxsPSIjRkZGRkZGIi8+CjxyZWN0IHg9IjEwIiB5PSIxMCIgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjMDAwMDAwIi8+CjxyZWN0IHg9IjMwIiB5PSIxMCIgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjMDAwMDAwIi8+CjxyZWN0IHg9IjUwIiB5PSIxMCIgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjMDAwMDAwIi8+CjxyZWN0IHg9IjcwIiB5PSIxMCIgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjMDAwMDAwIi8+CjxyZWN0IHg9IjkwIiB5PSIxMCIgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjMDAwMDAwIi8+CjxyZWN0IHg9IjExMCIgeT0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iIzAwMDAwMCIvPgo8cmVjdCB4PSIxMzAiIHk9IjEwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiMwMDAwMDAiLz4KPHJlY3QgeD0iMTAiIHk9IjMwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiMwMDAwMDAiLz4KPHJlY3QgeD0iNzAiIHk9IjMwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiMwMDAwMDAiLz4KPHJlY3QgeD0iMTMwIiB5PSIzMCIgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjMDAwMDAwIi8+Cjx0ZXh0IHg9Ijc1IiB5PSI4MCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZm9udC1zaXplPSIxMiIgZmlsbD0iIzAwMDAwMCI+QkNBPC90ZXh0Pgo8dGV4dCB4PSI3NSIgeT0iOTUiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGZvbnQtc2l6ZT0iMTAiIGZpbGw9IiMwMDAwMDAiPjEyMzQ1Njc4OTA8L3RleHQ+CjwvdGV2Zz4=" 
                                         alt="BCA QR Code" class="w-32 h-32 mx-auto">
                                </div>
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">Bank Central Asia (BCA)</p>
                                    <p class="text-lg font-mono font-bold text-gray-800">1234567890</p>
                                    <p class="text-sm text-gray-600">a.n. MIINACCI STORE</p>
                                </div>
                            </div>
                        </div>

                        <!-- E-Wallet QR Code -->
                        <div id="eWalletQR" class="payment-qr-section hidden">
                            <div class="bg-gray-50 rounded-lg p-6 text-center">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">E-Wallet Payment</h3>
                                <div class="bg-white p-4 rounded-lg inline-block shadow-sm">
                                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDE1MCAxNTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxNTAiIGhlaWdodD0iMTUwIiBmaWxsPSIjRkZGRkZGIi8+CjxyZWN0IHg9IjIwIiB5PSIyMCIgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjMDAwMDAwIi8+CjxyZWN0IHg9IjQwIiB5PSIyMCIgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjMDAwMDAwIi8+CjxyZWN0IHg9IjgwIiB5PSIyMCIgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjMDAwMDAwIi8+CjxyZWN0IHg9IjEwMCIgeT0iMjAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iIzAwMDAwMCIvPgo8cmVjdCB4PSIxMjAiIHk9IjIwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiMwMDAwMDAiLz4KPHJlY3QgeD0iMjAiIHk9IjQwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiMwMDAwMDAiLz4KPHJlY3QgeD0iNjAiIHk9IjQwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiMwMDAwMDAiLz4KPHJlY3QgeD0iMTIwIiB5PSI0MCIgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjMDAwMDAwIi8+CjxjaXJjbGUgY3g9Ijc1IiBjeT0iNzUiIHI9IjE1IiBmaWxsPSIjRkY2QjM1Ii8+Cjx0ZXh0IHg9Ijc1IiB5PSI4MCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZm9udC1zaXplPSIxNCIgZmlsbD0iI0ZGRkZGRiI+ZTwvdGV4dD4KPHRleHQgeD0iNzUiIHk9IjExMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZm9udC1zaXplPSIxMiIgZmlsbD0iIzAwMDAwMCI+R29QYXkgLyBPVk8gLyBEYW5hPC90ZXh0Pgo8L3N2Zz4=" 
                                         alt="E-Wallet QR Code" class="w-32 h-32 mx-auto">
                                </div>
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">Scan with your E-Wallet app</p>
                                    <p class="text-lg font-semibold text-gray-800">GoPay / OVO / Dana</p>
                                    <p class="text-sm text-gray-600">MIINACCI STORE</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Notes -->
                    <div class="bg-white rounded-lg card-shadow p-6 mb-6">
                        <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-6">Order Notes (Optional)</h2>
                        <textarea name="order_notes" rows="4" class="form-input" placeholder="Any special instructions or notes for your order..."></textarea>
                    </div>
                </form>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg card-shadow p-6">
                    <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-6">Order Summary</h2>
                    
                    <!-- Cart Items List (No product images) -->
                    <div id="checkoutItems" class="space-y-4 mb-6">
                        <!-- Items will be loaded dynamically from localStorage, but product images are hidden/removed -->
                    </div>

                    <!-- Order Totals -->
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Subtotal</span>
                            <span id="subtotalAmount">Rp 0</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Shipping</span>
                            <span id="shippingCost">Free</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 flex justify-between text-xl font-bold text-gray-800">
                            <span>Total</span>
                            <span id="totalAmount">Rp 0</span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <button type="submit" form="checkoutForm" class="w-full bg-red-800 text-white py-4 rounded-lg font-semibold text-lg hover:bg-red-900 transition-colors relative z-10 cursor-pointer">
                        Checkout Now
                    </button>

                    <!-- Security Notice -->
                    <div class="mt-4 text-center">
                        <div class="flex items-center justify-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Secure checkout protected by SSL encryption</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load selected items from localStorage
        let selectedItems = [];
        
        function loadSelectedItems() {
            const storedItems = localStorage.getItem('selectedCartItems');
            if (storedItems) {
                selectedItems = JSON.parse(storedItems);
                displayCheckoutItems();
                updateOrderSummary();
            } else {
                // Fallback if no items selected (redirect back to cart)
                alert('No items selected for checkout. Redirecting to cart...');
                window.location.href = '{{ route("cart") }}';
            }
        }
        
        function displayCheckoutItems() {
            const checkoutItemsContainer = document.getElementById('checkoutItems');
            let itemsHTML = '';
            
            selectedItems.forEach(item => {
                const itemTotal = item.price * item.quantity;
                
                itemsHTML += `
                    <div class="flex items-center space-x-4 pb-4 border-b border-gray-200">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-100 to-pink-200 rounded-lg flex items-center justify-center">
                            <span class="text-2xl">💎</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">${item.name}</h3>
                            <p class="text-sm text-gray-600">Qty: ${item.quantity}</p>
                            <p class="text-sm text-yellow-600 font-bold">Rp ${item.price.toLocaleString('id-ID')} each</p>
                        </div>
                        <div class="text-lg font-semibold text-gray-800">Rp ${itemTotal.toLocaleString('id-ID')}</div>
                    </div>
                `;
            });
            
            checkoutItemsContainer.innerHTML = itemsHTML;
        }
        
        function updateOrderSummary() {
            let subtotal = 0;
            let totalItems = 0;
            
            selectedItems.forEach(item => {
                subtotal += item.price * item.quantity;
                totalItems += item.quantity;
            });
            
            const total = subtotal; // Total is just subtotal without tax
            
            document.getElementById('subtotalAmount').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Payment method toggle
        document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const bankTransferQR = document.getElementById('bankTransferQR');
                const eWalletQR = document.getElementById('eWalletQR');
                
                if (this.value === 'bank_transfer') {
                    bankTransferQR.classList.remove('hidden');
                    eWalletQR.classList.add('hidden');
                } else if (this.value === 'e_wallet') {
                    bankTransferQR.classList.add('hidden');
                    eWalletQR.classList.remove('hidden');
                }
            });
        });

        // Update shipping cost based on selected method
        document.querySelectorAll('input[name="shipping_method"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const shippingCost = document.getElementById('shippingCost');
                const totalAmount = document.getElementById('totalAmount');
                let cost = 0;
                let costText = 'Free';
                
                if (this.value === 'express') {
                    cost = 50000;
                    costText = 'Rp 50,000';
                } else if (this.value === 'overnight') {
                    cost = 100000;
                    costText = 'Rp 100,000';
                }
                
                shippingCost.textContent = costText;
                
                // Recalculate total with shipping
                let subtotal = 0;
                selectedItems.forEach(item => {
                    subtotal += item.price * item.quantity;
                });
                const newTotal = subtotal + cost;
                totalAmount.textContent = 'Rp ' + newTotal.toLocaleString('id-ID');
            });
        });

        // Form validation and submission
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            console.log('Form submission triggered');
            
            // Basic validation (but don't prevent submission)
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    field.style.borderColor = '#ef4444';
                    isValid = false;
                } else {
                    field.style.borderColor = '#d1d5db';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
                console.log('Form validation failed');
                return;
            }
            
            console.log('Form validation passed, submitting...');

            // Set the order total in the hidden input before submitting
            let subtotal = 0;
            selectedItems.forEach(item => {
                subtotal += item.price * item.quantity;
            });
            let shippingCost = 0;
            const shippingMethod = document.querySelector('input[name="shipping_method"]:checked');
            if (shippingMethod) {
                if (shippingMethod.value === 'express') shippingCost = 50000;
                else if (shippingMethod.value === 'overnight') shippingCost = 100000;
            }
            const total = subtotal + shippingCost;
            document.getElementById('orderTotalInput').value = total;
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]') || document.querySelector('button[form="checkoutForm"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...';
                submitBtn.disabled = true;
            }
        });

        // Only allow numbers for postal code
        document.querySelector('input[name="postal_code"]').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
        
        // Load items when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadSelectedItems();
            
            // Add click handler for checkout button as backup
            const checkoutButton = document.querySelector('button[form="checkoutForm"]');
            if (checkoutButton) {
                checkoutButton.addEventListener('click', function(e) {
                    console.log('Checkout button clicked');
                    // This will trigger the form submission
                });
            }
        });
    </script>
</x-layout>
