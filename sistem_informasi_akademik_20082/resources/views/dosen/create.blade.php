@extends('master')
@section('title','Create Dosen')
@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-12">
            <h3 style="text-align: center">Form Dosen</h3>
            <div class="row justify-content-center">
                <div class="col-lg-6 mt-3">
                    <form method="post" action="{{ route('dosen.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="nidn" placeholder="2251XX" value="{{ old('nidn') }}">
                            <label for="floatingInput">NIDN</label>
                            @error('nidn')
                            <p style="color: red">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="nama" placeholder="Nama Lengkap" {{ old('nama') }}>
                            <label for="floatingInput">Nama</label>
                            @error('nama')
                            <p style="color: red">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" name="jenis_kelamin" aria-label="Floating label select example">
                                <option {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }} value="laki-laki">Laki-laki</option>
                                <option {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }} value="perempuan">Perempuan</option>
    
                            </select>
                            <label for="floatingSelect">Jenis Kelamin</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" name="alamat" placeholder="Alamat Lengkap" id="floatingTextarea2" value="{{ old('alamat') }}">
                            <label for="floatingInput">Alamat</label>
                            @error('alamat')
                            <p style="color: red">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="tempat_lahir" placeholder="" value="{{ old('tempat_lahir') }}">
                            <label for="floatingInput">Tempat Lahir</label>
                            @error('tempat_lahir')
                            <p style="color: red">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="startDate" name="tanggal_lahir" placeholder="" value="{{ old('tanggal_lahir') }}">
                            <label for="startDate">Tanggal Lahir</label>    
                            @error('tanggal_lahir')
                            <p style="color: red">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload</label>
                            <input class="form-control" type="file" name="photo" id="formFile">
                            @error('photo')
                            <p style="color: red">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mt-3 mb-3">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
