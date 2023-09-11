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
            <div class="card-body px-4" style="margin-bottom: -50px;">
                @if (session('success'))
                    <div class="col-lg-12">
                        <div class="alert bg-primary text-white alert-dismissible">
                            <span>
                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9846 21.606C11.9846 21.606 19.6566 19.283 19.6566 12.879C19.6566 6.474 19.9346 5.974 19.3196 5.358C18.7036 4.742 12.9906 2.75 11.9846 2.75C10.9786 2.75 5.26557 4.742 4.65057 5.358C4.03457 5.974 4.31257 6.474 4.31257 12.879C4.31257 19.283 11.9846 21.606 11.9846 21.606Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>                            
                                {{ session('success') }}
                            </span>
                        </div>
                    </div>
                @endif
                @if (session('fail'))
                    <div class="col-lg-12">
                        <div class="alert bg-danger text-white alert-dismissible">
                            <span>
                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9852 21.606C11.9852 21.606 19.6572 19.283 19.6572 12.879C19.6572 6.474 19.9352 5.974 19.3192 5.358C18.7042 4.742 12.9912 2.75 11.9852 2.75C10.9792 2.75 5.26616 4.742 4.65016 5.358C4.03516 5.974 4.31316 6.474 4.31316 12.879C4.31316 19.283 11.9852 21.606 11.9852 21.606Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M13.864 13.8249L10.106 10.0669" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M10.106 13.8249L13.864 10.0669" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                {{ session('fail') }}
                            </span>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <form action="@if($form === 'Tambah') /tambah-kriteria @elseif($form === 'Edit') /edit-kriteria/{{$detail->id_kriteria}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nama_kriteria">Nama Kriteria <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror" id="nama_kriteria" name="nama_kriteria" value="@if($form === 'Tambah'){{ old('nama_kriteria') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->nama_kriteria}}@endif" @if($form === 'Detail') disabled @endif autofocus placeholder="Masukkan Nama Kriteria ">
                            @error('nama_kriteria')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="bobot">Bobot (%) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('bobot') is-invalid @enderror" id="bobot" name="bobot" value="@if($form === 'Tambah'){{ old('bobot') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->bobot * 100}}@endif"  @if($form === 'Detail') disabled @endif placeholder="Masukkan Bobot">
                            @error('bobot')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="bobot">Ideal Positif/Negatif <span class="text-danger">*</span></label>
                            <select name="ideal" id="ideal" class="selectpicker form-control @error('ideal') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif required>
                                @if ($form === 'Tambah')
                                    <option>-- Pilih --</option>    
                                @elseif ($form === 'Edit' || $form === 'Detail')
                                    <option value="{{$detail->ideal}}">{{$detail->ideal}}</option>
                                @endif
                                <option value="Benefit">Benefit</option>
                                <option value="Cost">Cost</option>
                            </select>
                            @error('ideal')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <a href="/daftar-kriteria" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection