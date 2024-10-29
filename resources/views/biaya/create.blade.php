@extends('layouts.tabler')
@section('title')
    Atur Biaya TA {{ $ta->tahunakademik }}
@endsection
@section('page-pretitle')
    Atur Biaya TA {{ $ta->tahunakademik }}
@endsection
@section('page-title')
    Atur Biaya TA {{ $ta->tahunakademik }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-2">
                <div class="card-body">
                    <form action="/biaya" method="post" id="frmBiaya">
                        @csrf
                        <input type="hidden" value="{{ $ta->tahunakademik }}" name="tahunakademik" id="tahunakademik">
                        <input type="hidden" id="cektemp">
                        <div class="row">
                            <div class="col">
                                <div class="input-icon mb-2">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/barcode -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                                            <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                                            <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                                            <rect x="5" y="11" width="1" height="2" />
                                            <line x1="10" y1="11" x2="10" y2="13" />
                                            <rect x="14" y="11" width="1" height="2" />
                                            <line x1="19" y1="11" x2="19" y2="13" />
                                        </svg>
                                    </span>
                                    <input type="text" name="kodebiaya" id="kodebiaya" placeholder="Kode Biaya" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <select name="jenjang" id="jenjang" class="form-select">
                                        <option value="">Jenjang</option>
                                        @foreach ($jenjang as $j)
                                            <option data-tingkat={{ $j->jumlah_tingkat }} value="{{ $j->nama_unit }}">{{ $j->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="tingkat" id="tingkat" class="form-select">
                                        <option value="">Tingkat</option>
                                    </select>
                                </div>
                            </div>
                        </div>

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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="loadbiayatemp"></tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary" type="submit" name="submit">
                            <!-- Download SVG icon from http://tabler-icons.io/i/send -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="10" y1="14" x2="21" y2="3" />
                                <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
                            </svg>
                            Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {

            function loadkodebiaya() {
                var tahunakademik = $("#tahunakademik").val();
                var jenjang = $("#jenjang").val();
                var tingkat = $("#tingkat").val();
                var ta1 = tahunakademik.substr(2, 2);
                var ta2 = tahunakademik.substr(7, 2);
                var kodebiaya = "B." + jenjang + "." + ta1 + ta2 + "." + tingkat;
                $("#kodebiaya").val(kodebiaya);
            }

            function loaddatabiaya() {
                var tahunakademik = $("#tahunakademik").val();
                var jenjang = $("#jenjang").val();
                var tingkat = $("#tingkat").val();
                var ta1 = tahunakademik.substr(2, 2);
                var ta2 = tahunakademik.substr(7, 2);
                var kodebiaya = "B." + jenjang + "." + ta1 + ta2 + "." + tingkat;
                $.ajax({
                    type: 'POST',
                    url: '/biaya/showtemp',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodebiaya: kodebiaya
                    },
                    cache: false,
                    success: function(respond) {
                        $("#loadbiayatemp").html(respond);
                    }
                });
            }


            function loadcheckbiaya() {
                var tahunakademik = $("#tahunakademik").val();
                var jenjang = $("#jenjang").val();
                var tingkat = $("#tingkat").val();
                var ta1 = tahunakademik.substr(2, 2);
                var ta2 = tahunakademik.substr(7, 2);
                var kodebiaya = "B." + jenjang + "." + ta1 + ta2 + "." + tingkat;
                $.ajax({
                    type: 'POST',
                    url: '/biaya/cektemp',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodebiaya: kodebiaya
                    },
                    cache: false,
                    success: function(respond) {
                        $("#cektemp").val(respond);
                    }
                });
            }

            loadcheckbiaya();

            $("#jumlah_biaya").maskNumber({
                integer: true,
                thousands: '.'
            });

            $("#jenjang").change(function() {
                loaddatabiaya();
                loadcheckbiaya();
            });

            $("#tingkat").change(function() {
                loaddatabiaya();
                loadcheckbiaya();
            });

            loaddatabiaya();
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
                        url: '/biaya/storetemp',
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
                                loaddatabiaya();
                                loadcheckbiaya();
                            } else if (respond == 2) {
                                swal("Oops", "Data Sudah ada", "warning");
                            } else {
                                swal("Error", "Data Gagal Disimpan", "error");
                            }
                        }
                    });
                }
            });
            $("#tingkat").change(function() {
                loadkodebiaya();
            });
            $("#jenjang").change(function() {
                loadkodebiaya();
                var jumlah_tingkat = $('option:selected', this).attr('data-tingkat');
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/gettingkat',
                    data: {
                        _token: "{{ csrf_token() }}",
                        jumlah_tingkat: jumlah_tingkat
                    },
                    cache: false,
                    success: function(respond) {
                        console.log(respond);
                        $("#tingkat").html(respond);
                    }
                });
            });

            $("#frmBiaya").submit(function(e) {
                var jenjang = $("#jenjang").val();
                var tingkat = $("#tingkat").val();
                var cektemp = $("#cektemp").val();
                if (jenjang == "") {
                    swal('Oops', 'Jenjang Harus dipilih !', "warning");
                    return false;
                } else if (tingkat == "") {
                    swal('Oops', 'Tingkat Harus dipilih !', "warning");
                    return false;
                } else if (cektemp < 1) {
                    swal('Oops', 'Data Masih Kosong !', "warning");
                    return false;
                } else {
                    return true;
                }
            });
        });
    </script>
@endpush
