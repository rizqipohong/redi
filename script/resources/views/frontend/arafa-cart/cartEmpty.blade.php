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
    <form action="{{ url('checkout/data') }}" method="post">
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
                                            <td align="left"><label class="container ">
                                                    <input type="checkbox" name="select-all" class="ami"
                                                           id="select-all">
                                                    <span class="checkmark"></span>
                                                </label></td>
                                            <td>{{ __('Hapus') }}</td>
                                            <td align="left">{{ __('Product') }}</td>
                                            <td align="center">{{ __('Qty') }}</td>
                                            <td align="center">{{ __('Weight') }}</td>
                                            <td align="center">{{ __('Total') }}</td>
                                            <td align="center" colspan="3">{{ __('Action') }}</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
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
                <!--====== End - Section Content ======-->
            </div>
            {{--          if any coupon--}}
            <div class="u-s-p-b-60">
                <!--====== Section Content ======-->
                <div class="section__content">

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
            var hasil = 0;
            <?php foreach (Cart::content() as $row): ?>
            $(<?php echo "'#$row->id'" ?>).on('change', function () {
                    <?php echo "var price ='$row->price';"; ?>
                var end = price * $(this).val();
                $(<?php echo "'#total$row->id'" ?>).text('Rp.' + format_rupiah(end) + '.00');
                hasil += end
                $(<?php echo "'#all_total'" ?>).text('Rp.' + format_rupiah(hasil) + '.00');
                console.log(hasil);
                document.getElementById(<?php echo "'subtot$row->id'" ?>).value = end;
            });
            //set address primary
            <?php echo "var id ='$row->id';"; ?>
            <?php echo "var from ='$city_code_data';"; ?>
            <?php echo "var berat ='$berat';"; ?>
            <?php echo "var grand_total ='535453';"; ?>
            <?php foreach ($address as $a): ?>
            $(<?php echo "'#address_primary-$a->id'" ?>)
                .change(function () {
                    if ($(this).is(":checked")) {
                        var id_address = $(this).val();
                        $.ajax({
                            type: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: "{{ url('/cost_primary/') }}",
                            data: {
                                'id': id,
                                'code': from,
                                'tariff_code': id_address,
                                'weight': berat,
                                'total': grand_total
                            },
                            success: function (data) {
                                $('#show_address_primary').html(data);
                            },
                            error: function (data) {
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
                        $.ajax({
                            type: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: "{{ url('/get_cost/') }}",
                            data: {
                                'id': id,
                                'code': from,
                                'tariff_code': id_address,
                                'weight': berat,
                                'total': grand_total
                            },
                            success: function (data) {
                                $(<?php echo "'#tampil_ongkir-$row->id'" ?>).html(data);
                            },
                            error: function (data) {
                                alert("Something was wrong, choose another address!!");
                            }
                        });
                    }
                });
            <?php endforeach; ?>
            <?php endforeach; ?>
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
