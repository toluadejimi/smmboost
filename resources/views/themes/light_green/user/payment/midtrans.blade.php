@extends(template().'layouts.user')
@section('title')
    {{ __('Pay with ').__(optional($deposit->gateway)->name) }}
@endsection
@section('content')

    @push('style')
        <style>
            .gateway-img {
                border-radius: 5px;
            }
        </style>
    @endpush


    <div class="dashboard-wrapper d-flex align-items-center">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-7 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <img
                                        src="{{ getFile(optional($deposit->gateway)->driver, optional($deposit->gateway)->image) }}"
                                        class="card-img-top gateway-img">
                                </div>
                                <div class="col-md-6">
                                    <h5 class="my-3">@lang('Please Pay') {{getAmount($deposit->payable_amount)}} {{$deposit->payment_method_currency}}</h5>
                                    <button type="button"
                                            class="cmn-btn rounded-1"
                                            id="pay-button">@lang('Pay Now')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @if($data->environment == 'test')
        <script type="text/javascript"
                src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ $data->client_key }}"></script>
    @else
        <script type="text/javascript"
                src="https://app.midtrans.com/snap/snap.js"
                data-client-key="{{ $data->client_key }}"></script>
    @endif
    <script defer>
        let payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay("{{ $data->token }}", {
                onSuccess: function (result) {
                    let route = '{{ route('ipn', ['midtrans']) }}/';
                    window.location.href = route + result.order_id;
                },
                onPending: function (result) {
                    let route = '{{ route('ipn', ['midtrans']) }}/';
                    window.location.href = route + result.order_id;
                },
                onError: function (result) {
                    window.location.href = '{{ route('failed') }}';
                },
                onClose: function () {
                    window.location.href = '{{ route('failed') }}';
                }
            });
        });
    </script>
@endpush



