<x-frontend-layout title="Products">
    <script src="https://cdn.tailwindcss.com"></script>

<style>
    p {
        color: black !important;
    }
    table {
    color: black;
}
</style>

    <section
        class="sk__animated-header sk__header-y-m dark-shade-7-bg dark-shade-5-border sk__parallax-background-section sk__parallax-fixer-ignore-height"
        style="opacity: 1; transform: translate(0px, 0px);">

        <div class="w-full bg-gray-800 rounded-lg shadow p-16">
             <div >

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
         <!-- Mobile Menu Toggle -->
<div class="md:hidden mb-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold">Menu</h1>
    <button onclick="toggleMenu()" class="p-2 text-white bg-gray-700 rounded">
        <!-- Hamburger Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>

<!-- Tab Buttons -->
<div id="menuButtons" class="hidden md:flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-4 mb-6">
    @foreach ($menus->take(2) as $index => $menu)
        <button onclick="showSection('section-{{ $index }}')"
                class="tab-btn  p-2 bg-gray-500 text-white rounded hover:bg-blue-600 text-left md:text-center">
            {{ $menu->menu_name }}
        </button>
    @endforeach
    <button>
<a href="{{ route('products', ['id' => $sister->id]) }}"
   class="tab-btn flex justify-center items-center p-2  bg-gray-500 text-white rounded hover:bg-blue-600 text-center">
    Products
</a>
    </button>
 
    @foreach ($menus->skip(2) as $index => $menu)
        <button onclick="showSection('section-{{ $index }}')"
                class="tab-btn bg-gray-500 p-2 text-white rounded hover:bg-blue-600 text-left md:text-center">
            {{ $menu->menu_name }}
        </button>
    @endforeach
</div>

<!-- Content Sections -->
@foreach ($menus as $index => $menu)
    <div id="section-{{ $index }}" class="tab-content {{ $index !== 0 ? 'hidden' : '' }} p-6 bg-white rounded ">
        <h2 class="text-2xl text-black font-bold mb-2">{{ $menu->menu_name }}</h2>
      <p class="!text-black">{!! nl2br(e($menu->content)) !!}</p>
<p class="!text-black">{!! $menu->description_en !!}</p>

    </div>
@endforeach

<!-- Scripts -->
<script>
    function toggleMenu() {
        const menu = document.getElementById('menuButtons');
        menu.classList.toggle('hidden');
    }

    function showSection(sectionId) {
        document.querySelectorAll('.tab-content').forEach(div => {
            div.classList.add('hidden');
        });
        document.getElementById(sectionId).classList.remove('hidden');
    }
</script>

            <script>
                function showSection(sectionId) {
                    document.querySelectorAll('.tab-content').forEach(div => {
                        div.classList.add('hidden');
                    });
                    document.getElementById(sectionId).classList.remove('hidden');
                }
            </script>



            {{-- <p>{!! $sister->description !!}</p> --}}

            

            <div>
                <h2 class="text-2xl font-bold text-center text-gray-500">Company Profile</h2>
                @if (!empty($sister->pdf))
                    {{-- PDF Viewer --}}
                    <div class="mb-8 text-center">
                     <a href="{{ asset($sister->pdf) }}" download class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Download PDF
                    </a>
                    </div>
                @endif

            </div>

    </section>
</x-frontend-layout>
