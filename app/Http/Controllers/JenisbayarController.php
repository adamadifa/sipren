<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jenisbayar;
use Illuminate\Http\Request;

class JenisbayarController extends Controller
{
    function index()
    {
        $jenisbayar = Jenisbayar::orderBy('id', 'asc')->get();
        return view('jenisbayar.index', compact('jenisbayar'));
    }

    function create()
    {
        return view('jenisbayar.create');
    }

    function store(Request $request)
    {
        $attribute = $request->validate([
            'jenisbayar' => 'required'
        ]);
        $simpan = Jenisbayar::create($attribute);
        if ($simpan) {
            return redirect('/jenisbayar')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect('/jenisbayar')->with(['failed' => 'Data Gagal Disimpan']);
        }
    }

    function edit($id)
    {
        $jb = Jenisbayar::findorfail($id);
        return view('jenisbayar.edit', compact('jb'));
    }

    function update($id, Request $request)
    {
        $request->validate([
            'jenisbayar' => 'required'
        ]);

        $jb = Jenisbayar::findorfail($id);
        $jb->jenisbayar = $request->jenisbayar;
        $simpan = $jb->save();
        if ($simpan) {
            return redirect('/jenisbayar')->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return redirect('/jenisbayar')->with(['failed' => 'Data Gagal Diupdate']);
        }
    }
}
