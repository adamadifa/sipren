<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
}
