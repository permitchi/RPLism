<head>
    <title>Order History - MIINACCI</title>
</head>

<x-layout>
    <div class="container mx-auto px-4 md:px-20 py-12">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-2xl md:text-4xl font-logo font-bold text-yellow-600 mb-4">Order History</h1>
            <p class="text-gray-600 font-body text-lg">Track and review your accessory purchases</p>
        </div>

        @auth
            <!-- Filter and Search Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    <div class="flex flex-col md:flex-row gap-4 flex-1">
                        <!-- Search Bar -->
                        <div class="relative flex-1 max-w-md">
                            <input type="text" 
                                   id="orderSearch" 
                                   placeholder="Search by order ID or product name..." 
                                   class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body">
                            <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>

                        <!-- Status Filter -->
                        <select id="statusFilter" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>

                        <!-- Date Filter -->
                        <select id="dateFilter" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body">
                            <option value="">All Time</option>
                            <option value="7">Last 7 days</option>
                            <option value="30">Last 30 days</option>
                            <option value="90">Last 3 months</option>
                            <option value="365">Last year</option>
                        </select>
                    </div>

                    <!-- Results Count -->
                    <div class="font-body text-gray-600">
                        <span id="orderCount">{{ isset($orders) ? $orders->count() : 0 }}</span> orders found
                    </div>
                </div>
            </div>

            @if(isset($orders) && $orders->count() > 0)
                <!-- Orders List -->
                <div class="space-y-6" id="ordersList">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 order-item"
                             data-status="{{ $order->status }}"
                             data-date="{{ $order->created_at->format('Y-m-d') }}"
                             data-search="{{ strtolower('MII' . $order->id) }}">
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                    <div class="flex flex-col md:flex-row gap-6">
                                        <div>
                                            <p class="font-body font-semibold text-gray-800">Order #MII{{ $order->id }}</p>
                                            <p class="font-body text-sm text-gray-600">{{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-body font-medium">Pending</span>
                                                @break
                                            @case('on going')
                                                <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-body font-medium">On Going</span>
                                                @break
                                            @case('finished')
                                                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-body font-medium">Finished</span>
                                                @break
                                            @case('processing')
                                                <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-body font-medium">Processing</span>
                                                @break
                                            @case('shipped')
                                                <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-body font-medium">Shipped</span>
                                                @break
                                            @case('delivered')
                                                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-body font-medium">Delivered</span>
                                                @break
                                            @case('cancelled')
                                                <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-body font-medium">Cancelled</span>
                                                @break
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if(method_exists($orders, 'links'))
                    <div class="mt-8">
                        {{ $orders->links() }}
                    </div>
                @endif

            @else
                <!-- Empty Order History State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="mb-8">
                            <div class="w-32 h-32 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-16 h-16 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-2xl font-logo font-bold text-gray-800 mb-4">No Orders Yet</h2>
                        <p class="text-gray-600 font-body mb-8">You haven't placed any orders yet. Start shopping to see your order history here!</p>
                        <a href="{{ route('shop') }}" 
                           class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-8 rounded-lg font-body font-medium transition duration-300">
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endif

        @else
            <!-- Not Logged In State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-8">
                        <div class="w-32 h-32 bg-gradient-to-br from-red-100 to-red-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-logo font-bold text-gray-800 mb-4">Login to View Your Orders</h2>
                    <p class="text-gray-600 font-body mb-8">Please log in to access your order history and track your purchases.</p>
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
    </div>

    <!-- JavaScript for Order History Functionality -->
    <script>
        // Toggle order details
        function toggleOrderDetails(orderId) {
            const details = document.getElementById(orderId);
            const icon = document.getElementById('toggle-icon-' + orderId.split('-')[1]);
            
            if (details.classList.contains('hidden')) {
                details.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                details.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Search functionality
        document.getElementById('orderSearch').addEventListener('input', function() {
            filterOrders();
        });

        document.getElementById('statusFilter').addEventListener('change', function() {
            filterOrders();
        });

        document.getElementById('dateFilter').addEventListener('change', function() {
            filterOrders();
        });

        function filterOrders() {
            const searchTerm = document.getElementById('orderSearch').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const dateFilter = parseInt(document.getElementById('dateFilter').value);
            const orders = document.querySelectorAll('.order-item');
            let visibleCount = 0;

            orders.forEach(order => {
                const searchData = order.getAttribute('data-search');
                const status = order.getAttribute('data-status');
                const orderDate = new Date(order.getAttribute('data-date'));
                const now = new Date();
                const daysDiff = (now - orderDate) / (1000 * 60 * 60 * 24);

                let show = true;

                // Search filter
                if (searchTerm && !searchData.includes(searchTerm)) {
                    show = false;
                }

                // Status filter
                if (statusFilter && status !== statusFilter) {
                    show = false;
                }

                // Date filter
                if (dateFilter && daysDiff > dateFilter) {
                    show = false;
                }

                if (show) {
                    order.style.display = 'block';
                    visibleCount++;
                } else {
                    order.style.display = 'none';
                }
            });

            document.getElementById('orderCount').textContent = visibleCount;
        }

        // Order actions
        function cancelOrder(orderId) {
            if (confirm('Are you sure you want to cancel this order?')) {
                fetch(`/orders/${orderId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error cancelling order');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error cancelling order');
                });
            }
        }

        function downloadInvoice(orderId) {
            window.open(`/orders/${orderId}/invoice`, '_blank');
        }

        function reorderItems(orderId) {
            fetch(`/orders/${orderId}/reorder`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Items added to cart successfully!');
                    window.location.href = '/cart';
                } else {
                    alert('Error adding items to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error processing reorder');
            });
        }

        function trackOrder(trackingNumber) {
            // This would typically open a tracking page or modal
            alert(`Tracking number: ${trackingNumber}\n\nYou can track your package using this number on the courier's website.`);
        }
    </script>
</x-layout>
