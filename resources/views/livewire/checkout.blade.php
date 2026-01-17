{{-- <div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Shipping Information</h2>

                    <form wire:submit="placeOrder">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" wire:model="shipping_name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    required>
                                @error('shipping_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" wire:model="shipping_email"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    required>
                                @error('shipping_email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="tel" wire:model="shipping_phone"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            @error('shipping_phone')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                            <input type="text" wire:model="shipping_address"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                required>
                            @error('shipping_address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                <input type="text" wire:model="shipping_city"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    required>
                                @error('shipping_city')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                                <input type="text" wire:model="shipping_state"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('shipping_state')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code *</label>
                                <input type="text" wire:model="shipping_postal_code"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    required>
                                @error('shipping_postal_code')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                            <input type="text" wire:model="shipping_country"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                required>
                            @error('shipping_country')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Order Notes</label>
                            <textarea wire:model="notes" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                            @error('notes')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            Place Order
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6">
                        @foreach ($cartItems as $item)
                           
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                </div>
                                <p class="text-sm font-medium text-gray-900">
                                    ${{ number_format($item->quantity * $item->product->price, 2) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 pt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="text-gray-900">${{ number_format($this->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax (10%):</span>
                            <span class="text-gray-900">${{ number_format($this->tax, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping:</span>
                            <span class="text-gray-900">${{ number_format($this->shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-200">
                            <span class="text-gray-900">Total:</span>
                            <span class="text-indigo-600">${{ number_format($this->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <div class="text-sm breadcrumbs mb-6">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('cart') }}">Cart</a></li>
                <li><a class="text-primary">Checkout</a></li>
            </ul>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-2">Checkout</h1>
        <p class="text-gray-600 mb-8">Complete your order with secure checkout</p>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Shipping Information -->
            <div class="lg:col-span-2">
                <div class="card bg-base-100 shadow-xl border border-base-300">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Shipping Information
                        </h2>

                        <form wire:submit="placeOrder">
                            <!-- Personal Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">Full Name <span
                                                class="text-error">*</span></span>
                                    </label>
                                    <input type="text" wire:model="shipping_name" placeholder="John Doe"
                                        class="input input-bordered w-full focus:input-primary" required>
                                    @error('shipping_name')
                                        <label class="label">
                                            <span class="label-text-alt text-error">{{ $message }}</span>
                                        </label>
                                    @enderror
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">Email <span
                                                class="text-error">*</span></span>
                                    </label>
                                    <input type="email" wire:model="shipping_email" placeholder="john@example.com"
                                        class="input input-bordered w-full focus:input-primary" required>
                                    @error('shipping_email')
                                        <label class="label">
                                            <span class="label-text-alt text-error">{{ $message }}</span>
                                        </label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-control mb-6">
                                <label class="label">
                                    <span class="label-text font-semibold">Phone Number</span>
                                </label>
                                <input type="tel" wire:model="shipping_phone" placeholder="+1 (555) 123-4567"
                                    class="input input-bordered w-full focus:input-primary">
                                @error('shipping_phone')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="form-control mb-6">
                                <label class="label">
                                    <span class="label-text font-semibold">Address <span
                                            class="text-error">*</span></span>
                                </label>
                                <input type="text" wire:model="shipping_address" placeholder="123 Main Street"
                                    class="input input-bordered w-full focus:input-primary" required>
                                @error('shipping_address')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <!-- City, State, Postal Code -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">City <span
                                                class="text-error">*</span></span>
                                    </label>
                                    <input type="text" wire:model="shipping_city" placeholder="New York"
                                        class="input input-bordered w-full focus:input-primary" required>
                                    @error('shipping_city')
                                        <label class="label">
                                            <span class="label-text-alt text-error">{{ $message }}</span>
                                        </label>
                                    @enderror
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">State/Province</span>
                                    </label>
                                    <input type="text" wire:model="shipping_state" placeholder="NY"
                                        class="input input-bordered w-full focus:input-primary">
                                    @error('shipping_state')
                                        <label class="label">
                                            <span class="label-text-alt text-error">{{ $message }}</span>
                                        </label>
                                    @enderror
                                </div>

                                {{-- <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-semibold">Postal Code <span
                                                class="text-error">*</span></span>
                                    </label>
                                    <input type="text" wire:model="shipping_postal_code" placeholder="10001"
                                        class="input input-bordered w-full focus:input-primary" required>
                                    @error('shipping_postal_code')
                                        <label class="label">
                                            <span class="label-text-alt text-error">{{ $message }}</span>
                                        </label>
                                    @enderror
                                </div> --}}
                            </div>

                            <!-- Country -->
                            <div class="form-control mb-6">
                                <label class="label">
                                    <span class="label-text font-semibold">Country <span
                                            class="text-error">*</span></span>
                                </label>
                                <select wire:model="shipping_country"
                                    class="select select-bordered w-full focus:select-primary">
                                    <option disabled selected>Select your country</option>
                                    <option value="EGP">EGYPT</option>
                                    {{-- <option value="CA">Canada</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="AU">Australia</option>
                                    <option value="DE">Germany</option>
                                    <option value="FR">France</option> --}}
                                </select>
                                @error('shipping_country')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <!-- Order Notes -->
                            <div class="form-control mb-8">
                                <label class="label">
                                    <span class="label-text font-semibold">Order Notes</span>
                                </label>
                                <textarea wire:model="notes" rows="3" placeholder="Special instructions, delivery preferences, etc."
                                    class="textarea textarea-bordered w-full focus:textarea-primary"></textarea>
                                @error('notes')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <!-- Payment Method (Optional Section) -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    Payment Method
                                </h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="form-control">
                                        <label class="label cursor-pointer justify-start gap-3">
                                            <input type="radio" name="payment_method" value="credit_card"
                                                class="radio radio-primary" checked />
                                            <span class="label-text">Credit Card</span>
                                        </label>
                                    </div>
                                    <div class="form-control">
                                        <label class="label cursor-pointer justify-start gap-3">
                                            <input type="radio" name="payment_method" value="paypal"
                                                class="radio radio-primary" />
                                            <span class="label-text">PayPal</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="card-actions">
                                <button type="submit"
                                    class="btn btn-primary btn-block btn-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Place Order & Pay
                                </button>
                            </div>

                            <!-- Security Note -->
                            <div
                                class="mt-6 p-4 bg-info bg-opacity-10 rounded-lg border border-info border-opacity-20">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-info mt-0.5 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <p class="text-sm text-info-content">
                                        <span class="font-semibold">Secure Checkout:</span> Your payment information is
                                        encrypted and secure. We never store your credit card details.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="lg:col-span-1">
                <div class="card bg-base-100 shadow-xl border border-base-300 sticky top-4">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Order Summary
                        </h2>

                        <!-- Cart Items -->
                        <div class="space-y-4 mb-6 max-h-80 overflow-y-auto pr-2">
                            @foreach ($cartItems as $item)
                                <div class="flex gap-3 p-3 bg-base-200 rounded-lg">
                                    <div class="avatar">
                                        <div class="w-12 h-12 rounded bg-base-300 flex items-center justify-center">
                                            @if ($item->product->colors->find($item->product_color_id)->hasMedia('color_images'))
                                                <img src="{{ $item->product->colors->find($item->product_color_id)->getColorImageUrl('thumb') }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-full h-full object-cover rounded">
                                            @else
                                                <svg class="w-6 h-6 text-base-content opacity-50" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-sm truncate">{{ $item->product->name }}</h4>
                                        <div class="flex items-center justify-between mt-1">
                                            <div class="text-xs text-base-content opacity-70">
                                                <span
                                                    class="badge badge-xs mr-1">{{ $item->productColor->name }}</span>
                                                <span
                                                    class="badge badge-xs">{{ $item->productSize->size }}</span>
                                            </div>
                                            <span class="text-xs font-medium">×{{ $item->quantity }}</span>
                                        </div>
                                        <p class="text-sm font-semibold mt-1">
                                            EGP {{ number_format($item->line_total, 2) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Price Breakdown -->
                        <div class="space-y-3 border-t border-base-300 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-base-content">Subtotal</span>
                                <span class="font-medium">EGP {{ number_format($this->subtotal, 2) }}</span>
                            </div>

                            {{-- <div class="flex justify-between items-center">
                                <span class="text-base-content">Tax (10%)</span>
                                <span class="font-medium">${{ number_format($this->tax, 2) }}</span>
                            </div> --}}

                            <div class="flex justify-between items-center">
                                <span class="text-base-content">Shipping</span>
                                <span class="font-medium">
                                    @if ($this->shipping > 0)
                                        EGP {{ number_format($this->shipping, 2) }}
                                    @else
                                        <span class="text-success">Free</span>
                                    @endif
                                </span>
                            </div>

                            <!-- Discount Coupon (Optional) -->
                            <div class="pt-3 border-t border-base-300">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">Discount Code</span>
                                    </label>
                                    <div class="join w-full">
                                        <input type="text" placeholder="SUMMER2024" wire:model='coupon'
                                            class="input input-bordered join-item flex-1 focus:input-primary">
                                        <button class="btn btn-outline join-item">Apply</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="flex justify-between items-center pt-4 border-t border-base-300">
                                <span class="text-lg font-bold text-base-content">Total</span>
                                <div class="text-right">
                                    <span
                                        class="text-2xl font-bold text-primary">EGP {{ number_format($this->total, 2) }}</span>
                                    <p class="text-xs text-base-content opacity-70">EGP</p>
                                </div>
                            </div>
                        </div>

                        <!-- Return Policy -->
                        <div class="mt-6 p-3 bg-base-200 rounded-lg">
                            <div class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-success mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-xs text-base-content opacity-80">
                                    <span class="font-semibold">7-Day Return Policy:</span> Easy returns within 7
                                    days of delivery.
                                </p>
                            </div>
                        </div>

                        <!-- Help Link -->
                        <div class="text-center mt-4">
                            <a href="#" class="text-sm link link-primary hover:link-hover">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Need Help?
                            </a>
                            <p class=" text-sm text-secondary">hello</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay (for when submitting) -->
    {{-- @if ($processing)
        <div class="fixed inset-0 bg-base-100 bg-opacity-50 z-50 flex items-center justify-center">
            <div class="text-center">
                <div class="loading loading-spinner loading-lg text-primary"></div>
                <p class="mt-4 text-lg font-medium">Processing your order...</p>
                <p class="text-sm text-base-content opacity-70">Please don't close this window</p>
            </div>
        </div>
    @endif --}}
</div>
