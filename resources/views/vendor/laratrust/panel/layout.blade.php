<x-admin-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <div class="text-xl">@yield('title')</div>
        </div>
    </x-slot>

    <main>
        <div class="max-w-6xl mx-auto py-6 sm:px-6 lg:px-8">
            @foreach ([
    'error' => 'p-2 bg-red-400 rounded-lg',
    'warning' => 'p-2 bg-yellow-400 rounded-lg',
    'success' => 'p-2 bg-green-400 rounded-lg',
    ] as $msg => $class)
                @if(Session::has('laratrust-' . $msg))
                    <div class="{{ $class }}" role="alert" x-data x-init="setTimeout(() => { $root.remove(); }, 2000)">
                        <p>{{ Session::get('laratrust-' . $msg) }}</p>
                    </div>
                @endif
            @endforeach
            <div class="px-4 py-6 sm:px-0">
                @yield('content')
            </div>
        </div>
    </main>
</x-admin-app-layout>
