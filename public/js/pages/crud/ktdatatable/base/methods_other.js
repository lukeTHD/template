"use strict";

jQuery(document).ready(function () {
    window.datatable = $('#kt_datatable').KTDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: KTDB_URL,
                    method: typeof KTDB_METHOD !== 'undefined' ? KTDB_METHOD : 'GET',
                    params: typeof KTDB_PARAMS !== 'undefined' ? KTDB_PARAMS : {},
                    // sample custom headers
                    headers: typeof KTDB_HEADERS !== 'undefined' ? KTDB_HEADERS : {},
                    map: function (raw) {
                        // sample data mapping
                        var dataSet = raw;
                        if (typeof raw.data !== 'undefined') {
                            dataSet = raw.data;
                        }
                        return dataSet;
                    },
                },
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
            saveState: false
        },

        // layout definition
        layout: {
            scroll: false,
            footer: false,
        },

        // column sorting
        sortable: true,

        pagination: true,

        search: {
            input: $('#generalSearch'),
            key: "generalSearch",
            onEnter: true,
        },

        // columns definition
        columns: KTDB_COLUMNS,
    });

    $("#kt_datatable_reload").on("click", function() {
        datatable.reload();
    });

    $("#kt_datatable_remove_row").on("click", function() {
        let data = [];
        $(".datatable-row-active").each(function(){
            let id = $(this).find('td:first').attr('aria-label');
            if(typeof(id) != 'undefined'){
                data.push(parseInt(id));
            }
        });
        if(data.length > 0){
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    let status = 2;
                    $.ajax({
                        url: REMOVE_ROWS_URL,
                        method: "POST",
                        data: {data:data, status:status},
                        headers:{
                            "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                        },
                        success: function(data){
                            if(data == 'success'){
                                Swal.fire(
                                "Deleted!",
                                "Tickets has been deleted.",
                                "success"
                                ).then(function(OK){
                                    if (OK.value){
                                        datatable.reload();
                                    }
                                });
                            }
                        },
                        error: function(){
                            Swal.fire(
                                "Cancelled",
                                "error"
                            )
                        }
                    })
                    
                }
            });
        }
    });
});
// $(window).on("load", function () {
//     console.log(datatable.getTotalRows());
// });