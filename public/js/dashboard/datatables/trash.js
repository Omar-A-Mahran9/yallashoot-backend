// "use strict";

// Class definition
 KTDatatable = function () {

    // Shared variables
    let table;
    let filter;

    // Private functions
    let initDatatable = function () {
        datatable = $("#kt_datatable").DataTable({
            destroy: true,
            orderable: false,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [], // display records number and ordering type
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
                    datatable.DataTable().ajax.url(`/dashboard/trash/${modelName}?page=${info.page + 1}&per_page=${info.length}`);
                }
            },
            columns: dataTableColumns.get(modelName),
            columnDefs: dataTableColumnsDefs.get(modelName),

        });

        table = datatable.$;

        datatable.on('draw', function () {
            handleDeleteRows();
            handleRestoreRows();
            KTMenu.createInstances();
            $('body').append(`<script src='${lightboxPath}' ></script>`)
        });
    }



    // Delete record
    let handleDeleteRows = () => {

        $('.delete-row').click(function () {

            let rowId = $(this).data('row-id');
            let type  = $(this).data('type');

            deleteAlert(type).then(function (result) {

                if (result.value) {

                    loadingAlert(__('deleting now ...'));

                    $.ajax({
                        method: 'delete',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '/dashboard/trash/'+ modelName + '/' + rowId,
                        success: () => {

                            setTimeout( () => {

                                successAlert(`${__('You have deleted the') + ' ' + type + ' ' + __('successfully !')} `)
                                    .then(function () {
                                        datatable.draw();
                                    });

                            } , 1000)



                        },
                        error: (err) => {

                            if (err.hasOwnProperty('responseJSON')) {
                                if (err.responseJSON.hasOwnProperty('message')) {
                                    errorAlert(err.responseJSON.message);
                                }
                            }
                        }
                    });


                } else if (result.dismiss === 'cancel') {

                    errorAlert( __('was not deleted !') )

                }
            });
        })
    }

    // Restore record
    let handleRestoreRows = () => {

        $('.restore-row').click(function () {
            let rowId = $(this).data('row-id');
            let type  = $(this).data('type');

            $.ajax({
                method: 'get',
                url: `/dashboard/trash/${modelName}/${rowId}`,
                success: () => {
                    setTimeout( () => {

                        successAlert(`${__('You have restored the') + ' ' + type + ' ' + __('successfully !')} `)
                            .then(function () {
                                datatable.draw();
                            });

                    } , 1000)
                },
                error: (err) => {
                    if (err.hasOwnProperty('responseJSON')) {
                        if (err.responseJSON.hasOwnProperty('message')) {
                            errorAlert(err.responseJSON.message);
                        }
                    }
                }
            });

        })

    }


    // Public methods
    return {
        init: function () {
            initDatatable();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatable.init();
});
