<x-frontend-layout title="Checkout">
    <div class="container mx-auto my-8 p-8 bg-white shadow-lg border border-gray-300">
        <h1 class="text-3xl font-semibold mb-6">Checkout</h1>
        <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Billing Information</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700"> Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="number" id="phone" name="phone"
                            class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

            </div>

            <!-- Shipping Information -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Shipping Information</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="shipping_address" class="block text-sm font-medium text-gray-700">Shipping
                            Address</label>
                        <input type="text" id="shipping_address" name="shipping_address"
                            class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <!-- Add more fields for shipping information like city, country, zip code, etc. -->
                </div>

            </div>

            <!-- Order Summary -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Order Summary</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">Product</th>
                            <th class="py-2 px-4 border-b">Price</th>
                            <th class="py-2 px-4 border-b">Quantity</th>
                            <th class="py-2 px-4 border-b text-right">Total</th>

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
                                        {{ $cartItem['quantity'] }}

                                    </td>
                                    <td class="py-2 px-4 border-b text-right">
                                        {{ $product->sale_price * $cartItem['quantity'] }} Tk
                                    </td>
                                    <input type="hidden" name="product_id[]" value="{{ $cartItem['product_id'] }}">
                                    <input type="hidden" name="quantity[]" value="{{ $cartItem['quantity'] }}">
                                    <input type="hidden" name="sale_price[]" value="{{ $product->sale_price }}">
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <!-- Cart Summary -->
                <div class="mt-8 p-4 ">
                    <h2 class="text-2xl font-semibold mb-4">Cart Summary</h2>
                    <div class="flex justify-between items-center">
                        <span class="text-lg">Subtotal:</span>
                        <span class="text-lg font-semibold">{{ $total }} Tk.</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-lg">Shipping:</span>
                        <span class="text-lg font-semibold">
                            <select id="shipping_price" name="shipping_price"
                                class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm">
                                <option data-price="0" value="1">Select</option>
                                @foreach (App\Models\Shipping::all() as $shipping)
                                    <option value="{{ $shipping->price }}" data-price="{{ $shipping->price }}">
                                        {{ $shipping->address }}</option>
                                @endforeach
                            </select>

                        </span>
                        <span id="selected_shipping_price"class="text-lg font-semibold">0 Tk.</span>
                    </div>
                    {{-- <div class="flex justify-between items-center">
                    <span class="text-lg">Total:</span>
                    <span class="text-lg font-semibold">{{ $total }} Tk.</span>
                </div> --}}
                    <div class="flex justify-between items-center">
                        <span class="text-lg">Total:</span>
                        <span id="total_amount" class="text-lg font-semibold">{{ $total }} Tk.</span>
                        <input type="hidden" name="total" value="{{ $total }}">
                    </div>
                </div>
            </div>

            <!-- Checkout Button -->
            <div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Complete
                    Purchase</button>
            </div>
        </form>
    </div>
    <script>
        const shippingSelect = document.getElementById('shipping_price');
        const selectedShippingPrice = document.getElementById('selected_shipping_price');
        const totalAmount = document.getElementById('total_amount');

        shippingSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');

            if (price) {
                selectedShippingPrice.textContent = price + ' Tk.';
            } else {
                selectedShippingPrice.textContent = ''; // Reset the price if no option is selected
            }

            updateTotal();
        });

        function updateTotal() {
            const shippingPrice = parseFloat(selectedShippingPrice.textContent.replace('$', ''));
            const total = parseFloat(totalAmount.textContent.replace('Tk.', ''));
            const newTotal = shippingPrice + total;
            totalAmount.textContent = newTotal.toFixed(2) + ' Tk.';
        }
    </script>

</x-frontend-layout>
