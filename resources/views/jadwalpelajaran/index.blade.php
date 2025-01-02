@extends('layouts.tabler')
@section('title', 'Jadwal Pelajaran')
@section('page-pretitle', 'Jadwal Pelajaran')
@section('page-title', 'Jadwal Pelajaran')
@section('content')
    <style>
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 35px !important;
            user-select: none;
            -webkit-user-select: none
        }
    </style>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
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
                    <a href="/jadwalpelajaran/create" class="btn btn-primary d-none d-sm-inline-block mb-3" id="tambahjadwal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Tambah Jadwal
                    </a>
                    <form action="#" method="GET">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="form-label">Tahun Akademik</label>
                                <div class="form-group">
                                    <select name="tahunakademik" id="tahunakademik" class="form-select">
                                        @foreach ($takademik as $t)
                                            <option
                                                @if (!empty(Request('tahunakademik'))) @if ($t['tahunakademik'] == Request('tahunakademik'))
                                                        selected @endif
                                            @else @if ($ta_aktif['tahunakademik'] == $t['tahunakademik']) selected @endif @endif
                                                value="{{ $t['tahunakademik'] }}">
                                                {{ $t['tahunakademik'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="form-label">Jenjang</label>
                                <div class="form-group">
                                    <select name="jenjang" id="jenjang" class="form-select">
                                        <option value="">Jenjang</option>
                                        @foreach ($jenjang as $d)
                                            <option @if (Request::get('jenjang') == $d->nama_unit) selected @endif value="{{ $d->nama_unit }}">{{ $d->nama_unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="form-label">Kelas</label>
                                <div class="form-group">
                                    <select name="kode_kelas" id="kode_kelas" class="form-select">
                                        <option value="">Kelas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="form-label">Guru</label>
                                <div class="form-group">
                                    <select name="kode_guru" id="kode_guru" class="form-select" style="width: 100%;">
                                        <option value="">Guru</option>
                                        @foreach ($guru as $d)
                                            <option value="{{ $d->kode_guru }}" {{ Request::get('kode_guru') == $d->kode_guru ? 'selected' : '' }}>
                                                {{ $d->nama_guru }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="form-label" style="color:transparent">Cari Data</label>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" name="search" value="search" style="background: #ffb500">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <circle cx="10" cy="10" r="7" />
                                            <line x1="21" y1="21" x2="15" y2="15" />
                                        </svg>
                                        Cari Data
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="table-responsive mt-3">
                        <table class="table table-boredered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Pelajaran</th>
                                    <th>Nama Guru</th>
                                    <th>Kelas</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Jenjang</th>
                                    <th>Semester</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $d)
                                    <tr>
                                        <td>{{ $d->kode_jadwal }}</td>
                                        <td>{{ $d->nama_matpel }}</td>
                                        <td>{{ $d->nama_guru }}</td>
                                        <td>{{ $d->nama_kelas }}</td>
                                        <td>{{ $d->hari }}</td>
                                        <td>{{ $d->jam_mulai }} s/d {{ $d->jam_selesai }}</td>
                                        <td>{{ $d->jenjang }}</td>
                                        <td>
                                            @if ($d->semester == 1)
                                                Ganjil
                                            @else
                                                Genap
                                            @endif
                                        </td>
                                        <td>{{ $d->tahunakademik }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/jadwalpelajaran/{{ $d->kode_jadwal }}/edit" class="btn btn-sm btn-primary mr-2"><i
                                                        class="fa fa-pencil"></i></a>
                                                <a href="/presensisiswa/{{ Crypt::encrypt($d->kode_jadwal) }}/create"
                                                    class="btn btn-sm btn-info mr-2"><i class="fa fa-list"></i></a>
                                                <a href="/presensisiswa/{{ Crypt::encrypt($d->kode_jadwal) }}/cetak"
                                                    class="btn btn-sm btn-success mr-2" target="_blank"><i class="fa fa-print"></i></a>
                                                <form action="/jadwalpelajaran/{{ Crypt::encrypt($d->kode_jadwal) }}/delete" method="post">
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

            function getkelas() {
                let tahunakademik = $("#tahunakademik").val();
                let jenjang = $("#jenjang").val();
                let kelas = "{{ Request::get('kode_kelas') }}";
                // alert(kelas);
                $.ajax({
                    url: "{{ route('getkelas') }}",
                    type: "GET",
                    data: {
                        tahunakademik: tahunakademik,
                        jenjang: jenjang
                    },
                    success: function(response) {
                        $("#kode_kelas").empty();
                        $("#kode_kelas").append(
                            '<option value="">Kelas</option>');
                        $.each(response, function(i, item) {
                            $("#kode_kelas").append(
                                '<option value="' + item
                                .kode_kelas + '" ' + (item.kode_kelas == kelas ? 'selected' : '') + '>' + item
                                .nama_kelas + '</option>');
                        });
                    }
                });
            }

            $("#tahunakademik, #jenjang").change(function() {
                getkelas();
            });

            // Tambahkan Select2 pada Guru dengan style bootstrap
            $('#kode_guru').select2({
                placeholder: 'Pilih Guru',
                allowClear: true,
                width: '100%',

            });

            getkelas();
        });
    </script>
@endpush
