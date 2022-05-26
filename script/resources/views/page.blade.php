@extends('main.app')
@section('content')
    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-capitalize mb-5 text-lg">{{ $info->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($info->excerpt->value == "academy")
    @else
    <section class="section mb-10">
        <div class="container">

                {{ content($info->content->value ?? '') }}
        </div>
    </section>
    @endif
    @if($info->excerpt->value == "paket")
        <section class="section gray-bg" id="priceing">
            <div class="container">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="section-title text-center">
                                <h2>{{ __('Paket Membership') }}</h2>
                                <div class="divider mx-auto my-4"></div>
                                <p>{{ __('priceing_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END -->
                <div class="row text-center align-items-end plan_list">
                    <!-- Pricing Table-->
                    @foreach($plans as $row)
                        <div class="col-lg-4 mb-5 mb-lg-0  @if($row->featured == 0) priceing @endif">
                            <div class="bg-white p-5 rounded-lg  @if($row->featured == 1) shadow @endif ">
                                <h1 class="h6 text-uppercase font-weight-bold mb-4">{{ $row->name }}</h1>
                                <h2 class="h1 font-weight-bold">{{ amount_format($row->price) }}</h2>
                                <span class="font-weight-bold">@if($row->days == 365) Yearly @elseif($row->days == 30)
                                        Monthly @else {{ $row->days }}  Days @endif</span>
                                <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i> {{ __('Products Limit') }}
                                        <b>{{ $row->product_limit }}</b>
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i> {{ __('Storage Limit') }}
                                        <b>{{ number_format($row->storage) }}MB</b>
                                    </li>
                                    <li class="mb-3">
                                        @if($row->custom_domain == 1)
                                            <i class="fa fa-check mr-2 text-success"></i>
                                            {{ __('Use your custom domain') }}
                                        @else
                                            <i class="fa fa-times mr-2 text-danger"></i>
                                            <del>{{ __('Use your custom domain') }}</del>
                                        @endif
                                    </li>
                                    <li class="mb-3">
                                        @if($row->custom_domain == 1)
                                            <i class="fa fa-check mr-2 text-success"></i>
                                            {{ __('Use subdoamin or custom domain') }}
                                        @else
                                            <i class="fa fa-check mr-2 text-success"></i>
                                            {{ __('Use subdoamin only') }}
                                        @endif
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i> {{ __('Inventory Management') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i> {{ __('POS System') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i> {{ __('Customer Panel') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i>{{ __('Google Analytics') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i>{{ __('Google Tag Manager (GTM)') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i>{{ __('Facebook Pixel') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i>{{ __('Whatsapp Api') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i>{{ __('SEO Sitemap') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i>{{ __('Multi Language') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fa fa-check mr-2 text-success"></i>{{ __('Image Optimization') }}
                                    </li>
                                </ul>
                                <a href="{{ route('merchant.form',$row->id) }}"
                                   class="btn site_color text-white btn-block p-2 shadow rounded-pill">{{ __('Start With') }}
                                    (<b>{{ $row->name }}</b>)</a>
                            </div>
                        </div>
                @endforeach
                <!-- END -->
                </div>
            </div>
        </section>

    @endif
    @if($info->excerpt->value == "academy")
        <section class="section service gray-bg" id="service">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 text-center">
                        <div class="section-title">
                            <h2>{{ __('features_title') }}</h2>
                            <div class="divider mx-auto my-4"></div>
                            <p>{{ __('features_description') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($features as $row)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="service-item mb-4">
                                <div class="icon d-flex align-items-center">
                                    <img src="{{ asset($row->preview->content ?? '') }}" height="80">
                                    <h4 class="mt-3 mb-3">{{ $row->name }}</h4>
                                </div>
                                <div class="content">
                                    <p class="mb-4">{{ $row->excerpt->content ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
