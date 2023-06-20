<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditPasswordController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\InputNilaiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalMengajarController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RaportController;
use App\Http\Middleware\AuthGuard;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('login');
});



Route::post('/login',[LoginController::class,'authenticating']);

Route::get('/logout', function(){
    if(Auth::guard('admin')->check()){
        Auth::guard('admin')->logout();
        return redirect('/')->with('toast_success', 'Anda berhasil keluar !');
   
    }else if(Auth::guard('guru')->check()){
        Auth::guard('guru')->logout();
        return redirect('/')->with('toast_success', 'Anda berhasil keluar !');
    }else if(Auth::guard('siswa')->check()){
        Auth::guard('siswa')->logout();
        return redirect('/')->with('toast_success', 'Anda berhasil keluar !');
    }else if(Auth::guard('kepsek')->check()){
        Auth::guard('kepsek')->logout();
        return redirect('/')->with('toast_success', 'Anda berhasil keluar !');
    }

    
});

Route::middleware(AuthGuard::class)->group(function(){
    
    Route::get('/dashboard',[DashboardController::class,'index']);

    //edit password
    
    Route::get('/editpassword',[EditPasswordController::class,'index']);
    Route::post('/edit-password/{id}',[EditPasswordController::class,'ubah']);
    Route::post('/edit-passwordsiswa/{id}',[EditPasswordController::class,'ubahpwdsiswa']);

    Route::get('/data-jadwalguru/{id}',[JadwalMengajarController::class,'jadwalguru']);
    Route::get('/data-jadwalguru/cetak_pdf/{id}', [JadwalMengajarController::class,'cetakjadwalguru']);
 
    // input nilai
    Route::get('/data-inputnilai/{id}',[InputNilaiController::class,'index']);
    Route::get('/data-nilai-atur/{id}/{smt}',[InputNilaiController::class,'atur']);
    Route::get('/data-input-nilai/{idjadwal}/{idsiswa}/{idmapel}/{smt}',[InputNilaiController::class,'input']);
    Route::post('/data-input-nilai-siswa/{idjadwal}/{idsiswa}/{idmapel}/{smt}',[InputNilaiController::class,'store']);
    Route::get('/data-detail-nilai/{idjadwal}/{idsiswa}/{idmapel}/{smt}',[InputNilaiController::class,'detail']);

    //input raport
    Route::get('/data-raport',[RaportController::class,'index']);
    Route::get('/data-raport-input/{id}/{smt}',[RaportController::class,'input']);
    Route::post('/tambahnilai',[RaportController::class,'tambahnilai']);
    Route::get('/data-nilai-hapus/{id}', [RaportController::class,'destroy']);
    Route::post('/data-raport-insert', [RaportController::class,'store']);
    Route::get('/data-cetak-raport/{smt}/{id}', [RaportController::class,'cetak']);

    //raport siswa
    Route::post('/data-raport-siswa/{id}', [RaportController::class,'raportsiswa']);

    //jadwal siswa
    Route::get('/data-jadwal/{id}',[JadwalController::class,'jadwalsiswa']);
    Route::get('/data-jadwalsiswa/cetak_pdf/{id}', [JadwalController::class,'cetakjadwalsiswa']);

    Route::get('/data-raport-cetak-siswa/{id}/{smt}',[RaportController::class,'cetakraportsiswa']);

    //kepsek
    Route::get('/data-pegawai-lihat',[PegawaiController::class,'lihat']);
    Route::get('/data-guru-lihat',[GuruController::class,'lihat']);
    Route::get('/data-jadwalmengajar-guru',[JadwalMengajarController::class,'lihat']);
    Route::get('/data-jadwalmengajar-cek/{id}',[JadwalMengajarController::class,'cekjadwal']);
    Route::get('/data-jadwal-cek',[JadwalController::class,'lihat']);
    Route::get('/data-jadwal-cekjadwal/{id}',[JadwalController::class,'cekjadwal']);
    Route::middleware(isGuru::class)->group(function(){
    });
    Route::middleware(isAdmin::class)->group(function(){
        Route::get('/data-pegawai',[PegawaiController::class,'index']);
        Route::get('/data-pegawai-add',[PegawaiController::class,'create']);
        Route::post('/data-pegawai-insert',[PegawaiController::class,'store']);
        Route::get('/data-pegawai-edit/{id}',[PegawaiController::class,'edit']);
        Route::put('/data-pegawai-update/{id}', [PegawaiController::class,'update']);
        Route::get('/data-pegawai-hapus/{id}', [PegawaiController::class,'destroy']);

        Route::get('/data-guru',[GuruController::class,'index']);
        Route::get('/data-guru-add',[GuruController::class,'create']);
        Route::post('/data-guru-insert',[GuruController::class,'store']);
        Route::get('/data-guru-edit/{id}',[GuruController::class,'edit']);
        Route::put('/data-guru-update/{id}', [GuruController::class,'update']);
        Route::get('/data-guru-hapus/{id}', [GuruController::class,'destroy']);

        Route::get('/data-kelas',[KelasController::class,'index']);
        Route::post('/data-kelas-insert',[KelasController::class,'store']);
        Route::put('/data-kelas-update/{id}', [KelasController::class,'update']);
        Route::get('/data-kelas-hapus/{id}', [KelasController::class,'destroy']);

        Route::get('/data-mapel',[MapelController::class,'index']);
        Route::post('/data-mapel-insert',[MapelController::class,'store']);
        Route::put('/data-mapel-update/{id}', [MapelController::class,'update']);
        Route::get('/data-mapel-hapus/{id}', [MapelController::class,'destroy']);

        Route::get('/data-jadwal',[JadwalController::class,'index']);
        Route::get('/data-jadwal-atur/{id}',[JadwalController::class,'atur']);
     
        Route::post('/data-jadwal-insert',[JadwalController::class,'store']);
        Route::put('/data-jadwal-update/{id}', [JadwalController::class,'update']);
        Route::get('/data-jadwal-hapus/{id}', [JadwalController::class,'destroy']);
        Route::get('/data-jadwal/cetak_pdf/{id}', [JadwalController::class,'cetak']);
        
        Route::get('/data-jadwalmengajar',[JadwalMengajarController::class,'index']);
        Route::get('/data-jadwalmengajar-atur/{id}',[JadwalMengajarController::class,'atur']);
        Route::get('/data-jadwalmengajar-cek/{id}',[JadwalMengajarController::class,'cek']);
        Route::post('/data-jadwalmengajar-insert',[JadwalMengajarController::class,'store']);
        Route::put('/data-jadwalmengajar-update/{id}', [JadwalMengajarController::class,'update']);
        Route::get('/data-jadwalmengajar-hapus/{id}', [JadwalMengajarController::class,'destroy']);
        Route::get('/data-jadwalmengajar/cetak_pdf/{id}', [JadwalMengajarController::class,'cetak']);

        Route::get('/data-raport-admin',[RaportController::class,'show']);
        Route::get('/data-raport-cek/{id}',[RaportController::class,'cek']);
        Route::get('/data-raport-cetak/{id}/{smt}',[RaportController::class,'cetakraport']);

    });
});
