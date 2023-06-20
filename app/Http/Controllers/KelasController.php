<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Exception;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::All();
        $guru =  Guru::select('id','nama')->get(); 
        return view('datakelas.kelas',compact('kelas','guru'));  
      
    }
    public function store(Request $request)
    {
        Kelas::create($request->all());
        return redirect('/data-kelas')->with('toast_success','Data berhasil ditambahkan !');
    }
    public function update(Request $request, $id)
    {
        $kelas = Kelas::find($id);
        $kelas->update($request->all());
        return redirect('/data-kelas')->with('toast_success','Data berhasil diubah !');
    }
    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
       return redirect('/data-kelas')->with('toast_success','Data berhasil dihapus !');
    }
}
