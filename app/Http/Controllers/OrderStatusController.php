<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class OrderStatusController extends Controller
{
    public function handle()
    {
        $orders = Order::with(['service', 'service.provider', 'users'])
            ->whereNotIn('status', ['completed', 'refunded', 'canceled'])
            ->whereHas('service', function ($query) {
                $query->whereNotNull('api_provider_id')
                      ->orWhere('api_provider_id', '!=', 0);
            })
            ->get();

        $results = [];

        foreach ($orders as $order) {
            $service = $order->service;

            if (isset($service->api_provider_id)) {
                $apiproviderdata = $service->provider;

                $response = Http::asForm()->post($apiproviderdata->url, [
                    'key' => $apiproviderdata->api_key,
                    'action' => 'status',
                    'order' => $order->api_order_id,
                ]);

                $apidata = $response->json();

                $results[] = [
                    'order_id' => $order->id,
                    'status_response' => $apidata,
                ];

                if (isset($apidata['status'])) {
                    $order->status = (strtolower($apidata['status']) === 'in progress') ? 'progress' : strtolower($apidata['status']);
                    $order->start_counter = $apidata['start_count'] ?? null;
                    $order->remains = $apidata['remains'] ?? null;
                }

                if (isset($apidata['error'])) {
                    $order->status_description = "error: {" . $apidata['error'] . "}";
                }

                $order->save();

                // Handle refund if refunded
                if ($order->status === 'refunded' && $order->remains != 0) {
                    $perOrder = $order->price / $order->quantity;
                    $getBackAmo = $order->remains * $perOrder;

                    $user = $order->users;
                    $user->balance += $getBackAmo;
                    $user->save();

                    Transaction::create([
                        'user_id' => $user->id,
                        'child_panel_id' => $order->child_panel_id ?? null,
                        'trx_type' => '+',
                        'amount' => $getBackAmo,
                        'remarks' => 'Refunded order on #' . $order->id,
                        'charge' => 0,
                    ]);
                }

                // Handle refund if canceled
                if ($order->status === 'canceled') {
                    $getBackAmo = $order->price;

                    $user = $order->users;
                    $user->balance += $getBackAmo;
                    $user->save();

                    Transaction::create([
                        'user_id' => $user->id,
                        'child_panel_id' => $order->child_panel_id ?? null,
                        'trx_type' => '+',
                        'amount' => $getBackAmo,
                        'remarks' => 'Canceled order on #' . $order->id,
                        'charge' => 0,
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'Order statuses processed.',
            'results' => $results,
        ]);
    }
}
