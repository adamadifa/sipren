<?php

namespace App\Http\Controllers;

use App\Propinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class MobileController extends Controller
{

    public function index()
    {
        return view('mobile.login');
    }
    public function dashboard()
    {
        $saldo = DB::table('koperasi_saldo_simpanan')
            ->selectRaw('sum(jumlah) as saldo')
            ->join('koperasi_anggota', 'koperasi_saldo_simpanan.no_anggota', '=', 'koperasi_anggota.no_anggota')
            ->leftJoin('karyawan', 'koperasi_anggota.npp', '=', 'karyawan.npp')
            ->where('koperasi_anggota.npp', Auth::user()->npp)
            ->first();

        $simpananpokok = DB::table('koperasi_saldo_simpanan')
            ->selectRaw('koperasi_saldo_simpanan.no_anggota,jumlah as saldo')
            ->join('koperasi_anggota', 'koperasi_saldo_simpanan.no_anggota', '=', 'koperasi_anggota.no_anggota')
            ->leftJoin('karyawan', 'koperasi_anggota.npp', '=', 'karyawan.npp')
            ->where('koperasi_anggota.npp', Auth::user()->npp)
            ->where('kode_simpanan', '001')
            ->first();
        $tabungan = DB::table('koperasi_tabungan')
            ->selectRaw('koperasi_tabungan.no_rekening,saldo,nama_tabungan')
            ->join('koperasi_jenistabungan', 'koperasi_tabungan.kode_tabungan', '=', 'koperasi_jenistabungan.kode_tabungan')
            ->join('koperasi_anggota', 'koperasi_tabungan.no_anggota', '=', 'koperasi_anggota.no_anggota')
            ->leftJoin('karyawan', 'koperasi_anggota.npp', '=', 'karyawan.npp')
            ->where('koperasi_anggota.npp', Auth::user()->npp)
            ->get();

        $simpananwajib = DB::table('koperasi_saldo_simpanan')
            ->selectRaw('koperasi_saldo_simpanan.no_anggota,jumlah as saldo')
            ->join('koperasi_anggota', 'koperasi_saldo_simpanan.no_anggota', '=', 'koperasi_anggota.no_anggota')
            ->leftJoin('karyawan', 'koperasi_anggota.npp', '=', 'karyawan.npp')
            ->where('koperasi_anggota.npp', Auth::user()->npp)
            ->where('kode_simpanan', '002')
            ->first();


        $simsuk = DB::table('koperasi_saldo_simpanan')
            ->selectRaw('koperasi_saldo_simpanan.no_anggota,jumlah as saldo')
            ->join('koperasi_anggota', 'koperasi_saldo_simpanan.no_anggota', '=', 'koperasi_anggota.no_anggota')
            ->leftJoin('karyawan', 'koperasi_anggota.npp', '=', 'karyawan.npp')
            ->where('koperasi_anggota.npp', Auth::user()->npp)
            ->where('kode_simpanan', '003')
            ->first();

        $bulan = date("m");
        $tahun = date("Y");
        $hariini = date("Y-m-d");
        $presensi = DB::table('presence')
            ->select('presence_date', 'time_in', 'time_out', 'presence_address')
            ->where('npp', Auth::user()->npp)
            ->whereRaw('MONTH(presence_date)=' . $bulan)
            ->whereRaw('YEAR(presence_date)=' . $tahun)
            ->orderBy('presence_date', 'desc')
            ->get();

        $presensihariini = DB::table('presence')
            ->select('presence_date', 'time_in', 'time_out', 'presence_address')
            ->where('npp', Auth::user()->npp)
            ->where('presence_date', $hariini)
            ->orderBy('presence_date', 'desc')
            ->first();
        $pembiayaan = DB::table('koperasi_pembiayaan')
            ->select('no_akad', 'nama_pembiayaan', 'tgl_permohonan', 'jumlah', 'koperasi_pembiayaan.persentase', 'jangka_waktu', 'jmlbayar')
            ->join('koperasi_jenispembiayaan', 'koperasi_pembiayaan.kode_pembiayaan', '=', 'koperasi_jenispembiayaan.kode_pembiayaan')
            ->join('koperasi_anggota', 'koperasi_pembiayaan.no_anggota', '=', 'koperasi_anggota.no_anggota')
            ->leftJoin('karyawan', 'koperasi_anggota.npp', '=', 'karyawan.npp')
            ->where('koperasi_anggota.npp', Auth::user()->npp)
            ->get();




        return view('mobile.index', compact('saldo', 'presensi', 'pembiayaan', 'simpananpokok', 'simpananwajib', 'simsuk', 'presensihariini', 'tabungan'));
    }

    public function showpembiayaan($no_akad)
    {
        $no_akad = Crypt::decrypt($no_akad);
        $pembiayaan = DB::table('koperasi_pembiayaan')->where('no_akad', $no_akad)
            ->join('koperasi_jenispembiayaan', 'koperasi_pembiayaan.kode_pembiayaan', '=', 'koperasi_jenispembiayaan.kode_pembiayaan')
            ->first();
        $historibayar = DB::table('koperasi_bayarpembiayaan')->where('no_akad', $no_akad)
            ->orderBy('tgl_transaksi')
            ->get();
        return view('mobile.showpembiayaan', compact('pembiayaan', 'historibayar'));
    }


    public function checklistibadah()
    {
        return view('mobile.checklistibadah');
    }

    public function changepassword()
    {
        return view('mobile.changepassword');
    }

    public function updatepassword($npp, Request $request)
    {
        //dd($request->all());
        $id = Crypt::decrypt($npp);
        $user = DB::table('karyawan')->where('npp', $id)->first();
        $password_user = $user->password;
        $password_lama = $request->password_lama;
        $password_baru = $request->password_baru;

        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required'
        ]);
        $pas = "12345";
        //dd(Hash::make($pas));
        //dd($password_lama);
        //dd(Hash::check($password_lama, $password_user));
        if (Hash::check($password_lama, $password_user)) {
            $update = DB::table('karyawan')->where('npp', $id)->update(['password' => Hash::make($password_baru)]);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data User Berhasil Diupdate']);
            } else {
                return Redirect::back()->with(['warning' => 'Data User Gagal Diupdate, Hubungi Tim IT']);
            }
        } else {
            return Redirect::back()->with(['warning' => 'Password Lama Salah, Hubungi Tim IT']);
        }
    }

    public function mutasitabungan($no_rekening)
    {
        $no_rekening = Crypt::decrypt($no_rekening);
        $tabungan = DB::table('koperasi_tabungan')
            ->join('koperasi_jenistabungan', 'koperasi_tabungan.kode_tabungan', '=', 'koperasi_jenistabungan.kode_tabungan')
            ->where('no_rekening', $no_rekening)->first();
        return view('mobile.mutasitabungan', compact('tabungan'));
    }

    public function pembiayaan()
    {
        $pembiayaan = DB::table('koperasi_pembiayaan')
            ->select('no_akad', 'nama_pembiayaan', 'tgl_permohonan', 'jumlah', 'koperasi_pembiayaan.persentase', 'jangka_waktu', 'jmlbayar')
            ->join('koperasi_jenispembiayaan', 'koperasi_pembiayaan.kode_pembiayaan', '=', 'koperasi_jenispembiayaan.kode_pembiayaan')
            ->join('koperasi_anggota', 'koperasi_pembiayaan.no_anggota', '=', 'koperasi_anggota.no_anggota')
            ->leftJoin('karyawan', 'koperasi_anggota.npp', '=', 'karyawan.npp')
            ->where('koperasi_anggota.npp', Auth::user()->npp)
            ->get();
        return view('mobile.pembiayaan', compact('pembiayaan'));
    }

    public  function ajukanpembiayaan($step)
    {

        $anggota = DB::table('koperasi_anggota')->where('npp', Auth::user()->npp)->first();
        $propinsi = Propinsi::orderBy('prov_name', 'asc')->get();
        return view('mobile.ajukanpembiayaan', compact('anggota', 'step', 'propinsi'));
    }

    public function storeajukanpembiayaan($step, Request $request)
    {

        if ($step == 1) {
            $no_anggota = $request->no_anggota;
            $nik = $request->nik;
            $nama_lengkap = $request->nama_lengkap;
            $tempat_lahir = $request->tempat_lahir;
            $tanggal_lahir = $request->tanggal_lahir;
            $jenis_kelamin = $request->jenis_kelamin;
            $pendidikan_terakhir = $request->pendidikan_terakhir;

            try {
                DB::table('koperasi_anggota')
                    ->where('no_anggota', $no_anggota)
                    ->update([
                        'nik' => $nik,
                        'nama_lengkap' => $nama_lengkap,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'jenis_kelamin' => $jenis_kelamin,
                        'pendidikan_terakhir' => $pendidikan_terakhir
                    ]);

                return redirect('/mobile/ajukanpembiayaan/2');
            } catch (\Exception $e) {
                dd($e);
                return Redirect::back()->with(['error' => 'Data Gagal Disimpan']);
            }
        } else if ($step == 2) {
            $no_anggota = $request->no_anggota;
            $status_pernikahan = $request->status_pernikahan;
            $jml_tanggungan = $request->jml_tanggungan;
            $nama_pasangan = $request->nama_pasangan;
            $pekerjaan_pasangan = $request->pekerjaan_pasangan;
            $nama_ibu = $request->nama_ibu;
            $nama_saudara = $request->nama_saudara;
            $no_hp = $request->no_hp;

            try {
                DB::table('koperasi_anggota')
                    ->where('no_anggota', $no_anggota)
                    ->update([
                        'status_pernikahan' => $status_pernikahan,
                        'jml_tanggungan' => $jml_tanggungan,
                        'nama_pasangan' => $nama_pasangan,
                        'pekerjaan_pasangan' => $pekerjaan_pasangan,
                        'nama_ibu' => $nama_ibu,
                        'nama_saudara' => $nama_saudara,
                        'no_hp' => $no_hp
                    ]);

                return redirect('/mobile/ajukanpembiayaan/3');
            } catch (\Exception $e) {
                dd($e);
                return Redirect::back()->with(['error' => 'Data Gagal Disimpan']);
            }
        } else if ($step == 3) {
            $no_anggota = $request->no_anggota;
            $alamat = $request->alamat;
            $id_propinsi = $request->id_propinsi;
            $id_kota = $request->id_kota;
            $id_kecamatan = $request->id_kecamatan;
            $id_kelurahan = $request->id_kelurahan;
            $kode_pos = $request->kode_pos;
            $status_tinggal = $request->status_tinggal;

            try {
                DB::table('koperasi_anggota')
                    ->where('no_anggota', $no_anggota)
                    ->update([
                        'alamat' => $alamat,
                        'id_propinsi' => $id_propinsi,
                        'id_kota' => $id_kota,
                        'id_kecamatan' => $id_kecamatan,
                        'id_kelurahan' => $id_kelurahan,
                        'kode_pos' => $kode_pos,
                        'status_tinggal' => $status_tinggal
                    ]);

                return redirect('/mobile/ajukanpembiayaan/4');
            } catch (\Exception $e) {
                dd($e);
                return Redirect::back()->with(['error' => 'Data Gagal Disimpan']);
            }
        }
    }
}
