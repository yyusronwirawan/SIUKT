@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$subTitle}}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <form action="@if($form === 'Tambah') /tambah-user @elseif($form === 'Edit') /edit-user/{{$detail->id_user}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nama_user">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_user') is-invalid @enderror" id="nama_user" name="nama_user" value="@if($form === 'Tambah'){{ old('nama_user') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->nama_user}}@endif" @if($form === 'Detail') disabled @endif autofocus placeholder="Masukkan Nama Lengkap ">
                            @error('nama_user')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nik">NIK/NIP</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="@if($form === 'Tambah'){{ old('nik') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->nik}}@endif"  @if($form === 'Detail') disabled @endif placeholder="Masukkan nik">
                            @error('nik')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nomor_telepon">Nomor Telepon</label>
                            <input type="number" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="@if($form === 'Tambah'){{ old('nomor_telepon') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->nomor_telepon}}@endif"  @if($form === 'Detail') disabled @endif placeholder="Masukkan Nomor Telepon">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="@if($form === 'Tambah'){{ old('email') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->email}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Email ">
                            @error('email')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" @if($form === 'Detail') disabled @endif placeholder="Masukkan Password ">
                            @error('password')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="status">Role</label>
                            <select name="status" id="status" class="selectpicker form-control @error('status') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif>
                                @if ($form === 'Tambah')
                                    <option value="">-- Pilih --</option>    
                                @elseif ($form === 'Edit' || $form === 'Detail')
                                    <option value="{{$detail->status}}">{{$detail->status}}</option>
                                @endif
                                <option value="Bagian Keuangan">Bagian Keuangan</option>
                                <option value="Kabag Umum & Akademik">Kabag Umum & Akademik</option>
                                <option value="Akademik">Akademik</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="foto">Foto</label>
                            <input type="file" class="form-control @error('foto_user') is-invalid @enderror" id="preview_image" name="foto_user" @if($form === 'Detail') disabled @endif>
                            @error('foto_user')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="foto_user"></label>
                            <div class="profile-img-edit position-relative">
                                <img src="@if($form === 'Tambah') {{ asset('foto_user/default1.jpg') }} @elseif($form === 'Edit' || $form === 'Detail') {{ asset('foto_user/'.$detail->foto_user) }} @endif" alt="profile-pic" id="load_image" class="theme-color-default-img profile-pic rounded avatar-100">
                            </div>
                        </div>
                    </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <a href="/daftar-user" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection