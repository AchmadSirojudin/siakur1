<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::All();
        return view('datamapel.mapel',[
            'mapel'      => $mapel
        ]);
      
    } 
    public function store(Request $request)
    {
        $q = DB::table('mapel')->select(DB::raw('MAX(RIGHT(kodemapel,3)) as kode'));
        $kd ="";
        if($q->count()>0){
            foreach($q->get() as $k)
            {
                $tmp = ((int) $k->kode)+1;
                $kd = sprintf("%03s",$tmp);
            }
        }
        else{
            $kd = "001";
        }
        $kodemapel = "KMP". $kd;
        $data = new Mapel();
        $data->kodemapel = $kodemapel;
        $data->namamapel = $request->namamapel;
        $data->save();
        return redirect('/data-mapel')->with('toast_success','Data berhasil ditambahkan !');
    }
    // edit
    public function update(Request $request, $id)
    {
        $mapel = Mapel::find($id);
        $mapel->update($request->all());
        return redirect('/data-mapel')->with('toast_success','Data berhasil diubah !');
    }
    // hapus
    public function destroy($id)
    {
        $mapel = Mapel::find($id);
        $mapel->delete();
        return redirect('/data-mapel')->with('toast_success','Data berhasil dihapus !');
    }
}
