@extends('layouts.tabler')
@section('title', 'Dashboard')
@section('page-pretitle', 'Dashboard')
@section('page-title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-red text-white avatar">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ $jmlkaryawan }}
                            </div>
                            <div class="text-muted">
                                Data Karyawan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="bg-warning text-white avatar">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="col">
                            <div class="font-weight-medium">
                                {{ $jmlsiswa }}
                            </div>
                            <div class="text-muted">
                                Data Siswa
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Jenis Kelamin</div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered tablestriped">
                        <thead class="thead-dark">
                            <tr style="text-align: center">
                                <th>Jenis Kelamin</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jk as $j)
                                @if (empty($j->jenis_kelamin))
                                    @php
                                        $jk = 'Belum Diisi';
                                    @endphp
                                @else
                                    @php
                                        $jk = $j->jenis_kelamin;
                                    @endphp
                                @endif

                                @php
                                    $jkelamin[] = $jk;
                                    $jkelamindata[] = $j->jmldata;
                                @endphp
                                <tr>
                                    <td align="center">{{ $jk }}</td>
                                    <td align="center">{{ $j->jmldata }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Golongan Darah</div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered tablestriped">
                        <thead class="thead-dark">
                            <tr style="text-align: center">
                                <th>Golongan Darah</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($goldar as $g)
                                @if (empty($g->golongan_darah))
                                    @php
                                        $gol = 'Belum Diisi';
                                    @endphp
                                @else
                                    @php
                                        $gol = $g->golongan_darah;
                                    @endphp
                                @endif
                                <tr>
                                    <td align="center">{{ $gol }}</td>
                                    <td align="center">{{ $g->jmldata }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Status Kepegawaian</div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered tablestriped">
                        <thead class="thead-dark">
                            <tr style="text-align: center">
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sk as $s)
                                @if (empty($s->status_kepegawaian))
                                    @php
                                        $status = 'Belum Diisi';
                                    @endphp
                                @else
                                    @php
                                        $status = $s->status_kepegawaian;
                                    @endphp
                                @endif
                                <tr>
                                    <td align="center">{{ $status }}</td>
                                    <td align="center">{{ $s->jmldata }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Unit</div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered tablestriped">
                        <thead class="thead-dark">
                            <tr style="text-align: center">
                                <th>Unit</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unit as $u)
                                @if (empty($u->id_unit))
                                    @php
                                        $namaunit = 'Belum Diisi';
                                    @endphp
                                @else
                                    @php
                                        $namaunit = $u->nama_unit;
                                    @endphp
                                @endif
                                <tr>
                                    <td align="center">{{ $namaunit }}</td>
                                    <td align="center">{{ $u->jmldata }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


@endsection
