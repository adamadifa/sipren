<link rel="stylesheet" href="{{ asset('assets/mycss/table.css') }}">
<div class="page">
    <div class="subpage">
        <table border="0" width="100%" style="text-align: left;">
            <thead>
                <tr>
                    <th align="center" width="13%">
                        <img src="{{ asset('klorofil/img/logoaja.png') }}" alt=""
                            style="width:auto; height:auto; max-width:100px; max-height:100px; display:block;">
                    </th>
                    <th>
                        <table border="0">
                            <thead>
                                <tr>
                                    <th>
                                        <h5 style="margin: 0;" align="left">LAPORAN PRESENSI SISWA </h5>
                                        <h5 style="margin: 0;" align="left">PESANTREN NURUL IMAN</h5>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </th>
                </tr>
            </thead>
        </table>
        <br>
        <br>
        <div style="display: flex; gap: 10px">
            <div>
                <table class="datatable">
                    <tr>
                        <th>Kode Jadwal</th>
                        <td>{{ $jadwal->kode_jadwal }}</td>
                    </tr>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <td>{{ $jadwal->nama_matpel }}</td>
                    </tr>
                    <tr>
                        <th>Guru</th>
                        <td>{{ $jadwal->nama_guru }}</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>{{ $jadwal->nama_kelas }}</td>
                    </tr>
                </table>
            </div>
            <div>
                <table class="datatable">
                    <tr>
                        <th>Hari</th>
                        <td>{{ $jadwal->hari }}</td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td>{{ $jadwal->jam_mulai }} s/d {{ $jadwal->jam_selesai }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Ajaran</th>
                        <td>{{ $jadwal->tahunakademik }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="margin-top: 10px">
            <table class="datatable3">
                <thead>
                    <tr>
                        <th rowspan="3">No</th>
                        <th rowspan="3">NIS</th>
                        <th rowspan="3">Nama Siswa</th>
                        <th colspan="{{ count($presensi) }}">Pertemuan</th>
                        <th colspan="4">Total</th>
                    </tr>
                    <tr>
                        @php
                            $pt = 1;
                        @endphp
                        @foreach ($presensi as $d)
                            <th>{{ $pt }}</th>
                            @php
                                $pt++;
                            @endphp
                        @endforeach
                        <th>H</th>
                        <th>I</th>
                        <th>S</th>
                        <th>A</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presensikelas as $d)
                        <tr>
                            <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                            <td style="vertical-align: middle">{{ $d['nis'] }}</td>
                            <td style="vertical-align: middle">{{ $d['nama_lengkap'] }}</td>
                            @php
                                $total_hadir = 0;
                                $total_izin = 0;
                                $total_sakit = 0;
                                $total_alpa = 0;
                            @endphp
                            @foreach ($presensi as $p)
                                @if ($d[$p->tanggal]['status'] == 'H')
                                    @php
                                        $total_hadir++;
                                        $color = '';
                                    @endphp
                                @elseif ($d[$p->tanggal]['status'] == 'I')
                                    @php
                                        $total_izin++;
                                        $color = '#0b6daa';
                                    @endphp
                                @elseif ($d[$p->tanggal]['status'] == 'S')
                                    @php
                                        $total_sakit++;
                                        $color = '#ba0b77';
                                    @endphp
                                @elseif ($d[$p->tanggal]['status'] == 'A')
                                    @php
                                        $total_alpa++;
                                        $color = '#ff0000';
                                    @endphp
                                @endif
                                <td
                                    style="text-align: center; vertical-align: middle; background-color: {{ $color }}; color:{{ $d[$p->tanggal]['status'] != 'H' ? 'white' : '#000' }}">
                                    {{ $d[$p->tanggal]['status'] }}</td>
                            @endforeach
                            <td style="text-align: center; vertical-align: middle">{{ $total_hadir }}</td>
                            <td style="text-align: center; vertical-align: middle">{{ $total_izin }}</td>
                            <td style="text-align: center; vertical-align: middle">{{ $total_sakit }}</td>
                            <td style="text-align: center; vertical-align: middle">{{ $total_alpa }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Tanggal</th>
                        @foreach ($presensi as $i)
                            <th>{{ date('d', strtotime($i->tanggal)) }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th colspan="3">Bulan</th>
                        @foreach ($presensi as $i)
                            <th>{{ date('m', strtotime($i->tanggal)) }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th colspan="3">Tahun</th>
                        @foreach ($presensi as $i)
                            <th>{{ date('y', strtotime($i->tanggal)) }}</th>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
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
        width: 297mm;
        min-height: 210mm;
        padding: 1mm;
        margin: 0mm auto;
        background: white;
    }

    .subpage {
        margin-left: 5mm;
        margin-right: 5mm;
        margin-top: 5mm;
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
