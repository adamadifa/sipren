<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jadwalpelajaran;
use App\Kelas;
use App\Matapelajaran;
use App\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class JadwalpelajaranController extends Controller
{
    public function index(Request $request)
    {
        $ta_aktif = Tahunakademik::where('status', 1)->first();
        $query = Jadwalpelajaran::query();
        $query->join('kelas', 'jadwal_pelajaran.kode_kelas', '=', 'kelas.kode_kelas');
        $query->join('matapelajaran', 'jadwal_pelajaran.kode_matpel', '=', 'matapelajaran.kode_matpel');
        $query->join('guru', 'jadwal_pelajaran.kode_guru', '=', 'guru.kode_guru');
        $query->orderBy('jadwal_pelajaran.kode_jadwal', 'desc');
        if (!empty($request->tahunakademik)) {
            $query->where('jadwal_pelajaran.tahunakademik', $request->tahunakademik);
        } else {
            $query->where('jadwal_pelajaran.tahunakademik', $ta_aktif->tahunakademik);
        }
        if (!empty($request->jenjang)) {
            $query->where('kelas.jenjang', $request->jenjang);
        }

        if (!empty($request->kode_kelas)) {
            $query->where('jadwal_pelajaran.kode_kelas', $request->kode_kelas);
        }

        if (!empty($request->kode_guru)) {
            $query->where('jadwal_pelajaran.kode_guru', $request->kode_guru);
        }

        if (Auth::guard('guru')->check()) {
            $query->where('jadwal_pelajaran.kode_guru', Auth::guard('guru')->user()->kode_guru);
        }
        $jadwal = $query->get();
        $data['jadwal'] = $jadwal;
        $data['takademik'] = Tahunakademik::all();
        $data['jenjang'] = DB::table('unit')->where('status', 1)->get();
        $data['ta_aktif'] =  $ta_aktif;
        $data['guru'] = Guru::orderBy('nama_guru', 'asc')->get();
        return view('jadwalpelajaran.index', $data);
    }

    public function create()
    {
        $tahunakademik = Tahunakademik::where('status', 1)->first();
        $data['tahunakademik'] = $tahunakademik;
        $data['kelas'] = Kelas::where('tahunakademik', $tahunakademik['tahunakademik'])->get();
        $data['matpel'] = Matapelajaran::orderBy('nama_matpel', 'asc')->get();
        $data['guru'] = Guru::orderBy('nama_guru', 'asc')->get();
        return view('jadwalpelajaran.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $tahunakademik = Tahunakademik::where('status', 1)->first();
            $ta = explode("/", $tahunakademik['tahunakademik']);
            $takademik = substr($ta[0], 2, 2) . substr($ta[1], 2, 2);
            $lastjadwal = DB::table('jadwal_pelajaran')->orderBy('kode_jadwal', 'desc')
                ->where('tahunakademik', $tahunakademik['tahunakademik'])->first();
            $last_kode_jadwal = $lastjadwal != null ? $lastjadwal->kode_jadwal : '';
            $format = "JD" . $takademik;
            $kode_jadwal = buatkode($last_kode_jadwal, $format, 4);

            DB::table('jadwal_pelajaran')->insert([
                'kode_jadwal' => $kode_jadwal,
                'semester' => $request->semester,
                'kode_matpel' => $request->kode_matpel,
                'kode_kelas' => $request->kode_kelas,
                'kode_guru' => $request->kode_guru,
                'tahunakademik' => $tahunakademik['tahunakademik'],
                'hari' => $request->hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai
            ]);

            return redirect('/jadwalpelajaran')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect('/jadwalpelajaran')->with('failed', 'Data gagal disimpan' . $e->getMessage());
        }
    }

    public function destroy($kode_jadwal)
    {
        $kode_jadwal = Crypt::decrypt($kode_jadwal);
        try {
            Jadwalpelajaran::where('kode_jadwal', $kode_jadwal)->delete();
            return redirect('/jadwalpelajaran')->with('success', 'Jadal Pelajaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/jadwalpelajaran')->with('failed', 'Jadwal Pelajaran gagal dihapus' . $e->getMessage());
        }
    }
}
