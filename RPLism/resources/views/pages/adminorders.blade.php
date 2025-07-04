<head>
    <title>Orders - MIINACCI (Admin)</title>
</head>

<x-layout>
    <div class="container mx-auto px-4 md:px-20 py-12">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-2xl md:text-4xl font-logo font-bold text-yellow-600 mb-4">Orders (Admin)</h1>
            <p class="text-gray-600 font-body text-lg">Track and manage all customer orders</p>
        </div>

        @auth
            @if(auth()->user()->role === 'admin')
            <!-- Filter and Search Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    <div class="flex flex-col md:flex-row gap-4 flex-1">
                        <!-- Search Bar -->
                        <div class="relative flex-1 max-w-md">
                            <input type="text" id="orderSearch" placeholder="Search by order ID or product name..." class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 font-body">
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
                             data-search="{{ strtolower($order->order_number . ' ' . $order->items->pluck('product.name')->implode(' ')) }}">
                            <!-- Order Header -->
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b">
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                    <div class="flex flex-col md:flex-row gap-6">
                                        <div>
                                            <p class="font-body font-semibold text-gray-800">Order #{{ $order->order_number }}</p>
                                            <p class="font-body text-sm text-gray-600">{{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
                                        </div>
                                        <div>
                                            <p class="font-body text-sm text-gray-600">Total Amount</p>
                                            <p class="font-body font-bold text-yellow-600 text-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="font-body text-sm text-gray-600">Items</p>
                                            <p class="font-body font-semibold text-gray-800">{{ $order->items->count() }} {{ $order->items->count() === 1 ? 'item' : 'items' }}</p>
                                        </div>
                                    </div>
                                    <!-- Order Status (Admin can change) -->
                                    <div class="flex items-center gap-4">
                                        <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}" class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="px-3 py-2 border rounded-lg font-body text-sm" onchange="this.form.submit()">
                                                <option value="pending" @if($order->status=='pending') selected @endif>Pending</option>
                                                <option value="processing" @if($order->status=='processing') selected @endif>Processing</option>
                                                <option value="shipped" @if($order->status=='shipped') selected @endif>Shipped</option>
                                                <option value="delivered" @if($order->status=='delivered') selected @endif>Delivered</option>
                                                <option value="cancelled" @if($order->status=='cancelled') selected @endif>Cancelled</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Order Details (reuse from user order history) -->
                            <div id="order-{{ $order->id }}" class="">
                                <!-- Shipping Information -->
                                <div class="px-6 py-4 bg-gray-50 border-b">
                                    <h3 class="font-body font-semibold text-gray-800 mb-3">Shipping Information</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="font-body text-sm text-gray-600">Shipping Address</p>
                                            <p class="font-body text-gray-800">{{ $order->shipping_address }}</p>
                                        </div>
                                        @if($order->tracking_number)
                                            <div>
                                                <p class="font-body text-sm text-gray-600">Tracking Number</p>
                                                <p class="font-body text-gray-800 font-mono">{{ $order->tracking_number }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- Order Items -->
                                <div class="px-6 py-4">
                                    <h3 class="font-body font-semibold text-gray-800 mb-4">Order Items</h3>
                                    <div class="space-y-4">
                                        @foreach($order->items as $item)
                                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                                <div class="w-16 h-16 bg-gradient-to-br from-pink-100 to-pink-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    @if($item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-12 h-10 object-contain rounded" />
                                                    @else
                                                        <span class="text-lg">💎</span>
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-body font-semibold text-gray-800">{{ $item->product->name }}</h4>
                                                    <p class="font-body text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                                                    <p class="font-body text-sm text-gray-600">Unit Price: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-body font-bold text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if(method_exists($orders, 'links'))
                    <div class="mt-8">
                        {{ $orders->links() }}
                    </div>
                @endif
            @else
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
                        <p class="text-gray-600 font-body mb-8">No orders have been placed yet.</p>
                    </div>
                </div>
            @endif
            @else
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="mb-8">
                            <div class="w-32 h-32 bg-gradient-to-br from-red-100 to-red-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-2xl font-logo font-bold text-gray-800 mb-4">Login as Admin to View Orders</h2>
                        <p class="text-gray-600 font-body mb-8">Please log in as an admin to manage orders.</p>
                        <a href="{{ route('login') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white py-3 px-8 rounded-lg font-body font-medium transition duration-300">Login</a>
                    </div>
                </div>
                @endif
            @endauth
    </div>
</x-layout>
