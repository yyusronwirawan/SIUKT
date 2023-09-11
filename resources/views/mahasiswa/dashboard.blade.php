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
                      <p  class="mb-2">Penentuan UKT</p>
                      <h4 class="counter">@if($user->id_kelompok_ukt)Sudah @else Belum @endif</h4>
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
                      <p  class="mb-2">Penurunan UKT</p>
                      <h4 class="counter">@if($detailPenurunanUKT) Sudah @else Belum @endif</h4>
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
                      <p  class="mb-2">Penangguhan UKT</p>
                      <h4 class="counter">@if($user->status_pengajuan === 'Penangguhan') Sedang @else Tidak @endif</h4>
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
          <div class="card-body">
             <div class="flex-wrap mb-4 d-flex align-itmes-center justify-content-between">
                <div class="d-flex align-itmes-center me-0 me-md-4">
                   <div>
                      <div class="p-3 mb-2 rounded bg-soft-primary">
                         <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" clip-rule="evenodd" d="M16.9303 7C16.9621 6.92913 16.977 6.85189 16.9739 6.77432H17C16.8882 4.10591 14.6849 2 12.0049 2C9.325 2 7.12172 4.10591 7.00989 6.77432C6.9967 6.84898 6.9967 6.92535 7.00989 7H6.93171C5.65022 7 4.28034 7.84597 3.88264 10.1201L3.1049 16.3147C2.46858 20.8629 4.81062 22 7.86853 22H16.1585C19.2075 22 21.4789 20.3535 20.9133 16.3147L20.1444 10.1201C19.676 7.90964 18.3503 7 17.0865 7H16.9303ZM15.4932 7C15.4654 6.92794 15.4506 6.85153 15.4497 6.77432C15.4497 4.85682 13.8899 3.30238 11.9657 3.30238C10.0416 3.30238 8.48184 4.85682 8.48184 6.77432C8.49502 6.84898 8.49502 6.92535 8.48184 7H15.4932ZM9.097 12.1486C8.60889 12.1486 8.21321 11.7413 8.21321 11.2389C8.21321 10.7366 8.60889 10.3293 9.097 10.3293C9.5851 10.3293 9.98079 10.7366 9.98079 11.2389C9.98079 11.7413 9.5851 12.1486 9.097 12.1486ZM14.002 11.2389C14.002 11.7413 14.3977 12.1486 14.8858 12.1486C15.3739 12.1486 15.7696 11.7413 15.7696 11.2389C15.7696 10.7366 15.3739 10.3293 14.8858 10.3293C14.3977 10.3293 14.002 10.7366 14.002 11.2389Z" fill="currentColor"></path>                                            
                         </svg>
                      </div>
                   </div>
                   <div class="ms-3">
                      <h5>Uang Kuliah Tunggal</h5>
                      <small class="mb-0">Program Studi {{$user->prodi}}</small>
                   </div>
                </div>
             </div>
             <div class="mb-4">
                <div class="flex-wrap d-flex justify-content-between">
                   <h2 class="mb-2">
                    @if ($user->id_kelompok_ukt)
                        UKT {{$user->kelompok_ukt}} / {{'Rp '.number_format($user->nominal, 0, ',', '.')}}
                    @else
                        Belum Ada Kelompok Uang Kuliah Tunggal
                    @endif
                   </h2>
                   <div>
                      <span class="badge bg-success rounded-pill"></span>
                   </div>
                </div>
                <p class="text-info">
                    @if ($user->id_kelompok_ukt)
                        Uang Kuliah Anda sebesar <strong>{{terjemahkanNominal($user->nominal)}} Rupiah</strong>
                    @else
                        Ayo segera melakukan proses penentuan UKT
                    @endif
                </p>
             </div>
             <div class="grid-cols-2 d-grid gap-card">
                <a href="/penentuan-ukt" class="p-2 btn btn-primary text-uppercase">Lihat</a>
             </div>
          </div>
       </div>
    </div>
</div>

@endsection