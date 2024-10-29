<?php

namespace App\Http\Controllers;

use App\Pendaftaranonline;
use App\Tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranonlineController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['ta'] = Tahunakademik::where('status', 1)->first();
        $data['tahunakademik'] = Tahunakademik::all();
        $data['jenjang'] = DB::table('unit')->where('status', 1)->get();

        $query = Pendaftaranonline::query();
        if ($request->search == 'search') {
            if (!empty($request->tahunakademik)) {
                $query = $query->where('tahunakademik', $request->tahunakademik);
            }


            if (!empty($request->nama_lengkap)) {
                $query = $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
            }
            //dd($request);
        } else {
            $query = $query->where('tahunakademik', $data['ta']['tahunakademik']);
        }
        $query->select(
            'no_pendaftaran',
            'tgl_daftar',
            'nisn',
            'nama_lengkap',
            'jenis_kelamin',
            'tanggal_lahir',
            'jenjang',
            'tahunakademik',
            'biaya_pendaftaran'
        );

        // $query->where('pendaftaran.jenjang', $jenjang);
        $query->orderBy('no_pendaftaran', 'desc');
        $pendaftaran = $query->paginate(10);
        $pendaftaran->appends($request->all());
        $data['pendaftaran'] = $pendaftaran;
        return view('pendaftaranonline.index', $data);
    }
}
