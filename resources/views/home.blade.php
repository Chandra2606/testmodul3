<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="The News Dispatch - Your trusted source for latest news and stories">
    <title>The News Dispatch - Latest News & Stories</title>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="{{ asset('js/imagerandom.js') }}" defer></script>
    <style>
        [x-cloak] { 
            display: none !important; 
        }
    </style>

    <!-- Custom Styles -->
    <style>
        @layer utilities {
            .text-shadow {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            }

            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }

            .card-hover {
                @apply transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg;
            }
        }

        /* Smooth transitions */
        * {
            @apply transition-colors duration-200;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            @apply w-2;
        }

        ::-webkit-scrollbar-track {
            @apply bg-gray-100;
        }

        ::-webkit-scrollbar-thumb {
            @apply bg-gray-300 rounded-full hover:bg-gray-400;
        }

        [x-cloak] { 
            display: none !important; 
        }
    </style>
</head>

<body class="bg-gray-50 antialiased" x-data="{ isMenuOpen: false, showSearch: false, showModal: false }" x-on:keydown.escape.window="showModal = false">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md shadow-sm">
        <nav class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex-shrink-0">
                    <h1 class="font-serif font-bold text-2xl leading-tight hover:text-gray-600">
                        the news<br>dispatch.
                    </h1>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <button @click="showSearch = !showSearch" class="p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    @auth
                        <a href="/dashboard" class="text-sm font-medium hover:text-gray-600">Dashboard</a>
                    @else
                        <a href="/login" class="text-sm font-medium hover:text-gray-600">Log In</a>
                    @endauth
                    <button @click="showModal = true"
                        class="bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800 active:scale-95 transform transition">
                        Subscribe
                    </button>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="isMenuOpen = !isMenuOpen" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Search Bar (Hidden by default) -->
            <div x-show="showSearch" x-transition
                class="absolute inset-x-0 top-full bg-white border-t border-gray-100 p-4">
                <div class="container mx-auto">
                    <input type="search" placeholder="Search articles..."
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-black/5">
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="isMenuOpen" x-transition class="md:hidden border-t border-gray-100">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="/signin" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">
                        Sign In
                    </a>
                    <button @click="showModal = true"
                        class="w-full text-left px-3 py-2 rounded-md text-base font-medium hover:bg-gray-100">
                        Subscribe
                    </button>
                </div>
            </div>
        </nav>

        <!-- Categories -->
        <div class="border-t border-gray-100">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="overflow-x-auto scrollbar-hide">
                    <ul class="flex space-x-8 py-4 text-sm font-medium">
                        @foreach ($categories as $cat)
                            <li><a href="#{{ strtolower($cat->name) }}"
                                    class="hover:text-gray-600">{{ strtoupper($cat->name) }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        <!-- Hero Section -->
        <section class="container mx-auto px-4 lg:px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Featured Article -->
                @if ($articles->first())
                    <article class="lg:col-span-2 group" data-aos="fade-up">
                        <div class="relative overflow-hidden rounded-xl aspect-[16/9]">
                            <img src="{{ $articles->first()->image_url ?? 'https://images.unsplash.com/photo-1499673610122-01c7122c5dcb?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fHByb2dyYW1taW5nfGVufDB8fDB8fHww' }}"
                                alt="{{ $articles->first()->title }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                                <div class="absolute bottom-0 p-6">
                                    <span class="text-white/80 text-sm font-medium">FEATURED</span>
                                    <h2 class="text-white text-2xl md:text-3xl font-serif font-bold mt-2 text-shadow">
                                        <a href="{{ route('articles.show', $articles->first()->id) }}">
                                            {{ $articles->first()->title }}
                                        </a>
                                    </h2>
                                    <p class="text-white/90 mt-2 text-sm">
                                        By {{ $articles->first()->author->name ?? 'Anonymous' }} •
                                        {{ $articles->first()->created_at->diffForHumans() }}
                                        {{-- {{ $articles->first()->read_time ?? '5' }} min read --}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endif

                <!-- Trending Articles -->
                <div class="space-y-6" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="font-serif text-xl font-bold">Trending Now</h3>
                    <div class="space-y-6">
                        @foreach ($articles->skip(1) as $index => $article)
                            <article class="group cursor-pointer">
                                <div class="flex gap-4 items-start">
                                    <span
                                        class="text-3xl font-serif text-gray-200 group-hover:text-black">0{{ $index + 1 }}</span>
                                    <div class="space-y-1">
                                        @if ($article->categories->first())
                                            <span
                                                class="text-xs font-bold text-blue-600">{{ strtoupper($article->categories->first()->name) }}</span>
                                        @endif
                                        <h4 class="font-serif font-bold group-hover:text-blue-600">
                                            <a href="{{ route('articles.show', $article->id) }}">
                                                {{ $article->title }}
                                            </a>
                                        </h4>
                                        {{-- <p class="text-sm text-gray-600">{{ $article->read_time ?? '5' }} min read</p> --}}
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Article Slider Section -->
        <div class="container mx-auto px-4 lg:px-8 py-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-serif font-bold">Latest Articles</h2>
                <a href="#" class="text-blue-600 hover:text-blue-800">View All</a>
            </div>

            @if ($articles->count() > 0)
                <div class="flex overflow-x-auto gap-8 pb-8 snap-x scrollbar-hide">
                    @foreach ($articles as $article)
                        <article class="group card-hover flex-none w-[300px] md:w-[400px] snap-start"
                            data-aos="fade-up">
                            <div class="overflow-hidden rounded-xl aspect-[4/3] mb-4">
                                <img src="https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8cHJvZ3JhbW1pbmd8ZW58MHx8MHx8fDA%3D"
                                    alt="{{ $article->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500 article-image"
                                    loading="lazy">
                            </div>

                            <div class="space-y-3">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($article->categories as $category)
                                        <span
                                            class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                            <svg class="w-3 h-3 inline-block mr-1" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4h16M4 12h16M4 20h16" />
                                            </svg>
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>

                                <h3 class="font-serif font-bold text-xl group-hover:text-blue-600 line-clamp-2">
                                    <a href="{{ route('articles.show', $article->id) }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-600 text-sm line-clamp-3">
                                    {{ Str::limit(strip_tags($article->content), 150) }}
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-2">
                                        @if ($article->author)
                                            <span>By {{ $article->author->name }}</span>
                                        @endif
                                        @if ($article->read_time)
                                            <span class="mx-2">•</span>
                                            <span>{{ $article->read_time }} min read</span>
                                        @endif
                                    </div>

                                    <span>{{ $article->created_at->diffForHumans() }}</span>
                                </div>


                                @if ($article->tags->count() > 0)
                                    <div class="flex flex-wrap gap-2 pt-2">
                                        @foreach ($article->tags as $tag)
                                            <span
                                                class="px-3 py-1 text-sm font-medium bg-gray-100 text-gray-800 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                                <svg class="w-3 h-3 inline-block mr-1" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M12.01 12 8 8m4.01 4 4-4m-4 4 4 4m-4-4-4 4" />
                                                </svg>
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif  
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    No articles found.
                </div>
            @endif
        </div>

        <!-- Newsletter Section -->
        <section class="bg-black text-white py-16">
            <div class="container mx-auto px-4 lg:px-8 text-center">
                <div class="max-w-2xl mx-auto">
                    <h2 class="text-3xl font-serif font-bold mb-4">Stay Updated</h2>
                    <p class="text-gray-400 mb-8">
                        Get the latest news delivered directly to your inbox. Subscribe to our newsletter.
                    </p>
                    <form class="flex gap-4 max-w-md mx-auto">
                        <input type="email" placeholder="Enter your email"
                            class="flex-1 px-4 py-2 rounded-lg bg-white/10 border border-white/20 
                                   text-white placeholder-gray-400 focus:outline-none focus:ring-2 
                                   focus:ring-white/50">
                        <button type="submit"
                            class="px-6 py-2 bg-white text-black rounded-lg hover:bg-gray-100 
                                   active:scale-95 transform transition">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t">
        <div class="container mx-auto px-4 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <h3 class="font-serif font-bold text-2xl mb-4">the news dispatch.</h3>
                    <p class="text-gray-600 mb-4">
                        Delivering the most important news and stories that matter to you.
                    </p>
                    <div class="flex space-x-4">
                        <!-- Social Icons -->
                        <a href="#" class="text-gray-400 hover:text-black">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <!-- Twitter icon path -->
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-gray-600 hover:text-black">About Us</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-600 hover:text-black">Contact</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-600 hover:text-black">Careers</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-gray-600 hover:text-black">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-600 hover:text-black">Terms of Service</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-600 hover:text-black">Cookie Policy</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t mt-12 pt-8 text-center text-gray-600">
                <p>&copy; 2024 The News Dispatch. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Initialize AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    </script>

    <!-- Modal Backdrop -->
    <div x-show="showModal" 
         class="fixed inset-0 bg-black/50 z-50"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    <!-- Modal Content -->
    <div x-show="showModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">

        <div class="bg-white rounded-xl shadow-xl max-w-md w-full relative" @click.away="showModal = false">
            <!-- Close Button -->
            <button @click="showModal = false" class="absolute right-4 top-4 text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <div class="p-6" x-data="{ submitted: false }">
                <!-- Before Submit -->
                <div x-show="!submitted">
                    <h3 class="text-2xl font-serif font-bold mb-4">Subscribe to Our Newsletter</h3>
                    <p class="text-gray-600 mb-6">Get the latest news and updates delivered directly to your inbox.</p>

                    <form @submit.prevent="submitted = true" class="space-y-4">
                        <input type="email" required placeholder="Enter your email address"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-black/5">
                        <button type="submit"
                            class="w-full bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800 active:scale-95 transform transition">
                            Subscribe Now
                        </button>
                    </form>
                </div>

                <!-- After Submit -->
                <div x-show="submitted" x-transition>
                    <div class="text-center py-8">
                        <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-2xl font-serif font-bold mb-2">Thank You!</h3>
                        <p class="text-gray-600">You've successfully subscribed to our newsletter.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
