"use strict";

// Class definition
let KTDatatable = function () {

    // Shared variables
    let table;
    let datatable;
    let filter;

    // Private functions
    let initDatatable = function () {
        datatable = $("#kt_datatable").DataTable({
            orderable: false,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [[5, 'desc']], // display records number and ordering type
            stateSave: false,
            select: {
                style: 'os',
                selector: 'td:first-child',
                className: 'row-selected'
            },
            ajax: {
                data: function () {
                    let datatable = $('#kt_datatable');
                    let info = datatable.DataTable().page.info();
                    datatable.DataTable().ajax.url(`/dashboard/contact-us?page=${info.page + 1}&per_page=${info.length}`);
                }
            },
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'message'},
                {data: 'reply'},
                {data: null},
            ],
            columnDefs: [
                {
                    targets: 1,
                    width:150,
                },
                {
                    targets: 4,
                    width:180,
                    orderable: false,
                    render:function (data, type, row) {
                        return `<a     onclick="showMoreInDT(this)" > <span  class="cursor-pointer" title="${ __('show more')}" >${ data.substr(0, 20) }</span> </a>
                                <span  title="${ __('show more')}"> ${ data.length > 20 ? '...' : ''} </span>
                                <span  style="display:none"> ${ data.substr(20) } </span>` ;
                    }
                },
                {
                    targets: 5,
                    width:180,
                    render:function (data, type, row) {

                        if (!data)
                            return "<h1>-</h1>";

                        return `<a     onclick="showMoreInDT(this)" > <span  class="cursor-pointer" title="${ __('show more')}" >${ data.substr(0, 18) }</span> </a>
                                <span  title="${ __('show more')}"> ${ data.length > 18 ? '...' : ''} </span>
                                <span  style="display:none"> ${ data.substr(18) } </span>` ;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    render: function (data, type, row) {

                        return `<a href="/dashboard/contact-us/${row.id}/edit"> <i class="fa fa-reply fa-flip-horizontal"></i> </a> `;

                    },
                },
            ],

        });

        table = datatable.$;

        datatable.on('draw', function () {
            KTMenu.createInstances();
        });
    }

    // general search in datatable
    let handleSearchDatatable = () => {

        $('#general-search-inp').keyup( function () {
            datatable.search( $(this).val() ).draw();
        });

    }

    // Filter Datatable
    let handleFilterDatatable = () => {

        $('.filter-datatable-inp').each( (index , element) =>  {

            $(element).change( function () {

                let columnIndex = $(this).data('filter-index'); // index of the searching column

                datatable.column(columnIndex).search( $(this).val()).draw();
            });

        })
    }





    // Public methods
    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
            // handleFilterDatatable();

        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatable.init();
});
