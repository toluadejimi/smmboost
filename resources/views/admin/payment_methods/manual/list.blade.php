@extends('admin.layouts.app')
@section('page_title', __('Manual Payment Methods'))
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item"><a class="breadcrumb-link"
                                                           href="javascript:void(0)">@lang("Dashboard")</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">@lang("Payment Settings")</li>
                            <li class="breadcrumb-item active" aria-current="page">@lang("Manual Gateway")</li>
                        </ol>
                    </nav>
                    <h1 class="page-header-title">@lang("Manual Gateway")</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="d-grid gap-3 gap-lg-5">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h2 class="card-title h4 mt-2">@lang('Manual Gateway')</h2>
                            <a href="{{route('admin.deposit.manual.create')}}" class="btn btn-sm btn-primary">
                                @lang('Add Method')
                            </a>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th>@lang("Name")</th>
                                    <th>@lang("Supported Currency")</th>
                                    <th>@lang("Description")</th>
                                    <th>@lang("Status")</th>
                                    <th>@lang("Action")</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($methods) > 0)
                                    @foreach($methods as $method)
                                        <tr data-code="{{ $method->code }}">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar avatar-circle">
                                                            <img class="avatar-img"
                                                                 src="{{ getFile($method->driver, $method->image) }}"
                                                                 alt="Image Description">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                    <span class="h5 text-inherit">
                                                        @lang($method->name)
                                                    </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                            <span
                                                class="badge bg-soft-dark text-dark">@lang(count($method->supported_currency ?? 0))</span>
                                            </td>
                                            <td>
                                                {{ Str::limit($method->description, 32) }}
                                            </td>
                                            <td>
                                                @if($method->status == 1)
                                                    <span class="badge bg-soft-success text-success">
                                                    <span class="legend-indicator bg-success"></span>@lang("Active")
                                                    </span>
                                                @else
                                                    <span class="badge bg-soft-danger text-danger">
                                                    <span class="legend-indicator bg-danger"></span>@lang("Inactive")
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a class="btn btn-white btn-sm"
                                                       href="{{ route('admin.deposit.manual.edit', $method->id) }}">
                                                        <i class="bi-pencil-fill me-1"></i> @lang('Edit')
                                                    </a>
                                                    <div class="btn-group">
                                                        <button type="button"
                                                                class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty"
                                                                id="paymentMethodEditDropdown" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end mt-1"
                                                             aria-labelledby="paymentMethodEditDropdown"
                                                             data-popper-placement="bottom-end">
                                                            <a class="dropdown-item disableBtn"
                                                               href="javascript:void(0)"
                                                               data-code="{{ $method->code }}"
                                                               data-status="{{ $method->status }}"
                                                               data-message="{{($method->status == 0)?'enable':'disable'}}"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#paymentMethodModal">
                                                                <i class="fa-light fa-{{($method->status == 0)?'check':'ban'}} dropdown-item-icon"></i> {{($method->status == 0)?'Mark As Enable':'Mark As Disable'}}
                                                            </a>
                                                            @if(Module::has('ChildPanel') && Module::isEnabled('ChildPanel'))
                                                                <a class="dropdown-item add-child-panel"
                                                                   href="javascript:void(0)"
                                                                   data-route="{{ route('admin.payment.methods.add.child.panel', $method->id) }}"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#addGatewayPanel">
                                                                    <i class="fa-light fa-money-check dropdown-item-icon"></i>@lang('Add Panel Gateway')
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="paymentMethodModal" tabindex="-1" role="dialog"
         aria-labelledby="paymentMethodModalLabel" data-bs-backdrop="static"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentMethodModalLabel">@lang('Confirmation')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.payment.methods.deactivate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="code">
                    <div class="modal-body">
                        @lang(' Are you sure') <span class="messageShow"></span> @lang('this gateway ?')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addGatewayPanel" tabindex="-1" aria-labelledby="addGatewayPanelLabel"
         data-bs-backdrop="static"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addGatewayPanelLabel"><i
                            class="bi bi-check2-square"></i> @lang("Confirmation")</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="setRoute">
                        @csrf
                        <input type="hidden" name="route" value="" class="old_route">
                        <p>@lang("Do you want to add this gateway to the child panel?")</p>
                        <div class="tom-select-custom">
                            <select class="js-select form-select" name="child_panel_id" autocomplete="off"
                                    data-hs-tom-select-options='{
                                      "placeholder": "Select Child Panel",
                                      "hideSearch": true
                                    }'>
                                <option value="">@lang("Select Child Panel")</option>
                                @forelse($childPanels as $panel)
                                    <option value="{{ $panel->id }}">{{ $panel->username }} - ({{ $panel->domain }})
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        @error('child_panel_id')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                        <div class="d-flex justify-content-end gap-3 mt-3 pt-2">
                            <button type="button" class="btn btn-white" data-bs-dismiss="modal">@lang("Close")</button>
                            <button type="submit" class="btn btn-primary">@lang("Confirm")</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/tom-select.bootstrap5.css') }}">
@endpush

@push('js-lib')
    <script src="{{ asset('assets/admin/js/tom-select.complete.min.js') }}"></script>
@endpush

@push('script')
    <script>
        'use strict';

        $(document).on('click', '.add-child-panel', function () {
            let route = $(this).data('route');
            $('.setRoute').attr('action', route);
            $('.old_route').val(route);
        });

        @if($errors->has('errorMessage'))
        $(document).ready(function () {
            let route = "{{ old('route') }}";
            $('.setRoute').attr('action', route);

            let addGatewayPanel = new bootstrap.Modal(document.getElementById("addGatewayPanel"), {});
            addGatewayPanel.show();
        });
        @endif

        $('.disableBtn').on('click', function () {
            let status = $(this).data('status');
            $('.messageShow').text($(this).data('message'));
            let modal = $('#paymentMethodModal');
            modal.find('input[name=code]').val($(this).data('code'));
        });

        HSCore.components.HSTomSelect.init('.js-select', {
            maxOptions: 250,
        })

    </script>
@endpush




