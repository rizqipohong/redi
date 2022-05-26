@extends('frontend.arafa-cart.account.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/bigbag/css/order.css') }}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
        .scroll {
            margin: 5px;
            padding: 5px;
            width: 100%;
            height: 700px;
            overflow: auto;
            text-align: justify;
        }
    </style>
@endpush
@section('user_content')
    <div class="dash__box dash__box--shadow dash__box--bg-white dash__box--radius u-s-m-b-30">
        <div class="dash__pad-2">
            <h1 class="dash__h1 u-s-m-b-14">{{ __('Edit Address') }}</h1>
            <div class="dash__link dash__link--secondary u-s-m-b-30">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="dash-edit-p basicform" method="post" action="{{ url('/user/address/update', $data->id) }}">
                            @csrf
                            <div class="gl-inline">
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="reg-fname">{{ __('Province') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="province" class="input-text input-text--primary-style" id="province">
                                        <option selected disabled value="">{{ __('Select Province') }}</option>
                                        @foreach($destination as $province)
                                            <option
                                                value="{{ $province->province }}">{{ $province->province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="reg-fname">{{ __('City') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="city" id="city" class="input-text input-text--primary-style">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="reg-fname">{{ __('District') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="district" id="district" class="input-text input-text--primary-style">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="reg-fname">{{ __('Sub District') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="location" id="subdistrict"
                                            class="input-text input-text--primary-style">
                                        @if($data->address_id)
                                            <option value="{{$data->address_id}}">{{$data->address_id}}</option>
                                        @else
                                            <option value=""></option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="gl-inline">
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="reg-fname">{{ __('Recipient"s Name') }} </label>
                                    <input value="{{ $data->recipient }}" class="input-text input-text--primary-style"
                                           name="recipient" type="text">
                                </div>
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="reg-fname">{{ __('Phone Number') }} </label>
                                    <input value="{{ $data->phonenumber }}" class="input-text input-text--primary-style"
                                           name="phonenumber"
                                           type="number">
                                </div>
                            </div>

                            <div class="u-s-m-b-30">
                                <label class="gl-label" for="reg-fname">{{ __('Your Full Address') }} </label>
                                <textarea class="input-text input-text--primary-style" name="detail" id="" cols="50"
                                          rows="30"> {{ $data->detail }}</textarea>
                            </div>
                            <button class="btn btn--e-brand-b-2 basicbtn" type="submit">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="{{ asset('frontend/bigbag/js/checkout.js') }}"></script>
    <script src="{{ asset('frontend/bigbag/js/get_dest.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
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
                            $('#subdistrict').append(new Option(subdistrict, id))
                        })
                    });
            });
        });
        $(function () {
            $('#subdistrict').on('change', function () {
                axios.post('{{ url('/get_cost/') }}', {
                    id: $(this).val(),
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
                    console.log('asu_tenan', id)
                    $("#tampil_ongkir").html(data);
                }
            });
        });
    </script>
@endpush
