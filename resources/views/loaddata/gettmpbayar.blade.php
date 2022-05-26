@php
$totalbayar = 0;
@endphp
@foreach ($tmp_bayar as $t)
@php
$jenjang = $t->jenjang;
$totalbayar+=$t->jumlah_bayar;
@endphp


<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$t->jenisbayar}}</td>
    <td>
        @if ($t->jenisbayar=="SPP" )
        SPP Bulan {{$namabulan[$t->ket]}} <b>{{$jenjang}} {{$t->tahunakademik}}</b>
        @elseif($t->jenisbayar == "Uang Lauk")
        Uang Lauk Bulan {{$namabulan[$t->ket]}} <b>{{$jenjang}} {{$t->tahunakademik}}</b>
        @else
        {{$t->jenisbayar}} <b>{{$jenjang}} {{$t->tahunakademik}}</b>
        @endif
    </td>
    <td align="right">{{number_format($t->jumlah_bayar,'0','','.')}}</td>
    <td><a href="#" class="btn btn-sm btn-danger hapus" data-id="{{$t->id_temp}}"><i class="fa fa-trash-o"></i></a></td>
</tr>
@endforeach
<tr class="thead-dark">
    <th colspan="3">TOTAL</th>
    <th style="text-align: right">{{number_format($totalbayar,'0','','.')}}</td>
    <th></th>
</tr>
<script>
    $(function() {
        function loadcekdatatmp() {
            var kodebiaya = $("#kodebiaya").val();
            var no_pendaftaran = $("#no_pendaftaran").val();
            $.ajax({
                type: 'POST'
                , url: '/loaddata/cektmpbayar'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , kodebiaya: kodebiaya
                    , no_pendaftaran: no_pendaftaran
                }
                , cache: false
                , success: function(respond) {
                    console.log(respond);
                    $("#cekdata").val(respond);
                }
            });
        }

        function loadrencanaspp() {
            var mulaispp = $("#mulaispp").val();
            //alert(mulaispp);
            var kodebiaya = $("#kodebiaya").val();
            var no_pendaftaran = $("#no_pendaftaran").val();
            var bulanspp = $("#bulanspp").val();
            $.ajax({
                type: 'POST'
                , url: '/loaddata/getrencanaspp'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , mulaispp: mulaispp
                    , kodebiaya: kodebiaya
                    , no_pendaftaran: no_pendaftaran
                    , bulanspp: bulanspp
                }
                , cache: false
                , success: function(respond) {
                    $("#jumlah_spp").val(respond);
                    $("#wajib_bayar").val(respond);
                    $("#sisabayar").text("");
                    console.log(respond);
                }
            });
        }

        function loaddata_tmpbayar() {
            var no_pendaftaran = $("#no_pendaftaran").val();
            var kodebiaya = $("#kodebiaya").val();
            $.ajax({
                type: 'POST'
                , url: '/loaddata/gettmpbayar'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , no_pendaftaran: no_pendaftaran
                    , kodebiaya: kodebiaya
                }
                , cache: false
                , success: function(respond) {
                    $("#load_tmpbayar").html(respond);
                }
            });
        }

        function loadbulanspp() {
            var mulaispp = $("#mulaispp").val();
            var kodebiaya = $("#kodebiaya").val();
            var no_pendaftaran = $("#no_pendaftaran").val();
            $.ajax({
                type: 'POST'
                , url: '/loaddata/getoptionbulan'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , mulaispp: mulaispp
                    , kodebiaya: kodebiaya
                    , no_pendaftaran: no_pendaftaran
                }
                , cache: false
                , success: function(respond) {
                    $("#bulanspp").html(respond);
                    loadrencanaspp();
                    console.log(respond);
                }
            });
        }

        $(".hapus").click(function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            //alert(id);
            $.ajax({
                type: 'POST'
                , url: '/pembayaran/hapus_bayartemp'
                , data: {
                    id: id
                    , _token: "{{ csrf_token() }}"
                , }
                , cache: false
                , success: function(respond) {
                    loaddata_tmpbayar();
                    loadbulanspp();
                    loadcekdatatmp();
                }
            });
        });
    });

</script>
