<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class LoginController extends Controller
{
    
    public function index()
    {
       
        return view('login');
    }
    public function authenticating(Request $request)
    {
        //cek login admin
        if (Auth::guard('admin')->attempt([
            'NIP' => $request->username, 
            'password' => $request->password,
            'jabatan' => 'waka'])) {
            $request->session()->regenerate();
            // dd(Auth::guard('admin'));
            //menuju dashboard admin
            if($request->input('redirect')){
                return redirect($request->redirect);
            }else{
                return redirect()->intended('/dashboard');
            }
        }else{}

        if(Auth::guard('kepsek')->attempt([
            'NIP' => $request->username, 
            'password' => $request->password,
            'jabatan' => 'Kepala Sekolah'])) {
            $request->session()->regenerate();
            if($request->input('redirect')){
                return redirect($request->redirect);
            }else{
                return redirect()->intended('/dashboard');
            }
        }else{}

        if(Auth::guard('guru')->attempt(['NIP' => $request->username, 'password' => 
        $request->password])){
            //$request->session()->regenerate();
            //menuju ke halaman dashboard untuk guru
            if($request->input('redirect')){
                return redirect($request->redirect);
            }else{
                return redirect()->intended('/dashboard');
            }
        }else{}

        if(Auth::guard('siswa')->attempt(['nisn' => $request->username, 'password' => 
        $request->password])){
            //$request->session()->regenerate();
            //menuju ke halaman dashboard untuk guru
            if($request->input('redirect')){
                return redirect($request->redirect);
            }else{
                return redirect()->intended('/dashboard');
            }
        }else{}
        return redirect('/')->with('toast_error', 'Username atau Password salah !');
    }
}
