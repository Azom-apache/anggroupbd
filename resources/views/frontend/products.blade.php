   <script src="https://cdn.tailwindcss.com"></script>
<x-frontend-layout title="Products">
 
<style>
    p {
        color: black !important;
    }
</style>

    <section
        class="text black sk__animated-header sk__header-y-m dark-shade-7-bg dark-shade-5-border sk__parallax-background-section sk__parallax-fixer-ignore-height"
        style="opacity: 1; transform: translate(0px, 0px);">

        <div class="w-full bg-gray-800 rounded-lg shadow p-16">
            <div>

                @if (!empty($sister->image))
                    @php
                        $extension = pathinfo($sister->image, PATHINFO_EXTENSION);
                    @endphp

                    @if (strtolower($extension) === 'pdf')
                        {{-- PDF Viewer --}}
                        <div class="mb-8 text-center">
                            <iframe src="{{ asset($sister->image) }}" width="100%" height="60px"
                                class="mx-auto border rounded shadow"></iframe>
                        </div>
                    @else
                        {{-- Image Viewer --}}
                        <div class="mb-8 text-center">
                            <img src="{{ asset($sister->image) }}" alt="Image"
                                class="mx-auto max-w-full h-32 rounded shadow">
                        </div>
                    @endif
                @endif

            </div>
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-500">{{ $sister->name ?? '' }}</h2>
            </div>
            <!-- Buttons -->
            <!-- Responsive Menu Buttons -->
            <!-- Mobile Toggle Button -->
            <div class="md:hidden mb-4 flex justify-between items-center ">
                <h1 class="text-xl font-semibold">Menu</h1>
                <button onclick="toggleMenu()" class="p-2 text-white bg-gray-700 rounded">
                    <!-- Hamburger SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Menu Items -->
            <div id="menuButtons" class="hidden md:flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4 mb-6">
          
    @foreach ($menus->take(2) as $index => $menu)
      <button>
        <a href="{{ route('sister', ['id' => $sister->id]) }}"
           class="tab-btn flex justify-center items-center px-2 py-2 bg-gray-500 text-white rounded hover:bg-blue-600 text-center">
            {{ $menu->menu_name }}
        </a>
      </button>
    @endforeach
  <button>
    <a href="{{ route('products', ['id' => $sister->id]) }}"
       class="tab-btn flex justify-center items-center px-2 py-2 bg-gray-500 text-white rounded hover:bg-blue-600 text-center">
        Products
    </a>
  </button>
    @foreach ($menus->skip(2) as $index => $menu)
      <button>
        <a href="{{ route('sister', ['id' => $sister->id]) }}"
           class="tab-btn flex justify-center items-center px-2 py-2 bg-gray-500 text-white rounded hover:bg-blue-600 text-center">
            {{ $menu->menu_name }}
        </a>
      </button>
    @endforeach
</div>


            <!-- Responsive Product Grid -->
           <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach ($products as $product)
    <div class="bg-white rounded shadow p-4 relative group overflow-hidden">
      
       <a href="{{ route('singleProduct', ['id' => $product->id]) }}">
        <img src="{{ $product->image ?? '' }}" alt="Product Image"
            class="w-full h-72 object-cover mb-2 transition duration-300 group-hover:opacity-30">
       </a>

       <h2 class="text-xl font-bold mb-2 text-gray-500">{{ $product->name_en }}</h2>

        <!-- Description overlay (does not block clicks) -->
        <div class="absolute inset-0 bg-white bg-opacity-90 opacity-0 group-hover:opacity-100 transition duration-300 p-4 overflow-y-auto pointer-events-none">
            <p class="text-gray-700 text-sm">{!! $product->description_en ?? 'na' !!}</p>
        </div>
    </div>
@endforeach

</div>


            <!-- Toggle Script -->
            <script>
                function toggleMenu() {
                    const menu = document.getElementById('menuButtons');
                    menu.classList.toggle('hidden');
                }
            </script>

            <!-- Content Sections -->

            <script>
                function showSection(sectionId) {
                    document.querySelectorAll('.tab-content').forEach(div => {
                        div.classList.add('hidden');
                    });
                    document.getElementById(sectionId).classList.remove('hidden');
                }
            </script>



            {{-- <p>{!! $sister->description !!}</p> --}}

<br>

            <div class="mt-10">
                <h2 class="text-2xl font-bold text-center text-gray-500">Company Profile</h2>
                @if (!empty($sister->pdf))
                    {{-- PDF Viewer --}}
                    <div class="mb-8 text-center">
                        <a href="{{ asset($sister->pdf) }}" download
                            class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Download PDF
                        </a>
                    </div>
                @endif

            </div>

    </section>
</x-frontend-layout>
