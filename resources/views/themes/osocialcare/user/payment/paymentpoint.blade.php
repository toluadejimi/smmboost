@extends(template() . 'layouts.app')

@section('title')
    {{ 'Pay with ' . optional($gateway)->name ?? 'Manual Transfer' }}
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
            <div class="add-funds__form vh-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-lg-8">
                        <div class="component_card">
                            <div class="card">
                                <div class="text-center my-4">
                                    <h4>@lang('Pay with' . ' ' . optional($gateway)->name)</h4>
                                    <p>
                                        You have to pay via Paymentpoint by making a direct deposit to your virtual account.
                                    </p>
                                    <p>@lang(optional($gateway)->note)</p>
                                </div>

                                @if ($bankAccount)
                                    @php
                                        $bankJson = json_encode([
                                            "bank_name" => $bankAccount->bank_name,
                                            "account_name" => $bankAccount->account_name,
                                            "account_number" => $bankAccount->account_number,
                                            "bank_code" => $bankAccount->bank_code
                                        ]);  
                                    @endphp
                                    <div class="text-center mb-4">
                                        <button type="button" class="btn btn-big-primary cmn-btn mt-3" id="detail-btn" data-info='{{ $bankJson }}'
                                        data-toggle="modal" data-target="#describeModal">
                                            View Bank Account
                                        </button>
                                    </div>
                                @else
                                    <div class="text-center mb-4">
                                        <a href="{{ route('user.bank.create') }}" type="button" class="btn btn-big-primary cmn-btn mt-3">
                                            Generate Bank Account
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="describeModal" tabindex="-1" role="dialog" aria-labelledby="describeModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title" id="title"></h4>
                    <div class="userData">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {

            "use strict";

            $('#detail-btn').on('click', function() {
                var userData = $(this).data('info');
                var html = '';
                if (userData) {
                    Object.keys(userData).forEach(function(key) {
                        var field = userData[key];
                        
                        if (field != null) {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${key.charAt(0).toUpperCase() + key.slice(1)}</span>
                                <span>${field}</span>
                            </li>`;
                        }
                    });
                }

                if (!html) {
                    html = `<span class='d-block text-center mt-2 mb-2'>No data to display</span>`;
                }

                $('.userData').html(html);
                // modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
