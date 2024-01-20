@extends('mobile.layouts.fimobile')
@section('content')
    @if ($step == 1)
        <form action="/mobile/ajukanpembiayaan/1/store" method="POST">
            @csrf
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="no_anggota" placeholder="No. Anggota"
                    readonly value="{{ $anggota->no_anggota }}">
                <label for="floatingInput">No. Anggota</label>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="nik" placeholder="Nik"
                    value="{{ $anggota->nik }}">
                <label for="floatingInput">Nomor Identitas</label>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="nama_lengkap" placeholder="Nama Lengkap"
                    value="{{ $anggota->nama_lengkap }}">
                <label for="floatingInput">Nama Lengkap</label>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="tempat_lahir" placeholder="Tempat Lahir"
                    value="{{ $anggota->tempat_lahir }}">
                <label for="floatingInput">Tempat Lahir</label>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="tanggal_lahir"
                    placeholder="Tanggal Lahir" value="{{ $anggota->tanggal_lahir }}">
                <label for="floatingInput">Tanggal Lahir</label>
            </div>
            <div class="form-group mb-1">
                <select class="form-select form-select-lg" name="jenis_kelamin" aria-label=".form-select-lg example">
                    <option value="">Jenis Kelamin</option>
                    <option value="L" {{ $anggota->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                    <option value="P" {{ $anggota->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="form-group mb-1">
                <select class="form-select form-select-lg" name="pendidikan_terakhir" aria-label=".form-select-lg example">
                    <option value="">Pendidikan Terakhir</option>
                    <option value="SD" {{ $anggota->pendidikan_terakhir == 'SD' ? 'selected' : '' }}>
                        SD
                    </option>
                    <option value="SMP" {{ $anggota->pendidikan_terakhir == 'SMP' ? 'selected' : '' }}>
                        SMP
                    </option>
                    <option value="SMA" {{ $anggota->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>
                        SMA
                    </option>
                    <option value="D3" {{ $anggota->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>
                        D3
                    </option>
                    <option value="S1" {{ $anggota->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>
                        S1
                    </option>
                    <option value="S2" {{ $anggota->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>
                        S2
                    </option>
                </select>
            </div>
            <div class="row mb-4">
                <div class="col-12 ">
                    <button type="submit" class="btn btn-default btn-lg shadow-sm w-100">
                        Next
                    </button>
                </div>
            </div>
        </form>
    @elseif ($step == 2)
        <form action="/mobile/ajukanpembiayaan/2/store" method="POST">
            @csrf
            <input type="hidden" name="no_anggota" value="{{ $anggota->no_anggota }}">
            <div class="form-group mb-1">
                <select class="form-select form-select-lg" name="status_perkawinan" aria-label=".form-select-lg example">
                    <option value="">Status Perkawinan</option>
                    <option value="M" {{ $anggota->status_pernikahan == 'M' ? 'selected' : '' }}>
                        Menikah
                    </option>
                    <option value="BM" {{ $anggota->status_pernikahan == 'BM' ? 'selected' : '' }}>
                        Belum
                        Menikah
                    </option>
                    <option value="JD" {{ $anggota->status_pernikahan == 'JD' ? 'selected' : '' }}>
                        Janda/Duda
                    </option>
                </select>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="jml_tanggungan"
                    placeholder="Jumlah Tanggungan" value="{{ $anggota->jml_tanggungan }}">
                <label for="floatingInput">Jumlah Tanggungan</label>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="nama_pasangan"
                    placeholder="Nama Pasangan" value="{{ $anggota->nama_pasangan }}">
                <label for="floatingInput">Nama Pasangan</label>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="pekerjaan_pasangan"
                    placeholder="Pekerjaan Pasangan" value="{{ $anggota->pekerjaan_pasangan }}">
                <label for="floatingInput">Pekerjaan Pasangan</label>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="nama_ibu"
                    placeholder="Nama Ibu Kandung" value="{{ $anggota->nama_ibu }}">
                <label for="floatingInput">Nama Ibu Kandung</label>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="nama_saudara"
                    placeholder="Nama Saudara Tidak Serumah" value="{{ $anggota->nama_saudara }}">
                <label for="floatingInput">Nama Saudara Tidak Serumah</label>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="no_hp" placeholder="No. HP"
                    value="{{ $anggota->no_hp }}">
                <label for="floatingInput">No. HP</label>
            </div>
            <div class="row mb-4">
                <div class="col-6 ">
                    <a href="/mobile/ajukanpembiayaan/1" class="btn btn-default btn-lg shadow-sm w-100">
                        Back
                    </a>
                </div>
                <div class="col-6 ">
                    <button type="submit" class="btn btn-default btn-lg shadow-sm w-100">
                        Next
                    </button>
                </div>
            </div>
        </form>
    @elseif ($step == 3)
        <form action="/mobile/ajukanpembiayaan/3/store" method="POST">
            @csrf
            <input type="hidden" name="no_anggota" value="{{ $anggota->no_anggota }}">
            <div class="form-floating mb-1">
                <textarea type="text" class="form-control" id="floatingInput" name="alamat" placeholder="ALamat">{{ $anggota->alamat }}</textarea>
                <label for="floatingInput">Alamat</label>
            </div>
            <div class="form-group mb-1">
                <select name="id_propinsi" id="id_propinsi" class="form-select form-select-lg">
                    <option value="">Propinsi</option>
                    @foreach ($propinsi as $p)
                        <option {{ $anggota->id_propinsi == $p->id ? 'selected' : '' }} value="{{ $p->id }}">
                            {{ $p->prov_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-1">
                <select name="id_kota" id="id_kota" class="form-select form-select-lg">
                    <option value="">Kabupaten/Kota</option>
                </select>
            </div>

            <div class="form-group mb-1">
                <select name="id_kecamatan" id="id_kecamatan" class="form-select form-select-lg">
                    <option value="">Kecamatan</option>
                </select>
            </div>
            <div class="form-group mb-1">
                <select name="id_kelurahan" id="id_kelurahan" class="form-select form-select-lg">
                    <option value="">Kelurahan</option>
                </select>
            </div>
            <div class="form-floating mb-1">
                <input type="text" class="form-control" id="floatingInput" name="kode_pos" placeholder="Kode Pos"
                    value="{{ $anggota->kode_pos }}">
                <label for="floatingInput">Kode Pos</label>
            </div>
            <div class="row mb-4">
                <div class="col-6 ">
                    <a href="/mobile/ajukanpembiayaan/2" class="btn btn-default btn-lg shadow-sm w-100">
                        Back
                    </a>
                </div>
                <div class="col-6 ">
                    <button type="submit" class="btn btn-default btn-lg shadow-sm w-100">
                        Next
                    </button>
                </div>
            </div>
        </form>
    @endif
@endsection
@push('myscript')
    <script>
        $(function() {

            function loadkota() {
                var id_propinsi = $("#id_propinsi").val();
                var id_kota = "{{ $anggota->id_kota }}";
                //alert(id_kota);
                $.ajax({
                    type: 'POST',
                    url: '/kota/getkota',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_propinsi: id_propinsi,
                        id_kota: id_kota
                    },
                    cache: false,
                    success: function(respond) {
                        $("#id_kota").html(respond);
                    }
                });
            }

            $("#id_propinsi").change(function() {
                loadkota();
            });

            function loadkecamatan() {
                var kota = $("#id_kota").val();
                var id_kota = "";
                if (kota == "") {
                    id_kota = "{{ $anggota->id_kota }}";
                } else {
                    id_kota = kota
                }
                var id_kecamatan = "{{ $anggota->id_kecamatan }}";
                //alert(id_kota);
                $.ajax({
                    type: 'POST',
                    url: '/kecamatan/getkecamatan',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_kota: id_kota,
                        id_kecamatan: id_kecamatan
                    },
                    cache: false,
                    success: function(respond) {
                        $("#id_kecamatan").html(respond);
                    }
                });
            }

            function loadkelurahan() {
                var kecamatan = $("#id_kecamatan").val();
                var id_kecamatan = "";
                if (kecamatan == "") {
                    id_kecamatan = "{{ $anggota->id_kecamatan }}";
                } else {
                    id_kecamatan = kecamatan;
                }

                var id_kelurahan = "{{ $anggota->id_kelurahan }}";
                $.ajax({
                    type: 'POST',
                    url: '/kelurahan/getkelurahan',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_kecamatan: id_kecamatan,
                        id_kelurahan: id_kelurahan
                    },
                    cache: false,
                    success: function(respond) {
                        $("#id_kelurahan").html(respond);
                    }
                });
            }

            $("#id_kota").change(function() {
                loadkecamatan();
            });
            loadkota();
            loadkecamatan();
            loadkelurahan();
            $("#id_kecamatan").change(function() {
                loadkelurahan();
            });
        });
    </script>
@endpush
