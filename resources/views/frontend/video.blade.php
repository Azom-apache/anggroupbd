<x-frontend-layout title="Services">
    <div class="container mx-auto py-12 px-6 mt-10">
        <!-- Page Title Section -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold">Video</h1>
            <p class="text-gray-500 mt-2">HOME / Video</p>
        </div>

        <!-- YouTube Videos Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <!-- Video 1 -->
            @foreach ($videos as $v)
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $v->video ?? '' }}" frameborder="0"
                        allowfullscreen></iframe>
                </div>
            @endforeach
        </div>
    </div>
</x-frontend-layout>
