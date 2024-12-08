@extends('layouts.app')

@section('title', 'Detail Article')

@section('page-title', 'Detail Article')

@section('content')
    <div class="max-w-auto p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Detail Article</h1>
            <a href="{{ route('article.index') }}"
                class="text-black bg-[#ffc01f] hover:bg-[#a07813] focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                <svg class="w-4 h-4 inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
                Back
            </a>
        </div>
    </div>

    <div class="max-w-auto p-8 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <article class="max-w-4xl mx-auto">
            <!-- Article Header -->
            <header class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    {{ $article->title }}
                </h1>
                
                <!-- Author and Date -->
                <div class="flex items-center mb-6">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr($article->author->name, 0, 1)) }}
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $article->author->name }}
                            </p>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $article->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories and Tags -->
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($article->categories as $category)
                        <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full dark:bg-blue-900 dark:text-blue-300">
                            <svg class="w-3 h-3 inline-block mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16M4 12h16M4 20h16"/>
                            </svg>
                            {{ $category->name }}
                        </span>
                    @endforeach
                    
                    @foreach($article->tags as $tag)
                        <span class="px-3 py-1 text-sm font-medium bg-gray-100 text-gray-800 rounded-full dark:bg-gray-700 dark:text-gray-300">
                            <svg class="w-3 h-3 inline-block mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 12 8 8m4.01 4 4-4m-4 4 4 4m-4-4-4 4"/>
                            </svg>
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </header>

            <!-- Article Content -->
            <div class="prose max-w-none dark:prose-invert mb-8">
                <div class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="border-t dark:border-gray-700 pt-6 mt-8">
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('article.edit', $article->id) }}"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10.8 17.8-6.4 2.1 2.1-6.4m4.3 4.3L19 9a3 3 0 0 0-4-4l-8.4 8.4m4.3 4.3-4.3-4.3m2.1 2.1L15 12"/>
                        </svg>
                        Edit Article
                    </a>
                    
                    <button type="button" id="delete-article" data-id="{{ $article->id }}"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                        </svg>
                        Delete Article
                    </button>
                </div>
            </div>
        </article>
    </div>

    <x-alert-modal />
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let deleteId;

            // Ketika tombol delete diklik
            $('#delete-article').on('click', function(e) {
                e.preventDefault();
                deleteId = $(this).data('id');
                $('#confirmDeleteButton').click();
            });

            // Ketika tombol Yes, I'm sure diklik pada modal konfirmasi
            $('#deleteData').on('click', function() {
                $.ajax({
                    url: `/article/${deleteId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#deleteData').html(`
                            <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                            </svg>
                            Deleting...
                        `).prop('disabled', true);
                    },
                    success: function(response) {
                        if (response.success) {
                            // Tutup modal konfirmasi
                            $('#hiddenButtonDelete').click();

                            $('#alertModal h3').text(response.message);

                            // Update class icon sesuai tipe
                            const iconColor = {
                                success: 'text-green-500',
                                error: 'text-red-500',
                                warning: 'text-yellow-500',
                                info: 'text-blue-500'
                            }[response.type];

                            $('#alertModal .icon-animate svg')
                                .removeClass('text-green-500 text-red-500 text-yellow-500 text-blue-500')
                                .addClass(iconColor);

                            // Tampilkan modal
                            $('#alertModalButton').click();

                            // Redirect setelah 2 detik
                            setTimeout(function() {
                                window.location.href = '{{ route('article.index') }}';
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Terjadi kesalahan saat menghapus data');
                    },
                    complete: function() {
                        $('#deleteData').html('Yes, I\'m sure').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
