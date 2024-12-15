@extends('layouts.tabler')
@section('title', 'Presensi Siswa')
@section('page-pretitle', 'Presensi Siswa')
@section('page-title', 'Presensi Siswa')
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
                    <form action="{{ route('presensisiswa.store', Crypt::encrypt($jadwal->kode_jadwal)) }}" method="POST" id="formPresensi">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <tr>
                                        <th>Kode Jadwal</th>
                                        <td>{{ $jadwal->kode_jadwal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mata Pelajaran</th>
                                        <td>{{ $jadwal->nama_matpel }}</td>
                                    </tr>
                                    <tr>
                                        <th>Guru</th>
                                        <td>{{ $jadwal->nama_guru }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas</th>
                                        <td>{{ $jadwal->nama_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Semester</th>
                                        <td>{{ $jadwal->semester }} {{ $jadwal->semester == 1 ? '(Ganjil)' : '(Genap)' }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table">
                                    <tr>
                                        <th>Hari</th>
                                        <td>{{ $jadwal->hari }}</td>
                                    </tr>
                                    <tr>
                                        <th>Waktu</th>
                                        <td>{{ $jadwal->jam_mulai }} s/d {{ $jadwal->jam_selesai }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <td>{{ $jadwal->tahunakademik }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>
                                            <input type="text" name="tanggal" id="tanggal" value="{{ date(' Y-m-d') }}" placeholder="Tanggal"
                                                class="form-control" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa_kelas as $d)
                                            <td style="vertical-align: middle">{{ $loop->iteration }}</td>
                                            <td style="vertical-align: middle">{{ $d->nis }}</td>
                                            <td style="vertical-align: middle">{{ $d->nama_lengkap }}</td>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="no_pendaftaran[]" value="{{ $d->no_pendaftaran }}">
                                                    <select name="status[]" class="form-select p-1">
                                                        <option value="Hadir">Hadir</option>
                                                        <option value="Izin">Izin</option>
                                                        <option value="Sakit">Sakit</option>
                                                        <option value="Alpa">Alpa</option>
                                                    </select>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <textarea name="materi_pokok" id="materi_pokok" class="form-control" placeholder="Materi Pokok" cols="30" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button class="btn btn-primary w-100" type="submit" id="btnSimpan">
                                    <i class="fa fa-send mr-2"></i>
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('myscript')
    <script>
        $(function() {
            $('#formPresensi').submit(function(e) {
                let materi_pokok = $("textarea[name='materi_pokok']").val();
                if (materi_pokok == "") {
                    swal({
                        title: 'Oops',
                        text: 'Materi Pokok Harus diisi !',
                        icon: 'warning',
                        didClose: function() {
                            $("#materi_pokok").focus();
                        }
                    });
                    return false;
                } else {
                    return true;
                    $("#btnSimpan").attr("disabled", true);
                    $("#btnSimpan").html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

                }
            });
        });
    </script>
@endpush
