@props(['type' => 'success', 'message' => ''])

@php
    $icons = [
        'success' => '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>',
        'error' => '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>',
        'warning' => '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>',
        'info' => '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
    ];
    
    $colors = [
        'success' => 'green',
        'error' => 'red',
        'warning' => 'yellow',
        'info' => 'blue'
    ];
@endphp

<button id="alertModalButton" data-modal-target="alertModal" data-modal-toggle="alertModal" class="hidden"></button>

<div id="alertModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 modal-animate">
            <!-- Modal body -->
            <div class="p-4 text-center">
                <div class="icon-animate w-12 h-12 mx-auto mb-3">
                    <svg class="w-12 h-12 text-{{ $colors[$type] }}-500 dark:text-{{ $colors[$type] }}-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        {!! $icons[$type] !!}
                    </svg>
                </div>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ $message }}</h3>
                <button data-modal-hide="alertModal" type="button" class="text-white bg-{{ $colors[$type] }}-700 hover:bg-{{ $colors[$type] }}-800 focus:ring-4 focus:outline-none focus:ring-{{ $colors[$type] }}-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal konfirmasi hapus -->
<button id="confirmDeleteButton" data-modal-target="confirmDeleteModal" data-modal-toggle="confirmDeleteModal" class="hidden"></button>
<button id="hiddenButtonDelete" data-modal-hide="confirmDeleteModal" class="hidden"></button>

<div id="confirmDeleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
   <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 modal-animate">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="confirmDeleteModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <div class="icon-animate">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </div>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this data?</h3>
                <button id="deleteData" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center hover:scale-105 transition-transform duration-200">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="confirmDeleteModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 hover:scale-105 transition-transform duration-200">No, cancel</button>
            </div>
        </div>
    </div>
</div>


<style>
/* Animasi untuk modal */
.modal-animate {
    animation: modalSlideIn 0.3s ease-out;
}

/* Animasi untuk icon */
.icon-animate svg {
    animation: iconScale 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* Keyframes untuk modal */
@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Keyframes untuk icon */
@keyframes iconScale {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}
</style>