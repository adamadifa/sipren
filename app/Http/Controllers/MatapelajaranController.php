<?php

namespace App\Http\Controllers;

use App\Matapelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MatapelajaranController extends Controller
{
    public function index()
    {
        $query = Matapelajaran::query();
        $query->orderBy('kode_matpel', 'asc');
        $matapelajaran = $query->get();
        $data['matapelajaran'] = $matapelajaran;
        return view('matapelajaran.index', $data);
    }

    public function create()
    {
        return view('matapelajaran.create');
    }

    public function store(Request $request)
    {
        try {
            $cek = Matapelajaran::where('kode_matpel', $request->kode_matpel)->count();
            if ($cek > 0) {
                return redirect()->back()->with('failed', 'Kode Mata Pelajaran Sudah Ada');
            }
            Matapelajaran::create([
                'kode_matpel' => $request->kode_matpel,
                'nama_matpel' => $request->nama_matpel
            ]);

            return redirect('/matapelajaran')->with('success', 'Data Mata Pelajaran berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect('/matapelajaran')->with('failed', 'Data Mata Pelajaran gagal disimpan' . $e->getMessage());
        }
    }

    public function edit($kode_matpel)
    {
        $kode_matpel = Crypt::decrypt($kode_matpel);
        $matapelajaran = Matapelajaran::where('kode_matpel', $kode_matpel)->first();
        $data['matapelajaran'] = $matapelajaran;
        return view('matapelajaran.edit', $data);
    }

    public function update($kode_matpel, Request $request)
    {
        $kode_matpel = Crypt::decrypt($kode_matpel);
        try {
            Matapelajaran::where('kode_matpel', $kode_matpel)->update([
                'nama_matpel' => $request->nama_matpel
            ]);
            return redirect('/matapelajaran')->with('success', 'Data Mata Pelajaran berhasil diubah.');
        } catch (\Exception $e) {
            return redirect('/matapelajaran')->with('failed', 'Data Mata Pelajaran gagal diubah' . $e->getMessage());
        }
    }

    public function destroy($kode_matpel)
    {
        $kode_matpel = Crypt::decrypt($kode_matpel);
        try {
            Matapelajaran::where('kode_matpel', $kode_matpel)->delete();
            return redirect('/matapelajaran')->with('success', 'Data Mata Pelajaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/matapelajaran')->with('failed', 'Data Mata Pelajaran gagal dihapus' . $e->getMessage());
        }
    }
}
