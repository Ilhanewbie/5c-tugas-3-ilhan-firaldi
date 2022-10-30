@extends('master')
@section('title','Dashboard')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9">
                    <h1 class="mt-3">Dashboard</h1>
                </div> 
            </div>
            <div class="kartu col-lg-3">
                <div class="card">
                    <div class="card-header">
                      Dosen
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Dosen</h5>
                      <p class="card-text">Jumlah dosen : {{ $dosen }} </p>
                      <a href="{{ route('dosen.index')}}" class="btn btn-primary">Lihat Data</a>
                    </div>
                  </div>
            </div>
            <div class="kartu col-lg-3">
                <div class="card">
                    <div class="card-header">
                      Mahasiswa
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Mahasiswa</h5>
                      <p class="card-text">Jumlah mahasiswa : {{ $mahasiswa }}</p>
                      <a href="{{ route('mahasiswa.index')}}" class="btn btn-primary">Lihat Data</a>
                    </div>
                  </div>
            </div>
            <div class="kartu col-lg-3">
                <div class="card">
                    <div class="card-header">
                      Matakuliah
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Matakuliah</h5>
                      <p class="card-text">Jumlah Matakuliah : {{ $matakuliah }}</p>
                      <a href="{{ route('matakuliah.index')}}" class="btn btn-primary">Lihat Data</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection