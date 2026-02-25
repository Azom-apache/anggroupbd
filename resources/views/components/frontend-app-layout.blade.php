<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartex</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>
<style>
    #navbar {
        z-index: 50;
        /* Ensure navbar stays on top */
    }

    #product-dropdown,
    #product-dropdown-mobile {
        z-index: 100;
        /* Ensure dropdown stays above the navbar and slider */
    }
</style>

<body class="font-sans bg-gray-100">

    <!-- Top Bar (Scrolls and then hides) -->
    <div id="top-bar"
        class="bg-blue-900 text-white text-sm flex justify-between px-6 py-2 w-full z-50 transition-all duration-300">
        <span>info@caretexbd.com</span>
        <span>Hotline: +8801715447215</span>
        <span>
            <div class="gap-2">
                <a rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=https://caretexbd.com/"
                    target="_blank" class="gap-2 woodmart-social-icon social-facebook">
                    <i class="fab fa-facebook-f"></i>

                </a>

                <a rel="nofollow" href="https://twitter.com/share?url=https://caretexbd.com/" target="_blank"
                    class="gap-2 woodmart-social-icon social-twitter">
                    <i class="fab fa-twitter"></i>

                </a>

                <a rel="nofollow"
                    href="https://pinterest.com/pin/create/button/?url=https://caretexbd.com/&media=https://caretexbd.com/wp-includes/images/media/default.svg&description=Home+base"
                    target="_blank" class="gap-2 woodmart-social-icon social-pinterest">
                    <i class="fab fa-pinterest-p"></i>

                </a>

                <a rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=https://caretexbd.com/"
                    target="_blank" class="gap-2 woodmart-social-icon social-linkedin">
                    <i class="fab fa-linkedin-in"></i>

                </a>

                <a rel="nofollow" href="https://telegram.me/share/url?url=https://caretexbd.com/" target="_blank"
                    class="gap-2 woodmart-social-icon social-tg">
                    <i class="fab fa-telegram-plane"></i>

                </a>
            </div>
        </span>



    </div>
    <hr>
    <div>
        <center>
            <a href="https://caretexbd.com/" rel="home">
                <img src="https://caretexbd.com/wp-content/uploads/2021/02/CARE-TEX-BD-logo.png" alt="CARE-TEX BD."
                    class="h-15 w-20 text-center"> </a>
        </center>


    </div>
    <!-- Navbar (Becomes sticky after top bar hides) -->
    <!-- Navbar -->
    <nav id="navbar" class="bg-blue-900 text-white py-4 shadow-lg transition-all duration-300">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <h1 class="text-2xl font-bold text-orange-500">CARE-TEX BD.</h1>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden focus:outline-none" onclick="toggleMenu()">
                ☰
            </button>

            <!-- Desktop Menu -->
            <ul class="hidden lg:flex space-x-6">
                <li><a href="#" class="hover:text-orange-500">Home</a></li>
                <li><a href="#" class="hover:text-orange-500">About</a></li>

                <!-- Product Dropdown (Auto Hover for Desktop, Clickable for Mobile) -->
                <li class="relative group">
                    <button class="hover:text-orange-500 focus:outline-none flex items-center cursor-pointer"
                        onclick="toggleDropdown()">
                        Products
                        <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <ul id="product-dropdown"
                        class="absolute hidden group-hover:block lg:group-hover:block bg-white text-black mt-2 rounded-lg shadow-lg w-48">
                        @foreach (\App\Models\Product::all() as $product)
                            @dd($product)
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-orange-500 hover:text-white">
                                    {{ $product->id }} - {{ $product->name }}
                                </a>
                            </li>
                        @endforeach

                        <li><a href="#" class="block px-4 py-2 hover:bg-orange-500 hover:text-white">Cutting
                                Machines</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-orange-500 hover:text-white">Printing
                                Machines</a></li>
                    </ul>
                </li>

                <li><a href="#" class="hover:text-orange-500">Services</a></li>
                <li><a href="#" class="hover:text-orange-500">Clients</a></li>
                <li><a href="#" class="hover:text-orange-500">Contact Us</a></li>
            </ul>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-blue-800 text-white p-4 space-y-2">
            <a href="#" class="block hover:text-orange-500">Home</a>
            <a href="#" class="block hover:text-orange-500">About</a>
            <a href="#" onclick="toggleDropdown()" class="block hover:text-orange-500">Products</a>
            <ul id="product-dropdown-mobile" class="hidden bg-white text-black mt-2 rounded-lg shadow-lg w-48">
                @foreach (\App\Models\Product::all() as $product)
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-orange-500 hover:text-white">
                            {{ $product->id }} - {{ $product->name }}
                        </a>
                    </li>
                @endforeach
                <li><a href="#" class="block px-4 py-2 hover:bg-orange-500 hover:text-white">Cutting Machines</a>
                </li>
                <li><a href="#" class="block px-4 py-2 hover:bg-orange-500 hover:text-white">Printing Machines</a>
                </li>
            </ul>
            <a href="#" class="block hover:text-orange-500">Services</a>
            <a href="#" class="block hover:text-orange-500">Clients</a>
            <a href="#" class="block hover:text-orange-500">Contact Us</a>
        </div>
    </nav>

    <!-- JavaScript for Navbar Functionality -->
    <script>
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('fixed', 'top-0', 'w-full');
                navbar.style.zIndex = '50';
            } else {
                navbar.classList.remove('fixed', 'top-0', 'w-full');
            }
        });


        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        function toggleDropdown() {
            const dropdown = document.getElementById('product-dropdown');
            const mobileDropdown = document.getElementById('product-dropdown-mobile');
            dropdown.classList.toggle('hidden');
            mobileDropdown.classList.toggle('hidden');
        }
    </script>
    {{ $slot }}
    <!-- Footer Section -->
    <footer class="bg-blue-900 text-white py-12">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-6">
            <div>
                <h3 class="text-xl font-bold mb-4">Company Address</h3>
                <p>CARE-TEX BD.</p>
                <p>123 Textile Street, Dhaka, Bangladesh</p>
                <p>Email: info@caretexbd.com</p>
                <p>Hotline: +8801715447215</p>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Support</h3>
                <ul>
                    <li><a href="#" class="hover:text-orange-500">FAQs</a></li>
                    <li><a href="#" class="hover:text-orange-500">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-orange-500">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-orange-500">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-orange-500">Facebook</a>
                    <a href="#" class="hover:text-orange-500">Twitter</a>
                    <a href="#" class="hover:text-orange-500">Instagram</a>
                </div>
            </div>
        </div>
        <p class="text-center mt-6 text-sm">&copy; 2024 CARE-TEX BD. All Rights Reserved.</p>
    </footer>

</body>

</html>
