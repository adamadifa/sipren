@extends('layouts.tabler')
@section('title','Laporan Tagihan')
@section('page-pretitle','Laporan Tagihan')
@section('page-title','Laporan Tagihan')
@section('content')
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form id="frmLaporan" action="/pembayaran/cetak" method="POST" target="_blank">
                    @csrf
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="jenjang" id="jenjang" class="form-select">
                                    <option value="">Jenjang</option>
                                    @foreach ($jenjang as $d)
                                    <option data-tingkat="{{$d->jumlah_tingkat}}" value="{{$d->nama_unit}}">{{$d->nama_unit}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="tingkat" id="tingkat" class="form-select">
                                    <option value="">Tingkat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-md-12">
                                <select name="tahunakademik" id="tahunakademik" class="form-select">
                                    @foreach ($ta as $t)
                                    <option @if ($t['status']==1 ) selected @endif value="{{$t['tahunakademik']}}">
                                        {{$t['tahunakademik']}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary  mb-3"><i class="fa fa-print mr-2"></i> Cetak</button>
                    <button class="btn btn-success  mb-3"><i class="fa fa-file-excel-o mr-2"></i> Export to
                        Excel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('myscript')
<script>
    document.addEventListener("DOMContentLoaded", function() {
      flatpickr(document.getElementById('dari'), {});
      flatpickr(document.getElementById('sampai'), {});
    });
    $(function(){
        $("#jenjang").change(function(){
            var jumlah_tingkat = $('option:selected', this).attr('data-tingkat');
            $.ajax({
                type:'POST',
                url:'/loaddata/gettingkat',
                data:{
                _token: "{{ csrf_token() }}",
                jumlah_tingkat:jumlah_tingkat
                },
                cache:false,
                success:function(respond){
                console.log(respond);
                $("#tingkat").html(respond);
                }
            });
        });
    });
</script>
@endpush
