@extends(template() . 'layouts.app')
@section('title', trans('Add Fund'))

@section('content')
    <div id="block_289">
        <div class="block-bg"></div>
        <div class="container">
            <div class="text-block-with-card ">
                <div class="row">
                    <div class="col-12">
                        <div class="component_card_1">
                            <div class="card">
                                <div class="text-block__description">
                                    <p>IMPORTANT | Make sure to pay in the exact amount you inputted.</p>
                                    <p><br></p>
                                    <p><strong style="font-weight: bold">IF YOUR PAYMENT DOESN'T REFELCT IMMEDIATELY PLEASE
                                            &nbsp;WAIT FOR AT LEAST 3 HOURS BEFORE FILLING A PAYMENTS TICKET BY SENDING A
                                            MAIL TO US </strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="block_122">
        <div class="block-bg"></div>
        <div class="container">
            <div class="add-funds__form">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="component_card">
                            <div class="card">
                                <form method="post" action="{{ route('user.payment.request') }}"
                                    class="component_form_group">
                                    @csrf
                                    <div>
                                        <div class="form-group">
                                            <label for="method" class="control-label">Method</label>
                                            <select class="form-control select-payment-method" id="method"
                                                name="gateway_id">
                                                @foreach ($gateways as $gateway)
                                                    <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div id="amount-fields">
                                                <div>
                                                    <label for="amount" class="control-label">Amount <span
                                                            id="amount_label_currency" class="hidden"></span></label>
                                                    <input type="number" class="form-control" name="amount" id="amount"
                                                        step="0.0000000001" placeholder="0.00" autocomplete="off">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" id="currency-section">
                                            <label class="form-label">Supported Currency</label>
                                            <select class="form-control cmn-select2" name="supported_currency"
                                                id="supported_currency">
                                                <option value="" disabled selected>Select Currency</option>
                                            </select>
                                        </div>

                                        <div class="form-group d-none" id="crypto-currency-section">
                                            <label class="form-label">Crypto Currency</label>
                                            <select class="form-control crypto-select" name="supported_crypto_currency"
                                                id="supported_crypto_currency">
                                                <option value="">Select Crypto Currency</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_csrf" value="{{ csrf_token() }}">
                                    <div class="component_button_submit">
                                        <div class="form-check mt-3">
                                            <input type="checkbox" class="form-check-input agree-checked"
                                                id="agreeCheckbox">
                                            <label class="form-check-label" for="agreeCheckbox">
                                                I agree to the <a href="{{ url('terms-and-conditions') }}"
                                                    target="_blank">terms and conditions</a>.
                                            </label>
                                        </div>
                                        <div class="mt-3">
                                            <ul class="transfer-list show-deposit-summery"></ul>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-block btn-big-primary cmn-btn"
                                                disabled>Pay</button>
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
    <div id="block_109">
        <div class="block-bg"></div>
        <div class="container">
            <div class="add-funds__list">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="table-bg component_table">
                            <div class="table-wr table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>@lang('Transaction ID')</th>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Method')</th>
                                            <th>@lang('Amount')</th>
                                            <th>@lang("Status")</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($deposits as $deposit)
                                            <tr>
                                                <td>{{ '#' . $deposit->trx_id }}</td>
                                                <td>{{ dateTime($deposit->created_at) }}</td>
                                                <td>@lang(optional($deposit->gateway)->name)</td>
                                                <td>
                                                    @if (auth()->user()->currency)
                                                        {{ currencyPositionBySelectedCurrency($deposit->payable_amount_in_base_currency * $currency->conversion_rate, auth()->user()->currency) }}
                                                    @else
                                                        {{ currencyPosition($deposit->payable_amount_in_base_currency) }}
                                                    @endif
                                                </td>
                                                <td data-label="@lang("Status")">
                                                    @if($deposit->status == 1)
                                                        <span class="badge text-bg-success">@lang('Complete')</span>
                                                    @elseif($deposit->status == 2)
                                                        <span class="badge text-bg-warning">@lang('Pending')</span>
                                                    @elseif($deposit->status == 3)
                                                        <span class="badge text-bg-danger">@lang('Cancel')</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <img src="{{ asset('assets/global/img/oc-error.svg') }}" alt="No Data"
                                                        style="width: 100px;" class="mb-2">
                                                    <p>@lang('The deposits are not available.')</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="row">
                    <div class="col-lg-5">
                        <nav class="component_pagination">
                            {{ $deposits->appends($_GET)->links(template() . 'partials.pagination') }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict';

        $(document).ready(function() {
            let selectedGateway = $('#method').val();

            function supportCurrency(gatewayId) {
                if (!gatewayId) return;

                $('#supported_currency').empty();
                $('#supported_crypto_currency').empty();
                $.ajax({
                    url: "{{ route('user.supported.currency') }}",
                    data: {
                        gateway: gatewayId
                    },
                    type: "GET",
                    success: function(response) {
                        if (response.currencyType === 1) {
                            $('#currency-section').removeClass('d-none');
                            $('#crypto-currency-section').addClass('d-none');
                            $(response.data).each(function(i, val) {
                                $('#supported_currency').append(
                                    `<option value="${val}">${val}</option>`);
                            });
                            $('#amount').val(response.min_amount || 10);
                        } else {
                            $('#currency-section').addClass('d-none');
                            $('#crypto-currency-section').removeClass('d-none');
                            $(response.data).each(function(i, val) {
                                $('#supported_crypto_currency').append(
                                    `<option value="${val}">${val}</option>`);
                            });
                            $('#amount').val(response.min_amount || 10);
                        }

                        checkAmount($('#amount').val(), $('#supported_currency').val(), gatewayId, $(
                            '#supported_crypto_currency').val());
                    }
                });
            }

            function checkAmount(amount, currency, gateway, crypto = null) {
                $.ajax({
                    method: "GET",
                    url: "{{ route('user.deposit.checkAmount') }}",
                    data: {
                        amount: amount,
                        selected_currency: currency,
                        select_gateway: gateway,
                        selectedCryptoCurrency: crypto
                    },
                    success: function(response) {
                        let field = $('#amount');
                        if (response.status) {
                            field.removeClass('is-invalid').addClass('is-valid');
                            $('.cmn-btn').prop('disabled', false);
                            showSummery(response, "{{ basicControl()->base_currency }}");
                        } else {
                            field.removeClass('is-valid').addClass('is-invalid');
                            field.next('.invalid-feedback').html(response.message);
                            $('.cmn-btn').prop('disabled', true);
                        }
                    }
                });
            }

            function showSummery(response, baseCurrency) {
                let html = `
                <li><span>Amount:</span> ${response.amount.toFixed(2)} ${response.currency}</li>
                <li><span>Charge:</span> ${response.charge.toFixed(2)} ${response.currency}</li>
                <li><span>Payable:</span> ${response.payable_amount.toFixed(2)} ${response.currency}</li>
                <li><span>Exchange Rate:</span> 1 ${baseCurrency} = ${response.conversion_rate} ${response.currency}</li>
                <li><span>Base Currency Payable:</span> ${response.amount_in_base_currency} ${baseCurrency}</li>
            `;
                $('.show-deposit-summery').html(html);
            }

            $('#method').on('change', function() {
                selectedGateway = $(this).val();
                console.log(selectedGateway);
                if(selectedGateway === "43"){
                    $('#currency-section').addClass('d-none');
                    $('.show-deposit-summery').html("");
                    return;
                }
                supportCurrency(selectedGateway);
            });

            $('#amount, #supported_currency, #supported_crypto_currency').on('input change', function() {
                if(selectedGateway !== "43"){
                    checkAmount($('#amount').val(), $('#supported_currency').val(), selectedGateway, $(
                        '#supported_crypto_currency').val());
                }
            });

            $('.agree-checked').on('change', function() {
                $('.cmn-btn').prop('disabled', !$(this).is(':checked'));
            });

            // Initial load
            if (selectedGateway) supportCurrency(selectedGateway);
        });
    </script>
@endpush
