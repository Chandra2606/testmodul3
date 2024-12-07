import { DataTable } from "simple-datatables";
window.DataTableUtils = {
    tables: {},

    refreshTable: function (tableId) {
        if (this.tables[tableId]) {
            return this.tables[tableId].refresh();
        } else {
            console.error(`Tabel dengan ID ${tableId} tidak ditemukan`);
            return Promise.reject(`Tabel dengan ID ${tableId} tidak ditemukan`);
        }
    },
};

function initializeDataTable(tableId, endpoint, columnMapper) {
    let dataTable;

    const loadData = () => {
        // Tambahkan class loading ke tabel
        const table = document.getElementById(tableId);
        
        // Jika belum ada dataTable (loading pertama), gunakan loading fullscreen
        if (!dataTable) {
            table.classList.add('loading-table-fullscreen');
        } else {
            table.classList.add('loading-table');
        }
        
        // Sembunyikan thead saat loading
        const thead = document.querySelector(`#${tableId} thead`);
        if (thead) thead.style.display = 'none';
        
        const timestamp = new Date().getTime();
        const urlWithTimestamp = `${endpoint}?t=${timestamp}`;
        
        return fetch(urlWithTimestamp)
            .then((response) => response.json())
            .then((data) => {
                const tbody = document.querySelector(`#${tableId} tbody`);
                tbody.innerHTML = "";

                data.data.forEach((item, index) => {
                    const row = document.createElement("tr");
                    row.innerHTML = columnMapper(item, index);
                    tbody.appendChild(row);
                });

                // Tampilkan kembali thead setelah data dimuat
                if (thead) thead.style.display = '';
                // Hapus class loading
                table.classList.remove('loading-table-fullscreen');
                table.classList.remove('loading-table');

                if (dataTable) {
                    dataTable.refresh();
                    return Promise.resolve();
                }

                dataTable = new DataTable(`#${tableId}`, {
                    header: true,
                    searchable: true,
                    sortable: true,
                    perPage: 10,
                    perPageSelect: [5, 10, 20, 50],
                });

                DataTableUtils.tables[tableId] = {
                    instance: dataTable,
                    refresh: loadData
                };

                return Promise.resolve();
            })
            .catch((error) => {
                // Tampilkan kembali thead jika terjadi error
                if (thead) thead.style.display = '';
                // Hapus class loading
                table.classList.remove('loading-table-fullscreen');
                table.classList.remove('loading-table');
                console.error("Error:", error);
                return Promise.reject(error);
            });
    };

    loadData().catch((error) => {
        console.error("Error saat mengambil data:", error);
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Tabel Users
    if (document.getElementById("default-table")) {
        initializeDataTable(
            "default-table",
            "/users/getdata",
            (user, index) => `
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${
                index + 1
            }</td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${
                user.name
            }</td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${
                user.email
            }</td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white flex gap-2">
                <a href="/users/${
                    user.id
                }/edit" class="text-blue-500 hover:text-blue-700">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17v1a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2M6 1v4a1 1 0 0 1-1 1H1m13.14.772 2.745 2.746M18.1 5.612a2.086 2.086 0 0 1 0 2.953l-6.65 6.646-3.693.739.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z"/>
                    </svg>
                </a>
                <a href="/users/${
                    user.id
                }/delete" class="text-red-500 hover:text-red-700">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                    </svg>
                </a>
            </td>
        `
        );
    }

    // Tabel Author
    if (document.getElementById("author-table")) {
        initializeDataTable(
            "author-table",
            "/author/show",
            (author, index) => `
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${
                index + 1
            }</td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${
                author.name
            }</td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${
                author.email
            }</td>
            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white flex gap-2">
                <button type="button" id="edit-author" class="text-blue-500 hover:text-blue-700" data-id="${author.id}" data-name="${author.name}" data-email="${author.email}">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17v1a.97.97 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.97.97 0 0 1 15 2M6 1v4a1 1 0 0 1-1 1H1m13.14.772 2.745 2.746M18.1 5.612a2.086 2.086 0 0 1 0 2.953l-6.65 6.646-3.693.739.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z"/>
                    </svg>
                </button>
                <a href="/author/${
                    author.id
                }/delete" class="text-red-500 hover:text-red-700">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                    </svg>
                </a>
            </td>
        `
        );
    }
});
