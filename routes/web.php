<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\MobileController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/phpinfo', function () {
    phpinfo();
});
Route::get('/login', function () {
    return view('Auth.login');
})->name('login');



Route::get('/daftar', function () {
    return view('Auth.register');
})->name('daftar');

Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('mobile.login');
    });
    Route::get('/mobile', [MobileController::class, 'index']);
});

Route::get('/listisianibadah', 'CheckingibadahController@listpengisianibadahharian');
Route::post('/postlogin', 'LoginController@postlogin')->name('postlogin');
Route::post('/loginmobile', 'LoginController@postloginmobile');
Route::post('/postregister', 'LoginController@postregister')->name('postregister');
Route::get('/logout', 'LoginController@postlogout')->name('logout');
Route::get('/form-pendaftaran', 'PendaftaranController@formpsb');

//get Kelurahan s/d Provinsi
Route::post('/kota/getkota', 'KotaController@getkota');
Route::post('/kecamatan/getkecamatan', 'KecamatanController@getkecamatan');
Route::post('/kelurahan/getkelurahan', 'KelurahanController@getkelurahan');

Route::get('/absensi/map', 'AbsensiController@map');
Route::get('/absensi/karyawan', 'AbsensiController@absenkaryawan');
Route::get('/absensi/karyawanlist', 'AbsensiController@absenkaryawanlist');
Route::post('/loaddata/getabsensiharian', 'LoaddataController@getabsensiharian');
Route::post('/loaddata/getabsensiharianall', 'LoaddataController@getabsensiharianall');
Route::post('/loaddata/getchecklistibadahlist', 'LoaddataController@getchecklistibadahlist');
Route::middleware(['auth:user', 'ceklevel:admin_unit,admin'])->group(function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    //Absensi

    Route::get('/absensi/laporan', 'AbsensiController@laporan');
    Route::get('/absensi/laporansiswa', 'AbsensiController@laporansiswa');
    Route::post('/absensi/cetak', 'AbsensiController@cetak');
    Route::post('/absensi/cetaksiswa', 'AbsensiController@cetaksiswa');
    //Load Data
    Route::post('/loaddata/getabsensikaryawan', 'LoaddataController@getabsensikaryawan');

    Route::post('/loaddata/map_frame', 'LoaddataController@map_frame');
    //Ibadah Harian
    Route::get('/checkingibadah/laporan', 'CheckingibadahController@laporan');
    Route::post('/checkingibadah/cetak', 'CheckingibadahController@cetak');
    Route::get('/checkingibadah/rekap', 'CheckingibadahController@rekap');
    //Pembayaran

    Route::get('/pembayaran', 'PembayaranController@index');
    Route::get('/pembayaran/{no_pendaftaran}/show', 'PembayaranController@show');
    Route::post('/pembayaran/store_bayartemp', 'PembayaranController@store_bayartemp');
    Route::post('/pembayaran/hapus_bayartemp', 'PembayaranController@hapus_bayartemp');
    Route::post('/pembayaran', 'PembayaranController@store');
    Route::get('/cetakkwitansi/{no_transaksi}', 'PembayaranController@cetakkwitansi');
    Route::get('/pembayaran/{no_transaksi}/{no_pendaftaran}/hapus', 'PembayaranController@hapus');
    Route::post('/simpanpotongan', 'PembayaranController@simpanpotongan');
    Route::post('/simpanmutasi', 'PembayaranController@simpanmutasi');
    Route::get('/laporanpembayaran', 'PembayaranController@laporan');
    Route::get('/laporantagihan', 'PembayaranController@laporantagihan');
    Route::post('/pembayaran/cetak', 'PembayaranController@cetak');
    Route::get('/generatespp/{no_pendaftaran}/{kode_biaya}', 'PembayaranController@generatespp');
    Route::get('/generateuangmakan/{no_pendaftaran}/{kode_biaya}', 'PembayaranController@generateuangmakan');
    Route::post('/editspp', 'PembayaranController@editspp');
    Route::post('/editum', 'PembayaranController@editum');
    Route::post('/updatespp', 'PembayaranController@updatespp');
    Route::post('/updateum', 'PembayaranController@updateum');
    Route::post('/inputmutasispp', 'PembayaranController@inputmutasispp');
    Route::post('/inputmutasium', 'PembayaranController@inputmutasium');

    //Biaya
    Route::get('/biaya', 'BiayaController@index');
    Route::get('/biaya/create', 'BiayaController@create');
    Route::post('/biaya/storetemp', 'BiayaController@storetemp');
    Route::post('/biaya/showtemp', 'BiayaController@showtemp');
    Route::post('/biaya/deletetemp', 'BiayaController@destroytemp');
    Route::post('/biaya', 'BiayaController@store');
    Route::post('/biaya/cektemp', 'BiayaController@cektemp');
    Route::get('/biaya/{kodebiaya}/edit', 'BiayaController@edit');
    Route::post('/biaya/updatedetailbiaya', 'BiayaController@updatedetailbiaya');
    Route::post('/biaya/storedetail', 'BiayaController@storedetail');

    //Load Data
    Route::post('/loaddata/gettingkat', 'LoaddataController@gettingkat');
    Route::post('/loaddata/getbiaya', 'LoaddataController@getbiaya');
    Route::post('/loaddata/getdetailbiaya', 'LoaddataController@getdetailbiaya');
    Route::post('/loaddata/getoptionbiaya', 'LoaddataController@getoptionbiaya');
    Route::post('/loaddata/getspp', 'LoaddataController@getspp');
    Route::post('/loaddata/getoptionbulan', 'LoaddataController@getoptionbulan');
    Route::post('/loaddata/getoptionbulanum', 'LoaddataController@getoptionbulanum');
    Route::post('/loaddata/gettmpbayar', 'LoaddataController@gettmpbayar');
    Route::post('/loaddata/getjumlahbiaya', 'LoaddataController@getjumlahbiaya');
    Route::post('/loaddata/cektmpbayar', 'LoaddataController@cektmpbayar');
    Route::post('/loaddata/getsppta', 'LoaddataController@getsppta');
    Route::post('/loaddata/getspptaasrama', 'LoaddataController@getspptaasrama');
    Route::post('/loaddata/getdetailtransaksi', 'LoaddataController@getdetailtransaksi');
    Route::post('/loaddata/getrencanaspp', 'LoaddataController@getrencanaspp');
    Route::post('/loaddata/getrencanaum', 'LoaddataController@getrencanaum');
    Route::post('/loaddata/showdatasiswa', 'LoaddataController@getdatasiswa');
    Route::post('/loaddata/showdatakeluarga', 'LoaddataController@getdatakeluarga');
    //Siswa
    Route::get('/siswa', 'SiswaController@index');
    Route::get('/siswa/create', 'SiswaController@create');
    Route::post('/siswa', 'SiswaController@store');
    Route::get('/siswa/{id_siswa}/show', 'SiswaController@show');
    Route::get('/siswa/cari', 'SiswaController@cari');
    Route::delete('/siswa/{id_siswa}/delete', 'SiswaController@destroy');
    Route::get('/siswa/{id_siswa}/edit', 'SiswaController@edit');
    Route::put('/siswa/{id_siswa}', 'SiswaController@update');
    Route::get('/siswa/json', 'SiswaController@json');

    //Pendaftaran
    Route::get('/pendaftaran/{jenjang}', 'PendaftaranController@index');
    Route::get('/pendaftaran/{jenjang}/create', 'PendaftaranController@create');
    Route::get('/pendaftaran/{jenjang}/{no_pendaftaran}/edit', 'PendaftaranController@edit');
    Route::post('/pendaftaran', 'PendaftaranController@store');
    Route::put('/pendaftaran/{no_pendaftaran}', 'PendaftaranController@update');
    Route::delete('/pendaftaran/{jenjang}/{no_pendaftaran}/delete', 'PendaftaranController@destroy');
    Route::get('/pendaftaran/{jenjang}/{no_pendaftaran}/show', 'PendaftaranController@show');
});
Route::middleware(['auth:user', 'ceklevel:admin'])->group(function () {
    Route::get('/karyawan', 'KaryawanController@index')->name('karyawan');
    Route::get('/karyawan/cari', 'KaryawanController@cari')->name('carikaryawan');
    Route::get('/karyawan/create', 'KaryawanController@create');
    Route::delete('/karyawan/{npp}/delete', 'KaryawanController@destroy');
    Route::post('/karyawan', 'KaryawanController@store');
    Route::get('/unit', 'UnitController@index');

    Route::get('/karyawan/{npp}/detailabsensi', 'KaryawanController@detailabsensi');

    //Jenis Bayar
    Route::get('/jenisbayar', 'JenisbayarController@index');
    Route::get('/jenisbayar/create', 'JenisbayarController@create');
    Route::post('/jenisbayar', 'JenisbayarController@store');
    Route::get('/jenisbayar/{id}/edit', 'JenisbayarController@edit');
    Route::put('/jenisbayar/{id}', 'JenisbayarController@update');
    //Tahun Akademik
    Route::get('/tahunakademik', 'TahunakademikController@index');
    Route::get('/tahunakademik/create', 'TahunakademikController@create');
    Route::post('/tahunakademik', 'TahunakademikController@store');
    Route::get('/tahunakademik/{id}/edit', 'TahunakademikController@edit');
    Route::put('/tahunakademik/{id}', 'TahunakademikController@update');

    Route::get('/checklistibadah/karyawanlist', 'CheckingibadahController@karyawanlist');
});

Route::middleware(['auth:karyawan', 'ceklevel:user'])->group(function () {
    Route::get('/checkingibadah', 'CheckingibadahController@checkingibadah');
    Route::post('/loadchecklistibadah', 'CheckingibadahController@loadchecklistibadah');
    Route::post('/simpanchecklistibadah', 'CheckingibadahController@storechecklistibadah');
    Route::post('/hapuschecklistibadah', 'CheckingibadahController@destroychecklistibadah');

    Route::get('/mobile/dashboard', [MobileController::class, 'dashboard']);
    Route::get('/mobile/{no_akad}/showpembiayaan', [MobileController::class, 'showpembiayaan']);
    Route::get('/absensi/create', [AbsensiController::class, 'create']);
    Route::post('/absensi/store', [AbsensiController::class, 'store']);
    Route::get('/mobile/checklistibadah', [MobileController::class, 'checklistibadah']);
    Route::get('/mobile/checklistibadah', [MobileController::class, 'checklistibadah']);
    Route::get('/mobile/changepassword', [MobileController::class, 'changepassword']);
    Route::post('/mobile/{npp}/updatepassword', [MobileController::class, 'updatepassword']);
    Route::get('/mobile/{no_rekening}/mutasitabungan', [MobileController::class, 'mutasitabungan']);
});


Route::middleware(['auth:user,karyawan', 'ceklevel:admin,user'])->group(function () {
    Route::get('/karyawan/{npp}/edit', 'KaryawanController@edit');
    Route::put('/karyawan/{npp}', 'KaryawanController@update');
    Route::get('/karyawan/{npp}', 'KaryawanController@show');
    //Upload Dokumen
    Route::get('/karyawan/{npp}/uploaddokumen', 'KaryawanController@uploaddokumen');
    Route::post('/karyawan/{npp}/uploaddokumen', 'KaryawanController@storedokumen');

    //Upload Foto
    Route::post('/karyawan/{npp}/gantifoto', 'KaryawanController@updatefoto');
    Route::get('/karyawan/{npp}/gantifoto', 'KaryawanController@gantifoto');


    Route::post('/karyawan/getunittambahan', 'KaryawanController@getunittambahan');
    Route::post('/karyawan/simpanunittambahan', 'KaryawanController@storeunittambahan');
    Route::post('/karyawan/deleteunittambahan', 'KaryawanController@destroyunittambahan');

    Route::post('/karyawan/getanak', 'KaryawanController@getanak');
    Route::post('/karyawan/simpananak', 'KaryawanController@storeanak');
    Route::post('/karyawan/deleteanak', 'KaryawanController@destroyanak');

    Route::post('/karyawan/getpendidikan', 'KaryawanController@getpendidikan');
    Route::post('/karyawan/simpanpendidikan', 'KaryawanController@storependidikan');
    Route::post('/karyawan/deletependidikan', 'KaryawanController@destroypendidikan');

    //Ibadah Harian



    //Auth
    Route::get('/gantipassword', 'LoginController@gantipassword');
    Route::post('/updatepassword', 'LoginController@updatepassword');
});
