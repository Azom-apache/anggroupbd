<x-frontend-layout title="Products">

    <section class="sk__animated-header sk__header-y-m dark-shade-7-bg dark-shade-5-border sk__parallax-background-section sk__parallax-fixer-ignore-height" style="opacity: 1; transform: translate(0px, 0px);">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900"></h2>
        </div>
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-6">
            @foreach ($products as $product)
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="{{ route('singleCategory', ['id' => $product->id]) }}">
                        <img src="{{ $product->image ?? '' }}" alt="Product Image" class="w-full h-48  mb-4">

                    </a>
                    <h3 class="text-lg font-bold mb-2">{{ Str::limit($product->name ?? $product->name, 25) }}</h3>
                    <p class="text-gray-600 mb-2">{{ Str::limit($product->short_text ?? '', 100) }}</p>

                </div>
            @endforeach
        </div>
    </section>
</x-frontend-layout>
