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
    <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 px-4 py-8">
        <div class="max-w-3xl mx-auto">

            <div class="text-center mb-10">
                <div class="mb-3">
                    <img src="{{ getFile(optional($deposit->gateway)->driver, optional($deposit->gateway)->image) }}"
                        alt="gateway" class="gateway-img">
                </div>
                <h1 class="text-3xl font-bold text-white">@lang('Pay with' . ' ' . optional($deposit->gateway)->name)</h1>
                <p class="text-slate-400 text-sm mt-2">Please follow instructions below</p>
            </div>


            <div class="glass-card bg-slate-800/60 p-6 rounded-2xl">
                <div>
                    <div class="mb-4 text-white text-sm">
                        @lang('You have requested to deposit')
                        <b>{{ number_format($deposit->amount, 2) }} {{ $deposit->payment_method_currency }}</b>,
                        @lang('Please pay')
                        <b>{{ getAmount($deposit->payable_amount) }} {{ $deposit->payment_method_currency }}</b>
                        @lang('for successful payment.')

                        <p>@lang(optional($deposit->gateway)->note)</p>
                    </div>

                    <button onClick="payWithRave()" id="submit-btn"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-bold glow-orange">
                        <i class="fas fa-paper-plane mr-2"></i> @lang('Pay Now')
                    </button>
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
                onclose: function() {},
                callback: function(response) {
                    let txref = response.tx.txRef;
                    let status = response.tx.status;
                    window.location = '{{ url('payment/flutterwave') }}/' + txref + '/' + status;
                }
            });
        }
    </script>
@endpush
