@extends('layouts.tabler')
@section('title', 'Set Kelas')
@section('page-pretitle', 'Set Kelas')
@section('page-title', 'Set Kelas')
@section('content')
    <form action="/kelas/store" method="post" id="formKelas">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <tr>
                                        <th>Kode</th>
                                        <td>{{ $kelas->kode_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelas</th>
                                        <td>{{ $kelas->nama_kelas }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenjang</th>
                                        <td>{{ $kelas->jenjang }}</th>
                                    </tr>
                                    <tr></tr>
                                    <th>Tingkat</th>
                                    <td>{{ $kelas->tingkat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <td>{{ $kelas->tahunakademik }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="#" class="btn btn-primary mb-3" id="tambahsiswa">
                                    <i class="fa fa-user-plus mr-1"></i> Tambah Siswa
                                </a>
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>No. Pendaftaran</th>
                                            <th>Nama Lengkap</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelassiswa as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->no_pendaftaran }}</td>
                                                <td>{{ $d->nama_lengkap }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <div class="modal fade" id="mdltambahsiswa">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="loadaddsiswa">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        $(function() {
            $("#tambahsiswa").click(function() {
                let jenjang = "{{ $kelas->jenjang }}";
                let tingkat = "{{ $kelas->tingkat }}";
                let tahunakademik = "{{ $kelas->tahunakademik }}";
                let kode_kelas = "{{ $kelas->kode_kelas }}";
                $.ajax({
                    type: 'POST',
                    url: '/kelas/addsiswa',
                    data: {
                        _token: "{{ csrf_token() }}",
                        jenjang: jenjang,
                        tingkat: tingkat,
                        tahunakademik: tahunakademik,
                        kode_kelas: kode_kelas
                    },
                    cache: false,
                    success: function(respond) {
                        $("#loadaddsiswa").html(respond);
                    }
                });

                $('#mdltambahsiswa').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#mdltambahsiswa').modal('show');
            });

            $(".close").click(function() {
                $('#mdltambahsiswa').modal('hide');
            });
        });
    </script>
@endpush
