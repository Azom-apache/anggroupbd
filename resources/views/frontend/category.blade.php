<!-- In your <head> section -->
<script src="https://cdn.tailwindcss.com"></script>

<x-frontend-layout title="Products">
    <section class="sk__animated-header sk__header-y-m dark-shade-7-bg dark-shade-5-border sk__parallax-background-section sk__parallax-fixer-ignore-height" style="opacity: 1; transform: translate(0px, 0px);">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900">{{ $products->first()->category->name ?? '' }}</h2>
        </div>

        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-6">
            @foreach ($products as $product)
                <div class="relative group border p-4 rounded-lg shadow-md overflow-hidden bg-white">
                    <!-- Product image & title inside link -->
                    <a href="{{ route('singleProduct', ['id' => $product->id]) }}" class="block z-10 relative">
                        <img src="{{ $product->image ?? '' }}" alt="Product Image" class="w-full h-48 object-cover mb-4 transition duration-300 group-hover:opacity-30">
                        <h3 class="text-lg font-bold mb-2 text-gray-900">{{ Str::limit($product->name_en ?? $product->name, 25) }}</h3>
                    </a>

                    <!-- Hover description (doesn't block the link now) -->
                    <div class="absolute inset-0 bg-white bg-opacity-90 opacity-0 group-hover:opacity-100 transition duration-300 p-4 overflow-y-auto pointer-events-none">
                        <p class="text-sm text-gray-800">{!! $product->short_text ?? '' !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-frontend-layout>

