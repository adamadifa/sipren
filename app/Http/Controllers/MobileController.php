<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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




        return view('mobile.index', compact('saldo', 'presensi', 'pembiayaan', 'simpananpokok', 'simpananwajib', 'simsuk', 'presensihariini'));
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
}
