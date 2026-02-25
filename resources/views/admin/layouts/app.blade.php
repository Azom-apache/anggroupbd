<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
   

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/datatable.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-200" x-data="{ sidebarOpen: window.innerWidth >= 1024, width: window.innerWidth }" @resize.window="width = window.innerWidth"
        x-init="window.addEventListener('resize', () => { sidebarOpen = window.innerWidth >= 1024 });
        $watch('sidebarOpen', open => { document.body.style.overflow = open ? 'hidden' : 'auto' })">
        @include('admin.layouts.navigation')

        <template x-if="sidebarOpen && width < 1024">
            <div>
                <div @click.slef="sidebarOpen = false"
                    class="absolute z-0 top-0 bottom-0 right-0 left-0 bg-gray-500 opacity-50"></div>
            </div>
        </template>

        <div class="flex flex-col flex-grow">
            <header class="w-full flex-grow-0">
                <div class="w-full flex justify-between items-center bg-white border-b border-gray-200 p-3"
                    x-bind:class="sidebarOpen ? 'overflow-hidden' : ''">
                    <svg xmlns="http://www.w3.org/2000/svg" @click="sidebarOpen = true"
                        class="h-6 w-6 cursor-pointer text-gray-600 lg:hidden" fill="currentColor" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <div class="flex-grow flex justify-end items-center gap-2">
                        {{-- <button class="p-2 rounded-full bg-gray-100 hover:bg-gray-200">
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 16 16"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                class="text-gray-500"
                                fill="currentColor"
                                d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z"
                            ></path>
                            <path
                                class="text-gray-400"
                                fill="currentColor"
                                d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z"
                            ></path>
                        </svg>
                    </button>
                    <button class="p-2 rounded-full bg-gray-100 hover:bg-gray-200">
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 16 16"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                class="fill-current text-gray-500"
                                d="M6.5 0C2.91 0 0 2.462 0 5.5c0 1.075.37 2.074 1 2.922V12l2.699-1.542A7.454 7.454 0 006.5 11c3.59 0 6.5-2.462 6.5-5.5S10.09 0 6.5 0z"
                            ></path>
                            <path
                                class="fill-current text-gray-400"
                                d="M16 9.5c0-.987-.429-1.897-1.147-2.639C14.124 10.348 10.66 13 6.5 13c-.103 0-.202-.018-.305-.021C7.231 13.617 8.556 14 10 14c.449 0 .886-.04 1.307-.11L15 16v-4h-.012C15.627 11.285 16 10.425 16 9.5z"
                            ></path>
                        </svg>
                    </button>
                    <button class="p-2 rounded-full bg-gray-100 hover:bg-gray-200">
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 16 16"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                class="fill-current text-gray-500"
                                d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"
                            ></path>
                        </svg>
                    </button>
                    <div class="h-5 border-r border-gray-300 ml-1 mr-2"></div> --}}
                    </div>
                    <div class="relative" x-data="{ dropped: false }" x-cloak x-on:click.outside="dropped = false">
                        <div class="flex items-center pl-2 mr-2 cursor-pointer" x-on:click="dropped = !dropped">
                            <img src="{{ auth()->user()->avatar ?? asset('images/avatar.png') }}" alt="Avatar of {{ auth()->user()->name }}"
                                class="h-8 w-8 rounded-full" />
                            <div class="text-gray-500 font-semibold mx-1 ml-4">{{ auth()->user()->name }}</div>
                            <svg class="w-3 h-3 fill-current text-gray-400 ml-2" viewBox="0 0 12 12">
                                <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z"></path>
                            </svg>
                        </div>
                        <div class="w-48 fixed top-16 right-0 bg-white rounded-b shadow-lg" x-show="dropped"
                            x-transition:enter="transition origin-top ease-out duration-100"
                            x-transition:enter-start="opacity-0 scale-y-0"
                            x-transition:enter-end="opacity-100 scale-y-100"
                            x-transition:leave="transition origin-top ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-y-100"
                            x-transition:leave-end="opacity-0 scale-y-0">
                            <a href="{{ route('admin.profile.edit') }}"
                                class="block w-full p-2 cursor-pointer hover:bg-slate-200 ">
                                {{ __('Profile') }}
                            </a>
                            <div class="block w-full p-2 cursor-pointer hover:bg-slate-200">
                                <form class="w-full" method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button class="w-full text-start">{{ __('Log Out') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <main class="flex-grow lg:ml-64">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-2 sm:px-2 lg:px-4">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                @if (session(\App\Mixin\ResponseMixin::SUCCESS_MESSAGE_SESSION_KEY))
                    <x-alert
                        type="success">{{ session(\App\Mixin\ResponseMixin::SUCCESS_MESSAGE_SESSION_KEY) }}</x-alert>
                @endif
                @if (session(\App\Mixin\ResponseMixin::ERROR_MESSAGE_SESSION_KEY))
                    <x-alert
                        type="error">{{ session(\App\Mixin\ResponseMixin::ERROR_MESSAGE_SESSION_KEY) }}</x-alert>
                @endif
                <div class="w-full">
                    {{ $slot }}
                </div>
            </main>
            <footer class="w-full p-2 text-center">
                Copyright {{ date('Y') }}
            </footer>
            <script type="text/javascript">
                window.onload = () => {
                    const url = location.href.indexOf('?') > 0 ?
                        location.href.substring(0, location.href.indexOf('?')) :
                        location.href;
                    document.querySelector('.nav-links').querySelectorAll("a").forEach(element => {
                        if (element.href === url) {
                            element.classList.add('active')
                        }
                    })
                    document.querySelectorAll("a.active").forEach(element => {
                        element.classList.remove('border-transparent')
                        element.classList.add('border-teal-400')
                        element.dispatchEvent(
                            new CustomEvent("active", {
                                bubbles: true,
                            })
                        );
                    });
                };
            </script>
            <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
            <style>
                .cke_notification_warning {
                    display: none;
                }
            </style>
            <script>
                CKEDITOR.replace(document.querySelector('[is-editor="is-editor"]'));
                CKEDITOR.replace(document.querySelector('[is-editor2="is-editor2"]'));
                CKEDITOR.replace(document.querySelector('[is-editor3="is-editor3"]'));
                CKEDITOR.replace(document.querySelector('[is-editor4="is-editor4"]'));
                CKEDITOR.replace(document.querySelector('[is-editor5="is-editor5"]'));
                CKEDITOR.replace(document.querySelector('[is-editor6="is-editor6"]'));
                CKEDITOR.replace(document.querySelector('[is-editor7="is-editor7"]'));
                CKEDITOR.replace('editor1');
                CKEDITOR.replace('editor2');
                CKEDITOR.replace('editor3');
                CKEDITOR.replace('editor4');
                CKEDITOR.replace('editor5');
                CKEDITOR.replace('editor6');
                CKEDITOR.replace('editor7');
            </script>
            {{ $script ?? '' }}
        </div>
    </div>

</body>

</html>
