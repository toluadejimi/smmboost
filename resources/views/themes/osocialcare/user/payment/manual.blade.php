@extends(template() . 'layouts.user')
@section('title')
    {{ 'Pay with ' . optional($deposit->gateway)->name ?? 'Manual Transfer' }}
@endsection

@push('style')
    <style>
        img {
            width: 200px;
            border-radius: 4px;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 px-4 py-8">
        <div class="max-w-3xl mx-auto">

            <div class="text-center mb-10">
                <div
                    class="w-16 h-16 bg-gradient-to-r from-orange-500 to-amber-500 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-wallet text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-white">Manual Payment</h1>
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

                    <form action="{{ route('user.add.fund.from.submit', $deposit->trx_id) }}" enctype="multipart/form-data"
                        method="POST" class="space-y-4">
                        @csrf
                        {{-- Dynamic Gateway Parameters --}}
                        @if (optional($deposit->gateway)->parameters)
                            @foreach ($deposit->gateway->parameters as $k => $v)
                                @php $fieldLabel = trans($v->field_label); @endphp

                                @if ($v->type == 'text' || $v->type == 'number' || $v->type == 'date')
                                    <div>
                                        <label class="text-white text-sm">{{ $fieldLabel }} <span
                                                class="text-red-500">{{ $v->validation == 'required' ? '*' : '' }}</span></label>
                                        <input type="{{ $v->type == 'date' ? 'date' : 'text' }}" class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white"
                                            name="{{ $k }}" required="{{ $v->validation == 'required' }}">
                                        @error($k)
                                            <span class="text-red-400">{{ trans($message) }}</span>
                                        @enderror
                                    </div>
                                @elseif($v->type == 'textarea')
                                    <div>
                                        <label class="text-white text-sm">{{ $fieldLabel }} <span
                                                class="text-red-400">{{ $v->validation == 'required' ? '*' : '' }}</span></label>
                                        <textarea class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white" name="{{ $k }}" rows="3"
                                            required="{{ $v->validation == 'required' }}"></textarea>
                                        @error($k)
                                            <span class="text-danger">{{ trans($message) }}</span>
                                        @enderror
                                    </div>
                                @elseif($v->type == 'file')
                                    <div>
                                        <label class="text-white text-sm">{{ $fieldLabel }} <span
                                                class="text-danger">{{ $v->validation == 'required' ? '*' : '' }}</span></label>
                                        <div class="flex gap-3 items-center">
                                            <div class="image-area">
                                                <img id="previewImage" src="{{ getFile(config('filelocation.default')) }}"
                                                    alt="Choose Image" style="width: 100px; border-radius: 4px;">
                                            </div>
                                            <div class="btn-area">
                                                <input class="text-white" type="file" accept="image/*"
                                                    name="{{ $k }}" onchange="previewFile()">
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <small class="text-sm text-white">@lang('Allowed JPG, JPEG or PNG. Max size of 5MB')</small>
                                        </div>
                                        @error($k)
                                            <span class="text-red-400">{{ trans($message) }}</span>
                                        @enderror
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        <button type="submit" id="submit-btn"
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-xl font-bold glow-orange">
                            <i class="fas fa-paper-plane mr-2"></i> Confirm Now
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
    <script>
        'use strict';

        function previewFile() {
            const preview = document.getElementById('previewImage');
            const file = document.querySelector('input[type="file"]').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
@endpush
