@extends('frontend.arafa-cart.account.layout.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/bigbag/css/order.css') }}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
        <div class="dash__table-2-wrap gl-scroll">
            <table class="dash__table-2">
                <thead>
                <tr>
                    <th>{{ __('No') }}</th>
                    <th>{{ __('Address') }}</th>
                    <th>{{ __('Recipient"s Name') }}</th>
                    <th>{{ __('Phone Number') }}</th>
                    <th>{{ __('Primary Address') }}</th>
                    <th>{{ __('Act') }}</th>
                </tr>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                @foreach($data_address as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->detail }}</td>
                        <td>{{ $row->recipient }}</td>
                        <td>{{ $row->phonenumber }}</td>
                        <td class="text-center">
                            @if($row->status == 1)
                                <a href=""><i style="color: green;" class="fas fa-globe"></i> Primary</a>
                            @else
                                <a href="{{ url('/user/address/primary', $row->id) }}"><i class="fas fa-globe"></i></a>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ url('/user/address/edit', $row->id) }}"><i class="fas fa-pencil-alt"></i></a>&nbsp;&nbsp;
                            <a class="button" href="" data-id="{{$row->id}}"><i class="fas fa-trash-alt"
                                                                                aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="dash__pad-2">
            <h1 class="dash__h1 u-s-m-b-14">{{ __('Create Address') }}</h1>
            <div class="dash__link dash__link--secondary u-s-m-b-30">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="dash-edit-p basicform" action="{{ url('/user/address/create') }}">
                            <div class="gl-inline">
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="reg-fname">{{ __('Province') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="province" class="input-text input-text--primary-style" id="province">
                                        <option selected disabled value="">{{ __('Select Province') }}</option>
                                        @foreach($daftarProvinsi as $province)
                                            <option
                                                value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="reg-fname">{{ __('City') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="city" class="input-text input-text--primary-style">
                                        @foreach($daftarKota as $city)
                                            <option
                                                value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="gl-inline">
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="reg-fname">{{ __('Recipient"s Name') }} </label>
                                    <input class="input-text input-text--primary-style" name="recipient" type="text">
                                </div>
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="reg-fname">{{ __('Phone Number') }} </label>
                                    <input class="input-text input-text--primary-style" name="phonenumber"
                                           type="number">
                                </div>
                            </div>

                            <div class="u-s-m-b-30">
                                <label class="gl-label" for="reg-fname">{{ __('Your Full Address') }} </label>
                                <textarea class="input-text input-text--primary-style" name="detail" id="" cols="90"
                                          rows="90"></textarea>
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
        $(document).on('click', '.button', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                    title: "Are you sure !",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function () {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{url('/user/address/delete')}}",
                        data: {id: id},
                        success: function (data) {
                            location.reload(true);
                        }
                    });
                });
        });
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
