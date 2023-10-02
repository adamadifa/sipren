<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Pendaftaran;
use App\Propinsi;
use App\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

class PendaftaranController extends Controller
{
    function index($jenjang, Request $request)
    {


        $ta = Tahunakademik::where('status', 1)->first();
        $query = Pendaftaran::query();
        if ($request->search == 'search') {
            if (!empty($request->tahunakademik)) {
                $query = $query->where('tahunakademik', $request->tahunakademik);
            }

            if (!empty($request->nis)) {
                $query = $query->where('nis', $request->nis);
            }

            if (!empty($request->nama_lengkap)) {
                $query = $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
            }
            //dd($request);
        } else {
            $query = $query->where('tahunakademik', $ta['tahunakademik']);
        }
        $query->select('no_pendaftaran', 'tgl_pendaftarand', 'nis', 'nisn', 'nama_lengkap', 'jenis_kelamin', 'tanggal_lahir');
        $query->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa');
        $query->where('pendaftaran.jenjang', $jenjang);
        $query->orderBy('no_pendaftaran', 'desc');
        $pendaftaran = $query->paginate(10);
        $pendaftaran->appends($request->all());
        // $pendaftaran = DB::table('pendaftaran')
        //     ->select('no_pendaftaran', 'tgl_pendaftaran', 'nis', 'nisn', 'nama_lengkap', 'jenis_kelamin', 'tanggal_lahir')
        //     ->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa')
        //     ->where('pendaftaran.jenjang', $jenjang)
        //     ->orderBy('no_pendaftaran', 'desc')
        //     ->get();

        $tahunakademik = Tahunakademik::all();
        return view('pendaftaran.index', compact('jenjang', 'pendaftaran', 'tahunakademik', 'ta'));
    }

    function create($jenjang)
    {
        $ta = Tahunakademik::where('status', 1)->first();
        $pekerjaan = DB::table('pekerjaan')->orderBy('id', 'asc')->get();
        $propinsi = Propinsi::orderBy('prov_name', 'asc')->get();
        return view('pendaftaran.create', compact('propinsi', 'pekerjaan', 'jenjang', 'ta'));
    }


    function store(Request $request)
    {
        $jenjang = $request->jenjang;
        $id_siswa = $request->id_siswa;
        $t = Tahunakademik::where('status', 1)->first();
        $ta = substr($t['tahunakademik'], 2, 2) . substr($t['tahunakademik'], 7, 2);

        //Cek Pendaftaran Terakhir
        $cekpendaftaran = DB::table('pendaftaran')
            ->select('no_pendaftaran', 'nis')
            ->where('tahunakademik', $t['tahunakademik'])
            ->where('jenjang', $jenjang)
            ->orderBy('no_pendaftaran', 'desc')
            ->first();
        $format = "REG" . $jenjang;
        $format_nis = $ta . "." . "7.";


        if (empty($cekpendaftaran->no_pendaftaran)) {
            $no_pendaftaran_terakhir = $format . $ta . "000";
        } else {
            $no_pendaftaran_terakhir = $cekpendaftaran->no_pendaftaran;
        }

        if (empty($cekpendaftaran->nis)) {
            $nis_terakhir = $format_nis . "000";
        } else {
            $nis_terakhir = $cekpendaftaran->nis;
        }


        $no_pendaftaran = buatkode($no_pendaftaran_terakhir, $format . $ta, 3);
        $nis = buatkode($nis_terakhir, $format_nis, 3);

        $cekbiaya = DB::table('biaya')
            ->where('jenjang', $jenjang)
            ->where('tahunakademik', $t['tahunakademik'])
            ->where('tingkat', 1)
            ->first();
        if (empty($id_siswa)) {

            //Cek ID Siswa Terakhir
            $ceksiswa = DB::table('siswa')
                ->select('id_siswa')
                ->orderBy('id_siswa', 'desc')
                ->first();
            $idterakhir = $ceksiswa->id_siswa;
            $id_siswa = buatkode($idterakhir, $ta, 3);

            if ($jenjang != 'TK') {
                $request->validate([
                    'tgl_pendaftaran' => 'required',
                    'asal_sekolah' => 'required',
                    'nisn' => '',
                    'nama_lengkap' => 'required',
                    'jenis_kelamin' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'anak_ke' => 'required|numeric',
                    'jml_saudara' => 'required|numeric',
                    'alamat' => 'required',
                    'id_propinsi' => 'required',
                    'id_kota' => 'required',
                    'id_kecamatan' => 'required',
                    'id_kelurahan' => 'required',
                    'kodepos' => 'required',
                    'no_kk' => 'required|numeric',
                    'nik_ayah' => 'required|numeric',
                    'nama_ayah' => 'required',
                    'pendidikan_ayah' => 'required',
                    'pekerjaan_ayah' => 'required',
                    'nik_ibu' => 'required',
                    'nama_ibu' => 'required',
                    'pendidikan_ibu' => 'required',
                    'pekerjaan_ibu' => 'required'

                ]);
            } else {
                $request->validate([
                    'tgl_pendaftaran' => 'required',
                    'nisn' => '',
                    'nama_lengkap' => 'required',
                    'jenis_kelamin' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'anak_ke' => 'required|numeric',
                    'jml_saudara' => 'required|numeric',
                    'alamat' => 'required',
                    'id_propinsi' => 'required',
                    'id_kota' => 'required',
                    'id_kecamatan' => 'required',
                    'id_kelurahan' => 'required',
                    'kodepos' => 'required',
                    'no_kk' => 'required|numeric',
                    'nik_ayah' => 'required|numeric',
                    'nama_ayah' => 'required',
                    'pendidikan_ayah' => 'required',
                    'pekerjaan_ayah' => 'required',
                    'nik_ibu' => 'required',
                    'nama_ibu' => 'required',
                    'pendidikan_ibu' => 'required',
                    'pekerjaan_ibu' => 'required'
                ]);
            }

            if (empty($cekbiaya->kodebiaya)) {
                return redirect('/pendaftaran/' . $jenjang)->with(['failed' => 'Data Gagal Disimpan, Karena Biaya untuk  Jenjang Tersebut Belum di atur']);
            } else {
                $simpansiswa = DB::table('siswa')->insert([
                    'id_siswa' => $id_siswa,
                    'nisn' => $request->nisn,
                    'nama_lengkap' => $request->nama_lengkap,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'anak_ke' => $request->anak_ke,
                    'jml_saudara' => $request->jml_saudara,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'alamat' => $request->alamat,
                    'id_propinsi' => $request->id_propinsi,
                    'id_kota' => $request->id_kota,
                    'id_kecamatan' => $request->id_kecamatan,
                    'id_kelurahan' => $request->id_kelurahan,
                    'kodepos' => $request->kodepos,
                    'no_kk' => $request->no_kk,
                    'nik_ayah' => $request->nik_ayah,
                    'nama_ayah' => $request->nama_ayah,
                    'pendidikan_ayah' => $request->pendidikan_ayah,
                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'nik_ibu' => $request->nik_ibu,
                    'nama_ibu' => $request->nama_ibu,
                    'pendidikan_ibu' => $request->pendidikan_ibu,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu
                ]);

                if ($simpansiswa) {
                    $simpanpendaftaran = DB::table('pendaftaran')->insert([
                        'no_pendaftaran' => $no_pendaftaran,
                        'tgl_pendaftaran' => $request->tgl_pendaftaran,
                        'id_siswa' => $id_siswa,
                        'nis' => $nis,
                        'asal_sekolah' => $request->asal_sekolah,
                        'npsn' => $request->npsn,
                        'nomor_peserta_ujian' => $request->no_peserta_ujian,
                        'no_ijazah' => $request->no_ijazah,
                        'no_shun' => $request->no_shun,
                        'tanggal_lulus' => $request->tanggal_lulus,
                        'nilai_us' => $request->nilai_us,
                        'jenjang' => $jenjang,
                        'tahunakademik' => $t['tahunakademik'],
                        'id_user' => Auth::guard('user')->user()->id,
                    ]);

                    if ($simpanpendaftaran) {
                        $simpanrincianbiaya = DB::table('rincian_biaya_siswa')->insert([
                            'no_pendaftaran' => $no_pendaftaran,
                            'kodebiaya' => $cekbiaya->kodebiaya
                        ]);
                        if ($simpanrincianbiaya) {
                            return redirect('/pendaftaran/' . $jenjang)->with(['success' => 'Data Berhasil Disimpan']);
                        } else {
                            DB::table('siswa')
                                ->where('id_siswa', $id_siswa)
                                ->delete();
                            DB::table('pendaftaran')
                                ->where('no_pendaftaran', $no_pendaftaran)
                                ->delete();
                            return redirect('/pendaftaran/' . $jenjang)->with(['failed' => 'Data Gagal Disimpan']);
                        }
                    } else {
                        DB::table('siswa')
                            ->where('id_siswa', $id_siswa)
                            ->delete();
                        return redirect('/pendaftaran/' . $jenjang)->with(['failed' => 'Data Gagal Disimpan']);
                    }
                } else {
                    return redirect('/pendaftaran/' . $jenjang)->with(['failed' => 'Data Gagal Disimpan']);
                }
            }
        } else {
            if ($jenjang != 'TK') {
                $request->validate([
                    'tgl_pendaftaran' => 'required',
                    'asal_sekolah' => 'required',
                ]);
            } else {
                $request->validate([
                    'tgl_pendaftaran' => 'required',
                ]);
            }
            if (empty($cekbiaya->kodebiaya)) {
                return redirect('/pendaftaran/' . $jenjang)->with(['failed' => 'Data Gagal Disimpan, Karena Biaya untuk  Jenjang Tersebut Belum di atur']);
            } else {
                $simpanpendaftaran = DB::table('pendaftaran')->insert([
                    'no_pendaftaran' => $no_pendaftaran,
                    'tgl_pendaftaran' => $request->tgl_pendaftaran,
                    'id_siswa' => $id_siswa,
                    'nis' => $nis,
                    'asal_sekolah' => $request->asal_sekolah,
                    'npsn' => $request->npsn,
                    'nomor_peserta_ujian' => $request->no_peserta_ujian,
                    'no_ijazah' => $request->no_ijazah,
                    'no_shun' => $request->no_shun,
                    'tanggal_lulus' => $request->tanggal_lulus,
                    'nilai_us' => $request->nilai_us,
                    'jenjang' => $jenjang,
                    'tahunakademik' => $t['tahunakademik'],
                    'id_user' => Auth::guard('user')->user()->id,
                ]);

                if ($simpanpendaftaran) {
                    $simpanrincianbiaya = DB::table('rincian_biaya_siswa')->insert([
                        'no_pendaftaran' => $no_pendaftaran,
                        'kodebiaya' => $cekbiaya->kodebiaya
                    ]);
                    if ($simpanrincianbiaya) {
                        return redirect('/pendaftaran/' . $jenjang)->with(['success' => 'Data Berhasil Disimpan']);
                    } else {
                        DB::table('pendaftaran')
                            ->where('no_pendaftaran', $no_pendaftaran)
                            ->delete();
                        return redirect('/pendaftaran/' . $jenjang)->with(['failed' => 'Data Gagal Disimpan']);
                    }
                } else {
                    return redirect('/pendaftaran/' . $jenjang)->with(['failded' => 'Data Gagal Disimpan']);
                }
            }
        }
    }

    function edit($jenjang, $no_pendaftaran)
    {
        $propinsi = Propinsi::orderBy('id', 'asc')->get();
        $pekerjaan = DB::table('pekerjaan')->orderBy('id', 'asc')->get();
        $pendaftaran = DB::table('pendaftaran')
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
                'id_kota',
                'id_kecamatan',
                'id_kelurahan',
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
            ->where('no_pendaftaran', $no_pendaftaran)
            ->first();
        return view('pendaftaran.edit', compact('pendaftaran', 'propinsi', 'pekerjaan'));
    }

    function update($no_pendaftaran, Request $request)
    {
        if ($request->jenjang != 'TK') {
            $request->validate([
                'tgl_pendaftaran' => 'required',
                'asal_sekolah' => 'required',
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'anak_ke' => 'required|numeric',
                'jml_saudara' => 'required|numeric',
                'alamat' => 'required',
                'id_propinsi' => 'required',
                'id_kota' => 'required',
                'id_kecamatan' => 'required',
                'id_kelurahan' => 'required',
                'kodepos' => 'required',
                'no_kk' => 'required|numeric',
                'nik_ayah' => 'required|numeric',
                'nama_ayah' => 'required',
                'pendidikan_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'nik_ibu' => 'required',
                'nama_ibu' => 'required',
                'pendidikan_ibu' => 'required',
                'pekerjaan_ibu' => 'required'

            ]);
        } else {
            $request->validate([
                'tgl_pendaftaran' => 'required',
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'anak_ke' => 'required|numeric',
                'jml_saudara' => 'required|numeric',
                'alamat' => 'required',
                'id_propinsi' => 'required',
                'id_kota' => 'required',
                'id_kecamatan' => 'required',
                'id_kelurahan' => 'required',
                'kodepos' => 'required',
                'no_kk' => 'required|numeric',
                'nik_ayah' => 'required|numeric',
                'nama_ayah' => 'required',
                'pendidikan_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'nik_ibu' => 'required',
                'nama_ibu' => 'required',
                'pendidikan_ibu' => 'required',
                'pekerjaan_ibu' => 'required'
            ]);
        }

        $updatependaftaran = DB::table('pendaftaran')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->update([
                'no_pendaftaran' => $no_pendaftaran,
                'tgl_pendaftaran' => $request->tgl_pendaftaran,
                'asal_sekolah' => $request->asal_sekolah,
                'npsn' => $request->npsn,
                'nomor_peserta_ujian' => $request->no_peserta_ujian,
                'no_ijazah' => $request->no_ijazah,
                'no_shun' => $request->no_shun,
                'tanggal_lulus' => $request->tanggal_lulus,
                'nilai_us' => $request->nilai_us,
                'id_user' => Auth::guard('user')->user()->id,
            ]);

        $updatesiswa = DB::table('siswa')
            ->where('id_siswa', $request->id_siswa)
            ->update([
                'nisn' => $request->nisn,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'anak_ke' => $request->anak_ke,
                'jml_saudara' => $request->jml_saudara,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'id_propinsi' => $request->id_propinsi,
                'id_kota' => $request->id_kota,
                'id_kecamatan' => $request->id_kecamatan,
                'id_kelurahan' => $request->id_kelurahan,
                'kodepos' => $request->kodepos,
                'no_kk' => $request->no_kk,
                'nik_ayah' => $request->nik_ayah,
                'nama_ayah' => $request->nama_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nik_ibu' => $request->nik_ibu,
                'nama_ibu' => $request->nama_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu
            ]);

        if ($updatependaftaran || $updatesiswa) {
            return redirect('/pendaftaran/' . $request->jenjang . '/' . $no_pendaftaran . '/show')->with(['success' => 'Data Berhasil di Update']);
        } else {
            return  redirect('/pendaftaran/' . $request->jenjang . '/' . $no_pendaftaran . '/show')->with(['failed' => 'Data Gagal Update']);
        }
    }

    function destroy($jenjang, $no_pendaftaran)
    {
        try {
            $hapuspendaftaran = DB::table('pendaftaran')
                ->where('no_pendaftaran', $no_pendaftaran)
                ->delete();
            if ($hapuspendaftaran) {
                return redirect('/pendaftaran/' . $jenjang)->with(['success' => 'Data Berhasil di hapus']);
            } else {
                return redirect('/pendaftaran/' . $jenjang)->with(['success' => 'Data Gagal di hapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            if ($errorcode == 23000) {
                return redirect('/pendaftaran/' . $jenjang)->with(['failed' => 'Data Pendaftaran tidak dapat dihapus karena memiliki histori transaksi !']);
            }
        }
    }

    function show($jenjang, $no_pendaftaran)
    {
        $pendaftaran = DB::table('pendaftaran')
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
        return view('pendaftaran.show', compact('pendaftaran'));
    }


    function formpsb()
    {
        $ta = Tahunakademik::where('status', 1)->first();
        $pekerjaan = DB::table('pekerjaan')->orderBy('id', 'asc')->get();
        $propinsi = Propinsi::orderBy('prov_name', 'asc')->get();
        return view('pendaftaran.form-psb', compact('propinsi', 'pekerjaan', 'ta'));
    }
}
