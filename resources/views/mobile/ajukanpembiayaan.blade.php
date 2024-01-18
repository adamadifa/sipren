@extends('mobile.layouts.fimobile')
@section('content')
    <div class="form-floating mb-1">
        <input type="text" class="form-control" id="floatingInput" name="no_angota" placeholder="No. Anggota" readonly
            value="{{ $anggota->no_anggota }}">
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
        <input type="text" class="form-control" id="floatingInput" name="tanggal_lahir" placeholder="Tanggal Lahir"
            value="{{ $anggota->tanggal_lahir }}">
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
            <a href="/mobile/ajukanpembiayaan" class="btn btn-default btn-lg shadow-sm w-100">
                Next
            </a>
        </div>
    </div>
    {{-- <div class="form-group mb-1">
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
        <input type="text" class="form-control" id="floatingInput" name="tanggal_lahir" placeholder="Jumlah Tanggungan"
            value="{{ $anggota->jml_tanggungan }}">
        <label for="floatingInput">Jumlah Tanggungan</label>
    </div>
    <div class="form-floating mb-1">
        <input type="text" class="form-control" id="floatingInput" name="nama_pasangan" placeholder="Nama Pasangan"
            value="{{ $anggota->nama_pasangan }}">
        <label for="floatingInput">Nama Pasangan</label>
    </div>
    <div class="form-floating mb-1">
        <input type="text" class="form-control" id="floatingInput" name="pekerjaan_pasangan"
            placeholder="Pekerjaan Pasangan" value="{{ $anggota->pekerjaan_pasangan }}">
        <label for="floatingInput">Pekerjaan Pasangan</label>
    </div>
    <div class="form-floating mb-1">
        <input type="text" class="form-control" id="floatingInput" name="nama_ibu" placeholder="Nama Ibu"
            value="{{ $anggota->nama_ibu }}">
        <label for="floatingInput">Nama Ibu</label>
    </div> --}}
@endsection
