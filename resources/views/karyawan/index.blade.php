@extends('layouts.tabler')
@section('title','Data Karyawan')
@section('page-pretitle','Data Karyawan')
@section('page-title','Data Karyawan')
@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <form action="/karyawan/cari" method="GET">
                    <div class="input-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="10" cy="10" r="7" />
                                    <line x1="21" y1="21" x2="15" y2="15" /></svg>
                            </span>
                            <input type="text" class="form-control" value="{{ Request::get('cari') }}"
                                placeholder="Pencarian Data" name="cari">
                        </div>
                        <button type="submit" class="btn btn-success">Cari Data</button>
                    </div>
                </form>
            </div>
            <div>
                <a href="/karyawan/create" class="btn btn-primary d-none d-sm-inline-block mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Tambah Data
                </a>
            </div>

        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-important alert-success alert-dismissible" role="alert">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 12l5 5l10 -10" />
                        <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                </div>
                <div>
                    {{ $message }}
                </div>
            </div>
            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
        </div>

        @endif
        @if ($message = Session::get('failed'))
        <div class="alert alert-important alert-danger alert-dismissible" role="alert">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 12l5 5l10 -10" />
                        <path d="M2 12l5 5m5 -5l5 -5" /></svg>
                </div>
                <div>
                    {{ $message }}
                </div>
            </div>
            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
        </div>

        @endif
        <div class="table-responsive">
            <table class="table table-boredered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>NPP</th>
                        <th>Nama Lengkap</th>
                        <th>TTL</th>
                        <th>Status</th>
                        <th>Masa Kerja</th>
                        <th>No HP</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datakaryawan as $d)
                    <tr>
                        <td>{{ $loop->iteration + $datakaryawan->firstItem() - 1 }}</td>
                        <td>{{$d->npp}}</td>
                        <td>{{strtoupper($d->nama_lengkap)}}</td>
                        <td>{{$d->tempat_lahir." / ".date('d-m-Y', strtotime($d->tanggal_lahir))}}</td>
                        <td>{{$d->status_kepegawaian}}</td>
                        <td>
                            {{\Carbon\Carbon::parse($d->tmt)->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan and %d Hari')}}
                        </td>
                        <td>{{$d->no_hp}}</td>
                        <td>
                            <div class="grid-container2">
                                <div class="grid-item">
                                    <a href="/karyawan/{{$d->npp}}/edit" class="btn btn-sm btn-primary"><i
                                            class="fa fa-pencil"></i></a>
                                    <a href="/karyawan/{{$d->npp}}" class="btn btn-sm btn-info"><i
                                            class="fa fa-list"></i></a>
                                    <a href="/karyawan/{{$d->npp}}/detailabsensi" class="btn btn-sm btn-warning"><i
                                            class="fa fa-file-text"></i></a>
                                </div>
                                <div class="grid-item">
                                    <form action="/karyawan/{{$d->npp}}/delete" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                </div>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4" style="float:right">{{$datakaryawan->links()}}</div>
        </div>
    </div>
</div>
@endsection
