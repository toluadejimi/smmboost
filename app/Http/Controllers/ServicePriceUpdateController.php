<?php

namespace App\Http\Controllers;

use App\Models\ApiProvider;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ServicePriceUpdateController extends Controller
{
    public function update(Request $request)
    {
        try {
            $apiProviders = ApiProvider::with('services')->where('status', 1)->get();

            foreach ($apiProviders as $provider) {
                $response = Http::post($provider->url, [
                    'key' => $provider->api_key,
                    'action' => 'services',
                ]);

                if ($response->failed()) {
                    Log::error("API request failed for provider ID: {$provider->id}", ['response' => $response->body()]);
                    continue;
                }

                $responseData = collect($response->json());

                // dd($responseData);

                $updates = [];
                
                foreach ($provider->services as $service) {
                    if (!isset($service->price)) {
                        continue;
                    }

                    $apiRate = collect($responseData)->firstWhere('service', $service->api_service_id)['price']
                        ?? collect($responseData)->firstWhere('service', $service->api_service_id)['rate']
                        ?? $service->api_provider_price;

                    $conversionRate = $provider->conversion_rate ?: 1;
                    $originalPrice = $service->original_price ?: 1;
                    // $percentageIncrease = (((float) $service->price - (float) $originalPrice) / $originalPrice) * 100;
                    
                    // dd($conversionRate, $service->price, $originalPrice, $percentageIncrease);
                    
                    if ($apiRate) {
                        $increased_price = $apiRate * (30 / 100);
                        // dd($apiRate / $conversionRate);
                        
                        $updates[] = [
                            'id' => $service->id,
                            'api_provider_price' => $apiRate,
                            'price' => ($apiRate + $increased_price) / $conversionRate,
                            // 'price' => $apiRate / $conversionRate,
                            'updated_at' => now(),
                        ];
                    }
                }

                if (!empty($updates)) {
                    foreach ($updates as $update) {
                        Service::where('id', $update['id'])->update($update);
                    }
                }
            }

            return response()->json(['status' => 'success', 'message' => 'Service prices updated.']);
        } catch (\Exception $e) {
            Log::error('Error updating service prices', ['exception' => $e]);

            return response()->json(['status' => 'error', 'message' => 'An error occurred while updating service prices.'], 500);
        }
    }
}
