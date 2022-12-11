@extends('mobile.layouts.fimobile')
@section('content')
<!-- select Amount -->
<div class="row">
    <div class="col-12 text-center mb-4">
        <h1>{{ number_format($pembiayaan->jumlah + ($pembiayaan->jumlah * ($pembiayaan->persentase/100)),'0','','.') }}</h1>

    </div>
</div>
<!-- amount breakdown -->
<div class="row mb-3">
    <div class="col">
        <p class="text-color-theme">Pengajuan Pembiayaan</p>
    </div>
    <div class="col-auto text-end">
        <p class="text-muted">{{ number_format($pembiayaan->jumlah,'0','','.') }}</p>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <p class="text-color-theme">Jenis Pembiayaan</p>
    </div>
    <div class="col-auto text-end">
        <p class="text-muted">{{ $pembiayaan->nama_pembiayaan }}</p>
    </div>
</div>
<div class="row mb-4 ">
    <div class="col">
        <p class="text-color-theme">Bagi Hasil ({{ $pembiayaan->persentase }} %) </p>
    </div>
    <div class="col-auto text-end">
        <p class="text-muted">{{ number_format($pembiayaan->jumlah * ($pembiayaan->persentase/100)) }}</p>
    </div>
</div>
<div class="row mb-4 fw-medium">
    <div class="col">
        <p class="text-color-theme">Total Pembiayaan</p>
    </div>
    <div class="col-auto text-end">
        <p class="text-muted">{{ number_format($pembiayaan->jumlah + ($pembiayaan->jumlah * ($pembiayaan->persentase/100)),'0','','.') }}</p>
    </div>
</div>
<div class="row mb-4 fw-medium">
    <div class="col">
        <p class="text-color-theme">Pembayaran</p>
    </div>
    <div class="col-auto text-end">
        <p class="text-muted">{{ number_format($pembiayaan->jmlbayar,'0','','.') }}</p>
    </div>
</div>
<div class="row mb-4 fw-medium">
    <div class="col">
        <p class="text-color-theme">Sisa Tagihan</p>
    </div>
    <div class="col-auto text-end">
        <p class="text-muted">{{ number_format($pembiayaan->jumlah + ($pembiayaan->jumlah * ($pembiayaan->persentase/100) - $pembiayaan->jmlbayar),'0','','.') }}</p>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <p class="text-color-theme">Keperluan</p>
    </div>
    <div class="col-auto text-start">
        <p class="text-muted">{{ $pembiayaan->keperluan }}</p>
    </div>
</div>
<!-- Saving targets -->
<div class="row mb-3">
    <div class="col">
        <h6 class="title">Histori Pembayaran</h6>
    </div>
    <div class="col-auto">
        <a href="" class="small"></a>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <table class="table" style="font-size: 14px">
            <thead>
                <tr class="text-color-theme">
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody class="text-muted">
                @foreach ($historibayar as $d)
                <tr>
                    <td>{{ $d->no_transaksi }}</td>
                    <td>{{ date("d/m/y",strtotime($d->tgl_transaksi)) }}</td>
                    <td style=" text-align: right">{{ number_format($d->jumlah,'0','','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
