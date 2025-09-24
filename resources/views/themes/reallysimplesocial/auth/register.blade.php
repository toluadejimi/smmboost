@extends(template() . 'layouts.app')
@section('title', trans('Register'))

@section('content')
    <div id="block_174">
        <div class="block-bg"></div>
        <div class="container">
            <div class="header-with-text ">
                <div class="row">
                    <div class="col-12">
                        <div class="text-block__title">
                            <h1 class="text-center">sign up to get started</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="text-block__description">
                            <p class="text-center"><span style="color: var(--color-id-200)"><span
                                        style="font-size: 20px">Choose a username and quickly set up your account with your
                                        email</span></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="block_146">
        <div class="block-bg"></div>
        <div class="container">
            <div class="sign-in">
                <div class="row sign-up-center-alignment">
                    <div class="col-lg-8">
                        <div class="component_card">
                            <div class="card">
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div>
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
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="login" class="control-label">Username</label>
                                                    <input type="text" class="form-control" id="login"
                                                        value="{{ old('username') }}" name="username">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        value="{{ old('email') }}" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="phone" class="control-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone"
                                                        value="{{ old('phone') }}" name="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="first_name" class="control-label">First name</label>
                                                    <input type="text" class="form-control" id="first_name"
                                                        value="{{ old('first_name') }}" name="first_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="last_name" class="control-label">Last name</label>
                                                    <input type="text" class="form-control" id="last_name"
                                                        value="{{ old('last_name') }}" name="last_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="password" class="control-label">Password</label>
                                                    <input type="password" class="form-control" id="password"
                                                        value="" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="password_again" class="control-label">Confirm
                                                        password</label>
                                                    <input type="password" class="form-control" id="password_again"
                                                        value="" name="password_confirmation">
                                                </div>
                                            </div>
                                        </div>
                                        @if ($basicControl->google_recaptcha == 1 && $basicControl->google_recaptcha_login == 1)
                                            <div class="g-recaptcha @error('g-recaptcha-response') is-invalid @enderror"
                                                data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                        @endif

                                        <div class="component_button_submit">
                                            <div class="form-group">
                                                <div class="">
                                                    <button type="submit" class="btn btn-block btn-big-primary">Sign
                                                        up</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">Already have an account?<a href="{{ route('home') }}"
                                                class="sign-up-center-signin-link">Sign in</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('extra-js')
    <script async src="https://www.google.com/recaptcha/api.js"></script>
@endpush

@push('script')
    <script>
        function refreshCaptcha() {
            let img = document.images['captcha_image'];
            img.src = img.src.substring(
                0, img.src.lastIndexOf("?")
            ) + "?rand=" + Math.random() * 1000;
        }
    </script>
@endpush

