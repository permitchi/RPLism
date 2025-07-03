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
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-800 focus:border-transparent transition-all;
        }
        .form-label {
            @apply block text-sm font-medium text-gray-700 mb-2;
        }
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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

        <!-- Checkout Steps -->
        <div class="flex justify-center mb-8">
            <div class="flex items-center space-x-8">
                <div class="checkout-step active">
                    <div class="w-8 h-8 bg-red-800 text-white rounded-full flex items-center justify-center mr-2">
                        1
                    </div>
                    <span>Shipping Information</span>
                </div>
                <div class="w-16 h-1 bg-gray-300"></div>
                <div class="checkout-step">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center mr-2">
                        2
                    </div>
                    <span>Payment</span>
                </div>
                <div class="w-16 h-1 bg-gray-300"></div>
                <div class="checkout-step">
                    <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center mr-2">
                        3
                    </div>
                    <span>Order Review</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Checkout Form -->
            <div class="lg:col-span-2">
                <form id="checkoutForm" method="POST" action="{{ route('checkout.process') }}">
                    @csrf
                    
                    <!-- Shipping Information -->
                    <div class="bg-white rounded-lg card-shadow p-6 mb-6">
                        <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-6">Shipping Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="form-label">First Name *</label>
                                <input type="text" name="first_name" class="form-input" required>
                            </div>
                            <div>
                                <label class="form-label">Last Name *</label>
                                <input type="text" name="last_name" class="form-input" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" class="form-input" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Street Address *</label>
                            <input type="text" name="address" class="form-input" placeholder="Street address, apartment, suite, etc." required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="form-label">City *</label>
                                <input type="text" name="city" class="form-input" required>
                            </div>
                            <div>
                                <label class="form-label">State/Province *</label>
                                <select name="state" class="form-input" required>
                                    <option value="">Select State</option>
                                    <option value="DKI Jakarta">DKI Jakarta</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                    <option value="Jawa Timur">Jawa Timur</option>
                                    <option value="Banten">Banten</option>
                                    <option value="Yogyakarta">Yogyakarta</option>
                                    <!-- Add more states as needed -->
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Postal Code *</label>
                                <input type="text" name="postal_code" class="form-input" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Country *</label>
                            <select name="country" class="form-input" required>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Singapore">Singapore</option>
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
                                <input type="radio" name="payment_method" value="credit_card" class="mr-3 text-red-800 focus:ring-red-800" checked>
                                <div class="flex items-center">
                                    <svg class="w-8 h-6 mr-3" viewBox="0 0 32 24" fill="none">
                                        <rect width="32" height="24" rx="3" fill="#1A73E8"/>
                                        <rect x="2" y="8" width="28" height="2" fill="white"/>
                                        <rect x="2" y="14" width="8" height="1" fill="white"/>
                                    </svg>
                                    <span class="font-semibold text-gray-800">Credit/Debit Card</span>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="bank_transfer" class="mr-3 text-red-800 focus:ring-red-800">
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

                        <!-- Credit Card Fields -->
                        <div id="creditCardFields" class="space-y-4">
                            <div>
                                <label class="form-label">Card Number *</label>
                                <input type="text" name="card_number" class="form-input" placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">Expiry Date *</label>
                                    <input type="text" name="expiry_date" class="form-input" placeholder="MM/YY" maxlength="5">
                                </div>
                                <div>
                                    <label class="form-label">CVV *</label>
                                    <input type="text" name="cvv" class="form-input" placeholder="123" maxlength="4">
                                </div>
                            </div>

                            <div>
                                <label class="form-label">Cardholder Name *</label>
                                <input type="text" name="cardholder_name" class="form-input" placeholder="Name as it appears on card">
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
                <div class="bg-white rounded-lg card-shadow p-6 sticky top-4">
                    <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-6">Order Summary</h2>
                    
                    <!-- Sample Cart Items -->
                    <div id="checkoutItems" class="space-y-4 mb-6">
                        <!-- Items will be loaded dynamically from localStorage -->
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
                        <div class="flex justify-between text-gray-700">
                            <span>Tax</span>
                            <span id="taxAmount">Rp 0</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 flex justify-between text-xl font-bold text-gray-800">
                            <span>Total</span>
                            <span id="totalAmount">Rp 0</span>
                        </div>
                    </div>

                    <!-- Promo Code -->
                    <div class="mb-6">
                        <div class="flex space-x-2">
                            <input type="text" placeholder="Promo code" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            <button type="button" class="px-4 py-2 bg-gray-600 text-white rounded-lg text-sm hover:bg-gray-700 transition">Apply</button>
                        </div>
                    </div>

                    <!-- Place Order Button -->
                    <button type="submit" form="checkoutForm" class="w-full bg-red-800 text-white py-4 rounded-lg font-semibold text-lg hover:bg-red-900 transition-colors">
                        Place Order
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
                const imageUrl = getItemImage(item.id);
                
                itemsHTML += `
                    <div class="flex items-center space-x-4 pb-4 border-b border-gray-200">
                        <img src="${imageUrl}" alt="${item.name}" class="w-16 h-16 object-cover rounded-lg">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">${item.name}</h3>
                            <p class="text-sm text-gray-600">Qty: ${item.quantity}</p>
                        </div>
                        <div class="text-lg font-semibold text-gray-800">Rp ${itemTotal.toLocaleString('id-ID')}</div>
                    </div>
                `;
            });
            
            checkoutItemsContainer.innerHTML = itemsHTML;
        }
        
        function getItemImage(itemId) {
            const images = {
                1: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=80&h=80&fit=crop',
                2: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=80&h=80&fit=crop'
            };
            return images[itemId] || 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=80&h=80&fit=crop';
        }
        
        function updateOrderSummary() {
            let subtotal = 0;
            let totalItems = 0;
            
            selectedItems.forEach(item => {
                subtotal += item.price * item.quantity;
                totalItems += item.quantity;
            });
            
            const tax = subtotal * 0.1; // 10% tax
            const total = subtotal + tax;
            
            document.getElementById('subtotalAmount').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('taxAmount').textContent = 'Rp ' + tax.toLocaleString('id-ID');
            document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Format card number with spaces
        document.querySelector('input[name="card_number"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formattedValue = value.replace(/(.{4})/g, '$1 ').trim();
            e.target.value = formattedValue;
        });

        // Format expiry date
        document.querySelector('input[name="expiry_date"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
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
                const tax = subtotal * 0.1;
                const newTotal = subtotal + tax + cost;
                totalAmount.textContent = 'Rp ' + newTotal.toLocaleString('id-ID');
            });
        });

        // Show/hide payment fields based on selected method
        document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const creditCardFields = document.getElementById('creditCardFields');
                if (this.value === 'credit_card') {
                    creditCardFields.style.display = 'block';
                } else {
                    creditCardFields.style.display = 'none';
                }
            });
        });

        // Form validation
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
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
            
            if (isValid) {
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...';
                submitBtn.disabled = true;
                
                // Store order data
                localStorage.setItem('orderData', JSON.stringify({
                    items: selectedItems,
                    formData: new FormData(this)
                }));
                
                // Clear selected items from localStorage
                localStorage.removeItem('selectedCartItems');
                
                // Redirect to success page
                setTimeout(() => {
                    window.location.href = '{{ route("checkout.success") }}';
                }, 2000);
            } else {
                alert('Please fill in all required fields.');
            }
        });

        // Only allow numbers for certain fields
        document.querySelector('input[name="cvv"]').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });

        document.querySelector('input[name="postal_code"]').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
        
        // Load items when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadSelectedItems();
        });
    </script>
</x-layout>
