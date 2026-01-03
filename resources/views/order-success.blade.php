<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="mb-6">
                <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Order Placed Successfully!</h1>
            <p class="text-lg text-gray-600 mb-2">Thank you for your purchase.</p>
            <p class="text-sm text-gray-500 mb-6">Order Number: <span class="font-semibold">{{ $order->order_number }}</span></p>
            <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left max-w-md mx-auto">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal:</span>
                        <span class="text-gray-900">${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax:</span>
                        <span class="text-gray-900">${{ number_format($order->tax, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Shipping:</span>
                        <span class="text-gray-900">${{ number_format($order->shipping, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg pt-2 border-t border-gray-200">
                        <span class="text-gray-900">Total:</span>
                        <span class="text-indigo-600">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</x-layout>

