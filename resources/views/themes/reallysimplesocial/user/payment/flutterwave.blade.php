@extends(template() . 'layouts.app')

@section('title')
    {{ 'Pay with ' . optional($deposit->gateway)->name ?? 'Manual Transfer' }}
@endsection

@push('style')
    <style>
        img.gateway-img {
            width: 200px;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <div id="block_122">
        <div class="block-bg"></div>
        <div class="container">
            <div class="add-funds__form">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="component_card">
                            <div class="card">
                                <div class="text-center my-4">
                                    <h4>@lang('Pay with' . ' ' . optional($deposit->gateway)->name)</h4>
                                    <div class="mb-3">
                                        <img
                                            src="{{ getFile(optional($deposit->gateway)->driver, optional($deposit->gateway)->image) }}"
                                            alt="gateway" class="gateway-img">
                                    </div>
                                    <p>
                                        @lang('You have requested to deposit')
                                        <b>{{ number_format($deposit->amount, 2) }} {{ $deposit->payment_method_currency }}</b>.
                                        @lang('Please pay')
                                        <b class="text--base">{{ getAmount($deposit->payable_amount) }} {{ $deposit->payment_method_currency }}</b>
                                        @lang('for successful payment.').
                                    </p>
                                    <p>@lang(optional($deposit->gateway)->note)</p>
                                </div>

                                <div class="text-center mb-4">
                                    <button type="button" class="btn btn-big-primary cmn-btn mt-3"
                                            id="btn-confirm" onClick="payWithRave()">
                                        @lang('Pay Now')
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
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <script>
        'use strict';
        let btn = document.querySelector("#btn-confirm");
        btn.setAttribute("type", "button");

        const API_publicKey = "{{ $data->API_publicKey }}";

        function payWithRave() {
            let x = getpaidSetup({
                PBFPubKey: API_publicKey,
                customer_email: "{{ $data->customer_email }}",
                amount: "{{ $data->amount }}",
                customer_phone: "{{ $data->customer_phone }}",
                currency: "{{ $data->currency }}",
                txref: "{{ $data->txref }}",
                onclose: function () {},
                callback: function (response) {
                    let txref = response.tx.txRef;
                    let status = response.tx.status;
                    window.location = '{{ url('payment/flutterwave') }}/' + txref + '/' + status;
                }
            });
        }
    </script>
@endpush
