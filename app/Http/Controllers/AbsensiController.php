<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    function map(Request $request)
    {
        $nama = $request->nama;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        return view('absensi.map', compact('nama', 'latitude', 'longitude'));
    }

    function absenkaryawan()
    {
        return view('absensi.karyawan');
    }



    function absenkaryawanlist()
    {
        return view('absensi.karyawanlist');
    }


    function laporan()
    {
        $tahunmulai = 2021;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $unit = DB::table('unit')->orderBy('id', 'asc')->get();
        return view('absensi.laporan', compact('tahunmulai', 'namabulan', 'unit'));
    }

    function cetak(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $tglawal = $tahun . "-" . $bulan . "-01";
        $tglakhir = date('Y-m-t', strtotime($tglawal));
        $id_unit = $request->unit;
        $unit = DB::table('unit')->where('id', $request->unit)->first();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bln = $namabulan[$bulan];
        if (empty($id_unit)) {
            $absensi = DB::table("karyawand")
                ->select(
                    'karyawan.*',
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
                )
                ->leftjoin(
                    DB::raw('(
                    SELECT npp,
                    MAX(IF(DAY(presence_date)=1,CONCAT(time_in,"-",time_out),0)) as tgl_1,
                    MAX(IF(DAY(presence_date)=2,CONCAT(time_in,"-",time_out),0)) as tgl_2,
                    MAX(IF(DAY(presence_date)=3,CONCAT(time_in,"-",time_out),0)) as tgl_3,
                    MAX(IF(DAY(presence_date)=4,CONCAT(time_in,"-",time_out),0)) as tgl_4,
                    MAX(IF(DAY(presence_date)=5,CONCAT(time_in,"-",time_out),0)) as tgl_5,
                    MAX(IF(DAY(presence_date)=6,CONCAT(time_in,"-",time_out),0)) as tgl_6,
                    MAX(IF(DAY(presence_date)=7,CONCAT(time_in,"-",time_out),0)) as tgl_7,
                    MAX(IF(DAY(presence_date)=8,CONCAT(time_in,"-",time_out),0)) as tgl_8,
                    MAX(IF(DAY(presence_date)=9,CONCAT(time_in,"-",time_out),0)) as tgl_9,
                    MAX(IF(DAY(presence_date)=10,CONCAT(time_in,"-",time_out),0)) as tgl_10,
                    MAX(IF(DAY(presence_date)=11,CONCAT(time_in,"-",time_out),0)) as tgl_11,
                    MAX(IF(DAY(presence_date)=12,CONCAT(time_in,"-",time_out),0)) as tgl_12,
                    MAX(IF(DAY(presence_date)=13,CONCAT(time_in,"-",time_out),0)) as tgl_13,
                    MAX(IF(DAY(presence_date)=14,CONCAT(time_in,"-",time_out),0)) as tgl_14,
                    MAX(IF(DAY(presence_date)=15,CONCAT(time_in,"-",time_out),0)) as tgl_15,
                    MAX(IF(DAY(presence_date)=16,CONCAT(time_in,"-",time_out),0)) as tgl_16,
                    MAX(IF(DAY(presence_date)=17,CONCAT(time_in,"-",time_out),0)) as tgl_17,
                    MAX(IF(DAY(presence_date)=18,CONCAT(time_in,"-",time_out),0)) as tgl_18,
                    MAX(IF(DAY(presence_date)=19,CONCAT(time_in,"-",time_out),0)) as tgl_19,
                    MAX(IF(DAY(presence_date)=20,CONCAT(time_in,"-",time_out),0)) as tgl_20,
                    MAX(IF(DAY(presence_date)=21,CONCAT(time_in,"-",time_out),0)) as tgl_21,
                    MAX(IF(DAY(presence_date)=22,CONCAT(time_in,"-",time_out),0)) as tgl_22,
                    MAX(IF(DAY(presence_date)=23,CONCAT(time_in,"-",time_out),0)) as tgl_23,
                    MAX(IF(DAY(presence_date)=24,CONCAT(time_in,"-",time_out),0)) as tgl_24,
                    MAX(IF(DAY(presence_date)=25,CONCAT(time_in,"-",time_out),0)) as tgl_25,
                    MAX(IF(DAY(presence_date)=26,CONCAT(time_in,"-",time_out),0)) as tgl_26,
                    MAX(IF(DAY(presence_date)=27,CONCAT(time_in,"-",time_out),0)) as tgl_27,
                    MAX(IF(DAY(presence_date)=28,CONCAT(time_in,"-",time_out),0)) as tgl_28,
                    MAX(IF(DAY(presence_date)=29,CONCAT(time_in,"-",time_out),0)) as tgl_29,
                    MAX(IF(DAY(presence_date)=30,CONCAT(time_in,"-",time_out),0)) as tgl_30,
                    MAX(IF(DAY(presence_date)=31,CONCAT(time_in,"-",time_out),0)) as tgl_31
	            FROM presence
	            WHERE  presence_date BETWEEN "' . $tglawal . '" AND "' . $tglakhir . '"
	            GROUP BY npp
                ) absensi'),
                    function ($join) {
                        $join->on('karyawan.npp', '=', 'absensi.npp');
                    }
                )
                ->orderBy('nama_lengkap', 'asc')
                ->get();
        } else {
            $absensi = DB::table("karyawan")
                ->select(
                    'karyawan.*',
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
                )
                ->leftjoin(
                    DB::raw('(
                    SELECT npp,
                    MAX(IF(DAY(presence_date)=1,CONCAT(time_in,"-",time_out),0)) as tgl_1,
                    MAX(IF(DAY(presence_date)=2,CONCAT(time_in,"-",time_out),0)) as tgl_2,
                    MAX(IF(DAY(presence_date)=3,CONCAT(time_in,"-",time_out),0)) as tgl_3,
                    MAX(IF(DAY(presence_date)=4,CONCAT(time_in,"-",time_out),0)) as tgl_4,
                    MAX(IF(DAY(presence_date)=5,CONCAT(time_in,"-",time_out),0)) as tgl_5,
                    MAX(IF(DAY(presence_date)=6,CONCAT(time_in,"-",time_out),0)) as tgl_6,
                    MAX(IF(DAY(presence_date)=7,CONCAT(time_in,"-",time_out),0)) as tgl_7,
                    MAX(IF(DAY(presence_date)=8,CONCAT(time_in,"-",time_out),0)) as tgl_8,
                    MAX(IF(DAY(presence_date)=9,CONCAT(time_in,"-",time_out),0)) as tgl_9,
                    MAX(IF(DAY(presence_date)=10,CONCAT(time_in,"-",time_out),0)) as tgl_10,
                    MAX(IF(DAY(presence_date)=11,CONCAT(time_in,"-",time_out),0)) as tgl_11,
                    MAX(IF(DAY(presence_date)=12,CONCAT(time_in,"-",time_out),0)) as tgl_12,
                    MAX(IF(DAY(presence_date)=13,CONCAT(time_in,"-",time_out),0)) as tgl_13,
                    MAX(IF(DAY(presence_date)=14,CONCAT(time_in,"-",time_out),0)) as tgl_14,
                    MAX(IF(DAY(presence_date)=15,CONCAT(time_in,"-",time_out),0)) as tgl_15,
                    MAX(IF(DAY(presence_date)=16,CONCAT(time_in,"-",time_out),0)) as tgl_16,
                    MAX(IF(DAY(presence_date)=17,CONCAT(time_in,"-",time_out),0)) as tgl_17,
                    MAX(IF(DAY(presence_date)=18,CONCAT(time_in,"-",time_out),0)) as tgl_18,
                    MAX(IF(DAY(presence_date)=19,CONCAT(time_in,"-",time_out),0)) as tgl_19,
                    MAX(IF(DAY(presence_date)=20,CONCAT(time_in,"-",time_out),0)) as tgl_20,
                    MAX(IF(DAY(presence_date)=21,CONCAT(time_in,"-",time_out),0)) as tgl_21,
                    MAX(IF(DAY(presence_date)=22,CONCAT(time_in,"-",time_out),0)) as tgl_22,
                    MAX(IF(DAY(presence_date)=23,CONCAT(time_in,"-",time_out),0)) as tgl_23,
                    MAX(IF(DAY(presence_date)=24,CONCAT(time_in,"-",time_out),0)) as tgl_24,
                    MAX(IF(DAY(presence_date)=25,CONCAT(time_in,"-",time_out),0)) as tgl_25,
                    MAX(IF(DAY(presence_date)=26,CONCAT(time_in,"-",time_out),0)) as tgl_26,
                    MAX(IF(DAY(presence_date)=27,CONCAT(time_in,"-",time_out),0)) as tgl_27,
                    MAX(IF(DAY(presence_date)=28,CONCAT(time_in,"-",time_out),0)) as tgl_28,
                    MAX(IF(DAY(presence_date)=29,CONCAT(time_in,"-",time_out),0)) as tgl_29,
                    MAX(IF(DAY(presence_date)=30,CONCAT(time_in,"-",time_out),0)) as tgl_30,
                    MAX(IF(DAY(presence_date)=31,CONCAT(time_in,"-",time_out),0)) as tgl_31
	            FROM presence
	            WHERE  presence_date BETWEEN "' . $tglawal . '" AND "' . $tglakhir . '"
	            GROUP BY npp
                ) absensi'),
                    function ($join) {
                        $join->on('karyawan.npp', '=', 'absensi.npp');
                    }
                )
                ->orderBy('nama_lengkap', 'asc')
                ->where('karyawan.id_unit', $id_unit)
                ->get();
        }

        //dd($checklist);
        return view("absensi.cetak", compact('absensi', 'unit', 'bln', 'tahun'));
    }
}
