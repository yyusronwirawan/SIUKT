@extends('auth.main')

@section('content')
<section class="login-content">
   <div class="row m-0 align-items-center bg-white vh-100">            
      <div class="col-md-6">
         <div class="row justify-content-center">
            <div class="col-md-10">
               <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                  <div class="card-body">
                     <a href="{{ asset('template/html/dashboard/index.html') }}" class="navbar-brand d-flex align-items-center mb-3">
                        <!--Logo start-->
                        <img src="{{ asset('gambar/logo.png') }}" width="175" alt="Logo Jawer.id">
                     </a>
                     <h2 class="mb-2 text-center">Reset Password</h2>
                     <p class="text-center">Silahkan masukkan password baru.</p>
                     <form action="@if($user->status === 'Mahasiswa') /reset-password/{{$user->id_mahasiswa}} @elseif($user->status === 'Bagian Keuangan' || $user->status === 'Kabag Umum & Akademik'|| $user->status === 'Akademik') /reset-password/{{$user->id_user}} @endif" method="POST">
                        @csrf
                        <div class="row">
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
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="password" class="form-label">Password Baru</label>
                                 <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" aria-describedby="password" placeholder=" " autofocus>
                                 <input type="hidden" class="form-control" name="status"  value="{{$user->status}}">
                                 @error('password')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <div class="form-group">
                                 <label for="password_confirmation" class="form-label">Ulangi Password Baru</label>
                                 <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" aria-describedby="password_confirmation" placeholder=" ">
                                 @error('password_confirmation')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                        </div>
                        <div class="d-flex justify-content-center  mt-5">
                           <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="sign-bg">
            <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g opacity="0.05">
               <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
               <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
               <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
               <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
               </g>
            </svg>
         </div>
      </div>
      <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
         <img src="{{ asset('template/html/assets/images/auth/01.png') }}" class="img-fluid gradient-main animated-scaleX" alt="images">
      </div>
   </div>
 </section>
@endsection
