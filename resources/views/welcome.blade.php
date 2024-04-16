<x-app-layout>
    @push('head')
        <script type="text/javascript"
            src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
            kr-public-key="{{ config('services.izi_pay.public_key') }}" kr-post-url-success="{{ route('success') }}" ;></script>

        <!-- 3 : theme néon should be loaded in the HEAD section   -->
        <link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon-reset.min.css">
        <script type="text/javascript" src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon.js"></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="m-5">
                    <div class="cursor-pointer " x-data="{ open: false }">
                        <div class="my-2 flex h-12 items-center justify-center rounded-full px-4 bg-red-400"
                            @click="open = !open">
                            <div class="flex items-center">
                                <div class="ml-2">
                                    <div class="">IZI PAY</div>
                                </div>
                            </div>
                        </div>
                        <div style="display: none" x-show="open" class="p-4 bg-gray-100 flex justify-center">
                            <div class="kr-embedded" kr-form-token="{{ $formToken }}">
                            </div>

                        </div>
                    </div>
                    <div class="cursor-pointer " x-data="{ open: false }">
                        <div class="my-2 flex h-12 items-center justify-center rounded-full px-4 bg-red-400"
                            @click="open = !open">
                            <div class="flex items-center">
                                <div class="ml-2">
                                    <div class="">PAY U</div>
                                </div>
                            </div>
                        </div>
                        <button style="display: none" x-show="open" class="p-4 bg-gray-100 flex justify-center rounded-lg shadow-sm">
                            <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">  <!-- Formulario de pago PayU -->

                                <input name="merchantId" type="hidden" value="{{config('services.pay_u.merchant_id')}}">    <!-- Número de cuenta -->

                                <input name="accountId" type="hidden" value="{{config('services.pay_u.account_id')}}">  <!-- Cuenta -->

                                <input name="description" type="hidden" value="Texto Prueba">   <!-- Descripción -->

                                <input name="referenceCode" type="hidden" value="{{$payU['referenceCode']}}">   <!-- Referencia -->

                                <input name="amount" type="hidden" value="10000">   <!-- Valor -->

                                <input name="tax" type="hidden" value="0">  <!-- Impuesto -->

                                <input name="taxReturnBase" type="hidden" value="0">    <!-- Valor base de devolución de impuesto -->

                                <input name="currency" type="hidden" value="PEN">   <!-- Moneda -->

                                <input name="signature" type="hidden" value="{{$payU['signature']}}"> <!-- Firma -->

                                <input name="test" type="hidden" value="1"> <!-- 1: pruebas; 0: producción -->

                                <input name="buyerEmail" type="hidden" value="{{auth()->user()->email}}">

                                <input name="responseUrl" type="hidden" value="{{route('gracias')}}">

                                <input name="confirmationUrl" type="hidden" value="http://www.test.com/confirmation">

                                <input name="Submit" type="submit" value="Enviar">

                            </form>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
