@extends('frontend.arafa-cart.layouts.app')
@section('content')
    <!--====== App Content ======-->
    <div class="app-content">
        <!--====== Section 1 ======-->
        <div class="u-s-p-y-60">
            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="breadcrumb">
                        <div class="breadcrumb__wrap">
                            <ul class="breadcrumb__list">
                                <li class="has-separator">
                                    <a href="{{ url('/') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="is-marked">
                                    <a>{{ __('Checkout') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="u-s-p-b-60">
            <form action="{{ url('/make_order') }}" class="checkout_form" method="POST">
                @csrf
                <div class="section__content">
                    <div class="container">
                        <div class="checkout-f">
                            <h1 class="checkout-f__h1">{{ __('Order Summary') }}</h1>
                            <div class="row">
                                <table style="color: black;" class="table-p">
                                    <thead>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th style="height: 40px; width: 40%">Address</th>
                                        @foreach($get_order as $row)
                                            <td align="justify">
                                                {{ $row->detail }}
                                            </td>
                                            @php break; @endphp
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th style="height: 40px;">Customer</th>
                                        <td>
                                            {{ Auth::guard('customer')->user()->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="height: 40px;">Np. Hp</th>
                                        @foreach($get_order as $row)
                                            <td>
                                                0{{ $row->phonenumber }}
                                            </td>
                                            @php break; @endphp
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="row">
                                <table style="color: black;" class="table-p">
                                    <thead>
                                    </thead>
                                    <tbody>
                                    <tr style="height: 100px;">
                                        <th>#</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Weight</th>
                                        <th>Price</th>
                                        <th>Sub Total</th>
                                    </tr>
                                    @php $no =1 ; $total =0;   $shiping=0;@endphp
                                    @foreach($get_order as $row)
                                        <tr style="height: 120px;" align="center">
                                            <td>{{ $no ++ }}</td>
                                            <td>
                                                <div class="o-card__img-wrap">
                                                    <img class="u-img-fluid"
                                                         src="{{ $row->url }}" alt="">
                                                </div>
                                            </td>
                                            <td>{{ $row->title }} </td>
                                            <td>{{ $row->qty }} pcs</td>
                                            <td>{{ $row->weight }} kg</td>
                                            <td>{{ amount_format($row->price) }}</td>
                                            <td>{{ amount_format($row->subtotal) }}</td>
                                        </tr>
                                        @php  $total += $row->subtotal @endphp
                                    @endforeach
                                    @foreach($get_order as $row)
                                        <tr align="center">
                                            <td colspan="6">Shipping Fee</td>
                                            <td>{{ amount_format($row->primary_shipping_mode) }}</td>
                                        </tr>
                                        @php
                                            $shiping = $row->primary_shipping_mode;
                                            break;
                                        @endphp
                                    @endforeach
                                    <tr align="center">
                                        <td colspan="6">Coupon</td>
                                        <td><b>{{ amount_format(0) }}</b></td>
                                    </tr>
                                    <tr align="center">
                                        <td colspan="6">Grand Total</td>
                                        <td><b>{{ amount_format($total + $shiping) }}</b></td>
                                    </tr>
                                    <tr align="center">
                                        <td colspan="6">Payment Method</td>
                                        <td><b><i>Ratapay</i></b></td>
                                    </tr>
                                    <tr align="center">
                                        <td colspan="6"></td>
                                        <td>
                                            @if(Cart::count() > 0)
                                                <div >
                                                    <button class="btn btn--e-brand-b-2 checkout_submit_btn"
                                                            type="submit">{{ __('Pay Now') }}</button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <input type="hidden" value="{{ str_replace(',','',number_format(Cart::total(),2)) }}" id="total_amount"/>
@endsection
@push('js')
    <script src="{{ asset('frontend/arafa-cart/js/checkout.js') }}"></script>
@endpush
