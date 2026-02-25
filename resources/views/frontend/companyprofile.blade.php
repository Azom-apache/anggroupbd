<x-frontend-layout title="CEO Message">
    <!-- Header Section -->
    <div class="bg-black text-white py-16 text-center">
        <h1 class="text-5xl font-bold">Company Profile</h1>
        <p class="mt-2"><a href="/" class="text-gray-300">HOME</a> / <span class="text-gray-500">Company
                Profile</span>
        </p>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto py-16 px-8 flex flex-col lg:flex-row items-center gap-10">
        <!-- Left Text Section -->
        <div class="lg:w-full border-l-4 border-red-600 pl-6">
            <img src="{{ asset('images/pro.png') }}" alt="CEO Image" class="w-full h-auto rounded-lg shadow-lg">
        </div>


    </div>
    <!-- Right Image Section -->
    <div class="lg:w-full justify-center p-4">
        <img src="{{ asset('images/card.png') }}" alt="CEO Image" class="w-full h-auto rounded-lg shadow-lg">
    </div>
</x-frontend-layout>
