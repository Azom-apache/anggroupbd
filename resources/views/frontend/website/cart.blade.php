<x-frontend-layout title="Cart">
    <div class="container mx-auto my-8 p-8 bg-white shadow-lg  border border-gray-300">
        <h1 class="text-3xl font-semibold mb-6">Your Cart</h1>

        <!-- Cart Items Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Product</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Quantity</th>
                        <th class="py-2 px-4 border-b">Total</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php($total = 0)
                    @if (isset($data))
                        @foreach ($data as $cartItem)
                            @php($product = App\Models\Product::find($cartItem['product_id']))
                            @php($total += $cartItem['quantity'] * $product->sale_price)
                            <tr>
                                <td class="py-2 px-4 border-b">
                                    <img src="{{ $product->image ?? '' }}" alt="Product Image"
                                        class="h-[50px] mr-2 rounded-md">
                                    {{ $product->name_en ?? '' }}
                                </td>
                                <td class="py-2 px-4 border-b text-center">{{ $product->sale_price ?? '' }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <input class="update-cart" data-id="{{ $cartItem['product_id'] }}" type="number"
                                        id="quantity_{{ $cartItem['product_id'] }}" value="{{ $cartItem['quantity'] }}">
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    {{ $product->sale_price * $cartItem['quantity'] }}
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    <form action="{{ route('cart.destroy', $cartItem['product_id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-200 text-gray-700 hover:text-gray-800 focus:outline-none rounded border-2 border-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="h-6 w-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>


        <!-- Cart Summary -->
        <div class="mt-8 p-4 ">
            <h2 class="text-2xl font-semibold mb-4">Cart Summary</h2>
            <div class="flex justify-between items-center">
                <span class="text-lg">Subtotal:</span>
                <span class="text-lg font-semibold">{{ $total }} Tk.</span>
            </div>
            {{-- <div class="flex justify-between items-center">
                <span class="text-lg">Shipping:</span>
                <span class="text-lg font-semibold">0.00 Tk.</span>
            </div> --}}
            <div class="flex justify-between items-center">
                <span class="text-lg">Total:</span>
                <span class="text-lg font-semibold">{{ $total }} Tk.</span>
            </div>
        </div>

        <!-- Checkout Button -->
        <div class="mt-8">
            <a href="{{ route('checkout.index') }}"
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-400">Proceed to Checkout</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.update-cart').on('click', function() {
                var id = $(this).data('id');
                var quantity = $('#quantity_' + id).val();

                $.ajax({
                    type: 'PATCH',
                    url: '/cart/update/' + id,
                    data: {
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        location.reload();
                    },
                    error: function(data) {
                        console.error('Error updating cart');
                    }
                });
            });
        });
    </script>
</x-frontend-layout>
