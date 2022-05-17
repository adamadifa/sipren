<?php

namespace App\Http\Controllers;

use App\Biaya;
use App\Http\Controllers\Controller;
use App\Jenisbayar;
use App\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BiayaController extends Controller
{
    function index()
    {
        $id_unit = Auth::guard('user')->user()->id_unit;
        $unit = DB::table('unit')->where('id', $id_unit)->first();
        $ta = Tahunakademik::all();
        $jenjang = DB::table('unit')->where('status', 1)->get();
        return view('biaya.index', compact('ta', 'jenjang', 'id_unit', 'unit'));
    }

    function create()
    {
        $ta = Tahunakademik::where('status', 1)->first();
        $jenjang = DB::table('unit')->where('status', 1)->get();
        $jb = Jenisbayar::orderBy('id', 'asc')->get();
        return view('biaya.create', compact('ta', 'jenjang', 'jb'));
    }

    function edit($kodebiaya)
    {

        $jenjang = DB::table('unit')->where('status', 1)->get();
        $jb = Jenisbayar::orderBy('id', 'asc')->get();
        $biaya = Biaya::where('kodebiaya', $kodebiaya)->first();
        return view('biaya.edit', compact('jenjang', 'jb', 'biaya'));
    }

    function storetemp(Request $request)
    {

        $kodebiaya = $request->kodebiaya;
        $id_jenisbayar = $request->jenisbayar;
        $jumlah_biaya = str_replace(".", "", $request->jumlah_biaya);
        $cek = DB::table('tmp_detailbiaya')
            ->where('kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', $id_jenisbayar)
            ->count();
        if ($cek > 0) {
            echo "2";
        } else {
            $simpan = DB::table('tmp_detailbiaya')->insert([
                'kodebiaya' => $kodebiaya,
                'id_jenisbayar' => $id_jenisbayar,
                'jumlah_biaya' => $jumlah_biaya
            ]);
            if ($simpan) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

    function showtemp(Request $request)
    {
        $kodebiaya = $request->kodebiaya;

        $biayatemp = DB::table('tmp_detailbiaya')
            ->join('jenisbayar', 'tmp_detailbiaya.id_jenisbayar', '=', 'jenisbayar.id')
            ->where('kodebiaya', $kodebiaya)
            ->get();

        return view('biaya.showtemp', compact('biayatemp'));
    }

    function destroytemp(Request $request)
    {
        $kodebiaya = $request->kodebiaya;
        $jenisbayar = $request->jenisbayar;
        DB::table('tmp_detailbiaya')
            ->where('kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', $jenisbayar)
            ->delete();
    }

    function cektemp(Request $request)
    {
        $kodebiaya = $request->kodebiaya;

        $biayatemp = DB::table('tmp_detailbiaya')
            ->join('jenisbayar', 'tmp_detailbiaya.id_jenisbayar', '=', 'jenisbayar.id')
            ->where('kodebiaya', $kodebiaya)
            ->count();

        echo $biayatemp;
    }
    function store(Request $request)
    {
        $simpan = DB::table('biaya')->insert([
            'kodebiaya' => $request->kodebiaya,
            'jenjang' => $request->jenjang,
            'tingkat' => $request->tingkat,
            'tahunakademik' => $request->tahunakademik
        ]);
        if ($simpan) {
            $berhasil = 0;
            $error = 0;
            $detailbiaya = DB::table('tmp_detailbiaya')
                ->where('kodebiaya', $request->kodebiaya)
                ->get();
            foreach ($detailbiaya as $d) {
                $simpandetail = DB::table('detailbiaya')->insert([
                    'kodebiaya' => $d->kodebiaya,
                    'id_jenisbayar' => $d->id_jenisbayar,
                    'jumlah_biaya' => $d->jumlah_biaya
                ]);

                if ($simpandetail) {
                    $berhasil += 1;
                } else {
                    $error += 1;
                }
            }

            if ($error > 0) {
                DB::table('biaya')
                    ->where('kodebiaya', $request->kodebiaya)
                    ->delete();
                DB::table('detailbiaya')
                    ->where('kodebiaya', $request->kodebiaya)
                    ->delete();
                return redirect('/biaya/')->with(['failed' => 'Data Gagal Disimpan']);
            } else {
                DB::table('tmp_detailbiaya')
                    ->where('kodebiaya', $request->kodebiaya)
                    ->delete();
                return redirect('/biaya/')->with(['success' => 'Data Berhasil Disimpan']);
            }
        }
    }

    function updatedetailbiaya(Request $request)
    {
        $simpan = DB::table('detailbiaya')
            ->where('kodebiaya', $request->kodebiaya)
            ->where('id_jenisbayar', $request->jenisbayar)
            ->update([
                'jumlah_biaya' => str_replace(".", "", $request->jumlah_biaya)
            ]);
        if ($simpan) {
            echo "1";
        } else {
            echo "0";
        }
    }

    function storedetail(Request $request)
    {

        $kodebiaya = $request->kodebiaya;
        $id_jenisbayar = $request->jenisbayar;
        $jumlah_biaya = str_replace(".", "", $request->jumlah_biaya);
        $cek = DB::table('detailbiaya')
            ->where('kodebiaya', $kodebiaya)
            ->where('id_jenisbayar', $id_jenisbayar)
            ->count();
        if ($cek > 0) {
            echo "2";
        } else {
            $simpan = DB::table('detailbiaya')->insert([
                'kodebiaya' => $kodebiaya,
                'id_jenisbayar' => $id_jenisbayar,
                'jumlah_biaya' => $jumlah_biaya
            ]);
            if ($simpan) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }
}
