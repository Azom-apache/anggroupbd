<x-frontend-layout title="Products">
    <style>
        .zoom-effect {
            overflow: hidden;
            position: relative;
        }

        .zoom-effect img {
            transition: transform 0.5s ease;
        }

        .zoom-effect:hover img {
            transform: scale(1.2);
        }
    </style>



<section class="sk__animated-header sk__header-y-m dark-shade-7-bg dark-shade-5-border sk__parallax-background-section sk__parallax-fixer-ignore-height" style="opacity: 1; transform: translate(0px, 0px);">
        <div class="max-w-6xl px-4 mx-auto">
            <div class="flex flex-wrap mb-24 -mx-4">
                <div class="w-full px-4 mb-8 md:w-1/2 md:mb-0">
                    <div class="sticky top-0 overflow-hidden ">
                        <div class="relative mb-6 lg:mb-10 lg:h-96">
                            {{-- <a class="absolute left-0 transform lg:ml-2 top-1/2 translate-1/2" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="w-5 h-5 text-yellow-500 bi bi-chevron-left dark:text-yellow-200"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                                    </path>
                                </svg>
                            </a> --}}

                            <img class="object-contain w-full lg:h-full" src="{{ $singleProduct->image }}" alt="">

                            {{-- <a class="absolute right-0 transform lg:mr-2 top-1/2 translate-1/2" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor"
                                    class="w-5 h-5 text-yellow-500 bi bi-chevron-right dark:text-yellow-200"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                    </path>
                                </svg>
                            </a> --}}
                        </div>

                    </div>

                </div>

                <div class="w-full px-4 md:w-1/2 bg-white">
                    <div class="lg:pl-20">
                        <div class="mb-6 ">

                            {{-- <span
                                class="px-2.5 py-0.5 text-xs text-yellow-600 bg-yellow-100 dark:bg-gray-700 rounded-xl dark:text-gray-200">New
                                Arrival</span> --}}
                            <h2
                                class="max-w-xl mt-6 mb-6 text-xl font-semibold leading-loose tracking-wide text-black md:text-2xl ">
                                {{ $singleProduct->name }}
                            </h2>
                            <div class="flex flex-wrap items-center">
                                {{-- <ul class="flex mb-4 mr-2 lg:mb-0">
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z">
                                                </path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z">
                                                </path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z">
                                                </path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor"
                                                class="w-4 mr-1 text-red-500 dark:text-gray-400 bi bi-star "
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z">
                                                </path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul> --}}

                            </div>
                            <div class="gap-2 flex">

                                <a rel="nofollow"
                                    href="{{ \App\Models\ConfigDictionary::get('fb_share_for_withdraw') }}"
                                    target="_blank" class="gap-2 woodmart-social-icon social-facebook">
                                    <i class="fab fa-facebook-f"></i>

                                </a>

                                <a rel="nofollow" href="https://twitter.com/share?url=https://caretexbd.com/"
                                    target="_blank" class="gap-2 woodmart-social-icon social-twitter">
                                    <i class="fab fa-twitter"></i>

                                </a>

                                <a rel="nofollow"
                                    href="https://pinterest.com/pin/create/button/?url=https://caretexbd.com/&media=https://caretexbd.com/wp-includes/images/media/default.svg&description=Home+base"
                                    target="_blank" class="gap-2 woodmart-social-icon social-pinterest">
                                    <i class="fab fa-pinterest-p"></i>

                                </a>

                                <a rel="nofollow"
                                    href="https://www.linkedin.com/shareArticle?mini=true&url=https://caretexbd.com/"
                                    target="_blank" class="gap-2 woodmart-social-icon social-linkedin">
                                    <i class="fab fa-linkedin-in"></i>

                                </a>

                                <a rel="nofollow" href="https://telegram.me/share/url?url=https://caretexbd.com/"
                                    target="_blank" class="gap-2 woodmart-social-icon social-tg">
                                    <i class="fab fa-telegram-plane"></i>

                                </a>
                            </div>
                            {{-- <p class="inline-block text-2xl font-semibold text-gray-700 dark:text-gray-400 ">
                                <span>{{ $singleProduct->discount_price }}</span>
                                <span class="ml-3 text-base font-normal text-gray-500 line-through dark:text-gray-400">
                                    {{ $singleProduct->sale_price }}
                                </span>
                            </p> --}}
                        </div>
                        {{-- <div class="mb-6">
                            <h2 class="mb-2 text-lg font-bold text-gray-700 dark:text-gray-400">Size / Unit :</h2>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-xl">
                                <div class="p-3 lg:p-5 ">
                                    <div class="p-2 rounded-xl lg:p-6 dark:bg-gray-800 bg-gray-50">
                                        <div class="flex flex-wrap justify-center">
                                            <div class="flex flex-wrap justify-between">
                                                @foreach ($singleProduct->attribute as $attribut)
                                                    <div class="w-full mb-1 md:w-1/4">
                                                        <label class="inline-flex items-center">
                                                            <input type="radio" class="form-radio" name="size"
                                                                value="{{ $attribut->id }}">
                                                            <span
                                                                class="m-4 text-white">{{ $attribut->attribute_value }}</span>
                                                        </label>
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="py-6 mb-6 border-t border-b border-gray-200 dark:border-gray-700">

                            <p class="mt-2 text-sm text-yellow-500 dark:text-yellow-200">
                                <span class="text-gray-600 ">
                                    {!! $singleProduct->description_en !!}
                                </span>
                            </p>
                        </div>
                        {{-- <div class="mb-6 "></div>

                                        <form method="post" action="{{ route('cart.store') }}">
                                            @csrf
                                            <div class="flex flex-wrap items-center mb-6">
                                                <div class="mb-4 mr-4 lg:mb-0">
                                                    <div class="w-28">
                                                        <div class="relative flex flex-row w-full h-10 bg-transparent rounded-lg">
                                                            <button
                                                                class="w-20 h-full text-gray-600 bg-gray-100 border-r rounded-l outline-none cursor-pointer dark:border-gray-700 dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-300">
                                                                <span class="m-auto text-2xl font-thin">-</span>
                                                            </button>
                                                            <input type="number" name="quantity" value="0" min="1"
                                                                id="quantityInput"
                                                                class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-100 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black"
                                                                placeholder="1">
                                                            <button
                                                                class="w-20 h-full text-gray-600 bg-gray-100 border-l rounded-r outline-none cursor-pointer dark:border-gray-700 dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-300">
                                                                <span class="m-auto text-2xl font-thin">+</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="product_id" value="{{ $singleProduct->id }}">
                                                <div class="mb-4 lg:mb-0">
                                                    <button
                                                        class="flex items-center justify-center w-full h-10 p-2 mr-4 text-gray-700 border border-gray-300 lg:w-11 hover:text-gray-50 dark:text-gray-200 dark:border-yellow-600 hover:bg-yellow-600 hover:border-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-500 dark:hover:border-yellow-500 dark:hover:text-gray-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class=" bi bi-heart" viewBox="0 0 16 16">
                                                            <path
                                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <button
                                                    class="w-full px-4 py-3 text-center text-yellow-600 bg-yellow-100 border border-yellow-600 dark:hover:bg-gray-900 dark:text-gray-400 dark:border-gray-700 dark:bg-gray-700 hover:bg-[#0baf9a] hover:text-gray-100 lg:w-1/2 rounded-xl">
                                                    Add to cart
                                                </button>
                                            </div>
                                            <div class="flex gap-4 mb-6">
                                                <button href="#"
                                                    class="w-full px-4 py-3 text-center text-gray-100 bg-[#0baf9a] border border-transparent dark:border-gray-700 hover:border-yellow-500 hover:text-yellow-700 hover:bg-yellow-100 dark:text-gray-400 dark:bg-gray-700 dark:hover:bg-gray-900 rounded-xl">
                                                    Buy now</button>
                                            </div>
                                        </form>
                                </div> --}}
                    </div>
                </div>

            </div>
    </section>

    <script>
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                let input = document.getElementById('quantityInput');
                let value = parseInt(input.value);
                if (this.textContent === '+' && value < 99) {
                    input.value = value + 1;
                } else if (this.textContent === '-' && value > 1) {
                    input.value = value - 1;
                }
            });
        });
    </script>


</x-frontend-layout>
