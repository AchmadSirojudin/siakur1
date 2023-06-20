<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Raport;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RaportController extends Controller
{
    
    public function index()
    {
        $data = Auth::guard('guru')->user()->id;
        $kelas = Kelas::where('guru_id',$data)->first();
        $kelasid = $kelas->id;
        $siswa = Siswa::where('kelas_id',$kelasid)->get();
        return view('dataraport.raport',[
            'kelas' => $kelas,
            'siswa' => $siswa
        ]);
    }
    public function input($id,$smt)
    {
        $siswa       = Siswa::where('id',$id)->first();
        $raport      = Nilai::where('siswa_id',$id)->where('semester',$smt)->whereNotNull('mapel_id')->get();
        $raport_ket  = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('sakit');
        $raport_ket2 = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('ijin');
        $raport_ket3 = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('tanpa_ket');
        $semester    = $smt;
        $mapel  =  Mapel::select('id','namamapel')->get(); 
        $idraport = Raport::where('siswa_id',$id)->where('mapel_id',null)->where('semester',$smt)->first();
        $kelas = Kelas::All();
        return view('dataraport.input',[
            'siswa'         => $siswa,
            'raport'        => $raport,
            'mapel'         => $mapel,
            'raport_ket'    => $raport_ket,
            'raport_ket2'   => $raport_ket2,
            'raport_ket3'   => $raport_ket3,
            'idraport'      => $idraport,
            'semester'      => $semester,
            'kelas'         => $kelas
        ]);
    
    }

    public function tambahnilai(Request $request)
    {
        $nilai_pth = $request->nilai_pth;
        $nilai_ktr = $request->nilai_ktr;
       
        if($nilai_pth >= 85 && $nilai_pth <= 100){
            $nilai_huruf_pth = 'A';
        }elseif ($nilai_pth >= 70 && $nilai_pth < 85){
            $nilai_huruf_pth = 'B';
        }elseif ($nilai_pth >= 55 && $nilai_pth < 70){
            $nilai_huruf_pth = 'C';
        }elseif ($nilai_pth >= 40 && $nilai_pth < 55){
            $nilai_huruf_pth = 'D';
        }else{
            $nilai_huruf_pth = 'E';
        }

        if($nilai_ktr >= 85 && $nilai_ktr <= 100){
            $nilai_huruf_ktr = 'A';
        }elseif ($nilai_ktr >= 70 && $nilai_ktr < 85){
            $nilai_huruf_ktr = 'B';
        }elseif ($nilai_ktr >= 55 && $nilai_ktr < 70){
            $nilai_huruf_ktr = 'C';
        }elseif ($nilai_ktr >= 40 && $nilai_ktr < 55){
            $nilai_huruf_ktr = 'D';
        }else{
            $nilai_huruf_ktr = 'E';
        }
   

        Raport::create([
            'sakit'             => 0,
            'ijin'              => 0,
            'tanpa_ket'         => 0,
            'nilai_pth'         => $request->nilai_pth,
            'nilai_ktr'         => $request->nilai_ktr,
            'nilai_huruf_pth'   => $nilai_huruf_pth,
            'nilai_huruf_ktr'   => $nilai_huruf_ktr,
            'siswa_id'          => $request->siswa_id,
            'mapel_id'          => $request->mapel_id,
            'guru_id'           => $request->guru_id,
            'semester'          => $request->semester
           
        ]);
       
        return Redirect::back();
    }
    public function destroy($id)
    {
        $raport = Raport::find($id);
        $raport->delete();
        return Redirect::back();
    }
    public function store(Request $request)
    {
        // dd($request->idraport);
        if($request->idraport == null){
            Raport::create($request->all());
        }else{
            $data = Raport::where(
                [
                    "id"=> $request->idraport
                ])->first();
            $data->update($request->all());

        }
        $datasiswa = Siswa::where(
            [
                "id"=> $request->siswa_id
            ])->first();
        // $datasiswa->kelas_id = $request->kelassiswa;
        // // $datasiswa->kelas_id = $request->kelas;
        // $datasiswa->save();
            
        $semester = $request->semester;
        $siswaid = $request->siswa_id;
        return redirect('/data-cetak-raport/'.$semester.'/'.$siswaid);
       
    }
    public function cetak($smt,$id)
    {
        $data = Auth::guard('guru')->user()->id;
        
        $kelas = Kelas::where('guru_id',$data)->first();
        $kelasid = $kelas->id;
        $siswa = Siswa::where('kelas_id',$kelasid)->first();
        $mapel  =  Mapel::select('id','namamapel')->get(); 
        $raport = Nilai::where('siswa_id',$id)->where('semester',$smt)->whereNotNull('mapel_id')->get();
        $raport_ket = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('sakit');
        $raport_ket2 = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('ijin');
        $raport_ket3 = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('tanpa_ket');

        $status = Raport::where('siswa_id',$id)->where('mapel_id',null)->where('semester',$smt)->first();

        $kepsek = User::where('jabatan','Kepala Sekolah')->first();
        $walikelas_nama = Auth::guard('guru')->user()->nama;
        $walikelas_nip = Auth::guard('guru')->user()->NIP;
       
        $tanggalSekarang = Carbon::now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y');
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('dataraport.cetak',[
            'kelas'             => $kelas,
            'siswa'             => $siswa,
            'mapel'             => $mapel,
            'raport'            => $raport,
            'raport_ket'        => $raport_ket,
            'raport_ket2'       => $raport_ket2,
            'raport_ket3'       => $raport_ket3,
            'kepsek'            => $kepsek,
            'tanggal'           => $tanggalSekarang,
            'walikelasnama'     => $walikelas_nama,
            'walikelasnip'      => $walikelas_nip,
            'semester'          => $smt,
            'status'            => $status
        ]);
        return $pdf->stream('Laporan hasil belajar - '.$siswa->nisn . ' (' .$siswa->fullname. ') .pdf');

    }

    public function show()
    {
        $kelas = Kelas::All();
        
        return view('dataraportadmin.raport',[
            'kelas'      => $kelas,
            
        ]);
    }
    public function cek($id)
    {
        $siswa =  Siswa::where("kelas_id",$id)->get();
        return view('dataraportadmin.siswa',[
            'siswa'      => $siswa,

        ]);
    }
    public function cetakraport($id,$smt)
    {
        $siswa = Siswa::where('id',$id)->first();
        $dataraport = Raport::where(
            [
                "siswa_id"  => $id,
                "semester"  => $smt
            ])->first();
        
        if($dataraport ){
        $raport = Nilai::where('siswa_id',$id)->where('semester',$smt)->whereNotNull('mapel_id')->get();
        $raport_ket = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('sakit');
        $raport_ket2 = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('ijin');
        $raport_ket3 = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('tanpa_ket');

        $status = Raport::where('siswa_id',$id)->where('mapel_id',null)->where('semester',$smt)->first();

        $kepsek = User::where('jabatan','Kepala Sekolah')->first();
        $datawalikelas = Raport::where('siswa_id',$id)->where('semester',$smt)->first();
        $walikelas = Guru::where('id',$datawalikelas->guru_id)->first();
       
        $tanggalSekarang = Carbon::now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y');
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('dataraportadmin.cetak',[
            'siswa'             => $siswa,
            'raport'            => $raport,
            'raport_ket'        => $raport_ket,
            'raport_ket2'       => $raport_ket2,
            'raport_ket3'       => $raport_ket3,
            'kepsek'            => $kepsek,
            'tanggal'           => $tanggalSekarang,
            'semester'          => $smt,
            'status'            => $status,
            'walikelas'         => $walikelas,
        ]);
        return $pdf->stream('Laporan hasil belajar - '.$siswa->nisn . ' (' .$siswa->fullname. ') .pdf');
    }else{
        return Redirect::back()->with('toast_error','Data raport belum ada');
    }

    }

    public function cetakraportsiswa($id,$smt)
    {
        $siswa = Siswa::where('id',$id)->first();
        $dataraport = Raport::where(
            [
                "siswa_id"  => $id,
                "semester"  => $smt
            ])->first();
        
        if($dataraport ){
        $raport = Nilai::where('siswa_id',$id)->where('semester',$smt)->whereNotNull('mapel_id')->get();
        $raport_ket = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('sakit');
        $raport_ket2 = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('ijin');
        $raport_ket3 = Raport::where('siswa_id',$id)->where('semester',$smt)->sum('tanpa_ket');

        $status = Raport::where('siswa_id',$id)->where('mapel_id',null)->where('semester',$smt)->first();

        $kepsek = User::where('jabatan','Kepala Sekolah')->first();
        $datawalikelas = Raport::where('siswa_id',$id)->where('semester',$smt)->first();
        $walikelas = Guru::where('id',$datawalikelas->guru_id)->first();
       
        $tanggalSekarang = Carbon::now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y');
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('dataraportadmin.cetak',[
            'siswa'             => $siswa,
            'raport'            => $raport,
            'raport_ket'        => $raport_ket,
            'raport_ket2'       => $raport_ket2,
            'raport_ket3'       => $raport_ket3,
            'kepsek'            => $kepsek,
            'tanggal'           => $tanggalSekarang,
            'semester'          => $smt,
            'status'            => $status,
            'walikelas'         => $walikelas,
        ]);
        return $pdf->stream('Laporan hasil belajar - '.$siswa->nisn . ' (' .$siswa->fullname. ') .pdf');
    }else{
        return Redirect::back()->with('toast_error','Data raport belum ada');
    }

    }
}
