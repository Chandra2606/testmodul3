@extends('layouts.app')

@section('title', 'Manage Category')

@section('page-title', 'Category Overview')

@section('content')

    <div class="max-w-auto p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Manage Category</h1>
            <button data-modal-target="modalAddCategory" data-modal-toggle="modalAddCategory" id="modalAddCategoryButton"
                class="text-black bg-[#ffc01f] hover:bg-[#a07813] focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                <svg class="w-4 h-4 inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 8h6m-3 3V5m-6-.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                </svg>
                Add Category
            </button>
        </div>
    </div>


    <div class="max-w-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <table id="category-table">
            <thead>
                <tr>
                    <th data-sortable="true" data-type="number">No</th>
                    <th data-sortable="true" data-type="string">Name</th>
                    <th data-sortable="false">Action</th>
                </tr>
            </thead>
            
            <tbody>
                
            </tbody>
        </table>
    </div>


    <x-alert-modal />
    <x-category-modal />

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

            $('#modalAddCategoryButton').on('click', function(e) {
                $('#name').val('');
            });

                $('#save-category').on('click', function(e) {
                e.preventDefault();

                // Clear previous errors
                ['name'].forEach(field => clearError(field));

                let formData = {
                    name: $('#name').val(),
                };

                $.ajax({
                    type: 'POST',
                    url: '{{ route('category.store') }}',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save-category').html(`
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                        Saving...
                    `).prop('disabled', true);
                    },
                    
                    success: function(response) {
                        if (response.success) {
                            // Tutup modal

                            DataTableUtils.refreshTable('category-table')
                                .then(() => {
                                    $('#modalAddCategory').click();

                                    $('#alertModal h3').text(response.message);

                                    // Update class icon sesuai tipe
                                    const iconColor = {
                                        success: 'text-green-500',
                                        error: 'text-red-500',
                                        warning: 'text-yellow-500',
                                        info: 'text-blue-500'
                                    } [response.type];

                                    $('#alertModal .icon-animate svg').removeClass(
                                            'text-green-500 text-red-500 text-yellow-500 text-blue-500'
                                            )
                                        .addClass(iconColor);

                                    // Tampilkan modal
                                    $('#alertModalButton').click();
                                })
                                .catch((error) => {
                                    console.error('Gagal merefresh tabel:', error);
                                });


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
                    },
                    complete: function() {
                        $('#save-category').html(`<svg class="w-4 h-4 inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h6m5 4v3m0 0v3m0-3h3m-3 0h-3"/>
                    </svg>
                    Save Category`).prop('disabled', false);
                    },
                });
            });

            let deleteId;
            $(document).on('click', 'a[href*="/category/"][href$="/delete"]', function(e) {
                e.preventDefault();
                deleteId = $(this).attr('href').split('/')[2];
                $('#confirmDeleteButton').click();
            });

            $('#deleteData').on('click', function() {
                $.ajax({
                    url: `/category/${deleteId}`,
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
                                DataTableUtils.refreshTable('category-table')
                                .then(() => {
                                    $('#alertModal h3').text(response.message);

                                    // Update class icon sesuai tipe
                                    const iconColor = {
                                        success: 'text-green-500',
                                        error: 'text-red-500',
                                        warning: 'text-yellow-500',
                                        info: 'text-blue-500'
                                    } [response.type];

                                    $('#alertModal .icon-animate svg').removeClass(
                                            'text-green-500 text-red-500 text-yellow-500 text-blue-500'
                                            )
                                        .addClass(iconColor);

                                    // Tampilkan modal
                                    $('#alertModalButton').click();
                                })
                                .catch((error) => {
                                    console.error('Gagal merefresh tabel:', error);
                                });
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

            $(document).on('click', '#edit-category', function(e) {
                e.preventDefault();
                let editId = $(this).attr('data-id');
                let editName = $(this).attr('data-name');
                $('#nameEdit').val('');
                clearError('nameEdit');
                $('#modalEditCategoryButton').click();
                $.ajax({
                    url: `/category/${editId}/edit`,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#idEdit').val(editId);
                        $('#nameEdit').val(editName);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Terjadi kesalahan saat mengedit data');
                    }
                });
            });

            $('#update-category').on('click', function(e) {
                e.preventDefault();
                let editId = $('#idEdit').val();
               // Clear previous errors
                ['name'].forEach(field => clearError(field));

                let formData = {
                    nameEdit: $('#nameEdit').val(),
                };

                $.ajax({
                    type: 'PUT',
                    url: `/category/${editId}`,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        $('#update-category').html(`
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                        Updating...
                    `).prop('disabled', true);
                    },
                    
                    success: function(response) {
                        if (response.success) {
                            // Tutup modal

                            DataTableUtils.refreshTable('category-table')
                                .then(() => {
                                    $('#modalEditCategoryButton').click();

                                    $('#alertModal h3').text(response.message);

                                    // Update class icon sesuai tipe
                                    const iconColor = {
                                        success: 'text-green-500',
                                        error: 'text-red-500',
                                        warning: 'text-yellow-500',
                                        info: 'text-blue-500'
                                    } [response.type];

                                    $('#alertModal .icon-animate svg').removeClass(
                                            'text-green-500 text-red-500 text-yellow-500 text-blue-500'
                                            )
                                        .addClass(iconColor);

                                    // Tampilkan modal
                                    $('#alertModalButton').click();
                                })
                                .catch((error) => {
                                    console.error('Gagal merefresh tabel:', error);
                                });


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
                    },
                    complete: function() {
                        $('#update-category').html(`<svg class="w-4 h-4 inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h6m5 4v3m0 0v3m0-3h3m-3 0h-3"/>
                    </svg>
                    Update Category`).prop('disabled', false);
                    },
                });
                
            });

        });
    </script>
@endpush