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
            <!-- Author -->
            <li>
                <a href="{{ route('author.index') }}" class="flex items-center px-3 py-2 {{ request()->routeIs('author.*') ? 'bg-[#ffc01f] text-black' : 'text-gray-300 hover:bg-[#171C28]' }} rounded-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Author
                </a>
            </li>
            <!-- Category -->
            <li>
                <a href="{{ route('category.index') }}" class="flex items-center px-3 py-2 {{ request()->routeIs('category.*') ? 'bg-[#ffc01f] text-black' : 'text-gray-300 hover:bg-[#171C28]' }} rounded-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Category
                </a>
            </li>
            <!-- Tag -->
            <li>
                <a href="{{ route('tag.index') }}" class="flex items-center px-3 py-2 {{ request()->routeIs('tag.*') ? 'bg-[#ffc01f] text-black' : 'text-gray-300 hover:bg-[#171C28]' }} rounded-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z M6 6h.008v.008H6V6z"/>
                    </svg>
                    Tag
                </a>
            </li>
            <!-- Article -->
            <li>
                <a href="{{ route('article.index') }}" class="flex items-center px-3 py-2 {{ request()->routeIs('article.*') ? 'bg-[#ffc01f] text-black' : 'text-gray-300 hover:bg-[#171C28]' }} rounded-md">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    Article
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
