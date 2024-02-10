<?php

namespace App\Http\Controllers;

use App\Historibayar_detail;
use App\Jenisbayar;
use App\Pembayaran;
use App\Pendaftaran;
use App\Rincianbiaya;
use App\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redis;

class PembayaranController extends Controller
{
    function index(Request $request)
    {
        $id_unit = Auth::guard('user')->user()->id_unit;
        $unit = DB::table('unit')->where('id', $id_unit)->first();
        $ta = Tahunakademik::where('status', 1)->first();
        $query = Rincianbiaya::query();
        // if ($id_unit != 9) {
        //     $query = $query->where('jenjang', $unit->nama_unit);
        // }
        // if (!empty($request->nama_lengkap and empty($request->nis))) {
        //     $query = $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        // } else {
        //     $query = $query->where('nis', $request->nis);
        //     $query = $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        // }

        if (!empty($request->nama_lengkap)) {
            $query = $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        if (!empty($request->tahunakademik)) {
            $query = $query->where('biaya.tahunakademik', $request->tahunakademik);
        } else {
            $query = $query->where('biaya.tahunakademik', $ta->tahunakademik);
        }

        if (!empty($request->jenjang)) {
            $query = $query->where('biaya.jenjang', $request->jenjang);
        } else {
            if ($id_unit != 9) {
                $query = $query->where('biaya.jenjang', $unit->nama_unit);
            }
        }

        if (!empty($request->tingkat)) {
            $query = $query->where('biaya.tingkat', $request->tingkat);
        }

        $query->where('biaya.jenjang', '!=', 'ASRAMA');

        //dd($request);
        $query->select('rincian_biaya_siswa.no_pendaftaran', 'tgl_pendaftaran', 'nis', 'nisn', 'nama_lengkap', 'jenis_kelamin', 'tanggal_lahir', 'biaya.jenjang', 'biaya.tahunakademik', 'nama_ayah');
        $query->join('pendaftaran', 'rincian_biaya_siswa.no_pendaftaran', '=', 'pendaftaran.no_pendaftaran');
        $query->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa');
        $query->join('biaya', 'rincian_biaya_siswa.kodebiaya', '=', 'biaya.kodebiaya');
        $query->orderBy('rincian_biaya_siswa.no_pendaftaran', 'desc');
        $pendaftaran = $query->paginate(10);
        $pendaftaran->appends($request->all());
        $takademik = Tahunakademik::all();
        $jenjang = DB::table('unit')->where('status', 1)->get();
        return view('pembayaran.index', compact('pendaftaran', 'jenjang', 'ta', 'takademik', 'id_unit', 'unit'));
    }

    function show($no_pendaftaran)
    {

        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);

        $pembayaran = DB::table('pendaftaran')
            ->select(
                'pendaftaran.*',
                'nisn',
                'nama_lengkap',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'anak_ke',
                'jml_saudara',
                'alamat',
                'id_propinsi',
                'prov_name',
                'id_kota',
                'regc_name',
                'id_kecamatan',
                'dist_name',
                'id_kelurahan',
                'vill_name',
                'kodepos',
                'no_kk',
                'nik_ayah',
                'nama_ayah',
                'pendidikan_ayah',
                'pekerjaan_ayah',
                'nik_ibu',
                'nama_ibu',
                'pendidikan_ibu',
                'pekerjaan_ibu',
                'no_hp_ortu'
            )
            ->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa')
            ->leftjoin('pekerjaan as pa', 'siswa.pekerjaan_ayah', '=', 'pa.id')
            ->leftjoin('pekerjaan as pi', 'siswa.pekerjaan_ibu', '=', 'pi.id')
            ->leftjoin('provinces', 'siswa.id_propinsi', '=', 'provinces.id')
            ->leftjoin('regencies', 'siswa.id_kota', '=', 'regencies.id')
            ->leftjoin('districts', 'siswa.id_kecamatan', '=', 'districts.id')
            ->leftjoin('villages', 'siswa.id_kelurahan', '=', 'villages.id')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->first();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $ta_aktif = Tahunakademik::where('status', 1)->first();
        $tahunakademik = DB::table('rincian_biaya_siswa')
            ->select('tahunakademik')
            ->join('biaya', 'rincian_biaya_siswa.kodebiaya', '=', 'biaya.kodebiaya')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->groupBy('tahunakademik')
            ->get();
        $databiaya = DB::table('detailbiaya as db')
            ->select(
                'rincian_biaya_siswa.no_pendaftaran',
                'db.kodebiayad',
                'db.id_jenisbayar',
                'jenisbayar',
                'tahunakademik',
                'jenjang',
                'tingkat',
                'jumlah_biaya',
                'totalbayar',
                'jumlah_potongan',
                'jumlah_mutasi',
                'no_rencana_spp',
                'jml_rencana_spp',
                'jml_mutasi_spp',
                'no_rencana_um',
                'jml_rencana_um',
                'jml_mutasi_um'
            )
            ->join('biaya', 'db.kodebiaya', '=', 'biaya.kodebiaya')
            ->join('jenisbayar', 'db.id_jenisbayar', '=', 'jenisbayar.id')
            ->join('rincian_biaya_siswa', 'db.kodebiaya', '=', 'rincian_biaya_siswa.kodebiaya')
            ->leftJoin('potongan', function ($join) {
                $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'potongan.no_pendaftaran')
                    ->on('db.kodebiaya', '=', 'potongan.kodebiaya')
                    ->on('db.id_jenisbayar', '=', 'potongan.id_jenisbayar');
            })

            ->leftJoin('mutasi', function ($join) {
                $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'mutasi.no_pendaftaran')
                    ->on('db.kodebiaya', '=', 'mutasi.kodebiaya')
                    ->on('db.id_jenisbayar', '=', 'mutasi.id_jenisbayar');
            })
            ->leftJoin('rencana_spp', function ($join) {
                $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'rencana_spp.no_pendaftaran')
                    ->on('db.kodebiaya', '=', 'rencana_spp.kodebiaya');
            })

            ->leftJoin('rencana_uangmakan', function ($join) {
                $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'rencana_uangmakan.no_pendaftaran')
                    ->on('db.kodebiaya', '=', 'rencana_uangmakan.kodebiaya');
            })

            ->leftJoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,id_jenisbayar,SUM(jumlah_bayar) as totalbayar
            FROM historibayar_detail
            INNER JOIN historibayar ON historibayar_detail.no_transaksi = historibayar.no_transaksi
            GROUP BY no_pendaftaran,kodebiaya,id_jenisbayar) bayar'),
                function ($join) {
                    $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'bayar.no_pendaftaran');
                    $join->on('db.kodebiaya', '=', 'bayar.kodebiaya');
                    $join->on('db.id_jenisbayar', '=', 'bayar.id_jenisbayar');
                }
            )

            ->leftJoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,SUM(jumlah) as jml_rencana_spp,SUM(jumlah_mutasi) as jml_mutasi_spp
                FROM rencana_spp_detail rsd
                INNER JOIN rencana_spp rs ON rsd.no_rencana_spp = rs.no_rencana_spp
                GROUP BY no_pendaftaran,kodebiaya) rs'),
                function ($join) {
                    $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'rs.no_pendaftaran');
                    $join->on('db.kodebiaya', '=', 'rs.kodebiaya');
                }
            )

            ->leftJoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,SUM(jumlah) as jml_rencana_um,SUM(jumlah_mutasi) as jml_mutasi_um
                FROM rencana_uangmakan_detail rmd
                INNER JOIN rencana_uangmakan rm ON rmd.no_rencana_um = rm.no_rencana_um
                GROUP BY no_pendaftaran,kodebiaya) rm'),
                function ($join) {
                    $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'rm.no_pendaftaran');
                    $join->on('db.kodebiaya', '=', 'rm.kodebiaya');
                }
            )


            ->where('rincian_biaya_siswa.no_pendaftaran', $no_pendaftaran)
            ->orderBy('tahunakademik', 'asc')
            ->orderBy('biaya.jenjang', 'desc')
            ->orderBy('jenisbayar.no_urut', 'asc')

            ->get();

        $historibayar = DB::table('historibayar')
            ->select('historibayar.no_transaksi', 'tgl_transaksi', 'totalbayar', 'name', 'status_transaksi', 'historibayar.created_at')
            ->join('users', 'historibayar.id_user', '=', 'users.id')
            ->leftjoin(
                DB::raw('(SELECT no_transaksi, SUM(jumlah_bayar) as totalbayar
                FROM historibayar_detail
                GROUP BY no_transaksi) hb_detail'),
                function ($join) {
                    $join->on('historibayar.no_transaksi', '=', 'hb_detail.no_transaksi');
                }
            )
            ->where('no_pendaftaran', $no_pendaftaran)
            ->get();

        $cektingkat = DB::table('rincian_biaya_siswa')
            ->join('biaya', 'rincian_biaya_siswa.kodebiaya', '=', 'biaya.kodebiaya')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('jenjang', '!=', 'ASRAMA')
            ->orderBy('tingkat', 'desc')
            ->first();


        $tingkat = $cektingkat->tingkat;
        $jenjang = $cektingkat->jenjang;
        if ($jenjang == "TK") {
            if ($tingkat == 1) {
                $tk = "TK A";
            } else {
                $tk = "TK B";
            }
        } else if ($jenjang == "SDIT") {
            $tk = $tingkat;
        } else if ($jenjang == "MTS") {
            if ($tingkat == 1) {
                $tk = "7";
            } else if ($tingkat == 2) {
                $tk = "8";
            } else if ($tingkat == 3) {
                $tk = "9";
            }
        } else if ($jenjang == "MA") {
            if ($tingkat == 1) {
                $tk = "10";
            } else if ($tingkat == 2) {
                $tk = "11";
            } else if ($tingkat == 3) {
                $tk = "12";
            }
        }
        return view('pembayaran.show', compact('pembayaran', 'namabulan', 'tahunakademik', 'ta_aktif', 'databiaya', 'historibayar', 'tk'));
    }

    function store_bayartemp(Request $request)
    {
        $no_pendaftaran = $request->no_pendaftaran;
        $kodebiaya = $request->kodebiaya;
        $id_jenisbayar = $request->id_jenisbayar;
        $jumlah_bayar = str_replace(".", "", $request->jumlah);
        $bulanspp = $request->bulanspp;
        if ($id_jenisbayar == "7" || $id_jenisbayar == "39") {
            $cek = 0;
            $ket = $bulanspp;
        } else {
            $ket = "";
            $cek = DB::table('tmp_bayar')
                ->where('no_pendaftaran', $no_pendaftaran)
                ->where('kodebiaya', $kodebiaya)
                ->where('id_jenisbayar', $id_jenisbayar)
                ->count();
        }

        if ($cek == 0) {
            DB::table('tmp_bayar')->insert([
                'no_pendaftaran' => $no_pendaftaran,
                'kodebiaya' => $kodebiaya,
                'id_jenisbayar' => $id_jenisbayar,
                'jumlah_bayar' => $jumlah_bayar,
                'ket' => $ket
            ]);
            echo "1";
        } else {
            echo "2";
        }
    }

    function hapus_bayartemp(Request $request)
    {
        DB::table('tmp_bayar')
            ->where('id_temp', $request->id)
            ->delete();
    }

    function store(Request $request)
    {
        if (isset($request->statustransaksi)) {
            $statustransaksi = 1;
        } else {
            $statustransaksi = 0;
        }
        $request->validate([
            'no_pendaftaran' => 'required',
            'kodebiaya' => 'required',
            'tgl_transaksi' => 'required',
            'cekdata' => 'required'
        ]);

        $t = Tahunakademik::where('status', 1)->first();
        $ta = substr($t['tahunakademik'], 2, 2) . substr($t['tahunakademik'], 7, 2);

        $tgl = explode("-", $request->tgl_transaksi);
        $thn = substr($tgl[0], 2, 2);
        $day = $tgl[2];
        $month = $tgl[1];
        $format = $thn . $month . $day;
        $cekpembayaran = DB::table('historibayar')
            ->select('no_transaksi')
            ->where('tgl_transaksi', $request->tgl_transaksi)
            ->orderBy('no_transaksi', 'desc')
            ->first();
        if (empty($cekpembayaran->no_transaksi)) {
            $no_transaksi_terakhir = $format . "000";
        } else {
            $no_transaksi_terakhir = $cekpembayaran->no_transaksi;
        }

        //dd($no_transaksi_terakhir);
        $no_transaksi = buatkode($no_transaksi_terakhir, $format, 3);
        $simpan = DB::table('historibayar')->insert([
            'no_transaksi' => $no_transaksi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'no_pendaftaran' => $request->no_pendaftaran,
            'status_transaksi' => $statustransaksi,
            'id_user' => Auth::guard('user')->user()->id
        ]);

        if ($simpan) {
            $gagal = 0;
            $tmpbayar = DB::table('tmp_bayar')->where('no_pendaftaran', $request->no_pendaftaran)->get();
            foreach ($tmpbayar as $t) {
                $simpandetail = DB::table('historibayar_detail')->insert([
                    'no_transaksi' => $no_transaksi,
                    'kodebiaya' => $t->kodebiaya,
                    'id_jenisbayar' => $t->id_jenisbayar,
                    'jumlah_bayar' => $t->jumlah_bayar,
                    'ket' => $t->ket
                ]);

                if (!$simpandetail) {
                    $gagal += 1;
                }
            }

            if ($gagal > 0) {
                DB::table('historibayar_detail')->where('no_transaksi', $no_transaksi)->delete();
                DB::table('historibayar')->where('no_transaksi', $no_transaksi)->delete();
            } else {
                DB::table('tmp_bayar')->where('no_pendaftaran', $request->no_pendaftaran)->delete();
                return redirect('/pembayaran/' . Crypt::encrypt($request->no_pendaftaran) . '/show')->with(['success' => 'Data Berhasil Disimpan']);
            }
        }
    }

    function cetakkwitansi($no_transaksi)
    {
        $bayar = DB::table('historibayar')
            ->select('historibayar.no_transaksi', 'tgl_transaksi', 'nis', 'siswa.nama_lengkap', 'jenjang', 'name')
            ->join('users', 'historibayar.id_user', '=', 'users.id')
            ->join('pendaftaran', 'historibayar.no_pendaftaran', '=', 'pendaftaran.no_pendaftaran')
            ->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa')
            ->where('no_transaksi', $no_transaksi)
            ->first();

        $namabulan = ["", "Januari", "Februaru", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $detail = DB::table('historibayar_detail')
            ->join('biaya', 'historibayar_detail.kodebiaya', '=', 'biaya.kodebiaya')
            ->join('jenisbayar', 'historibayar_detail.id_jenisbayar', '=', 'jenisbayar.id')
            ->where('no_transaksi', $no_transaksi)
            ->get();

        // dd($bayar);
        return view('pembayaran.cetakkwitansi', compact('bayar', 'detail', 'namabulan'));
    }

    function hapus($no_transaksi, $no_pendaftaran)
    {
        $hapus = DB::table('historibayar')
            ->where('no_transaksi', $no_transaksi)
            ->delete();
        if ($hapus) {
            return redirect('/pembayaran/' . Crypt::encrypt($no_pendaftaran) . '/show')->with(['success' => 'Data Berhasil Disimpan']);
        }
    }

    function simpanpotongan(Request $request)
    {
        $cek = DB::table('potongan')
            ->where('no_pendaftaran', $request->no_pendaftaran)
            ->where('kodebiaya', $request->kodebiaya)
            ->where('id_jenisbayar', $request->id_jenisbayar)
            ->first();

        if ($cek == null) {
            $simpan = DB::table('potongan')
                ->insert([
                    'no_pendaftaran' => $request->no_pendaftaran,
                    'kodebiaya' => $request->kodebiaya,
                    'id_jenisbayar' => $request->id_jenisbayar,
                    'jumlah_potongan' => str_replace(".", "", $request->jumlah_potongan)
                ]);
            if ($simpan) {
                return redirect('/pembayaran/' . Crypt::encrypt($request->no_pendaftaran) . '/show')->with(['success' => 'Data Berhasil Disimpan']);
            }
        } else {
            if ($request->jumlah_potongan == 0) {
                $hapus = DB::table('potongan')
                    ->where('no_pendaftaran', $request->no_pendaftaran)
                    ->where('kodebiaya', $request->kodebiaya)
                    ->where('id_jenisbayar', $request->id_jenisbayar)
                    ->delete();
                if ($hapus) {
                    return redirect('/pembayaran/' . Crypt::encrypt($request->no_pendaftaran) . '/show')->with(['success' => 'Data Berhasil Di Hapus']);
                }
            } else {
                $update = DB::table('potongan')
                    ->where('no_pendaftaran', $request->no_pendaftaran)
                    ->where('kodebiaya', $request->kodebiaya)
                    ->where('id_jenisbayar', $request->id_jenisbayar)
                    ->update([
                        'jumlah_potongan' => str_replace(".", "", $request->jumlah_potongan)
                    ]);
                if ($update) {
                    return redirect('/pembayaran/' . Crypt::encrypt($request->no_pendaftaran) . '/show')->with(['success' => 'Data Berhasil Di Update']);
                }
            }
        }
    }


    function simpanmutasi(Request $request)
    {
        $cek = DB::table('mutasi')
            ->where('no_pendaftaran', $request->no_pendaftaran)
            ->where('kodebiaya', $request->kodebiaya)
            ->where('id_jenisbayar', $request->id_jenisbayar)
            ->first();

        if ($cek == null) {
            $simpan = DB::table('mutasi')
                ->insert([
                    'no_pendaftaran' => $request->no_pendaftaran,
                    'kodebiaya' => $request->kodebiaya,
                    'id_jenisbayar' => $request->id_jenisbayar,
                    'jumlah_mutasi' => str_replace(".", "", $request->jumlah_mutasi)
                ]);
            if ($simpan) {
                return redirect('/pembayaran/' . Crypt::encrypt($request->no_pendaftaran) . '/show')->with(['success' => 'Data Berhasil Disimpan']);
            }
        } else {
            if ($request->jumlah_mutasi == 0) {
                $hapus = DB::table('mutasi')
                    ->where('no_pendaftaran', $request->no_pendaftaran)
                    ->where('kodebiaya', $request->kodebiaya)
                    ->where('id_jenisbayar', $request->id_jenisbayar)
                    ->delete();
                if ($hapus) {
                    return redirect('/pembayaran/' . Crypt::encrypt($request->no_pendaftaran) . '/show')->with(['success' => 'Data Berhasil Di Hapus']);
                }
            } else {
                $update = DB::table('mutasi')
                    ->where('no_pendaftaran', $request->no_pendaftaran)
                    ->where('kodebiaya', $request->kodebiaya)
                    ->where('id_jenisbayar', $request->id_jenisbayar)
                    ->update([
                        'jumlah_mutasi' => str_replace(".", "", $request->jumlah_mutasi)
                    ]);
                if ($update) {
                    return redirect('/pembayaran/' . Crypt::encrypt($request->no_pendaftaran) . '/show')->with(['success' => 'Data Berhasil Di Update']);
                }
            }
        }
    }

    function laporan()
    {
        $jenjang = DB::table('unit')->where('status', 1)->get();
        $jenisbayar = Jenisbayar::orderBy('id', 'asc')->get();
        return view('pembayaran.laporan', compact('jenisbayar', 'jenjang'));
    }

    function cetak(Request $request)
    {
        $query = Historibayar_detail::query();
        if (!empty($request->dari and !empty($request->sampai))) {
            $query = $query->whereBetween('tgl_transaksi', [$request->dari, $request->sampai]);
        }

        if (!empty($request->id_jenisbayar)) {
            $query = $query->where('id_jenisbayar', $request->id_jenisbayar);
        }

        if (!empty($request->jenjang)) {
            $query = $query->where('pendaftaran.jenjang', $request->jenjang);
        }

        $dari = $request->dari;
        $sampai = $request->sampai;
        $jenisbayar = DB::table('jenisbayar')->where('id', $request->id_jenisbayar)->first();
        if ($jenisbayar != null) {
            $jb = $jenisbayar->jenisbayar;
        } else {
            $jb = "";
        }

        $query->select('historibayar_detail.*', 'tgl_transaksi', 'nis', 'nama_lengkap', 'pendaftaran.jenjang', 'jenisbayar', 'biaya.tahunakademik', 'biaya.jenjang as jenjangbiaya');
        $query->join('historibayar', 'historibayar_detail.no_transaksi', '=', 'historibayar.no_transaksi');
        $query->join('pendaftaran', 'historibayar.no_pendaftaran', '=', 'pendaftaran.no_pendaftaran');
        $query->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa');
        $query->join('biaya', 'historibayar_detail.kodebiaya', '=', 'biaya.kodebiaya');
        $query->join('jenisbayar', 'historibayar_detail.id_jenisbayar', '=', 'jenisbayar.id');
        $query->orderBy('no_transaksi', 'asc');
        $query->orderBy('tgl_transaksi', 'asc');
        $historibayar = $query->get();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('pembayaran.cetak', compact('historibayar', 'namabulan', 'dari', 'sampai', 'jb'));
    }

    function generatespp($no_pendaftaran, $kode_biaya)
    {
        $nodaftar = Crypt::decrypt($no_pendaftaran);
        $kodebiaya = Crypt::decrypt($kode_biaya);


        $cekbiaya = DB::table('biaya')
            ->where('kodebiaya', $kodebiaya)
            ->first();
        $detailbiaya = DB::table('detailbiaya')
            ->where('kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', 7)
            ->first();
        $mulai_pembayaran = $detailbiaya->mulai_pembayaran;
        $tahunakademik = $cekbiaya->tahunakademik;
        $ta = substr($tahunakademik, 2, 2) . substr($tahunakademik, 7, 2);
        $format = "RS" . $ta;
        $cekrencanaspp = DB::table('rencana_spp')
            ->select('no_rencana_spp')
            ->where('tahunakademik', $tahunakademik)
            ->join('biaya', 'rencana_spp.kodebiaya', '=', 'biaya.kodebiaya')
            ->orderBy('no_rencana_spp', 'desc')
            ->first();
        if (empty($cekrencanaspp->no_rencana_spp)) {
            $no_rencana_terakhir = $format . "000";
        } else {
            $no_rencana_terakhir = $cekrencanaspp->no_rencana_spp;
        }




        $no_rencana = buatkode($no_rencana_terakhir, $format, 3);

        //dd($cekrencanaspp);
        $cek = DB::table('rencana_spp')
            ->where('no_pendaftaran', $nodaftar)
            ->where('kodebiaya', $kodebiaya)
            ->count();


        if (empty($cek)) {
            DB::beginTransaction();
            try {

                DB::table('rencana_spp')
                    ->insert([
                        'no_rencana_spp' => $no_rencana,
                        'no_pendaftaran' => $nodaftar,
                        'kodebiaya' => $kodebiaya
                    ]);

                for ($i = 1; $i <= 12; $i++) {
                    if ($mulai_pembayaran > 12) {
                        $mulai_pembayaran = 1;
                    }
                    DB::table('rencana_spp_detail')->insert([
                        'no_rencana_spp' => $no_rencana,
                        'bulan' => $mulai_pembayaran,
                        'jumlah' => $detailbiaya->jumlah_biaya
                    ]);
                    $mulai_pembayaran++;
                }

                DB::commit();

                return redirect('/pembayaran/' . $no_pendaftaran . '/show')->with(['success' => 'Data SPP Berhasil di Generate']);
            } catch (\Exception $e) {
                dd($e);
                DB::rollback();
                return redirect('/pembayaran/' . $no_pendaftaran . '/show')->with(['danger' => 'Data SPP Gagal di Generate']);
            }
        } else {
            return redirect('/pembayaran/' . $no_pendaftaran . '/show')->with(['warning' => 'Data Rencana SPP sudah Ada']);
        }
    }


    function generateuangmakan($no_pendaftaran, $kode_biaya)
    {
        $nodaftar = Crypt::decrypt($no_pendaftaran);
        $kodebiaya = Crypt::decrypt($kode_biaya);


        $cekbiaya = DB::table('biaya')
            ->where('kodebiaya', $kodebiaya)
            ->first();
        $detailbiaya = DB::table('detailbiaya')
            ->where('kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', 39)
            ->first();
        $mulai_pembayaran = $detailbiaya->mulai_pembayaran;
        $tahunakademik = $cekbiaya->tahunakademik;
        $ta = substr($tahunakademik, 2, 2) . substr($tahunakademik, 7, 2);
        $format = "RM" . $ta;
        $cekrencanaum = DB::table('rencana_uangmakan')
            ->select('no_rencana_um')
            ->where('tahunakademik', $tahunakademik)
            ->join('biaya', 'rencana_uangmakan.kodebiaya', '=', 'biaya.kodebiaya')
            ->orderBy('no_rencana_um', 'desc')
            ->first();
        if (empty($cekrencanaum->no_rencana_um)) {
            $no_rencana_um_terakhir = $format . "000";
        } else {
            $no_rencana_um_terakhir = $cekrencanaum->no_rencana_um;
        }




        $no_rencana_um = buatkode($no_rencana_um_terakhir, $format, 3);

        //dd($cekrencanaspp);
        $cek = DB::table('rencana_uangmakan')
            ->where('no_pendaftaran', $nodaftar)
            ->where('kodebiaya', $kodebiaya)
            ->count();


        if (empty($cek)) {
            DB::beginTransaction();
            try {

                DB::table('rencana_uangmakan')
                    ->insert([
                        'no_rencana_um' => $no_rencana_um,
                        'no_pendaftaran' => $nodaftar,
                        'kodebiaya' => $kodebiaya
                    ]);

                for ($i = 1; $i <= 12; $i++) {
                    if ($mulai_pembayaran > 12) {
                        $mulai_pembayaran = 1;
                    }
                    DB::table('rencana_uangmakan_detail')->insert([
                        'no_rencana_um' => $no_rencana_um,
                        'bulan' => $mulai_pembayaran,
                        'jumlah' => $detailbiaya->jumlah_biaya
                    ]);
                    $mulai_pembayaran++;
                }

                DB::commit();

                return redirect('/pembayaran/' . $no_pendaftaran . '/show')->with(['success' => 'Data Uang Lauk Berhasil di Generate']);
            } catch (\Exception $e) {
                dd($e);
                DB::rollback();
                return redirect('/pembayaran/' . $no_pendaftaran . '/show')->with(['danger' => 'Data Uang Lauk Gagal di Generate']);
            }
        } else {
            return redirect('/pembayaran/' . $no_pendaftaran . '/show')->with(['warning' => 'Data Uang Lauk SPP sudah Ada']);
        }
    }

    function editspp(Request $request)
    {
        $rencanaspp = DB::table('rencana_spp_detail')
            ->where('no_rencana_spp', $request->no_rencana_spp)
            ->get();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('pembayaran.editspp', compact('rencanaspp', 'namabulan'));
    }

    function editum(Request $request)
    {
        $rencanaum = DB::table('rencana_uangmakan_detail')
            ->where('no_rencana_um', $request->no_rencana_um)
            ->get();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('pembayaran.editum', compact('rencanaum', 'namabulan'));
    }

    function updatespp(Request $request)
    {
        $jumlah = !empty($request->jumlah) ?  str_replace(".", "", $request->jumlah) : 0;
        $jumlah_mutasi = !empty($request->jumlah_mutasi) ? str_replace(".", "", $request->jumlah_mutasi) : 0;

        if (isset($request->jumlah_mutasi)) {
            DB::table('rencana_spp_detail')
                ->where('no_rencana_spp', $request->no_rencana_spp)
                ->where('bulan', $request->bulan)
                ->update([
                    'jumlah_mutasi' => $jumlah_mutasi,
                ]);
        } else {
            DB::table('rencana_spp_detail')
                ->where('no_rencana_spp', $request->no_rencana_spp)
                ->where('bulan', $request->bulan)
                ->update([
                    'jumlah' => $jumlah,
                ]);
        }
    }

    function updateum(Request $request)
    {
        $jumlah = !empty($request->jumlah) ? str_replace(".", "", $request->jumlah) : 0;
        $jumlah_mutasi = !empty($request->jumlah_mutasi) ? str_replace(".", "", $request->jumlah_mutasi) : 0;
        if (isset($request->jumlah_mutasi)) {
            DB::table('rencana_uangmakan_detail')
                ->where('no_rencana_um', $request->no_rencana_um)
                ->where('bulan', $request->bulan)
                ->update([
                    'jumlah_mutasi' => $jumlah_mutasi
                ]);
        } else {
            DB::table('rencana_uangmakan_detail')
                ->where('no_rencana_um', $request->no_rencana_um)
                ->where('bulan', $request->bulan)
                ->update([
                    'jumlah' => $jumlah
                ]);
        }
    }

    function laporantagihan()
    {
        $jenjang = DB::table('unit')->where('status', 1)->get();
        $jenisbayar = Jenisbayar::orderBy('id', 'asc')->get();
        $ta = Tahunakademik::all();
        return view('pembayaran.laporantagihan', compact('jenisbayar', 'jenjang', 'ta'));
    }

    function inputmutasispp(Request $request)
    {
        $rencanaspp = DB::table('rencana_spp_detail')
            ->where('no_rencana_spp', $request->no_rencana_spp)
            ->get();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('pembayaran.inputmutasispp', compact('rencanaspp', 'namabulan'));
    }


    function inputmutasium(Request $request)
    {
        $rencanaum = DB::table('rencana_uangmakan_detail')
            ->where('no_rencana_um', $request->no_rencana_um)
            ->get();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('pembayaran.inputmutasium', compact('rencanaum', 'namabulan'));
    }
}
