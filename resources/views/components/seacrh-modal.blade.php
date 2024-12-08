
<button type="button" id="searchAuthorButton" data-modal-target="searchAuthorModal" data-modal-toggle="searchAuthorModal" class="hidden">Cari Author</button>
<!-- Search Author modal -->
<div id="searchAuthorModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 modal-animate">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Cari Author
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="searchAuthorModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Tutup modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
               <table id="author-table-search">
            <thead>
                <tr>
                    <th data-sortable="true" data-type="number">No</th>
                    <th data-sortable="true" data-type="string">Name</th>
                    <th data-sortable="true" data-type="string">Email</th>
                    <th data-sortable="false">Action</th>
                </tr>
            </thead>
            
            <tbody>
                
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
/* Animasi untuk modal */
.modal-animate {
    animation: modalSlideIn 0.3s ease-out;
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
</style>