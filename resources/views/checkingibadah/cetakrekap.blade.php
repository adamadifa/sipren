<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
<title>Cetak Rekap Pengisian Checklist Ibadah</title>
<style>
    @page {
        size: F4 landscape;
        margin: 10mm 5mm 10mm 5mm;

    }

    .sheet {
        overflow: visible;
        height: auto !important;
        width: 100% !important
    }

    body {
        font-family: 'Poppins'
    }

</style>
<link rel=" stylesheet" href="{{asset('assets/mycss/table.css')}}">
<body class="A4 landscape">
    <section class="sheet padding-10mm">
        <table border="0" width="100%" style="text-align: left;">
            <thead>
                <tr>
                    <th align="center" width="5%">
                        <img src="{{asset('assets/static/logopersis.png')}}" alt="" style="width:auto; height:auto; max-width:70px; max-height:70px; display:block;"></th>
                    <th>
                        <table border="0">
                            <thead>
                                <tr>
                                    <th>
                                        <h5 style="margin: 0;" align="left">LAPORAN PRESENSI SISWA</h5>
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
                    <th rowspan="2">Nama Lengkap</th>
                    <th colspan="31">Tanggal</th>
                    <th rowspan="2">Total</th>
                </tr>
                <tr style="font-size:12px">
                    @for ($i = 1; $i <= 31; $i++) <th>{{$i}}</th>
                        @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($checklist as $d)
                <tr>
                    <td>{{$d->npp}}</td>
                    <td>{{ucwords(strtolower($d->nama_lengkap))}}</td>
                    @php
                    $total = 0;
                    @endphp
                    @for ($i = 1; $i <= 31; $i++) <td align="center" style="font-weight:bold">
                        @php
                        $tgl= "tgl_".$i;
                        $check = $d->$tgl;
                        if(!empty($check)){
                        echo "&#10004";
                        $total += 1;
                        }
                        @endphp
                        </td>
                        @endfor

                        <td style="text-align: center; font-weight:bold">{{$total}}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>
