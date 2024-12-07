@extends('layouts.app')

@section('title', 'Add User')

@section('page-title', 'Add User')

@section('content')
    <div class="max-w-auto p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Add User</h1>
            <a href="{{ route('users.index') }}"
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

    <div
        class="max-w-auto p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">


        <form class="max-w-sm mx-auto">
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Name</label>
                <input type="text" id="name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                <p class="mt-2 text-sm text-red-600 dark:text-red-500" id="name-error"></p>
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Email</label>
                <input type="email" id="email"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                <p class="mt-2 text-sm text-red-600 dark:text-red-500" id="email-error"></p>
                
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    password</label>
                <input type="password" id="password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                <p class="mt-2 text-sm text-red-600 dark:text-red-500" id="password-error"></p>
            </div>
            <div class="mb-5">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat
                    password</label>
                <input type="password" id="password_confirmation"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                <p class="mt-2 text-sm text-red-600 dark:text-red-500" id="password_confirmation-error"></p>
            </div>

            <div class="flex justify-end">
                <button id="save-user"
                    class="text-white justify-self-end bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4 inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 12v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h6m5 4v3m0 0v3m0-3h3m-3 0h-3" />
                    </svg>
                    Save User</button>
            </div>

        </form>
    <x-alert-modal />

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            function showError(fieldId, message) {
                $(`#${fieldId}`).addClass(
                    'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500'
                    );
                $(`#${fieldId}-error`).text(message);
            }

            function clearError(fieldId) {
                $(`#${fieldId}`).removeClass(
                    'bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500'
                    );
                $(`#${fieldId}-error`).text('');
            }


            $('#save-user').on('click', function(e) {
                e.preventDefault();

                // Clear previous errors
                ['name', 'email', 'password', 'password_confirmation'].forEach(field => clearError(field));

                let formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '{{ route('users.store') }}',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save-user').html(`
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                        Saving...
                    `).prop('disabled', true);
                    },
                    complete: function() {
                        $('#save-user').html(`<svg class="w-4 h-4 inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h6m5 4v3m0 0v3m0-3h3m-3 0h-3"/>
                    </svg>
                    Save User`).prop('disabled', false);
                    },
                    success: function(response) {
                        if (response.success) {
                       // Update pesan dan tipe modal sesuai response
                            $('#alertModal h3').text(response.message);
                            
                            // Update class icon sesuai tipe
                            const iconColor = {
                                success: 'text-green-500',
                                error: 'text-red-500',
                                warning: 'text-yellow-500',
                                info: 'text-blue-500'
                            }[response.type];
                            
                            $('#alertModal .icon-animate svg').removeClass(
                                    'text-green-500 text-red-500 text-yellow-500 text-blue-500')
                                .addClass(iconColor);
                            
                            // Tampilkan modal
                            $('#alertModalButton').click();
                            
                            // Redirect setelah 2 detik
                            setTimeout(function() {
                                window.location.href = '{{ route('users.index') }}';
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            for (let field in errors) {
                                showError(field, errors[field][0]);
                            }
                        } else {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    }



                });
            });
        });
    </script>
@endpush
