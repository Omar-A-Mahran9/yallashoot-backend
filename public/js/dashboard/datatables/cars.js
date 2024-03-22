"use strict";

// Class definition
let KTDatatable = (function () {
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
            order: [], // display records number and ordering type
            stateSave: false,
            select: {
                style: "os",
                selector: "td:first-child",
                className: "row-selected",
            },
            ajax: {
                data: function () {
                    let datatable = $("#kt_datatable");
                    let info = datatable.DataTable().page.info();
                    datatable
                        .DataTable()
                        .ajax.url(
                            `/dashboard/cars?page=${info.page + 1}&per_page=${
                                info.length
                            }`
                        );
                },
            },
            columns: [
                { data: "id" },
                { data: "main_image" },
                { data: "name_" + locale },
                { data: "price" },
                { data: "discount_price" },
                { data: "brand.name", name: "brand_id" },
                { data: "status_name" },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 3,
                    render: function (data, type, row) {
                        if (/^</.test(data))
                            return (
                                __("Price") + " " + data + " " + __(currency)
                            );
                        else return __(data);
                    },
                },
                {
                    targets: 1,
                    render: function (data, type, row) {
                        return `<a class="d-block overlay" style="height:47px;" data-fslightbox="lightbox-basic" href="${getImagePathFromDirectory(
                            data,
                            "Cars"
                        )}">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded"
                                         style="height:56px;width:100px;border-radius:4px;margin:auto;background-image:url('${getImagePathFromDirectory(
                                             data,
                                             "Cars"
                                         )}');background-size:contain;">
                                    </div>
                                    <!--end::Image-->

                                    <!--begin::Action-->
                                    <div style="width:47px;margin: auto;" class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                    </div>
                                    <!--end::Action-->
                                </a>`;
                    },
                },
                {
                    targets: -1,
                    data: null,
                    render: function (data, type, row) {
                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                ${__("Actions")}
                                <span class="svg-icon svg-icon-5 m-0">
                                    <i class="fa fa-angle-down mx-1"></i>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="/dashboard/cars/${
                                        row.id
                                    }/edit" class="menu-link px-3 d-flex justify-content-between edit-row" >
                                       <span> ${__("Edit")} </span>
                                       <span>  <i class="fa fa-edit text-primary"></i> </span>
                                    </a>

                                </div>
                                <!--end::Menu item-->
                    
                              

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="/dashboard/cars/${
                                        row.id
                                    }" class="menu-link px-3 d-flex justify-content-between" >
                                       <span> ${__("Show")} </span>
                                       <span>  <i class="fa fa-eye text-black-50"></i> </span>
                                    </a>

                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 d-flex justify-content-between delete-row" data-row-id="${
                                        row.id
                                    }" data-type="${__("car")}">
                                       <span> ${__("Delete")} </span>
                                       <span>  <i class="fa fa-trash text-danger"></i> </span>
                                    </a>
                                </div>
                                <!--end::Menu item-->

                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ],
        });

        table = datatable.$;

        datatable.on("draw", function () {
            handleDeleteRows();
            handleFilterDatatable();
            KTMenu.createInstances();
            $("body").append(`<script src='${lightboxPath}' ></script>`);
        });
    };

    // general search in datatable
    let handleSearchDatatable = () => {
        $("#general-search-inp").keyup(function () {
            datatable.search($(this).val()).draw();
        });
    };

    // Filter Datatable
    let handleFilterDatatable = () => {
        $(".filter-datatable-inp").each((index, element) => {
            $(element).change(function () {
                let columnIndex = $(this).data("filter-index"); // index of the searching column

                datatable.column(columnIndex).search($(this).val()).draw();
            });
        });
    };

    // Delete record
    let handleDeleteRows = () => {
        $(".delete-row").click(function () {
            let rowId = $(this).data("row-id");
            let type = $(this).data("type");

            deleteAlert(type).then(function (result) {
                if (result.value) {
                    loadingAlert(__("deleting now ..."));

                    $.ajax({
                        method: "delete",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        url: "/dashboard/cars/" + rowId,
                        success: () => {
                            setTimeout(() => {
                                successAlert(
                                    `${
                                        __("You have deleted the") +
                                        " " +
                                        type +
                                        " " +
                                        __("successfully !")
                                    } `
                                ).then(function () {
                                    datatable.draw();
                                });
                            }, 1000);
                        },
                        error: (err) => {
                            if (err.hasOwnProperty("responseJSON")) {
                                if (
                                    err.responseJSON.hasOwnProperty("message")
                                ) {
                                    errorAlert(err.responseJSON.message);
                                }
                            }
                        },
                    });
                } else if (result.dismiss === "cancel") {
                    errorAlert(__("was not deleted !"));
                }
            });
        });
    };

    // Public methods
    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
            // handleFilterDatatable();
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatable.init();
});

// <!--begin::Menu item-->
// <div class="menu-item px-3">
//     <a href="/dashboard/cars/${
//         row.id
//     }/duplicate" class="menu-link px-3 d-flex justify-content-between edit-row" >
//        <span> ${__("Duplicate")} </span>
//        <span>  <i class="fa fa-copy text-primary"></i> </span>
//     </a>

// </div>
// <!--end::Menu item-->
