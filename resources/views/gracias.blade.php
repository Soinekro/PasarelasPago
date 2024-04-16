<x-app-layout>
    <div class="w-full flex justify-center">
        <div class="">
            <p class="my-2 text-gray-800">
                @php
                    $ApiKey = '4Vj8eK4rloUd272L48hsrarnUA';

                    $merchant_id = $_REQUEST['merchantId'];

                    $referenceCode = $_REQUEST['referenceCode'];

                    $TX_VALUE = $_REQUEST['TX_VALUE'];

                    $New_value = number_format($TX_VALUE, 1, '.', '');

                    $currency = $_REQUEST['currency'];

                    $transactionState = $_REQUEST['transactionState'];

                    $firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";

                    $firmacreada = md5($firma_cadena);

                    $firma = $_REQUEST['signature'];

                    $reference_pol = $_REQUEST['reference_pol'];

                    $cus = $_REQUEST['cus'];

                    $extra1 = $_REQUEST['description'];

                    $pseBank = $_REQUEST['pseBank'];

                    $lapPaymentMethod = $_REQUEST['lapPaymentMethod'];

                    $transactionId = $_REQUEST['transactionId'];
                @endphp
                @switch(request()->get('transactionState'))
                    @case(4)
                    <h1 class="my-2 text-gray-800 font-bold text-2xl">
                        Gracias por tu compra
                    </h1>
                    
                @break

                @case(6)
                    <h1 class="my-2 text-gray-800 font-bold text-2xl">
                        Su transacción ha sido rechazada
                    </h1>
                @break

                @case(104)
                   <h1 class="my-2 text-gray-800 font-bold text-2xl">
                        Su transacción tiene un error
                    </h1>
                @break

                @case(7)
                    <h1 class="my-2 text-gray-800 font-bold text-2xl">
                        Su transacción esta pendiente
                    </h1>
                @break

                @default
                    <p class="my-2 text-gray-800">
                        {{ request()->get('mensaje') }}
                    </p>
            @endswitch

            @if (strtoupper($firma) == strtoupper($firmacreada))
                <h2>Resumen de la transacción</h2>

                <table>

                    <tr>

                        <td>Estado de la transacción</td>

                        <td> {{  request()->get('estadoTx') }}</td>

                    </tr>

                    <tr>

                    <tr>

                        <td>ID de la transacción</td>

                        <td> {{  request()->get('transactionId') }}</td>

                    </tr>

                    <tr>

                        <td>Referencia de venta</td>

                        <td> {{  request()->get('reference_pol') }}</td>

                    </tr>

                    <tr>

                        <td>Referencia de la transacción</td>

                        <td> {{  request()->get('referenceCode') }}</td>

                    </tr>

                    <tr>
                        @if (request()->get('pseBank') != null)
                    <tr>

                        <td>cus </td>

                        <td>{{ request()->get('cus') }}</td>

                    </tr>

                    <tr>

                        <td>Banco </td>

                        <td>{{ request()->get('pseBank') }} </td>

                    </tr>
            @endif

            <tr>

                <td>Valor total</td>

                <td>$ {{ request()->get('TX_VALUE') }}</td>

            </tr>

            <tr>

                <td>Moneda</td>

                <td>{{  request()->get('currency') }}</td>

            </tr>

            <tr>

                <td>Descripción</td>

                <td>{{  request()->get('description') }}</td>

            </tr>

            <tr>

                <td>Entidad:</td>

                <td>{{  request()->get('lapPaymentMethod') }}</td>

            </tr>

            </table>
        @else
            <h1>Error validando la firma digital.</h1>
            </p>
            <button
                class="sm:w-full lg:w-auto my-2 border rounded md py-4 px-8 text-center
                    bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2
                    focus:ring-indigo-700 focus:ring-opacity-50">
                Regresar al Panel
            </button>
            @endif
        </div>
    </div>
</x-app-layout>
