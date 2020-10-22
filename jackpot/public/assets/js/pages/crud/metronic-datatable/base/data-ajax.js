"use strict";

jQuery(document).ready(function () {
    window.datatable = $('.kt-datatable').KTDatatable({
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
            saveState: {
                cookie: false,
                webstorage: false
            }
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
            onEnter: true,
        },

        // columns definition
        columns: KTDB_COLUMNS,
        translate: {
            records: {
                processing: KTDB_PROCESSING + ' ...'
            }
        }
    });
});
