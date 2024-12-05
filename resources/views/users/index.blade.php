@extends('layouts.app')

@section('title', 'Manage Users')

@section('page-title', 'Users Overview')

@section('content')
    <div class="max-w-auto p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Manage Users</h1>
            <a href="{{ route('users.create') }}"
                class="text-black bg-[#ffc01f] hover:bg-[#a07813] focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                <svg class="w-4 h-4 inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 8h6m-3 3V5m-6-.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                </svg>
                Add User
            </a>
        </div>
    </div>


    <div class="max-w-auto p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <table id="default-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


@endsection

@push('scripts')
    <script>document.addEventListener('DOMContentLoaded', function() {
        fetch('/users/getdata')
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('#default-table tbody');
                tbody.innerHTML = '';

                data.data.forEach(user => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${user.name}</td>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${user.email}</td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                alert('Terjadi kesalahan saat mengambil data');
            });
    });</script>
@endpush
