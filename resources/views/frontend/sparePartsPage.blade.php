<x-frontend-layout title="Products">
    <section class="py-12 bg-white">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900">Spare Products</h2>
        </div>
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-6">
            @foreach ($spairproducts as $product)
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                        <img src="{{ $product->image ?? '' }}" alt="Product Image" class="w-full h-48  mb-4">

                    </a>
                    <h3 class="text-lg font-bold mb-2">{{ Str::limit($product->name_en ?? '', 25) }}</h3>
                    <p class="text-gray-600 mb-2">{{ Str::limit($product->short_text ?? '', 100) }}</p>

                </div>
            @endforeach
        </div>
    </section>

</x-frontend-layout>
