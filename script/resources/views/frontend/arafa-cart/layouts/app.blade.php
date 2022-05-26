<!DOCTYPE html>
<html lang="{{ App::getlocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{-- generate seo info --}}
        {!! SEO::generate() !!}
        {!! JsonLdMulti::generate() !!}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--=====================================
                    CSS LINK PART START
        =======================================-->
        <!-- FOR PAGE ICON -->
        <link rel="icon" href="{{ asset('uploads/'.domain_info('user_id').'/favicon.ico') }}">
        @php
        Helper::autoload_site_data();

        @endphp
        <style type="text/css">
           :root {
              --main-theme-color: {{ Cache::get(domain_info('user_id').'theme_color','#ff4500') }};
          }
        </style>
        <!--====== Google Font ======-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('frontend/arafa-cart/css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/arafa-cart/css/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/arafa-cart/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/arafa-cart/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/arafa-cart/css/owlcarousel.css') }}">
        <!--====== Utility-Spacing ======-->
        <link rel="stylesheet" href="{{ asset('frontend/arafa-cart/css/utility.css') }}">

        <!--====== App ======-->
        <link rel="stylesheet" href="{{ asset('frontend/arafa-cart/css/app.css') }}">
{{--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
{{--        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}
         @stack('css')
        <!-- FOR STYLE -->
        {{ load_header() }}

    </head>
<body class="config">
@include('sweetalert::alert')

    <!--====== Main App ======-->
<div id="app">




{{-- load partials views --}}
@include('frontend/arafa-cart/layouts/header')
@yield('content')
@include('frontend/arafa-cart/layouts/footer')

{{-- end load --}}

{{-- load whatsapp api --}}
{{ load_whatsapp() }}
{{-- end whatsapp api loading --}}
</div>
<!--====== End - Main App ======-->

@php
$currency_info=currency_info();
@endphp
<input type="hidden" id="currency_position" value="{{ $currency_info['currency_position'] }}">
<input type="hidden" id="currency_name" value="{{ $currency_info['currency_name'] }}">
<input type="hidden" id="currency_icon" value="{{ $currency_info['currency_icon'] }}">
<input type="hidden" id="preloader" value="{{ asset('uploads/preload.webp') }}">
<input type="hidden" id="base_url" value="{{ url('/') }}">
<input type="hidden" id="theme_color" value="{{ Cache::get(domain_info('user_id').'theme_color','#dc3545') }}">


<!--====== Vendor Js ======-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="{{ asset('frontend/arafa-cart/js/modernizr.js') }}"></script>
<script src="{{ asset('frontend/arafa-cart/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/arafa-cart/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/arafa-cart/js/owlcarousel.js') }}"></script>
<script src="{{ asset('frontend/arafa-cart/js/slick.js') }}"></script>

<!--====== jQuery Shopnav plugin ======-->
<script src="{{ asset('frontend/arafa-cart/js/jquery.shopnav.js') }}"></script>
<script src="{{ asset('assets/js/jquery.unveil.js') }}"></script>
<!--====== App ======-->

<script src="{{ asset('frontend/arafa-cart/js/helper.js?v=1.0') }}"></script>
@stack('js')
<script src="{{ asset('frontend/arafa-cart/js/app.js') }}"></script>
{{ load_footer() }}
 <!-- FOR INTERACTION -->
<!--=====================================
    JS LINK PART END
=======================================-->

<!--====== Noscript ======-->
    <noscript>
        <div class="app-setting">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="app-setting__wrap">
                            <h1 class="app-setting__h1">JavaScript is disabled in your browser.</h1>

                            <span class="app-setting__text">Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </noscript>
</body>
</html>
