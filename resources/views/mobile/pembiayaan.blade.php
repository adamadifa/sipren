@extends('mobile.layouts.fimobile')
@section('content')
    <div class="row mb-4">
        <div class="col-12 ">
            <a href="/mobile/ajukanpembiayaan" class="btn btn-default btn-lg shadow-sm w-100">
                Ajukan Pembiayaan
            </a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 px-0">
            <ul class="list-group list-group-flush bg-none">
                @foreach ($pembiayaan as $d)
                    @php
                        $sisa = $d->jumlah + $d->jumlah * ($d->persentase / 100) - $d->jmlbayar;
                        if ($sisa > 0) {
                            $ket = 'Belum Lunas';
                        } else {
                            $ket = 'Lunas';
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
                                    <p class="text-color-theme mb-0" style="font-size:15px">{{ $d->no_akad }}
                                    </p>
                                    <p class="text-muted size-12">{{ $d->nama_pembiayaan }} <span
                                            class="{{ $sisa > 0 ? 'text-danger' : 'text-success' }}">({{ $ket }})</span>
                                    </p>
                                </div>
                                <div class="col align-self-center text-end">
                                    <p class="mb-0 text-success" style="font-weight: bold">
                                        {{ number_format($d->jumlah + $d->jumlah * ($d->persentase / 100), '0', '', '.') }}
                                    </p>
                                    <p class="mb-0 text-muted size-12">{{ $d->jangka_waktu }} Angsuran</p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
