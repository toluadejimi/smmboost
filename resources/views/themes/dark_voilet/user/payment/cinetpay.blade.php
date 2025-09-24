@extends(template().'layouts.user')
@section('title')
    {{ 'Pay with '.optional($deposit->gateway)->name ?? '' }}
@endsection

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.cinetpay.com/seamless/main.js"></script>
    <style>
        .sdk {
            display: block;
            position: absolute;
            background-position: center;
            text-align: center;
            left: 45%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .main-card {
            margin-top: 150px;
        }
    </style>



    <main id="main" class="main bg-color2">
        <div class="pagetitle">
            <h3 class="mb-1">@lang('Pay with ' . optional($deposit->gateway)->name)</h3>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">@lang("Home")</a></li>
                    <li class="breadcrumb-item">@lang("add fund")</li>
                    <li class="breadcrumb-item active">@lang('Pay with ' . optional($deposit->gateway)->name)</li>
                </ol>
            </nav>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-7 col-md-6">
                <div class="card main-card">
                    <div class="card-body ">
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <div class="card">
                                    <img
                                        src="{{getFile(optional($deposit->gateway)->driver, optional($deposit->gateway)->image)}}"
                                        class="card-img-top gateway-img" alt="..">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>@lang('Please Pay') {{getAmount($deposit->payable_amount)}} {{$deposit->payment_method_currency}}</h4>
                                <h4>@lang('To Get') {{getAmount($deposit->amount)}}  {{ $deposit->payment_method_currency }}</h4>
                                <div class="sdk">
                                    <button class="cmn-btn text-start mt-2"
                                            onclick="checkout()">@lang('Pay Now')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('script')
    <script>
        function checkout() {
            CinetPay.setConfig({
                apikey: '{{optional($deposit->gateway)->parameters->apiKey}}',//   YOUR APIKEY
                site_id: '{{optional($deposit->gateway)->parameters->site_id}}',//YOUR_SITE_ID
                notify_url: '{{route('ipn', [$deposit->gateway->code, $deposit->trx_id])}}',
                return_url: '{{route('success')}}',
                mode: 'PRODUCTION'
                // mode: 'SANDBOX'
            });
            CinetPay.getCheckout({
                transaction_id: '{{$deposit->trx_id}}', // YOUR TRANSACTION ID
                amount: {{(int) $deposit->payable_amount}},
                currency: '{{optional($deposit->gateway)->currency}}',
                channels: 'ALL',
                description: 'Test de paiement',
                //Fournir ces variables pour le paiements par carte bancaire
                customer_name: "{{optional($deposit->user)->username ?? 'abc'}}",//Le nom du client
                customer_surname: "{{optional($deposit->user)->username ?? 'abc'}}",//Le prenom du client
                customer_email: "{{optional($deposit->user)->email ?? 'abc'}}",//l'email du client
                customer_phone_number: "{{optional($deposit->user)->phone ?? 'abc'}}",//l'email du client
                customer_address: "BP 0024",//addresse du client
                customer_city: "Antananarivo",// La ville du client
                customer_country: "CM",// le code ISO du pays
                customer_state: "CM",// le code ISO l'état
                customer_zip_code: "06510", // code postal

            });
            CinetPay.waitResponse(function (data) {
                if (data.status == "REFUSED") {
                    if (alert("Votre paiement a échoué")) {
                        window.location.reload();
                    }
                } else if (data.status == "ACCEPTED") {
                    if (alert("Votre paiement a été effectué avec succès")) {
                        window.location.reload();
                    }
                }
            });
            CinetPay.onError(function (data) {
                console.log(data);
            });
        }
    </script>
@endpush



