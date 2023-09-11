@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-body">
               <div class="d-flex flex-wrap align-items-center justify-content-between">
                  <div class="d-flex flex-wrap align-items-center">
                     <div class="profile-img position-relative me-3 mb-3 mb-lg-0 profile-logo profile-logo1">
                        <img src="@if($user->foto_user == null){{ asset('foto_user/default1.jpg') }}@else{{ asset('foto_user/'.$user->foto_user) }}@endif" alt="User-Profile" class="theme-color-default-img img-fluid rounded-pill avatar-100">
                     </div>
                     <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                        <h4 class="me-2 h4">{{$user->nama_user}}</h4>
                        <span> - {{$user->status}}</span>
                     </div>
                  </div>
               </div>
            </div>
        </div>
         <div class="card">
            <div class="card-header">
               <div class="header-title">
                  <h4 class="card-title">Tentang Anda</h4>
               </div>
            </div>
            <div class="card-body">
               <div class="user-bio">
                  <p>Jika ingin merubah data profil Anda, silahkan ubah di form edit profil.</p>
               </div>
               <div class="mt-2">
               <h6 class="mb-1">Nama Lengkap:</h6>
               <p>{{$user->nama_user}}</p>
               </div>
               <div class="mt-2">
               <h6 class="mb-1">NIK/NIP:</h6>
               <p>{{$user->nik}}</p>
               </div>
               <div class="mt-2">
               <h6 class="mb-1">Nomor Telepon:</h6>
               <p>{{$user->nomor_telepon}}</p>
               </div>
               <div class="mt-2">
               <h6 class="mb-1">Email:</h6>
               <p>{{$user->email}}</p>
               </div>
            </div>
         </div>
    </div>
    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$subTitle}}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
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
                    <form action="/edit-profil/{{$user->id_user}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="nama_user">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_user') is-invalid @enderror" id="nama_user" name="nama_user" value="{{$user->nama_user}}" autofocus placeholder="Masukkan Nama Lengkap ">
                            @error('nama_user')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nik">NIP/NIK</label>
                            <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{$user->nik}}" placeholder="Masukkan NIP/NIK ">
                            @error('nik')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nomor_telepon">Nomor Telepon</label>
                            <input type="number" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{$user->nomor_telepon}}" placeholder="Masukkan NIP/nomor_telepon ">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$user->email}}" placeholder="Masukkan Email ">
                            @error('email')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="foto">Foto</label>
                                    <input type="file" class="form-control @error('foto_user') is-invalid @enderror" id="preview_image" name="foto_user">
                                    @error('foto_user')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="foto_user"></label>
                                    <div class="profile-img-edit position-relative">
                                        <img src="@if($user->foto_user){{ asset('foto_user/'.$user->foto_user) }}@else{{ asset('foto_user/default1.jpg') }}@endif" alt="profile-pic" id="load_image" class="theme-color-default-img profile-pic rounded avatar-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection