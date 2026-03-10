<script src="https://cdn.tailwindcss.com"></script>
<x-frontend-layout title="Products">

    
    <section class="sk__animated-header sk__header-y-m dark-shade-7-bg dark-shade-5-border sk__parallax-background-section sk__parallax-fixer-ignore-height" style="opacity: 1; transform: translate(0px, 0px);">
        <div class="text-center mb-5">
            <h2 class="display-4 text-dark">Our Products</h2>
        </div>
        <div class="container my-3">
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm mb-4 d-inline-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Back
            </a>
        </div>
        <div class="container">
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-200 shadow-sm">
                            <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
                                <img src="{{ $product->image ?? '' }}" alt="Product Image" class="card-img-top" style="height: 20rem; object-fit: contain;">
                            </a>
                            <div class="card-body">
                                <h3 class="card-title h5 mb-2 text-gray-500">{{ Str::limit($product->name_en ?? '', 25) }}</h3>
                                <p class="card-text text-muted text-gray-500">{{ Str::limit($product->short_text ?? '', 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</x-frontend-layout>
