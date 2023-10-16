@extends('layouts.tabler')
@section('title')
Data Pendaftarans {{$jenjang}}
@endsection
@section('page-pretitle')
Data Pendaftaran {{$jenjang}}
@endsection
@section('page-title')
Data Pendaftaran {{$jenjang}}
@endsection
@section('content')
<div class="card mt-2">
    <div class="card-body">

        <form action="/pendaftaran/{{$jenjang}}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="form-label">Tahun Akademik</label>
                    <div class="form-group">
                        <select name="tahunakademik" class="form-select" id="">
                            @foreach ($tahunakademik as $t)
                            <option @if (!empty(Request::get('tahunakademik'))) @if($t['tahunakademik']==Request::get('tahunakademik')) selected @endif @else @if($ta['tahunakademik']==$t['tahunakademik']) selected @endif @endif value="{{$t['tahunakademik']}}">
                                {{$t->tahunakademik}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">NIS</label>
                    <div class="form-group">
                        <input type="text" name="nis" class="form-control" placeholder="NIS" value="{{Request::get('nis')}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label">Nama Lengkap</label>
                    <div class="form-group">
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="{{Request::get('nama_lengkap')}}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="" class="form-label" style="color:transparent">Cari Data</label>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="search" value="search" style="background: #ffb500">
                            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" /></svg>
                            Cari Data
                        </button>
                    </div>
                </div>
            </div>

        </form>



    </div>
    @include('layouts.notification')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>No. Registrasi</th>
                            <th>NISN</th>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaran as $p)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><b>{{$p->no_pendaftaran}}</b></td>
                            <td>{{$p->nisn}}</td>
                            <td>{{$p->nis}}</td>
                            <td>{{$p->nama_lengkap}}</td>
                            <td>{{$p->jenis_kelamin}}</td>
                            <td>{{!empty($p->tanggal_lahir) ? date('d-m-Y',strtotime($p->tanggal_lahir)) : ''}}</td>
                            <td>
                                <div class="grid-container">
                                    <div class="grid-item">
                                        <a href="/pendaftaran/{{$jenjang}}/{{$p->no_pendaftaran}}/edit" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="/pendaftaran/{{$jenjang}}/{{$p->no_pendaftaran}}/show" class="btn btn-sm btn-info"><i class="fa fa-list"></i></a>
                                    </div>
                                    <div class="grid-item">
                                        <form action="/pendaftaran/{{$jenjang}}/{{$p->no_pendaftaran}}/delete" id="deleteform" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm delete-confirm"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="/pendaftaran/{{$jenjang}}/create" class="btn btn-primary d-none mt-4 d-sm-inline-block mb-3" style="background-color:#004c2d; color:white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" /></svg>
                    Tambah Data
                </a>
                <div class="mt-4" style="float:right">{{$pendaftaran->links()}}</div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('myscript')
<script>
    $(function() {
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Anda Yakin?'
                , text: 'Data ini akan didelete secara permanen!'
                , icon: 'warning'
                , buttons: ["Cancel", "Yes!"]
            , }).then(function(value) {
                if (value) {
                    $("#deleteform").submit();
                }
            });
        });
    });

</script>
@endpush
