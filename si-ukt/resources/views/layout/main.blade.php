

<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>SI UKT | {{ $subTitle }}</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('template/html/assets/images/favicon.ico') }}" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="{{ asset('template/html/assets/css/core/libs.min.css') }}" />
      
      <!-- Aos Animation Css -->
      <link rel="stylesheet" href="{{ asset('template/html/assets/vendor/aos/dist/aos.css') }}" />
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="{{ asset('template/html/assets/css/hope-ui.min.css?v=1.2.0') }}" />
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="{{ asset('template/html/assets/css/custom.min.css?v=1.2.0') }}" />
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="{{ asset('template/html/assets/css/dark.min.css') }}"/>
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="{{ asset('template/html/assets/css/customizer.min.css') }}" />
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="{{ asset('template/html/assets/css/rtl.min.css') }}"/>
      
  </head>
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    
    </div>
    <!-- loader END -->
    
    {{-- sidebar --}}
    @include('layout.sidebar')  

    <main class="main-content">
      <div class="position-relative iq-banner">
        <!--Nav Start-->
        <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
          <div class="container-fluid navbar-inner">
            <a href="#" class="navbar-brand">
                <!--Logo start-->
                <!--logo End-->        <h4 class="logo-title">SI UKT</h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                 <svg width="20px" height="20px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                </svg>
                </i>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon">
                  <span class="mt-2 navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                <li class="nav-item dropdown">
                  <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="@if($user->foto_user === null) {{ asset('foto_user/default1.jpg') }} @else {{ asset('foto_user/'.$user->foto_user) }} @endif" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                    <div class="caption ms-3 d-none d-md-block ">
                        <h6 class="mb-0 caption-title">@if($user->status === 'Bagian Keuangan' || $user->status === 'Kabag Umum & Akademik' || $user->status === 'Akademik'){{$user->nama_user}}@elseif($user->status === 'Mahasiswa'){{$user->nama_mahasiswa}}@endif</h6>
                        <p class="mb-0 caption-sub-title">{{$user->status}}</p>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="@if($user->status === 'Bagian Keuangan'||$user->status === 'Kabag Umum & Akademik'||$user->status === 'Akademik') /profil @elseif($user->status === 'Mahasiswa') /profil-mahasiswa @endif">Profil</a></li>
                    <li><a class="dropdown-item" href="@if($user->status === 'Bagian Keuangan'||$user->status === 'Kabag Umum & Akademik'||$user->status === 'Akademik') /ubah-password @elseif($user->status === 'Mahasiswa') /ubah-password-mahasiswa @endif">Ubah Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout">Logout</button></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>          <!-- Nav Header Component Start -->
          <div class="iq-navbar-header" style="height: 215px;">
              <div class="container-fluid iq-container">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="flex-wrap d-flex justify-content-between align-items-center">
                              <div>
                                @if($subTitle === 'Dashboard')
                                  <h1>Hello, @if($user->status === 'Bagian Keuangan' || $user->status === 'Kabag Umum & Akademik' || $user->status === 'Akademik'){{$user->nama_user}}@elseif($user->status === 'Mahasiswa'){{$user->nama_mahasiswa}}@endif</h1>
                                  <p>Selamat Datang Di Website Sistem Informasi Uang Kuliah Tunggal (UKT).</p>
                                @else
                                  <h1>{{$subTitle}}</h1>
                                  <p>Silahkan Jelajahi {{$subTitle}}.</p>
                                @endif
                              </div>
                              <div >
                                  <a href="" class="btn btn-link btn-soft-light">
                                      @if($title === null)
                                        {{$subTitle}}
                                        @else
                                        {{$title}} / {{$subTitle}}
                                      @endif
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="iq-header-img">
                  <img src="{{ asset('template/html/assets/images/dashboard/top-header.png') }}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                  <img src="{{ asset('template/html/assets/images/dashboard/top-header1.png') }}" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                  <img src="{{ asset('template/html/assets/images/dashboard/top-header2.png') }}" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                  <img src="{{ asset('template/html/assets/images/dashboard/top-header3.png') }}" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                  <img src="{{ asset('template/html/assets/images/dashboard/top-header4.png') }}" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                  <img src="{{ asset('template/html/assets/images/dashboard/top-header5.png') }}" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
              </div>
          </div>          <!-- Nav Header Component End -->
        <!--Nav End-->
      </div>
      <div class="conatiner-fluid content-inner mt-n5 py-0">

        {{-- content --}}
        @yield('content')

      </div>
      {{-- <div class="btn-download">
          <a class="btn btn-danger px-3 py-2" href="https://iqonic.design/product/admin-templates/hope-ui-admin-free-open-source-bootstrap-admin-template/" target="_blank" >
              <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M5.91064 20.5886C5.91064 19.7486 6.59064 19.0686 7.43064 19.0686C8.26064 19.0686 8.94064 19.7486 8.94064 20.5886C8.94064 21.4186 8.26064 22.0986 7.43064 22.0986C6.59064 22.0986 5.91064 21.4186 5.91064 20.5886ZM17.1606 20.5886C17.1606 19.7486 17.8406 19.0686 18.6806 19.0686C19.5106 19.0686 20.1906 19.7486 20.1906 20.5886C20.1906 21.4186 19.5106 22.0986 18.6806 22.0986C17.8406 22.0986 17.1606 21.4186 17.1606 20.5886Z" fill="currentColor"></path>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M20.1907 6.34909C20.8007 6.34909 21.2007 6.55909 21.6007 7.01909C22.0007 7.47909 22.0707 8.13909 21.9807 8.73809L21.0307 15.2981C20.8507 16.5591 19.7707 17.4881 18.5007 17.4881H7.59074C6.26074 17.4881 5.16074 16.4681 5.05074 15.1491L4.13074 4.24809L2.62074 3.98809C2.22074 3.91809 1.94074 3.52809 2.01074 3.12809C2.08074 2.71809 2.47074 2.44809 2.88074 2.50809L5.26574 2.86809C5.60574 2.92909 5.85574 3.20809 5.88574 3.54809L6.07574 5.78809C6.10574 6.10909 6.36574 6.34909 6.68574 6.34909H20.1907ZM14.1307 11.5481H16.9007C17.3207 11.5481 17.6507 11.2081 17.6507 10.7981C17.6507 10.3781 17.3207 10.0481 16.9007 10.0481H14.1307C13.7107 10.0481 13.3807 10.3781 13.3807 10.7981C13.3807 11.2081 13.7107 11.5481 14.1307 11.5481Z" fill="currentColor"></path>
              </svg>
          </a>
      </div> --}}
      <!-- Footer Section Start -->
      <footer class="footer">
          <div class="footer-body">
              <ul class="left-panel list-inline mb-0 p-0">
                  <li class="list-inline-item"><a href="#">Politeknik Negeri Subang</a></li>
              </ul>
              <div class="right-panel">
                  ©<script>document.write(new Date().getFullYear())</script> Designed SI UKT
              </div>
          </div>
      </footer>

      <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin akan logout ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="/logout" type="button" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Library Bundle Script -->
    <script src="{{ asset('template/html/assets/js/core/libs.min.js') }}"></script>
    
    <!-- External Library Bundle Script -->
    <script src="{{ asset('template/html/assets/js/core/external.min.js') }}"></script>
    
    <!-- Widgetchart Script -->
    <script src="{{ asset('template/html/assets/js/charts/widgetcharts.js') }}"></script>
    
    <!-- mapchart Script -->
    <script src="{{ asset('template/html/assets/js/charts/vectore-chart.js') }}"></script>
    <script src="{{ asset('template/html/assets/js/charts/dashboard.js') }}" ></script>
    
    <!-- fslightbox Script -->
    <script src="{{ asset('template/html/assets/js/plugins/fslightbox.js') }}"></script>
    
    <!-- Settings Script -->
    <script src="{{ asset('template/html/assets/js/plugins/setting.js') }}"></script>
    
    <!-- Slider-tab Script -->
    <script src="{{ asset('template/html/assets/js/plugins/slider-tabs.js') }}"></script>
    
    <!-- Form Wizard Script -->
    <script src="{{ asset('template/html/assets/js/plugins/form-wizard.js') }}"></script>
    
    <!-- AOS Animation Plugin-->
    <script src="{{ asset('template/html/assets/vendor/aos/dist/aos.js') }}"></script>
    
    <!-- App Script -->
    <script src="{{ asset('template/html/assets/js/hope-ui.js') }}" defer></script>

    <script>
        // umum
        function readImage(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#load_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }
        $('#preview_image').change(function() {
          readImage(this);
        })
      </script>
  
     <script>
        window.setTimeout(function() {
        $(".alert").fadeTo(1500, 0).slideUp(1500, function() {
           $(this).remove();
        });
        }, 6000);
     </script>

{{-- <script>
  $(function() {
      $("#tahun_angkatan").on("change", function() {
          var tahun_angkatan = $(this).val();
          if (tahun_angkatan != '') {
             console.log('masuk')
          }
      });
  });
</script> --}}
  </body>
</html>