<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckingibadahController extends Controller
{
    function checkingibadah()
    {

        return view('checkingibadah.checkibadahkaryawan');
    }

    function loadchecklistibadah(Request $request)
    {
        $npp = Auth::guard('karyawan')->user()->npp;
        $kegiatan = DB::select("SELECT kegiatan_ibadah.id,kegiatan_ibadah,kategori_ibadah,nama_kategori_ibadah,cekkegiatan
          FROM kegiatan_ibadah
          INNER JOIN kategori_ibadah ON kegiatan_ibadah.kategori_ibadah = kategori_ibadah.id
          LEFT JOIN (SELECT id_kegiatan,tanggal,COUNT(id_kegiatan) as cekkegiatan FROM checklist_ibadah
          WHERE npp = '$npp' AND tanggal = '$request->tanggal'
          GROUP BY id_kegiatan,tanggal) checklist ON (checklist.id_kegiatan = kegiatan_ibadah.id)
        ");
        return view('checkingibadah.loadchecklistibadah', compact('kegiatan'));
    }

    function storechecklistibadah(Request $request)
    {
        $npp = Auth::guard('karyawan')->user()->npp;
        DB::table('checklist_ibadah')->insert(['npp' => $npp, 'tanggal' => $request->tanggal, 'id_kegiatan' => $request->id]);
    }

    function destroychecklistibadah(Request $request)
    {
        $npp = Auth::guard('karyawan')->user()->npp;
        DB::table('checklist_ibadah')
            ->where('id_kegiatan', $request->id)
            ->where('tanggal', $request->tanggal)
            ->where('npp', $npp)
            ->delete();
    }

    function laporan()
    {
        $tahunmulai = 2021;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        if (Auth::guard('user')->user()->id_unit == 9) {
            $karyawan = DB::table('karyawan')->orderBy('nama_lengkap', 'asc')->get();
        } else {
            $karyawan = DB::table('karyawan')->orderBy('nama_lengkap', 'asc')
                ->where('id_unit', Auth::guard('user')->user()->id_unit)
                ->get();
        }

        return view('checkingibadah.laporan', compact('karyawan', 'namabulan', 'tahunmulai'));
    }

    function cetak(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $tglawal = $tahun . "-" . $bulan . "-01";
        $tglakhir = date('Y-m-t', strtotime($tglawal));
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bln = $namabulan[$bulan];
        $karyawan = DB::table('karyawan')->where('npp', $request->npp)->first();
        $checklist = DB::table("kegiatan_ibadah")
            ->select('*')
            ->leftjoin(
                DB::raw('(
                    SELECT id_kegiatan,SUM(IF(DAY(tanggal)=1,1,0)) as tgl_1,
                    SUM(IF(DAY(tanggal)=2,1,0)) as tgl_2,
                    SUM(IF(DAY(tanggal)=3,1,0)) as tgl_3,
                    SUM(IF(DAY(tanggal)=4,1,0)) as tgl_4,
                    SUM(IF(DAY(tanggal)=5,1,0)) as tgl_5,
                    SUM(IF(DAY(tanggal)=6,1,0)) as tgl_6,
                    SUM(IF(DAY(tanggal)=7,1,0)) as tgl_7,
                    SUM(IF(DAY(tanggal)=8,1,0)) as tgl_8,
                    SUM(IF(DAY(tanggal)=9,1,0)) as tgl_9,
                    SUM(IF(DAY(tanggal)=10,1,0)) as tgl_10,
                    SUM(IF(DAY(tanggal)=11,1,0)) as tgl_11,
                    SUM(IF(DAY(tanggal)=12,1,0)) as tgl_12,
                    SUM(IF(DAY(tanggal)=13,1,0)) as tgl_13,
                    SUM(IF(DAY(tanggal)=14,1,0)) as tgl_14,
                    SUM(IF(DAY(tanggal)=15,1,0)) as tgl_15,
                    SUM(IF(DAY(tanggal)=16,1,0)) as tgl_16,
                    SUM(IF(DAY(tanggal)=17,1,0)) as tgl_17,
                    SUM(IF(DAY(tanggal)=18,1,0)) as tgl_18,
                    SUM(IF(DAY(tanggal)=19,1,0)) as tgl_19,
                    SUM(IF(DAY(tanggal)=20,1,0)) as tgl_20,
                    SUM(IF(DAY(tanggal)=21,1,0)) as tgl_21,
                    SUM(IF(DAY(tanggal)=22,1,0)) as tgl_22,
                    SUM(IF(DAY(tanggal)=23,1,0)) as tgl_23,
                    SUM(IF(DAY(tanggal)=24,1,0)) as tgl_24,
                    SUM(IF(DAY(tanggal)=25,1,0)) as tgl_25,
                    SUM(IF(DAY(tanggal)=26,1,0)) as tgl_26,
                    SUM(IF(DAY(tanggal)=27,1,0)) as tgl_27,
                    SUM(IF(DAY(tanggal)=28,1,0)) as tgl_28,
                    SUM(IF(DAY(tanggal)=29,1,0)) as tgl_29,
                    SUM(IF(DAY(tanggal)=30,1,0)) as tgl_30,
                    SUM(IF(DAY(tanggal)=31,1,0)) as tgl_31
	            FROM checklist_ibadah
	            WHERE npp = "' . $request->npp . '" AND tanggal BETWEEN "' . $tglawal . '" AND "' . $tglakhir . '"
	            GROUP BY id_kegiatan
                ) checklist'),
                function ($join) {
                    $join->on('kegiatan_ibadah.id', '=', 'checklist.id_kegiatan');
                }
            )
            ->get();
        //dd($checklist);
        return view("checkingibadah.cetak", compact('checklist', 'karyawan', 'bln', 'tahun'));
    }

    function listpengisianibadahharian()
    {
        $hariini = date('Y-m-d');
        $list = DB::table('checklist_ibadah')
            ->select('checklist_ibadah.npp', 'nama_lengkap')
            ->join('karyawan', 'checklist_ibadah.npp', '=', 'karyawan.npp')
            ->where('tanggal', $hariini)
            ->groupBy('checklist_ibadah.npp', 'nama_lengkap')
            ->get();
        return view('checkingibadah.listpengisian', compact('list'));
    }

    public function karyawanlist()
    {
        return view('checkingibadah.karyawanlist');
    }

    function rekap()
    {
        $tahunmulai = 2021;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $unit = DB::table('unit')->orderBy('id', 'asc')->get();
        return view('checkingibadah.rekap', compact('tahunmulai', 'namabulan', 'unit'));
    }

    public function cetakrekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $unit = $request->unit;
        $tglawal = $tahun . "-" . $bulan . "-01";
        $tglakhir = date('Y-m-t', strtotime($tglawal));
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bln = $namabulan[$bulan];
        $query = Karyawan::query();
        $query->select(
            'karyawan.npp',
            'karyawan.nama_lengkap',
            'tgl_1',
            'tgl_2',
            'tgl_3',
            'tgl_4',
            'tgl_5',
            'tgl_6',
            'tgl_7',
            'tgl_8',
            'tgl_9',
            'tgl_10',
            'tgl_11',
            'tgl_12',
            'tgl_13',
            'tgl_14',
            'tgl_15',
            'tgl_16',
            'tgl_17',
            'tgl_18',
            'tgl_19',
            'tgl_20',
            'tgl_21',
            'tgl_22',
            'tgl_23',
            'tgl_24',
            'tgl_25',
            'tgl_26',
            'tgl_27',
            'tgl_28',
            'tgl_29',
            'tgl_30',
            'tgl_31'
        );
        $query->leftjoin(
            DB::raw('(
                    SELECT npp, IF(SUM(IF(DAY(tanggal) = 1,1,0)) > 0 ,1,0) as tgl_1,
                    IF(SUM(IF(DAY(tanggal) = 2,1,0)) > 0 ,1,0) as tgl_2,
                    IF(SUM(IF(DAY(tanggal) = 3,1,0)) > 0 ,1,0) as tgl_3,
                    IF(SUM(IF(DAY(tanggal) = 4,1,0)) > 0 ,1,0) as tgl_4,
                    IF(SUM(IF(DAY(tanggal) = 5,1,0)) > 0 ,1,0) as tgl_5,
                    IF(SUM(IF(DAY(tanggal) = 6,1,0)) > 0 ,1,0) as tgl_6,
                    IF(SUM(IF(DAY(tanggal) = 7,1,0)) > 0 ,1,0) as tgl_7,
                    IF(SUM(IF(DAY(tanggal) = 8,1,0)) > 0 ,1,0) as tgl_8,
                    IF(SUM(IF(DAY(tanggal) = 9,1,0)) > 0 ,1,0) as tgl_9,
                    IF(SUM(IF(DAY(tanggal) = 10,1,0)) > 0 ,1,0) as tgl_10,
                    IF(SUM(IF(DAY(tanggal) = 11,1,0)) > 0 ,1,0) as tgl_11,
                    IF(SUM(IF(DAY(tanggal) = 12,1,0)) > 0 ,1,0) as tgl_12,
                    IF(SUM(IF(DAY(tanggal) = 13,1,0)) > 0 ,1,0) as tgl_13,
                    IF(SUM(IF(DAY(tanggal) = 14,1,0)) > 0 ,1,0) as tgl_14,
                    IF(SUM(IF(DAY(tanggal) = 15,1,0)) > 0 ,1,0) as tgl_15,
                    IF(SUM(IF(DAY(tanggal) = 16,1,0)) > 0 ,1,0) as tgl_16,
                    IF(SUM(IF(DAY(tanggal) = 17,1,0)) > 0 ,1,0) as tgl_17,
                    IF(SUM(IF(DAY(tanggal) = 18,1,0)) > 0 ,1,0) as tgl_18,
                    IF(SUM(IF(DAY(tanggal) = 19,1,0)) > 0 ,1,0) as tgl_19,
                    IF(SUM(IF(DAY(tanggal) = 20,1,0)) > 0 ,1,0) as tgl_20,
                    IF(SUM(IF(DAY(tanggal) = 21,1,0)) > 0 ,1,0) as tgl_21,
                    IF(SUM(IF(DAY(tanggal) = 22,1,0)) > 0 ,1,0) as tgl_22,
                    IF(SUM(IF(DAY(tanggal) = 23,1,0)) > 0 ,1,0) as tgl_23,
                    IF(SUM(IF(DAY(tanggal) = 24,1,0)) > 0 ,1,0) as tgl_24,
                    IF(SUM(IF(DAY(tanggal) = 25,1,0)) > 0 ,1,0) as tgl_25,
                    IF(SUM(IF(DAY(tanggal) = 26,1,0)) > 0 ,1,0) as tgl_26,
                    IF(SUM(IF(DAY(tanggal) = 27,1,0)) > 0 ,1,0) as tgl_27,
                    IF(SUM(IF(DAY(tanggal) = 28,1,0)) > 0 ,1,0) as tgl_28,
                    IF(SUM(IF(DAY(tanggal) = 29,1,0)) > 0 ,1,0) as tgl_29,
                    IF(SUM(IF(DAY(tanggal) = 30,1,0)) > 0 ,1,0) as tgl_30,
                    IF(SUM(IF(DAY(tanggal) = 31,1,0)) > 0 ,1,0) as tgl_31
                    FROM checklist_ibadah
            WHERE  tanggal BETWEEN "' . $tglawal . '" AND "' . $tglakhir . '"
            GROUP BY npp
            ) checklist'),
            function ($join) {
                $join->on('karyawan.npp', '=', 'checklist.npp');
            }
        );
        if (!empty($unit)) {
            $query->where('id_unit', $unit);
        }
        $query->orderBy('nama_lengkap', 'asc');
        $checklist = $query->get();

        return view("checkingibadah.cetakrekap", compact('checklist', 'bln', 'tahun'));
    }
}
