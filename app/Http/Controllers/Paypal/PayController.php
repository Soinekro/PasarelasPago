<?php

namespace App\Http\Controllers\Paypal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PayController extends Controller
{
    public function index()
    {
        $url = config('services.paypal.url');
        $client_id = config('services.paypal.client_id');
        $client_secret = config('services.paypal.client_secret');
        $public_key = config('services.paypal.public_key');
        $hash_key = config('services.paypal.hash_key');
        
        $code = base64_encode($client_id . ':' . $client_secret);
        return $code;
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $code,
        ])->post($url, [
            'amount' => 10000,
            'currency' => 'USD',
            'orderId' => Str::random(20),
            'customer' => [
                'email' => auth()->user()->email,
            ],
        ])->json();

    return $response;
        return view('paypal.index');
    }
}
