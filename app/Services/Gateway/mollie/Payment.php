<?php

namespace App\Services\Gateway\mollie;

use Facades\App\Services\BasicService;
use Mollie\Laravel\Facades\Mollie;

class Payment
{
    public static function prepareData($deposit, $gateway)
    {
        $basic = $deposit->child_panel_id ? generalSetting() : basicControl();
        config(['mollie.key' => trim($gateway->parameters->api_key)]);

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $deposit->payment_method_currency,
                'value' => number_format($deposit->payable_amount, 2, '.', ''),
            ],
            'description' => "Payment To $basic->site_title Account",
            'redirectUrl' => route('ipn', [$deposit->child_panel_id ? $gateway->gateway->code : $gateway->code, $deposit->trx_id]),
            'metadata' => [
                "order_id" => $deposit->trx_id,
            ],
        ]);

        session()->put('payment_id', $payment->id);

        $payment = Mollie::api()->payments()->get($payment->id);

        $send['redirect'] = true;
        $send['redirect_url'] = $payment->getCheckoutUrl();

        return json_encode($send);
    }

    public static function ipn($request, $gateway, $deposit = null, $trx = null, $type = null)
    {
        config(['mollie.key' => trim($gateway->parameters->api_key)]);
        $payment = Mollie::api()->payments()->get(session()->get('payment_id'));
        if ($payment->status == "paid") {
            BasicService::preparePaymentUpgradation($deposit);

            $data['status'] = 'success';
            $data['msg'] = 'Transaction was successful.';
            $data['redirect'] = route('success');
        } else {
            $data['status'] = 'error';
            $data['msg'] = 'Invalid response.';
            $data['redirect'] = route('failed');
        }

        return $data;
    }
}
