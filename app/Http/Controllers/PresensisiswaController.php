<?php

namespace App\Http\Controllers;

use App\Detailpresensisiswa;
use App\Jadwalpelajaran;
use App\Kelassiswa;
use App\Presensisiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PresensisiswaController extends Controller
{
    public function create($kode_jadwal)
    {
        $kode_jadwal = Crypt::decrypt($kode_jadwal);
        $query = Jadwalpelajaran::query();
        $query->join('kelas', 'jadwal_pelajaran.kode_kelas', '=', 'kelas.kode_kelas');
        $query->join('matapelajaran', 'jadwal_pelajaran.kode_matpel', '=', 'matapelajaran.kode_matpel');
        $query->join('guru', 'jadwal_pelajaran.kode_guru', '=', 'guru.kode_guru');
        $query->where('kode_jadwal', $kode_jadwal);
        $jadwal = $query->first();

        $siswa_kelas = Kelassiswa::where('kode_kelas', $jadwal->kode_kelas)
            ->join('pendaftaran', 'kelas_siswa.no_pendaftaran', '=', 'pendaftaran.no_pendaftaran')
            ->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa')
            ->get();
        $data['siswa_kelas'] = $siswa_kelas;
        $data['jadwal'] = $jadwal;
        return view('presensisiswa.create', $data);
    }

    public function store(Request $request, $kode_jadwal)
    {
        $no_pendaftaran = $request->no_pendaftaran;
        $status = $request->status;
        DB::beginTransaction();
        try {
            //code...
            $kode_jadwal = Crypt::decrypt($kode_jadwal);
            $presensi = Presensisiswa::create([
                'kode_jadwal' => $kode_jadwal,
                'tanggal' => $request->tanggal,
                'materi_pokok' => $request->materi_pokok
            ]);

            for ($i = 0; $i < count($no_pendaftaran); $i++) {
                Detailpresensisiswa::create([
                    'id_presensi' => $presensi->id,
                    'no_pendaftaran' => $no_pendaftaran[$i],
                    'status' => $status[$i]
                ]);
            }
            DB::commit();
            if (Auth::guard('guru')->check()) {
                return redirect('/dashboardguru')->with('success', 'Data berhasil disimpan');
            }
            return redirect('/jadwalpelajaran')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            if (Auth::guard('guru')->check()) {
                return redirect('/dashboardguru')->with('success', 'Data berhasil disimpan');
            }
            return redirect('/jadwalpelajaran')->with('failed', 'Data gagal disimpan' . $e->getMessage());
        }
    }

    public function cetak($kode_jadwal)
    {
        $kode_jadwal = Crypt::decrypt($kode_jadwal);
        $query = Jadwalpelajaran::query();
        $query->join('kelas', 'jadwal_pelajaran.kode_kelas', '=', 'kelas.kode_kelas');
        $query->join('matapelajaran', 'jadwal_pelajaran.kode_matpel', '=', 'matapelajaran.kode_matpel');
        $query->join('guru', 'jadwal_pelajaran.kode_guru', '=', 'guru.kode_guru');
        $query->where('kode_jadwal', $kode_jadwal);
        $jadwal = $query->first();

        $presensi = Presensisiswa::where('kode_jadwal', $jadwal->kode_jadwal)->get();
        $detailpresensi = Detailpresensisiswa::join('presensi_siswa', 'presensi_siswa_detail.id_presensi', '=', 'presensi_siswa.id')
            ->select('presensi_siswa_detail.no_pendaftaran', 'presensi_siswa_detail.status', 'presensi_siswa.tanggal')
            ->where('presensi_siswa.kode_jadwal', $jadwal->kode_jadwal)
            ->orderBy('presensi_siswa.tanggal', 'asc');

        $siswa_kelas = Kelassiswa::where('kode_kelas', $jadwal->kode_kelas)
            ->select('kelas_siswa.no_pendaftaran', 'siswa.nama_lengkap', 'pendaftaran.nis', 'detailpresensi.tanggal', 'detailpresensi.status')
            ->join('pendaftaran', 'kelas_siswa.no_pendaftaran', '=', 'pendaftaran.no_pendaftaran')
            ->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa')
            ->leftjoinSub($detailpresensi, 'detailpresensi', 'kelas_siswa.no_pendaftaran', '=', 'detailpresensi.no_pendaftaran')
            ->get();

        $presensikelas = $siswa_kelas->groupBy('no_pendaftaran')->map(function ($rows) {
            $data = [
                'no_pendaftaran' => $rows->first()->no_pendaftaran,
                'nis' => $rows->first()->nis,
                'nama_lengkap' => $rows->first()->nama_lengkap
            ];
            foreach ($rows as $row) {
                $data[$row->tanggal] = [
                    'status' => $row->status,
                ];
            }
            return $data;
        });

        $data['presensi'] = $presensi;
        $data['presensikelas'] = $presensikelas;

        $data['siswa_kelas'] = $siswa_kelas;
        $data['jadwal'] = $jadwal;
        return view('presensisiswa.cetak', $data);
    }
}
