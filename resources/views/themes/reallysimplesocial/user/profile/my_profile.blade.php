@extends(template() . 'layouts.app')
@section('title', trans('Profile'))

@section('content')
    <div id="block_115">
        <div class="block-bg"></div>
        <div class="container">
            <div class="account ">
                <div class="row">
                    <div class="col-lg-12">
                        @if (session('success'))
                            <div class="alert alert-dismissible alert-success mb-3">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ __(session('success')) }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-dismissible alert-danger mb-3">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ __($error) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="component_tabs account-card">
                            <div class="">
                                <ul class="nav nav-pills tab">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('user.profile') }}">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.password.setting') }}">Password Setting</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf
                            <div class="component_card">
                                <div class="card account-card">
                                    <div class="component_form_group">
                                        <div class="">
                                            <div class="form-group">
                                                <label for="firstname">@lang('First Name')</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname"
                                                    value="{{ old('firstname', auth()->user()->firstname) }}"
                                                    autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label for="lastname">@lang('Last Name')</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname"
                                                    value="{{ old('lastname', auth()->user()->lastname) }}"
                                                    autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">@lang('Email')</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', auth()->user()->email) }}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="telephone">@lang('Phone Number')</label>
                                                <input type="hidden" name="phone_code" value="+880">
                                                <input type="tel" class="form-control" id="telephone" name="phone"
                                                    value="{{ old('phone', auth()->user()->phone) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="address">@lang('Address')</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ old('address', auth()->user()->address_one) }}"
                                                    autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label for="state">@lang('State')</label>
                                                <input type="text" class="form-control" id="state" name="state"
                                                    value="{{ old('state', auth()->user()->state) }}" autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label for="zipcode">@lang('Zip Code')</label>
                                                <input type="text" class="form-control" id="zipcode" name="zipcode"
                                                    value="{{ old('zipcode', auth()->user()->zip_code) }}"
                                                    autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label for="country">@lang('Country')</label>
                                                <select class="form-control cmn-select2" name="country" id="country_name">
                                                    <option value="" disabled selected>@lang('Select Country')</option>
                                                    @forelse($countries as $country)
                                                        <option value="{{ $country['name'] }}"
                                                            {{ old('country', $country['name']) == auth()->user()->country ? 'selected' : '' }}>
                                                            {{ $country['name'] }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <input type="hidden" name="country_code" id="country_code">
                                            </div>

                                            <div class="form-group">
                                                <label for="language">@lang('Language')</label>
                                                <select class="form-control cmn-select2" name="language">
                                                    <option value="" selected disabled>@lang('Select Language')</option>
                                                    @forelse($languages as $lang)
                                                        <option value="{{ $lang->id }}"
                                                            {{ old('language', $lang->id) == auth()->user()->language_id ? 'selected' : '' }}>
                                                            @lang($lang->name)
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="time_zone">@lang('Time Zone')</label>
                                                <select class="form-control cmn-select2" name="time_zone">
                                                    <option value="">@lang('Select Timezone')</option>
                                                    @foreach (timezone_identifiers_list() as $value)
                                                        <option value="{{ $value }}"
                                                            {{ old('time_zone', auth()->user()->time_zone) == $value ? 'selected' : '' }}>
                                                            {{ __($value) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="component_button_save mt-4">
                                                <button type="submit"
                                                    class="btn btn-block btn-big-primary">@lang('Save Changes')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="component_card">
                            <div class="card account-card">
                                <div style=" display: none; " class="alert alert-dismissible alert-danger mr-2 mb-3 ">
                                    <button type="button" class="close">×</button>
                                    <span></span>
                                </div>
                                <form class="component_form_group" action="{{ route('user.keyGenerate') }}"
                                    method="post">
                                    <div class="">
                                        <div class="form-group">
                                            <label>API key</label>
                                            <div class="d-flex">
                                                @if ($api_token === null)
                                                    <div class="">
                                                        <div class="component_button_save">
                                                            <div class="">
                                                                @csrf
                                                                <button class="btn btn-block btn-big-primary"
                                                                    type="submit">
                                                                    Generate new
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="w-100">
                                                        <input type="text" class="form-control" id="api_key"
                                                            value="{{ $api_token }}" readonly=""
                                                            data-original-title="" title="">
                                                    </div>
                                                    <div class="account-button-right">
                                                        <div class="component_button_save">
                                                            <div class="">
                                                                @csrf
                                                                <button class="btn btn-block btn-big-primary"
                                                                    type="submit">
                                                                    Generate new
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change email -->
            <div class="modal fade" tabindex="-1" role="dialog" id="changeEmailModal" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <form id="changeEmailForm" class="modal-content" method="post" action="/change-email">
                        <div class="modal-header">
                            <h4 class="modal-title">Change email</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body component_form_group">
                            <div id="changeEmailError"
                                class="error-summary alert alert-dismissible alert-danger mb-3 hidden">
                            </div>
                            <div class="form-group">
                                <label for="current-email">Current email</label>
                                <input type="email" class="form-control" value="onepeakstore3@gmail.com"
                                    readonly="">
                            </div>
                            <div class="form-group">
                                <label for="new-email">New email</label>
                                <input type="email" class="form-control" id="new-email" name="ChangeEmailForm[email]">
                            </div>
                            <div class="form-group">
                                <label for="current-password">Current password</label>
                                <input type="password" class="form-control" id="current-password"
                                    name="ChangeEmailForm[password]">
                            </div>
                            <input type="hidden" name="_csrf"
                                value="Js5anBMBHYlAHoj6Gj1cPH6OML2NU5SjlOSd-YkDtANAiyDPV3VrvDRY24kscS5mE-Fp8tIn0dnRr-Wz7HD8QA==">
                        </div>
                        <div class="modal-footer component_button_save">
                            <button type="button" class="btn btn-big-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-big-primary" id="changeEmailSubmitBtn">Change
                                email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
