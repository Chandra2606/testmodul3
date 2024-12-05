import { DataTable } from "simple-datatables";

document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("default-table")) {
        const dataTable = new DataTable("#default-table", {
            header: true,

            searchable: true,

            sortable: true,

            perPage: 10,

            perPageSelect: [5, 10, 20, 50],

            firstLast: true,
        });
    }
});
