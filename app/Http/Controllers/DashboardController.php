<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pegawai = User::get();
        $guru = Guru::get();
        $kelas = Kelas::get();
        $siswa = Siswa::get();

        if (Auth::guard('admin')->check()){
            return view('dashboard',[
                'pegawai'   => $pegawai,
                'guru'      => $guru,
                'kelas'     => $kelas,
                'siswa'     => $siswa,
               
            ]);

        }elseif(Auth::guard('siswa')->check()){
            $data = Auth::guard('siswa')->user()->id;
            return view('dashboard',[
                'pegawai'   => $pegawai,
                'guru'      => $guru,
                'kelas'     => $kelas,
                'siswa'     => $siswa,
               
            ]);
        }elseif(Auth::guard('kepsek')->check()){
            $data = Auth::guard('kepsek')->user()->id;
            return view('dashboard',[
                'pegawai'   => $pegawai,
                'guru'      => $guru,
                'kelas'     => $kelas,
                'siswa'     => $siswa,
               
            ]);
        }
        else{
            $data = Auth::guard('guru')->user()->id;
            $walikelas = Kelas::where('guru_id',$data)->first();
            return view('dashboard',[
                'pegawai'   => $pegawai,
                'guru'      => $guru,
                'kelas'     => $kelas,
                'siswa'     => $siswa,
                'walikelas' => $walikelas

            ]);
        }
    
        // if($walikelas){

           
       

    }
}
