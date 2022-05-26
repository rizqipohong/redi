@extends('frontend.bigbag.layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/bigbag/css/checkout.css') }}">
@endpush
@section('content')
    <section class="single-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h2>{{ __('Checkout') }}</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Checkout') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form action="{{ url('/make_order') }}" class="checkout_form" method="post">
        @csrf
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('user_limit'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ Session::get('user_limit') }}</li>
                                </ul>
                                <a style="float: right;" href="{{ url('/user/login') }}">
                                    <button class="btn btn-primary">Login First</button>
                                </a>
                            </div>
                        @endif
                        @if(Session::has('payment_fail'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('payment_fail') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    @endif
                    <!-- Buyer Info Start -->
                        <h4>{{ __('Billing Details') }}</h4>
                        <div class="row">
                            <div class="form-group col-xl-12">
                                <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                <input type="text" placeholder="{{ __('Name') }}" name="name" class="form-control"
                                       required=""
                                       value="{{ Auth::guard('customer')->user()->name  ?? '' }}">
                            </div>
                            <div class="form-group col-xl-6">
                                <label>{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                <input type="email" placeholder="{{ __('Email Address') }}" name="email"
                                       class="form-control"
                                       required="" value="{{ Auth::guard('customer')->user()->email ?? '' }}">
                            </div>
                            <div class="form-group col-xl-6">
                                <label>{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                <input type="text" placeholder="{{ __('Phone Number') }}" name="phone"
                                       class="form-control" value=""
                                       required="">
                            </div>
                            @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)
                                @if(!Auth::guard('customer')->check())
                                    <div class="form-group col-xl-12">
                                        <label><input type="checkbox" name="create_account" value="1"
                                                      class="create_account"> {{ __('With Create Account') }}</label>
                                    </div>
                                    <div class="form-group col-xl-12 password_area none">

                                        <label>{{ __('Password') }} <span class="text-danger">*</span></label>
                                        <input type="password" placeholder="Enter Password" name="password"
                                               class="form-control" value="" minlength="8">
                                    </div>
                                @endif
                            @endif

                            <div class="form-group col-xl-12">
                                <label><input type="checkbox" name="create_dropship" value="1"
                                              class="create_dropship"> {{ __('Send as Dropshipper') }}</label>
                            </div>
                            <div class="form-group col-xl-6 dropship none">
                                <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter Name" name="name_dropship"
                                       class="form-control">
                            </div>
                            <div class="form-group col-xl-6 dropship none">
                                <label>{{ __('Handphone') }} <span class="text-danger">*</span></label>
                                <input type="number" placeholder="Enter Your Number" name="number_hp"
                                       class="form-control">
                            </div>

                            @if(domain_info('shop_type') == 1)
                                {{--                                @if(count($locations) > 0)--}}
                                <div class="not_dropship form-group col-xl-12">
                                    <label>{{ __('Province') }} <span class="text-danger">*</span></label>
                                    <select name="province" class="form-control select2" id="province">
                                        <option selected disabled value="">{{ __('Select Province') }}</option>
                                        @foreach($destination as $province)
                                            <option
                                                value="{{ $province->province }}">{{ $province->province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="not_dropship form-group col-xl-12">
                                    <label>{{ __('City') }} <span class="text-danger">*</span></label>
                                    <select name="city" id="city" class="form-control select2">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="not_dropship form-group col-xl-12">
                                    <label>{{ __('District') }} <span class="text-danger">*</span></label>
                                    <select name="district" id="district" class="form-control select2">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="not_dropship form-group col-xl-12">
                                    <label>{{ __('Sub District') }} <span class="text-danger">*</span></label>
                                    <select name="location" id="subdistrict" class="form-control select2">
                                        <option value=""></option>
                                    </select>
                                </div>
                                {{--                                @endif--}}

                                <div class="not_dropship form-group col-xl-6">
                                    <label>{{ __('Delivery Address') }} <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="{{ __('Delivery Address') }}"
                                           name="delivery_address"
                                           class="form-control" value="" >
                                </div>

                                <div class="not_dropship form-group col-xl-6">
                                    <label>{{ __('Zip Code') }}<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="{{ __('Zip Code') }}" name="zip_code"
                                           class="form-control"
                                           value="" >
                                </div>

                            @endif
                            <div class="not_dropship form-group col-xl-12 mb-0">
                                <label>{{ __('Order Notes') }}</label>
                                <textarea name="comment" rows="5" class="form-control"
                                          placeholder="{{ __('Order Notes') }}"></textarea>
                            </div>
                        </div>
                        <!-- Buyer Info End -->

                    </div>

                    <div class="col-xl-5 checkout-billing ">
                        @if(env('MULTILEVEL_CUSTOMER_REGISTER') == true)
                            @if(!Auth::guard('customer')->check())
                                <div class="bigbag_notice">
                                    <p>{{ __('Are you a returning customer?') }} <a
                                            href="{{ url('/user/login') }}">{{ __('Click here to login') }}</a></p>
                                </div>
                            @endif
                        @endif

                        <div class="bigbag_notice">
                            <p>{{ __('Do you have a coupon code?') }} <a
                                    href="{{ url('/cart') }}">{{ __('Click here to apply') }}</a></p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('user_limit'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ Session::get('user_limit') }}</li>
                                </ul>
                                <a style="float: right;" href="{{ url('/user/login') }}">
                                    <button class="btn btn-primary">Login First</button>
                                </a>
                            </div>
                        @endif
                        @if(Session::has('payment_fail'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('payment_fail') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="not_dropship">
                            <h6>{{ __('Shipping From') }}:
                                @php $city_code_data = json_decode($city_code->value)->city @endphp
                                {{$city->origin_name ?? ''}} </h6>
                            <hr>
                            <h6>{{ __('Courier') }}</h6>
                            <span id="tampil_ongkir"></span>
                            <hr>
                            <table class="bigbag_responsive-table">
                                <thead>
                                <tr>
                                    <th>{{ __('Product') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Total') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::content() as $row)
                                    <tr>
                                        <td data-title="Product">
                                            <div class="bigbag_cart-product-wrapper">
                                                <div class="bigbag_cart-product-body">
                                                    <h6>
                                                        <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ $row->name }}</a>
                                                    </h6>
                                                    @foreach ($row->options->attribute as $attribute)
                                                        <p><b>{{ $attribute->attribute->name }}</b>
                                                            : {{ $attribute->variation->name }}</p>
                                                    @endforeach
                                                    @foreach ($row->options->options as $op)
                                                        <p>{{ $op->name }}</p>
                                                    @endforeach
                                                    <p>{{ $row->qty }} {{ __('Piece') }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-title="Quantity">x{{ $row->qty }}</td>
                                        <td data-title="Total"><strong>{{ amount_format($row->price) }}</strong></td>
                                    </tr>
                                @endforeach
                                <tr class="total none shipping_charge">
                                    <td>
                                        <h6 class="mb-0">{{ __('Shipping Charge') }}</h6>
                                    </td>
                                    <td></td>
                                    <td><strong id="shipping_charge"></strong></td>
                                </tr>
                                <tr class="total">
                                    <td>
                                        <h6 class="mb-0">{{ __('Weight') }}</h6>
                                    </td>

                                    <?php $berat = 0; $total_weight = 0;?>
                                    @foreach(Cart::content() as $row)
                                        @foreach($weight as $key)
                                            @if($row->id == $key->term_id)
                                                <?php $total_weight += $key->weight * $row->qty;?>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td>{{ $total_weight }} kg</td>
                                    <td></td>
                                </tr>
                                <tr class="total">
                                    <td>
                                        <h6 class="mb-0">{{ __('Tax') }}</h6>
                                    </td>
                                    <td></td>
                                    <td><strong>{{ amount_format(Cart::tax()) }}</strong></td>
                                </tr>
                                <tr id="shipping_fee" class="total"></tr>
                                <tr class="total">
                                    <td>
                                        <h6 class="mb-0">{{ __('Grand Total') }}</h6>
                                    </td>
                                    <td></td>
                                    <td><strong id="ongkir"
                                                class="total_cost_amount">{{ amount_format(Cart::total()) }}</strong>
                                    </td>
                                    <?php $grand_total = Cart::total()?>
                                </tr>
                                </tbody>
                            </table>
                            <div class="bigbag-checkout-payment none">
                                <h6>{{ __('Select Shipping Mode') }}</h6>
                                <hr>

                                <ul class="wc_payment_methods payment_methods shipping_methods">

                                </ul>
                            </div>
                            <div id="payment" class="bigbag-checkout-payment mt-3">

                                <h6>{{ __('Select Payment Mode') }}</h6>
                                <hr>


                                <ul class="wc_payment_methods payment_methods">
                                    @foreach($getways as $key => $row)
                                        @php
                                            $data=json_decode($row->content);
                                        @endphp
                                        <li class="wc_payment_method payment_method_bacs">
                                            <input id="payment_method_{{ $key }}" type="radio" class="input-radio"
                                                   name="payment_method" value="{{ $row->category_id  }}"
                                                   @if($key==0) checked="checked" @endif>
                                            <label for="payment_method_{{ $key }}">
                                                {{ $data->title }} </label>
                                            @if(isset($data->additional_details))
                                                <div class="payment_box payment_method_{{ $key }}">
                                                    <p>{{ $data->additional_details }}</p>
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            @if(Cart::count() > 0)
                                <button type="submit"
                                        class="bigbag_btn-custom primary btn-block mt-2 checkout_submit_btn">{{ __('Place Order') }}</button>
                        @endif
                        <!-- Order Details End -->
                        </div>
                    </div>
                        <div class="col-xl-12 dropship none">
                            <div class=" checkout-billing">
                                <!-- Order Details Start -->
                                <h6>{{ __('Shipping From') }}:
                                    @php $city_code_data = json_decode($city_code->value)->city @endphp
                                    {{$city->origin_name ?? ''}} </h6>
                                <hr>
                                <h6>{{ __('Courier') }}</h6>
                                <hr>
                                <table class="bigbag_responsive-table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Product') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Total') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::content() as $row)
                                        <tr>
                                            <td data-title="Product">
                                                <div class="bigbag_cart-product-wrapper">
                                                    <div class="bigbag_cart-product-body">
                                                        <h6>
                                                            <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ $row->name }}</a>
                                                        </h6>
                                                        @foreach ($row->options->attribute as $attribute)
                                                            <p><b>{{ $attribute->attribute->name }}</b>
                                                                : {{ $attribute->variation->name }}</p>
                                                        @endforeach
                                                        @foreach ($row->options->options as $op)
                                                            <p>{{ $op->name }}</p>
                                                        @endforeach
                                                        <p>{{ $row->qty }} {{ __('Piece') }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-title="Quantity">x{{ $row->qty }}</td>
                                            <td data-title="Total"><strong>{{ amount_format($row->price) }}</strong>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td data-title="Address">
                                                <div class="form-group col-xl-6">
                                                    <label>{{ __('Province') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select name="province" class="form-control province2" id="province2">
                                                        <option selected disabled
                                                                value="">{{ __('Select Province') }}</option>
                                                        @foreach($destination as $province)
                                                            <option
                                                                value="{{ $province->province }}">{{ $province->province }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-xl-6">
                                                    <label>{{ __('City') }} <span class="text-danger">*</span></label>
                                                    <select name="city" id="city2" class="form-control city2">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-xl-6">
                                                    <label>{{ __('District') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select name="district" id="district2" class="form-control district2">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-xl-6">
                                                    <label>{{ __('Sub District') }} <span
                                                            class="text-danger">*</span></label>
                                                    <select name="location2" id="subdistrict2" class="form-control subdistrict2">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td colspan="2"><span class="tampil_ongkir2"></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class=" form-group col-xl-12">
                                                    <label>{{ __('Delivery Address') }} <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="{{ __('Delivery Address') }}"
                                                           name="delivery_address"
                                                           class="form-control" value="" >
                                                </div>

                                            </td>
                                            <td>
                                                <div class=" form-group col-xl-10">
                                                    <label>{{ __('Zip Code') }}<span class="text-danger">*</span></label>
                                                    <input type="number" placeholder="{{ __('Zip Code') }}" name="zip_code"
                                                           class="form-control"
                                                           value="" >
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="total none shipping_charge">
                                        <td>
                                            <h6 class="mb-0">{{ __('Shipping Charge') }}</h6>
                                        </td>
                                        <td></td>
                                        <td><strong id="shipping_charge"></strong></td>
                                    </tr>
                                    <tr class="total">
                                        <td>
                                            <h6 class="mb-0">{{ __('Total Weight') }}</h6>
                                        </td>

                                        <?php $berat = 0; $total_weight = 0;?>
                                        @foreach(Cart::content() as $row)
                                            @foreach($weight as $key)
                                                @if($row->id == $key->term_id)
                                                    <?php $berat = $key->weight *= $row->qty;?>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        <?php $total_weight += $berat;?>
                                        <td>{{ $total_weight }} kg</td>
                                        <td></td>
                                    </tr>
                                    <tr class="total">
                                        <td>
                                            <h6 class="mb-0">{{ __('Tax') }}</h6>
                                        </td>
                                        <td></td>
                                        <td><strong>{{ amount_format(Cart::tax()) }}</strong></td>
                                    </tr>
                                    <tr id="shipping_fee" class="total"></tr>
                                    <tr class="total">
                                        <td>
                                            <h6 class="mb-0">{{ __('Grand Total') }}</h6>
                                        </td>
                                        <td></td>
                                        <td><strong
                                                    class="total_cost_amount ongkir">{{ amount_format(Cart::total()) }}</strong>
                                        </td>
                                        <?php $grand_total = Cart::total()?>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="bigbag-checkout-payment none">
                                    <h6>{{ __('Select Shipping Mode') }}</h6>
                                    <hr>

                                    <ul class="wc_payment_methods payment_methods shipping_methods">

                                    </ul>
                                </div>
                                <div id="payment" class="bigbag-checkout-payment mt-3">

                                    <h6>{{ __('Select Payment Mode') }}</h6>
                                    <hr>
                                    <ul class="wc_payment_methods payment_methods">
                                        @foreach($getways as $key => $row)
                                            @php
                                                $data=json_decode($row->content);
                                            @endphp
                                            <li class="wc_payment_method payment_method_bacs">
                                                <input id="payment_method_{{ $key }}" type="radio" class="input-radio"
                                                       name="payment_method" value="{{ $row->category_id  }}"
                                                       @if($key==0) checked="checked" @endif>
                                                <label for="payment_method_{{ $key }}">
                                                    {{ $data->title }} </label>
                                                @if(isset($data->additional_details))
                                                    <div class="payment_box payment_method_{{ $key }}">
                                                        <p>{{ $data->additional_details }}</p>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                @if(Cart::count() > 0)
                                    <button type="submit"
                                            class="bigbag_btn-custom primary btn-block mt-2 checkout_submit_btn">{{ __('Place Order') }}</button>
                            @endif
                            <!-- Order Details End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="refund_threshold" id="refund_threshold">
            <input type="hidden" name="shipment" id="fee_ship">
            <input type="hidden" name="service" id="service">
            <input type="hidden" name="estimation" id="estimation">
            @if(request()->cookie('affiliate') && request()->cookie('product_aff'))
                <input type="hidden" name="affiliate" value="{{request()->cookie('affiliate')}}">
                <input type="hidden" name="product_aff" value="{{request()->cookie('product_aff')}}">
                <input type="hidden" name="seller_id" value="{{request()->cookie('seller_id')}}">
        @endif
    </form>
    <input type="hidden" value="{{ str_replace(',','',number_format(Cart::total(),2)) }}" id="total_amount"/>


@endsection
@push('js')
    <script src="{{ asset('frontend/bigbag/js/checkout.js') }}"></script>
    <script src="{{ asset('frontend/bigbag/js/get_dest.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script >
        //dropship mode

        $(function () {
            $('.province2').on('change', function () {
                axios.post('{{ url('/get_city/') }}', {id: $(this).val()})
                    .then(function (response) {
                        $('.city2').empty();
                        $('.city2').append(new Option("{{ __('Select City') }}", "value"));
                        $.each(response.data, function (id, city) {
                            $('.city2').append(new Option(city))

                        })
                    });
            });
        });
        $(function () {
            $('.city2').on('change', function () {
                axios.post('{{ url('/get_district/') }}', {id: $(this).val()})
                    .then(function (response) {
                        $('.district2').empty();
                        $('.district2').append(new Option("{{ __('Select District') }}", "value"));
                        $.each(response.data, function (id, subdistrict) {
                            $('.district2').append(new Option(subdistrict))
                        })
                    });
            });
        });
        $(function () {
            $('.district2').on('change', function () {
                axios.post('{{ url('/get_subdistrict/') }}', {id: $(this).val()})
                    .then(function (response) {
                        $('.subdistrict2').empty();
                        $('.subdistrict2').append(new Option("{{ __('Select Subdistrict') }}", "value"));
                        $.each(response.data, function (id, subdistrict) {
                            $('.subdistrict2').append(new Option(subdistrict))
                        })
                    });
            });
        });
        $(function () {
            $('.subdistrict2').on('change', function () {
                axios.post('{{ url('/get_cost/') }}', {
                    id: $(this).val(),
                    code: jsvar
                })
                    .then(response => console.log(this.price = response.data.price))
                    .catch(error => console.log(error));
            });
        });
        $('.subdistrict2').change(function () {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('/get_cost2/') }}",
                data: {'id': id, 'code': jsvar, 'weight': berat, 'total': grand_total},
                success: function (data) {
                    $(".tampil_ongkir2").html(data);
                }
            });
        });

    </script>

    <script>
        $('.create_dropship').on('click', function (e) {
            if ($('.create_dropship').is(":checked")) {
                $('.dropship').show();
                $('.not_dropship').hide();
            } else {
                $('.not_dropship').show();
                $('.dropship').hide();
            }
        });
        $(document).ready(function () {
            $('.select2').select2();
        });
        <?php echo "var jsvar ='$city_code_data';"; ?>
        <?php echo "var berat ='$total_weight';"; ?>
        <?php echo "var grand_total ='$grand_total';"; ?>
        $(function () {
            $('#province').on('change', function () {
                axios.post('{{ url('/get_city/') }}', {id: $(this).val()})
                    .then(function (response) {
                        $('#city').empty();
                        $('#city').append(new Option("{{ __('Select City') }}", "value"));
                        $.each(response.data, function (id, city) {
                            $('#city').append(new Option(city))

                        })
                    });
            });
        });
        $(function () {
            $('#city').on('change', function () {
                axios.post('{{ url('/get_district/') }}', {id: $(this).val()})
                    .then(function (response) {
                        $('#district').empty();
                        $('#district').append(new Option("{{ __('Select District') }}", "value"));
                        $.each(response.data, function (id, subdistrict) {
                            $('#district').append(new Option(subdistrict))
                        })
                    });
            });
        });
        $(function () {
            $('#district').on('change', function () {
                axios.post('{{ url('/get_subdistrict/') }}', {id: $(this).val()})
                    .then(function (response) {
                        $('#subdistrict').empty();
                        $('#subdistrict').append(new Option("{{ __('Select Subdistrict') }}", "value"));
                        $.each(response.data, function (id, subdistrict) {
                            $('#subdistrict').append(new Option(subdistrict))
                        })
                    });
            });
        });
        $(function () {
            $('#subdistrict').on('change', function () {
                axios.post('{{ url('/get_cost/') }}', {
                    id: $(this).val(),
                    code: jsvar
                })
                    .then(response => console.log(this.price = response.data.price))
                    .catch(error => console.log(error));
            });
        });
        $('#subdistrict').change(function () {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ url('/get_cost/') }}",
                data: {'id': id, 'code': jsvar, 'weight': berat, 'total': grand_total},
                success: function (data) {
                    $("#tampil_ongkir").html(data);
                }
            });
        });
    </script>
@endpush
