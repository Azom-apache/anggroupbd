<x-frontend-layout title="Services">
    <div class="container mx-auto py-12 px-6 mt-10">
        <!-- Page Title Section -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold">Image Gallery</h1>
            <p class="text-gray-500 mt-2">HOME / Image</p>
        </div>

        <!-- Image Gallery Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Image 1 -->
            @foreach ($images as $v)
                <div>
                    <img src="{{ $v->image ?? '' }}" alt="Image 8" class="w-full h-60 object-cover rounded-lg shadow-lg">
                </div>
            @endforeach
        </div>
    </div>
</x-frontend-layout>
