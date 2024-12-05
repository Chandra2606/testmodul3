<nav class="bg-white shadow-sm">
    <div class="px-6 py-2">
        <div class="flex items-center justify-between">
            <!-- Mobile Toggle -->
            <div class="flex items-center p-2 lg:hidden">
                <button @click="sidebarOpen = true" class="p-1 rounded-md hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Desktop Toggle -->
            <div class="hidden lg:flex items-center p-2">
                <button @click="sidebarOpen = !sidebarOpen" class="p-1 rounded-md hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Right side -->
            <div class="flex items-center ml-auto">
                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 p-1 rounded-md hover:bg-gray-100">
                        <div class="w-7 h-7 bg-gray-200 rounded-full flex items-center justify-center">
                            <img src="{{ asset('images/rc.png') }}" alt="User Avatar" class="w-full h-full object-cover">
                        </div>
                        <span class="text-gray-700">Admin User</span>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                        <div class="border-t border-gray-100"></div>
                        <form method="POST" action="{{'logout'}}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Keluar
                            </button>
                            
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</nav>
