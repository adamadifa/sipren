<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr style="text-align: center">
            <th>Bulan</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rencanaspp as $d)
            <tr>
                <td align="center">{{$namabulan[$d->bulan]}}</td>
                <td style="text-align:right">
                    <input type="text" data-bulan="{{$d->bulan}}" data-norencanaspp="{{$d->no_rencana_spp}}" class="form-control jumlahrencanaspp" style="text-align: right" value="{{number_format($d->jumlah,'0','','.')}}" name="jumlahrencanaspp"  >
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(function(){
        $(".jumlahrencanaspp").maskNumber({
            integer:true,
            thousands:'.'
        });

        $(".jumlahrencanaspp").keyup(function(){
            var bulan = $(this).attr("data-bulan");
            var no_rencana_spp = $(this).attr("data-norencanaspp");
            var jumlah = $(this).val();
            $.ajax({
                type:'POST',
                url:'/updatespp',
                data:{
                    _token:"{{ csrf_token() }}",
                    bulan:bulan,
                    no_rencana_spp:no_rencana_spp,
                    jumlah:jumlah
                },
                cache:false,
                success:function(respond){

                }

            });
        });
    })
</script>

