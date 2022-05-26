<br>
<table style="height: 10px;"class="bigbag_responsive-table">
    <thead>
    <tr>
        <th>{{ __('Service Code') }}</th>
        <th>{{ __('Type') }}</th>
        <th>{{ __('Price') }}</th>
        <th>{{ __('Estimation') }}</th>
        <th>{{ __('Select') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data['price'] as $member)
        <tr>
            <td>{{ $member['service_code'] }}</td>
            <td>{{ $member['goods_type'] }}</td>
            <td>{{ amount_format($member['price']) }}</td>
            <td>{{ $member['etd_from'] }} - {{ $member['etd_thru'] }} days</td>
            <td align="center">
                <div class="radio">
                    <label><input type="radio" required
                                  refund_threshold_value="{{ $member['etd_thru'] }}"
                                  total_all="{{$grand_total}}"
                                  tarif="{{$member['price']}}"
                                  service="{{$member['service_code']}}"
                                  estimation="{{ $member['etd_from'] }} - {{ $member['etd_thru'] }}"
                                  name="shipping_mode" class="courier"></label>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script type="text/javascript">
    function format_rupiah(nominal) {
        var reverse = nominal.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        return ribuan = ribuan.join(',').split('').reverse().join('');
    }

    $('.courier').on('click', function () {
        var tarif = parseInt($(this).attr("tarif"));
        var total_all = parseFloat($(this).attr("total_all"));
        var end = parseInt(tarif) + parseFloat(total_all);
        var refund_threshold = parseInt($(this).attr("refund_threshold_value"));
        var service = $(this).attr("service");
        var estimation = $(this).attr("estimation");
        var html = '<td><h6 class="mb-0">{{ __('Shipping Charge') }}</h6></td><td></td><td><strong>Rp.' + format_rupiah(tarif) + '.00</strong></td>';
        $('#shipping_fee').html(html);
        $('.ongkir').text('Rp.' + format_rupiah(end) + '.00');
        console.log('tarif', end);
        document.getElementById("fee_ship").value = tarif;
        document.getElementById("refund_threshold").value = refund_threshold;
        document.getElementById("service").value = service;
        document.getElementById("estimation").value = estimation;
    });
    console.log('.courier');
</script>

