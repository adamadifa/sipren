@extends('layouts.tabler')
@section('title', 'Data Pendaftaran Online')
@section('page-pretitle', 'Data Pendaftaran Online')
@section('page-title', 'Data Pendaftaran Online')
@section('content')
    <div class="card mt-2">
        <div class="card-body">
            <form action="#" method="GET">
                <div class="row">
                    <div class="col-md-2">
                        <label for="" class="form-label">Nama Pendaftar</label>
                        <div class="form-group">
                            <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Siswa"
                                value="{{ Request::get('nama_lengkap') }}">
                        </div>
                    </div>

                    {{-- <input type="hidden" data-tingkat = "{{ $unit->jumlah_tingkat }}" id="jenjang" name="jenjang" value="{{ $unit->nama_unit }}"> --}}

                    <div class="col-md-2">
                        <label for="" class="form-label">Jenjang</label>
                        <div class="form-group">
                            <select name="jenjang" id="jenjang" class="form-select">
                                <option value=""> Semua Jenjang</option>
                                @foreach ($jenjang as $j)
                                    <option @if (Request::get('jenjang') == $j->nama_unit) selected @endif data-tingkat={{ $j->jumlah_tingkat }}
                                        value="{{ $j->nama_unit }}">
                                        {{ $j->nama_unit }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">Tahun Akademik</label>
                        <div class="form-group">
                            <select name="tahunakademik" id="tahunakademik" class="form-select">
                                @foreach ($tahunakademik as $t)
                                    <option
                                        @if (!empty(Request('tahunakademik'))) @if ($t['tahunakademik'] == Request('tahunakademik'))
                                                selected @endif
                                    @else @if ($ta['tahunakademik'] == $t['tahunakademik']) selected @endif @endif
                                        value="{{ $t['tahunakademik'] }}">
                                        {{ $t['tahunakademik'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label" style="color:transparent">Cari Data</label>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="search" value="search" style="background: #ffb500">
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="10" cy="10" r="7" />
                                    <line x1="21" y1="21" x2="15" y2="15" />
                                </svg>
                                Cari Data
                            </button>
                        </div>
                    </div>
                </div>

            </form>
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.notification')
                    <div class="table-responsive">
                        <table class="table bordered table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>No. Pendaftar</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tgl Lahir</th>
                                    <th>Jenjang</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Jumlah</th>
                                    <th>Bukti</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendaftaran as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->no_pendaftaran }}</td>
                                        <td>{{ $p->nama_lengkap }}</td>
                                        <td>{{ $p->jenis_kelamin }}</td>
                                        <td>{{ date('d-m-Y', strtotime($p->tanggal_lahir)) }}</td>
                                        <td>{{ $p->jenjang }}</td>
                                        <td>{{ $p->tahunakademik }}</td>
                                        <td style="text-align: right">{{ number_format($p->biaya_pendaftaran, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $p->no_pendaftaran . '.jpg') }}" target="_blank">Lihat Bukti</a>
                                        </td>
                                        <td>
                                            @if (!empty($p->no_pendaftaran_online))
                                                <span class="badge bg-success">Diterima</span>
                                            @else
                                                <span class="badge bg-danger">Belum Diterima</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($p->no_pendaftaran_online))
                                                <a href="#" class="btn btn-danger btn-sm">Batalkan</a>
                                            @else
                                                <a href="/pendaftaranonline/{{ Crypt::encrypt($p->no_pendaftaran) }}/proses"
                                                    class="btn btn-success btn-sm"><i class="fa fa-external-link mr-2"></i> Proses
                                                    Terima</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- <div class="mt-4" style="float:right">{{ $pendaftaran->links() }}</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            function loadtingkat() {
                var jumlah_tingkat = $('#jenjang option:selected').attr('data-tingkat');
                if (jumlah_tingkat == undefined) {
                    jumlah_tingkat = $("#jenjang").attr("data-tingkat");
                }
                var tingkat = "{{ Request::get('tingkat') }}";
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/gettingkat',
                    data: {
                        _token: "{{ csrf_token() }}",
                        jumlah_tingkat: jumlah_tingkat,
                        tingkat: tingkat
                    },
                    cache: false,
                    success: function(respond) {
                        console.log(respond);
                        $("#tingkat").html(respond);
                    }
                });
            }
            loadtingkat();
            $("#jenjang").change(function() {
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
