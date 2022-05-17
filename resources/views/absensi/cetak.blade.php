<link rel="stylesheet" href="{{asset('assets/mycss/table.css')}}">
<div class="page">
    <div class="subpage">
        <table border="0" width="100%" style="text-align: left;">
            <thead>
                <tr>
                    <th align="center" width="13%">
                        <img src="{{asset('assets/static/logopersis.png')}}" alt=""
                            style="width:auto; height:auto; max-width:70px; max-height:70px; display:block;"></th>
                    <th>
                        <table border="0">
                            <thead>
                                <tr>
                                    <th>
                                        <h5 style="margin: 0;" align="left">LAPORAN ABSENSI SDM</h5>
                                        <h5 style="margin: 0;" align="left">PESANTREN PERSATUAN ISLAM 80 AL AMIN</h5>
                                        <h5 style="margin: 0;" align="left">SINDANGKASIH CIAMIS</h5>
                                        <h5 style="margin: 0;" align="left">BULAN : {{$bln}} {{$tahun}}</h5>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </th>
                </tr>
            </thead>
        </table>
        {{-- <table style="margin-top:10px; font-size:75%">
            <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td style="font-weight: bold">{{$karyawan->nama_lengkap}}</td>
            </tr>
        </table> --}}
        <table class="datatable3" style="margin-top:20px;">
            <thead>
                <tr>
                    <th rowspan="2">NPP</th>
                    <th rowspan="2">Nama Karyawan</th>
                    <th colspan="31">Tanggal</th>
                    <th rowspan="2">WH</th>
                    <th rowspan="2">TH</th>
                    <th rowspan="2">%</th>
                </tr>
                <tr style="font-size:12px">
                    @for ($i = 1; $i <= 31; $i++) <th>{{$i}}</th>
                        @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($absensi as $d)
                <tr>
                    <td>{{$d->npp}}</td>
                    <td>{{$d->nama_lengkap}}</td>
                    @php
                         $total = 0;
                    @endphp
                    @for ($i = 1; $i <= 31; $i++) <td align="center" style="font-weight:bold">
                        @php
                        $tgl= "tgl_".$i;
                        $check = $d->$tgl;
                        if(!empty($check)){
                        echo "✓";
                            $total += 1;
                        }
                        @endphp
                        </td>
                        @endfor
                        <td></td>
                        <td style="text-align: center; font-weight:bold">{{$total}}</td>
                        <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>



    </div>
</div>
</body>

</html>

<style type="text/css">
    .row {
        margin-top: 0;
        margin-bottom: 0;
    }

    .data {
        margin-top: 0;
        margin-bottom: 0;
    }

    .wrapper-header {
        width: 100%;
        font-size: 72%;
    }

    .left {
        content: " ";
        float: left;
    }

    .right {
        float: right;
        width: 50%;
    }

    .wrapper-header .table {
        width: 100%;
    }

    #btm td {
        border-bottom: 1px solid black;
    }

    body {
        font-family: Arial;
        font-style: bold;
        margin: 0;
        background-color: #404040;
    }

    .page {
        width: 330mm;
        min-height: 215mm;
        padding: 1mm;
        margin: 5mm auto;
        background: white;
    }

    .subpage {
        margin-left: 5mm;
        margin-right: 5mm;
        margin-top: 5mm;
        margin-bottom: 5mm;
    }

    table td {
        vertical-align: top;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    @page {
        size: A4 landscape;
        margin: 0;

    }

    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
