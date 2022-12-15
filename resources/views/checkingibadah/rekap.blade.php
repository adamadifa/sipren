@extends('layouts.tabler')
@section('title','Rekap Checklist Ibadah SDM')
@section('page-pretitle','Rekap Checklist Ibadah SDM')
@section('page-title','Rekap Checklist Ibadah SDM')
@section('content')
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form id="frmLaporan" action="/checkingibadah/rekap/cetak" method="POST" target="_blank">
                    @csrf
                    <div class="form-group">
                        @if (Auth::guard('user')->user()->id_unit == 9)
                        <select name="unit" id="unit" class="form-select">
                            <option value="">Semua Unit</option>
                            @foreach ($unit as $d)
                            <option value="{{$d->id}}">{{strtoupper($d->nama_unit)}}</option>
                            @endforeach
                        </select>
                        @else
                        <input type="hidden" name="unit" id="unit" value="{{Auth::guard('user')->user()->id_unit}}">
                        @endif
                        {{-- <label for="" class="form-label">Nama Karyawan</label> --}}

                    </div>
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
    $(function() {
        $("#frmLaporan").submit(function() {
            var npp = $("#npp").val();
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            if (npp == "") {
                swal("Oops", "Karyawan Harus dipilih", "warning");
                return false;
            } else if (bulan == "") {
                swal("Oops", "Bulan Harus dipilih", "warning");
                return false;
            } else if (tahun == "") {
                swal("Oops", "Tahun Harus dipilih", "warning");
                return false;
            } else {
                return true;
            }
        });
    });

</script>
@endpush
