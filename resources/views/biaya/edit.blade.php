@extends('layouts.tabler')
@section('title')
    Edit Biaya TA {{ $biaya->tahunakademik }}
@endsection
@section('page-pretitle')
    Edit Biaya TA {{ $biaya->tahunakademik }}
@endsection
@section('page-title')
    Edit Biaya TA {{ $biaya->tahunakademik }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-2">
                <div class="card-body">

                    @csrf
                    <input type="hidden" value="{{ $biaya->tahunakademik }}" name="tahunakademik" id="tahunakademik">
                    <input type="hidden" name="kodebiaya" id="kodebiaya" placeholder="Kode Biaya" class="form-control" value="{{ $biaya->kodebiaya }}">
                    <input type="hidden" name="jenjang" id="jenjang" placeholder="Jenjang" class="form-control" value="{{ $biaya->jenjang }}">
                    <input type="hidden" name="tingkat" id="tingkat" placeholder="Tingkat" class="form-control" value="{{ $biaya->jenjang }}">

                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Kode Biaya</th>
                            <td>{{ $biaya->kodebiaya }}</td>
                        </tr>
                        <tr>
                            <th>Jenjang</th>
                            <td>{{ $biaya->jenjang }}</td>
                        </tr>
                        <tr>
                            <th>Tingkat</th>
                            <td>{{ $biaya->tingkat }}</td>
                        </tr>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <select name="jenisbayar" id="jenisbayar" class="form-select">
                                <option value="">Jenis Biaya</option>
                                @foreach ($jb as $d)
                                    <option value="{{ $d->id }}">{{ $d->jenisbayar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/report-money -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                        <rect x="9" y="3" width="6" height="4" rx="2" />
                                        <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                        <path d="M12 17v1m0 -8v1" />
                                    </svg>
                                </span>
                                <input type="text" name="jumlah_biaya" id="jumlah_biaya" style="text-align: right" placeholder="Jumlah Biaya"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="btn btn-primary" id="tambahkan">
                                <!-- Download SVG icon from http://tabler-icons.io/i/layout-grid-add -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <rect x="4" y="4" width="6" height="6" rx="1" />
                                    <rect x="14" y="4" width="6" height="6" rx="1" />
                                    <rect x="4" y="14" width="6" height="6" rx="1" />
                                    <path d="M14 17h6m-3 -3v6" />
                                </svg>
                                Tambahkan</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Biaya</th>
                                    <th>Jumlah Biaya</th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody id="loadbiaya"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $("#jumlah_biaya").maskNumber({
                integer: true,
                thousands: '.'
            });

            function loaddetailbiaya() {
                var kodebiaya = $("#kodebiaya").val();
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/getdetailbiaya',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodebiaya: kodebiaya
                    },

                    cache: false,
                    success: function(respond) {
                        $("#loadbiaya").html(respond);
                    }
                });
            }

            loaddetailbiaya();

            $("#tambahkan").click(function(e) {
                e.preventDefault();
                var kodebiaya = $("#kodebiaya").val();
                var jenjang = $("#jenjang").val();
                var tingkat = $("#tingkat").val();
                var jenisbayar = $("#jenisbayar").val();
                var jumlah_biaya = $("#jumlah_biaya").val();

                if (jenjang == "") {
                    swal('Oops', 'Jenjang Harus dipilih !', "warning");
                } else if (tingkat == "") {
                    swal('Oops', 'Tingkat Harus dipilih !', "warning");
                } else if (jenisbayar == "") {
                    swal('Oops', 'Jenis Biaya Harus dipilih !', "warning");
                } else if (jumlah_biaya == "") {
                    swal('Oops', 'Jumlah Biaya Harus diisi !', "warning");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/biaya/storedetail',
                        data: {
                            _token: "{{ csrf_token() }}",
                            kodebiaya: kodebiaya,
                            jenisbayar: jenisbayar,
                            jumlah_biaya: jumlah_biaya
                        },
                        cache: false,
                        success: function(respond) {

                            if (respond == 1) {
                                swal("Berhasil", "Data Berhasil Disimpan", "success");
                                loaddetailbiaya();
                            } else if (respond == 2) {
                                swal("Oops", "Data Sudah ada", "warning");
                            } else {
                                swal("Error", "Data Gagal Disimpan", "error");
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
