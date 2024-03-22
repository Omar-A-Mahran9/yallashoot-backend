@extends('partials.dashboard.master')
@push('styles')
    <link href="{{ asset('dashboard-assets/css/datatables' . ( isDarkMode() ?  '.dark' : '' ) .'.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>

    <style>
        .headerIcons{
            font-size: 1.5rem;
        }

        .activeTab, .activeTab i{
            color: #0095E8;
            background-color: #fff !important;
        }

        .trashTab{
            background-color: #F5F8FA;
        }

    </style>
@endpush
@section('content')

<div class="row justify-content-center">

    <div class="trashTab col-md-4 col-12 card  text-center h2 py-5 mb-0 text-hover-primary activeTab" data-model="Car" style="cursor: pointer">
        <i class="fa fa-car headerIcons"></i>
        <span>{{ __("Cars") }}</span>
    </div>
    <div class="trashTab col-md-4 col-12 card  text-center h2 py-5 mb-0 text-hover-primary" data-model="Order" style="cursor: pointer">
        <i class="fa fa-users headerIcons"></i>
        <span>{{ __("Orders") }}</span>
    </div>


</div>

<!-- begin :: Datatable card -->
<div class="row card mb-2">
    <!-- begin :: Card Body -->
    <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">

            <div id="table-container">

            <!-- begin :: Datatable -->
            <table id="kt_datatable" class="table text-center table-row-dashed fs-6 gy-5">

                <thead>
                    <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0" id="table-header">
                        <th>#</th>
                        {{-- <th>{{ __("image") }}</th> --}}
                        <th>{{ getLocale() == 'ar' ? __("arabic name") : __("english name") }}</th>
                        <th>{{ __("price") }}</th>
                        <th>{{ __("Brand") }}</th>
                        <th class="min-w-100px">{{ __("actions") }}</th>
                    </tr>
                </thead>

                <tbody class="text-gray-600 fw-bold text-center">

                </tbody>
            </table>
            <!-- end   :: Datatable -->

            </div>
    </div>
    <!-- end   :: Card Body -->
</div>
<!-- end   :: Datatable card -->

@endsection
@push('scripts')

    <script>
        let tabs = $('.trashTab');
        let tableHeader = $('thead tr').first();
        let modelName = 'Car';
        let datatable = null;
        let userAbilites = @json(auth()->user()->abilities());
        let canDelete  = userAbilites.includes('delete_recycle_bin');
        let canRestore = userAbilites.includes('restore_recycle_bin');
        let lightboxPath = "{{ asset('dashboard-assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}";

        // start map containts (html) table header columns
        let tableHeaderColumns = new Map();
        tableHeaderColumns.set('Car', `<th>#</th>
                     <th>{{ getLocale() == 'ar' ? __("arabic name") : __("english name") }}</th>
                    <th>{{ __("price") }}</th>
                    <th>{{ __("Brand") }}</th>
                    <th class="min-w-100px">{{ __("actions") }}</th>` );

        tableHeaderColumns.set('Order', `<th>#</th>
                    <th>{{ __("name") }}</th>
                    <th>{{ __("phone") }}</th>
                    <th>{{ __("price") }}</th>
                    <th>{{ __("type") }}</th>
                    <th>{{ __("status") }}</th>
                    <th>{{ __("created date") }}</th>
                    <th>{{ __("opened by") }}</th>
                    <th>{{ __("opened at") }}</th>
                    <th class="min-w-100px">{{ __("actions") }}</th>` );

        // end map containts (html) table header columns

        // start map containts data table columns names
        let dataTableColumns = new Map();
        dataTableColumns.set('Car', [
                {data: 'id'},
                 {data: 'name_' + locale },
                {data: 'price'},
                {data: 'brand.name' , name:'brand_id'},
                {data: null},
        ]);

        dataTableColumns.set('Order', [
                {data: 'id'},
                {data: 'name'},
                {data: 'phone'},
                {data: 'price'},
                {data: 'type'},
                {data: 'status',name:'status'},
                {data: 'created_at',name: 'created_at'},
                {data: 'employee.name'},
                {data: 'opened_at'},
                {data: null},
        ]);

        // end map containts data table columns names

        // start map containts data table columns definitions
        let dataTableColumnsDefs = new Map();
        dataTableColumnsDefs.set('Car', [
                {
                    targets: 3,
                    render : function (data, type, row) {
                        if(/^</.test(data))
                            return __('Price') + " " + data + " " + __(currency);
                        else
                            return __(data);
                    }
                },
                // {
                //     targets: 1,
                //     render: function (data, type, row) {

                //         return `<a class="d-block overlay" style="height:47px;" data-fslightbox="lightbox-basic" href="${getImagePathFromDirectory(data, 'Cars')}">
                //                     <!--begin::Image-->
                //                     <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded"
                //                          style="height:56px;width:100px;border-radius:4px;margin:auto;background-image:url('${getImagePathFromDirectory(data, 'Cars')}');background-size:contain;">
                //                     </div>
                //                     <!--end::Image-->

                //                     <!--begin::Action-->
                //                     <div style="width:47px;margin: auto;" class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                //                         <i class="bi bi-eye-fill text-white fs-3x"></i>
                //                     </div>
                //                     <!--end::Action-->
                //                 </a>`;

                //     }
                // },
                {
                    targets: -1,
                    data: null,
                    render: function (data, type, row) {


                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                ${__('Actions')}
                                <span class="svg-icon svg-icon-5 m-0">
                                    <i class="fa fa-angle-down mx-1"></i>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">

                            ${ canRestore ? `<!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 d-flex justify-content-between restore-row" data-row-id="${row.id}" data-type="${__('car')}" >
                                        <span> ${__('Restore')} </span>
                                        <span>  <i class="fas fa-share text-primary"></i> </span>
                                        </a>

                                    </div>
                                    <!--end::Menu item-->` : ``
                            }

                            ${ canDelete ? `<!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 d-flex justify-content-between delete-row" data-row-id="${row.id}" data-type="${__('car')}">
                                    <span> ${__('Delete')} </span>
                                    <span>  <i class="fa fa-trash text-danger"></i> </span>
                                    </a>
                                </div>
                            <!--end::Menu item-->` : ``

                            }

                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ]);
            // /dashboard/trash/${modelName}/${ row.id }
        dataTableColumnsDefs.set('Order', [
                {
                    targets: 3,
                    render : function (data, type, row) {
                        if(data) return data + " " + __(currency);
                        return "<h1>-</h1>";
                    }
                },
                {
                    targets: 5,
                    render : function (data, type, row) {
                        return getStatusObject(data)['name_' + locale];
                    }
                },
                {
                    targets: 4,
                    render : function (data, type, row) {
                        return __( data.replace("_"," ") );
                    }
                },
                {
                    targets: -2,
                    render : function (data, type, row) {
                        if(data) return data;
                        return "<h1>-</h1>";
                    }
                },
                {
                    targets: -3,
                    render : function (data, type, row) {
                        if(data) return data;
                        return "<h1>-</h1>";
                    }
                },
                {
                    targets: -1,
                    data: null,
                    render: function (data, type, row) {

                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                ${__('Actions')}
                                <span class="svg-icon svg-icon-5 m-0">
                                    <i class="fa fa-angle-down mx-1"></i>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">


                                ${ canRestore ? `<!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3 d-flex justify-content-between restore-row" data-row-id="${row.id}" data-type="${__('order')}" >
                                        <span> ${__('Restore')} </span>
                                        <span>  <i class="fas fa-share text-primary"></i> </span>
                                        </a>

                                    </div>
                                    <!--end::Menu item-->` : ``
                            }

                            ${ canDelete ? `<!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 d-flex justify-content-between delete-row" data-row-id="${row.id}" data-type="${__('order')}">
                                    <span> ${__('Delete')} </span>
                                    <span>  <i class="fa fa-trash text-danger"></i> </span>
                                    </a>
                                </div>
                            <!--end::Menu item-->` : ``

                            }

                            </div>
                            <!--end::Menu-->
                        `;
                    },
                },
            ]);
        // end map containts data table columns definitions

        tabs.click(function(){

            tabs.removeClass('activeTab');
            $(this).addClass('activeTab');

            modelName = $(this).data('model');
            $('#table-container').html(`
                <table id="kt_datatable" class="table text-center table-row-dashed fs-6 gy-5">

                <thead>
                    <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0" id='table-header' >
                    ${ tableHeaderColumns.get(modelName) }
                    </tr>
                </thead>

                <tbody class="text-gray-600 fw-bold text-center">

                </tbody>
                </table>`
            );


            KTDatatable.init();

        })
    </script>
    <script src="{{ asset('js/dashboard/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/dashboard/datatables/trash.js') }}"></script>

@endpush