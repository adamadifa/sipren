@extends('layouts.tabler')
@section('title','Data Siswa')
@section('page-pretitle','Data Siswa')
@section('page-title','Data Siswa')
@section('content')
<div class="card mt-2">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <form action="/siswa/cari/" method="GET">
                    @csrf
                    <div class="input-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="10" cy="10" r="7" />
                                    <line x1="21" y1="21" x2="15" y2="15" /></svg>
                            </span>
                            <input type="text" class="form-control" value="{{ Request::get('cari') }}" placeholder="Pencarian Data" name="cari">
                        </div>
                        <button type="submit" class="btn btn-success" style="background: #ffb500; color:white;">Cari Data</button>
                    </div>
                </form>
            </div>
            <div>
                <a href="/siswa/create" class="btn btn-primary d-none d-sm-inline-block mb-3" style="background-color:#004c2d; color:white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Tambah Data
                </a>
            </div>

        </div>
        @include('layouts.notification')
        <div class="table-responsive">
            <table class="table table-boredered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>ID Siswa</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>PIN</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datasiswa as $s)
                    <tr>
                        <td>{{ $loop->iteration + $datasiswa->firstItem() - 1 }}</td>
                        <td>{{$s->id_siswa}}</td>
                        <td>{{$s->nisn}}</td>
                        <td>{{strtoupper($s->nama_lengkap)}}</td>
                        <td>{{date('d-m-Y',strtotime($s->tanggal_lahir))}}</td>
                        <td>{{$s->jenis_kelamin}}</td>
                        <td>{{$s->pin}}</td>
                        <td>
                            <div class="grid-container">
                                <div class="grid-item">
                                    <a href="/siswa/{{$s->id_siswa}}/edit" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a href="/siswa/{{$s->id_siswa}}/show" class="btn btn-sm btn-info"><i class="fa fa-list"></i></a>
                                </div>
                                <div class="grid-item">
                                    <form action="/siswa/{{$s->id_siswa}}/delete" method="post">
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
            <div class="mt-4" style="float:right">{{$datasiswa->links()}}</div>
        </div>
    </div>
</div>
@endsection
