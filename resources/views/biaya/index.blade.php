@extends('layouts.tabler')
@section('title', 'Biaya / Tahun Akademik')
@section('page-pretitle', 'Biaya / Tahun Akademik')
@section('page-title', 'Biaya / Tahun Akademik')


@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card mt-2">
                <div class="card-body">
                    @include('layouts.notification')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col">
                                    <a href="/biaya/create" class="btn btn-primary mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="12" y1="5" x2="12" y2="19" />
                                            <line x1="5" y1="12" x2="19" y2="12" />
                                        </svg>
                                        Tambah Data
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="tahunakademik" id="tahunakademik" class="form-select">
                                            @foreach ($ta as $t)
                                                <option @if ($t['status'] == 1) selected @endif value="{{ $t['tahunakademik'] }}">
                                                    {{ $t['tahunakademik'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($id_unit != 9)
                                        <input type="hidden" id="jenjang" name="jenjang" value="{{ $unit->nama_unit }}" />
                                    @else
                                        <div class="form-group">
                                            <select name="jenjang" id="jenjang" class="form-select">
                                                <option value="">Jenjang</option>
                                                @foreach ($jenjang as $j)
                                                    <option data-tingkat={{ $j->jumlah_tingkat }} value="{{ $j->nama_unit }}">
                                                        {{ $j->nama_unit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-boredered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Kode Biaya</th>
                                    <th>Jenjang</th>
                                    <th>Tingkat</th>
                                    <th>Tahun Akademik</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody id="loadbiaya">

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
        $(function() {
            function loadbiaya() {
                var tahunakademik = $("#tahunakademik").val();
                var jenjang = $("#jenjang").val();

                $.ajax({
                    type: 'POST',
                    url: '/loaddata/getbiaya',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tahunakademik: tahunakademik,
                        jenjang: jenjang,
                    },

                    cache: false,
                    success: function(respond) {
                        $("#loadbiaya").html(respond);

                    }
                });
            }

            loadbiaya();
            $("#tahunakademik").change(function() {
                loadbiaya();
            });
            $("#jenjang").change(function() {
                loadbiaya();
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

        });
    </script>
@endpush
