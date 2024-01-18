@extends('layouts.tabler')
@section('title', 'Data Pembayaran Siswa')
@section('page-pretitle', 'Data Pembayaran Siswa')
@section('page-title', 'Data Pembayaran Siswa')
@section('content')
    <div class="card mt-2">
        <div class="card-body">
            <form action="#" method="GET">
                <div class="row">
                    <div class="col-md-2">
                        <label for="" class="form-label">NIS</label>
                        <div class="form-group">
                            <input type="text" name="nis" class="form-control" placeholder="NIS"
                                value="{{ Request::get('nis') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">Nama Siswa</label>
                        <div class="form-group">
                            <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Siswa"
                                value="{{ Request::get('nama_lengkap') }}">
                        </div>
                    </div>
                    @if ($id_unit != 9)
                        <input type="hidden" data-tingkat = "{{ $unit->jumlah_tingkat }}" id="jenjang" name="jenjang"
                            value="{{ $unit->nama_unit }}">
                    @else
                        <div class="col-md-2">
                            <label for="" class="form-label">Jenjang</label>
                            <div class="form-group">
                                <select name="jenjang" id="jenjang" class="form-select">
                                    <option value="">Jenjang</option>
                                    @foreach ($jenjang as $j)
                                        <option @if (Request::get('jenjang') == $j->nama_unit) selected @endif
                                            data-tingkat={{ $j->jumlah_tingkat }} value="{{ $j->nama_unit }}">
                                            {{ $j->nama_unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-2">
                        <label for="" class="form-label">Tingkat</label>
                        <div class="form-group">
                            <select name="tingkat" id="tingkat" class="form-select">
                                <option value="">Tingkat</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="" class="form-label">Tahun Akademik</label>
                        <div class="form-group">
                            <select name="tahunakademik" id="tahunakademik" class="form-select">
                                @foreach ($takademik as $t)
                                    <option {{ Request('tahunakademik') == $t['tahunakademik'] ? 'selected' : '' }}
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
                            <button class="btn btn-primary" type="submit" name="search" value="search"
                                style="background: #ffb500">
                                <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
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
                    <div class="table-responsive">
                        <table class="table bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>No. Registrasi</th>
                                    <th>NISN</th>
                                    <th>NIS</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenjang</th>
                                    <th>Nama Ayah</th>
                                    <th>Tahun Masuk</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendaftaran as $p)
                                    <tr>
                                        <td>{{ $loop->iteration + $pendaftaran->firstItem() - 1 }}</td>
                                        <td><b>{{ $p->no_pendaftaran }}</b></td>
                                        <td>{{ $p->nisn }}</td>
                                        <td>{{ $p->nis }}</td>
                                        <td>{{ $p->nama_lengkap }}</td>
                                        <td>{{ $p->jenis_kelamin }}</td>
                                        <td>{{ date('d-m-Y', strtotime($p->tanggal_lahir)) }}</td>
                                        <td>{{ $p->jenjang }}</td>
                                        <td>{{ $p->nama_ayah }}</td>
                                        <td>{{ $p->tahunakademik }}</td>
                                        <td>
                                            <a href="/pembayaran/{{ \Crypt::encrypt($p->no_pendaftaran) }}/show"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4" style="float:right">{{ $pendaftaran->links() }}</div>
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
