@extends('layouts.tabler')
@section('page-pretitle','Detail Siswa')
@section('page-title','Detail Siswa')
@section('content')
<div class="row mt-3">
  @if ($message = Session::get('success'))
  <div class="alert alert-important alert-success alert-dismissible" role="alert">
    <div class="d-flex">
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
          stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
          stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
  <div class="col-md-3">
    <div class="card">
      <div class="card-body p-4 text-center">
        <span class="avatar avatar-xl mb-3 avatar-rounded">JL</span>
        <h3 class="m-0 mb-1"><a href="#">{{$siswa->nama_lengkap}}</a></h3>
        <div class="text-muted">{{$siswa->nisn}}</div>
        <div class="mt-3">
          <span class="badge bg-green-lt">Kelas 7</span>
        </div>
      </div>
      <div class="d-flex">
        <a href="#" class="card-btn" style="background-color:#09482f; color:white">
          <!-- Download SVG icon from http://tabler-icons.io/i/camera -->
          <svg xmlns='http://www.w3.org/2000/svg' class='icon me-2' width='24' height='24' viewBox='0 0 24 24'
            stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
            <path stroke='none' d='M0 0h24v24H0z' fill='none' />
            <path
              d='M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2' />
            <circle cx='12' cy='13' r='3' /></svg>
          Ganti Foto</a>
        <a href="/siswa/{{$siswa->id_siswa}}/edit" class="card-btn" style="background-color: #ffb500; color:white ">
          <!-- Download SVG icon from http://tabler-icons.io/i/phone -->
          <!-- Download SVG icon from http://tabler-icons.io/i/pencil -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
            <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
          Edit Data</a>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card-body">
      <div class="card">
        <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
          <li class="nav-item">
            <a href="#tabs-profile-16" class="nav-link active" data-bs-toggle="tab">
              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <circle cx="12" cy="7" r="4"></circle>
                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
              </svg>
              Profil Siswa</a>
          </li>
          <li class="nav-item">
            <a href="#tabs-activity-16" class="nav-link" data-bs-toggle="tab">
              <!-- Download SVG icon from http://tabler-icons.io/i/users -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <circle cx="9" cy="7" r="4" />
                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
              Data Orangtua</a>
          </li>

        </ul>
        <div class="card-body">
          <div class="tab-content">

            <div class="tab-pane show active" id="tabs-profile-16">
              <table class="table table-striped">
                <tr>
                  <td>NISN</td>
                  <td>{{$siswa->nisn}}</td>
                </tr>
                <tr>
                  <td>Nama Lengkap</td>
                  <td>{{strtoupper($siswa->nama_lengkap)}}</td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>{{strtoupper($siswa->jenis_kelamin)}}</td>
                </tr>
                <tr>
                  <td>Tempat / Tanggal Lahir</td>
                  <td>{{strtoupper($siswa->tempat_lahir)}} / {{date('d-m-Y',strtotime($siswa->tanggal_lahir))}}</td>
                </tr>
                <tr>
                  <td>Anak Ke</td>
                  <td>{{$siswa->anak_ke}}</td>
                </tr>
                <tr>
                  <td>Jumlah Saudara</td>
                  <td>{{$siswa->jml_saudara}}</td>
                </tr>

                <tr>
                  <td>Alamat</td>
                  <td>{{$siswa->alamat}}</td>
                </tr>
                <tr>
                  <td>Propinsi</td>
                  <td>{{$siswa->prov_name}}</td>
                </tr>
                <tr>
                  <td>Kota</td>
                  <td>{{$siswa->regc_name}}</td>
                </tr>
                <tr>
                  <td>Kecamatan</td>
                  <td>{{$siswa->dist_name}}</td>
                </tr>
                <tr>
                  <td>Kelurahan/Desa</td>
                  <td>{{$siswa->vill_name}}</td>
                </tr>
                <tr>
                  <td>Kode Pos</td>
                  <td>{{$siswa->kodepos}}</td>
                </tr>
              </table>
            </div>
            <div class="tab-pane" id="tabs-activity-16">
              <table class="table table-striped">
                <tr>
                  <td>No. KK</td>
                  <td>{{$siswa->no_kk}}</td>
                </tr>
                <tr>
                  <td>NIK</td>
                  <td>{{strtoupper($siswa->nik_ayah)}}</td>
                </tr>
                <tr>
                  <td>Nama Ayah</td>
                  <td>{{strtoupper($siswa->nama_ayah)}}</td>
                </tr>
                <tr>
                  <td>Pendidikan</td>
                  <td>{{$siswa->pendidikan_ayah}}</td>
                </tr>
                <tr>
                  <td>Pekerjaan</td>
                  <td>{{$siswa->pekerjaan_ayah}}</td>
                </tr>
                <tr>
                  <td>NIK</td>
                  <td>{{strtoupper($siswa->nik_ibu)}}</td>
                </tr>
                <tr>
                  <td>Nama Ibu</td>
                  <td>{{strtoupper($siswa->nama_ibu)}}</td>
                </tr>
                <tr>
                  <td>Pendidikan</td>
                  <td>{{$siswa->pendidikan_ibu}}</td>
                </tr>
                <tr>
                  <td>Pekerjaan</td>
                  <td>{{$siswa->pekerjaan_ibu}}</td>
                </tr>
                <tr>
                  <td>No. HP</td>
                  <td>{{$siswa->no_hp_ortu}}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection