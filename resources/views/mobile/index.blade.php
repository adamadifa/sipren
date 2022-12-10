@extends('mobile.layouts.fimobile')
@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-auto">
                <figure class="avatar avatar-44 rounded-10">
                    <img src="{{ asset('foto/nophoto.png') }}" alt="">
                </figure>
            </div>
            <div class="col px-0 align-self-center">
                <p class="mb-0 text-color-theme">{{ Auth::user()->nama_lengkap }}</p>
                <p class="text-muted size-12">{{ Auth::user()->npp }}</p>
            </div>
            <div class="col-auto">
                <a href="addmoney.html" class="btn btn-44 btn-light shadow-sm">
                    <i class="bi bi-plus-circle"></i>
                </a>
                <a href="withdraw.html" class="btn btn-44 btn-default shadow-sm ms-1">
                    <i class="bi bi-arrow-down-circle"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card theme-bg text-white border-0 text-center">
        <div class="card-body">
            <h1 class="display-1 my-2">{{$saldo == null ? 0 : number_format($saldo->saldo,'0','','.') }}</h1>
            <p class="text-muted mb-2">Saldo Simpanan Koperasi</p>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-12 px-0">
        <div class="swiper-container cardswiper swiper-container-initialized swiper-container-horizontal swiper-container-ios">
            <div class="swiper-wrapper" id="swiper-wrapper-e7c52537e6cf4732" aria-live="polite" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 3">
                    <div class="card dark-bg">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-auto align-self-center">
                                    <img src="{{ asset('assets-mobile/img/masterocard.png') }}" alt="">
                                </div>
                                <div class=" col align-self-center text-end">
                                    <p class="small">
                                        <span class="text-uppercase size-10">Validity</span><br>
                                        <span class="text-muted">Unlimited</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="fw-normal mb-2">
                                        {{ $simpananpokok == null ? 0 :number_format($simpananpokok->saldo,'0','','.') }}
                                        <span class="small text-muted">RP</span>
                                    </h4>
                                    <p class="mb-0 text-muted size-12">{{ $simpananpokok == null ? '' :$simpananpokok->no_anggota }}</p>
                                    <p class="text-muted size-12">Simpanan Pokok</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 3">
                    <div class="card theme-radial-gradient border-0">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-auto align-self-center">
                                    <i class="bi bi-wallet2"></i> Wallet
                                </div>
                                <div class="col align-self-center text-end">
                                    <p class="small">
                                        <span class="text-uppercase size-10">Validity</span><br>
                                        <span class="text-muted">Unlimited</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="fw-normal mb-2">
                                        {{ $simpananwajib== null ? 0 : number_format($simpananwajib->saldo,'0','','.') }}
                                        <span class="small text-muted">RP</span>
                                    </h4>
                                    <p class="mb-0 text-muted size-12">{{ $simpananwajib== null ? '' : $simpananwajib->no_anggota }}4</p>
                                    <p class="text-muted size-12">Simpanan Wajib</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide" role="group" aria-label="3 / 3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-auto align-self-center">
                                    <img src="{{ asset('assets-mobile/img/masterocard.png') }}" alt="">
                                </div>
                                <div class=" col align-self-center text-end">
                                    <p class="small">
                                        <span class="text-uppercase size-10">Validity</span><br>
                                        <span class="text-muted">Unlimited</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="fw-normal mb-2">
                                        {{ $simsuk == null ? 0 : number_format($simsuk->saldo,'0','','.') }}
                                        <span class="small text-muted">RP</span>
                                    </h4>
                                    <p class="mb-0 text-muted size-12">{{$simsuk == null ? '' : $simsuk->no_anggota }}</p>
                                    <p class="text-muted size-12">Simpanan Sukarela</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-6 col-md-4">
        <div class="card shadow-sm mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto px-0">
                        <div class="avatar avatar-40 bg-success text-white shadow-sm rounded-10-end">
                            <i class="bi bi-camera"></i>
                        </div>
                    </div>
                    <div class="col">
                        <p class="text-muted size-12 mb-0">Absen Masuk</p>
                        @if ($presensihariini != null)
                        <p>{{ $presensihariini->time_in }}</p>
                        @else
                        <p class="text-danger size-12">Belum Absen</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card shadow-sm mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto px-0">
                        <div class="avatar avatar-40 bg-danger text-white shadow-sm rounded-10-end">
                            <i class="bi bi-camera"></i>
                        </div>
                    </div>
                    <div class="col">
                        <p class="text-muted size-12 mb-0">Absen Pulang</p>
                        @if ($presensihariini != null)
                        @if ($presensihariini->time_out != "00:00:00")
                        <p>{{ $presensihariini->time_out }}</p>
                        @else
                        <p class="text-danger size-12">Belum Absen</p>
                        @endif
                        @else
                        <p class="text-danger size-12">Belum Absen</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<ul class="nav nav-pills nav-justified tabs mb-3" id="assetstabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#cards" type="button" role="tab" aria-controls="cards" aria-selected="true">Presensi</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="currency-tab" data-bs-toggle="tab" data-bs-target="#currency" type="button" role="tab" aria-controls="currency" aria-selected="false">Pembiayaan</button>
    </li>
</ul>
<div class="tab-content" id="assetstabsContent">
    <div class="tab-pane fade active show" id="cards" role="tabpanel">
        <!-- swiper credit cards -->
        <!-- Transactions -->
        <div class="row mb-3 mt-2">
            <div class="col">
                <h6 class="title">History Presensi Bulan Ini</h6>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12 px-0">
                <ul class="list-group list-group-flush bg-none">
                    @foreach ($presensi as $d)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <div class="avatar avatar-50 shadow rounded-10 bg-success text-white">
                                    <i class="bi bi-geo"></i>
                                </div>
                            </div>
                            <div class="col align-self-center ps-0">
                                <p class="text-color-theme mb-0" style="font-size:15px">{{ Gethari($d->presence_date) }}</p>
                                <p class="text-muted size-12">{{ DateToIndo2($d->presence_date) }}</p>
                            </div>
                            <div class="col align-self-center text-end">
                                <p class="mb-0 text-success" style="font-weight: bold">{{$d->time_in }}</p>
                                <p class="mb-0 text-danger" style="font-weight: bold">{{$d->time_out }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
    <div class="tab-pane fade" id="currency" role="tabpanel" aria-labelledby="currency-tab">
        <!-- Transactions -->
        <div class="row mb-3 mt-2">
            <div class="col">
                <h6 class="title">History Pembiayaan</h6>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12 px-0">
                <ul class="list-group list-group-flush bg-none">
                    @foreach ($pembiayaan as $d)
                    @php
                    $sisa = ($d->jumlah + ($d->jumlah * ($d->persentase / 100))) - $d->jmlbayar;
                    if($sisa > 0){
                    $ket = "Belum Lunas";
                    }else{
                    $ket ="Lunas";
                    }
                    @endphp
                    <li class="list-group-item">
                        <a href="/mobile/{{ Crypt::encrypt($d->no_akad) }}/showpembiayaan">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-50 shadow rounded-10 bg-danger text-white">
                                        <i class="bi bi-book"></i>
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="text-color-theme mb-0" style="font-size:15px">{{ $d->no_akad }}</p>
                                    <p class="text-muted size-12">{{ $d->nama_pembiayaan }} <span class="{{ $sisa > 0 ? 'text-danger' : 'text-success' }}">({{ $ket }})</span></p>
                                </div>
                                <div class="col align-self-center text-end">
                                    <p class="mb-0 text-success" style="font-weight: bold">{{number_format($d->jumlah + ($d->jumlah * ($d->persentase / 100)),'0','','.') }}</p>
                                    <p class="mb-0 text-muted size-12">{{$d->jangka_waktu }} Angsuran</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection
