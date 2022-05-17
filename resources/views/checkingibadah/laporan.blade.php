@extends('layouts.tabler')
@section('title','Laporan Amalan Harian')
@section('page-pretitle','Laporan Amalan Harian')
@section('page-title','Laporan Amalan Harian')
@section('content')
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form id="frmLaporan" action="/checkingibadah/cetak" method="POST" target="_blank">
                    @csrf
                    @if (!empty(Auth::guard('karyawan')->user()->level))
                    @if (Auth::guard('karyawan')->user()->level=="user")
                    <input type="hidden" name="npp" value="{{Auth::guard('karyawan')->user()->npp}}"
                        class="form-control">

                    @endif
                    @else
                    <div class="form-group">
                        {{-- <label for="" class="form-label">Nama Karyawan</label> --}}
                        <select name="npp" id="npp" class="form-select">
                            <option value="">Pilih karyawan</option>
                            @foreach ($karyawan as $d)
                            <option value="{{$d->npp}}">{{strtoupper($d->nama_lengkap)}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        {{-- <label for="" class="form-label">Bulan</label> --}}
                        <select name="bulan" id="bulan" class="form-select">
                            <option value="">Bulan</option>
                            @for ($i = 1; $i <=12; $i++) <option value={{$i}}>{{$namabulan[$i]}}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        {{-- <label for="" class="form-label">Bulan</label> --}}
                        <select name="tahun" id="tahun" class="form-select">
                            <option value="">Tahun</option>
                            @for ($thn = $tahunmulai; $thn <= date("Y"); $thn++) <option value={{$thn}}>{{$thn}}
                                </option>
                                @endfor
                        </select>
                    </div>
                    <button class="btn btn-primary w-100"><i class="fa fa-print mr-3"></i> Cetak</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('myscript')
<script>
    $(function(){
            $("#frmLaporan").submit(function(){
                var npp = $("#npp").val();
                var bulan = $("#bulan").val();
                var tahun = $("#tahun").val();
                if(npp == ""){
                    swal("Oops","Karyawan Harus dipilih","warning");
                    return false;
                }else if(bulan == ""){
                    swal("Oops","Bulan Harus dipilih","warning");
                    return false;
                }else if(tahun == ""){
                    swal("Oops","Tahun Harus dipilih","warning");
                    return false;
                }else{
                    return true;
                }
            });
        });
</script>
@endpush