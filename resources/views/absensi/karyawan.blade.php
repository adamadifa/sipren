@extends('layouts.tabler')
@section('title','Detail Absesni')
@section('page-pretitle','Detail Absensi')
@section('page-title','Detail Absensi')
@section('content')
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="input-icon">
                            <input id="tanggal" type="date" placeholder="Tanggal" class="form-control" name="dari"
                                value="{{date("Y-m-d")}}" />
                            <span class="input-icon-addon"><svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <rect x="4" y="5" width="16" height="16" rx="2" />
                                    <line x1="16" y1="3" x2="16" y2="7" />
                                    <line x1="8" y1="3" x2="8" y2="7" />
                                    <line x1="4" y1="11" x2="20" y2="11" />
                                    <line x1="11" y1="15" x2="12" y2="15" />
                                    <line x1="12" y1="15" x2="12" y2="18" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" id="tampilkan"> <i class="fa fa-tv mr-2"></i>Tampilkan</button>
                <button class="btn btn-success" id="export"> <i class="fa fa-download mr-2"></i>Export</button>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" id="loaddetailabsensi">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-location">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="iframe-map"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

@push('myscript')
<script>
    document.addEventListener("DOMContentLoaded", function() {
      flatpickr(document.getElementById('tanggal'), {});
    });
</script>
<script>
    $(document).on('click', '.btn-lokasi', function(){
        $("#modal-location").modal("show");
        var address = $(this).attr("data-address");
        var nama = $(this).attr("data-nama");
        var radar = address.split(",");
        var latitude = radar[0];
        var longitude = radar[1];
        $.ajax({
            type:'POST',
            url:'/loaddata/map_frame',
            data:{
                _token: "{{ csrf_token() }}",
                nama:nama,
                latitude:latitude,
                longitude:longitude
            },
            cache:false,
            success:function(respond){
                $("#iframe-map").html(respond);
            }
        });


    });
    $(function(){
        function loaddetailabsensi(){
            var tanggal = $("#tanggal").val();

            $.ajax({

                type :'POST',
                url:'/loaddata/getabsensiharian',
                data:{ _token: "{{ csrf_token() }}",tanggal:tanggal},
                cache:false,
                success:function(respond){
                    console.log(respond);
                    $("#loaddetailabsensi").html(respond);
                }
            });

        }

        loaddetailabsensi();

        $("#tanggal").change(function(){
            loaddetailabsensi();
        });
    });
</script>
@endpush
