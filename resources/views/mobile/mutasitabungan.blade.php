@extends('mobile.layouts.fimobile')
@section('content')
<!-- select Amount -->
<div class="row">
    <div class="col-12 text-center mb-4">
        <h1>{{ number_format($tabungan->saldo,'0','','.') }}</h1>

    </div>
</div>
<!-- amount breakdown -->
<div class="row mb-3">
    <div class="col">
        <p class="text-color-theme">No Rekening</p>
    </div>
    <div class="col-auto text-end">
        <p class="text-muted">{{ $tabungan->no_rekening }}</p>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <p class="text-color-theme">Jenis Tabungan</p>
    </div>
    <div class="col-auto text-end">
        <p class="text-muted">{{ $tabungan->nama_tabungan }}</p>
    </div>
</div>

<!-- Saving targets -->
<div class="row mb-3">
    <div class="col">
        <h6 class="title">Mutasi Tabungan</h6>
    </div>
    <div class="col-auto">
        <a href="" class="small"></a>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        {{-- <table class="table" style="font-size: 14px">
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
        </table> --}}

    </div>
</div>
@endsection
