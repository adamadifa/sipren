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
                    IF(DAY(presence_date)=1,CONCAT(time_in,"-",time_out),0) as tgl_1,
                    IF(DAY(presence_date)=2,CONCAT(time_in,"-",time_out),0) as tgl_2,
                    IF(DAY(presence_date)=3,CONCAT(time_in,"-",time_out),0) as tgl_3,
                    IF(DAY(presence_date)=4,CONCAT(time_in,"-",time_out),0) as tgl_4,
                    IF(DAY(presence_date)=5,CONCAT(time_in,"-",time_out),0) as tgl_5,
                    IF(DAY(presence_date)=6,CONCAT(time_in,"-",time_out),0) as tgl_6,
                    IF(DAY(presence_date)=7,CONCAT(time_in,"-",time_out),0) as tgl_7,
                    IF(DAY(presence_date)=8,CONCAT(time_in,"-",time_out),0) as tgl_8,
                    IF(DAY(presence_date)=9,CONCAT(time_in,"-",time_out),0) as tgl_9,
                    IF(DAY(presence_date)=10,CONCAT(time_in,"-",time_out),0) as tgl_10,
                    IF(DAY(presence_date)=11,CONCAT(time_in,"-",time_out),0) as tgl_11,
                    IF(DAY(presence_date)=12,CONCAT(time_in,"-",time_out),0) as tgl_12,
                    IF(DAY(presence_date)=13,CONCAT(time_in,"-",time_out),0) as tgl_13,
                    IF(DAY(presence_date)=14,CONCAT(time_in,"-",time_out),0) as tgl_14,
                    IF(DAY(presence_date)=15,CONCAT(time_in,"-",time_out),0) as tgl_15,
                    IF(DAY(presence_date)=16,CONCAT(time_in,"-",time_out),0) as tgl_16,
                    IF(DAY(presence_date)=17,CONCAT(time_in,"-",time_out),0) as tgl_17,
                    IF(DAY(presence_date)=18,CONCAT(time_in,"-",time_out),0) as tgl_18,
                    IF(DAY(presence_date)=19,CONCAT(time_in,"-",time_out),0) as tgl_19,
                    IF(DAY(presence_date)=20,CONCAT(time_in,"-",time_out),0) as tgl_20,
                    IF(DAY(presence_date)=21,CONCAT(time_in,"-",time_out),0) as tgl_21,
                    IF(DAY(presence_date)=22,CONCAT(time_in,"-",time_out),0) as tgl_22,
                    IF(DAY(presence_date)=23,CONCAT(time_in,"-",time_out),0) as tgl_23,
                    IF(DAY(presence_date)=24,CONCAT(time_in,"-",time_out),0) as tgl_24,
                    IF(DAY(presence_date)=25,CONCAT(time_in,"-",time_out),0) as tgl_25,
                    IF(DAY(presence_date)=26,CONCAT(time_in,"-",time_out),0) as tgl_26,
                    IF(DAY(presence_date)=27,CONCAT(time_in,"-",time_out),0) as tgl_27,
                    IF(DAY(presence_date)=28,CONCAT(time_in,"-",time_out),0) as tgl_28,
                    IF(DAY(presence_date)=29,CONCAT(time_in,"-",time_out),0) as tgl_29,
                    IF(DAY(presence_date)=30,CONCAT(time_in,"-",time_out),0) as tgl_30,
                    IF(DAY(presence_date)=31,CONCAT(time_in,"-",time_out),0) as tgl_31
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
                    SELECT npp,SUM(IF(DAY(presence_date)=1,1,0)) as tgl_1,
                    SUM(IF(DAY(presence_date)=2,1,0)) as tgl_2,
                    SUM(IF(DAY(presence_date)=3,1,0)) as tgl_3,
                    SUM(IF(DAY(presence_date)=4,1,0)) as tgl_4,
                    SUM(IF(DAY(presence_date)=5,1,0)) as tgl_5,
                    SUM(IF(DAY(presence_date)=6,1,0)) as tgl_6,
                    SUM(IF(DAY(presence_date)=7,1,0)) as tgl_7,
                    SUM(IF(DAY(presence_date)=8,1,0)) as tgl_8,
                    SUM(IF(DAY(presence_date)=9,1,0)) as tgl_9,
                    SUM(IF(DAY(presence_date)=10,1,0)) as tgl_10,
                    SUM(IF(DAY(presence_date)=11,1,0)) as tgl_11,
                    SUM(IF(DAY(presence_date)=12,1,0)) as tgl_12,
                    SUM(IF(DAY(presence_date)=13,1,0)) as tgl_13,
                    SUM(IF(DAY(presence_date)=14,1,0)) as tgl_14,
                    SUM(IF(DAY(presence_date)=15,1,0)) as tgl_15,
                    SUM(IF(DAY(presence_date)=16,1,0)) as tgl_16,
                    SUM(IF(DAY(presence_date)=17,1,0)) as tgl_17,
                    SUM(IF(DAY(presence_date)=18,1,0)) as tgl_18,
                    SUM(IF(DAY(presence_date)=19,1,0)) as tgl_19,
                    SUM(IF(DAY(presence_date)=20,1,0)) as tgl_20,
                    SUM(IF(DAY(presence_date)=21,1,0)) as tgl_21,
                    SUM(IF(DAY(presence_date)=22,1,0)) as tgl_22,
                    SUM(IF(DAY(presence_date)=23,1,0)) as tgl_23,
                    SUM(IF(DAY(presence_date)=24,1,0)) as tgl_24,
                    SUM(IF(DAY(presence_date)=25,1,0)) as tgl_25,
                    SUM(IF(DAY(presence_date)=26,1,0)) as tgl_26,
                    SUM(IF(DAY(presence_date)=27,1,0)) as tgl_27,
                    SUM(IF(DAY(presence_date)=28,1,0)) as tgl_28,
                    SUM(IF(DAY(presence_date)=29,1,0)) as tgl_29,
                    SUM(IF(DAY(presence_date)=30,1,0)) as tgl_30,
                    SUM(IF(DAY(presence_date)=31,1,0)) as tgl_31
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
