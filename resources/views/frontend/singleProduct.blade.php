<x-frontend-layout title="Products">
    <style>
        .zoom-effect {
            overflow: hidden;
        }

        .zoom-effect img {
            transition: transform 0.5s ease;
        }
        
        .zoom-effect:hover img {
            transform: scale(1.2);
        }
        
        .main-img {
            transition: transform 0.5s ease;
        }
        </style>

<div class="container py-5 mt-20" style="margin-top: 73px;">
        <div class="container py-3">
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm mb-4 d-inline-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Back
            </a>
        </div>
        <div class="row g-4">
            <!-- Left column: Product Images -->
            <div class="col-md-6">
                <div class="position-sticky top-0 ">
                    <div class="mb-3  p-2 text-center">
                        <img id="mainProductImage" class="img-fluid main-img" src="{{ $singleProduct->image }}" alt="Product Image">
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($singleProduct->productImages as $image)
                            <label class="border p-1" style="cursor: pointer;">
                                <input type="radio" name="selectedImage" class="d-none"
                                    value="{{ asset('upload/product/' . $image->image) }}">
                                <div class="zoom-effect">
                                    <img src="{{ asset('upload/product/' . $image->image) }}" class="img-thumbnail" style="width: 75px; h-72 object-fit: cover;">
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right column: Product Info -->
            <div class="col-md-6">
                <h2 class="mb-3">{{ $singleProduct->name_en }}</h2>

                <!-- Social Share Buttons -->
         <div class="mb-4">
    <span class="me-2 fw-bold">Share:</span>
    <a href="#" id="facebookShare" class="btn btn-outline-primary btn-sm me-1" target="_blank" aria-label="Share on Facebook">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 320 512">
            <path d="M279.14 288l14.22-92.66h-88.91V127.09c0-25.35 12.42-50.06 52.24-50.06H293V6.26S259.5 0 225.36 0c-73.5 0-121.36 44.38-121.36 124.72V195.3H22.89V288h81.11v224h100.17V288z"/>
        </svg>
    </a>
    <a href="#" id="twitterShare" class="btn btn-outline-info btn-sm me-1" target="_blank" aria-label="Share on Twitter">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 512 512">
            <path d="M459.4 151.7c.3 4.1.3 8.2.3 12.3 0 125.1-95.2 269.2-269.2 269.2-53.5 0-103.2-15.7-145.2-42.8 7.4.8 14.8 1.1 22.5 1.1 44.4 0 85.2-15.1 117.7-40.8-41.6-.8-76.6-28.2-88.7-65.9 5.8.8 11.6 1.4 17.8 1.4 8.5 0 16.8-1.1 24.6-3.3-43.4-8.7-76-47-76-92.5v-1.1c12.6 7 27 11.3 42.2 11.8-25.1-16.8-41.6-45.3-41.6-77.7 0-17.1 4.5-33 12.6-46.8 45.6 56.1 113.6 92.7 190.4 96.6-1.6-6.8-2.5-13.9-2.5-21.1 0-51 41.6-92.5 92.5-92.5 26.6 0 50.6 11.3 67.5 29.5 21.1-4.1 41.3-11.8 59.4-22.2-7 21.8-21.8 40.2-41.3 51.6 18.8-2 36.6-7.2 53.1-14.2-12.4 18.6-28.2 35.1-46.2 48.2z"/>
        </svg>
    </a>
    <a href="#" id="pinterestShare" class="btn btn-outline-danger btn-sm me-1" target="_blank" aria-label="Share on Pinterest">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 496 512">
            <path d="M496 256c0 137-111 248-248 248S0 393 0 256 111 8 248 8s248 111 248 248zM268.6 134.2c-48.8 0-90.4 25.9-96.2 72.4-5.1 38.2 11.3 74.7 49.6 85.5 14.4 4.1 27.2-3.6 31.3-18.1 3.6-12.8 4.7-26.5 7.3-39.7 2.2-10.9 9.5-17.4 20.5-14.2 20.2 5.6 23.7 28.1 18.8 46.4-7.3 26.9-23.6 47.8-50.7 53.2-32.7 6.9-63.5-11.9-73.1-47.1-9.8-36.2-1.5-80.6 18.9-111.3 27.6-42.5 86.1-52.1 124.8-24.2 23.1 16.6 31.4 47.4 28.8 74.5-2.1 21.7-12.3 40.6-32.1 50.5-13.6 6.8-22.7-1.4-19.8-16.1 2.5-12.3 5.6-24.5 6.3-37.1 1.1-20.6-10.1-31.9-30.3-31.9z"/>
        </svg>
    </a>
    <a href="#" id="linkedinShare" class="btn btn-outline-primary btn-sm me-1" target="_blank" aria-label="Share on LinkedIn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 448 512">
            <path d="M100.28 448H7.4V149.1h92.88zM53.79 108.1C24.09 108.1 0 83.9 0 54.3 0 24.7 24.09.5 53.79.5c29.47 0 53.79 24.19 53.79 53.8 0 29.6-24.32 53.8-53.79 53.8zM447.8 448h-92.4V302.4c0-34.7-12.5-58.3-43.6-58.3-23.8 0-38 16-44.3 31.4-2.3 5.6-2.9 13.4-2.9 21.3V448h-92.6s1.2-272.1 0-299.9h92.6v42.5c12.3-19 34.2-46.1 83.1-46.1 60.6 0 106.1 39.6 106.1 124.7V448z"/>
        </svg>
    </a>
    <a href="#" id="telegramShare" class="btn btn-outline-primary btn-sm" target="_blank" aria-label="Share on Telegram">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 496 512">
            <path d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm123.2 166.4l-38.4 180.4c-2.9 13.1-10.6 16.4-21.5 10.2l-59.4-43.7-28.6 27.5c-3.1 3.1-5.7 5.7-11.6 5.7l4.1-58.4 106.4-95.9c4.6-4.1-1-6.4-7.1-2.3L167.1 287.4l-56.3-17.6c-12.2-3.8-12.5-12.2 2.6-18.1l220.8-85.2c10.2-3.7 19.2 2.5 15.9 18.9z"/>
        </svg>
    </a>
</div>


                <!-- Optional: Product Price -->
                {{-- 
                <h4 class="text-success">
                    ${{ $singleProduct->discount_price }}
                    <small class="text-muted text-decoration-line-through">${{ $singleProduct->sale_price }}</small>
                </h4>
                --}}

                <!-- Optional: Product Description -->
                <span class="me-2 fw-bold">Description:</span>
                <p class="mt-4">{!! $singleProduct->description_en !!}</p> 
               
            </div>
        </div>
    </div>

    <!-- Social Share + Image Switch Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const currentUrl = encodeURIComponent(window.location.href);
            const mediaUrl = encodeURIComponent('{{ $singleProduct->image }}');
            const description = encodeURIComponent('{{ $singleProduct->name_en }}');

            document.getElementById("facebookShare").href = `https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`;
            document.getElementById("twitterShare").href = `https://twitter.com/share?url=${currentUrl}`;
            document.getElementById("pinterestShare").href = `https://pinterest.com/pin/create/button/?url=${currentUrl}&media=${mediaUrl}&description=${description}`;
            document.getElementById("linkedinShare").href = `https://www.linkedin.com/shareArticle?mini=true&url=${currentUrl}`;
            document.getElementById("telegramShare").href = `https://telegram.me/share/url?url=${currentUrl}`;

            const thumbnails = document.querySelectorAll('input[name="selectedImage"]');
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('change', function () {
                    const mainImage = document.getElementById("mainProductImage");
                    mainImage.src = this.value;
                });
            });
        });
    </script>
</x-frontend-layout>
