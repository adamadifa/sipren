@extends('layouts.tabler')
@section('title', 'Data Mata Pelajaran')
@section('page-pretitle', 'Data Mata Pelajaran')
@section('page-title', 'Data Mata Pelajaran')
@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="card mt-2">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-important alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 12l5 5l10 -10" />
                                        <path d="M2 12l5 5m5 -5l5 -5" />
                                    </svg>
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
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 12l5 5l10 -10" />
                                        <path d="M2 12l5 5m5 -5l5 -5" />
                                    </svg>
                                </div>
                                <div>
                                    {{ $message }}
                                </div>
                            </div>
                            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    @endif
                    <a href="/matapelajaran/create" class="btn btn-primary d-none d-sm-inline-block mb-3" id="tambahguru">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Tambah Data
                    </a>
                    <div class="table-responsive mt-3">
                        <table class="table table-boredered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Kode</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matapelajaran as $d)
                                    <tr>
                                        <td>{{ $d->kode_matpel }}</td>
                                        <td>{{ $d->nama_matpel }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/matapelajaran/{{ Crypt::encrypt($d->kode_matpel) }}/edit" class="btn btn-sm btn-primary mr-1"><i
                                                        class="fa fa-edit"></i></a>
                                                </a>
                                                <form action="/matapelajaran/{{ Crypt::encrypt($d->kode_matpel) }}/delete" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm delete-confirm"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('myscript')
    <script>
        $(function() {
            $('.delete-confirm').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var name = $(this).data('name');
                swal({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    buttons: {
                        cancel: 'Batal',
                        confirm: 'Ya, hapus!'
                    },
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
