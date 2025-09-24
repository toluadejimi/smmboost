@extends(template() . 'layouts.user')
@section('title', trans('Add Fund'))

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 px-4 py-8">
        <div class="max-w-3xl mx-auto">

            <div class="text-center mb-10">
                <div
                    class="w-16 h-16 bg-gradient-to-r from-orange-500 to-amber-500 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-wallet text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-white">Fund Wallet</h1>
                <p class="text-slate-400 text-sm mt-2">Choose your preferred funding method</p>
            </div>


            <div x-data="{ tab: 'other' }" class="glass-card bg-slate-800/60 p-6 rounded-2xl">
                <div class="flex mb-6 gap-2 bg-slate-700 rounded-xl p-1">
{{--                    <button @click="tab = 'auto'" class="flex-1 tab-button text-sm py-2 rounded-xl transition"--}}
{{--                        :class="tab === 'auto' ? 'active bg-orange-500 text-white' : 'text-slate-300'">--}}
{{--                        Auto Funding--}}
{{--                    </button>--}}
                    <button @click="tab = 'other'" class="flex-1 tab-button text-sm py-2 rounded-xl transition"
                        :class="tab === 'other' ? 'active bg-orange-500 text-white' : 'text-slate-300'">
                        Instant Payments
                    </button>
                </div>


{{--                <div x-show="tab === 'auto'" x-transition>--}}

{{--                    @if ($bankAccount)--}}
{{--                        <div class="space-y-4">--}}
{{--                            <div class="bg-slate-800 p-4 rounded-xl text-white">--}}
{{--                                <div class="mb-2 text-sm text-slate-400">Bank</div>--}}
{{--                                <div class="font-semibold">{{ $bankAccount->bank_name }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="bg-slate-800 p-4 rounded-xl flex justify-between items-center">--}}
{{--                                <div>--}}
{{--                                    <div class="mb-1 text-sm text-slate-400">Account Number</div>--}}
{{--                                    <div class="font-mono text-lg font-bold text-white">{{ $bankAccount->account_number }}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <button onclick="copyToClipboard('{{ $bankAccount->account_number }}')"--}}
{{--                                    class="text-orange-400 hover:text-orange-300" title="Copy">--}}
{{--                                    <i class="fas fa-copy"></i>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="bg-slate-800 p-4 rounded-xl text-white">--}}
{{--                                <div class="mb-2 text-sm text-slate-400">Account Name</div>--}}
{{--                                <div class="font-semibold">{{ $bankAccount->account_name }}</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="text-center">--}}
{{--                            <p class="text-white mb-4">No virtual account generated yet</p>--}}
{{--                            <form method="POST" action="{{ route('user.bank.create') }}">--}}
{{--                                @csrf--}}
{{--                                <button type="submit"--}}
{{--                                    class="px-6 py-3 bg-orange-500 text-white rounded-xl font-semibold glow-orange">--}}
{{--                                    Generate Virtual Account--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}


                <div x-show="tab === 'other'" x-transition>
                    <div class="mb-4 text-white text-sm">
                        Make Payments using other payment gateways
                    </div>

                    <form action="{{ route('user.payment.request') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="text-white text-sm">Method (₦)</label>
                            <select name="gateway_id" id="method"
                                class="w-full rounded-lg bg-gray-700 text-gray-100 border border-gray-600 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none p-3 text-xs transition-all duration-200">
                                @foreach ($gateways as $gateway)
                                    <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-white text-sm">Amount (₦)</label>
                            <input type="number" min="100" name="amount" id="amount"
                                class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white"
                                required="">
                            <div class="error-message" id="amount-error"></div>
                        </div>
                        <div id="currency-section">
                            <label class="text-white text-sm">Supported Currency</label>
                            <select name="supported_currency"
                                class="w-full rounded-lg bg-gray-700 text-gray-100 border border-gray-600 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none p-3 text-xs transition-all duration-200">
                                <option value="" >NGN</option>
                            </select>
                        </div>
                        <div class="hidden" id="crypto-currency-section">
                            <label class="text-white text-sm">Crypto Currency</label>
                            <select name="supported_currency" id="supported_currency"
                                class="w-full rounded-lg bg-gray-700 text-gray-100 border border-gray-600 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none p-3 text-xs transition-all duration-200">
                                <option value="" disabled selected>Select Currency</option>
                            </select>
                        </div>
                        <div>
                            <ul class="transfer-list show-deposit-summery text-white hidden"></ul>
                        </div>
                        <button type="submit" id="submit-btn"
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-bold glow-orange">
                            <i class="fas fa-paper-plane mr-2"></i> Confirm and continue
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="toast" class="toast" style="display:none;">
        <i class="fas fa-check-circle"></i>
        <span id="toast-message">Copied!</span>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    <script>
        function showToast(msg, type = 'success') {
            const toast = document.getElementById('toast');
            const message = document.getElementById('toast-message');
            message.textContent = msg;
            toast.style.background = type === 'error' ? 'rgba(239, 68, 68, 0.9)' : 'rgba(34, 197, 94, 0.9)';
            toast.style.display = 'flex';
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
                toast.style.display = 'none';
            }, 3000);
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => showToast('Account number copied!')).catch(() => showToast(
                'Copy failed', 'error'));
        }
    </script>
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
                if (selectedGateway === "43") {
                    $('#currency-section').addClass('d-none');
                    $('.show-deposit-summery').html("");
                    return;
                }
                supportCurrency(selectedGateway);
            });

            $('#amount, #supported_currency, #supported_crypto_currency').on('input change', function() {
                if (selectedGateway !== "43") {
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
