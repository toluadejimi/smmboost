@extends('admin.layouts.app')
@section('page_title', __('Cookie Control'))
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item"><a class="breadcrumb-link"
                                                           href="javascript:void(0)">@lang('Dashboard')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('Settings')</li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('Cookie Controls')</li>
                        </ol>
                    </nav>
                    <h1 class="page-header-title">@yield('page_title')</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('admin.control_panel.components.sidebar', ['settings' => config('generalsettings.settings'), 'suffix' => 'Settings'])
            </div>
            <div class="col-lg-7">
                <div class="d-grid gap-3 gap-lg-5">
                    <div class="card h-100">
                        <div class="card-header card-header-content-between">
                            <h4 class="card-header-title">@lang('Cookie Control')</h4>
                        </div>
                        <!-- Body -->
                        <div class="card-body">
                            <form action="{{ route('admin.cookie.control') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <label for="cookie_title"
                                           class="col-sm-3 col-form-label form-label">@lang("Title")</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                               class="form-control @error('cookie_title') is-invalid @enderror"
                                               name="cookie_title" id="cookie_title"
                                               placeholder="@lang("Cookie Title")"
                                               value="{{ old('cookie_title', @$basic->cookie_title) }}"
                                               autocomplete="off">
                                        @error('cookie_title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="cookie_sub_title"
                                           class="col-sm-3 col-form-label form-label">@lang("Cookie Sub Title")</label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                               class="form-control @error('cookie_sub_title') is-invalid @enderror"
                                               name="cookie_sub_title" id="cookie_sub_title"
                                               placeholder="@lang("Cookie Sub Title")"
                                               value="{{ old('cookie_sub_title', @$basic->cookie_sub_title) }}"
                                               autocomplete="off">
                                        @error('cookie_sub_title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="cookie_url"
                                           class="col-sm-3 col-form-label form-label">@lang("Cookie Url")
                                        {!! toolTip('set the full url of page link',) !!}
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text"
                                               class="form-control"
                                               id="cookie_url"
                                               name="cookie_url"
                                               value="{{ @$basic->cookie_url }}"
                                               autocomplete="off">
                                    </div>
                                </div>

                                <label class="row form-check form-switch mb-4" for="cookie_status">
                                    <span class="col-8 col-sm-9 ms-0">
                                        <span class="d-block text-dark">@lang("Status")</span>
                                        <span class="d-block fs-5">
                                            @lang("Change status to enable or disable cookie-policy on website.")
                                        </span>
                                    </span>
                                    <span class="col-4 col-sm-3 text-end">
                                        <input type='hidden' value='0' name='cookie_status'>
                                        <input type="checkbox" name="cookie_status" id="cookie_status"
                                               value="1" class="form-check-input"
                                            {{ $basic->cookie_status == 1 ? 'checked' : ''}} >
                                    </span>
                                    @error('cookie_status')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </label>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">@lang('Save changes')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        'use strict'

        function webhookCopy() {
            var copyText = document.getElementById("webhook");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            Notiflix.Notify.success(`${copyText.value} Copied`);
        }
    </script>
    @if ($errors->any())
        @php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        @endphp
        <script>
            "use strict";
            @foreach ($errors as $error)
            Notiflix.Notify.failure("{{trans($error)}}");
            @endforeach
        </script>
    @endif
@endpush
