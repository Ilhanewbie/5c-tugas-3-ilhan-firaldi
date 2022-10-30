<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
{
    public function index(Matakuliah $matakuliahs)
    {
        $matakuliahs = Matakuliah::get();
        return view('matakuliah.index',['matakuliahs'=>$matakuliahs]);
    }

    public function create(){
        return view('matakuliah.create');
    }

    public function store(Request $request){
        $request->validate([
            'kode_mk' => 'required|max:6',
            'nama_mk' => 'required',
        ]);

        Matakuliah::create($request->all());
        
        return redirect()->route('matakuliah.index')->with('message',"Data matakuliah berhasil ditambahkan");
    }

    public function edit($id){
        $data = Matakuliah::find($id);
        return view('matakuliah.edit',['matakuliahs' => $data]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'kode_mk' => 'required|max:6',
            'nama_mk' => 'required',
        ]);


        $matakuliah = Matakuliah::find($id);
        $matakuliah->kode_mk = $request->input('kode_mk');
        $matakuliah->nama_mk = $request->input('nama_mk');

        $matakuliah->update();
        return redirect()->route('matakuliah.index')->with('message',"Data matakuliah berhasil diubah");
    }

    public function destroy($id){
        $matakuliah = Matakuliah::find($id);
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('message',"Data matakuliah berhasil dihapus");
    }
}
