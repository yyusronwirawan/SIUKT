<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SI UKT | {{$title}}</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('template/html/assets/images/favicon.ico') }}" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="{{ asset('template/html/assets/css/core/libs.min.css') }}" />
      
      
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
      
      <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
      </script>
  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
    
      <div class="wrapper">
      @yield('content')
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
  </body>
</html>