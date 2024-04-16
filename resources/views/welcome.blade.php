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

                    {{-- <a href="https://www.instagram.com/ctrljames/">
                        <div class="my-2 flex h-12 items-center justify-center rounded-full px-4 bg-green-400">
                            <div class="flex items-center">
                                <!--
                                <img alt="photo" class="w-12 rounded-full" src="https://icon-library.com/images/2018/2298785_oreos-oreo-cookie-adult-costume-hd-png-download.png" />
                                -->
                                <div class="ml-2 ">
                                    <div class="">Paypal</div>
                                    <!--
                                    <div class="flex text-xs font-light text-gray-600">yourpal.com
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path>
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path>
                                        </svg>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
