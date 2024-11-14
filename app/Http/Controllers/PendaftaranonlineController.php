<?php

namespace App\Http\Controllers;

use App\Pendaftaranonline;
use App\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PendaftaranonlineController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['ta'] = Tahunakademik::where('status', 1)->first();
        $data['tahunakademik'] = Tahunakademik::all();
        $data['jenjang'] = DB::table('unit')->where('status', 1)->get();

        $query = Pendaftaranonline::query();
        if ($request->search == 'search') {
            if (!empty($request->tahunakademik)) {
                $query->where('pendaftaran_online.tahunakademik', $request->tahunakademik);
            }


            if (!empty($request->nama_lengkap)) {
                $query->where('pendaftaran_online.nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
            }

            if (!empty($request->jenjang)) {
                $query->where('pendaftaran_online.jenjang', $request->jenjang);
            }
            //dd($request);
        } else {
            $query = $query->where('pendaftaran_online.tahunakademik', $data['ta']['tahunakademik']);
        }
        $query->select(
            'pendaftaran_online.*',
            'no_pendaftaran_online'
        );
        $query->leftJoin('pendaftaran', 'pendaftaran_online.no_pendaftaran', '=', 'pendaftaran.no_pendaftaran_online');
        // $query->where('pendaftaran.jenjang', $jenjang);
        $query->orderBy('no_pendaftaran', 'desc');
        $pendaftaran = $query->paginate(10);
        $pendaftaran->appends($request->all());
        $data['pendaftaran'] = $pendaftaran;
        return view('pendaftaranonline.index', $data);
    }

    public function proses($no_pendaftaran)
    {
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $pendaftaran = Pendaftaranonline::where('no_pendaftaran', $no_pendaftaran)->first();

        $jenjang = $pendaftaran->jenjang;
        $tingkat = $pendaftaran->jenjang == "ASRAMA" ? "ASR" : $pendaftaran->jenjang;

        $t = Tahunakademik::where('status', 1)->first();
        $ta = substr($t['tahunakademik'], 2, 2) . substr($t['tahunakademik'], 7, 2);
        $ta_pendaftaran = substr($t['tahunakademik'], 2, 2);
        //Cek Pendaftaran Terakhir
        $cekpendaftaran = DB::table('pendaftaran')
            ->select('no_pendaftaran', 'nis')
            ->where('tahunakademik', $t['tahunakademik'])
            ->where('jenjang', $jenjang)
            ->orderBy('no_pendaftaran', 'desc')
            ->first();
        $format = "REG" . $tingkat;
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


        $no_pendaftaran = buatkode($no_pendaftaran_terakhir, $format . $ta_pendaftaran, 3);
        $nis = buatkode($nis_terakhir, $format_nis, 3);

        $cekbiaya = DB::table('biaya')
            ->where('jenjang', $jenjang)
            ->where('tahunakademik', $t['tahunakademik'])
            ->where('tingkat', 1)
            ->first();
        DB::beginTransaction();
        try {

            $ceksiswa = DB::table('siswa')
                ->select('id_siswa')
                ->orderBy('id_siswa', 'desc')
                ->first();
            $idterakhir = $ceksiswa != null ? $ceksiswa->id_siswa : '';
            $id_siswa = buatkode($idterakhir, $ta, 3);

            DB::table('siswa')->insert([
                'id_siswa' => $id_siswa,
                'nisn' => $pendaftaran->nisn,
                'nama_lengkap' => $pendaftaran->nama_lengkap,
                'jenis_kelamin' => $pendaftaran->jenis_kelamin,
                'tempat_lahir' => $pendaftaran->tempat_lahir,
                'tanggal_lahir' => $pendaftaran->tanggal_lahir,
                'anak_ke' => $pendaftaran->anak_ke,
                'jml_saudara' => $pendaftaran->jml_saudara,
                'alamat' => $pendaftaran->alamat,
                'id_propinsi' => $pendaftaran->id_propinsi,
                'id_kota' => $pendaftaran->id_kota,
                'id_kecamatan' => $pendaftaran->id_kecamatan,
                'id_kelurahan' => $pendaftaran->id_kelurahan,
                'kodepos' => $pendaftaran->kodepos,
                'no_kk' => $pendaftaran->no_kk,
                'nik_ayah' => $pendaftaran->nik_ayah,
                'nama_ayah' => $pendaftaran->nama_ayah,
                'pendidikan_ayah' => $pendaftaran->pendidikan_ayah,
                'pekerjaan_ayah' => $pendaftaran->pekerjaan_ayah,
                'nik_ibu' => $pendaftaran->nik_ibu,
                'nama_ibu' => $pendaftaran->nama_ibu,
                'pendidikan_ibu' => $pendaftaran->pendidikan_ibu,
                'pekerjaan_ibu' => $pendaftaran->pekerjaan_ibu
            ]);

            DB::table('pendaftaran')->insert([
                'no_pendaftaran' => $no_pendaftaran,
                'tgl_pendaftaran' => $pendaftaran->tgl_daftar,
                'id_siswa' => $id_siswa,
                'nis' => $nis,
                'asal_sekolah' => $pendaftaran->asal_sekolah,
                'jenjang' => $jenjang,
                'tahunakademik' => $t['tahunakademik'],
                'id_user' => Auth::guard('user')->user()->id,
            ]);

            DB::commit();
            return redirect('/pendaftaranonline')->with(['success' => 'Data Berhasil di simpan']);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect('/pendaftaranonline')->with(['failed' => 'Data Gagal di simpan']);
        }
    }
}
