<?php

namespace App\Http\Controllers;

use App\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class GuruController extends Controller
{
    public function index()
    {
        $query = Guru::query();
        $guru = $query->get();
        $data['guru'] = $guru;
        return view('guru.index', $data);
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        try {

            Guru::create([
                'kode_guru' => $request->kode_guru,
                'nama_guru' => $request->nama_guru,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                // Tambahkan atribut lain sesuai kebutuhan
            ]);

            return redirect('/guru')->with('success', 'Data guru berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect('/guru')->with('failed', 'Data gagal disimpan' . $e->getMessage());
        }
    }

    public function edit($kode_guru)
    {
        $kode_guru = Crypt::decrypt($kode_guru);
        $guru = Guru::findOrFail($kode_guru);
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, $kode_guru)
    {
        $kode_guru = Crypt::decrypt($kode_guru);
        try {
            $guru = Guru::findOrFail($kode_guru);
            $guru->update([
                'nama_guru' => $request->nama_guru,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                // Tambahkan atribut lain sesuai kebutuhan
            ]);

            return redirect('/guru')->with('success', 'Data guru berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect('/guru')->with('failed', 'Data gagal diperbarui' . $e->getMessage());
        }
    }

    public function destroy($kode_guru)
    {
        $kode_guru = Crypt::decrypt($kode_guru);
        try {
            Guru::findOrFail($kode_guru)->delete();
            return redirect('/guru')->with('success', 'Data guru berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/guru')->with('failed', 'Data gagal dihapus' . $e->getMessage());
        }
    }
}
