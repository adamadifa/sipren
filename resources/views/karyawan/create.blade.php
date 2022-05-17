@extends('layouts.tabler')
@section('page-pretitle','Input Data Karyawan')
@section('page-title','Input Data Karyawan')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mt-2">
            <div class="card-body">
                <form action="/karyawan" method="post">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <x-inputtext label="NPP" placeholder="NPP" field="npp" icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2'
                  stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                  <path stroke='none' d='M0 0h24v24H0z' fill='none' />
                  <path d='M4 7v-1a2 2 0 0 1 2 -2h2' />
                  <path d='M4 17v1a2 2 0 0 0 2 2h2' />
                  <path d='M16 4h2a2 2 0 0 1 2 2v1' />
                  <path d='M16 20h2a2 2 0 0 0 2 -2v-1' />
                  <rect x='5' y='11' width='1' height='2' />
                  <line x1='10' y1='11' x2='10' y2='13' />
                  <rect x='14' y='11' width='1' height='2' />
                  <line x1='19' y1='11' x2='19' y2='13' /></svg>" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <x-inputtext label="Nama Lengkap" placeholder="Nama Lengkap" field="nama_lengkap"
                                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><circle cx='12' cy='7' r='4' /><path d='M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2' /></svg>" />
                        </div>
                        <div class="col-md-6">
                            <x-inputtext label="Nama Panggilan" placeholder="Nama Panggilan" field="nama_panggilan"
                                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><circle cx='12' cy='7' r='4' /><path d='M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2' /></svg>" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <x-inputjeniskelamin field="jenis_kelamin" label="Jenis Kelamin" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <x-inputtext label="Tempat Lahir" placeholder="Tempat Lahir" field="tempat_lahir"
                                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><polyline points='3 7 9 4 15 7 21 4 21 17 15 20 9 17 3 20 3 7' /><line x1='9' y1='4' x2='9' y2='17' /><line x1='15' y1='7' x2='15' y2='20' /></svg>" />
                        </div>
                        <div class="col-md-6">
                            <x-inputtext label="Tanggal Lahir" placeholder="Tanggal Lahir" field="tanggal_lahir"
                                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><rect x='4' y='5' width='16' height='16' rx='2' /><line x1='16' y1='3' x2='16' y2='7' /><line x1='8' y1='3' x2='8' y2='7' /><line x1='4' y1='11' x2='20' y2='11' /><rect x='8' y='15' width='2' height='2' /></svg>" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <x-inputtext label="No KTP" placeholder="No KTP" field="no_ktp"
                                icon="<svg xmlns='<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><rect x='3' y='5' width='18' height='14' rx='3' /><line x1='3' y1='10' x2='21' y2='10' /><line x1='7' y1='15' x2='7.01' y2='15' /><line x1='11' y1='15' x2='13' y2='15' /></svg>" />
                        </div>
                        <div class="col-md-6">
                            <x-inputtext label="No KK" placeholder="No KK" field="no_kk"
                                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><rect x='3' y='5' width='18' height='14' rx='3' /><line x1='3' y1='10' x2='21' y2='10' /><line x1='7' y1='15' x2='7.01' y2='15' /><line x1='11' y1='15' x2='13' y2='15' /></svg>" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <x-inputtext label="No HP" placeholder="No HP" field="no_hp"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /><path d="M15 7a2 2 0 0 1 2 2" /><path d="M15 3a6 6 0 0 1 6 6" /></svg>' />
                        </div>
                        <div class="col-md-6">
                            <x-inputtext label="Whatsapp" placeholder="Whatsapp" field="whatsapp"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1" /></svg>' />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <x-inputtext label="Instagram" placeholder="Instagram" field="instagram"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="4" /><circle cx="12" cy="12" r="3" /><line x1="16.5" y1="7.5" x2="16.5" y2="7.501" /></svg>' />
                        </div>
                        <div class="col-md-6">
                            <x-inputtext label="Facebook" placeholder="Facebook" field="facebook"
                                icon='<svg xmlns="<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>' />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="" class="form-label">Status</label>
                        <div class="col-md-12">
                            <div class="form-group @error('status') is-invalid @enderror">
                                <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                    <option value="">Status</option>
                                    <option {{old('status')=='M' ? 'selected':''}} value="M">Menikah</option>
                                    <option {{old('status')=='BM' ? 'selected':''}} value="BM">Belum Menikah</option>
                                </select>
                            </div>
                            @error('status') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="rom mb-2">
                        <x-inputtextarea label="Alamat Sesuai KTP" field="alamat_ktp" />
                    </div>
                    <div class="rom mb-2">
                        <x-inputtextarea label="Alamat Tempat Tinggal" field="alamat_tinggal" />
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <x-inputtext label="RT" placeholder="RT" field="rt"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 4 4 8 12 12 20 8 12 4" /><polyline points="4 12 12 16 20 12" /><polyline points="4 16 12 20 20 16" /></svg>' />
                        </div>
                        <div class="col-md-2">
                            <x-inputtext label="RW" placeholder="RW" field="rw"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 4 4 8 12 12 20 8 12 4" /><polyline points="4 12 12 16 20 12" /><polyline points="4 16 12 20 20 16" /></svg>' />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <label for="" class="form-label">Propinsi</label>
                            <div class="form-group  @error('id_propinsi') is-invalid @enderror">
                                <select name="id_propinsi" id="id_propinsi"
                                    class="form-select  @error('id_propinsi') is-invalid @enderror">
                                    <option value="">Propinsi</option>
                                    @foreach ($propinsi as $p)
                                    <option {{old('id_propinsi')==$p->id ? 'selected':''}} value="{{$p->id}}">
                                        {{$p->prov_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_propinsi') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Kabupaten/Kota</label>
                            <div class="form-group  @error('id_kota') is-invalid @enderror">
                                <select name="id_kota" id="id_kota"
                                    class="form-select  @error('id_kota') is-invalid @enderror">
                                    <option value="">Kabupaten/Kota</option>
                                </select>
                            </div>
                            @error('id_kota') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="col-md-3">
                            <label for=""
                                class="form-label @error('id_kecamatan') is-invalid @enderror">Kecamatan</label>
                            <div class="form-group">
                                <select name="id_kecamatan" id="id_kecamatan"
                                    class="form-select @error('id_kecamatan') is-invalid @enderror">
                                    <option value="">Kecamatan</option>
                                </select>
                            </div>
                            @error('kecamatan') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Kelurahan</label>
                            <div class="form-group @error('id_kelurahan') is-invalid @enderror">
                                <select name="id_kelurahan" id="id_kelurahan"
                                    class="form-select @error('id_kelurahan') is-invalid @enderror">
                                    <option value="">Kelurahan</option>
                                </select>
                            </div>
                            @error('id_kelurahan') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <x-inputtext label="TMT" placeholder="TMT" field="tmt"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><rect x="8" y="15" width="2" height="2" /></svg>' />
                        </div>
                        <div class="col-md-6">
                            <x-inputtext label="Masa Kerja" placeholder="Masa kerja" field="masa_kerja"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 4 4 8 12 12 20 8 12 4" /><polyline points="4 12 12 16 20 12" /><polyline points="4 16 12 20 20 16" /></svg>' />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="" class="form-label">Status Kepegawaian</label>
                            <div class="form-group @error('status_kepegawaian') is-invalid @enderror">
                                <select name="status_kepegawaian" id="status_kepegawaian"
                                    class="form-select @error('status_kepegawaian') is-invalid @enderror">
                                    <option value="">Status Kepegawaian</option>
                                    <option {{old('status_kepegawaian')=='OJT' ? 'selected':''}} value="OJT">OJT
                                    </option>
                                    <option {{old('status_kepegawaian')=='Kontrak' ? 'selected':''}} value="Kontrak">
                                        Kontrak
                                    </option>
                                    <option {{old('status_kepegawaian')=='Tetap' ? 'selected':''}} value="Tetap">Pegawai
                                        Tetap
                                    </option>
                                    <option {{old('status_kepegawaian')=='Pengabdian' ? 'selected':''}}
                                        value="Pengabdian">
                                        Pengabdian</option>
                                </select>
                            </div>
                            @error('status_kepegawaian') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Jabatan</label>
                            <div class="form-group @error('id_jabatan') is-invalid @enderror">
                                <select name="id_jabatan" id="id_jabatan"
                                    class="form-select @error('id_jabatan') is-invalid @enderror">
                                    <option value="">Jabatan</option>
                                    @foreach ($jabatan as $j)
                                    <option {{old('id_jabatan')==$j->id ? 'selected':''}} value="{{$j->id}}">
                                        {{$j->nama_jabatan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('jabatan') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <label for="" class="form-label">Unit</label>
                            <div class="form-group @error('unit') is-invalid @enderror">
                                <select name="id_unit" id="id_unit"
                                    class="form-select @error('id_unit') is-invalid @enderror">
                                    <option value="">Unit Penugasan</option>
                                    @foreach ($unit as $u)
                                    <option {{old('id_unit')==$u->id ? 'selected':''}} value="{{$u->id}}">
                                        {{$u->nama_unit}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('unit') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <x-inputtext label="Nama Ayah" placeholder="Nama Ayah" field="nama_ayah"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>' />
                        </div>
                        <div class="col-md-6">
                            <x-inputtext label="Nama Ibu" placeholder="Nama Ibu" field="nama_ibu"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>' />
                        </div>
                    </div>
                    <div class="rom mb-2">
                        <x-inputtextarea label="Alamat Orang tua" field="alamat_orangtua" />
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <x-inputtext label="Nama Pasangan" placeholder="Nama Pasangan" field="nama_pasangan"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>' />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <x-inputtext label="Tempat Lahir Pasangan" placeholder="Tempat Lahir Pasangan"
                                field="tempat_lahir_pasangan"
                                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><polyline points='3 7 9 4 15 7 21 4 21 17 15 20 9 17 3 20 3 7' /><line x1='9' y1='4' x2='9' y2='17' /><line x1='15' y1='7' x2='15' y2='20' /></svg>" />
                        </div>
                        <div class="col-md-6">
                            <x-inputtext label="Tanggal Lahir Pasangan" placeholder="Tanggal Lahir Pasangan"
                                field="tanggal_lahir_pasangan"
                                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><rect x='4' y='5' width='16' height='16' rx='2' /><line x1='16' y1='3' x2='16' y2='7' /><line x1='8' y1='3' x2='8' y2='7' /><line x1='4' y1='11' x2='20' y2='11' /><rect x='8' y='15' width='2' height='2' /></svg>" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="" class="form-label">Pendidikan Terakhir</label>
                            <div class="form-group  @error('pendidikan_terakhir') is-invalid @enderror">
                                <select name="pendidikan_terakhir" id="pendidikan_terakhir"
                                    class="form-select  @error('pendidikan_terakhir') is-invalid @enderror">
                                    <option value="">Pendidikan Terakhir</option>
                                    <option {{old('pendidikan_terakhir')=='SD' ? 'selected':''}} value="SD">SD</option>
                                    <option {{old('pendidikan_terakhir')=='SMP' ? 'selected':''}} value="SMP">SMP
                                    </option>
                                    <option {{old('pendidikan_terakhir')=='SMA' ? 'selected':''}} value="SMA">SMA
                                    </option>
                                    <option {{old('pendidikan_terakhir')=='D3' ? 'selected':''}} value="D3">D3</option>
                                    <option {{old('pendidikan_terakhir')=='S1' ? 'selected':''}} value="S1">S1</option>
                                    <option {{old('pendidikan_terakhir')=='S2' ? 'selected':''}} value="S2">S2</option>
                                </select>
                            </div>
                            @error('pendidikan_terakhir') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <x-inputtext label="Pekerjaan" placeholder="Pekerjaan" field="pekerjaan" icon='<svg xmlns="
                    http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="3" y="7" width="18" height="13" rx="2" />
                    <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                    <line x1="12" y1="12" x2="12" y2="12.01" />
                    <path d="M3 13a20 20 0 0 0 18 0" /></svg>' />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <x-inputtext label="Kontak" placeholder="Kontak" field="kontak"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /><path d="M15 7a2 2 0 0 1 2 2" /><path d="M15 3a6 6 0 0 1 6 6" /></svg>' />
                        </div>
                    </div>
                    <button class="btn btn-primary btn-pill w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('myscript')
<script>
    document.addEventListener("DOMContentLoaded", function() {
    flatpickr(document.getElementById('tanggal_lahir'), {});
    flatpickr(document.getElementById('tanggal_lahir_pasangan'), {});
    flatpickr(document.getElementById('tmt'), {});
  });
</script>
@endpush
@push('myscript')
<script>
    $(function(){
    $("#id_propinsi").change(function(){
      var id_propinsi = $("#id_propinsi").val();
      $.ajax({
        type:'POST',
        url:'/kota/getkota',
        data:{
          _token: "{{ csrf_token() }}",
          id_propinsi:id_propinsi
          },
        cache:false,
        success:function(respond){
          $("#id_kota").html(respond);
        }
      });
    });

    $("#id_kota").change(function(){
      var id_kota = $("#id_kota").val();
      $.ajax({
        type:'POST',
        url:'/kecamatan/getkecamatan',
        data:{
          _token: "{{ csrf_token() }}",
          id_kota:id_kota
          },
        cache:false,
        success:function(respond){
          $("#id_kecamatan").html(respond);
        }
      });
    });

    $("#id_kecamatan").change(function(){
      var id_kecamatan = $("#id_kecamatan").val();
      $.ajax({
        type:'POST',
        url:'/kelurahan/getkelurahan',
        data:{
          _token: "{{ csrf_token() }}",
          id_kecamatan:id_kecamatan
          },
        cache:false,
        success:function(respond){
          $("#id_kelurahan").html(respond);
        }
      });
    });
  });
</script>
@endpush