<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index(Mahasiswa $mahasiswas)
    {
        $mahasiswas = Mahasiswa::get();
        return view('mahasiswa.index',['mahasiswas'=>$mahasiswas]);
    }

    public function create(){
        return view('mahasiswa.create');
    }

    public function store(Request $request){
        $request->validate([
            'npm' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'photo' => 'required|file|image|max:4000',
        ]);

        if($request->hasFile('photo')){
            $extFile = $request->photo->getClientOriginalExtension();
            $namaFile = 'mahasiswa_'. time() . "." . $extFile;
            $path = $request->photo->storeAs('public',$namaFile);
            $newPath = asset('storage/'.$namaFile);

        }

        $mahasiswa = new Mahasiswa;
        $mahasiswa->npm = $request->input('npm');
        $mahasiswa->nama = $request->input('nama');
        $mahasiswa->jenis_kelamin = $request->input('jenis_kelamin');
        $mahasiswa->alamat = $request->input('alamat');
        $mahasiswa->tempat_lahir = $request->input('tempat_lahir');
        $mahasiswa->tanggal_lahir = $request->input('tanggal_lahir');
        $mahasiswa->photo = $namaFile;
        $mahasiswa->save();
        
        return redirect()->route('mahasiswa.index')->with('message',"Data mahasiswa berhasil ditambahkan");
    }

    public function edit($id){
        $data = Mahasiswa::find($id);
        return view('mahasiswa.edit',['mahasiswas' => $data]);
    }

    public function update(Request $request, $id){
        $request -> validate([
            'npm' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'photo' => 'image|max:5000',
            'updated_at' => now()
        ]);

        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->npm = $request->input('npm');
        $mahasiswa->nama = $request->input('nama');
        $mahasiswa->jenis_kelamin = $request->input('jenis_kelamin');
        $mahasiswa->alamat = $request->input('alamat');
        $mahasiswa->tempat_lahir = $request->input('tempat_lahir');
        $mahasiswa->tanggal_lahir = $request->input('tanggal_lahir');

        if($request->hasFile('photo')){
            $destination = 'public'.$request->photo;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $extFile = $request->photo->getClientOriginalExtension();
            $namaFile = 'mahasiswa_'. time() . "." . $extFile;
            $path = $request->photo->storeAs('public',$namaFile);
            $newPath = asset('storage/'.$namaFile);

            $mahasiswa->photo = $namaFile;
        }
        $mahasiswa->update();
        return redirect()->route('mahasiswa.index')->with('message',"Data mahasiswa berhasil diubah");
    }

    public function destroy($id){
        $mahasiswa = Mahasiswa::findOrFail($id);
        if(Storage::delete($mahasiswa->photo)){
            $mahasiswa->delete();
        }
        return redirect()->route('mahasiswa.index')->with('message',"Data mahasiswa berhasil dihapus");
    }
}
