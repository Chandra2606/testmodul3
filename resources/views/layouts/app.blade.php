<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.partials.header')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen bg-gray-100" x-data="{
        sidebarOpen: window.innerWidth >= 1024,
        checkScreenSize() {
            this.sidebarOpen = window.innerWidth >= 1024
        }
    }" x-init="checkScreenSize();
    window.addEventListener('resize', checkScreenSize);">
        <!-- Sidebar Mobile -->
        <div class="lg:hidden">
            <aside
                :class="{
                    'translate-x-0': sidebarOpen,
                    '-translate-x-full': !sidebarOpen
                }"
                class="fixed inset-y-0 left-0 z-40 w-64 transition-transform duration-300 bg-[#1E2532]">

                <button @click="sidebarOpen = false" class="absolute top-4 right-4 text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                @include('layouts.partials.sidebar')
            </aside>

            <!-- Overlay Mobile -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-black bg-opacity-50">
            </div>
        </div>

        <!-- Sidebar Desktop -->
        <div class="hidden lg:block">
            <aside
                :class="{
                    'w-64': sidebarOpen,
                    'w-0': !sidebarOpen
                }"
                class="fixed top-0 left-0 h-full bg-[#1E2532] transition-all duration-300">
                @include('layouts.partials.sidebar')
            </aside>
        </div>

        <!-- Main Content -->
        <div :class="{ 'lg:ml-64': sidebarOpen }" class="flex-1">
            <div class="flex flex-col min-h-screen">
                <!-- Navbar dengan position fixed -->
                <nav class="sticky top-0 z-30 w-full bg-white shadow-sm">
                    @include('layouts.partials.navbar')
                </nav>

                <!-- Main Content Area dengan padding top untuk kompensasi navbar fixed -->
                <main class="flex-1 p-4 lg:p-6 pt-16">
                    @yield('content')
                </main>

                <!-- Footer -->
                @include('layouts.partials.footer')
            </div>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
@stack('scripts')


</body>

</html>
