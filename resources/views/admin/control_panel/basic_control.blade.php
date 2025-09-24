@extends('admin.layouts.app')
@section('page_title', __('Basic Control'))
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item">
                                <a class="breadcrumb-link" href="javascript:void(0)">@lang('Dashboard')
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('Settings')</li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('Basic Control')</li>
                        </ol>
                    </nav>
                    <h1 class="page-header-title">@lang('Basic Control')</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="shadow p-3 mb-5 alert alert-soft-dark mb-4 mb-lg-7" role="alert">
                    <div class="alert-box d-flex flex-wrap align-items-center">
                        <div class="flex-shrink-0">
                            <img class="avatar avatar-xl"
                                 src="{{ asset('assets/admin/img/oc-megaphone.svg') }}"
                                 alt="Image Description" data-hs-theme-appearance="default">
                            <img class="avatar avatar-xl"
                                 src="{{ asset('assets/admin/img/oc-megaphone-light.svg') }}"
                                 alt="Image Description" data-hs-theme-appearance="dark">
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <h3 class="  mb-1">@lang("Attention!")</h3>
                            <div class="d-flex align-items-center text-body">
                                <p class="mb-0 "> @lang(" If you get 500(server error) for some reason, please turn on `Debug Log` and try again. Then you can see what was missing in your system. ")</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                @include('admin.control_panel.components.sidebar', ['settings' => config('generalsettings.settings'), 'suffix' => 'Settings'])
            </div>
            <div class="col-lg-5" id="basic_control">
                <div class="d-grid gap-3 gap-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title h4">@lang('Basic Controls')</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.basic.control.update') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="siteTitleLabel" class="form-label">@lang('Site Title')</label>
                                        <input type="text"
                                               class="form-control  @error('site_title') is-invalid @enderror"
                                               name="site_title" id="siteTitleLabel"
                                               placeholder="@lang("Site Title")" aria-label="@lang("Site Title")"
                                               autocomplete="off"
                                               value="{{ old('site_title', $basicControl->site_title) }}">
                                        @error('site_title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="timeZoneLabel" class="form-label">@lang('Time Zone')</label>
                                        <div class="tom-select-custom">
                                            <select
                                                class="js-select form-select @error('time_zone') is-invalid @enderror"
                                                id="timeZoneLabel" name="time_zone">
                                                @foreach(timezone_identifiers_list() as $key => $value)
                                                    <option
                                                        value="{{$value}}" {{  (old('time_zone',$basicControl->time_zone) == $value ? ' selected' : '') }}>{{ __($value) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('time_zone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label for="baseCurrencyLabel" class="form-label">@lang('Base Currency')</label>
                                        <input type="text"
                                               class="form-control  @error('base_currency') is-invalid @enderror"
                                               name="base_currency"
                                               id="baseCurrencyLabel" autocomplete="off"
                                               placeholder="@lang("Base Currency")" aria-label="@lang("Base Currency")"
                                               value="{{ old('base_currency',$basicControl->base_currency) }}">
                                        @error('base_currency')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="CurrencySymbolLabel"
                                               class="form-label">@lang('Currency Symbol')</label>
                                        <input type="text"
                                               class="form-control @error('currency_symbol') is-invalid @enderror"
                                               name="currency_symbol"
                                               id="CurrencySymbolLabel" autocomplete="off"
                                               placeholder="@lang("Currency Symbol")"
                                               aria-label="@lang("Currency Symbol")"
                                               value="{{ old('currency_symbol',$basicControl->currency_symbol) }}">
                                        @error('currency_symbol')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label for="fractionNumberLabel"
                                               class="form-label">@lang('Fraction Number')</label>
                                        <input type="text"
                                               class="form-control @error('fraction_number') is-invalid @enderror"
                                               name="fraction_number"
                                               id="fractionNumberLabel"
                                               placeholder="@lang("Fraction Number")"
                                               aria-label="@lang("Fraction Number")"
                                               autocomplete="off"
                                               value="{{ old('fraction_number',$basicControl->fraction_number) }}">
                                        @error('fraction_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="paginateLabel" class="form-label">@lang('Paginate')</label>
                                        <input type="text" class="form-control @error('paginate') is-invalid @enderror"
                                               name="paginate" id="paginateLabel"
                                               placeholder="Paginate" aria-label="Paginate" autocomplete="off"
                                               value="{{ old('paginate',$basicControl->paginate) }}">
                                        @error('paginate')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <label for="dateFormatLabel" class="form-label">@lang('Date Format')</label>
                                        <div class="tom-select-custom">
                                            <select
                                                class="js-select form-select @error('date_format') is-invalid @enderror"
                                                id="dateFormatLabel" name="date_format">
                                                @foreach($dateFormat as $key => $value)
                                                    <option
                                                        value="{{ __($value) }}" {{ (old('time_zone',$basicControl->date_time_format) == $value ? ' selected' : '') }}>{{ date($value, time()) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('date_format')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <label for="adminPrefixLabel"
                                               class="form-label">@lang("Admin URL Prefix")</label>
                                        <input type="text"
                                               class="form-control @error('admin_prefix') is-invalid @enderror"
                                               name="admin_prefix" id="adminPrefixLabel"
                                               placeholder="@lang("Admin Prefix")"
                                               aria-label="@lang("Admin URL Prefix")"
                                               autocomplete="off"
                                               value="{{ old('admin_prefix', $basicControl->admin_prefix) }}">
                                        @error('admin_prefix')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary">@lang('Save changes')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3 mb-lg-5">
                <div class="card">
                    <div class="card-header card-header-content-between">
                        <h4 class="card-header-title">@lang('System Control')</h4>
                    </div>
                    <form action="{{ route('admin.basic.control.activity.update') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <ul class="list-group list-group-flush list-group-no-gutters">
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">@lang('Strong Password')</h5>
                                                    <span class="d-block fs-6 text-body">
                                                        @lang('Create a secure password using our generator tool.')
                                                    </span>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="row form-check form-switch mb-3" for="strongPassword">
                                                    <span class="col-4 col-sm-3 text-end">
                                                        <input type='hidden' value='0' name='strong_password'>
                                                        <input
                                                            class="form-check-input @error('strong_password') is-invalid @enderror"
                                                            type="checkbox"
                                                            name="strong_password"
                                                            id="strongPassword"
                                                            value="1" {{($basicControl->strong_password == 1) ? 'checked' : ''}}>
                                                        </span>
                                                        @error('strong_password')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">@lang('Registration')</h5>
                                                    <span class="d-block fs-6 text-body">
                                                        @lang('Enable or Disable User Registration')
                                                    </span>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="row form-check form-switch mb-3" for="registration">
                                                        <span class="col-4 col-sm-3 text-end">
                                                            <input type='hidden' value='0' name='registration'>
                                                             <input
                                                                 class="form-check-input @error('registration') is-invalid @enderror"
                                                                 type="checkbox" name="registration"
                                                                 id="registration"
                                                                 value="1" {{($basicControl->registration == 1) ? 'checked' : ''}}>
                                                            </span>
                                                        @error('registration')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">@lang('Debug Log')</h5>
                                                    <span class="d-block fs-6 text-body">
                                                        @lang('Debug logs are generated.')
                                                    </span>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="row form-check form-switch mb-3" for="errorLog">
                                                        <span class="col-4 col-sm-3 text-end">
                                                            <input type='hidden' value='0' name='error_log'>
                                                            <input
                                                                class="form-check-input @error('error_log') is-invalid @enderror"
                                                                type="checkbox" name="error_log"
                                                                id="errorLog"
                                                                value="1" {{($basicControl->error_log == 1) ? 'checked' : ''}}>
                                                        </span>
                                                        @error('error_log')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- List Group Item -->
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">@lang('Cron Pop Up Set')</h5>
                                                    <span
                                                        class="d-block fs-6 text-body">@lang('Is the active cron pop-up set.')</span>
                                                </div>

                                                <div class="col-auto">
                                                    <label class="row form-check form-switch mb-3"
                                                           for="isActiveCronNotification">
                                                    <span class="col-4 col-sm-3 text-end">
                                                     <input type='hidden' value='0' name='is_active_cron_notification'>
                                                        <input
                                                            class="form-check-input @error('is_active_cron_notification') is-invalid @enderror"
                                                            type="checkbox"
                                                            name="is_active_cron_notification"
                                                            id="isActiveCronNotification"
                                                            value="1" {{ ($basicControl->is_active_cron_notification == 1) ? 'checked' : '' }}>
                                                    </span>
                                                        @error('cron_set_up_pop_up')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">@lang('Space Between Currency & Amount')</h5>
                                                    <span
                                                        class="d-block fs-6 text-body">@lang('The customary currency symbol follows the amount, and is preceded by a space.')</span>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="row form-check form-switch mb-3"
                                                           for="inSpaceBetweenCurrency">
                                                    <span class="col-4 col-sm-3 text-end">
                                                    <input type='hidden' value='0'
                                                           name='has_space_between_currency_and_amount'>
                                                        <input
                                                            class="form-check-input @error('has_space_between_currency_and_amount') is-invalid @enderror"
                                                            type="checkbox"
                                                            name="has_space_between_currency_and_amount"
                                                            id="inSpaceBetweenCurrency"
                                                            value="1" {{($basicControl->has_space_between_currency_and_amount == 1) ? 'checked' : ''}}>
                                                    </span>
                                                        @error('has_space_between_currency_and_amount')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">@lang('Currency Position In Left')</h5>
                                                    <span
                                                        class="d-block fs-6 text-body">@lang('The currency position can be on the left or right of the amount.')</span>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="row form-check form-switch" for="currencyPosition">
                                                <span class="col-4 col-sm-3 text-end">
                                                    <input type='hidden' value='left' name='is_currency_position'>
                                                        <input
                                                            class="form-check-input @error('is_currency_position') is-invalid @enderror"
                                                            type="checkbox"
                                                            name="is_currency_position"
                                                            id="is_currency_position"
                                                            value="right" {{($basicControl->is_currency_position == "right") ? 'checked' : ''}}>
                                                    </span>
                                                        @error('is_currency_position')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">@lang('Force SSL')</h5>
                                                    <span
                                                        class="d-block fs-6 text-body">@lang('To force the HTTPS connection on your website.')</span>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="row form-check form-switch" for="currencyPosition">
                                                <span class="col-4 col-sm-3 text-end">
                                                    <input type='hidden' value='0' name='is_force_ssl'>
                                                        <input
                                                            class="form-check-input @error('force_ssl') is-invalid @enderror"
                                                            type="checkbox"
                                                            name="is_force_ssl"
                                                            id="force_ssl"
                                                            value="1" {{($basicControl->is_force_ssl == "1") ? 'checked' : ''}}>
                                                    </span>
                                                        @error('force_ssl')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h5 class="mb-0">@lang('Gateway Auto Update Currency')</h5>
                                                    <span
                                                        class="d-block fs-6 text-body">@lang('This feature automates currency rate updates in a payment gateway.')</span>
                                                </div>
                                                <div class="col-auto">
                                                    <label class="row form-check form-switch" for="gatewayCurrencyUpdate">
                                                <span class="col-4 col-sm-3 text-end">
                                                    <input type='hidden' value='0' name='automatic_currency_update_permission'>
                                                        <input
                                                            class="form-check-input @error('automatic_currency_update_permission') is-invalid @enderror"
                                                            type="checkbox"
                                                            name="automatic_currency_update_permission"
                                                            id="automatic_currency_update_permission"
                                                            value="1" {{($basicControl->automatic_currency_update_permission == "1") ? 'checked' : ''}}>
                                                    </span>
                                                        @error('automatic_currency_update_permission')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <div class="d-flex justify-content-start mt-3">
                                    <button type="submit" class="btn btn-primary">@lang('Save changes')</button>
                                </div>
                            </ul>
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
        $( document ).ready(function() {
            HSCore.components.HSTomSelect.init('.js-select', {
                maxOptions: 500
            })
        })
    </script>
@endpush
