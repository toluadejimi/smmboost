@extends(template().'layouts.app')
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
    <div id="block_122">
        <div class="block-bg"></div>
        <div class="container">
            <div class="add-funds__form">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="component_card">
                            <div class="card">
                                <form method="post" action="{{ route('user.add.fund.from.submit', $deposit->trx_id) }}" enctype="multipart/form-data" class="component_form_group">
                                    @csrf

                                    {{-- Instruction Section --}}
                                    <div class="text-center mb-4">
                                        <h4>@lang("Please follow the instruction below")</h4>
                                        <p>
                                            @lang("You have requested to deposit")
                                            <b>{{ number_format($deposit->amount, 2) }} {{ $deposit->payment_method_currency }}</b>,
                                            @lang("Please pay")
                                            <b class="text--base">{{ getAmount($deposit->payable_amount) }} {{ $deposit->payment_method_currency }}</b>
                                            @lang("for successful payment.")
                                        </p>
                                        <p>@lang(optional($deposit->gateway)->note)</p>
                                    </div>

                                    {{-- Dynamic Gateway Parameters --}}
                                    @if(optional($deposit->gateway)->parameters)
                                        @foreach($deposit->gateway->parameters as $k => $v)
                                            @php $fieldLabel = trans($v->field_label); @endphp

                                            @if($v->type == "text" || $v->type == "number" || $v->type == "date")
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ $fieldLabel }} <span class="text-danger">{{ $v->validation == 'required' ? '*' : '' }}</span></label>
                                                    <input 
                                                        type="{{ $v->type == 'date' ? 'date' : 'text' }}"
                                                        class="form-control"
                                                        name="{{ $k }}"
                                                        required="{{ $v->validation == 'required' }}"
                                                    >
                                                    @error($k)
                                                        <span class="text-danger">{{ trans($message) }}</span>
                                                    @enderror
                                                </div>
                                            @elseif($v->type == "textarea")
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ $fieldLabel }} <span class="text-danger">{{ $v->validation == 'required' ? '*' : '' }}</span></label>
                                                    <textarea class="form-control" name="{{ $k }}" rows="3" required="{{ $v->validation == 'required' }}"></textarea>
                                                    @error($k)
                                                        <span class="text-danger">{{ trans($message) }}</span>
                                                    @enderror
                                                </div>
                                            @elseif($v->type == "file")
                                                <div class="form-group mb-3">
                                                    <label class="form-label">{{ $fieldLabel }} <span class="text-danger">{{ $v->validation == 'required' ? '*' : '' }}</span></label>
                                                    <div class="d-flex gap-3 align-items-center">
                                                        <div class="image-area">
                                                            <img id="previewImage" src="{{ getFile(config('filelocation.default')) }}" alt="Choose Image" style="width: 100px; border-radius: 4px;">
                                                        </div>
                                                        <div class="btn-area">
                                                            <input class="form-control" type="file" accept="image/*" name="{{ $k }}" onchange="previewFile()">
                                                            <small>@lang("Allowed JPG, JPEG or PNG. Max size of 5MB")</small>
                                                        </div>
                                                    </div>
                                                    @error($k)
                                                        <span class="text-danger">{{ trans($message) }}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    {{-- Submit --}}
                                    <div class="component_button_submit">
                                        <button type="submit" class="btn btn-block btn-big-primary cmn-btn mt-3">
                                            @lang('Confirm Now')
                                        </button>
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

@push('script')
<script>
    'use strict';
    function previewFile() {
        const preview = document.getElementById('previewImage');
        const file = document.querySelector('input[type="file"]').files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
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
