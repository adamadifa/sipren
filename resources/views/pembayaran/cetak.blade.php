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
                                        <h5 style="margin: 0;" align="left">LAPORAN PENERIMAAN PEMBAYARAN </h5>
                                        <h5 style="margin: 0;" align="left">PESANTREN NURUL IMAN</h5>
                                        <h5 style="margin: 0;" align="left">PERIODE {{ date('d-m-Y', strtotime($dari)) }}
                                            s/d {{ date('d-m-Y', strtotime($sampai)) }}</h5>
                                        @if (!empty($jb))
                                            <h5 style="margin: 0;" align="left">JENIS BIAYA : {{ $jb }}</h5>
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="datatable3" style="margin-top:20px;">
            <thead style="font-size:16px">
                <tr>
                    <th>No</th>
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Jenjang</th>
                    <th>Ket</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody style="font-size: 14px; text-align:center">
                @php
                    $total = 0;
                @endphp
                @foreach ($historibayar as $d)
                    @php
                        $total = $total += $d->jumlah_bayar;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->no_transaksi }}</td>
                        <td>{{ $d->tgl_transaksi }}</td>
                        <td>{{ $d->nis }}</td>
                        <td style="text-align:left">{{ $d->nama_lengkap }}</td>
                        <td>{{ $d->jenjang }}</td>
                        <td style="text-align:left">
                            @if ($d->id_jenisbayar == '1' || $d->id_jenisbayar == '11')
                                @php
                                    $ta = $d->tahunakademik;
                                    $jenjangbiaya = $d->jenjangbiaya;
                                @endphp
                            @else
                                @php
                                    $ta = '';
                                    $jenjangbiaya = '';
                                @endphp
                            @endif

                            @if ($d->id_jenisbayar == '11')
                                @php
                                    $bulan = 'Bulan ' . $namabulan[$d->ket];
                                @endphp
                            @else
                                @php
                                    $bulan = '';
                                @endphp
                            @endif
                            {{ $d->jenisbayar }} {{ $jenjangbiaya }} {{ $bulan }} {{ $ta }}
                        </td>
                        <td style="text-align: right">
                            {{ number_format($d->jumlah_bayar, '0', '', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="7">TOTAL</th>
                    <th style="text-align: right">
                        {{ number_format($total, '0', '', '.') }}
                    </th>
                </tr>
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
