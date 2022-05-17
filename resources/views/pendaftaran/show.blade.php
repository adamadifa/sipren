@extends('layouts.tabler')
@section('page-pretitle','Detail Pendaftaran')
@section('page-title','Detail Pendaftaran')
@section('content')
<div class="row mt-3">
  @include('layouts.notification')
  <div class="col-md-3">
    <div class="card">
      <div class="card-body p-4 text-center">
        <span class="avatar avatar-xl mb-3 avatar-rounded">JL</span>
        <h3 class="m-0 mb-1"><a href="#">{{$pendaftaran->nama_lengkap}}</a></h3>
        <div class="text-muted">{{$pendaftaran->nisn}}</div>
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
        <a href="/pendaftaran/{{$pendaftaran->jenjang}}/{{$pendaftaran->no_pendaftaran}}/edit" class="card-btn"
          style="background-color: #ffb500; color:white ">
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
          <li class="nav-item">
            <a href="#tabs-pendaftaran-16" class="nav-link" data-bs-toggle="tab">
              <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                <line x1="9" y1="9" x2="10" y2="9" />
                <line x1="9" y1="13" x2="15" y2="13" />
                <line x1="9" y1="17" x2="15" y2="17" /></svg>
              Data Pendaftaran</a>
          </li>
        </ul>
        <div class="card-body">
          <div class="tab-content">

            <div class="tab-pane show active" id="tabs-profile-16">
              <table class="table table-striped">
                <tr>
                  <th style="width:30%">NISN</th>
                  <td>{{$pendaftaran->nisn}}</td>
                </tr>
                <tr>
                  <th>Nama Lengkap</th>
                  <td>{{strtoupper($pendaftaran->nama_lengkap)}}</td>
                </tr>
                <tr>
                  <th>Jenis Kelamin</th>
                  <td>{{strtoupper($pendaftaran->jenis_kelamin)}}</td>
                </tr>
                <tr>
                  <th>Tempat / Tanggal Lahir</th>
                  <td>{{strtoupper($pendaftaran->tempat_lahir)}} /
                    {{date('d-m-Y',strtotime($pendaftaran->tanggal_lahir))}}</td>
                </tr>
                <tr>
                  <th>Anak Ke</th>
                  <td>{{$pendaftaran->anak_ke}}</td>
                </tr>
                <tr>
                  <th>Jumlah Saudara</th>
                  <td>{{$pendaftaran->jml_saudara}}</td>
                </tr>

                <tr>
                  <th>Alamat</th>
                  <td>{{$pendaftaran->alamat}}</td>
                </tr>
                <tr>
                  <th>Propinsi</th>
                  <td>{{$pendaftaran->prov_name}}</td>
                </tr>
                <tr>
                  <th>Kota</th>
                  <td>{{$pendaftaran->regc_name}}</td>
                </tr>
                <tr>
                  <th>Kecamatan</th>
                  <td>{{$pendaftaran->dist_name}}</td>
                </tr>
                <tr>
                  <th>Kelurahan/Desa</th>
                  <td>{{$pendaftaran->vill_name}}</td>
                </tr>
                <tr>
                  <th>Kode Pos</th>
                  <td>{{$pendaftaran->kodepos}}</td>
                </tr>
              </table>
            </div>
            <div class="tab-pane" id="tabs-activity-16">
              <table class="table table-striped">
                <tr>
                  <th style="width:30%">No. KK</th>
                  <td>{{$pendaftaran->no_kk}}</td>
                </tr>
                <tr>
                  <th>NIK</th>
                  <td>{{strtoupper($pendaftaran->nik_ayah)}}</td>
                </tr>
                <tr>
                  <th>Nama Ayah</th>
                  <td>{{strtoupper($pendaftaran->nama_ayah)}}</td>
                </tr>
                <tr>
                  <th>Pendidikan</th>
                  <td>{{$pendaftaran->pendidikan_ayah}}</td>
                </tr>
                <tr>
                  <th>Pekerjaan</th>
                  <td>{{$pendaftaran->pekerjaan_ayah}}</td>
                </tr>
                <tr>
                  <th>NIK</th>
                  <td>{{strtoupper($pendaftaran->nik_ibu)}}</td>
                </tr>
                <tr>
                  <th>Nama Ibu</th>
                  <td>{{strtoupper($pendaftaran->nama_ibu)}}</td>
                </tr>
                <tr>
                  <th>Pendidikan</th>
                  <td>{{$pendaftaran->pendidikan_ibu}}</td>
                </tr>
                <tr>
                  <th>Pekerjaan</th>
                  <td>{{$pendaftaran->pekerjaan_ibu}}</td>
                </tr>
                <tr>
                  <th>No. HP</th>
                  <td>{{$pendaftaran->no_hp_ortu}}</td>
                </tr>
              </table>
            </div>
            <div class="tab-pane" id="tabs-pendaftaran-16">
              <table class="table table-striped">
                <tr>
                  <th style="width:30%">No. Pendaftaran</th>
                  <td>{{$pendaftaran->no_pendaftaran}}</td>
                </tr>
                <tr>
                  <th>Tanggal Pendaftaran</th>
                  <td>{{date('d-m-Y',strtotime($pendaftaran->tgl_pendaftaran))}}</td>
                </tr>
                <tr>
                  <th>NIS</th>
                  <td>{{$pendaftaran->nis}}</td>
                </tr>
                <tr>
                  <th>NPSN</th>
                  <td>{{$pendaftaran->npsn}}</td>
                </tr>
                <tr>
                  <th>Asal Sekolah</th>
                  <td>{{$pendaftaran->asal_sekolah}}</td>
                </tr>
                <tr>
                  <th>Nomor Peserta Ujian</th>
                  <td>{{$pendaftaran->nomor_peserta_ujian}}</td>
                </tr>
                <tr>
                  <th>No. Ijazah</th>
                  <td>{{$pendaftaran->no_ijazah}}</td>
                </tr>
                <tr>
                  <th>No. SHUN</th>
                  <td>{{$pendaftaran->no_shun}}</td>
                </tr>
                <tr>
                  <th>Rata Rata Nilai US</th>
                  <td>{{$pendaftaran->nilai_us}}</td>
                </tr>
                <tr>
                  <th>Tanggal Lulus</th>
                  <td>
                    @if (!empty($pendaftaran->tanggal_lulus))
                    {{date('d-m-Y',strtotime($pendaftaran->tanggal_lulus))}}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Tahun Angkatan</th>
                  <td>{{$pendaftaran->tahunakademik}}</td>
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