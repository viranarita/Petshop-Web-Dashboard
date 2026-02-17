<div class="h-[calc(100vh-65px)] flex flex-col md:flex-row overflow-hidden bg-gray-50">
    
    <!-- Left Side: Product/Service Grid -->
    <div class="w-full md:w-2/3 flex flex-col h-full">
        <!-- Search Bar -->
        <div class="p-6 bg-white border-b border-gray-100 shadow-sm z-10">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search products or services..." class="pl-10 w-full border-gray-200 rounded-xl shadow-sm focus:border-primary-500 focus:ring-primary-500 py-3 text-lg">
            </div>
        </div>

        <!-- Grid Content -->
        <div class="flex-1 overflow-y-auto p-6">
            <h3 class="font-bold text-xl mb-4 text-gray-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Services
            </h3>
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8">
                @foreach ($services as $service)
                    <div wire:click="addToCart('service', {{ $service->id }})" class="bg-white p-5 rounded-2xl shadow-sm cursor-pointer hover:shadow-lg hover:ring-2 hover:ring-primary-500 hover:-translate-y-1 transition-all duration-200 relative group border border-gray-100 h-full flex flex-col justify-between">
                        <div>
                            <div class="font-bold text-gray-800 text-lg leading-tight mb-2">{{ $service->name }}</div>
                            <div class="text-sm text-gray-500">{{ $service->duration_minutes }} mins</div>
                        </div>
                        <div class="mt-4 flex justify-between items-end">
                            <span class="text-primary-600 font-bold text-lg">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 group-hover:bg-primary-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <h3 class="font-bold text-xl mb-4 text-gray-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Products
            </h3>
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @forelse ($products as $product)
                    <div wire:click="addToCart('product', {{ $product->id }})" class="bg-white p-5 rounded-2xl shadow-sm cursor-pointer hover:shadow-lg hover:ring-2 hover:ring-purple-500 hover:-translate-y-1 transition-all duration-200 border border-gray-100 h-full flex flex-col justify-between group">
                        <div>
                            <div class="font-bold text-gray-800 text-lg leading-tight mb-2">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">Stock: {{ $product->stock }}</div>
                        </div>
                        <div class="mt-4 flex justify-between items-end">
                            <span class="text-purple-600 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                             <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center">
                        <p class="text-gray-400 text-lg">No products found.</p>
                        <p class="text-sm text-gray-400">Try adjusting your search or add new products.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right Side: Cart -->
    <div class="w-full md:w-1/3 bg-white border-l border-gray-100 shadow-xl flex flex-col h-full z-20">
        <div class="p-6 bg-gray-900 text-white shadow-md">
            <h2 class="font-bold text-2xl flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Current Order
            </h2>
            <div class="text-gray-400 text-sm mt-1">Transaction #{{ rand(1000,9999) }}</div>
        </div>

        <!-- Cart Items -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4">
            @if (empty($cart))
                <div class="h-full flex flex-col items-center justify-center text-gray-400 opacity-50">
                    <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <p class="text-lg font-medium">Cart is empty</p>
                    <p class="text-sm">Select items from the left to start.</p>
                </div>
            @else
                @foreach ($cart as $key => $item)
                    <div class="flex justify-between items-center group">
                        <div class="flex-1 pr-4">
                            <div class="font-bold text-gray-800">{{ $item['name'] }}</div>
                            <div class="text-xs text-gray-500 font-medium tracking-wide">{{ strtoupper($item['type']) }}</div>
                        </div>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg p-1">
                            <button wire:click="updateQuantity('{{ $key }}', {{ $item['quantity'] - 1 }})" class="w-7 h-7 rounded-md bg-white text-gray-600 shadow-sm hover:bg-red-50 hover:text-red-500 transition-colors flex items-center justify-center border border-gray-200">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </button>
                            <span class="w-6 text-center font-bold text-gray-900">{{ $item['quantity'] }}</span>
                            <button wire:click="updateQuantity('{{ $key }}', {{ $item['quantity'] + 1 }})" class="w-7 h-7 rounded-md bg-white text-gray-600 shadow-sm hover:bg-green-50 hover:text-green-500 transition-colors flex items-center justify-center border border-gray-200">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                        <div class="w-24 text-right">
                             <div class="font-bold text-gray-900">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</div>
                             <div class="text-xs text-gray-500">@ {{ number_format($item['price'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Checkout Section -->
        <div class="p-6 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-between items-end mb-6">
                <span class="text-gray-500 font-medium">Total Amount</span>
                <span class="text-3xl font-bold text-gray-900">Rp {{ number_format($this->total, 0, ',', '.') }}</span>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Method</label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="paymentMethod" value="cash" class="peer sr-only">
                        <div class="rounded-xl border border-gray-200 bg-white p-3 text-center peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:text-primary-700 transition-all hover:border-gray-300">
                            <span class="block text-sm font-bold">Cash</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="paymentMethod" value="qris" class="peer sr-only">
                        <div class="rounded-xl border border-gray-200 bg-white p-3 text-center peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:text-primary-700 transition-all hover:border-gray-300">
                            <span class="block text-sm font-bold">QRIS</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="paymentMethod" value="card" class="peer sr-only">
                        <div class="rounded-xl border border-gray-200 bg-white p-3 text-center peer-checked:border-primary-500 peer-checked:bg-primary-50 peer-checked:text-primary-700 transition-all hover:border-gray-300">
                            <span class="block text-sm font-bold">Card</span>
                        </div>
                    </label>
                </div>
            </div>

            <button wire:click="checkout" class="w-full py-4 bg-primary-600 hover:bg-primary-700 active:bg-primary-800 text-white rounded-xl font-bold text-lg shadow-lg shadow-primary-500/30 transition-all transform hover:-translate-y-0.5" {{ empty($cart) ? 'disabled' : '' }}>
                Process Payment
            </button>
        </div>
    </div>
</div>
