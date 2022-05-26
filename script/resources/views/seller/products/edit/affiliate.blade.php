@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>'Affiliate Commission'])
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-3">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item ">
                                    <a class="nav-link "
                                       href="{{ url('seller/product/'.$info->id.'/general') }}"><i
                                            class="fas fa-globe"></i> {{ __('General') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('seller.product.edit',$info->id) }}"><i
                                            class="fas fa-cogs"></i> {{ __('Item') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/price') }}"><i
                                            class="fas fa-money-bill-alt"></i> {{ __('Price') }}</a>
                                </li>
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link " href="{{ url('seller/product/'.$info->id.'/option') }}"><i--}}
                                {{--                                            class="fas fa-tags"></i> {{ __('Options') }}</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/varient') }}"><i--}}
                                {{--                                            class="fas fa-expand-arrows-alt"></i> {{ __('Variants') }}</a>--}}
                                {{--                                </li>--}}


                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/image') }}"><i
                                            class="far fa-images"></i> {{ __('Images') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/inventory') }}"><i
                                            class="fa fa-cubes"></i> {{ __('Inventory') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/files') }}"><i
                                            class="fas fa-file"></i> {{ __('Files') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/seo') }}"><i
                                            class="fas fa-chart-line"></i> {{ __('SEO') }}</a>
                                </li>
                                {{--                                <li class="nav-item">--}}
                                {{--                                    <a class="nav-link "--}}
                                {{--                                       href="{{ url('seller/product/'.$info->id.'/express-checkout') }}"><i--}}
                                {{--                                            class="fas fa-cart-arrow-down"></i> {{ __('Express checkout') }}</a>--}}
                                {{--                                </li>--}}

                                <li class="nav-item">
                                    <a class="nav-link active"
                                       href="{{ url('seller/product/'.$info->id.'/affiliate') }}"><i
                                            class="fab fa-affiliatetheme"></i> {{ __('Affiliate') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-9">
                            <div class="card-body">
                                <form method="post" action="{{ route('seller.product.affiliate',$info->id) }}"
                                      class="affiliate_form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12">
                                            <h6>{{ __('Create Affiliate Commission For This Product') }}</h6>
                                            <hr>
                                        </div>
                                        <div class="col-12 col-md-8 col-lg-8">

                                            <div class="form-group">
                                                <label for="stock_qty">{{ __('Affiliate Percent') }}</label>
                                                <input placeholder="%" id="hm" type="tel" size="4" maxlength="2"
                                                       name="affiliate"
                                                       onchange="changeHandler(this)"
                                                       value="{{ $info->price->affiliate ?? '' }}" class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div style="float: right;">
                                        <button type="submit" class="btn btn-primary">{{ __('Save All Changes') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <input type="hidden" id="base_url" value="{{ url('/') }}">
@endsection
@push('js')
    <script>
        function changeHandler(val) {
            if (Number(val.value) > 100) {
                val.value = 100
            }
        }
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
    <script src="{{ asset('assets/seller/product/index.js') }}"></script>
@endpush
