<script src="https://cdn.tailwindcss.com"></script>
<x-frontend-layout title="Products">

    <section class="sk__animated-header sk__header-y-m dark-shade-7-bg dark-shade-5-border sk__parallax-background-section sk__parallax-fixer-ignore-height" style="opacity: 1; transform: translate(0px, 0px);">
        <div class="text-center mb-5">
            <h2 class="display-4 text-dark">Our Products</h2>
        </div>
        <div class="container">
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('product2', ['id' => $product->id]) }}">
                                <img src="{{ $product->image ?? '' }}" alt="Product Image" class="card-img-top" style="height: 12rem; object-fit: cover;">
                            </a>
                            <div class="card-body">
                                <h3 class="card-title h5 mb-2 text-gray-500">{{ Str::limit($product->name ?? '', 25) }}</h3>
                                <p class="card-text text-muted text-gray-500">{{ Str::limit($product->short_text ?? '', 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-frontend-layout>

