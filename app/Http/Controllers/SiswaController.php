<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Propinsi;
use App\Siswa;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class SiswaController extends Controller
{
    function index()
    {
        $datasiswa = Siswa::orderBy('id_siswa', 'asc')->orderBy('nama_lengkap', 'asc')->paginate(15);
        return view('siswa.index', compact('datasiswa'));
    }

    function create()
    {
        $pekerjaan = DB::table('pekerjaan')->orderBy('id', 'asc')->get();
        $propinsi = Propinsi::orderBy('prov_name', 'asc')->get();
        return view('siswa.create', compact('propinsi', 'pekerjaan'));
    }
    function store(Request $request)
    {
        $ta = "2021";
        $ceksiswa = DB::table('siswa')
            ->select('id_siswa')
            ->orderBy('id_siswa', 'desc')
            ->first();

        $idterakhir = $ceksiswa->id_siswa;
        $id_siswa = buatkode($idterakhir, $ta, 3);
        $attribute = $request->validate([
            'nisn' => '',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'anak_ke' => 'required|numeric',
            'jml_saudara' => 'required|numeric',
            'alamat' => 'required',
            'id_propinsi' => 'required',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_kelurahan' => 'required',
            'kodepos' => 'required',
            'no_kk' => 'required|numeric',
            'nik_ayah' => 'required|numeric',
            'nama_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nik_ibu' => 'required',
            'nama_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required'

        ]);

        $simpan = DB::table('siswa')->insert([
            'id_siswa' => $id_siswa,
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'anak_ke' => $request->anak_ke,
            'jml_saudara' => $request->jml_saudara,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'id_propinsi' => $request->id_propinsi,
            'id_kota' => $request->id_kota,
            'id_kecamatan' => $request->id_kecamatan,
            'id_kelurahan' => $request->id_kelurahan,
            'kodepos' => $request->kodepos,
            'no_kk' => $request->no_kk,
            'nik_ayah' => $request->nik_ayah,
            'nama_ayah' => $request->nama_ayah,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu
        ]);
        if ($simpan) {
            return redirect('/siswa/')->with(['success' => 'Data Berhasil Disimpan']);
        }
    }

    function show($id_siswa)
    {
        $siswa = DB::table('siswa')
            ->select('siswa.*', 'prov_name', 'regc_name', 'dist_name', 'vill_name', 'pa.nama_pekerjaan as pekerjaan_ayah', 'pi.nama_pekerjaan as pekerjaan_ibu')
            ->leftjoin('pekerjaan as pa', 'siswa.pekerjaan_ayah', '=', 'pa.id')
            ->leftjoin('pekerjaan as pi', 'siswa.pekerjaan_ibu', '=', 'pi.id')
            ->leftjoin('provinces', 'siswa.id_propinsi', '=', 'provinces.id')
            ->leftjoin('regencies', 'siswa.id_kota', '=', 'regencies.id')
            ->leftjoin('districts', 'siswa.id_kecamatan', '=', 'districts.id')
            ->leftjoin('villages', 'siswa.id_kelurahan', '=', 'villages.id')
            ->Where('id_siswa', '=', $id_siswa)
            ->first();
        return view('siswa.show', compact('siswa'));
    }

    function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $datasiswa = DB::table('siswa')
            ->where('nama_lengkap', 'like', "%" . $cari . "%")
            ->orWhere('nisn', $cari)
            ->paginate(15);
        $datasiswa->appends($request->all());
        // mengirim data pegawai ke view index
        return view('siswa.index', compact('datasiswa'));
    }

    function destroy($id_siswa)
    {

        try {
            $destroy = DB::table('siswa')->where('id_siswa', $id_siswa)->delete();
            if ($destroy) {
                return redirect('/siswa/')->with(['success' => 'Data Berhasil Dihapus']);
            } else {
                return redirect('/siswa/')->with(['failed' => 'Data Gagal Dihapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            if ($errorcode == 23000) {
                return redirect('/siswa/')->with(['failed' => 'Data Siswa ini tidak dapat dihapus karena sudah melakukan pendaftaran !']);
            }
        }
    }

    function edit($id_siswa)
    {
        $propinsi = Propinsi::orderBy('id', 'asc')->get();
        $pekerjaan = DB::table('pekerjaan')->orderBy('id', 'asc')->get();
        $siswa = Siswa::findorfail($id_siswa);
        return view('siswa.edit', compact('siswa', 'propinsi', 'pekerjaan'));
    }



    function update(Request $request, $id_siswa)
    {
        $request->validate([
            'nisn' => '',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'anak_ke' => 'required|numeric',
            'jml_saudara' => 'required|numeric',
            'alamat' => 'required',
            'id_propinsi' => 'required',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_kelurahan' => 'required',
            'kodepos' => 'required',
            'no_kk' => 'required|numeric',
            'nik_ayah' => 'required|numeric',
            'nama_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'nik_ibu' => 'required',
            'nama_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required'

        ]);

        $siswa = Siswa::find($id_siswa);
        $siswa->nisn = $request->nisn;
        $siswa->nama_lengkap = $request->nama_lengkap;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->anak_ke = $request->anak_ke;
        $siswa->jml_saudara = $request->jml_saudara;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->alamat = $request->alamat;
        $siswa->id_propinsi = $request->id_propinsi;
        $siswa->id_kota = $request->id_kota;
        $siswa->id_kecamatan = $request->id_kecamatan;
        $siswa->id_kelurahan = $request->id_kelurahan;
        $siswa->kodepos = $request->kodepos;
        $siswa->no_kk = $request->no_kk;
        $siswa->nik_ayah = $request->nik_ayah;
        $siswa->nama_ayah = $request->nama_ayah;
        $siswa->pendidikan_ayah = $request->pendidikan_ayah;
        $siswa->pekerjaan_ayah = $request->pekerjaan_ayah;
        $siswa->nik_ibu = $request->nik_ibu;
        $siswa->nama_ibu = $request->nama_ibu;
        $siswa->pendidikan_ibu = $request->pendidikan_ibu;
        $siswa->pekerjaan_ibu = $request->pekerjaan_ibu;
        $siswa->save();
        return redirect('/siswa/' . $id_siswa . '/show')->with(['success' => 'Data Berhasil DiUpdate']);
    }

    function json()
    {
        $siswa = Siswa::select('id_siswa', 'nisn', 'nama_lengkap', 'tanggal_lahir')->get();
        return Datatables::of($siswa)
            ->addColumn('choose', function ($siswa) {
                $choose = '<a href="#" data-id_siswa=' . $siswa->id_siswa . ' class="btn btn-primary btn-sm" style="background-color:#004c2d; color:white">Pilih</a>';
                return $choose;
            })
            ->rawColumns(['choose'])
            ->make(true);
    }
}
