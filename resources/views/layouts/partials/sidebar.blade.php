<aside class="h-screen flex flex-col overflow-hidden ">
    <!-- Logo -->
    <div class="flex items-center space-x-3 px-6 py-5  whitespace-nowrap">
        <img src="{{ asset('images/rc.png') }}" alt="Logo" class="w-8 h-8">
        <span class="text-white text-lg font-medium">Rafi Chandra</span>
    </div>
    

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto py-4">
        <ul class="space-y-1 px-3">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 {{ request()->routeIs('dashboard') ? 'bg-[#ffc01f] text-black' : 'text-gray-300 hover:bg-[#171C28]' }} rounded-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </li>

            <!-- Users -->
            <li>
                <a href="{{ 'users' }}" class="flex items-center px-3 py-2 {{ request()->routeIs('users.*') ? 'bg-[#ffc01f] text-black' : 'text-gray-300 hover:bg-[#171C28]' }} rounded-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Users
                </a>
            </li>

            <!-- Pengaturan -->
            <li>
                <a href="" class="flex items-center px-3 py-2 {{ request()->routeIs('settings') ? 'bg-[#ffc01f] text-black' : 'text-gray-300 hover:bg-[#171C28]' }} rounded-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Pengaturan
                </a>
            </li>
        </ul>
    </nav>

  
    <div class="border-t border-[#171C28] p-4 whitespace-nowrap">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                <span class="text-gray-600 text-sm font-medium">AU</span>
            </div>
            <div class="flex-1">
                <p class="text-sm text-gray-300 font-medium">Admin User</p>
                <p class="text-xs text-gray-500">admin@example.com</p>
            </div>
        </div>
    </div>
</aside>
