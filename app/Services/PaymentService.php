<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class PaymentService
{
    public function createPayment($request){
        $service = $request->input('service');
        $product = Product::where('id', $service)->first();
        if (!$product) {
            $response = [
                'error' => "nie ma takiego produktu"
            ]; 
            return response($response, 404);
        }

        $months = $request->input('months');
        $urlSuccess = env('URL_SUCCESS_DPAY');
        $urlFail = env('URL_FAIL_DPAY');
        $urlIpn = env('URL_IPN_DPAY');
        $secretHash = env('SECRET_HASH_DPAY');
        $value = number_format($product->price * $months, 2, '.', '');

        $checksum = Hash::make("{$product->name}|{$secretHash}|{$value}|{$urlSuccess}|{$urlFail}|{$urlIpn}");
        $paymentUuid = self::generateUniqueUuid();

        $data = [
            "service" => $product->name,
            "value" => $value,
            "url_success" => $urlSuccess,
            "url_fail" => $urlFail,
            "url_ipn" => $urlIpn,
            "checksum" => $checksum,
            "creditcard" => true,
            "paysafecard" => true,
            "paypal" => true,
            "nobanks" => false,
            "email" => "",
            "client_name" => "",
            "client_surname" => "",
            "custom" => $paymentUuid
        ];
    
        $url = 'https://secure.dpay.pl/register';
        $response = Http::post($url, $data);
    
        if ($response->successful()) {
            $responseData = $response->json();

            Payment::create([
                'payment' => $paymentUuid,
                'transaction' => $responseData['transactionId'],
                'price' => $value,
                'product' => $product->id,
                'months' => $months,
            ]);

            $response = [
                'url' => $responseData['msg']
            ]; 
            return response($response, 200);
        } else {
            return response($response->body(), $response->status());
        }
    }

    private function generateUniqueUuid(){
        do {
            $uuid = Uuid::uuid4();
            $uuidString = $uuid->toString();
            $exists = Payment::where('payment', $uuidString)->exists();
        } while ($exists);

        return $uuidString;
    }
}