@extends('layout.main')

@section('content')

@php

function tanggalIndonesia($tanggal) {
  $namaBulan = array(
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  );

  $tanggalArr = explode('-', $tanggal);
  $tahun = $tanggalArr[0];
  $bulan = (int)$tanggalArr[1];
  $hari = (int)$tanggalArr[2];

  $tanggalIndo = $hari . ' ' . $namaBulan[$bulan - 1] . ' ' . $tahun;

  return $tanggalIndo;
}

function terjemahkanNominal($nominal) {
    // Daftar kata-kata untuk digit
    $digit = array(
        0 => 'Nol',
        1 => 'Satu',
        2 => 'Dua',
        3 => 'Tiga',
        4 => 'Empat',
        5 => 'Lima',
        6 => 'Enam',
        7 => 'Tujuh',
        8 => 'Delapan',
        9 => 'Sembilan'
    );

    // Daftar kata-kata untuk satuan
    $satuan = array(
        1 => 'Ribu',
        2 => 'Juta',
        3 => 'Miliar',
        4 => 'Triliun'
        // Tambahkan lebih banyak satuan jika diperlukan
    );

    // Mengecek apakah nominal negatif atau positif
    $isNegatif = false;
    if ($nominal < 0) {
        $isNegatif = true;
        $nominal = abs($nominal);
    }

    // Mengkonversi nominal menjadi kata-kata
    $hasil = '';

    if ($nominal == 0) {
        $hasil = $digit[0];
    } else {
        $grup = 0;
        while ($nominal > 0) {
            $ratusan = $nominal % 1000;
            $nominal = floor($nominal / 1000);

            if ($ratusan > 0) {
                $satu = '';
                $puluh = '';
                $ratus = '';

                // Mengkonversi ratusan
                $r = floor($ratusan / 100);
                if ($r > 0) {
                    $ratus = $digit[$r] . ' Ratus ';
                }

                // Mengkonversi puluhan dan satuan
                $p = $ratusan % 100;
                if ($p >= 20) {
                    $satu = $digit[floor($p / 10)] . ' Puluh ';
                    $p = $p % 10;
                }

                if ($p > 0) {
                    if ($p == 1 && $grup == 1) {
                        $satu = 'se';
                    } else {
                        $satu .= $digit[$p] . ' ';
                    }
                }

                // Menambahkan satuan grup
                $hasil = $ratus . $satu . $satuan[$grup] . ' ' . $hasil;
            }

            $grup++;
        }
    }

    // Menambahkan tanda negatif jika diperlukan
    if ($isNegatif) {
        $hasil = 'minus ' . $hasil;
    }

    return trim($hasil);
}

@endphp

<div class="row row-cols-1">
    <div class="overflow-hidden d-slider1 ">
       <ul  class="p-0 m-0 mb-2 swiper-wrapper list-inline">
        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                     <svg class="card-slie-arrow " width="24" height="24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Approve Penurunan</p>
                     <h4 class="counter">{{$totalApprovePenurunan}}</h4>
                  </div>
               </div>
            </div>
         </li>
         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                     <svg class="card-slie-arrow " width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Appreve Penangguhan</p>
                     <h4 class="counter">{{$totalApprovePenangguhan}}</h4>
                  </div>
               </div>
            </div>
         </li>
         <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
            <div class="card-body">
               <div class="progress-widget">
                  <div id="circle-progress-04" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                     <svg class="card-slie-arrow " width="24px" height="24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                     </svg>
                  </div>
                  <div class="progress-detail">
                     <p  class="mb-2">Total Kelompok UKT</p>
                     <h4 class="counter">{{$totalKelompokUKT}}</h4>
                  </div>
               </div>
            </div>
         </li>
       </ul>
       <div class="swiper-button swiper-button-next"></div>
       <div class="swiper-button swiper-button-prev"></div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
       <div class="card credit-card-widget" data-aos="fade-up" data-aos-delay="900">
          <div class="pb-4 border-0 card-header">
             <div class="p-4 border border-white rounded primary-gradient-card">
                <div class="d-flex justify-content-between align-items-center">
                   <div>
                      <h5 class="font-weight-bold">SI UKT </h5>
                      <P class="mb-0">Sistem Informasi Uang Kuliah Tunggal</P>  
                   </div>
                   <div class="master-card-content">
                      <svg class="master-card-1" width="60" height="60" viewBox="0 0 24 24">
                         <path fill="#ffffff" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                      </svg>
                      <svg class="master-card-2" width="60" height="60" viewBox="0 0 24 24">
                         <path fill="#ffffff" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                      </svg>
                   </div>
                </div>
                <div class="my-4">
                   <div class="card-number">
                      <span class="fs-5 me-2">Politeknik Negeri Subang</span>
                   </div>
                </div>
                <div class="mb-2 d-flex align-items-center justify-content-between">
                   <p class="mb-0">&nbsp;</p>
                   <p class="mb-0">&nbsp;</p>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                   <h6>&nbsp;</h6>
                   <h6 class="ms-5">{{tanggalIndonesia(date('Y-m-d'))}}</h6>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
@endsection