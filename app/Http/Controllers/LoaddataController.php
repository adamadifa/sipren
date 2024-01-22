<?php

namespace App\Http\Controllers;

use App\Biaya;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class LoaddataController extends Controller
{
    function gettingkat(Request $request)
    {
        echo "<option value=''>Tingkat</option>";
        for ($i = 1; $i <= $request->jumlah_tingkat; $i++) {
            if ($request->tingkat == $i) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            echo "<option $selected value='$i'>$i</option>";
        }
    }

    function getbiaya(Request $request)
    {
        $biaya = Biaya::where('tahunakademik', $request->tahunakademik)
            ->where('jenjang', $request->jenjang)
            ->get();


        return view('loaddata.getbiaya', compact('biaya'));
    }

    function getdetailbiaya(Request $request)
    {
        $kodebiaya = $request->kodebiaya;

        $biaya = DB::table('detailbiaya')
            ->join('jenisbayar', 'detailbiaya.id_jenisbayar', '=', 'jenisbayar.id')
            ->where('kodebiaya', $kodebiaya)
            ->get();
        return view('loaddata.getdetailbiaya', compact('biaya'));
    }

    function getoptionbiaya(Request $request)
    {


        $no_pendaftaran = $request->no_pendaftaran;
        $biaya = DB::table('detailbiaya as db')
            ->select('no_pendaftaran', 'db.kodebiaya', 'db.id_jenisbayar', 'jenisbayar', 'tahunakademik', 'jenjang', 'tingkat', 'jumlah_biaya', 'mulai_pembayaran')
            ->join('biaya', 'db.kodebiaya', '=', 'biaya.kodebiaya')
            ->join('jenisbayar', 'db.id_jenisbayar', '=', 'jenisbayar.id')
            ->join('rincian_biaya_siswa', 'db.kodebiaya', '=', 'rincian_biaya_siswa.kodebiaya')
            ->where('no_pendaftaran', $no_pendaftaran)
            // ->orderBy('biaya.jenjang', 'asc')
            ->orderBy('no_urut', 'asc')
            ->orderBy('tahunakademik', 'asc')
            ->get();
        print("<option value=''>Pilih Jenis Biaya</option>");
        foreach ($biaya as $d) {
            // if ($d->id_jenisbayar == '11' && $d->tahunakademik = $tahunakademik) {
            //     $selected = "selected";
            // } else {
            //     $selected = "";
            // }

            if ($d->jenjang == 'ASRAMA') {
                $jenjang = $d->jenjang;
            } else {
                $jenjang = "";
            }


            if ($d->id_jenisbayar == '7' || $d->id_jenisbayar == '1' || $d->jenisbayar == 'PAS' || $d->jenisbayar == 'PAT' || $d->id_jenisbayar == '25' || $d->id_jenisbayar == '39') {
                $value = $d->jenisbayar . " " . $jenjang . " " . $d->tahunakademik;
            } else {
                $value = $d->jenisbayar;
            }
            print("<option value='$d->id_jenisbayar' data-kodebiaya='$d->kodebiaya' data-mulaispp='$d->mulai_pembayaran' >$value</option>");
        }
    }

    //Mendapatkan Jumlah SPP Aktif
    function getspp(Request $request)
    {
        $kodebiaya = $request->kodebiaya;
        $id_jenisbayar = $request->id_jenisbayar;
        $spp = DB::table('detailbiaya')
            ->where('kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', $id_jenisbayar)
            ->first();
        echo number_format($spp->jumlah_biaya, '0', '', '.');
    }

    function getsppta(Request $request)
    {
        $tahunakademik = $request->tahunakademik;
        $no_pendaftaran = $request->no_pendaftaran;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $databiaya = DB::table('rencana_spp_detail')
            ->select('rencana_spp.no_pendaftaran', 'rencana_spp.kodebiaya', 'bulan', 'jumlah', 'jumlah_mutasi')
            ->join('rencana_spp', 'rencana_spp_detail.no_rencana_spp', '=', 'rencana_spp.no_rencana_spp')
            ->join('biaya', 'rencana_spp.kodebiaya', 'biaya.kodebiaya')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('tahunakademik', $tahunakademik)
            ->where('jenjang', '!=', 'ASRAMA')
            ->get();

        //dd($databiaya);
        return view('loaddata.getspp', compact('databiaya', 'namabulan', 'no_pendaftaran'));
    }

    function getspptaasrama(Request $request)
    {
        $tahunakademik = $request->tahunakademik;
        $no_pendaftaran = $request->no_pendaftaran;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $databiaya = DB::table('rencana_spp_detail')
            ->select('rencana_spp.no_pendaftaran', 'rencana_spp.kodebiaya', 'bulan', 'jumlah', 'jumlah_mutasi')
            ->join('rencana_spp', 'rencana_spp_detail.no_rencana_spp', '=', 'rencana_spp.no_rencana_spp')
            ->join('biaya', 'rencana_spp.kodebiaya', 'biaya.kodebiaya')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('tahunakademik', $tahunakademik)
            ->where('jenjang', 'ASRAMA')
            ->get();


        return view('loaddata.getsppasrama', compact('databiaya', 'namabulan', 'no_pendaftaran'));
    }


    //Mendapatkan Jumlah Biaya Berdasarkan KodeBiaya dan Id Jenis Biaya
    function getjumlahbiaya(Request $request)
    {
        $kodebiaya = $request->kodebiaya;
        $id_jenisbayar = $request->id_jenisbayar;
        $no_pendaftaran = $request->no_pendaftaran;


        $bayar = DB::table('historibayar_detail')
            ->select(DB::raw('SUM(jumlah_bayar) AS totalbayar'))
            ->join('historibayar', 'historibayar_detail.no_transaksi', '=', 'historibayar.no_transaksi')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', $id_jenisbayar)
            ->first();

        $potongan = DB::table('potongan')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', $id_jenisbayar)
            ->first();
        $biaya = DB::table('detailbiaya')
            ->join('jenisbayar', 'detailbiaya.id_jenisbayar', '=', 'jenisbayar.id')
            ->where('kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', $id_jenisbayar)
            ->first();
        if ($potongan != null) {
            $pot = $potongan->jumlah_potongan;
        } else {
            $pot = 0;
        }

        if ($bayar != null) {
            $b = $bayar->totalbayar;
        } else {
            $b = 0;
        }

        $wajibbayar = $biaya->jumlah_biaya - $pot;
        $sisabayar = $wajibbayar - $b;
        echo $sisabayar;
    }

    function getdatasiswa(Request $request)
    {
        $id_siswa = $request->id_siswa;
        $siswa = DB::table('siswa')
            ->select('siswa.*', 'prov_name', 'regc_name', 'dist_name', 'vill_name', 'pa.nama_pekerjaan as pekerjaan_ayah', 'pi.nama_pekerjaan as pekerjaan_ibu')
            ->leftjoin('pekerjaan as pa', 'siswa.pekerjaan_ayah', '=', 'pa.id')
            ->leftjoin('pekerjaan as pi', 'siswa.pekerjaan_ibu', '=', 'pi.id')
            ->leftjoin('provinces', 'siswa.id_propinsi', '=', 'provinces.id')
            ->leftjoin('regencies', 'siswa.id_kota', '=', 'regencies.id')
            ->leftjoin('districts', 'siswa.id_kecamatan', '=', 'districts.id')
            ->leftjoin('villages', 'siswa.id_kelurahan', '=', 'villages.id')
            ->Where('id_siswa', '=', $id_siswa)
            ->first();
        return view('loaddata.getdatasiswa', compact('siswa'));
    }

    function getdatakeluarga(Request $request)
    {
        $id_siswa = $request->id_siswa;
        $siswa = DB::table('siswa')
            ->select('siswa.*', 'prov_name', 'regc_name', 'dist_name', 'vill_name', 'pa.nama_pekerjaan as pekerjaan_ayah', 'pi.nama_pekerjaan as pekerjaan_ibu')
            ->leftjoin('pekerjaan as pa', 'siswa.pekerjaan_ayah', '=', 'pa.id')
            ->leftjoin('pekerjaan as pi', 'siswa.pekerjaan_ibu', '=', 'pi.id')
            ->leftjoin('provinces', 'siswa.id_propinsi', '=', 'provinces.id')
            ->leftjoin('regencies', 'siswa.id_kota', '=', 'regencies.id')
            ->leftjoin('districts', 'siswa.id_kecamatan', '=', 'districts.id')
            ->leftjoin('villages', 'siswa.id_kelurahan', '=', 'villages.id')
            ->Where('id_siswa', '=', $id_siswa)
            ->first();
        return view('loaddata.getdatakeluarga', compact('siswa'));
    }

    // Menampilkan Bulan Tunggakan
    function getoptionbulan(Request $request)
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $mulaispp = $request->mulaispp;
        $no_pendaftaran = $request->no_pendaftaran;
        $kodebiaya = $request->kodebiaya;
        $cek_bayartemp = DB::table('tmp_bayar')
            ->select('tmp_bayar.no_pendaftaran', 'tmp_bayar.kodebiaya', 'tmp_bayar.ket', DB::raw('(IFNULL(SUM(jumlah_bayar),0) + IFNULL(totalhb,0)) AS totalbayar'), 'totalrencana', 'totalhb')
            ->leftjoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,bulan, jumlah as totalrencana
            FROM rencana_spp_detail
            INNER JOIN rencana_spp ON rencana_spp_detail.no_rencana_spp = rencana_spp.no_rencana_spp
            ) rencanaspp'),
                function ($join) {
                    $join->on('tmp_bayar.no_pendaftaran', '=', 'rencanaspp.no_pendaftaran');
                    $join->on('tmp_bayar.ket', '=', 'rencanaspp.bulan');
                    $join->on('tmp_bayar.kodebiaya', '=', 'rencanaspp.kodebiaya');
                }
            )

            ->leftjoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,ket,  SUM( jumlah_bayar ) AS totalhb
            FROM historibayar_detail
            INNER JOIN historibayar ON historibayar_detail.no_transaksi = historibayar.no_transaksi
            GROUP BY no_pendaftaran,kodebiaya,ket
            ) hb'),
                function ($join) {
                    $join->on('tmp_bayar.no_pendaftaran', '=', 'hb.no_pendaftaran');
                    $join->on('tmp_bayar.ket', '=', 'hb.ket');
                    $join->on('tmp_bayar.kodebiaya', '=', 'hb.kodebiaya');
                }
            )

            ->where('tmp_bayar.no_pendaftaran', $no_pendaftaran)
            ->where('tmp_bayar.kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', '7')
            ->groupBy('tmp_bayar.no_pendaftaran', 'tmp_bayar.kodebiaya', 'tmp_bayar.ket', 'totalrencana', 'totalhb')
            ->havingRaw('(IFNULL(SUM(jumlah_bayar),0) + IFNULL(totalhb,0)) = totalrencana ')
            ->get();
        $cek_historibayar = DB::table('historibayar_detail')
            ->select('historibayar.no_pendaftaran', 'historibayar_detail.kodebiaya', 'historibayar_detail.ket', DB::raw('SUM(jumlah_bayar) AS totalbayar'), 'totalrencana')
            ->leftJoin('historibayar', 'historibayar_detail.no_transaksi', '=', 'historibayar.no_transaksi')
            ->leftjoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,bulan, jumlah as totalrencana
                FROM rencana_spp_detail
                INNER JOIN rencana_spp ON rencana_spp_detail.no_rencana_spp = rencana_spp.no_rencana_spp
                ) rencanaspp'),
                function ($join) {
                    $join->on('historibayar.no_pendaftaran', '=', 'rencanaspp.no_pendaftaran');
                    $join->on('historibayar_detail.ket', '=', 'rencanaspp.bulan');
                    $join->on('historibayar_detail.kodebiaya', '=', 'rencanaspp.kodebiaya');
                }
            )
            ->where('historibayar.no_pendaftaran', $no_pendaftaran)
            ->where('historibayar_detail.kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', '7')
            ->groupBy('historibayar.no_pendaftaran', 'historibayar_detail.kodebiaya', 'historibayar_detail.ket', 'totalrencana')
            ->havingRaw('SUM(jumlah_bayar) = totalrencana ')
            ->get();

        $cekmutasi = DB::table('rencana_spp_detail')
            ->selectRaw('no_pendaftaran,kodebiaya,bulan, jumlah as totalrencana, jumlah_mutasi')
            ->join('rencana_spp', 'rencana_spp_detail.no_rencana_spp', '=', 'rencana_spp.no_rencana_spp')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('kodebiaya', $kodebiaya)
            ->whereRaw('jumlah_mutasi = jumlah')
            ->get();


        $tmpbayar = [];
        $historibayar = [];
        $mutasi = [];
        foreach ($cek_bayartemp as $c) {
            $tmpbayar[] = $c->ket;
        }

        foreach ($cek_historibayar as $h) {
            $historibayar[] = $h->ket;
        }

        foreach ($cekmutasi as $m) {
            $mutasi[] = $m->bulan;
        }


        $bulan = array_merge($tmpbayar, $historibayar, $mutasi);

        for ($i = 1; $i <= 12; $i++) {
            if ($mulaispp > 12) {
                $mulaispp = 1;
            }
            if (!in_array($mulaispp, $bulan)) {
                echo "<option value='$mulaispp'>$namabulan[$mulaispp]</option>";
            }
            $mulaispp++;
        }
    }




    function getoptionbulanum(Request $request)
    {
        $namabulan = ["", "Januari", "Februaru", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $mulaispp = $request->mulaispp;
        $no_pendaftaran = $request->no_pendaftaran;
        $kodebiaya = $request->kodebiaya;
        $cek_bayartemp = DB::table('tmp_bayar')
            ->select('tmp_bayar.no_pendaftaran', 'tmp_bayar.kodebiaya', 'tmp_bayar.ket', DB::raw('(IFNULL(SUM(jumlah_bayar),0) + IFNULL(totalhb,0)) AS totalbayar'), 'totalrencana', 'totalhb')
            ->leftjoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,bulan, jumlah as totalrencana
            FROM rencana_uangmakan_detail
            INNER JOIN rencana_uangmakan ON rencana_uangmakan_detail.no_rencana_um = rencana_uangmakan.no_rencana_um
            ) rencanaum'),
                function ($join) {
                    $join->on('tmp_bayar.no_pendaftaran', '=', 'rencanaum.no_pendaftaran');
                    $join->on('tmp_bayar.ket', '=', 'rencanaum.bulan');
                    $join->on('tmp_bayar.kodebiaya', '=', 'rencanaum.kodebiaya');
                }
            )

            ->leftjoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,ket,  SUM( jumlah_bayar ) AS totalhb
            FROM historibayar_detail
            INNER JOIN historibayar ON historibayar_detail.no_transaksi = historibayar.no_transaksi
            GROUP BY no_pendaftaran,kodebiaya,ket
            ) hb'),
                function ($join) {
                    $join->on('tmp_bayar.no_pendaftaran', '=', 'hb.no_pendaftaran');
                    $join->on('tmp_bayar.ket', '=', 'hb.ket');
                    $join->on('tmp_bayar.kodebiaya', '=', 'hb.kodebiaya');
                }
            )

            ->where('tmp_bayar.no_pendaftaran', $no_pendaftaran)
            ->where('tmp_bayar.kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', '39')
            ->groupBy('tmp_bayar.no_pendaftaran', 'tmp_bayar.kodebiaya', 'tmp_bayar.ket', 'totalrencana', 'totalhb')
            ->havingRaw('(IFNULL(SUM(jumlah_bayar),0) + IFNULL(totalhb,0)) = totalrencana ')
            ->get();
        $cek_historibayar = DB::table('historibayar_detail')
            ->select('historibayar.no_pendaftaran', 'historibayar_detail.kodebiaya', 'historibayar_detail.ket', DB::raw('SUM(jumlah_bayar) AS totalbayar'), 'totalrencana')
            ->leftJoin('historibayar', 'historibayar_detail.no_transaksi', '=', 'historibayar.no_transaksi')
            ->leftjoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,bulan, jumlah as totalrencana
                FROM rencana_uangmakan_detail
                INNER JOIN rencana_uangmakan ON rencana_uangmakan_detail.no_rencana_um = rencana_uangmakan.no_rencana_um
                ) rencanaum'),
                function ($join) {
                    $join->on('historibayar.no_pendaftaran', '=', 'rencanaum.no_pendaftaran');
                    $join->on('historibayar_detail.ket', '=', 'rencanaum.bulan');
                    $join->on('historibayar_detail.kodebiaya', '=', 'rencanaum.kodebiaya');
                }
            )
            ->where('historibayar.no_pendaftaran', $no_pendaftaran)
            ->where('historibayar_detail.kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', '39')
            ->groupBy('historibayar.no_pendaftaran', 'historibayar_detail.kodebiaya', 'historibayar_detail.ket', 'totalrencana')
            ->havingRaw('SUM(jumlah_bayar) = totalrencana ')
            ->get();

        $cekmutasi = DB::table('rencana_uangmakan_detail')
            ->selectRaw('no_pendaftaran,kodebiaya,bulan, jumlah as totalrencana, jumlah_mutasi')
            ->join('rencana_uangmakan', 'rencana_uangmakan_detail.no_rencana_um', '=', 'rencana_uangmakan.no_rencana_um')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('kodebiaya', $kodebiaya)
            ->whereRaw('jumlah_mutasi = jumlah')
            ->get();

        $tmpbayar = [];
        $historibayar = [];
        $mutasi = [];

        foreach ($cek_bayartemp as $c) {
            $tmpbayar[] = $c->ket;
        }

        foreach ($cek_historibayar as $h) {
            $historibayar[] = $h->ket;
        }

        foreach ($cekmutasi as $m) {
            $mutasi[] = $m->bulan;
        }


        $bulan = array_merge($tmpbayar, $historibayar, $mutasi);

        for ($i = 1; $i <= 12; $i++) {
            if ($mulaispp > 12) {
                $mulaispp = 1;
            }
            if (!in_array($mulaispp, $bulan)) {
                echo "<option value='$mulaispp'>$namabulan[$mulaispp]</option>";
            }
            $mulaispp++;
        }
    }

    //Menampilkan Data Temporary Pembayaran
    function gettmpbayar(Request $request)
    {
        $no_pendaftaran = $request->no_pendaftaran;
        $kodebiaya = $request->kodebiaya;
        $namabulan = ["", "Januari", "Februaru", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $tmp_bayar = DB::table('tmp_bayar')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->join('jenisbayar', 'tmp_bayar.id_jenisbayar', '=', 'jenisbayar.id')
            ->join('biaya', 'tmp_bayar.kodebiaya', '=', 'biaya.kodebiaya')
            ->get();
        return view('loaddata.gettmpbayar', compact('tmp_bayar', 'namabulan'));
    }

    function cektmpbayar(Request $request)
    {
        $kodebiaya = $request->kodebiaya;
        $no_pendaftaran = $request->no_pendaftaran;
        $cektmpbayar = DB::table('tmp_bayar')
            ->where('kodebiaya', $kodebiaya)
            ->where('no_pendaftaran', $no_pendaftaran)
            ->count();
        echo $cektmpbayar;
    }

    function getdetailtransaksi(Request $request)
    {
        $namabulan = ["", "Januari", "Februaru", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $detail = DB::table('historibayar_detail')
            ->join('biaya', 'historibayar_detail.kodebiaya', '=', 'biaya.kodebiaya')
            ->join('jenisbayar', 'historibayar_detail.id_jenisbayar', '=', 'jenisbayar.id')
            ->where('no_transaksi', $request->notransaksi)
            ->get();
        return view('loaddata.getdetailtransaksi', compact('detail', 'namabulan'));
    }

    function getabsensikaryawan(Request $request)
    {

        $dari = $request->tahun . "-" . $request->bulan . "-01";
        $sampai = date('Y-m-t', strtotime($dari));

        $absensi = DB::table('presence')
            ->select('presence.*', 'nama_lengkap')
            ->join('karyawan', 'presence.npp', '=', 'karyawan.npp')
            ->where('presence.npp', $request->npp)
            ->whereBetween('presence_date', [$dari, $sampai])
            ->get();

        return view('loaddata.getabsensikaryawan', compact('absensi'));
    }


    function getabsensiharian(Request $request)
    {
        $tanggal = $request->tanggal;
        $unit = Auth::guard('user')->user()->id_unit;
        // if($unit == "PST"){
        //     $unit = "PESANTREN";
        // }else{
        //     $unit = $unit;
        // }
        if ($unit == 9) {
            $absensi = DB::table('presence')
                ->select('presence.*', 'nama_lengkap')
                ->join('karyawan', 'presence.npp', '=', 'karyawan.npp')
                ->join('unit', 'karyawan.id_unit', '=', 'unit.id')
                ->where('presence_date', $tanggal)
                ->get();
        } else {
            $absensi = DB::table('presence')
                ->select('presence.*', 'nama_lengkap')
                ->join('karyawan', 'presence.npp', '=', 'karyawan.npp')
                ->join('unit', 'karyawan.id_unit', '=', 'unit.id')
                ->where('presence_date', $tanggal)
                ->where('karyawan.id_unit', $unit)
                ->get();
        }

        $rekap = DB::table('presence')
            ->select('nama_unit', DB::raw('COUNT(presence_id) as jmlhadir'))
            ->join('karyawan', 'presence.npp', '=', 'karyawan.npp')
            ->join('unit', 'karyawan.id_unit', '=', 'unit.id')
            ->where('presence_date', $tanggal)
            ->groupBy('nama_unit')
            ->orderBy('karyawan.id_unit', 'asc')
            ->get();


        //dd($rekap);
        return view('loaddata.getabsensiharian', compact('absensi', 'rekap'));
    }

    function getabsensiharianall(Request $request)
    {
        $tanggal = $request->tanggal;
        $unit = 9;
        // if($unit == "PST"){
        //     $unit = "PESANTREN";
        // }else{
        //     $unit = $unit;
        // }
        if ($unit == 9) {
            $absensi = DB::table('presence')
                ->select('presence.*', 'nama_lengkap')
                ->leftjoin('karyawan', 'presence.npp', '=', 'karyawan.npp')
                ->leftjoin('unit', 'karyawan.id_unit', '=', 'unit.id')
                ->where('presence_date', $tanggal)
                ->get();
        } else {
            $absensi = DB::table('presence')
                ->select('presence.*', 'nama_lengkap')
                ->join('karyawan', 'presence.npp', '=', 'karyawan.npp')
                ->join('unit', 'karyawan.id_unit', '=', 'unit.id')
                ->where('presence_date', $tanggal)
                ->where('karyawan.id_unit', $unit)
                ->get();
        }

        $rekap = DB::table('presence')
            ->select('nama_unit', DB::raw('COUNT(presence_id) as jmlhadir'))
            ->join('karyawan', 'presence.npp', '=', 'karyawan.npp')
            ->join('unit', 'karyawan.id_unit', '=', 'unit.id')
            ->where('presence_date', $tanggal)
            ->groupBy('nama_unit')
            ->orderBy('karyawan.id_unit', 'asc')
            ->get();


        //dd($rekap);
        return view('loaddata.getabsensiharian', compact('absensi', 'rekap'));
    }

    function map_frame(Request $request)
    {
        $nama = $request->nama;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        return view('loaddata.map_frame', compact('nama', 'latitude', 'longitude'));
    }

    function getrencanaspp(Request $request)
    {
        $kodebiaya = $request->kodebiaya;
        $no_pendaftaran = $request->no_pendaftaran;
        $bulanspp = $request->bulanspp;
        $cekrencanaspp = DB::table('rencana_spp')->where('no_pendaftaran', $no_pendaftaran)->where('kodebiaya', $kodebiaya)->first();
        $cekhistoribayar = DB::table('historibayar_detail')
            ->select(DB::raw('SUM(jumlah_bayar) as totalbayar'))
            ->join('historibayar', 'historibayar_detail.no_transaksi', '=', 'historibayar.no_transaksi')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('kodebiaya', $kodebiaya)
            ->where('ket', $bulanspp)
            ->first();
        $cektmpbayar = DB::table('tmp_bayar')
            ->select(DB::raw('SUM(jumlah_bayar) as totalbayar'))
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('kodebiaya', $kodebiaya)
            ->where('ket', $bulanspp)
            ->first();

        if ($cekrencanaspp == null) {
            $no_rencana_spp = "";
        } else {
            $no_rencana_spp = $cekrencanaspp->no_rencana_spp;
            $cekmutasi = DB::table('rencana_spp_detail')
                ->select(DB::raw('SUM(jumlah_mutasi) as totalbayar'))
                ->where('no_rencana_spp', $no_rencana_spp)
                ->where('bulan', $bulanspp)
                ->first();
        }
        if (empty($no_rencana_spp)) {
            echo "1";
        } else {
            $cekspp = DB::table('rencana_spp_detail')->where('bulan', $bulanspp)->where('no_rencana_spp', $no_rencana_spp)->first();
            $sisa = $cekspp->jumlah - $cekhistoribayar->totalbayar - $cektmpbayar->totalbayar - $cekmutasi->totalbayar;
            echo !empty($sisa) ?  number_format($sisa, '0', '', '.') : '0';
        }
    }


    function getrencanaum(Request $request)
    {
        $kodebiaya = $request->kodebiaya;
        $no_pendaftaran = $request->no_pendaftaran;
        $bulanspp = $request->bulanspp;
        $cekrencanaum = DB::table('rencana_uangmakan')->where('no_pendaftaran', $no_pendaftaran)->where('kodebiaya', $kodebiaya)->first();
        $cekhistoribayar = DB::table('historibayar_detail')
            ->select(DB::raw('SUM(jumlah_bayar) as totalbayar'))
            ->join('historibayar', 'historibayar_detail.no_transaksi', '=', 'historibayar.no_transaksi')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('kodebiaya', $kodebiaya)
            ->where('ket', $bulanspp)
            ->first();
        $cektmpbayar = DB::table('tmp_bayar')
            ->select(DB::raw('SUM(jumlah_bayar) as totalbayar'))
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('kodebiaya', $kodebiaya)
            ->where('ket', $bulanspp)
            ->first();
        if ($cekrencanaum == null) {
            $no_rencana_um = "";
        } else {
            $no_rencana_um = $cekrencanaum->no_rencana_um;
            $cekmutasi = DB::table('rencana_uangmakan_detail')
                ->select(DB::raw('SUM(jumlah_mutasi) as totalbayar'))
                ->where('no_rencana_um', $no_rencana_um)
                ->where('bulan', $bulanspp)
                ->first();
        }
        if (empty($no_rencana_um)) {
            echo "1";
        } else {
            $cekum = DB::table('rencana_uangmakan_detail')->where('bulan', $bulanspp)->where('no_rencana_um', $no_rencana_um)->first();
            $sisa = $cekum->jumlah - $cekhistoribayar->totalbayar - $cektmpbayar->totalbayar - $cekmutasi->totalbayar;
            echo !empty($sisa) ?  number_format($sisa, '0', '', '.') : '0';
        }
    }


    function getchecklistibadahlist(Request $request)
    {
        $tanggal = $request->tanggal;
        $unit = 9;
        // if($unit == "PST"){
        //     $unit = "PESANTREN";
        // }else{
        //     $unit = $unit;
        // }
        if ($unit == 9) {
            $checklistibadah = DB::table('checklist_ibadah')
                ->selectRaw('DISTINCT(checklist_ibadah.npp),nama_lengkap')
                ->leftjoin('karyawan', 'checklist_ibadah.npp', '=', 'karyawan.npp')
                ->leftjoin('unit', 'karyawan.id_unit', '=', 'unit.id')
                ->where('tanggal', $tanggal)
                ->get();
        } else {
            $checklistibadah = DB::table('presence')
                ->select('presence.*', 'nama_lengkap')
                ->join('karyawan', 'presence.npp', '=', 'karyawan.npp')
                ->join('unit', 'karyawan.id_unit', '=', 'unit.id')
                ->where('presence_date', $tanggal)
                ->where('karyawan.id_unit', $unit)
                ->get();
        }

        $rekap = DB::table('checklist_ibadah')
            ->select('nama_unit', DB::raw('COUNT(DISTINCT checklist_ibadah.npp) as jmlhadir'))
            ->join('karyawan', 'checklist_ibadah.npp', '=', 'karyawan.npp')
            ->join('unit', 'karyawan.id_unit', '=', 'unit.id')
            ->where('tanggal', $tanggal)
            ->groupBy('nama_unit')
            ->orderBy('karyawan.id_unit', 'asc')
            ->get();


        //dd($rekap);
        return view('loaddata.getcheclistibadahlist', compact('checklistibadah', 'rekap'));
    }
}
