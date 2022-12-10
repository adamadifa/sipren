<?php

namespace App\Http\Controllers;

use App\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Str;

class LoginController extends Controller
{
    public function postlogin(Request $request)
    {

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else if ((Auth::guard('karyawan')->attempt(['npp' => $request->email, 'password' => $request->password]))) {
            //dd(Str::length(Auth::guard('user')->user()));
            return redirect('/karyawan/' . $request->email);
        } else {
            return redirect('login');
        }
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect('/karyawan');
        // }

    }

    public function postloginmobile(Request $request)
    {
        // /dd(Auth::guard('karyawan')->attempt(['npp' => $request->npp, 'password' => $request->password]));

        if (Auth::guard('karyawan')->attempt(['npp' => $request->npp, 'password' => $request->password])) {
            //dd(Str::length(Auth::guard('user')->user()));
            return redirect('/mobile/dashboard');
        } else {
            return redirect('/mobile');
        }
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect('/karyawan');
        // }

    }


    public function postlogout()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        } else  if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
        }
        return redirect('login');
    }

    public function postregister(Request $request)
    {
        $attribute = $request->validate([
            'npp' => 'required|numeric|unique:karyawan',
            'nama_lengkap' => 'required|max:50',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $simpan = Karyawan::create([
            'npp' => $request->npp,
            'nama_lengkap' => $request->nama_lengkap,
            'password' => Hash::make($request->password)
        ]);
        if ($simpan) {
            return redirect('/login')->with(['success' => 'Data Berhasil Disimpan']);
        }
    }

    function gantipassword()
    {
        return view('Auth.gantipassword');
    }

    function updatepassword(Request  $request)
    {
        $new_password = Hash::make($request->new_password);
        if (!empty(Auth::guard('user')->user()->id)) {
            $id_user = Auth::guard('user')->user()->id;
            $update = DB::table('users')
                ->where('id_users', $id_user)
                ->update([
                    'password' => $new_password
                ]);
        } else {
            $id_user = Auth::guard('karyawan')->user()->npp;
            $update = DB::table('karyawan')
                ->where('npp', $id_user)
                ->update([
                    'password' => $new_password
                ]);
            if ($update) {
                return redirect('/karyawan/' . $id_user)->with(['success' => 'Password Berhasil Diganti']);
            }
        }




        echo $id_user;
    }
}
