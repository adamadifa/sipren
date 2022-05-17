@extends('layouts.tabler')
@section('title','Checlist Ibadah Karyawan')
@section('page-pretitle','Checlist Ibadah Karyawan')
@section('page-title','Checlist Ibadah Karyawan')
@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="card-title">Checklist Amalan Riyadhoh</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>NPP</td>
                            <th>{{Auth::guard('karyawan')->user()->npp}}</th>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <th>{{Auth::guard('karyawan')->user()->nama_lengkap}}</th>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>
                                <div class="input-icon mb-2">
                                    <input class="form-control " placeholder="Tanggal" id="tanggal"
                                        value="<?php echo date('Y-m-d') ?>">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                            <line x1="16" y1="3" x2="16" y2="7"></line>
                                            <line x1="8" y1="3" x2="8" y2="7"></line>
                                            <line x1="4" y1="11" x2="20" y2="11"></line>
                                            <line x1="11" y1="15" x2="12" y2="15"></line>
                                            <line x1="12" y1="15" x2="12" y2="18"></line>
                                        </svg>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Kegiatan</th>
                                <th>Checklist</th>
                            </tr>
                        </thead>
                        <tbody id="loadchecklistibadah">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
  flatpickr(document.getElementById('tanggal'), {});
});
</script>


@push('myscript')
<script>
    $(function(){
    function loadchecklistibadah(){
      var tanggal = $("#tanggal").val();
      $.ajax({
          type:'POST',
          url:'/loadchecklistibadah',
          data:{
              _token: "{{ csrf_token() }}",
              tanggal:tanggal
          },
          cache:false,
          success:function(respond){
              $("#loadchecklistibadah").html(respond);
          }
      });
    }

   $("#tanggal").change(function(){
    loadchecklistibadah();
   });
    loadchecklistibadah();
  });
</script>
@endpush
