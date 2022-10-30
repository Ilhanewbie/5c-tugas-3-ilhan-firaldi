<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $dosen = Dosen::count();
        $mahasiswa = Mahasiswa::count();
        $matakuliah = Matakuliah::count();
        return view('index', compact('dosen','mahasiswa','matakuliah'));
    }
}
