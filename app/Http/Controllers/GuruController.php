<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all(); 
        return view('dataguru.guru',[
            'guru'      => $guru
        ]);
    }
    public function create()
    {
        return view('dataguru.tambah');
    }
    public function store(Request $request)
    {
        $messages = [
            'regex' => ':attribute harus diisi dengan huruf saja',
            'unique' => 'data ini sudah digunakan'
        ];
        $this->validate($request,[
            'nama' => 'regex:/^[a-zA-Z\s]+$/',
            'nip' => 'required|unique:users',
            'notelp' => 'required|unique:users'
        ],$messages);

        $filegambar = null;

        if($request->hasFile('foto')){
            $tujuan_upload = 'assets/img/pegawai';
            $file = $request->file('foto');
            $filegambar = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$filegambar);
        }
          
        Guru::create([
            'NIP'         => $request->nip,
            'password'    => Hash::make($request->nip),
            'nama'        => $request->nama,
            'jk'          => $request->input('jeniskelamin'),
            'agama'       => $request->agama,
            'notelp'      => $request->notelp,
            'tempatlahir' => $request->tempatlahir,
            'tgllahir'    => $request->tgllahir,
            'foto'        => $filegambar,
            'alamat'      => $request->alamat,
        ]);
        return redirect('/data-guru')->with('toast_success', 'Data Guru Berhasil di Tambahkan');
    }
    public function edit($id)
    {
        $guru = Guru::find($id);
        return view('dataguru.edit',[
            'guru'      => $guru
        ]);

    }
    public function update(Request $request, $id)
    {
        $guru = Guru::find($id);
        $data = [
            'NIP'         => $request->nip,
            'password'    => Hash::make($request->nip),
            'nama'        => $request->nama,
            'jk'          => $request->input('jeniskelamin'),
            'agama'       => $request->agama,
            'notelp'      => $request->notelp,
            'tempatlahir' => $request->tempatlahir,
            'tgllahir'    => $request->tgllahir,
            'alamat'      => $request->alamat,
        ];
        
        if($request->hasFile('foto')){
            $tujuan_upload = 'assets/img/pegawai';
            $file = $request->file('foto');
            $filegambar = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$filegambar);

            $folderDir1 = $tujuan_upload.'/'.$guru->foto;
            File::delete($folderDir1);
            //update post with new image
            $data['foto'] = $filegambar;
        }
          
        $guru->update($data);
        return redirect('/data-guru')->with('toast_success', 'Data Guru Berhasil di Ubah');
    
    }
    public function destroy($id)
    {
        $guru = Guru::find($id);
       
        //delete data
        $tujuan_upload = 'assets/img/pegawai/'.$guru->foto;
        if(File::exists($tujuan_upload))
        {
            File::delete($tujuan_upload);
        }
        //delete data
       $guru->delete();

        return redirect('/data-guru')->with('toast_success', 'Data Guru Berhasil di Hapus');
    }
    public function lihat()
    {
        $guru = Guru::all(); 
        return view('dataguru.lihat',[
            'guru'      => $guru
        ]);
    }
}
