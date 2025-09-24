@extends('admin.layouts.app')
@section('page_title', __('Edit Static Page'))
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-sm">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item"><a class="breadcrumb-link"
                                                           href="javascript:void(0)">@lang('Dashboard')</a></li>
                            <li class="breadcrumb-item">@lang('Frontend')</li>
                            <li class="breadcrumb-item active"
                                aria-current="page">@lang("Edit Static Page")</li>
                        </ol>
                    </nav>
                    <h1 class="page-header-title">@lang("Edit Static Page")</h1>
                </div>
            </div>
        </div>

        <div class="alert alert-soft-dark mb-5" role="alert">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <img class="avatar avatar-xl alert_image"
                         src="{{ asset('assets/admin/img/oc-megaphone.svg') }}"
                         alt="Image Description" data-hs-theme-appearance="default">
                    <img class="avatar avatar-xl alert_image"
                         src="{{ asset('assets/admin/img/oc-megaphone-light.svg') }}"
                         alt="Image Description" data-hs-theme-appearance="dark">
                </div>

                <div class="flex-grow-1 ms-3">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">@lang("You are editing static `$page->name` page for `$pageEditableLanguage->name` version in `".stringToTitle($theme)."`")</p>
                    </div>
                </div>
            </div>
        </div>



        <form action="{{ route("admin.update.static.page", [$page->id, $theme]) }}" method="post"
              enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="d-grid gap-3 gap-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title h4">@lang("Edit Page")</h2>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="language_id" value="{{ $pageEditableLanguage->id }}">

                                <div class="row mb-4">
                                    <div class="col-md-12 mb-5">
                                        <label for="NameLabel" class="form-label">@lang("Name")</label>
                                        <div class="input-group input-group-sm-vertical">
                                            <input type="text" class="form-control change_name_input" name="name"
                                                   id="NameLabel"
                                                   value="{{ old("name", optional($page->details)->name) }}"
                                                   placeholder="@lang("Name")"
                                                   autocomplete="off">
                                        </div>
                                        @error("name")
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label class="form-check form-check-dashed" for="logoUploader">
                                            <img id="logoImg"
                                                 class="avatar avatar-xl avatar-4x3 avatar-centered h-100 mb-2"
                                                 src="{{ getFile($page->breadcrumb_image_driver, $page->breadcrumb_image) }}"
                                                 alt="@lang("Breadcrumb Image")"
                                                 data-hs-theme-appearance="default">

                                            <span class="d-block">@lang("Browse your file here")</span>
                                            <input type="file" class="js-file-attach form-check-input"
                                                   name="breadcrumb_image" id="logoUploader"
                                                   data-hs-file-attach-options='{
                                                "textTarget": "#logoImg",
                                                "mode": "image",
                                                "targetAttr": "src",
                                                "allowTypes": [".png", ".jpeg", ".jpg"]
                                            }'>
                                        </label>
                                        @error("breadcrumb_image")
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label class="row form-check form-switch" for="breadcrumbStatus">
                                        <span class="col-8 col-sm-9 ms-0">
                                          <span class="text-dark">@lang("Breadcrumb Status")</span>
                                        </span>
                                            <span class="col-4 col-sm-3 text-end">
                                             <input type="hidden" name="breadcrumb_status" value="0">
                                            <input type="checkbox" class="form-check-input" name="breadcrumb_status"
                                                   id="breadcrumbSwitch"
                                                   value="1" {{ old("breadcrumb_status", $page->breadcrumb_status == 1 ? 'checked' : '') }}>
                                        </span>
                                        </label>
                                        @error("breadcrumb_status")
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-grid gap-3 gap-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title h4">@lang("Publish")</h2>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-start gap-2">
                                    <button type="submit" class="btn btn-primary" name="status"
                                            value="1">@lang("Save & Publish")</button>
                                    <button type="submit" class="btn btn-info" name="status"
                                            value="0">@lang("Save & Draft")</button>
                                </div>
                            </div>
                        </div>

                        <div class="card language_card">
                            <div class="card-header">
                                <h4 class="card-title">@lang("Language")</h4>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush list-group-no-gutters">
                                    @foreach($allLanguage as $language)
                                        @if($pageEditableLanguage->name !==  $language->name)
                                            <div class="list-group-item custom-list">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <img class="avatar avatar-xss avatar-square me-2"
                                                             src="{{ getFile($language->flag_driver, $language->flag) }}"
                                                             alt="{{ ucwords($language->name) }} Flag">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="row align-items-center">
                                                            <div class="col-sm mb-2 mb-sm-0">
                                                                <h5 class="mb-0">@lang($language->name)</h5>
                                                            </div>
                                                            @if($page->type !== 1 && $page->type !== 2)
                                                            <div class="col-sm-auto">
                                                                <a class="text-secondary"
                                                                   href="{{ route('admin.edit.page', [$page->id, $theme, $language->id]) }}"><i
                                                                        class="bi bi-pencil-square"></i></a>
                                                            </div>
                                                            @else
                                                                <div class="col-sm-auto">
                                                                    <a class="text-secondary"
                                                                       href="{{ route('admin.edit.static.page', [$page->id, $theme, $language->id]) }}"><i
                                                                            class="bi bi-pencil-square"></i></a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


@push('css-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/summernote-bs5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/tom-select.bootstrap5.css') }}">
@endpush

@push('js-lib')
    <script src="{{ asset('assets/admin/js/summernote-bs5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/tom-select.complete.min.js') }}"></script>
    <script src="{{ asset("assets/admin/js/hs-file-attach.min.js") }}"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            new HSFileAttach('.js-file-attach')
            HSCore.components.HSTomSelect.init('.js-select');
        });
    </script>
@endpush









