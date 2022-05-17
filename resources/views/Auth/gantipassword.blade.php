@extends('layouts.tabler')
@section('title','Ganti Password')
@section('page-pretitle','Ganti Password')
@section('page-title','Ganti Password')
@section('content')
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="card-title">Ganti Password</div>
            </div>
            <div class="card-body">
                <form action="/updatepassword" method="POST">
                    @csrf
                    {{-- <label for="" class="form-label">Password Lama</label>
                    <div class="form-group">
                        <input type="text" name="old_password" id="old_password" class="form-control"
                            placeholder="Password Lama">
                    </div> --}}

                    <label for="" class="form-label">Password Baru</label>
                    <div class="form-group">
                        <input type="text" name="new_password" id="new_password" class="form-control"
                            placeholder="Password Baru">
                    </div>
                    <button class="btn btn-primary w-100"><i class="fa fa-refresh mr-2"></i> Ganti Password</button>
                </form>
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
