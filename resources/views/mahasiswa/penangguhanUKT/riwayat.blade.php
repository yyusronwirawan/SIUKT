@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-sm-12">
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
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->nama_mahasiswa}}</td>
                            <td>{{$item->nama_orang_tua}}</td>
                            <td>{{$item->tanggal_pengajuan}}</td>
                            <td>{{$item->status_penangguhan}}</td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    @if ($item->status_penangguhan === 'Belum Dikirim')
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#kirim{{$item->id_penangguhan_ukt}}" data-placement="top" title="Kirim Pengajuan" data-original-title="Delete">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M15.8325 8.17463L10.109 13.9592L3.59944 9.88767C2.66675 9.30414 2.86077 7.88744 3.91572 7.57893L19.3712 3.05277C20.3373 2.76963 21.2326 3.67283 20.9456 4.642L16.3731 20.0868C16.0598 21.1432 14.6512 21.332 14.0732 20.3953L10.106 13.9602" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
                                        </span>
                                    </button>
                                    <a class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="Edit Pengajuan" data-original-title="Edit" href="/edit-pengajuan-penangguhan-ukt/{{$item->id_penangguhan_ukt}}">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#hapus{{$item->id_penangguhan_ukt}}" data-placement="top" title="Hapus Pengajuan" data-original-title="Delete">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                            <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </button>
                                    @elseif($item->status_penangguhan === 'Proses di Bagian Keuangan')
                                    <button type="button" class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#jadwal{{$item->id_penangguhan_ukt}}" data-placement="top" title="Jadwal Wawancara" data-original-title="Jadwal Wawancara">
                                        <span class="btn-inner">
                                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M3.09277 9.40421H20.9167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.442 13.3097H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0045 13.3097H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.55818 13.3097H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.442 17.1962H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M12.0045 17.1962H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.55818 17.1962H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M16.0433 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M7.96515 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2383 3.5791H7.77096C4.83427 3.5791 3 5.21504 3 8.22213V17.2718C3 20.3261 4.83427 21.9999 7.77096 21.9999H16.229C19.175 21.9999 21 20.3545 21 17.3474V8.22213C21.0092 5.21504 19.1842 3.5791 16.2383 3.5791Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                                
                                        </span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#detail{{$item->id_penangguhan_ukt}}" data-placement="top" title="Detail Pengajuan" data-original-title="Delete">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#detail{{$item->id_penangguhan_ukt}}" data-placement="top" title="Detail Pengajuan" data-original-title="Delete">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($dataPenangguhanUKT as $item)
<div class="modal fade" id="hapus{{$item->id_penangguhan_ukt}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan hapus data pengajuan ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <a href="/hapus-pengajuan-penangguhan-ukt/{{$item->id_penangguhan_ukt}}" type="button" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($dataPenangguhanUKT as $item)
<div class="modal fade" id="kirim{{$item->id_penangguhan_ukt}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kirim Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan kirim data pengajuan ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <a href="/kirim-pengajuan-penangguhan-ukt/{{$item->id_penangguhan_ukt}}" type="button" class="btn btn-primary">Kirim</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($dataPenangguhanUKT as $item)
<div class="modal fade" id="jadwal{{$item->id_penangguhan_ukt}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jadwal Wawancara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            @if ($item->tanggal_wawancara === null)
                            <p>Anda belum menerima jadwal wawancara pengajuan penangguhan UKT. Silahkan ditunggu!</p> 
                            @else
                            <table>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>:</td>
                                    <td>{{$item->tanggal_wawancara}}</td>
                                </tr>
                                <tr>
                                    <th>Jam</th>
                                    <td>:</td>
                                    <td>{{$item->jam_wawancara}}</td>
                                </tr>
                                @if ($item->jenis_wawancara === 'Offline')
                                <tr>
                                    <th>Jenis Wawancara</th>
                                    <td>:</td>
                                    <td>{{$item->jenis_wawancara}}</td>
                                </tr>
                                <tr>
                                    <th>Tempat</th>
                                    <td>:</td>
                                    <td>Kampus</td>
                                </tr>
                                @else
                                <tr>
                                    <th>Jenis Wawancara</th>
                                    <td>:</td>
                                    <td>{{$item->jenis_wawancara}}</td>
                                </tr>
                                <tr>
                                    <th>Link Meeting (Zoom)</th>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                @endif
                            </table>
                            <a href="{{$item->link_wawancara}}" target="__blank">
                                <p>{{$item->link_wawancara}}</p>
                            </a>
                            @endif
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
                        <div class="table-responsive">
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
                            {{-- <table class="mt-4">
                                <tr>
                                    <td>
                                        Bermaksud untuk mengajukan permohonan penangguhan pembayaran Uang Kuliah Tunggal (UKT) Semester <strong>{{$item->semester}}</strong> sebesar <strong>Rp. {{$user->nominal}}</strong> dan Denda Keterlambatan 5% dari UKT sebesar <strong>Rp. {{$user->nominal * 5 / 100}}</strong>. Permohonan penangguhan UKT tersebut dikarenakan <strong>{{$item->alasan}}</strong>. Pembayaran UKT akan dibayar pada:
                                    </td>
                                </tr>
                            </table> --}}
                            <p class="mt-4">
                                Bermaksud untuk mengajukan permohonan penangguhan pembayaran Uang Kuliah Tunggal (UKT) Semester <strong>{{$item->semester}}</strong> sebesar <strong>Rp. {{$user->nominal}}</strong> dan Denda Keterlambatan 5% dari UKT sebesar <strong>Rp. {{$user->nominal * 5 / 100}}</strong>. Permohonan penangguhan UKT tersebut dikarenakan <strong>{{$item->alasan}}</strong>. Pembayaran UKT akan dibayar pada:
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
                            {{-- <table class="mt-4">
                                <tr>
                                    <td style="font-weight: bold;">
                                        Jika saya tidak memenuhi kesanggupan dalam pembayaran UKT tersebut, maka saya bersedia menerima sanksi sesuai dengan peraturan yang berlaku di Politeknik Negeri Subang.
                                    </td>
                                </tr>
                            </table> --}}
                            <p class="mt-4" style="font-weight: bold;">
                                Jika saya tidak memenuhi kesanggupan dalam pembayaran UKT tersebut, maka saya bersedia menerima sanksi sesuai dengan peraturan yang berlaku di Politeknik Negeri Subang.
                            </p>
                            {{-- <table>
                                <tr>
                                    <td style="font-weight: bold;">
                                        Demikian surat permohonan ini kami buat. Atas perhatian Bapak/Ibu, kami ucapkan terima kasih.    
                                    </td>
                                </tr>
                            </table> --}}
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection