<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - The News Dispatch</title>
    <meta name="description" content="{{ Str::limit(strip_tags($article->content), 160) }}">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        @layer utilities {
            .text-shadow {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
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
    </style>
</head>

<body class="bg-gray-50 antialiased" x-data="{ showShare: false }">
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

                <!-- Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    @auth
                        <a href="/dashboard" class="text-sm font-medium hover:text-gray-600">Dashboard</a>
                    @else
                        <a href="/login" class="text-sm font-medium hover:text-gray-600">Log In</a>
                    @endauth
                    <button class="bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800">
                        Subscribe
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="/" class="text-gray-500 hover:text-gray-700">Home</a></li>
                <li class="text-gray-500">/</li>
                @if($article->categories->first())
                    <li><a href="/category/{{ $article->categories->first()->slug }}" 
                          class="text-gray-500 hover:text-gray-700">
                        {{ $article->categories->first()->name }}
                    </a></li>
                    <li class="text-gray-500">/</li>
                @endif
                <li class="text-gray-900">{{ Str::limit($article->title, 40) }}</li>
            </ol>
        </nav>

        <div class="max-w-4xl mx-auto">
            <!-- Article Header -->
            <header class="mb-8">
                <h1 class="text-4xl font-serif font-bold mb-4" data-aos="fade-up">
                    {{ $article->title }}
                </h1>
                
                <div class="flex items-center justify-between py-4 border-y border-gray-200">
                    <div class="flex items-center space-x-4">
                        @if($article->author)
                            <img src="{{ $article->author->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($article->author->name) }}" 
                                 alt="{{ $article->author->name }}"
                                 class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-medium">{{ $article->author->name }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $article->created_at->format('M d, Y') }} • 
                                    {{ $article->read_time ?? '5' }} min read
                                </p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Share Buttons -->
                    <div class="relative">
                        <button @click="showShare = !showShare" 
                                class="p-2 hover:bg-gray-100 rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                        </button>

                        <!-- Share Menu -->
                        <div x-show="showShare" 
                             @click.away="showShare = false"
                             x-transition
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                                Twitter
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                                </svg>
                                Facebook
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                                </svg>
                                LinkedIn
                            </a>
                            <button class="flex items-center px-4 py-2 hover:bg-gray-100 w-full"
                                    onclick="navigator.clipboard.writeText(window.location.href)">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                                </svg>
                                Copy Link
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <figure class="mb-8" data-aos="fade-up">
                <img src="https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8cHJvZ3JhbW1pbmd8ZW58MHx8MHx8fDA%3D" 
                     alt="{{ $article->title }}"
                     class="w-full h-[400px] object-cover rounded-xl">
                @if($article->image_caption)
                    <figcaption class="mt-2 text-sm text-gray-500 text-center">
                        {{ $article->image_caption }}
                    </figcaption>
                @endif
            </figure>

            <!-- Article Content -->
            <article class="prose prose-lg max-w-none mb-12" data-aos="fade-up">
                {!! $article->content !!}
            </article>

            <!-- Tags -->
            @if($article->tags->count() > 0)
                <div class="flex flex-wrap gap-2 mb-8">
                    @foreach($article->tags as $tag)
                        <a href="/tag/{{ $tag->slug }}" 
                           class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm hover:bg-gray-200">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- Author Bio -->
            @if($article->author)
                <div class="border-t border-gray-200 pt-8 mb-12">
                    <div class="flex items-center space-x-4">
                        <img src="{{ $article->author->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($article->author->name) }}" 
                             alt="{{ $article->author->name }}"
                             class="w-16 h-16 rounded-full">
                        <div>
                            <h3 class="font-bold text-lg">{{ $article->author->name }}</h3>
                            @if($article->author->bio)
                                <p class="text-gray-600">{{ $article->author->bio }}</p>
                            @endif
                            <div class="flex space-x-4 mt-2">
                                <a href="#" class="text-blue-600 hover:text-blue-800">Twitter</a>
                                <a href="#" class="text-blue-600 hover:text-blue-800">LinkedIn</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Related Articles -->
            @if(isset($relatedArticles) && $relatedArticles->count() > 0)
                <section class="border-t border-gray-200 pt-8">
                    <h2 class="text-2xl font-serif font-bold mb-6">Related Articles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($relatedArticles as $related)
                            <article class="group" data-aos="fade-up">
                                <a href="{{ route('articles.show', $related->id) }}">
                                    <div class="overflow-hidden rounded-lg mb-4">
                                        <img src="https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8cHJvZ3JhbW1pbmd8ZW58MHx8MHx8fDA%3D" 
                                             alt="{{ $related->title }}"
                                             class="w-full h-48 object-cover transform transition duration-500 group-hover:scale-110">
                                    </div>
                                    <h3 class="font-serif font-bold group-hover:text-blue-600">
                                        {{ $related->title }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-2">
                                        {{ $related->created_at->format('M d, Y') }}
                                    </p>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </main>

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

    <!-- Footer -->
    <footer class="bg-white border-t">
        <div class="container mx-auto px-4 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <h3 class="font-serif font-bold text-2xl mb-4">the news dispatch.</h3>
                    <p class="text-gray-600 mb-4">
                        Delivering the most important news and stories that matter to you.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-black">About Us</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black">Contact</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black">Careers</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-black">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-black">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t mt-12 pt-8 text-center text-gray-600">
                <p>&copy; {{ date('Y') }} The News Dispatch. All rights reserved.</p>
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
</body>
</html>