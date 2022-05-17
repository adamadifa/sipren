@extends('layouts.tabler')
@section('page-pretitle','Edit Data Pendaftaran')
@section('page-title','Edit Data Pendaftaran')
@section('content')
<form action="/pendaftaran/{{$pendaftaran->no_pendaftaran}}" method="post">
  <input type="hidden" name="id_siswa" value="{{$pendaftaran->id_siswa}}">
  <input type="hidden" name="jenjang" value="{{$pendaftaran->jenjang}}">
  <div class="row">

    <div class="col-md-6">
      <div class="card mt-2">
        <div class="card-header">
          <div class="card-title">Data Pendaftaran</div>
        </div>
        <div class="card-body">

          @csrf
          @method('PUT')
          <table class="table table-striped">
            <tr>
              <th>No. Pendaftaran</th>
              <td>{{$pendaftaran->no_pendaftaran}}</td>
            </tr>
            <tr>
              <th>NIS</th>
              <td>{{$pendaftaran->nis}}</td>
            </tr>
          </table>
          <div class="row mb-2">
            <div class="col-md-6">
              <x-inputtext label="Tangal Pendaftaran" placeholder="Tanggal Pendaftaran" field="tgl_pendaftaran"
                value="{{$pendaftaran->tgl_pendaftaran}}"
                icon='<!-- Download SVG icon from http://tabler-icons.io/i/calendar-event -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><rect x="8" y="15" width="2" height="2" /></svg>' />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4">
              <x-inputtext label="NISN" placeholder="NISN" field="nisn" value="{{$pendaftaran->nisn}}"
                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 7v-1a2 2 0 0 1 2 -2h2' /><path d='M4 17v1a2 2 0 0 0 2 2h2' /><path d='M16 4h2a2 2 0 0 1 2 2v1' /><path d='M16 20h2a2 2 0 0 0 2 -2v-1' /><rect x='5' y='11' width='1' height='2' /><line x1='10' y1='11' x2='10' y2='13' /><rect x='14' y='11' width='1' height='2' /><line x1='19' y1='11' x2='19' y2='13' /></svg>" />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <x-inputtext label="Nama Lengkap" placeholder="Nama Lengkap" field="nama_lengkap"
                value="{{$pendaftaran->nama_lengkap}}"
                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><circle cx='12' cy='7' r='4' /><path d='M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2' /></svg>" />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-4">
              <x-inputjeniskelamin field="jenis_kelamin" label="Jenis Kelamin"
                value="{{$pendaftaran->jenis_kelamin}}" />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-6">
              <x-inputtext label="Tempat Lahir" placeholder="Tempat Lahir" field="tempat_lahir"
                value="{{$pendaftaran->tempat_lahir}}"
                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M10.828 9.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z' /><line x1='8' y1='7' x2='8' y2='7.01' /><path d='M18.828 17.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z' /><line x1='16' y1='15' x2='16' y2='15.01' /></svg>" />
            </div>
            <div class="col-md-6">
              <x-inputtext label="Tanggal Lahir" placeholder="Tanggal Lahir" field="tanggal_lahir"
                value="{{$pendaftaran->tanggal_lahir}}"
                icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><rect x='4' y='5' width='16' height='16' rx='2' /><line x1='16' y1='3' x2='16' y2='7' /><line x1='8' y1='3' x2='8' y2='7' /><line x1='4' y1='11' x2='20' y2='11' /><rect x='8' y='15' width='2' height='2' /></svg>" />
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-3">
              <x-inputtext label="Anak Ke" placeholder="Anak Ke" field="anak_ke" value="{{$pendaftaran->anak_ke}}"
                icon="<!-- Download SVG icon from http://tabler-icons.io/i/users -->
                <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><circle cx='9' cy='7' r='4' /><path d='M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2' /><path d='M16 3.13a4 4 0 0 1 0 7.75' /><path d='M21 21v-2a4 4 0 0 0 -3 -3.85' /></svg>" />
            </div>
            <div class="col-md-3">
              <x-inputtext label="Jumlah Saudara" placeholder="Jumlah Saudara" field="jml_saudara"
                value="{{$pendaftaran->jml_saudara}}"
                icon="<!-- Download SVG icon from http://tabler-icons.io/i/users -->
                <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><circle cx='9' cy='7' r='4' /><path d='M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2' /><path d='M16 3.13a4 4 0 0 1 0 7.75' /><path d='M21 21v-2a4 4 0 0 0 -3 -3.85' /></svg>" />
            </div>
          </div>

          <div class="rom mb-2">
            <x-inputtextarea label="Alamat" field="alamat" value="{{$pendaftaran->alamat}}" />
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="" class="form-label">Propinsi</label>
              <div class="form-group  @error('id_propinsi') is-invalid @enderror">
                <select name="id_propinsi" id="id_propinsi"
                  class="form-select  @error('id_propinsi') is-invalid @enderror">
                  <option value="">Propinsi</option>
                  @foreach ($propinsi as $p)
                  <option @isset($pendaftaran->id_propinsi) @if(old("id_propinsi"))
                    {{old("id_propinsi")==$p->id ? "selected":""}} @else
                    {{$pendaftaran->id_propinsi==$p->id ? "selected":""}} @endif @else
                    {{old("id_propinsi")==$p->id ? "selected":""}}
                    @endisset {{old('id_propinsi')==$p->id ? 'selected':''}}
                    value="{{$p->id}}">{{$p->prov_name}}</option>
                  @endforeach
                </select>
              </div>
              @error('id_propinsi') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="" class="form-label">Kabupaten/Kota</label>
              <div class="form-group  @error('id_kota') is-invalid @enderror">
                <select name="id_kota" id="id_kota" class="form-select  @error('id_kota') is-invalid @enderror">
                  <option value="">Kabupaten/Kota</option>
                </select>
              </div>
              @error('id_kota') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="" class="form-label @error('id_kecamatan') is-invalid @enderror">Kecamatan</label>
              <div class="form-group">
                <select name="id_kecamatan" id="id_kecamatan"
                  class="form-select @error('id_kecamatan') is-invalid @enderror">
                  <option value="">Kecamatan</option>
                </select>
              </div>
              @error('kecamatan') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
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
          <div class="row">
            <div class="col-md-6">
              <x-inputtext label="Kode Pos" placeholder="Kode Pos" field="kodepos" value="{{$pendaftaran->kodepos}}"
                icon="<!-- Download SVG icon from http://tabler-icons.io/i/float-right -->
                <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><rect width='6' height='6' x='14' y='5' rx='1' /><line x1='4' y1='7' x2='10' y2='7' /><line x1='4' y1='11' x2='10' y2='11' /><line x1='4' y1='15' x2='20' y2='15' /><line x1='4' y1='19' x2='20' y2='19' /></svg>" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="card mt-2">
            <div class="card-header">
              <div class="card-title">Data Orangtua</div>
            </div>
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-md-8">
                  <x-inputtext label="No KK" placeholder="No KK" field="no_kk" value="{{$pendaftaran->no_kk}}"
                    icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 7v-1a2 2 0 0 1 2 -2h2' /><path d='M4 17v1a2 2 0 0 0 2 2h2' /><path d='M16 4h2a2 2 0 0 1 2 2v1' /><path d='M16 20h2a2 2 0 0 0 2 -2v-1' /><rect x='5' y='11' width='1' height='2' /><line x1='10' y1='11' x2='10' y2='13' /><rect x='14' y='11' width='1' height='2' /><line x1='19' y1='11' x2='19' y2='13' /></svg>" />
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-8">
                  <x-inputtext label="NIK" placeholder="NIK" field="nik_ayah" value="{{$pendaftaran->nik_ayah}}"
                    icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 7v-1a2 2 0 0 1 2 -2h2' /><path d='M4 17v1a2 2 0 0 0 2 2h2' /><path d='M16 4h2a2 2 0 0 1 2 2v1' /><path d='M16 20h2a2 2 0 0 0 2 -2v-1' /><rect x='5' y='11' width='1' height='2' /><line x1='10' y1='11' x2='10' y2='13' /><rect x='14' y='11' width='1' height='2' /><line x1='19' y1='11' x2='19' y2='13' /></svg>" />
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-12">
                  <x-inputtext label="Nama Ayah" placeholder="Nama Ayah" field="nama_ayah"
                    value="{{$pendaftaran->nama_ayah}}"
                    icon="<!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><circle cx='12' cy='7' r='4' /><path d='M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2' /></svg>" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="" class="form-label">Pendidikan Ayah</label>
                  <div class="form-group  @error('pendidikan_ayah') is-invalid @enderror">
                    <select name="pendidikan_ayah" id="pendidikan_ayah"
                      class="form-select  @error('pendidikan_ayah') is-invalid @enderror">
                      <option value="">Pendidikan Ayah</option>
                      <option @isset($pendaftaran->pendidikan_ayah)
                        @if(old("pendidikan_ayah"))
                        {{old("pendidikan_ayah")=="SD" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ayah == "SD" ? "selected":""}} @endif @else
                        {{old("pendidikan_ayah")== "SD" ? "selected":""}}
                        @endisset value="SD">SD</option>
                      <option @isset($pendaftaran->pendidikan_ayah)
                        @if(old("pendidikan_ayah"))
                        {{old("pendidikan_ayah")=="SMP" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ayah == "SMP" ? "selected":""}} @endif @else
                        {{old("pendidikan_ayah")== "SMP" ? "selected":""}}
                        @endisset value="SMP">SMP</option>
                      <option @isset($pendaftaran->pendidikan_ayah)
                        @if(old("pendidikan_ayah"))
                        {{old("pendidikan_ayah")=="SMA" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ayah == "SMA" ? "selected":""}} @endif @else
                        {{old("pendidikan_ayah")== "SMA" ? "selected":""}}
                        @endisset value="SMA">SMA / SLTA</option>

                      <option @isset($pendaftaran->pendidikan_ayah)
                        @if(old("pendidikan_ayah"))
                        {{old("pendidikan_ayah")=="D3" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ayah == "D3" ? "selected":""}} @endif @else
                        {{old("pendidikan_ayah")== "D3" ? "selected":""}}
                        @endisset value="D3">D3</option>
                      <option @isset($pendaftaran->pendidikan_ayah)
                        @if(old("pendidikan_ayah"))
                        {{old("pendidikan_ayah")=="S1" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ayah == "S1" ? "selected":""}} @endif @else
                        {{old("pendidikan_ayah")== "S1" ? "selected":""}}
                        @endisset value="S1">S1</option>
                      <option @isset($pendaftaran->pendidikan_ayah)
                        @if(old("pendidikan_ayah"))
                        {{old("pendidikan_ayah")=="S2" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ayah == "S2" ? "selected":""}} @endif @else
                        {{old("pendidikan_ayah")== "S2" ? "selected":""}}
                        @endisset value="S2">S2</option>
                    </select>
                  </div>
                  @error('pendidikan_ayah') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                  <label for="" class="form-label">Pekerjaan Ayah</label>
                  <div class="form-group @error('pekerjaan_ayah') is-invalid @enderror">
                    <select name="pekerjaan_ayah" id="pekerjaan_ayah"
                      class="form-select @error('pekerjaan_ayah') is-invalid @enderror">
                      <option value="">Pekerjaan Ayah</option>
                      @foreach ($pekerjaan as $p)
                      <option @isset($pendaftaran->pekerjaan_ayah)
                        @if (old('pendidikan_ayah'))
                        {{old('pekerjaan_ayah')==$p->id ? 'selected':''}}
                        @else
                        {{$pendaftaran->pekerjaan_ayah == $p->id ? 'selected':''}}
                        @endif
                        @endisset value="{{$p->id}}"">
                        {{$p->nama_pekerjaan}}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  @error('pekerjaan_ayah') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
                </div>
              </div>
              <hr>
              <div class="row mb-2">
                <div class="col-md-8">
                  <x-inputtext label="NIK" placeholder="NIK" field="nik_ibu" value="{{$pendaftaran->nik_ibu}}"
                    icon="<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 7v-1a2 2 0 0 1 2 -2h2' /><path d='M4 17v1a2 2 0 0 0 2 2h2' /><path d='M16 4h2a2 2 0 0 1 2 2v1' /><path d='M16 20h2a2 2 0 0 0 2 -2v-1' /><rect x='5' y='11' width='1' height='2' /><line x1='10' y1='11' x2='10' y2='13' /><rect x='14' y='11' width='1' height='2' /><line x1='19' y1='11' x2='19' y2='13' /></svg>" />
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-12">
                  <x-inputtext label="Nama Ibu" placeholder="Nama Ibu" field="nama_ibu"
                    value="{{$pendaftaran->nama_ibu}}"
                    icon="<!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns='http://www.w3.org/2000/svg' class='icon' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><circle cx='12' cy='7' r='4' /><path d='M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2' /></svg>" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="" class="form-label">Pendidikan Ibu</label>
                  <div class="form-group  @error('pendidikan_ibu') is-invalid @enderror">
                    <select name="pendidikan_ibu" id="pendidikan_ibu"
                      class="form-select  @error('pendidikan_ibu') is-invalid @enderror">
                      <option @isset($pendaftaran->pendidikan_ibu)
                        @if(old("pendidikan_ibu"))
                        {{old("pendidikan_ibu")=="SD" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ibu == "SD" ? "selected":""}} @endif @else
                        {{old("pendidikan_ibu")== "SD" ? "selected":""}}
                        @endisset value="SD">SD</option>
                      <option @isset($pendaftaran->pendidikan_ibu)
                        @if(old("pendidikan_ibu"))
                        {{old("pendidikan_ibu")=="SMP" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ibu == "SMP" ? "selected":""}} @endif @else
                        {{old("pendidikan_ibu")== "SMP" ? "selected":""}}
                        @endisset value="SMP">SMP</option>
                      <option @isset($pendaftaran->pendidikan_ibu)
                        @if(old("pendidikan_ibu"))
                        {{old("pendidikan_ibu")=="SMA" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ibu == "SMA" ? "selected":""}} @endif @else
                        {{old("pendidikan_ibu")== "SMA" ? "selected":""}}
                        @endisset value="SMA">SMA / SLTA</option>

                      <option @isset($pendaftaran->pendidikan_ibu)
                        @if(old("pendidikan_ibu"))
                        {{old("pendidikan_ibu")=="D3" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ibu == "D3" ? "selected":""}} @endif @else
                        {{old("pendidikan_ibu")== "D3" ? "selected":""}}
                        @endisset value="D3">D3</option>
                      <option @isset($pendaftaran->pendidikan_ibu)
                        @if(old("pendidikan_ibu"))
                        {{old("pendidikan_ibu")=="S1" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ibu == "S1" ? "selected":""}} @endif @else
                        {{old("pendidikan_ibu")== "S1" ? "selected":""}}
                        @endisset value="S1">S1</option>
                      <option @isset($pendaftaran->pendidikan_ibu)
                        @if(old("pendidikan_ibu"))
                        {{old("pendidikan_ibu")=="S2" ? "selected":""}}
                        @else
                        {{$pendaftaran->pendidikan_ibu == "S2" ? "selected":""}} @endif @else
                        {{old("pendidikan_ibu")== "S2" ? "selected":""}}
                        @endisset value="S2">S2</option>
                    </select>
                  </div>
                  @error('pendidikan_ibu') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="" class="form-label">Pekerjaan Ibu</label>
                  <div class="form-group @error('pekerjaan_ibu') is-invalid @enderror">
                    <select name="pekerjaan_ibu" id="pekerjaan_ibu"
                      class="form-select @error('pekerjaan_ibu') is-invalid @enderror">
                      <option value="">Pekerjaan Ibu</option>
                      @foreach ($pekerjaan as $p)
                      <option @isset($pendaftaran->pekerjaan_ibu)
                        @if (old('pekerjaan_ibu'))
                        {{old('pekerjaan_ibu')==$p->id ? 'selected':''}}
                        @else
                        {{$pendaftaran->pekerjaan_ibu == $p->id ? 'selected':''}}
                        @endif
                        @endisset value="{{$p->id}}"">
                        {{$p->nama_pekerjaan}}
                      </option>
                      @endforeach
                    </select>
                  </div>
                  @error('pekerjaan_ibu') <div class="mb-2 mt-2 invalid-feedback">{{$message}}</div> @enderror
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card mt-2">
            <div class="card-header">
              <div class="card-title">Data Sekolah</div>
            </div>
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-md-4">
                  <x-inputtext label="NPSN" placeholder="NPSN" field="npsn" value="{{$pendaftaran->npsn}}"
                    icon='<!-- Download SVG icon from http://tabler-icons.io/i/barcode -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><rect x="5" y="11" width="1" height="2" /><line x1="10" y1="11" x2="10" y2="13" /><rect x="14" y="11" width="1" height="2" /><line x1="19" y1="11" x2="19" y2="13" /></svg>' />
                </div>
                <div class="col-md-8">
                  <x-inputtext label="Asal Sekolah" placeholder="Asal Sekolah" field="asal_sekolah"
                    value="{{$pendaftaran->asal_sekolah}}"
                    icon='<!-- Download SVG icon from http://tabler-icons.io/i/building -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="3" y1="21" x2="21" y2="21" /><line x1="9" y1="8" x2="10" y2="8" /><line x1="9" y1="12" x2="10" y2="12" /><line x1="9" y1="16" x2="10" y2="16" /><line x1="14" y1="8" x2="15" y2="8" /><line x1="14" y1="12" x2="15" y2="12" /><line x1="14" y1="16" x2="15" y2="16" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>' />
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                  <x-inputtext label="No. Ijazah" placeholder="No. Ijazah" field="no_ijazah"
                    value="{{$pendaftaran->no_ijazah}}"
                    icon='<!-- Download SVG icon from http://tabler-icons.io/i/barcode -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><rect x="5" y="11" width="1" height="2" /><line x1="10" y1="11" x2="10" y2="13" /><rect x="14" y="11" width="1" height="2" /><line x1="19" y1="11" x2="19" y2="13" /></svg>' />
                </div>
                <div class="col-md-6">
                  <x-inputtext label="No. SHUN" placeholder="No. SHUN" field="no_shun" value="{{$pendaftaran->no_shun}}"
                    icon='<!-- Download SVG icon from http://tabler-icons.io/i/barcode -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><rect x="5" y="11" width="1" height="2" /><line x1="10" y1="11" x2="10" y2="13" /><rect x="14" y="11" width="1" height="2" /><line x1="19" y1="11" x2="19" y2="13" /></svg>' />
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                  <x-inputtext label="No. Peserta Ujian" placeholder="No. Peserta Ujian" field="no_peserta_ujian"
                    value="{{$pendaftaran->nomor_peserta_ujian}}"
                    icon='<!-- Download SVG icon from http://tabler-icons.io/i/barcode -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><rect x="5" y="11" width="1" height="2" /><line x1="10" y1="11" x2="10" y2="13" /><rect x="14" y="11" width="1" height="2" /><line x1="19" y1="11" x2="19" y2="13" /></svg>' />
                </div>
                <div class="col-md-3">
                  <x-inputtext label="Rata Rata Nilai US" placeholder="Rata Rata Nilai US" field="nilai_us"
                    value="{{$pendaftaran->nilai_us}}"
                    icon='<!-- Download SVG icon from http://tabler-icons.io/i/barcode -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><rect x="5" y="11" width="1" height="2" /><line x1="10" y1="11" x2="10" y2="13" /><rect x="14" y="11" width="1" height="2" /><line x1="19" y1="11" x2="19" y2="13" /></svg>' />
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                  <x-inputtext label="Tanggal Lulus" placeholder="Tanggal Lulus" field="tanggal_lulus"
                    value="{{$pendaftaran->tanggal_lulus}}"
                    icon='<!-- Download SVG icon from http://tabler-icons.io/i/calendar-event -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><rect x="8" y="15" width="2" height="2" /></svg>' />
                </div>
              </div>
              <button class="btn btn-primary w-100" style="background-color:#004c2d; color:white" type="submit"
                name="submit">
                <!-- Download SVG icon from http://tabler-icons.io/i/send -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                  stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <line x1="10" y1="14" x2="21" y2="3" />
                  <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection

@push('myscript')
<script>
  document.addEventListener("DOMContentLoaded", function() {
  flatpickr(document.getElementById('tanggal_lahir'), {});
  flatpickr(document.getElementById('tanggal_lulus'), {});
 
});
</script>
<script>
  $(function() {   
 $('.uppercase').keyup(function(){
        $(this).val($(this).val().toUpperCase());
    });
});
</script>
<script>
  $(function(){

  function loadkota(){
    var id_propinsi = $("#id_propinsi").val();
    var id_kota = "{{$pendaftaran->id_kota}}";
    //alert(id_kota);
    $.ajax({
      type:'POST',
      url:'/kota/getkota',
      data:{
        _token: "{{ csrf_token() }}",
        id_propinsi:id_propinsi,
        id_kota:id_kota
        },
      cache:false,
      success:function(respond){
        $("#id_kota").html(respond);
      }
    });
  }

  $("#id_propinsi").change(function(){
    loadkota();
  });

  function loadkecamatan(){
    var kota = $("#id_kota").val();
    var id_kota ="";
    if(kota ==""){
      id_kota = "{{$pendaftaran->id_kota}}";
    }else{
      id_kota = kota
    }
    var id_kecamatan = "{{$pendaftaran->id_kecamatan}}";
    //alert(id_kota);
    $.ajax({
      type:'POST',
      url:'/kecamatan/getkecamatan',
      data:{
        _token: "{{ csrf_token() }}",
        id_kota:id_kota,
        id_kecamatan:id_kecamatan
        },
      cache:false,
      success:function(respond){
        $("#id_kecamatan").html(respond);
      }
    });
  }

  function loadkelurahan(){
    var kecamatan = $("#id_kecamatan").val();
    var id_kecamatan ="";
    if(kecamatan ==""){
      id_kecamatan = "{{$pendaftaran->id_kecamatan}}";
    }else{
      id_kecamatan = kecamatan;
    }

    var id_kelurahan = "{{$pendaftaran->id_kelurahan}}";
    $.ajax({
      type:'POST',
      url:'/kelurahan/getkelurahan',
      data:{
        _token: "{{ csrf_token() }}",
        id_kecamatan:id_kecamatan,
        id_kelurahan:id_kelurahan
        },
      cache:false,
      success:function(respond){
        $("#id_kelurahan").html(respond);
      }
    });
  }

  $("#id_kota").change(function(){
    loadkecamatan();
  });
  loadkota();
  loadkecamatan();
  loadkelurahan();
  $("#id_kecamatan").change(function(){
    loadkelurahan();
  });
});
</script>
@endpush