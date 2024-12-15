<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $tahunakademik = Tahunakademik::where('status', 1)->first();
        $query = Kelas::query();
        if (!empty($request->tahunakademik)) {
            $query->where('tahunakademik', $request->tahunakademik);
        } else {
            $query->where('tahunakademik', $tahunakademik['tahunakademik']);
        }
        if (!empty($request->jenjang)) {
            $query->where('jenjang', $request->jenjang);
        }
        if (!empty($request->tingkat)) {
            $query->where('tingkat', $request->tingkat);
        }

        $kelas = $query->get();
        $data['kelas'] = $kelas;
        return view('kelas.index', $data);
    }

    public function create()
    {
        $data['tahunakademik'] = Tahunakademik::where('status', 1)->first();
        $data['jenjang'] = DB::table('unit')->where('status', 1)->get();
        return view('kelas.create', $data);
    }

    public function store(Request $request)
    {
        $tahunakademik = Tahunakademik::where('status', 1)->first();
        $ta = explode("/", $tahunakademik['tahunakademik']);
        $taaktif = substr($ta[0], 2, 2) . substr($ta[1], 2, 2);

        try {
            $lastkelas = DB::table('kelas')->orderBy('kode_kelas', 'desc')
                ->where('tahunakademik', $tahunakademik['tahunakademik'])
                ->where('jenjang', $request->jenjang)
                ->first();
            $lastkodekelas = $lastkelas != null ? $lastkelas->kode_kelas : '';
            $format = $request->jenjang . $taaktif;

            $kode_kelas = buatkode($lastkodekelas, $format, 3);

            DB::table('kelas')->insert([
                'kode_kelas' => $kode_kelas,
                'nama_kelas' => $request->nama_kelas,
                'jenjang' => $request->jenjang,
                'tingkat' => $request->tingkat,
                'tahunakademik' => $tahunakademik['tahunakademik']
            ]);

            return redirect('/kelas')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            dd($e);
            return redirect('/kelas')->with('failed', 'Data gagal disimpan' . $e->getMessage());
        }
    }

    public function destroy($kode_delete)
    {
        $kode_delete = Crypt::decrypt($kode_delete);
        try {
            //code...
            DB::table('kelas')->where('kode_kelas', $kode_delete)->delete();
            return redirect('/kelas')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            //throw $th;
            return redirect('/kelas')->with('failed', 'Data gagal dihapus' . $e->getMessage());
        }
    }


    public function setkelas($kode_kelas)
    {
        $kode_kelas = Crypt::decrypt($kode_kelas);
        $kelas = Kelas::where('kode_kelas', $kode_kelas)->first();
        $kelassiswa = DB::table('kelas_siswa')
            ->join('pendaftaran', 'kelas_siswa.no_pendaftaran', '=', 'pendaftaran.no_pendaftaran')
            ->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa')
            ->where('kelas_siswa.kode_kelas', $kode_kelas)
            ->get();

        $data['kelassiswa'] = $kelassiswa;
        $data['kelas'] = $kelas;
        return view('kelas.setkelas', $data);
    }

    public function addkelas(Request $request)
    {
        $tahunakademik = $request->tahunakademik;
        $jenjang = $request->jenjang;
        $tingkat = $request->tingkat;
        $data['kode_kelas'] = $request->kode_kelas;
        $listsiswa = DB::table('rincian_biaya_siswa')
            ->select('rincian_biaya_siswa.no_pendaftaran', 'nama_lengkap')
            ->join('pendaftaran', 'rincian_biaya_siswa.no_pendaftaran', '=', 'pendaftaran.no_pendaftaran')
            ->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa')
            ->join('biaya', 'rincian_biaya_siswa.kodebiaya', '=', 'biaya.kodebiaya')
            ->where('biaya.tahunakademik', $tahunakademik)
            ->where('biaya.jenjang', $jenjang)
            ->where('biaya.tingkat', $tingkat)
            ->whereNotIn('rincian_biaya_siswa.no_pendaftaran', DB::table('kelas_siswa')->where('kode_kelas', $request->kode_kelas)->pluck('no_pendaftaran'))
            ->get();

        $data['listsiswa'] = $listsiswa;
        return view('kelas.addkelas', $data);
    }

    public function storesiswa(Request $request, $kode_kelas)
    {
        $no_pendaftaran = $request->no_pendaftaran;
        $kode_kelas = Crypt::decrypt($kode_kelas);
        DB::beginTransaction();
        try {
            for ($i = 0; $i < count($no_pendaftaran); $i++) {
                DB::table('kelas_siswa')->insert([
                    'kode_kelas' => $kode_kelas,
                    'no_pendaftaran' => $no_pendaftaran[$i]
                ]);
            }
            DB::commit();
            return redirect('/kelas')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect('/kelas')->with('failed', 'Data gagal disimpan' . $e->getMessage());
            //throw $th;
        }
    }

    public function destroysiswa($no_pendaftaran, $kode_kelas)
    {
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $kode_kelas = Crypt::decrypt($kode_kelas);
        DB::beginTransaction();
        try {
            DB::table('kelas_siswa')->where('no_pendaftaran', $no_pendaftaran)->where('kode_kelas', $kode_kelas)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('failed', 'Data gagal dihapus: ' . $e->getMessage());
        }
    }

    public function getkelas(Request $request)
    {
        $tahunakademik = $request->tahunakademik;
        $jenjang = $request->jenjang;
        $kelas = Kelas::where('tahunakademik', $tahunakademik)->where('jenjang', $jenjang)->get();
        return response()->json($kelas);
    }
}
