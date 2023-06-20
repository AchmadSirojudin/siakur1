<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class JadwalController extends Controller
{
    public function index()
    {
        $kelas = Kelas::All();
        
        return view('datajadwal.jadwal',[
            'kelas'      => $kelas,
            
        ]);
    }
    public function atur($id)
    {
         $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];
        $jadwal = Jadwal::where("kelas_id",$id)->orderBy("hari",'asc')->get();
        $kelas  =  Kelas::find($id);
        $mapel  =  Mapel::select('id','namamapel')->get(); 
        $guru   =  Guru::select('id','nama')->get(); 
        return view('datajadwal.tambah',[  
            'guru'      => $guru,
            'mapel'     => $mapel,
            'jadwal'    => $jadwal,
            'kelas'     => $kelas,
            'hari' => $hari

        ]);
    }
    public function store(Request $request)
    {
        $jadwal = $request->all();
        Jadwal::create($jadwal);
        return Redirect::back()->with('toast_success','Data berhasil ditambahkan !');
    }
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::find($id);
        $jadwaldata = $request->all();
        //dd($jadwaldata);
        $jadwal->update($jadwaldata);
        return Redirect::back()->with('toast_success','Data berhasil diubah !');
    }
    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();
        return Redirect::back()->with('toast_success','Data berhasil dihapus !');
    }

    public function cetak($id)
    {
        $jadwal =  Jadwal::select('hari','kelas_id')->where("kelas_id",$id)->groupBy('hari','kelas_id')->orderBy("hari",'asc')->get();
        $data = [];
        $no = 0;
        foreach($jadwal as $item){
            $data[$no] = $item;
            $data[$no]->hari = $item->hari;
            $data[$no]->detail = Jadwal::where(['kelas_id' => $item->kelas_id,'hari' => $item->hari])->get();
            $no++;
        }
        // echo json_encode($data);
        // die;
        $kelas  =  Kelas::find($id);
        $mapel  =  Mapel::select('id','namamapel')->get(); 
        $guru   =  Guru::select('id','nama')->get(); 

        $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('datajadwal.cetak',[
            'guru'      => $guru,
            'mapel'     => $mapel,
            'jadwal'    => $data,
            'kelas'     => $kelas,
            'hari' => $hari
        ]);
        return $pdf->stream('laporan-jadwal-pelajaran-pdf');
    }

    public function jadwalsiswa($id)
    {
        $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];
        $jadwal = Jadwal::where("kelas_id",$id)->orderBy("hari",'asc')->get();
        $kelas  =  Kelas::find($id);
        $mapel  =  Mapel::select('id','namamapel')->get(); 
        $guru   =  Guru::select('id','nama')->get(); 
        return view('datajadwal.jadwalsiswa',[  
            'guru'      => $guru,
            'mapel'     => $mapel,
            'jadwal'    => $jadwal,
            'kelas'     => $kelas,
            'hari' => $hari

        ]);
    }

    public function cetakjadwalsiswa($id)
    {
        $jadwal =  Jadwal::select('hari','kelas_id')->where("kelas_id",$id)->groupBy('hari','kelas_id')->orderBy("hari",'asc')->get();
        $data = [];
        $no = 0;
        foreach($jadwal as $item){
            $data[$no] = $item;
            $data[$no]->hari = $item->hari;
            $data[$no]->detail = Jadwal::where(['kelas_id' => $item->kelas_id,'hari' => $item->hari])->get();
            $no++;
        }
        // echo json_encode($data);
        // die;
        $kelas  =  Kelas::find($id);
        $mapel  =  Mapel::select('id','namamapel')->get(); 
        $guru   =  Guru::select('id','nama')->get(); 

        $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('datajadwal.cetaksiswa',[
            'guru'      => $guru,
            'mapel'     => $mapel,
            'jadwal'    => $data,
            'kelas'     => $kelas,
            'hari' => $hari
        ]);
        return $pdf->stream('laporan-jadwal-pelajaran-pdf');
    }

    public function lihat()
    {
        $kelas = Kelas::All();
        
        return view('datajadwal.lihat',[
            'kelas'      => $kelas,
            
        ]);
    }
    public function cekjadwal($id)
    {
         $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];
        $jadwal = Jadwal::where("kelas_id",$id)->orderBy("hari",'asc')->get();
        $kelas  =  Kelas::find($id);
        $mapel  =  Mapel::select('id','namamapel')->get(); 
        $guru   =  Guru::select('id','nama')->get(); 
        return view('datajadwal.cekjadwal',[  
            'guru'      => $guru,
            'mapel'     => $mapel,
            'jadwal'    => $jadwal,
            'kelas'     => $kelas,
            'hari' => $hari

        ]);
    }

    public function cek($id)
    {
         $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];
        $jadwal = Jadwal::where("kelas_id",$id)->orderBy("hari",'asc')->get();
        $kelas  =  Kelas::find($id);
        $mapel  =  Mapel::select('id','namamapel')->get(); 
        $guru   =  Guru::select('id','nama')->get(); 
        return view('datajadwalmengajar.cek',[  
            'guru'      => $guru,
            'mapel'     => $mapel,
            'jadwal'    => $jadwal,
            'kelas'     => $kelas,
            'hari' => $hari

        ]);
    }

 
}
