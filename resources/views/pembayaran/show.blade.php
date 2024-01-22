@extends('layouts.tabler')
@section('title', 'Detail Pembayaran')
@section('page-pretitle', 'Detail Pembayaran')
@section('page-title', 'Detail Pembayaran')
@section('content')
    <div class="row mt-3">
        @include('layouts.notification')
        <div class="col-md-3">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3 avatar-rounded">JL</span>
                    <h3 class="m-0 mb-1"><a href="#">{{ $pembayaran->nama_lengkap }}</a></h3>
                    <div class="text-muted">{{ $pembayaran->nisn }}</div>
                    <div class="mt-3">
                        <span class="badge bg-green-lt">Kelas {{ $tk }}</span>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="#" class="card-btn" style="background-color:#09482f; color:white">
                        <!-- Download SVG icon from http://tabler-icons.io/i/camera -->
                        <svg xmlns='http://www.w3.org/2000/svg' class='icon me-2' width='24' height='24'
                            viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round'
                            stroke-linejoin='round'>
                            <path stroke='none' d='M0 0h24v24H0z' fill='none' />
                            <path
                                d='M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2' />
                            <circle cx='12' cy='13' r='3' />
                        </svg>
                        Ganti Foto
                    </a>
                    <a href="/pendaftaran/{{ $pembayaran->jenjang }}/{{ $pembayaran->no_pendaftaran }}/edit"
                        class="card-btn" style="background-color: #ffb500; color:white ">
                        <!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                        <!-- Download SVG icon from http://tabler-icons.io/i/pencil -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                            <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                        </svg>
                        Edit Data
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="card">
                    <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                        <li class="nav-item">
                            <a href="#tabs-profile-16" class="nav-link active" data-bs-toggle="tab">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                </svg>
                                Profil Siswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-activity-16" class="nav-link" data-bs-toggle="tab">
                                <!-- Download SVG icon from http://tabler-icons.io/i/users -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                                Data Orangtua
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tabs-pendaftaran-16" class="nav-link" data-bs-toggle="tab">
                                <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    <line x1="9" y1="9" x2="10" y2="9" />
                                    <line x1="9" y1="13" x2="15" y2="13" />
                                    <line x1="9" y1="17" x2="15" y2="17" />
                                </svg>
                                Data Pendaftaran
                            </a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane show active" id="tabs-profile-16">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width:30%">NISN</th>
                                        <td>{{ $pembayaran->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>{{ strtoupper($pembayaran->nama_lengkap) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ strtoupper($pembayaran->jenis_kelamin) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat / Tanggal Lahir</th>
                                        <td>{{ strtoupper($pembayaran->tempat_lahir) }} /
                                            {{ date('d-m-Y', strtotime($pembayaran->tanggal_lahir)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Anak Ke</th>
                                        <td>{{ $pembayaran->anak_ke }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Saudara</th>
                                        <td>{{ $pembayaran->jml_saudara }}</td>
                                    </tr>

                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $pembayaran->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Propinsi</th>
                                        <td>{{ $pembayaran->prov_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kota</th>
                                        <td>{{ $pembayaran->regc_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <td>{{ $pembayaran->dist_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelurahan/Desa</th>
                                        <td>{{ $pembayaran->vill_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Pos</th>
                                        <td>{{ $pembayaran->kodepos }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane" id="tabs-activity-16">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width:30%">No. KK</th>
                                        <td>{{ $pembayaran->no_kk }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td>{{ strtoupper($pembayaran->nik_ayah) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ayah</th>
                                        <td>{{ strtoupper($pembayaran->nama_ayah) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pendidikan</th>
                                        <td>{{ $pembayaran->pendidikan_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>{{ $pembayaran->pekerjaan_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td>{{ strtoupper($pembayaran->nik_ibu) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ibu</th>
                                        <td>{{ strtoupper($pembayaran->nama_ibu) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pendidikan</th>
                                        <td>{{ $pembayaran->pendidikan_ibu }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>{{ $pembayaran->pekerjaan_ibu }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. HP</th>
                                        <td>{{ $pembayaran->no_hp_ortu }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tab-pane" id="tabs-pendaftaran-16">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width:30%">No. Pendaftaran</th>
                                        <td>{{ $pembayaran->no_pendaftaran }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pendaftaran</th>
                                        <td>{{ date('d-m-Y', strtotime($pembayaran->tgl_pendaftaran)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIS</th>
                                        <td>{{ $pembayaran->nis }}</td>
                                    </tr>
                                    <tr>
                                        <th>NPSN</th>
                                        <td>{{ $pembayaran->npsn }}</td>
                                    </tr>
                                    <tr>
                                        <th>Asal Sekolah</th>
                                        <td>{{ $pembayaran->asal_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Peserta Ujian</th>
                                        <td>{{ $pembayaran->nomor_peserta_ujian }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. Ijazah</th>
                                        <td>{{ $pembayaran->no_ijazah }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. SHUN</th>
                                        <td>{{ $pembayaran->no_shun }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rata Rata Nilai US</th>
                                        <td>{{ $pembayaran->nilai_us }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lulus</th>
                                        <td>
                                            @if (!empty($pembayaran->tanggal_lulus))
                                                {{ date('d-m-Y', strtotime($pembayaran->tanggal_lulus)) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Angkatan</th>
                                        <td>{{ $pembayaran->tahunakademik }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Rincian Pembayaran </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <button id="refreshpage" class="btn btn-primary"><i class="fa fa-history mr-2"></i>
                            Refresh</button>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <select name="tahunakademik" id="tahunakademik" class="form-select">
                                @foreach ($tahunakademik as $t)
                                    <option @if ($t->tahunakademik == $ta_aktif->tahunakademik) selected @endif
                                        value="{{ $t->tahunakademik }}">{{ $t->tahunakademik }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <table class="table table-striped table-bordered table-hover" style="font-size:11px">
                            <thead class="thead-dark">
                                <tr>
                                    <th rowspan="2">Jenis Biaya</th>
                                    <th style="text-align: center; background-color:#780518" colspan="3">TAGIHAN</th>
                                    <th style="text-align: center;" colspan="3">PEMBAYARAN</th>
                                    <th style="text-align: center" rowspan="2">Sisa</th>
                                </tr>
                                <tr>
                                    <th style="text-align: right; background-color:#780518">Tagihan</th>
                                    <th style="text-align: right; background-color:#780518">Peny</th>
                                    <th style="text-align: right; background-color:#780518">Total</th>
                                    <th style="text-align: right">Mutasi</th>
                                    <th style="text-align: right">Bayar</th>
                                    <th style="text-align: right">Total</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grandtotaltagihan = 0;
                                    $grandtotalpotongan = 0;
                                    $grandtotalalltagihan = 0;

                                    $grandtotalmutasi = 0;
                                    $grandtotalbayar = 0;
                                    $grandtotalallbayar = 0;
                                    $grandtotalsisa = 0;
                                    $tahun_akademik = '';

                                    $totaltagihanperjenjang = 0;
                                    $totalpotonganperjenjang = 0;
                                    $grandtotaltagihanperjenjang = 0;

                                    $totalmutasiperjenjang = 0;
                                    $totalbayarperjenjang = 0;
                                    $grandtotalbayarperjenjang = 0;
                                    $totalsisaperjenjang = 0;

                                    $totaltagihanperta = 0;
                                    $totalpotonganperta = 0;
                                    $grandtotaltagihanperta = 0;

                                    $totalmutasiperta = 0;
                                    $totalbayarperta = 0;
                                    $grandtotalbayarperta = 0;
                                    $totalsisaperta = 0;
                                    $jj = 0;
                                @endphp
                                @foreach ($databiaya as $key => $d)

                                    @php
                                        if ($tahun_akademik != $d->tahunakademik) {
                                            echo "<tr style='background-color:#ffb500;'>
                                <th colspan='8'>BIAYA TAHUN AJARAN " .
                                                $d->tahunakademik .
                                                "</th>
                            </tr>";
                                        }
                                        $t_akademik = @$databiaya[$key + 1]->tahunakademik;
                                        $j = @$databiaya[$key + 1]->jenjang;
                                    @endphp
                                    @if (
                                        $d->jenisbayar == 'Pendaftaran' ||
                                            $d->jenisbayar == 'SPP' ||
                                            $d->jenisbayar == 'PAS' ||
                                            $d->jenisbayar == 'PAT' ||
                                            $d->jenisbayar == 'Registrasi Ulang')
                                        @php
                                            $ta = $d->tahunakademik;
                                        @endphp
                                    @else
                                        @php
                                            $ta = '';
                                        @endphp
                                    @endif

                                    @if ($d->jenjang == 'ASRAMA')
                                        @php
                                            $jenjang = $d->jenjang;
                                        @endphp
                                    @else
                                        @php
                                            $jenjang = '';
                                        @endphp
                                    @endif

                                    @if ($d->jenisbayar == 'SPP')
                                        @php
                                            $jmlbulan = '( x 12)';
                                            $jmlbiaya = $d->jml_rencana_spp;
                                            $jmlmutasi = $d->jml_mutasi_spp;
                                        @endphp
                                    @elseif($d->jenisbayar == 'Uang Lauk')
                                        @php
                                            $jmlbulan = '( x 12)';
                                            $jmlbiaya = $d->jml_rencana_um;
                                            $jmlmutasi = $d->jml_mutasi_um;
                                        @endphp
                                    @else
                                        @php
                                            $jmlbulan = '';
                                            $jmlbiaya = $d->jumlah_biaya;
                                            $jmlmutasi = $d->jumlah_mutasi;
                                        @endphp
                                    @endif

                                    @php
                                        $sisa = $jmlbiaya - $d->jumlah_potongan - $d->totalbayar - $jmlmutasi;
                                        $totaltagihan = $jmlbiaya - $d->jumlah_potongan;
                                        // $totalpotongan = $totalpotongan+= $d->jumlah_potongan;
                                        $totalbayar = $d->totalbayar + $jmlmutasi;
                                        // $totalsisa = $totalsisa+= $sisa;

                                        $totaltagihanperjenjang += $jmlbiaya;
                                        $totalpotonganperjenjang += $d->jumlah_potongan;
                                        $grandtotaltagihanperjenjang += $totaltagihan;

                                        $totalmutasiperjenjang += $jmlmutasi;
                                        $totalbayarperjenjang += $d->totalbayar;
                                        $grandtotalbayarperjenjang += $totalbayar;
                                        $totalsisaperjenjang += $sisa;

                                        $totaltagihanperta += $jmlbiaya;
                                        $totalpotonganperta += $d->jumlah_potongan;
                                        $grandtotaltagihanperta += $totaltagihan;

                                        $totalmutasiperta += $jmlmutasi;
                                        $totalbayarperta += $d->totalbayar;
                                        $grandtotalbayarperta += $totalbayar;
                                        $totalsisaperta += $sisa;

                                        $grandtotaltagihan += $jmlbiaya;
                                        $grandtotalpotongan += $d->jumlah_potongan;
                                        $grandtotalalltagihan += $totaltagihan;

                                        $grandtotalmutasi += $jmlmutasi;
                                        $grandtotalbayar += $d->totalbayar;
                                        $grandtotalallbayar += $totalbayar;
                                        $grandtotalsisa += $sisa;

                                    @endphp
                                    <tr>
                                        <td>{{ $d->jenisbayar }} {{ $jenjang }} <b>{{ $ta }}</b>
                                            {{ $jmlbulan }}</td>
                                        <td align="right" style="font-weight: bold">
                                            {{ number_format($jmlbiaya, '0', '', '.') }}</td>
                                        <td align="right" style="font-weight: bold">
                                            @if (!empty($d->jumlah_potongan))
                                                <a href="#" class="editpotongan"
                                                    data-jenisbiaya="{{ $d->jenisbayar }} {{ $jenjang }} {{ $ta }}"
                                                    data-kodebiaya="{{ $d->kodebiaya }}"
                                                    data-idjenisbayar="{{ $d->id_jenisbayar }}"
                                                    data-jumlahpotongan="
                                        {{ number_format($d->jumlah_potongan, '0', '', '.') }}">{{ number_format($d->jumlah_potongan, '0', '', '.') }}</a>
                                            @else
                                                @if ($d->jenisbayar == 'SPP')
                                                    @if (!empty($d->no_rencana_spp))
                                                        <a href="#" data-norencanaspp="{{ $d->no_rencana_spp }}"
                                                            class="btn btn-success btn-sm editspp">Edit SPP</a>
                                                    @else
                                                        <a href="/generatespp/{{ \Crypt::encrypt($pembayaran->no_pendaftaran) }}/{{ \Crypt::encrypt($d->kodebiaya) }}"
                                                            class="btn btn-primary btn-sm">Generate SPP</a>
                                                    @endif
                                                @elseif($d->jenisbayar == 'Uang Lauk')
                                                    @php
                                                        $no_rencana_uanglauk = '';
                                                    @endphp
                                                    @if (!empty($d->no_rencana_um))
                                                        <a href="#" data-norencanaum="{{ $d->no_rencana_um }}"
                                                            class="btn btn-success btn-sm edituangmakan">Edit Uang Lauk</a>
                                                    @else
                                                        <a href="/generateuangmakan/{{ \Crypt::encrypt($pembayaran->no_pendaftaran) }}/{{ \Crypt::encrypt($d->kodebiaya) }}"
                                                            class="btn btn-primary btn-sm">Generate</a>
                                                    @endif
                                                @else
                                                    <a href="#" class="btn btn-sm btn-danger tambahpotongan"
                                                        data-jenisbiaya="{{ $d->jenisbayar }} {{ $jenjang }} {{ $ta }}"
                                                        data-kodebiaya="{{ $d->kodebiaya }}"
                                                        data-idjenisbayar="{{ $d->id_jenisbayar }}"><i
                                                            class="fa fa-gears"></i></a>
                                                @endif
                                            @endif

                                        </td>
                                        <td class="text-right" style="font-weight:bold; color:red">
                                            @php
                                                $totaltagihan = $jmlbiaya - $d->jumlah_potongan;
                                            @endphp
                                            {{ number_format($totaltagihan, '0', '', '.') }}
                                        </td>
                                        <td class="text-right" style="font-weight: bold">
                                            @if (!empty($jmlmutasi))
                                                <a href="#" class="editmutasi"
                                                    data-jenisbiaya="{{ $d->jenisbayar }} {{ $jenjang }} {{ $ta }}"
                                                    data-kodebiaya="{{ $d->kodebiaya }}"
                                                    data-idjenisbayar="{{ $d->id_jenisbayar }}"
                                                    data-jumlahmutasi="
                                        {{ number_format($jmlmutasi, '0', '', '.') }}"
                                                    data-norencanaspp="{{ $d->no_rencana_spp }}"
                                                    data-norencanaum="{{ $d->no_rencana_um }}">{{ number_format($jmlmutasi, '0', '', '.') }}</a>
                                            @else
                                                <a href=" #" class="btn btn-sm btn-primary inputmutasi"
                                                    data-jenisbiaya="{{ $d->jenisbayar }} {{ $jenjang }} {{ $ta }}"
                                                    data-kodebiaya="{{ $d->kodebiaya }}"
                                                    data-idjenisbayar="{{ $d->id_jenisbayar }}"
                                                    data-norencanaspp="{{ $d->no_rencana_spp }}"
                                                    data-norencanaum="{{ $d->no_rencana_um }}"><i
                                                        class=" fa fa-book"></i></a>
                                            @endif
                                        </td>
                                        <td align="right" style="font-weight: bold;color:green">
                                            {{ !empty($d->totalbayar) ? number_format($d->totalbayar, '0', '', '.') : '' }}
                                        </td>
                                        <td class="text-right" style="font-weight:bold; color:green">
                                            @php
                                                $totalbayar = $jmlmutasi + $d->totalbayar;
                                            @endphp
                                            {{ !empty($totalbayar) ? number_format($totalbayar, '0', '', '.') : '' }}
                                        </td>
                                        <td align="right" style="font-weight: bold;color:red">
                                            {{ number_format($totaltagihan - $totalbayar, '0', '', '.') }}
                                        </td>

                                    </tr>
                                    @php
                                        if ($j != $d->jenjang) {
                                            echo "<tr class='thead-dark'>
                                <th>TOTAL " .
                                                $d->jenjang .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($totaltagihanperjenjang, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($totalpotonganperjenjang, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($grandtotaltagihanperjenjang, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($totalmutasiperjenjang, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($totalbayarperjenjang, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($grandtotalbayarperjenjang, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($totalsisaperjenjang, '0', '', '.') .
                                                "</th>
                            </tr>";
                                            $totaltagihanperjenjang = 0;
                                            $totalpotonganperjenjang = 0;
                                            $grandtotaltagihanperjenjang = 0;

                                            $totalmutasiperjenjang = 0;
                                            $totalbayarperjenjang = 0;
                                            $grandtotalbayarperjenjang = 0;
                                            $totalsisaperjenjang = 0;
                                        }
                                        if ($t_akademik != $d->tahunakademik) {
                                            echo "<tr style='background-color:#ffb500'>
                                <th>TOTAL " .
                                                $d->tahunakademik .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($totaltagihanperta, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($totalpotonganperta, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($grandtotaltagihanperta, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($totalmutasiperta, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($totalbayarperta, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($grandtotalbayarperta, '0', '', '.') .
                                                "</th>
                                <th style='text-align:right'>" .
                                                number_format($totalsisaperta, '0', '', '.') .
                                                "</th>
                            </tr>";
                                            $totaltagihanperta = 0;
                                            $totalpotonganperta = 0;
                                            $grandtotaltagihanperta = 0;

                                            $totalmutasiperta = 0;
                                            $totalbayarperta = 0;
                                            $grandtotalbayarperta = 0;
                                            $totalsisaperta = 0;
                                        }
                                        $tahun_akademik = $d->tahunakademik;
                                        $jj = $d->jenjang;
                                    @endphp

                                @endforeach

                                <tr style="background-color:#ffb500">
                                    <th>TOTAL</th>
                                    <th style="text-align: right">
                                        {{ number_format($grandtotaltagihan, '0', '', '.') }}
                                    </th>
                                    <th style="text-align: right">
                                        {{ number_format($grandtotalpotongan, '0', '', '.') }}
                                    </th>
                                    <th style="text-align: right">
                                        {{ number_format($grandtotalalltagihan, '0', '', '.') }}
                                    </th>
                                    <th style="text-align: right">
                                        {{ number_format($grandtotalmutasi, '0', '', '.') }}
                                    </th>
                                    <th style="text-align: right">
                                        {{ number_format($grandtotalbayar, '0', '', '.') }}
                                    </th>
                                    <th style="text-align: right">
                                        {{ number_format($grandtotalallbayar, '0', '', '.') }}
                                    </th>
                                    <th style="text-align: right">
                                        {{ number_format($grandtotalsisa, '0', '', '.') }}
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-striped table-hover mb-3" style="font-size:11px">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="4">SPP BULANAN</th>
                                        </tr>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Tagihan</th>
                                            <th>Bayar</th>
                                            <th>Tunggakan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadspp"></tbody>

                                </table>

                            </div>
                            <div class="col-md-6">
                                <table class="table table-striped table-hover mb-3" style="font-size:11px">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="4">SPP ASRAMA</th>
                                        </tr>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Tagihan</th>
                                            <th>Bayar</th>
                                            <th>Tunggakan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="loadsppasrama"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="4">Histori Pembayaran</th>
                                            <th><a href="#" style="float: right;" class="btn btn-primary bayar"><i
                                                        class="fa fa-money mr-3"></i>Bayar</a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>No. Transaksi</th>
                                            <th>Tanggal</th>
                                            <th style="text-align: right">Jumlah</th>
                                            <th>Petugas</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($historibayar as $d)
                                            <tr>
                                                <td>{{ $d->no_transaksi }}</td>
                                                <td>{{ date('d-m-Y', strtotime($d->tgl_transaksi)) }}</td>
                                                <td style="text-align: right">
                                                    {{ number_format($d->totalbayar, '0', '', '.') }}</td>
                                                <td>{{ $d->name }}</td>

                                                <td>
                                                    <a href="/cetakkwitansi/{{ $d->no_transaksi }}" target="_blank"
                                                        class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a>
                                                    <a href="/pembayaran/{{ $d->no_transaksi }}/{{ $pembayaran->no_pendaftaran }}/hapus"
                                                        class="btn btn-sm btn-danger" onclick="confirmation(event)"><i
                                                            class="fa fa-trash-o"></i></a>
                                                    <a href="#" class="btn btn-success btn-sm detail"
                                                        data-notransaksi="{{ $d->no_transaksi }}">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-bayar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 860px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmBayar" action="/pembayaran" method="POST">
                        @csrf
                        <input type="hidden" name="kodebiaya" id="kodebiaya">
                        <input type="hidden" name="cekdata" id="cekdata">
                        <input type="hidden" name="no_pendaftaran" id="no_pendaftaran"
                            value="{{ $pembayaran->no_pendaftaran }}">
                        <input type="hidden" name="mulaispp" id="mulaispp">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="4" y="5" width="16" height="16" rx="2" />
                                            <line x1="16" y1="3" x2="16" y2="7" />
                                            <line x1="8" y1="3" x2="8" y2="7" />
                                            <line x1="4" y1="11" x2="20" y2="11" />
                                            <line x1="11" y1="15" x2="12" y2="15" />
                                            <line x1="12" y1="15" x2="12" y2="18" />
                                        </svg>
                                    </span>
                                    <input type="text" name="tgl_transaksi" id="tgl_transaksi"
                                        value="{{ date(' Y-m-d') }}" placeholder="Tanggal Transaksi"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="form-label">Jenis Biaya</label>
                                    <select name="id_jenisbayar" id="id_jenisbayar" class="form-select">
                                        <option value="">Pilih Jenis Biaya</option>
                                    </select>
                                    <input type="hidden" name="sudah_bayar" id="sudah_bayar" value="" readonly
                                        class="form-control">
                                    <input type="hidden" name="wajib_bayar" id="wajib_bayar" value="" readonly
                                        class="form-control">

                                    <input type="hidden" name="sisa_bayar" id="sisa_bayar" value="" readonly
                                        class="form-control">

                                </div>
                            </div>
                            <div class="col-md-6" id="ppdb">
                                <label for="" class="form-label">Jumlah Bayar</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/report-money -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <rect x="9" y="3" width="6" height="4" rx="2" />
                                            <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                            <path d="M12 17v1m0 -8v1" />
                                        </svg>
                                    </span>
                                    <input type="text" name="jumlah_bayar" id="jumlah_bayar" value=""
                                        style="text-align: right" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6" id="spp">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="" class="form-label">Bulan</label>
                                        <select name="bulanspp" id="bulanspp" class="form-select">

                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="" class="form-label">Jumlah Bayar</label>
                                        <div class="input-icon">
                                            <span class="input-icon-addon">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/report-money -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                    <rect x="9" y="3" width="6" height="4" rx="2" />
                                                    <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                                    <path d="M12 17v1m0 -8v1" />
                                                </svg>
                                            </span>
                                            <input type="text" name="jumlah_spp" id="jumlah_spp" value=""
                                                style="text-align: right" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <label for="" class="form-label" style="color:transparent">Tambah</label>
                                <div class="form-group">
                                    <a href="#" class="btn btn-primary" id="tambah_bayar">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/layout-grid-add -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="4" y="4" width="6" height="6" rx="1" />
                                            <rect x="14" y="4" width="6" height="6" rx="1" />
                                            <rect x="4" y="14" width="6" height="6" rx="1" />
                                            <path d="M14 17h6m-3 -3v6" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <span style="font-weight: bold; color:red" id="sisabayar"></span>
                        </div>
                        <div class="row mt-3">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Jenis Biaya</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="load_tmpbayar"></tbody>
                            </table>
                            <label class="form-check">
                                <input class="form-check-input" name="statustransaksi" type="checkbox" value="1">
                                <span class="form-check-label">Transaksi Pindahan Manual</span>
                            </label>
                            <button type="submit" class="btn btn-primary w-100"
                                style="background-color:#09482f; color:white"><i class="fa fa-send mr-2"></i>
                                Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-detailtransaksi" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi <span style="font-weight:bold" id="notransaksi"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loaddetailtransaksi">
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-potongan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span style="font-weight: bold" id="inputedit"></span> <span
                            style="font-weight:bold" id="jenisbiayapotongan"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/simpanpotongan" method="POST">
                        @csrf
                        <input type="hidden" id="kodebiayapotongan" name="kodebiaya">
                        <input type="hidden" id="id_jenisbayarpotongan" name="id_jenisbayar">
                        <input type="hidden" id="no_pendaftaranpotongan" name="no_pendaftaran"
                            value="{{ $pembayaran->no_pendaftaran }}">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/report-money -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <rect x="9" y="3" width="6" height="4" rx="2" />
                                    <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                    <path d="M12 17v1m0 -8v1" />
                                </svg>
                            </span>
                            <input type="text" name="jumlah_potongan" placeholder="Jumlah Penyesuaian"
                                id="jumlah_potongan" autocomplete="off" style="text-align: right" class="form-control">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-mutasi" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span style="font-weight: bold" id="inputeditmutasi"></span> <span
                            style="font-weight:bold" id="jenisbiayamutasi"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/simpanmutasi" method="POST">
                        @csrf
                        <input type="hidden" id="kodebiayamutasi" name="kodebiaya">
                        <input type="hidden" id="id_jenisbayarmutasi" name="id_jenisbayar">
                        <input type="hidden" id="no_pendaftaranmutasi" name="no_pendaftaran"
                            value="{{ $pembayaran->no_pendaftaran }}">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/report-money -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <rect x="9" y="3" width="6" height="4" rx="2" />
                                    <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                    <path d="M12 17v1m0 -8v1" />
                                </svg>
                            </span>
                            <input type="text" name="jumlah_mutasi" placeholder="Jumlah Mutasi Manual"
                                id="jumlah_mutasi" autocomplete="off" style="text-align: right" class="form-control">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-editspp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 450px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit SPP </h5>
                    <button type="button" class="btn-close" id="close-spp" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditspp">
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-editum" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 450px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Uang Lauk </h5>
                    <button type="button" class="btn-close" id="close-spp" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditum">
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-inputmutasispp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="max-width: 450px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Mutasi</h5>
                    <button type="button" class="btn-close" id="close-spp" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadinputmutasispp">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute(
                'href'
            ); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
            console.log(urlToRedirect); // verify if this is the right URL
            swal({
                    title: "Anda Yakin Untuk Menghapus Data Ini?",
                    text: "Data Akan Terhapus Permanent !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {

                    if (willDelete) {
                        window.location.href = urlToRedirect;
                        swal("Data Sudah Terhapus !", {
                            icon: "success",
                        });
                    } else {
                        swal("Anda membatalkan Penghapusan!");
                    }
                });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr(document.getElementById('tgl_transaksi'), {});
        });
    </script>
    <script>
        $(function() {
            $('#close-spp, #refreshpage').click(function() {
                location.reload();
            });
            $(".editspp").click(function(e) {
                e.preventDefault();
                var no_rencana_spp = $(this).attr("data-norencanaspp");
                $("#modal-editspp").modal("show");
                $.ajax({
                    type: 'POST',
                    url: '/editspp',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_rencana_spp: no_rencana_spp
                    },
                    cache: false,
                    success: function(respond) {
                        $("#loadeditspp").html(respond);
                    }
                });
            });

            $(".edituangmakan").click(function(e) {
                e.preventDefault();
                var no_rencana_um = $(this).attr("data-norencanaum");
                $("#modal-editum").modal("show");
                $.ajax({
                    type: 'POST',
                    url: '/editum',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_rencana_um: no_rencana_um
                    },
                    cache: false,
                    success: function(respond) {
                        $("#loadeditum").html(respond);
                    }
                });
            });
            $("#tahunakademik").change(function(e) {
                e.preventDefault();
                loadspptaasrama();
                loadsppta();
            });

            function loadsppta() {
                var no_pendaftaran = "{{ $pembayaran->no_pendaftaran }}";
                var tahunakademik = $("#tahunakademik").val();
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/getsppta',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_pendaftaran: no_pendaftaran,
                        tahunakademik: tahunakademik
                    },
                    cache: false,
                    success: function(respond) {
                        $("#loadspp").html(respond);
                    }
                });
            }

            function loadspptaasrama() {
                var no_pendaftaran = "{{ $pembayaran->no_pendaftaran }}";
                var tahunakademik = $("#tahunakademik").val();
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/getspptaasrama',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_pendaftaran: no_pendaftaran,
                        tahunakademik: tahunakademik
                    },
                    cache: false,
                    success: function(respond) {
                        $("#loadsppasrama").html(respond);
                    }
                });
            }

            loadspptaasrama();
            loadsppta();

            $("#jumlah_bayar").maskNumber({
                integer: true,
                thousands: '.'
            });

            $("#jumlah_spp").maskNumber({
                integer: true,
                thousands: '.'
            });

            $("#jumlah_potongan, #jumlah_mutasi").maskMoney();

            function loadbayar() {
                var id_jenisbayar = $("#id_jenisbayar").val();
                //alert(id_jenisbayar);
                if (id_jenisbayar == "7" || id_jenisbayar == "39") {
                    $("#ppdb").hide();
                    $("#spp").show();
                } else {
                    $("#ppdb").show();
                    $("#spp").hide();
                }
            }

            function loadcekdatatmp() {
                var kodebiaya = $("#kodebiaya").val();
                var no_pendaftaran = $("#no_pendaftaran").val();
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/cektmpbayar',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodebiaya: kodebiaya,
                        no_pendaftaran: no_pendaftaran
                    },
                    cache: false,
                    success: function(respond) {
                        console.log(respond);
                        $("#cekdata").val(respond);
                    }
                });
            }


            $("#bulanspp").change(function() {
                var id_jenisbayar = $("#id_jenisbayar").val();
                if (id_jenisbayar == 7) {
                    loadrencanaspp();
                } else {
                    loadrencanaum();
                }
            });

            function loadbulanspp() {
                var mulaispp = $("#mulaispp").val();
                //alert(mulaispp);
                var kodebiaya = $("#kodebiaya").val();
                var no_pendaftaran = "{{ $pembayaran->no_pendaftaran }}";
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/getoptionbulan',
                    data: {
                        _token: "{{ csrf_token() }}",
                        mulaispp: mulaispp,
                        kodebiaya: kodebiaya,
                        no_pendaftaran: no_pendaftaran
                    },
                    cache: false,
                    success: function(respond) {
                        $("#bulanspp").html(respond);
                        loadrencanaspp();
                        console.log(respond);
                    }
                });
            }

            function loadbulanum() {
                var mulaispp = $("#mulaispp").val();
                //alert(mulaispp);
                var kodebiaya = $("#kodebiaya").val();
                var no_pendaftaran = "{{ $pembayaran->no_pendaftaran }}";
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/getoptionbulanum',
                    data: {
                        _token: "{{ csrf_token() }}",
                        mulaispp: mulaispp,
                        kodebiaya: kodebiaya,
                        no_pendaftaran: no_pendaftaran
                    },
                    cache: false,
                    success: function(respond) {
                        $("#bulanspp").html(respond);
                        loadrencanaum();
                        console.log(respond);
                    }
                });
            }



            // function loadspp(){
            //   var id_jenisbayar = $("#id_jenisbayar").val();
            //   $.ajax({
            //     type:'POST',
            //     url:'/loaddata/getspp',
            //     data:{ _token: "{{ csrf_token() }}",kodebiaya:kodebiaya,id_jenisbayar:id_jenisbayar},
            //     cache:false,
            //     success:function(respond){
            //       console.log(respond);
            //       $("#jumlah_spp").val(respond);
            //     }
            //   });

            // }
            function loadbiaya() {
                var no_pendaftaran = "{{ $pembayaran->no_pendaftaran }}";
                var tahunakademik = $("#tahunakademik").val();

                $.ajax({
                    type: 'POST',
                    url: '/loaddata/getoptionbiaya',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_pendaftaran: no_pendaftaran,
                        tahunakademik: tahunakademik
                    },
                    cache: false,
                    success: function(respond) {
                        console.log(respond);
                        $("#id_jenisbayar").html(respond);
                        loadbayar();
                    }
                });
            }

            function loaddata_tmpbayar() {
                var no_pendaftaran = "{{ $pembayaran->no_pendaftaran }}";
                var kodebiaya = $("#kodebiaya").val();
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/gettmpbayar',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_pendaftaran: no_pendaftaran,
                        kodebiaya: kodebiaya
                    },
                    cache: false,
                    success: function(respond) {
                        $("#load_tmpbayar").html(respond);
                    }
                });
            }

            function loadrencanaspp() {
                var mulaispp = $("#mulaispp").val();
                //alert(mulaispp);
                var kodebiaya = $("#kodebiaya").val();
                var no_pendaftaran = "{{ $pembayaran->no_pendaftaran }}";
                var bulanspp = $("#bulanspp").val();
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/getrencanaspp',
                    data: {
                        _token: "{{ csrf_token() }}",
                        mulaispp: mulaispp,
                        kodebiaya: kodebiaya,
                        no_pendaftaran: no_pendaftaran,
                        bulanspp: bulanspp
                    },
                    cache: false,
                    success: function(respond) {

                        console.log(respond);
                        if (respond == 1) {
                            swal("Oops", "Silahkan Generate SPP Terlebih Dahulu !", "warning")
                        } else {
                            $("#jumlah_spp").val(respond);
                            $("#wajib_bayar").val(respond);
                            $("#sisabayar").text("");
                        }
                    }
                });
            }

            function loadrencanaum() {
                var mulaispp = $("#mulaispp").val();
                //alert(mulaispp);
                var kodebiaya = $("#kodebiaya").val();
                var no_pendaftaran = "{{ $pembayaran->no_pendaftaran }}";
                var bulanspp = $("#bulanspp").val();
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/getrencanaum',
                    data: {
                        _token: "{{ csrf_token() }}",
                        mulaispp: mulaispp,
                        kodebiaya: kodebiaya,
                        no_pendaftaran: no_pendaftaran,
                        bulanspp: bulanspp
                    },
                    cache: false,
                    success: function(respond) {

                        if (respond == 1) {
                            swal("Oops", "Silahkan Generate Uang Makan Terlebih Dahulu !", "warning")
                        } else {
                            $("#jumlah_spp").val(respond);
                            $("#wajib_bayar").val(respond);
                            $("#sisabayar").text("");
                        }
                        console.log(respond);
                    }
                });
            }

            $("#id_jenisbayar").change(function(e) {
                e.preventDefault();
                loadbayar();

                var no_pendaftaran = "{{ $pembayaran->no_pendaftaran }}";
                //alert(no_pendaftaran);
                var kodebiaya = $('option:selected', this).attr('data-kodebiaya');
                var mulaispp = $('option:selected', this).attr('data-mulaispp');
                var id_jenisbayar = $(this).val();
                var bulanspp = $("#bulanspp").val();
                $.ajax({
                    type: 'POST',
                    url: '/loaddata/getjumlahbiaya',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_pendaftaran: no_pendaftaran,
                        kodebiaya: kodebiaya,
                        id_jenisbayar: id_jenisbayar,
                        bulanspp: bulanspp
                    },
                    cache: false,
                    success: function(respond) {
                        console.log(respond);
                        $("#kodebiaya").val(kodebiaya);
                        $("#mulaispp").val(mulaispp);
                        if (id_jenisbayar == 7) {
                            $("#jumlah_spp").focus();
                            loadbulanspp();

                        } else if (id_jenisbayar == 39) {
                            $("#jumlah_spp").focus();
                            loadbulanum();

                        } else {
                            $("#jumlah_bayar").focus();
                            $("#wajib_bayar").val(respond);
                            $("#sisabayar").text("Sisa Yang Harus Dibayarkan : " + respond)
                        }




                    }
                });

            })
            $(".bayar").click(function(e) {
                e.preventDefault();
                $("#modal-bayar").modal("show");
                loadbiaya();
                loaddata_tmpbayar()

            });
            $("#tambah_bayar").click(function(e) {
                e.preventDefault();
                var id_jenisbayar = $("#id_jenisbayar").val();
                var jumlah_spp = $("#jumlah_spp").val();
                var jumlah_bayar = $("#jumlah_bayar").val();
                var bulanspp = $("#bulanspp").val();
                var wajib_bayar = $("#wajib_bayar").val();
                var jumlah = 0;
                if (id_jenisbayar == "7" || id_jenisbayar == "39") {
                    jumlah = jumlah_spp;
                } else {
                    jumlah = jumlah_bayar;
                }

                var jml = jumlah.replace(".", "");
                var wb = wajib_bayar.replace(".", "");


                var tgl_transaksi = $("#tgl_transaksi").val();
                var kodebiaya = $("#kodebiaya").val();
                var no_pendaftaran = "<?php echo $pembayaran->no_pendaftaran; ?>";

                if (id_jenisbayar == "") {
                    swal("Oops", "Pilih Dulu Jenis Biaya !", "warning");
                } else if (jumlah == "" || jumlah == 0) {
                    swal("Oops", "Jumlah Bayar Harus Diisi !", "warning");
                } else if (id_jenisbayar != "7" && parseInt(jml) > parseInt(wb)) {
                    swal("Oops", "Pembayaran Melebihi Wajib Bayar ! Sisa Yang Harus Dibayarkan Sebesar " +
                        wb, "warning");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/pembayaran/store_bayartemp',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_pendaftaran: no_pendaftaran,
                            kodebiaya: kodebiaya,
                            id_jenisbayar: id_jenisbayar,
                            jumlah: jumlah,
                            bulanspp: bulanspp
                        },
                        cache: false,
                        success: function(respond) {
                            if (respond == 2) {
                                swal("Oops", "Data Sudah diinputkan !", "warning");
                            }
                            if (id_jenisbayar == "7") {
                                loadbulanspp();
                            } else if (id_jenisbayar == "39") {
                                loadbulanum();
                            }
                            $("#jumlah_bayar").val("");
                            $("#jumlah_bayar").focus();
                            loaddata_tmpbayar();
                            loadcekdatatmp();
                        }
                    });
                }
            });

            $("#frmBayar").submit(function(e) {
                var cekdata = $("#cekdata").val();
                if (cekdata == "" || cekdata == 0) {
                    swal("Oops", "Belum ada pembayaran yang diinputkan", "warning");
                    return false;
                } else {
                    return true;
                }
            });

            $(".detail").click(function(e) {
                e.preventDefault();
                var notransaksi = $(this).attr("data-notransaksi");
                $("#notransaksi").text(notransaksi);
                $("#modal-detailtransaksi").modal("show");
                $.ajax({
                    type: 'post',
                    url: '/loaddata/getdetailtransaksi',
                    data: {
                        _token: "{{ csrf_token() }}",
                        notransaksi: notransaksi
                    },
                    cache: false,
                    success: function(respond) {
                        $("#loaddetailtransaksi").html(respond);
                    }
                });
            });

            $(".tambahpotongan").click(function(e) {
                e.preventDefault();
                var jenisbiaya = $(this).attr("data-jenisbiaya");
                var kodebiaya = $(this).attr("data-kodebiaya");
                var id_jenisbayar = $(this).attr("data-idjenisbayar");
                $("#modal-potongan").modal("show");
                $("#jenisbiayapotongan").text(jenisbiaya);
                $("#inputedit").text("Input Penyesuaian");
                $("#kodebiayapotongan").val(kodebiaya);
                $("#id_jenisbayarpotongan").val(id_jenisbayar);
                $("#jumlah_potongan").val("");
                $("#jumlah_potongan").focus();
            });

            $(".inputmutasi").click(function(e) {
                e.preventDefault();
                var jenisbiaya = $(this).attr("data-jenisbiaya");
                var kodebiaya = $(this).attr("data-kodebiaya");
                var id_jenisbayar = $(this).attr("data-idjenisbayar");
                var no_rencana_spp = $(this).attr("data-norencanaspp");
                var no_rencana_um = $(this).attr("data-norencanaum");

                if (id_jenisbayar == 7) {
                    if (no_rencana_spp == "") {
                        alert("Oops", "Silahkan Generate SPP Terlebih Dahulu", "warning");
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '/inputmutasispp',
                            data: {
                                _token: "{{ csrf_token() }}",
                                no_rencana_spp: no_rencana_spp
                            },
                            cache: false,
                            success: function(respond) {
                                $("#modal-inputmutasispp").modal("show");
                                $("#loadinputmutasispp").html(respond);
                            }
                        });
                    }
                } else if (id_jenisbayar == 39) {
                    if (no_rencana_um == "") {
                        alert("Oops", "Silahkan Generate Uang Makan Terlebih Dahulu", "warning");
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '/inputmutasium',
                            data: {
                                _token: "{{ csrf_token() }}",
                                no_rencana_um: no_rencana_um
                            },
                            cache: false,
                            success: function(respond) {
                                $("#modal-inputmutasispp").modal("show");
                                $("#loadinputmutasispp").html(respond);
                            }
                        });
                    }
                } else {
                    $("#modal-mutasi").modal("show");
                    $("#jenisbiayamutasi").text(jenisbiaya);
                    $("#inputeditmutasi").text("Input Mutasi Data Manual");
                    $("#kodebiayamutasi").val(kodebiaya);
                    $("#id_jenisbayarmutasi").val(id_jenisbayar);
                    $("#jumlah_mutasi").val("");
                    $("#jumlah_mutasi").focus();
                }
            });

            $(".editpotongan").click(function(e) {
                e.preventDefault();
                var jenisbiaya = $(this).attr("data-jenisbiaya");
                var kodebiaya = $(this).attr("data-kodebiaya");
                var id_jenisbayar = $(this).attr("data-idjenisbayar");
                var jumlah_potongan = $(this).attr("data-jumlahpotongan");
                $("#modal-potongan").modal("show");
                $("#jenisbiayapotongan").text(jenisbiaya);
                $("#inputedit").text("Edit Potongan");
                $("#kodebiayapotongan").val(kodebiaya);
                $("#id_jenisbayarpotongan").val(id_jenisbayar);
                $("#jumlah_potongan").val(jumlah_potongan);
                $("#jumlah_potongan").focus();
            });

            $(".editmutasi").click(function(e) {
                e.preventDefault();
                var jenisbiaya = $(this).attr("data-jenisbiaya");
                var kodebiaya = $(this).attr("data-kodebiaya");
                var id_jenisbayar = $(this).attr("data-idjenisbayar");
                var jumlah_mutasi = $(this).attr("data-jumlahmutasi");
                var no_rencana_spp = $(this).attr("data-norencanaspp");
                var no_rencana_um = $(this).attr("data-norencanaum");
                if (id_jenisbayar == 7) {
                    if (no_rencana_spp == "") {
                        alert("Oops", "Silahkan Generate SPP Terlebih Dahulu", "warning");
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '/inputmutasispp',
                            data: {
                                _token: "{{ csrf_token() }}",
                                no_rencana_spp: no_rencana_spp
                            },
                            cache: false,
                            success: function(respond) {
                                $("#modal-inputmutasispp").modal("show");
                                $("#loadinputmutasispp").html(respond);
                            }
                        });
                    }
                } else if (id_jenisbayar == 39) {
                    if (no_rencana_um == "") {
                        alert("Oops", "Silahkan Generate Uang Makan Terlebih Dahulu", "warning");
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '/inputmutasium',
                            data: {
                                _token: "{{ csrf_token() }}",
                                no_rencana_um: no_rencana_um
                            },
                            cache: false,
                            success: function(respond) {
                                $("#modal-inputmutasispp").modal("show");
                                $("#loadinputmutasispp").html(respond);
                            }
                        });
                    }
                } else {
                    $("#modal-mutasi").modal("show");
                    $("#jenisbiayamutasi").text(jenisbiaya);
                    $("#inputeditmutasi").text("Edit Mutasi");
                    $("#kodebiayamutasi").val(kodebiaya);
                    $("#id_jenisbayarmutasi").val(id_jenisbayar);
                    $("#jumlah_mutasi").val(jumlah_mutasi);
                    $("#jumlah_mutasi").focus();
                }
            });
        });
    </script>
@endpush
