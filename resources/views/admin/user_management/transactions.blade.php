@extends('admin.layouts.app')
@section('page_title',__('View Profile'))
@section('content')
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10">
                @include('admin.user_management.components.header_user_profile')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header card-header-content-md-between">
                                <div class="mb-2 mb-md-0">
                                    <div class="input-group input-group-merge navbar-input-group">
                                        <div class="input-group-prepend input-group-text">
                                            <i class="bi-search"></i>
                                        </div>
                                        <input type="search" id="datatableSearch"
                                               class="search form-control form-control-sm"
                                               placeholder="@lang('Search transaction')"
                                               aria-label="@lang('Search transaction')"
                                               autocomplete="off">
                                    </div>
                                </div>

                                <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-white btn-sm w-100"
                                                id="dropdownMenuClickable" data-bs-auto-close="false"
                                                id="usersFilterDropdown"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            <i class="bi-filter me-1"></i> @lang('Filter')
                                        </button>

                                        <div
                                            class="dropdown-menu dropdown-menu-sm-end dropdown-card card-dropdown-filter-centered filter_dropdown"
                                            aria-labelledby="dropdownMenuClickable">
                                            <div class="card">
                                                <div class="card-header card-header-content-between">
                                                    <h5 class="card-header-title">@lang('Filter')</h5>
                                                    <button type="button"
                                                            class="btn btn-ghost-secondary btn-icon btn-sm ms-2"
                                                            id="filter_close_btn">
                                                        <i class="bi-x-lg"></i>
                                                    </button>
                                                </div>

                                                <div class="card-body">
                                                    <form id="filter_form">
                                                        <div class="mb-4">
                                                            <span
                                                                class="text-cap text-body">@lang('Transaction ID')</span>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <input type="text" class="form-control"
                                                                           id="transaction_id_filter_input"
                                                                           autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-12 mb-4">
                                                                <span
                                                                    class="text-cap text-body">@lang('Date Range')</span>
                                                                <div class="input-group mb-3 custom">
                                                                    <input type="text" id="filter_date_range"
                                                                           class="js-flatpickr form-control"
                                                                           placeholder="Select dates"
                                                                           data-hs-flatpickr-options='{
                                                                 "dateFormat": "d/m/Y",
                                                                 "mode": "range"
                                                               }' aria-describedby="flatpickr_filter_date_range">
                                                                    <span class="input-group-text"
                                                                          id="flatpickr_filter_date_range">
                                                        <i class="bi bi-arrow-counterclockwise"></i>
                                                    </span>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row gx-2">
                                                            <div class="col">
                                                                <div class="d-grid">
                                                                    <button type="button" id="clear_filter"
                                                                            class="btn btn-white">@lang('Clear Filters')</button>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="d-grid">
                                                                    <button type="button" class="btn btn-primary"
                                                                            id="filter_button"><i
                                                                            class="bi-search"></i> @lang('Apply')
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" table-responsive datatable-custom  ">
                                <table id="datatable"
                                       class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                       data-hs-datatables-options='{
                                       "columnDefs": [{
                                          "targets": [0, 4],
                                          "orderable": false
                                        }],
                                       "order": [],
                                       "info": {
                                         "totalQty": "#datatableWithPaginationInfoTotalQty"
                                       },
                                       "search": "#datatableSearch",
                                       "entries": "#datatableEntries",
                                       "pageLength": 10,
                                       "isResponsive": false,
                                       "isShowPaging": false,
                                       "pagination": "datatablePagination"
                                     }'>
                                    <thead class="thead-light">
                                    <tr>
                                        <th>@lang('No.')</th>
                                        <th>@lang('Transaction ID')</th>
                                        <th>@lang('Amount')</th>
                                        <th>@lang('Charge')</th>
                                        <th>@lang('Remarks')</th>
                                        <th>@lang('Date-time')</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            @if($transactions > 10)
                                <div class="card-footer">
                                    <div
                                        class="row justify-content-center justify-content-sm-between align-items-sm-center">
                                        <div class="col-sm mb-2 mb-sm-0">
                                            <div
                                                class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                                <span class="me-2">@lang('Showing:')</span>
                                                <div class="tom-select-custom">
                                                    <select id="datatableEntries"
                                                            class="js-select form-select form-select-borderless w-auto"
                                                            autocomplete="off"
                                                            data-hs-tom-select-options='{
                                                        "searchInDropdown": false,
                                                        "hideSearch": true
                                                      }'>
                                                        <option value="5">5</option>
                                                        <option value="10" selected>10</option>
                                                        <option value="15">15</option>
                                                        <option value="20">20</option>
                                                    </select>
                                                </div>
                                                <span class="text-secondary me-2">@lang('of')</span>
                                                <span id="datatableWithPaginationInfoTotalQty"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-auto">
                                            <div class="d-flex  justify-content-center justify-content-sm-end">
                                                <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.user_management.components.update_balance_modal')
    @include('admin.user_management.components.login_as_user')
    @include('admin.user_management.components.block_profile_modal')
@endsection

@push('css-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/tom-select.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/flatpickr.min.css') }}">
@endpush

@push('js-lib')
    <script src="{{ asset('assets/admin/js/tom-select.complete.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/select.min.js') }}"></script>
@endpush

@push('script')
    <script>
        $(document).on('ready', function () {
            HSCore.components.HSFlatpickr.init('.js-flatpickr')
            HSCore.components.HSTomSelect.init('.js-select', {
                maxOptions: 250,
            })

            HSCore.components.HSDatatables.init($('#datatable'), {
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: "{{ route("admin.user.transaction.search", $user->id) }}",
                },
                columns: [
                    {data: 'no', name: 'no'},
                    {data: 'trx', name: 'trx'},
                    {data: 'amount', name: 'amount'},
                    {data: 'charge', name: 'charge'},
                    {data: 'remarks', name: 'remarks'},
                    {data: 'date-time', name: 'date-time'},
                ],
                language: {
                    zeroRecords: `<div class="text-center p-4">
                    <img class="dataTables-image mb-3" src="{{ asset('assets/admin/img/oc-error.svg') }}" alt="Image Description" data-hs-theme-appearance="default">
                    <img class="dataTables-image mb-3" src="{{ asset('assets/admin/img/oc-error-light.svg') }}" alt="Image Description" data-hs-theme-appearance="dark">
                    <p class="mb-0">No data to show</p>
                    </div>`,
                    processing: `<div><div></div><div></div><div></div><div></div></div>`
                },
            });

            document.getElementById("filter_close_btn").addEventListener("click", function () {
                let dropdownMenu = document.querySelector(".dropdown-menu.show");
                if (dropdownMenu) {
                    dropdownMenu.classList.remove("show");
                }
            });

            document.getElementById("filter_button").addEventListener("click", function () {
                let filterTransactionId = $('#transaction_id_filter_input').val();
                let filterDate = $('#filter_date_range').val();

                const datatable = HSCore.components.HSDatatables.getItem(0);
                datatable.ajax.url("{{ route('admin.user.transaction.search', $user->id) }}" + "?filterTransactionID=" + filterTransactionId +
                    "&filterDate=" + filterDate).load();
            });

            document.getElementById("clear_filter").addEventListener("click", function () {
                document.getElementById("filter_form").reset();
            });

            $.fn.dataTable.ext.errMode = 'throw';

            $(document).on('click', '.loginAccount', function () {
                let route = $(this).data('route');
                $('.loginAccountAction').attr('action', route)
            });

            $(document).on('click', '.blockProfile', function () {
                let route = $(this).data('route');
                $('.blockProfileAction').attr('action', route)
            });
        });
    </script>
@endpush






