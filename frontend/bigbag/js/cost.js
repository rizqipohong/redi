
//dropship mode
$(function () {
    $('#province2').on('change', function () {
        axios.post('{{ url('/get_city/') }}', {id: $(this).val()})
            .then(function (response) {
                $('#city2').empty();
                $('#city2').append(new Option("{{ __('Select City') }}", "value"));
                $.each(response.data, function (id, city) {
                    $('#city2').append(new Option(city))

                })
            });
    });
});
$(function () {
    $('#city2').on('change', function () {
        axios.post('{{ url('/get_district/') }}', {id: $(this).val()})
            .then(function (response) {
                $('#district2').empty();
                $('#district2').append(new Option("{{ __('Select District') }}", "value"));
                $.each(response.data, function (id, subdistrict) {
                    $('#district2').append(new Option(subdistrict))
                })
            });
    });
});
$(function () {
    $('#district2').on('change', function () {
        axios.post('{{ url('/get_subdistrict/') }}', {id: $(this).val()})
            .then(function (response) {
                $('#subdistrict2').empty();
                $('#subdistrict2').append(new Option("{{ __('Select Subdistrict') }}", "value"));
                $.each(response.data, function (id, subdistrict) {
                    $('#subdistrict2').append(new Option(subdistrict))
                })
            });
    });
});
$(function () {
    $('#subdistrict2').on('change', function () {
        axios.post('{{ url('/get_cost/') }}', {
            id: $(this).val(),
            code: jsvar
        })
            .then(response => console.log(this.price = response.data.price))
            .catch(error => console.log(error));
    });
});
$('#subdistrict2').change(function () {
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