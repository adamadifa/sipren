<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunakademikController extends Controller
{
    function index()
    {
        $ta = Tahunakademik::orderBy('id', 'desc')->get();
        return view('tahunakademik.index', compact('ta'));
    }

    function create()
    {
        return view('tahunakademik.create');
    }

    function store(Request $request)
    {

        $request->validate([
            'tahunakademik' => 'required|numeric'
        ]);
        $ta2 = $request->tahunakademik + 1;
        $ta = $request->tahunakademik . "/" . $ta2;
        $status = 1;
        $simpan = DB::table('tahunakademik')->insert([
            'tahunakademik' => $ta,
            'status' => $status
        ]);
        if ($simpan) {
            $update = DB::table('tahunakademik')
                ->where('tahunakademik', '!=', $ta)
                ->update(['status' => 0]);
            if ($update) {
                return redirect('/tahunakademik/')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/tahunakademik/')->with(['success' => 'Data Gagal Disimpan']);
            }
        }
    }
}
