@extends(template() . 'layouts.app')
@section('title', trans('Mass Order'))

@section('content')
    <div id="block_111">
        <div class="block-bg"></div>
        <div class="container">
            <div class="new_order-block">
                <div class="row mass-order__alignment">
                    <div class="col-lg-12">
                        <div class="component_card">
                            <div class="card">
                                <form method="post" action="{{ route('user.draft.order.store') }}">
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
                                                    <label for="links" class="control-label">One order per line in
                                                        format</label>
                                                    <textarea class="form-control" name="mass_order" rows="15" id="links"
                                                        placeholder="service_id | link | quantity">{{ old('mass_order') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="component_button_submit">
                                            <div class="">
                                                <button type="submit" class="btn btn-block btn-big-primary">Submit</button>
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
    </div>
@endsection
