<?php

namespace App\Http\Controllers\IziPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PayController extends Controller
{
    public function index()
    {
        $formToken = $this->getFormToken();
        $payU = $this->generateFirma();

        return view('welcome', compact('formToken', 'payU'));
    }

    private function getFormToken()
    {
        $url = config('services.izi_pay.url');
        $client_id = config('services.izi_pay.client_id');
        $client_secret = config('services.izi_pay.client_secret');

        $code = base64_encode($client_id . ':' . $client_secret);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $code,
        ])->post($url, [
            'amount' => 10000,
            'currency' => 'USD',
            'orderId' => Str::random(20),
            'customer' => [
                'email' => auth()->user()->email,
            ],
        ])->json();

        return $response['answer']['formToken'];
    }

    public function success(Request $request)
    {
        // return $request->all();
        if ($request->get('kr-hash-algorithm') !== 'sha256_hmac') {
            throw new \Exception('Invalid hash algorithm');
        }

        $krAnswer = str_replace('\/', '/', request()->get('kr-answer'));

        $calculate_hasg = hash_hmac('sha256', $krAnswer, config('services.izi_pay.hash_key'));

        if ($calculate_hasg !== request()->get('kr-hash')) {
            throw new \Exception('Invalid hash');
        }
        return $krAnswer;
    }

    public function generateFirma(/* Request $request */)
    {
        $apiKey = config('services.pay_u.api_key');
        $merchantId = config('services.pay_u.merchant_id');
        $referenceCode = Str::random(10);
        $txValue = '10000';
        $currency = 'PEN';
        $signature = md5("$apiKey~$merchantId~$referenceCode~$txValue~$currency");
        return [
            'referenceCode' => $referenceCode,
            'signature' => $signature,
        ];
    }

    public function gracias()
    {
        return view('gracias');
    }
}
