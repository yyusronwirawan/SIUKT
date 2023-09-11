@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$subTitle}}</h4>
                </div>
                <div class="header-title">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cetak-semua">Cetak Semua</button>
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
            <div class="card-body px-0">
                <div class="table-responsive">
                <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                    <thead>
                        <tr class="ligth">
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nama Orang Tua</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th style="min-width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($dataPenangguhanUKT as $item)
                        @if ($item->status_penangguhan !== 'Belum Dikirim')
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->nama_mahasiswa}}</td>
                            <td>{{$item->nama_orang_tua}}</td>
                            <td>{{$item->tanggal_pengajuan}}</td>
                            <td>{{$item->status_penangguhan}}</td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <a href="/cetak-satuan-penangguhan/{{$item->id_penangguhan_ukt}}" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="Cetak" data-original-title="Cetak">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M12.1221 15.436L12.1221 3.39502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M15.0381 12.5083L12.1221 15.4363L9.20609 12.5083" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.7551 8.12793H17.6881C19.7231 8.12793 21.3721 9.77693 21.3721 11.8129V16.6969C21.3721 18.7269 19.7271 20.3719 17.6971 20.3719L6.55707 20.3719C4.52207 20.3719 2.87207 18.7219 2.87207 16.6869V11.8019C2.87207 9.77293 4.51807 8.12793 6.54707 8.12793L7.48907 8.12793" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                             
                                        </span>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#detail{{$item->id_penangguhan_ukt}}" data-placement="top" title="Detail Pengajuan" data-original-title="Detail Pengajuan">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($dataPenangguhanUKT as $item)
<div class="modal fade" id="detail{{$item->id_penangguhan_ukt}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table>
                            <tr>
                                <th style="font-weight: bold;">Kepada</th>
                            </tr>
                            <tr>
                                <th style="font-weight: bold;">Wakil Direktur II Politeknik Negeri Subang</th>
                            </tr>
                            <tr>
                                <th style="font-weight: bold;">Di</th>
                            </tr>
                            <tr>
                                <th style="font-weight: bold;">Tempat</th>
                            </tr>
                        </table>
                        <table class="mt-4">
                            <tr>
                                <td>Dengan hormat,</td>
                            </tr>
                            <tr>
                                <td>Yang bertanda tangan di bawah ini:</td>
                            </tr>
                        </table>
                        <table class="mt-3">
                            <tr>
                                <td width="130px">Nama</td>
                                <td>:</td>
                                <td>{{$item->nama_orang_tua}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{$item->alamat_orang_tua}}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td>{{$item->nomor_telepon_orang_tua}}</td>
                            </tr>
                        </table>
                        <table class="mt-4">
                            <tr>
                                <td colspan="3">Orang tua/Wali dari Mahasiswa Politeknik Negeri Subang:</td>
                            </tr>
                            <tr>
                                <td width="130px">Nama</td>
                                <td>:</td>
                                <td>{{$item->nama_mahasiswa}}</td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td>:</td>
                                <td>{{$item->nim}}</td>
                            </tr>
                            <tr>
                                <td>Program Studi</td>
                                <td>:</td>
                                <td>{{$item->prodi}}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td>{{$item->nomor_telepon}}</td>
                            </tr>
                        </table>
                        <p class="mt-4">
                            Bermaksud untuk mengajukan permohonan penangguhan pembayaran Uang Kuliah Tunggal (UKT) Semester <strong>{{$item->semester}}</strong> sebesar <strong>Rp. {{$item->nominal}}</strong> dan Denda Keterlambatan 5% dari UKT sebesar <strong>Rp. {{$item->nominal * 5 / 100}}</strong>. Permohonan penangguhan UKT tersebut dikarenakan <strong>{{$item->alasan}}</strong>. Pembayaran UKT akan dibayar pada:
                        </p>
                        <table>
                            <tr>
                                <td width="20px">1.</td>
                                <td width="160px">Angsuran Pertama</td>
                                <td width="140px">Rp. {{$item->angsuran_pertama}}</td>
                                <td width="120px">Tanggal {{date('d F Y', strtotime($item->tanggal_angsuran_pertama))}}</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Angsuran Kedua</td>
                                <td>Rp. {{$item->angsuran_kedua}}</td>
                                <td>Tanggal {{date('d F Y', strtotime($item->tanggal_angsuran_kedua))}}</td>
                            </tr>
                        </table>
                        <p class="mt-4" style="font-weight: bold;">
                            Jika saya tidak memenuhi kesanggupan dalam pembayaran UKT tersebut, maka saya bersedia menerima sanksi sesuai dengan peraturan yang berlaku di Politeknik Negeri Subang.
                        </p>
                        <p style="font-weight: bold;">
                            Demikian surat permohonan ini kami buat. Atas perhatian Bapak/Ibu, kami ucapkan terima kasih.    
                        </p>
                        <br>
                        <div class="row">
                            <div class="col-md-12" style="text-align: right;">
                                Subang, {{$item->tanggal_pengajuan}}
                            </div>
                            <div class="col-md-6">
                                Menyetujui,<br>
                                Koordinator Ketatausahaan,
                                <br>
                                @if ($item->kabag && $item->status_penangguhan == 'Setuju')
                                    <br>
                                    <img src="{{ asset('gambar/'.$setting->tanda_tangan_kabag) }}" alt="Tanda Tangan Kepala Bagian" id="load_image2" class="theme-color-default-img profile-pic rounded" style="margin-left: 20px;" width="47%">
                                    <br>
                                @else 
                                    <br><br>
                                @endif
                                <br>
                                Zaenal Abidin, S.Pdl., M.Si <br>
                                NIP 196704221996011000
                            </div>
                            <div class="col-md-6 text-center">
                                <br>
                                Orang tua/Wali Mahasiswa <br>
                                <br>
                                Materai 10.000
                                <br><br>
                                {{$item->nama_orang_tua}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="cetak-semua" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rentang Waktu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/cetak-semua-penangguhan" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="tanggal_mulai">Mulai Dari Tanggal</label>
                      <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai" id="tanggal_mulai" placeholder="Masukkan Tanggal Mulai" required>
                    </div>
                    <div class="form-group">
                      <label for="tanggal_akhir">Sampai Dengan</label>
                      <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror" name="tanggal_akhir" id="tanggal_akhir" placeholder="Masukkan Tanggal Akhir" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Cetak</button>
            </div>
        </div>
    </div>
</div>
@endsection