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
                    <form action="@if($form === 'Tambah') /tambah-mahasiswa @elseif($form === 'Edit') /edit-mahasiswa/{{$detail->id_mahasiswa}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nama_mahasiswa">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" name="nama_mahasiswa" value="@if($form === 'Tambah'){{ old('nama_mahasiswa') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->nama_mahasiswa}}@endif" @if($form === 'Detail') disabled @endif autofocus placeholder="Masukkan Nama Lengkap ">
                            @error('nama_mahasiswa')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nim">NIM <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="@if($form === 'Tambah'){{ old('nim') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->nim}}@endif"  @if($form === 'Detail') disabled @endif placeholder="Masukkan NIM">
                            @error('nim')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tahun_angkatan">Tahun Angkatan <span class="text-danger">* Contoh: 2020</span></label>
                            <input type="number" class="form-control @error('tahun_angkatan') is-invalid @enderror" id="tahun_angkatan" name="tahun_angkatan" value="@if($form === 'Tambah'){{ old('tahun_angkatan') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->tahun_angkatan}}@endif"  @if($form === 'Detail') disabled @endif placeholder="Masukkan Tahun Angkatan" min="2000" max="2099">
                            @error('tahun_angkatan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nomor_telepon">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="@if($form === 'Tambah'){{ old('nomor_telepon') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->nomor_telepon}}@endif"  @if($form === 'Detail') disabled @endif placeholder="Masukkan Nomor Telepon">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="prodi">Program Studi <span class="text-danger">*</span></label>
                            <select name="prodi" id="prodi" class="selectpicker form-control @error('prodi') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif>
                                @if ($form === 'Tambah')
                                    <option>-- Pilih --</option>    
                                @elseif ($form === 'Edit' || $form === 'Detail')
                                    <option value="{{$detail->prodi}}">{{$detail->prodi}}</option>
                                @endif
                                @foreach ($dataProdi as $item)
                                    <option value="{{$item->program_studi}}">{{$item->program_studi}}</option>
                                @endforeach
                            </select>
                            @error('prodi')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="@if($form === 'Tambah'){{ old('email') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->email}}@endif" @if($form === 'Detail') disabled @endif placeholder="Masukkan Email ">
                            @error('email')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" @if($form === 'Detail') disabled @endif placeholder="Masukkan Password ">
                            @error('password')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="foto">Foto <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('foto_user') is-invalid @enderror" id="preview_image" name="foto_user" @if($form === 'Detail') disabled @endif>
                            @error('foto_user')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label class="form-label" for="foto_user"></label>
                            <div class="profile-img-edit position-relative">
                                <img src="@if($form === 'Tambah') {{ asset('foto_user/default1.jpg') }} @elseif($form === 'Edit' || $form === 'Detail') {{ asset('foto_user/'.$detail->foto_user) }} @endif" alt="profile-pic" id="load_image" class="theme-color-default-img profile-pic rounded avatar-100">
                            </div>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label class="form-label" for="status_pengajuan">Status Pengajuan <span class="text-danger">*</span></label>
                            <select name="status_pengajuan" id="status_pengajuan" class="selectpicker form-control @error('status_pengajuan') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif>
                                @if ($form === 'Tambah')
                                    <option>-- Pilih --</option>    
                                @elseif ($form === 'Edit' || $form === 'Detail')
                                    <option value="{{$detail->status_pengajuan}}">{{$detail->status_pengajuan}}</option>
                                @endif
                                <option value="Tidak">Tidak</option>
                                <option value="Penangguhan">Penangguhan</option>
                                <option value="Penurunan">Penurunan</option>
                            </select>
                            @error('status_pengajuan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if ($form === 'Edit')
                        <div class="form-group col-md-6">
                            <label class="form-label" for="status_mahasiswa">Status Mahasiswa <span class="text-danger">*</span></label>
                            <select name="status_mahasiswa" id="status_mahasiswa" class="selectpicker form-control @error('status_mahasiswa') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif>
                                @if ($form === 'Tambah')
                                    <option>-- Pilih --</option>    
                                @elseif ($form === 'Edit' || $form === 'Detail')
                                    <option value="{{$detail->status_mahasiswa}}">{{$detail->status_mahasiswa}}</option>
                                @endif
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            @error('status_mahasiswa')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @endif
                        @if ($form === 'Edit' && $detail->id_kelompok_ukt !== null)
                        <div class="form-group col-md-6">
                            <label class="form-label" for="id_kelompok_ukt">Kelompok UKT</label>
                            <select name="id_kelompok_ukt" id="id_kelompok_ukt" class="selectpicker form-control @error('id_kelompok_ukt') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif>  
                                @if ($form === 'Edit' || $form === 'Detail')
                                    <option value="{{$detail->id_kelompok_ukt}}">{{$detail->kelompok_ukt}} | {{'Rp '.number_format($detail->nominal, 0, ',', '.')}}</option>
                                @endif
                                @foreach ($dataUKT as $item)
                                    @if ($item->program_studi == $detail->prodi)
                                        <option value="{{$item->id_kelompok_ukt}}">{{$item->kelompok_ukt}} | {{'Rp '.number_format($item->nominal, 0, ',', '.')}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kelompok_ukt')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @endif
                    </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <a href="/daftar-mahasiswa" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection