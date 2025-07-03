<head>
    <title>Order Confirmation - MIINACCI</title>
    <style>
        .success-icon {
            animation: checkmark 0.6s ease-in-out;
        }
        
        @keyframes checkmark {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<x-layout>
    <div class="container mx-auto px-4 lg:px-20 py-16">
        <div class="max-w-2xl mx-auto text-center">
            <!-- Success Icon -->
            <div class="success-icon mb-8">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <!-- Success Message -->
            <div class="fade-in">
                <h1 class="text-4xl font-logo font-bold text-gray-800 mb-4">Order Confirmed!</h1>
                <p class="text-xl text-gray-600 mb-8">Thank you for your purchase. Your order has been successfully placed.</p>
                
                <!-- Order Details -->
                <div class="bg-white rounded-lg shadow-lg p-8 mb-8 text-left">
                    <h2 class="text-2xl font-logo font-semibold text-gray-800 mb-6 text-center">Order Details</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2">Order Number</h3>
                            <p class="text-gray-600">#MII{{ rand(100000, 999999) }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2">Order Date</h3>
                            <p class="text-gray-600">{{ date('F d, Y') }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2">Total Amount</h3>
                            <p class="text-2xl font-bold text-red-800">Rp 4,950,000</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2">Payment Method</h3>
                            <p class="text-gray-600">Credit Card ending in ****1234</p>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="font-semibold text-gray-700 mb-4">Shipping Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700 font-medium">John Doe</p>
                            <p class="text-gray-600">123 Main Street</p>
                            <p class="text-gray-600">Jakarta, DKI Jakarta 12345</p>
                            <p class="text-gray-600">Indonesia</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Estimated Delivery:</span> 
                                {{ date('F d, Y', strtotime('+5 days')) }} - {{ date('F d, Y', strtotime('+7 days')) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- What's Next -->
                <div class="bg-blue-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-blue-800 mb-3">What happens next?</h3>
                    <div class="text-left space-y-3">
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-200 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                <span class="text-blue-800 text-sm font-bold">1</span>
                            </div>
                            <p class="text-blue-700">You'll receive an order confirmation email within the next few minutes.</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-200 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                <span class="text-blue-800 text-sm font-bold">2</span>
                            </div>
                            <p class="text-blue-700">We'll prepare your items and send you a shipping notification with tracking information.</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-6 h-6 bg-blue-200 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                <span class="text-blue-800 text-sm font-bold">3</span>
                            </div>
                            <p class="text-blue-700">Your order will be delivered to your specified address within the estimated timeframe.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('homepage') }}" class="bg-red-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-900 transition-colors">
                        Continue Shopping
                    </a>
                    <a href="#" class="bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                        Track Your Order
                    </a>
                </div>

                <!-- Contact Support -->
                <div class="mt-8 text-center">
                    <p class="text-gray-600 mb-2">Need help with your order?</p>
                    <a href="{{ route('contact') }}" class="text-red-800 hover:text-red-900 font-semibold">Contact our support team</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-scroll to top on page load
        window.scrollTo(0, 0);
        
        // Confetti effect (optional)
        function createConfetti() {
            const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57'];
            const confettiCount = 50;
            
            for (let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.style.position = 'fixed';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.width = '10px';
                confetti.style.height = '10px';
                confetti.style.zIndex = '9999';
                confetti.style.pointerEvents = 'none';
                confetti.style.top = '-10px';
                
                document.body.appendChild(confetti);
                
                const fallDuration = Math.random() * 3 + 2;
                const horizontalDrift = (Math.random() - 0.5) * 100;
                
                confetti.animate([
                    { transform: 'translateY(0px) translateX(0px) rotate(0deg)', opacity: 1 },
                    { transform: `translateY(100vh) translateX(${horizontalDrift}px) rotate(360deg)`, opacity: 0 }
                ], {
                    duration: fallDuration * 1000,
                    easing: 'linear'
                }).onfinish = () => confetti.remove();
            }
        }
        
        // Trigger confetti after a short delay
        setTimeout(createConfetti, 500);
    </script>
</x-layout>
