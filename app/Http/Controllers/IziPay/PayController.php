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

        return view('welcome', compact('formToken'));
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
        return $krAnswer;
    }
}
