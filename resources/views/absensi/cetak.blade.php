<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
<title>Cetak Absensi Karyawan</title>
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
                    <th rowspan="2" style="background: red">TL</th>
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
                    <td>{{ucwords(strtolower($d->nama_lengkap))}}</td>
                    @php
                    $total = 0;
                    @endphp
                    @for ($i = 1; $i <= 31; $i++) <td align="center" style="font-weight:bold">
                        @php
                        $tgl= "tgl_".$i;
                        $check = $d->$tgl;
                        if(!empty($check)){
                        // echo $check;
                        $jam = explode("-",$check);
                        $jam_masuk = date("H:i:s",strtotime($jam[0]));
                        $jam_pulang = date("H:i:s",strtotime($jam[1]));
                        if($jam_masuk == "00:00:00" || $jam_pulang=="00:00:00"){
                        $color = "red";
                        }else{
                        $color ="";
                        }

                        echo "<span style='color:$color'>".$jam_masuk."<br>".$jam_pulang."</span>";
                        $total += 1;
                        }
                        @endphp
                        </td>
                        @endfor
                        <td></td>
                        <td style="text-align: center; font-weight:bold">{{$total}}</td>
                        <td></td>
                        <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>



    </section>
</body>
</html>
