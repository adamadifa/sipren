<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Http\Controllers\Controller;
use App\Jadwalpelajaran;
use App\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {

        if (Auth::user()->level == "admin_ppdb") {
            return view('dashboard.ppdb');
        } else {
            $jk = DB::table('karyawan')
                ->select(DB::raw('count(*) as jmldata,jenis_kelamin'))
                ->groupBy('jenis_kelamin')
                ->get();
            $goldar = DB::table('karyawan')
                ->select(DB::raw('count(*) as jmldata,golongan_darah'))
                ->groupBy('golongan_darah')
                ->get();
            $sk = DB::table('karyawan')
                ->select(DB::raw('count(*) as jmldata,status_kepegawaian'))
                ->groupBy('status_kepegawaian')
                ->get();
            $unit = DB::table('karyawan')
                ->select(DB::raw('count(*) as jmldata,id_unit,nama_unit'))
                ->leftJoin('unit', 'karyawan.id_unit', '=', 'unit.id')
                ->groupBy('id_unit', 'nama_unit')
                ->get();

            $jmlkaryawan = DB::table('karyawan')->count();
            $jmlsiswa = DB::table('siswa')->count();

            return view('dashboard.index', compact('jmlkaryawan', 'jk', 'goldar', 'sk', 'unit', 'jmlsiswa'));
        }
    }

    public function guru(Request $request)
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
        $jadwal = $query->get();
        $data['jadwal'] = $jadwal;
        $data['takademik'] = Tahunakademik::all();
        $data['jenjang'] = DB::table('unit')->where('status', 1)->get();
        $data['ta_aktif'] =  $ta_aktif;
        $data['guru'] = Guru::orderBy('nama_guru', 'asc')->get();
        return view('dashboard.guru', $data);
    }
}
