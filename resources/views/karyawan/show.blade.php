@extends('layouts.tabler')
@section('title','Detail Karyawan')
@section('page-pretitle','Detail Karyawan')
@section('page-title','Detail Karyawan')
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-important alert-success alert-dismissible" role="alert">
    <div class="d-flex">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
<div class="row row-cards mt-3">
    @include('karyawan.sideprofile')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pribadi</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th style="width:30%">NPP</th>
                        <td>
                            <input type="hidden" id="npp" value="{{$karyawan->npp}}">
                            {{$karyawan->npp}}
                        </td>
                    </tr>
                    <tr>
                        <th>No. KK</th>
                        <td>{{$karyawan->no_kk}}</td>
                    </tr>
                    <tr>
                        <th>No. KTP</th>
                        <td>{{$karyawan->no_ktp}}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{strtoupper($karyawan->nama_lengkap)}}</td>
                    </tr>
                    <tr>
                        <th>Nama Panggilan</th>
                        <td>{{$karyawan->nama_panggilan}}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>
                            @if ($karyawan->jenis_kelamin=="L")
                            Laki-Laki
                            @else
                            Perempuan
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tempat / Tanggal Lahir</th>
                        <td>{{$karyawan->tempat_lahir." / ".\Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('d F Y')}}
                        </td>
                    </tr>
                    <tr>
                        <th>Golongan Darah</th>
                        <td>{{$karyawan->golongan_darah}}</td>
                    </tr>
                    <tr>
                        <th>Pendidikan Terakhir</th>
                        <td>{{$karyawan->pendidikan_terakhir}}</td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td>{{$karyawan->no_hp}}</td>
                    </tr>
                    <tr>
                        <th>Whatsapp</th>
                        <td>{{$karyawan->whatsapp}}</td>
                    </tr>
                    <tr>
                        <th>instagram</th>
                        <td>{{$karyawan->instagram}}</td>
                    </tr>
                    <tr>
                        <th>Facebook</th>
                        <td>{{$karyawan->facebook}}</td>
                    </tr>
                    <tr>
                        <th>Alamat KTP</th>
                        <td>{!! $karyawan->alamat_ktp !!}</td>
                    </tr>
                    <tr>
                        <th>Alamat Tinggal</th>
                        <td>{!! $karyawan->alamat_tinggal !!}</td>
                    </tr>
                    <tr>
                        <th>RT</th>
                        <td>{{$karyawan->rt}}</td>
                    </tr>
                    <tr>
                        <th>RW</th>
                        <td>{{$karyawan->rw}}</td>
                    </tr>
                    <tr>
                        <th>Kelurahan</th>
                        <td>{{$karyawan->vill_name}}</td>
                    </tr>
                    <tr>
                        <th>Kecamatan</th>
                        <td>{{$karyawan->dist_name}}</td>
                    </tr>
                    <tr>
                        <th>Kabupaten</th>
                        <td>{{$karyawan->regc_name}}</td>
                    </tr>
                    <tr>
                        <th>Propinsi</th>
                        <td>{{$karyawan->prov_name}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row row-cards mt-3">
    <div class="col-md-3">
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Orangtua</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Nama Ayah</th>
                        <td>{{$karyawan->nama_ayah}}</td>
                    </tr>
                    <tr>
                        <th>Nama Ibu</th>
                        <td>{{$karyawan->nama_ibu}}</td>
                    </tr>
                    <tr>
                        <th>Alamat Orangtua</th>
                        <td>{!! $karyawan->alamat_orangtua !!}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
<div class="row row-cards mt-3">
    <div class="col-md-3">
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Keluarga</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped mb-3">
                    <tr>
                        <th>Nama Pasangan</th>
                        <td>{{$karyawan->nama_pasangan}}</td>
                    </tr>
                    <tr>
                        <th>Tempat / Tgl Lahir</th>
                        <td>{{$karyawan->tempat_lahir_pasangan."/".$karyawan->tanggal_lahir_pasangan}}</td>
                    </tr>

                    <tr>
                        <th>Pekerjaan</th>
                        <td>{{ $karyawan->pekerjaan }}</td>
                    </tr>
                    <tr>
                        <th>Kontak</th>
                        <td>{{ $karyawan->kontak }}</td>
                    </tr>

                </table>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" name="nama_anak" id="nama_anak"
                                placeholder="Nama Anak">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" name="tgl_lahir_anak" id="tgl_lahir_anak"
                                placeholder="Tanggal Lahir">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <select name="jk" class="form-select" id="jk_anak">
                                <option value="">JK</option>
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <select name="anak_ke" class="form-select" id="anak_ke">
                                <?php for($i=1; $i<=10; $i++){ ?>
                                <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" id="tambahanak">Tambah</button>
                    </div>
                </div>
                <table class="table table-striped mb-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Anak</th>
                            <th>Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Anak Ke</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="loadanak"></tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<div class="row row-cards mt-3">
    <div class="col-md-3">
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Kepegawaian</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Unit</th>
                        <td>{{$karyawan->nama_unit}}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{$karyawan->nama_jabatan}}</td>
                    </tr>
                    <tr>
                        <th>Status Kepegawaian</th>
                        <td>{{$karyawan->status_kepegawaian}}</td>
                    </tr>
                    <tr>
                        <th>TMT</th>
                        <td>{{\Carbon\Carbon::parse($karyawan->tmt)->format('d F Y')}}</td>
                    </tr>
                    <tr>
                        <th>Masa Kerja</th>
                        <td> {{\Carbon\Carbon::parse($karyawan->tmt)->diff(\Carbon\Carbon::now())->format('%y Tahun, %m Bulan and %d Hari')}}
                        </td>
                    </tr>
                </table>
                <div class="row">
                    <h4 class="card-title">Unit Penugasan Tambahan</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <select name="unittambahan" id="unittambahan" class="form-select">
                                    <option value="">Unit Penugasan Tambahan</option>
                                    @foreach ($unit as $u)
                                    <option value="{{$u->id}}">{{$u->nama_unit}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary" id="tambahunit">Tambah</button>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped" style="width:60%">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Unit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="loadunittambahan">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row row-cards mt-3">
    <div class="col-md-3">
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Riwayat Pendidikan</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <select name="tingkat" id="tingkat" class="form-select">
                                    <option value="">Tingkat</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="D3">D3</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah"
                                    placeholder="Nama Sekolah / Institusi">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" name="tahunlulus" id="tahunlulus"
                                    placeholder="Tahun Lulus">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary" id="tambahpendidikan">Tambah</button>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Tingkat</th>
                                <th>Nama Sekolah / Institusi</th>
                                <th>Tahun Lulus</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="loadpendidikan">

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
    document.addEventListener("DOMContentLoaded", function() {
    flatpickr(document.getElementById('tgl_lahir_anak'), {});
  });
</script>
<script>
    $(function(){
        function loadunittambahan(){
            var npp = "{{$karyawan->npp}}";
            $.ajax({
                type:'POST',
                url:'/karyawan/getunittambahan',
                data:{
                    _token: "{{ csrf_token() }}",
                    npp:npp
                },
                cache:false,
                success:function(respond){
                    $("#loadunittambahan").html(respond);
                }
            });
        }
        
        function loadanak(){
            var npp = "{{$karyawan->npp}}";
            $.ajax({
                type:'POST',
                url:'/karyawan/getanak',
                data:{
                    _token: "{{ csrf_token() }}",
                    npp:npp
                },
                cache:false,
                success:function(respond){
                    $("#loadanak").html(respond);
                }
            });
        }
        
         function loadpendidikan(){
            var npp = "{{$karyawan->npp}}";
            $.ajax({
                type:'POST',
                url:'/karyawan/getpendidikan',
                data:{
                    _token: "{{ csrf_token() }}",
                    npp:npp
                },
                cache:false,
                success:function(respond){
                    $("#loadpendidikan").html(respond);
                }
            });
        }
        loadanak();
        loadunittambahan();
        loadpendidikan();
        $("#tambahunit").click(function(){
            var unittambahan = $("#unittambahan").val();
            var npp = "{{$karyawan->npp}}";
            if (unittambahan == ""){
                alert('Unit Tambahan Harus Di pilih dulu !');
            }else{
                $.ajax({
                    type:'POST',
                    url : '/karyawan/simpanunittambahan',
                    data :{
                        _token: "{{ csrf_token() }}",
                        npp:npp,
                        unittambahan:unittambahan
                    },
                    cache:false,
                    success:function(){
                        loadunittambahan();
                    }
                });
            }
        });
        
        $("#tambahpendidikan").click(function(){
            var nama_sekolah = $("#nama_sekolah").val();
            var tahunlulus = $("#tahunlulus").val();
            var tingkat = $("#tingkat").val();
            var npp = "{{$karyawan->npp}}";
            if (nama_sekolah == ""){
                alert('Nama Sekolah / Institusi Harus Di isi !');
            }else if (tahunlulus == ""){
                alert('Tahun Lulus Harus Di isi !');
            }else if (tingkat == ""){
                alert('Tingkat Harus Di isi !');
            }else{
                $.ajax({
                    type:'POST',
                    url : '/karyawan/simpanpendidikan',
                    data :{
                        _token: "{{ csrf_token() }}",
                        npp:npp,
                        tingkat:tingkat,
                        nama_sekolah:nama_sekolah,
                        tahunlulus:tahunlulus
                    },
                    cache:false,
                    success:function(){
                        loadpendidikan();
                    }
                });
            }
        });
        
        $("#tambahanak").click(function(){
            var nama_anak = $("#nama_anak").val();
            var tgl_lahir_anak = $("#tgl_lahir_anak").val();
            var jk_anak = $("#jk_anak").val();
            var anak_ke = $("#anak_ke").val();
            var npp = "{{$karyawan->npp}}";
            if (nama_anak == ""){
                alert('Nama Anak Harus Di isi !');
            }else if (tgl_lahir_anak == ""){
                alert('Tgl Lahir Anak Harus Di isi !');
            }else if (jk_anak == ""){
                alert('Jenis Kelamin Anak Harus Di pilih dulu !');
            }else if (anak_ke == ""){
                alert('Anak Ke Harus Di pilih dulu !');
            }else{
                $.ajax({
                    type:'POST',
                    url : '/karyawan/simpananak',
                    data :{
                        _token: "{{ csrf_token() }}",
                        npp:npp,
                        nama_anak:nama_anak,
                        tgl_lahir_anak:tgl_lahir_anak,
                        jk_anak:jk_anak,
                        anak_ke:anak_ke
                    },
                    cache:false,
                    success:function(){
                        loadanak();
                    }
                });
            }
        });


    });
</script>
@endpush