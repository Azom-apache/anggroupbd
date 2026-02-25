<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Your E-commerce Store</title>
</head>

<body class="bg-gray-100">

    <!-- Navigation -->
    <nav class="bg-blue-500 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-lg font-bold">Your Store</a>
            <ul class="flex space-x-4">
                <li><a href="#" class="text-lg font-bold hover:text-gray-300">Home</a></li>
                <li><a href="#" class="text-lg font-bold hover:text-gray-300">Shop</a></li>
                <li><a href="#" class="text-lg font-bold hover:text-gray-300">Contact</a></li>

                @if (Route::has('login'))

                    @auth
                        <li> <a href="{{ url('/dashboard') }}"
                                class="text-lg font-bold hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        </li>
                    @else
                        <li> <a href="{{ route('login') }}"
                                class="text-lg font-bold hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                in</a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}"
                                    class=" text-lg font-bold hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            </li>
                        @endif
                    @endauth

                @endif


                <li class="relative">
                    <a href="#" class="hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            version="1.1" width="36" height="36" viewBox="0 0 256 256" xml:space="preserve">

                            <defs>
                            </defs>
                            <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                <path
                                    d="M 72.975 58.994 H 31.855 c -1.539 0 -2.897 -1.005 -3.347 -2.477 L 15.199 13.006 H 3.5 c -1.933 0 -3.5 -1.567 -3.5 -3.5 s 1.567 -3.5 3.5 -3.5 h 14.289 c 1.539 0 2.897 1.005 3.347 2.476 l 13.309 43.512 h 36.204 l 10.585 -25.191 h -6.021 c -1.933 0 -3.5 -1.567 -3.5 -3.5 s 1.567 -3.5 3.5 -3.5 H 86.5 c 1.172 0 2.267 0.587 2.915 1.563 s 0.766 2.212 0.312 3.293 L 76.201 56.85 C 75.655 58.149 74.384 58.994 72.975 58.994 z"
                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                    transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                <circle cx="28.88" cy="74.33" r="6.16"
                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                    transform="  matrix(1 0 0 1 0 0) " />
                                <circle cx="74.59" cy="74.33" r="6.16"
                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                    transform="  matrix(1 0 0 1 0 0) " />
                                <path
                                    d="M 62.278 19.546 H 52.237 V 9.506 c 0 -1.933 -1.567 -3.5 -3.5 -3.5 s -3.5 1.567 -3.5 3.5 v 10.04 h -10.04 c -1.933 0 -3.5 1.567 -3.5 3.5 s 1.567 3.5 3.5 3.5 h 10.04 v 10.04 c 0 1.933 1.567 3.5 3.5 3.5 s 3.5 -1.567 3.5 -3.5 v -10.04 h 10.041 c 1.933 0 3.5 -1.567 3.5 -3.5 S 64.211 19.546 62.278 19.546 z"
                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                    transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            </g>
                        </svg>

                    </a>
                    <!-- Cart Preview -->

                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gray-800 text-white py-16">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to Your Store</h1>
            <p class="text-lg mb-8">Discover amazing products at great prices.</p>
            <a href="#" class="bg-yellow-500 text-gray-800 px-6 py-2 rounded-full hover:bg-yellow-400">Shop
                Now</a>
        </div>

    </div>

    <!-- Featured Products Section -->
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Featured Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <!-- Product Cards go here -->
            <!-- Example Product Card -->
            <div class="bg-white p-4 shadow-md rounded-md">
                <img src="data:image/jpeg;base64,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"
                    alt="Product Image" class="w-full h-32 object-cover mb-4">
                <h3 class="text-lg font-bold mb-2">Product Name</h3>
                <p class="text-gray-600 mb-2">Description of the product.</p>
                <p class="text-blue-500 font-bold">$19.99</p>
                <button class="bg-blue-500 text-white px-4 py-2 mt-4 rounded-full hover:bg-blue-400">Add to
                    Cart</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Your Store. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
