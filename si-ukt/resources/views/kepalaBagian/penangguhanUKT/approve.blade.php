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
                            {{-- <th>Status</th> --}}
                            <th style="min-width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($dataPenangguhanUKT as $item)
                        @if ($item->status_penangguhan == 'Proses di Kepala Bagian')
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->nama_mahasiswa}}</td>
                            <td>{{$item->nama_orang_tua}}</td>
                            <td>{{$item->tanggal_pengajuan}}</td>
                            {{-- <td>{{$item->status_penangguhan}}</td> --}}
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    @if($item->status_penangguhan === 'Proses di Kepala Bagian')
                                    <button type="button" class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#keputusan{{$item->id_penangguhan_ukt}}" data-placement="top" title="Approve" data-original-title="Approve">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M8.43994 12.0002L10.8139 14.3732L15.5599 9.6272" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
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
<div class="modal fade" id="keputusan{{$item->id_penangguhan_ukt}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Silahkan beri keputusan untuk pengajuan penangguhan UKT dari Mahasiswa yang bernama <strong>{{$item->nama_mahasiswa}}</strong>!</p>
            </div>
            <div class="modal-footer">
                <a href="/tidak-setuju-kepala-bagian/{{$item->id_penangguhan_ukt}}" class="btn btn-danger">Tidak Setuju</a>
                <a href="/setuju-kepala-bagian/{{$item->id_penangguhan_ukt}}" class="btn btn-success">Setuju</a>
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
                                Koordinator Ketatausahaan,<br>
                                <br><br><br>
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

@endsection