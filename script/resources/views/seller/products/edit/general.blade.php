@extends('layouts.app')
@push('style')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>
@endpush
@section('head')
    @include('layouts.partials.headersection',['title'=>'Product Item'])
@endsection
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="{{ route('seller.product.store') }}" id="product_create">
                @csrf
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-3">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item ">
                                        <a class="nav-link active"
                                           href="{{ url('seller/product/'.$info->id.'/general') }}"><i
                                                class="fas fa-globe"></i> {{ __('General') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link "
                                           href="{{ route('seller.product.edit',$info->id) }}"><i
                                                class="fas fa-cogs"></i> {{ __('Item') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/price') }}"><i
                                                class="fas fa-money-bill-alt"></i> {{ __('Price') }}</a>
                                    </li>

                                    {{--								<li class="nav-item">--}}
                                    {{--									<a class="nav-link " href="{{ url('seller/product/'.$info->id.'/option') }}"><i class="fas fa-tags"></i> {{ __('Options') }}</a>--}}
                                    {{--								</li>--}}
                                    {{--								<li class="nav-item">--}}
                                    {{--									<a class="nav-link" href="{{ url('seller/product/'.$info->id.'/varient') }}"><i class="fas fa-expand-arrows-alt"></i> {{ __('Variants') }}</a>--}}
                                    {{--								</li>--}}

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('seller/product/'.$info->id.'/image') }}"><i
                                                class="far fa-images"></i> {{ __('Images') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{ url('seller/product/'.$info->id.'/inventory') }}"><i
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
                                    {{--                                    <li class="nav-item">--}}
                                    {{--                                        <a class="nav-link"--}}
                                    {{--                                           href="{{ url('seller/product/'.$info->id.'/express-checkout') }}"><i--}}
                                    {{--                                                class="fas fa-cart-arrow-down"></i> {{ __('Express checkout') }}</a>--}}
                                    {{--                                    </li>--}}
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="{{ url('seller/product/'.$info->id.'/affiliate') }}"><i
                                                class="fab fa-affiliatetheme"></i> {{ __('Affiliate') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label>{{ __('Product Name') }}</label>
                                    <input readonly type="text" class="form-control" name="title"
                                           value="{{ $info->title }}">
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Slug') }}</label>
                                    <input readonly type="text" step="any" class="form-control"
                                           value="{{ $info->slug }}">
                                </div>
                                <div class="form-group">
                                    <div style="float: right;">
                                        <a class="btn btn-primary basicbtn"
                                           href="{{ url('seller/product/'.$info->id.'/edit') }}">{{ __('Next Step') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </div>

    </div>
    </form>

@endsection
@push('js')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/form.js?v=1.0') }}"></script>
@endpush
