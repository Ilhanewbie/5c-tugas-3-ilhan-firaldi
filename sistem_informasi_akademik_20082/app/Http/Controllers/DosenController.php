<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function index(Dosen $dosens)
    {
        $dosens = Dosen::get();
        return view('dosen.index',['dosens'=>$dosens]);
    }

    public function create(){
        return view('dosen.create');
    }

    public function store(Request $request){
        $request->validate([
            'nidn' => 'required|max:20',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'photo' => 'required|file|image|max:4000',
        ]);

        if($request->hasFile('photo')){
            $extFile = $request->photo->getClientOriginalExtension();
            $namaFile = 'dosen_'. time() . "." . $extFile;
            $path = $request->photo->storeAs('public',$namaFile);
            $newPath = asset('storage/'.$namaFile);
        }

        $dosen = new Dosen;
        $dosen->nidn = $request->input('nidn');
        $dosen->nama = $request->input('nama');
        $dosen->jenis_kelamin = $request->input('jenis_kelamin');
        $dosen->alamat = $request->input('alamat');
        $dosen->tempat_lahir = $request->input('tempat_lahir');
        $dosen->tanggal_lahir = $request->input('tanggal_lahir');
        $dosen->photo = $namaFile;
        $dosen->save();
        
        return redirect()->route('dosen.index')->with('message',"Data dosen berhasil ditambahkan");
    }

    public function edit($id){
        $data = Dosen::find($id);
        return view('dosen.edit',['dosens' => $data]);
    }

    public function update(Request $request, $id){
        $request -> validate([
            'nidn' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'photo' => 'image|max:5000',
            'updated_at' => now()
        ]);

        $dosen = Dosen::find($id);
        $dosen->nidn = $request->input('nidn');
        $dosen->nama = $request->input('nama');
        $dosen->jenis_kelamin = $request->input('jenis_kelamin');
        $dosen->alamat = $request->input('alamat');
        $dosen->tempat_lahir = $request->input('tempat_lahir');
        $dosen->tanggal_lahir = $request->input('tanggal_lahir');

        if($request->hasFile('photo')){

            $destination = 'public'.$request->photo;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $extFile = $request->photo->getClientOriginalExtension();
            $namaFile = 'dosen_'. time() . "." . $extFile;
            $path = $request->photo->storeAs('public',$namaFile);
            $newPath = asset('storage/'.$namaFile);

            $dosen->photo = $namaFile;
        }

        $dosen->update();
        return redirect()->route('dosen.index')->with('message',"Data dosen berhasil diubah");
    }

    public function destroy($id){
        $dosen = Dosen::findOrFail($id);
        if(Storage::delete($dosen->photo)){
            $dosen->delete();
        }
        return redirect()->route('dosen.index')->with('message',"Data dosen berhasil dihapus");
    }
}
