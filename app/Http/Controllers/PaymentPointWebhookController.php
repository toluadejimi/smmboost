<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Facades\App\Services\BasicService;

class PaymentPointWebhookController extends Controller
{
    /*
     * paymentpoint Gateway
     */

    public function walletipn()
    {
        // Step 1: Read the raw POST data from the request body
        $inputData = file_get_contents('php://input');
        
        Log::info('Paymentpoint webhook data:', ['response' => $inputData]);
    
        // Step 2: Get the signature from the headers (Paymentpoint's security header)
        $signatureHeader = $_SERVER['HTTP_PAYMENTPOINT_SIGNATURE'];
    
        // Step 3: Your secret key (replace with actual secret key from PaymentPoint)
        $secretKey = '82ea824e0f9c8192336bedcce23da44d978b6f3c614dcd0e44d7dc986678fdbe788bb0a633325590eeccea8f11dcd7be3a3459a501c7bf6bf41074bf';
    
        // Step 4: Calculate the expected signature using HMAC-SHA256
        $calculatedSignature = hash_hmac('sha256', $inputData, $secretKey);
    
        // Step 5: Verify if the calculated signature matches the signature from the header
        if (!hash_equals($calculatedSignature, $signatureHeader)) {
            // If signatures don't match, return an error response
            http_response_code(400);
            Log::info('Invalid signature.');
            exit;
        }
    
        // Step 6: Decode the JSON payload
        $webhookData = json_decode($inputData, true);
        
        Log::info('Paymentpoint webhook data:', ['response' => $webhookData]);

    
        // Step 7: Ensure the data was successfully decoded
        if ($webhookData === null) {
            // If the data couldn't be decoded, return an error response
            http_response_code(400);
            Log::info('Invalid JSON data received.');
            exit;
        }
    
        // Step 8: Extract relevant data from the decoded webhook
        $transactionId = $webhookData['transaction_id'] ?? null;
        $amountPaid = $webhookData['amount_paid'] ?? null;
        $settlementAmount = $webhookData['settlement_amount'] ?? null;
        $transactionStatus = $webhookData['transaction_status'] ?? null;
        $customerEmail = $webhookData['customer']['email'] ?? null;
        $description = $webhookData['description'] ?? null;
    
        // Check if required data is present
        if (!$transactionId || !$amountPaid || !$settlementAmount || !$transactionStatus || !$customerEmail) {
            http_response_code(400);
            Log::info('Missing required data.');
            exit;
        }
    
        // Step 9: Retrieve user info using customer email (assuming User model is available)
        $user = User::where('email', $customerEmail)->first();
        
        // Check if this transaction has already been processed
        $existingTransaction = Deposit::where('trx_id', $transactionId)->first();
        if ($existingTransaction) {
            http_response_code(200);
            Log::info("Transaction already processed: {$transactionId}");
            echo "Transaction already processed.";
            exit;
        }

        $deposit = Deposit::create([
            'user_id' => $user->id,
            'trx_id' => $transactionId,
            'payment_method_id' => "43",
            'payment_method_currency' => "NGN",
            'amount' => $settlementAmount,
            'percentage_charge' => 0,
            'fixed_charge' => 0,
            'payable_amount' => $settlementAmount,
            'base_currency_charge' => 0,
            'payable_amount_in_base_currency' => $settlementAmount,
            'status' => 0,
            'type' => 0,
        ]);
        
        BasicService::preparePaymentUpgradation($deposit);
        
        // Step 11: Return response
        http_response_code(200);
        echo "Webhook processed successfully.";
    }
}
