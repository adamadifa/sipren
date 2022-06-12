<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
<title>Rekap Simpanan</title>
<style>
    @page {
        size: A4 landscape;
        margin: 10mm 5mm 10mm 5mm;

    }

    .sheet {
        overflow: visible;
        height: auto !important;
    }

    body {
        font-family: 'Poppins'
    }

</style>

<link rel="stylesheet" href="{{asset('assets/mycss/table.css')}}">
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
                                        <h5 style="margin: 0;" align="left">LAPORAN AMALAN HARIAN SDM</h5>
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
        <table style="margin-top:10px; font-size:75%">
            <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td style="font-weight: bold">{{$karyawan->nama_lengkap}}</td>
            </tr>
        </table>
        <table class="datatable3" style="margin-top:20px;">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">Kegiatan Ibadah</th>
                    <th colspan="31">Tanggal</th>
                </tr>
                <tr style="font-size:12px">
                    @for ($i = 1; $i < 31; $i++) <th>{{$i}}</th>
                        @endfor
                </tr>
            </thead>
            <tbody style="font-size: 12px">
                @foreach ($checklist as $d)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$d->kegiatan_ibadah}}</td>
                    @for ($i = 1; $i < 31; $i++) <td style="text-align: center; font-weight:bold">
                        @php
                        $tgl= "tgl_".$i;
                        $check = $d->$tgl;
                        if(!empty($check)){
                        echo "✓";
                        }
                        @endphp
                        </td>
                        @endfor
                </tr>
                @endforeach
            </tbody>
        </table>


    </section>
</body>

</html>
