<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr style="text-align: center">
            <th>Bulan</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rencanaum as $d)
        <tr>
            <td align="center">{{$namabulan[$d->bulan]}}</td>
            <td style="text-align:right">
                <input type="text" data-bulan="{{$d->bulan}}" data-norencanaum="{{$d->no_rencana_um}}" class="form-control jumlahmutasium" style="text-align: right" value="{{number_format($d->jumlah_mutasi,'0','','.')}}" name="jumlahmutasium">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(function() {
        $(".jumlahmutasium").maskNumber({
            integer: true
            , thousands: '.'
        });

        $(".jumlahmutasium").keyup(function() {
            var bulan = $(this).attr("data-bulan");
            var no_rencana_um = $(this).attr("data-norencanaum");
            var jumlah = $(this).val();
            $.ajax({
                type: 'POST'
                , url: '/updateum'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , bulan: bulan
                    , no_rencana_um: no_rencana_um
                    , jumlah_mutasi: jumlah
                }
                , cache: false
                , success: function(respond) {

                }

            });
        });
    })

</script>
