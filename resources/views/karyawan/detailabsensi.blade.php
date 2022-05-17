@extends('layouts.tabler')
@section('title','Detail Absesni')
@section('page-pretitle','Detail Absensi')
@section('page-title','Detail Absensi')
@section('content')
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>NPP</th>
                        <td>{{$karyawan->npp}}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{$karyawan->nama_lengkap}}</td>
                    </tr>
                </table>
                <div class="form-group">
                    {{-- <label for="" class="form-label">Bulan</label> --}}
                    <select name="bulan" id="bulan" class="form-select">
                        <option value="">Bulan</option>
                        @for ($i = 1; $i <=12; $i++) <option @if ($i==date("m")) selected @endif value={{$i}}>
                            {{$namabulan[$i]}}</option>
                            @endfor
                    </select>
                </div>
                <div class="form-group">
                    {{-- <label for="" class="form-label">Bulan</label> --}}
                    <select name="tahun" id="tahun" class="form-select">
                        <option value="">Tahun</option>
                        @for ($thn = $tahunmulai; $thn <= date("Y"); $thn++) <option @if ($thn==date("Y")) selected @endif value={{$thn}}>{{$thn}}
                            </option>
                            @endfor
                    </select>
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
            <div class="card-body">
                <table class="table bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Hari/Tanggal</th>
                            <th><i class="fa fa-image"></i></th>
                            <th>Jam Masuk</th>
                            <th><i class="fa fa-image"></i></th>
                            <th>Jam Pulang</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody id="loaddetailabsensi">
                    </tbody>
                </table>
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
    $(function() {
        function loaddetailabsensi() {
            var npp = "{{$karyawan->npp}}";
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();

            $.ajax({

                type: 'POST'
                , url: '/loaddata/getabsensikaryawan'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , npp: npp
                    , bulan: bulan
                    , tahun: tahun
                }
                , cache: false
                , success: function(respond) {
                    console.log(respond);
                    $("#loaddetailabsensi").html(respond);
                }
            });

        }

        loaddetailabsensi();
    });

</script>
@endpush
