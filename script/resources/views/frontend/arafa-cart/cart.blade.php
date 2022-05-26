@extends('frontend.arafa-cart.layouts.app')
@push('css')
    <style>
        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;

        }

        .container .ami {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }

        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .container input:checked ~ .checkmark:after {
            display: block;
        }

        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .selectt {

            padding: 30px;
            display: none;
            margin-top: 30px;
            width: 5%;
        }



    </style>
@endpush
@section('content')
    <!--====== App Content ======-->
    <form action="{{ url('checkout') }}" method="post">
        @csrf
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
                                        <a>{{ __('Cart') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section 1 ======-->
            <!--====== Section 2 ======-->
            <div class="u-s-p-b-60">
                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-60">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary">{{ __('SHOPPING CART') }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->
                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container" style=" max-width: 80% !important;">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                <div class="table-responsive">
                                    <table class="table-p">
                                        <thead>
                                        <tr>
                                            <td align="left">
                                           #</td>
                                            <td>{{ __('Hapus') }}</td>
                                            <td align="left">{{ __('Product') }}</td>
                                            <td align="center">{{ __('Qty') }}</td>
                                            <td align="center">{{ __('Coupon') }}</td>
                                            <td align="center">{{ __('Weight') }}</td>
                                            <td align="center">{{ __('Total') }}</td>
                                            <td align="center" colspan="3">{{ __('Action') }}</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(Cart::content() as $row)
                                            <tr>
                                                <td align="left"><label class="container">
                                                        <input checked name="ceklis" type="checkbox"
                                                               id="subtotCheck{{ $row->id }}"
                                                               class="ami choose hitung-checked"
                                                               value="{{ $row->price*$row->qty }}">
                                                        <span class="checkmark "></span>
                                                    </label></td>
                                                <td>
                                                    <div class="table-p__del-wrap">
                                                        <a class="far fa-trash-alt table-p__delete-link"
                                                           href="{{ url('/cart_remove',$row->rowId) }}"></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-p__box">
                                                        <div class="table-p__img-wrap">
                                                            <img class="u-img-fluid"
                                                                 src="{{ asset($row->options->preview) }}" alt="">
                                                        </div>
                                                        <div class="table-p__info">
                                       <span class="table-p__name">
                                       <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}">{{ Str::limit($row->name,70) }}</a></span>
                                                            <span class="table-p__category">
                                       <a href="{{ url('/product/'.$row->name.'/'.$row->id) }}"></a>
                                        @foreach ($row->options->attribute as $attribute)
                                                                    <p><b>{{ $attribute->attribute->name }}</b> : {{ $attribute->variation->name }}</p>
                                                                @endforeach
                                                                @foreach ($row->options->options as $op)
                                                                    <small>{{ $op->name }}</small>,
                                                                @endforeach
                                    </span>

                                                        </div>
                                                    </div>
                                                </td>
                                                <input type="hidden" value="{{$row->id}}" name="id_product[]">
                                                <td align="center">
                                                    <input style="width: 90px;"
                                                           class="input-text input-text--primary-style" name="qty[]"
                                                           type="number" value="{{ $row->qty }}" min="1"
                                                           id="check-{{ $row->id }}">
                                                </td>
                                                <td>
                                                    <input style="width: 150px;"
                                                           class="input-text input-text--primary-style" name="code[]"
                                                           type="text" min="1" id="coupon_code"
                                                           placeholder="Enter Coupon"
                                                           id="{{ $row->id }}">
                                                </td>
                                                <td align="center">
                                                    <?php $berat = 0; $total_weight = 0;?>
                                                    @foreach($weight as $key)
                                                        <?php $berat = $key->weight; ?>
                                                        <?php $total_weight += $key->weight; ?>
                                                        @if($row->id == $key->term_id)
                                                            <span
                                                                class="table-p__price">{{ $key->weight ?? '0'}} kg</span>
                                                            <input type="hidden" name="weight[]"
                                                                   value="{{ $key->weight ?? '0'}}">
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                <span id="total{{ $row->id }}"
                                                      class="table-p__price">{{ amount_format($row->price*$row->qty) }}</span>
                                                    <input name="price[]" type="hidden" id="check-price-{{ $row->id }}"
                                                           value="{{ $row->price }}">
                                                    <input type="hidden" name="total_semua[]" class="hasil_akhir"
                                                           id="subtot{{ $row->id }}"
                                                           value="{{ $row->price*$row->qty }}">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="colorCheckbox"
                                                           value="C-{{$row->id}}"> <i
                                                        style="font-size: 13px;">{{ __('Set as dropship') }}</i><br>
                                                </td>
                                                <td class="C-{{$row->id}} selectt">
                                                    @if(Auth::guard('customer')->check())
                                                        <div class="table-p__del-wrap">
                                                            <a href="" data-toggle="modal"
                                                               data-target="#status-{{ $row->id }}"
                                                               class="fas fa-address-card table-p__delete-link"
                                                            > </a>
                                                        </div>
                                                        <div class="modal fade" id="status-{{ $row->id }}" tabindex="-1"
                                                             role="dialog" aria-labelledby="exampleModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content ">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel">{{ __('Select Destination') }} </h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <table style="font-size: 13px;">
                                                                            @forelse($address as $a)
                                                                                <tr>
                                                                                    <td><input
                                                                                            id="address{{ $row->id }}-{{ $a->id }}"
                                                                                            type="radio"
                                                                                            class="form-control"
                                                                                            name="location[{{ $row->id }}]"
                                                                                            value="{{ $a->address_id }}">
                                                                                    </td>
                                                                                    <td><b>{{ $a->recipient }}</b> <br>
                                                                                        <b>0{{ $a->phonenumber }}</b>
                                                                                    </td>
                                                                                    <td> {{ $a->detail }}</td>
                                                                                </tr>
                                                                            @empty
                                                                                <a class="mini-link btn-sm btn--e-transparent-secondary-b-2"
                                                                                   href="{{ url('/user/address') }}">{{ __('Add New Address') }}</a>
                                                                            @endforelse
                                                                        </table>
                                                                        <a class="mini-link btn--e-transparent-secondary-b-2"
                                                                           href="{{ url('/user/address') }}">{{ __('Add New Address') }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <a href="{{ url('/user/login') }}"
                                                           class="btn btn--e-brand-b-2 btn-lg">{{ __('Login First') }}</a>
                                                    @endif
                                                </td>
                                                <td class="C-{{$row->id}} selectt">
                                                    <input value="" type="hidden" id="id_address-{{ $row->id }}"
                                                    >
                                                    <a href="" data-toggle="modal" data-target="#courier-{{ $row->id }}"
                                                       class="fa fa-car"
                                                    > </a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="courier-{{ $row->id }}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="exampleModalLabel"> {{ __('Set Courier Type') }}</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <span style="font-size: 11px;" id="ongkir2-{{ $row->id }}">Please Choose Address First!!</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="C-{{$row->id}} selectt">
                                                    <a href="" data-toggle="modal"
                                                       data-target="#dropship-{{ $row->id }}"
                                                       class="fa fa-user"
                                                    > </a>
                                                    <div class="modal fade" id="dropship-{{ $row->id }}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Set
                                                                        Dropship</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <div class="checkout-f">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <label class="gl-label"
                                                                                           for="billing-fname">{{ __('Full Name') }}
                                                                                        *</label>
                                                                                    <input type="text"
                                                                                           placeholder="Full Name"
                                                                                           name="drosphip_name[]"
                                                                                           class="input-text input-text--primary-style"
                                                                                           value="">
                                                                                    <br><br>

                                                                                    <label class="gl-label"
                                                                                           for="billing-fname">{{ __('Number Telephone') }}
                                                                                    </label>
                                                                                    <input type="number"
                                                                                           width="100%"
                                                                                           placeholder="Number Telephone"
                                                                                           name="drosphip_number[]"
                                                                                           class="input-text input-text--primary-style"
                                                                                           value="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                            <!--====== End - Row ======-->
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="6" align="center">Subtotal</td>
                                            <td align="center">
                                                <span id="all_total"
                                                      class="table-p__price">{{ amount_format($row->price*$row->qty) }}</span>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="route-box">
                                    <div class="route-box__g1">
                                        <a class="route-box__link" href="{{ url('/shop') }}"><i
                                                class="fas fa-long-arrow-alt-left"></i>
                                            <span>{{ __('CONTINUE SHOPPING') }}</span></a>
                                    </div>
                                    <div class="route-box__g2">
                                        <a class="route-box__link" href="{{ url('/cart-clear') }}"><i
                                                class="fas fa-trash"></i>
                                            <span>{{ __('CLEAR CART') }}</span></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="u-s-p-b-60">
                <div class="section__content">
                    <div class="container" style=" max-width: 80% !important;">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                <div class="row">
                                    <div class="col-lg-8 col-md-6 u-s-m-b-30">
                                        <div class="f-cart__pad-box">
                                            <h1 class="gl-h1">{{ __('Set Primary Address ?') }}</h1>
                                            <table style="font-size: 12px;">
                                                @foreach($address as $a)
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="5%"><input
                                                                id="address_primary-{{ $a->id }}"
                                                                type="radio"
                                                                class="form-control"
                                                                name="primary_address"
                                                                value="{{ $a->address_id }}">
                                                        </td>
                                                        <td width="15%"><b>{{ $a->recipient }}</b> <br>
                                                            <b>0{{ $a->phonenumber }}</b>
                                                        </td>
                                                        <td width="85%"> {{ $a->detail }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                            <hr>
                                            <br>
                                            <span style="font-size: 11px;" id="ongkir"></span>
                                            <br>
                                            <a class="mini-link btn--e-transparent-secondary-b-2"
                                               href="{{ url('/user/address') }}">{{ __('Add New Address') }}</a>

                                        </div>
                                    </div>
                                    {{--                                </form>--}}
                                    <div class="col-lg-4 col-md-6 u-s-m-b-30">
                                        <div class="f-cart__pad-box">
                                            <div class="u-s-m-b-30">

                                                <table class="f-cart__table">

                                                    <tbody>
                                                    <tr>
                                                        <td>{{ __('Price Total') }}</td>
                                                        <td><span
                                                                class="all_total"> {{ amount_format(Cart::priceTotal()) }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('Subtotal') }}</td>
                                                        <td><span
                                                                class="all_total">{{ amount_format(Cart::subtotal()) }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('Shipping Fee') }}</td>
                                                        <td><span class="shiping_fee">{{ amount_format(0) }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('Tax') }}</td>
                                                        <td>{{ amount_format(Cart::tax()) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('Discount') }}</td>
                                                        <td> {{ amount_format(Cart::discount()) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('Grand Total') }}</td>
                                                        <td><span
                                                                class="all_total">{{ amount_format(Cart::total()) }}</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @php $city_code_data = json_decode($city_code->value)->city @endphp
                                            <input type="hidden" name="origin" value="{{$city_code_data}}">
                                            <div>
                                                <button type="submit"
                                                        class="btn btn-lg btn--e-brand-b-2 ">{{ __('Proceed to checkout') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{--           addresss--}}

            </div>
        </div>
        <!--====== End - Section 3 ======-->
        </div>
    </form>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/form.js') }}"></script>
    <script>
        function format_rupiah(nominal) {
            var reverse = nominal.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            return ribuan = ribuan.join(',').split('').reverse().join('');
        }

        $(document).ready(function () {
            $('input[type="checkbox"]').click(function () {
                var inputValue = $(this).attr("value");
                $("." + inputValue).toggle();
            });
        });
        $(document).ready(function () {
            var end = 0;
            var total_default = 0;
            <?php foreach (Cart::content() as $row): ?>
            <?php echo "var price ='$row->price';"; ?>
            <?php echo "var qty ='$row->qty';"; ?>
            $(<?php echo "'#check-$row->id'" ?>).on('change', function () {
                var checked_qty = $(<?php echo "'#check-$row->id'" ?>).val()
                var checked_price = $(<?php echo "'#check-price-$row->id'" ?>).val()
                if (checked_qty >= qty) {
                    end = checked_price * checked_qty;
                    $(<?php echo "'#total$row->id'" ?>).text('Rp.' + format_rupiah(end) + '.00');
                    $(<?php echo "'#subtot$row->id'" ?>).val(end);
                    $(<?php echo "'#subtotCheck$row->id'" ?>).val(end);
                    var arr = document.getElementsByClassName("hasil_akhir");
                    var tot = 0;
                    for (var i = 0; i < arr.length; i++) {
                        if (parseInt(arr[i].value))
                            tot += parseInt(arr[i].value);
                    }
                    $("#all_total").text('Rp.' + format_rupiah(tot) + '.00');
                    $(".all_total").text('Rp.' + format_rupiah(tot) + '.00');
                }
            });
            $(".hitung-checked").change(function () {
                var count = 0;
                var table_abc = document.getElementsByClassName("hitung-checked");
                for (var i = 0; table_abc[i]; ++i) {
                    if (table_abc[i].checked) {
                        var value = table_abc[i].value;
                        count += Number(table_abc[i].value);
                    }
                }
                var arr = document.getElementsByName('total_semua');
                var tot = 0;
                for (var i = 0; i < arr.length; i++) {
                    if (parseInt(arr[i].value))
                        tot += parseInt(arr[i].value);
                }
                $("#all_total").text('Rp.' + format_rupiah(count) + '.00');
                $(".all_total").text('Rp.' + format_rupiah(count) + '.00');
            });
            total_default += price * qty
            //set address primary
            <?php echo "var id ='$row->id';"; ?>
            <?php echo "var from ='$city_code_data';"; ?>
            <?php echo "var berat ='$berat';"; ?>
            <?php echo "var berat_total ='$total_weight';"; ?>
            <?php echo "var grand_total ='535453';"; ?>
            <?php foreach ($address as $a): ?>
            <!--                RAJA ONGKIR-->
            $(<?php echo "'#address_primary-$a->id'" ?>)
                .change(function () {
                    if ($(this).is(":checked")) {
                        var id_address = $(this).val();
                        console.log('id_val', id_address)
                        let token = $("meta[name='csrf-token']").attr("content");
                        let city_origin = 155;
                        let city_destination = id_address;
                        let courier = 'jne';
                        let weight = 1500;
                        jQuery.ajax({
                            url: "{{ url('/rajaongkir') }}",
                            data: {
                                _token: token,
                                city_origin: city_origin,
                                city_destination: city_destination,
                                courier: courier,
                                weight: weight,
                            },
                            dataType: "JSON",
                            type: "POST",
                            success: function (response) {
                                isProcessing = false;
                                if (response) {
                                    $('#ongkir').empty();
                                    $('.ongkir').addClass('d-block');
                                    var html = '<table class="table-p">\n' +
                                        '    <thead>\n' +
                                        '    <tr>\n' +
                                        '        <th>Service Code</th>\n' +
                                        '        <th>Type</th>\n' +
                                        '        <th>Price</th>\n' +
                                        '        <th>Estimation</th>\n' +
                                        '        <th>Select</th>\n' +
                                        '    </tr>\n' +
                                        '    </thead>\n' +
                                        '    <tbody align="center">';
                                    $.each(response[0]['costs'], function (key, value) {
                                        html += '<tr>';
                                        html += '<td>' + response[0].code.toUpperCase() + '</td>';
                                        html += '<td>' + value.service + '</td>';
                                        html += '<td>Rp. ' + format_rupiah(value.cost[0].value) + '</td>';
                                        html += '<td>' + value.cost[0].etd + ' days</td>';
                                        html += '<td><input type="radio" class="ship_fee form-control"  name="primary_shipping_mode" value="' + value.cost[0].value + '" ></td>';
                                    });
                                    html += ' </tbody></table>';
                                    $('#ongkir').append(html);

                                }
                            },
                            error: function (response) {
                                alert("Something was wrong, choose another address!!");
                            }
                        });
                    }
                });

            $(<?php echo "'#address$row->id-$a->id'" ?>)
                .change(function () {
                    if ($(this).is(":checked")) {
                        var id_address = $(this).val();
                        document.getElementById(<?php echo "'id_address-$row->id'" ?>).value = id_address;
                        let token = $("meta[name='csrf-token']").attr("content");
                        let city_origin = 155;
                        let city_destination = id_address;
                        let courier = 'jne';
                        let weight = 1500;
                        jQuery.ajax({
                            url: "{{ url('/rajaongkir') }}",
                            data: {
                                _token: token,
                                city_origin: city_origin,
                                city_destination: city_destination,
                                courier: courier,
                                weight: weight,
                            },
                            dataType: "JSON",
                            type: "POST",
                            success: function (response) {
                                isProcessing = false;
                                if (response) {
                                    $(<?php echo "'#ongkir2-$row->id'" ?>).empty();
                                    $('.ongkir').addClass('d-block');
                                        <?php echo "var id_d ='$row->id';"; ?>
                                    var html = '<table class="table-p">\n' +
                                        '    <thead>\n' +
                                        '    <tr>\n' +
                                        '        <th>Service Code</th>\n' +
                                        '        <th>Type</th>\n' +
                                        '        <th>Price</th>\n' +
                                        '        <th>Estimation</th>\n' +
                                        '        <th>Select</th>\n' +
                                        '    </tr>\n' +
                                        '    </thead>\n' +
                                        '    <tbody align="center">';
                                    $.each(response[0]['costs'], function (key, value) {
                                        html += '<tr>';
                                        html += '<td>' + response[0].code.toUpperCase() + '</td>';
                                        html += '<td>' + value.service + '</td>';
                                        html += '<td>Rp. ' + format_rupiah(value.cost[0].value) + '</td>';
                                        html += '<td>' + value.cost[0].etd + ' days</td>';
                                        html += '<td><input type="radio" class="ship_fee form-control"  name="dropship_shiping['+id_d+']" value="' + value.cost[0].value + '" ></td>';
                                    });
                                    html += ' </tbody></table>';
                                    $(<?php echo "'#ongkir2-$row->id'" ?>).append(html);

                                }
                            },
                            error: function (response) {
                                alert("Something was wrong, choose another address!!");
                            }
                        });
                    }
                });
            <?php endforeach; ?>
            <?php endforeach; ?>
            console.log(total_default);

            $("#all_total").text('Rp.' + format_rupiah(total_default) + '.00');


        });
        $("input[name='primary_shipping_mode']").on('click', function () {
            var radioValue = $("input[name='primary_shipping_mode']:checked").val();
            if (radioValue) {
                alert("Your are a - " + radioValue);
            }
        });
        $('#select-all').click(function (event) {
            if (this.checked) {
                $('.choose').each(function () {
                    this.checked = true;
                });
            } else {
                $('.choose').each(function () {
                    this.checked = false;
                });
            }
        });
        $('.btn-number').click(function (e) {
            e.preventDefault();
            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {
                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }
                } else if (type == 'plus') {
                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }
                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function () {
            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>
@endpush
