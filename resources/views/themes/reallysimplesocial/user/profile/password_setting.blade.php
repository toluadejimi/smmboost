@extends(template().'layouts.app')
@section('title',trans('Password Setting'))

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
                                        <a class="nav-link" href="{{ route('user.profile') }}">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('user.password.setting') }}">Password Setting</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="component_card">
                            <div class="card account-card">
                                <form class="component_form_group" method="post" action="{{ route('user.update.password') }}">
                                    <div class="">
                                                                    <div class="form-group">
                                            <label>Current password</label>
                                            <input type="password" class="form-control" id="current" name="current_password">
                                        </div>
                                        <div class="form-group">
                                            <label>New password</label>
                                            <input type="password" class="form-control" id="new" name="password">
                                        </div>
                                    </div>
                                    <div class="component_button_save">
                                        <div class="">
                                            @csrf
                                            <button class="btn btn-block btn-big-primary" type="submit">
                                                Change password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection