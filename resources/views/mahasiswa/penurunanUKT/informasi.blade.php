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
            <div class="card-header mx-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <th>Nama Mahassiwa</th>
                                    <td>:</td>
                                    <td>{{$detail->nama_mahasiswa}}</td>
                                </tr>
                                <tr>
                                    <th>NIM</th>
                                    <td>:</td>
                                    <td>{{$detail->nim}}</td>
                                </tr>
                                <tr>
                                    <th>Program Studi</th>
                                    <td>:</td>
                                    <td>{{$detail->prodi}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{$detail->email}}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Telepon</th>
                                    <td>:</td>
                                    <td>{{$detail->nomor_telepon}}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Angkatan</th>
                                    <td>:</td>
                                    <td>{{$detail->tahun_angkatan}}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Rumah Lengkap</th>
                                    <td>:</td>
                                    <td>{{$detail->alamat_rumah}}</td>
                                </tr>
                                <tr>
                                    <th>Semester</th>
                                    <td>:</td>
                                    <td>{{$detail->semester}}</td>
                                </tr>
                                <tr>
                                    <th>Uang Kuliah Tunggal (UKT)</th>
                                    <td>:</td>
                                    <td>{{$detail->kelompok_ukt}} / {{'Rp '.number_format($detail->nominal, 0, ',', '.')}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header mx-2">
                @if ($detail->status_penurunan == 'Belum Dikirim')
                    <p><strong>Keterangan:</strong></p>
                    <p>Pengajuan penurunan UKT Anda belum dikirim, silahkan klik tombol kirim jika Anda sudah yakin dengan data yang telah diinput.</p>
                    <a href="/edit-pengajuan-penurunan-ukt/{{$detail->id_penurunan_ukt}}" class="btn btn-success">Edit</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kirim">Kirim</button>
                @elseif($detail->status_penurunan == 'Proses di Bagian Keuangan')
                    <p><strong>Keterangan:</strong></p>
                    @if ($detail->tanggal_survey)
                    <p>Data pengajuan penurunan UKT Anda sudah dilakukan pengecekan oleh Bagian Keuangan. Silahkan cek jadwal survey!</p>
                        @else
                    <p>Data pengajuan penurunan UKT Anda sedang dilakukan pengecekan oleh Bagian Keuangan. Jika proses pengecekan data lolos maka akan diberi jadwal survey. Silahkan cek jadwal survey secara berkala!</p>
                    @endif
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#jadwalSurvey">Jadwal Survey</button>
                @elseif($detail->status_penurunan == 'Proses di Kepala Bagian')
                    <p><strong>Keterangan:</strong></p>
                    <p>Data pengajuan penurunan UKT Anda sedang dilakukan pengecekan oleh Kabag Umum & Akademik. Silahkan ditunggu dan cek informasinya secara berkala!</p>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#jadwalSurvey">Jadwal Survey</button>
                @elseif($detail->status_penurunan == 'Setuju')
                    <p><strong>Keterangan:</strong></p>
                    <p>Pengajuan penurunan UKT <strong>Disetujui</strong>.</p>
                @elseif($detail->status_penurunan == 'Tidak Setuju')
                    @if ($detail->kabag === null)
                        <p><strong>Keterangan:</strong></p>
                        <p>Pengajuan penurunan UKT <strong>Tidak Disetujui</strong>. Karena data pengajuan penurunan UKT tidak sesuai dengan ketentuan.</p>
                    @else 
                        <p><strong>Keterangan:</strong></p>
                        <p>Pengajuan penurunan UKT <strong>Tidak Disetujui</strong>. Karena data pengajuan penurunan UKT dan hasil survey tidak sesuai dengan ketentuan.</p>
                    @endif
                @endif
            </div>
            <div class="card-body px-2">
                <div class="table-responsive">
                <table class="table table-striped" role="grid" >
                    <thead>
                        <tr class="ligth">
                            <th>Dokumen</th>
                            <th>Status</th>
                            <th style="min-width: 100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($detail->surat_pengajuan != null)
                        <tr>
                            <td>Surat Pengajuan</td>
                            <td>
                                @if ($detail->surat_pengajuan)
                                    Terlampir
                                @else
                                    Tidak Terlampir
                                @endif
                            </td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#suratPengajuan" data-placement="top" title="Lihat Dokumen" data-original-title="Lihat Dokumen">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>  
                        @endif
                        @if ($detail->sktm != null)
                        <tr>
                            <td>SKTM (Surat Keterangan Tidak Mampu)</td>
                            <td>
                                @if ($detail->sktm)
                                    Terlampir
                                @else
                                    Tidak Terlampir
                                @endif
                            </td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#sktm" data-placement="top" title="Lihat Dokumen" data-original-title="Lihat Dokumen">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if ($detail->khs != null)
                        <tr>
                            <td>KHS (Semester Yang Sedang Berjalan)</td>
                            <td>
                                @if ($detail->khs)
                                    Terlampir
                                @else
                                    Tidak Terlampir
                                @endif
                            </td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#khs" data-placement="top" title="Lihat Dokumen" data-original-title="Lihat Dokumen">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if ($detail->struk_listrik != null)
                        <tr>
                            <td>Struk Listrik</td>
                            <td>
                                @if ($detail->struk_listrik)
                                    Terlampir
                                @else
                                    Tidak Terlampir
                                @endif
                            </td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#struk_listrik" data-placement="top" title="Lihat Dokumen" data-original-title="Lihat Dokumen">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr> 
                        @endif
                        @if ($detail->foto_rumah != null)
                        <tr>
                            <td>Foto Rumah</td>
                            <td>
                                @if ($detail->foto_rumah)
                                    Terlampir
                                @else
                                    Tidak Terlampir
                                @endif
                            </td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#foto_rumah" data-placement="top" title="Lihat Dokumen" data-original-title="Lihat Dokumen">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if ($detail->slip_gaji != null)
                        <tr>
                            <td>Slip Gaji / Keterangan Penghasilan Orang Tua</td>
                            <td>
                                @if ($detail->slip_gaji)
                                    Terlampir
                                @else
                                    Tidak Terlampir
                                @endif
                            </td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#slip_gaji" data-placement="top" title="Lihat Dokumen" data-original-title="Lihat Dokumen">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr> 
                        @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="suratPengajuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Surat Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset('dokumen_penurunan_ukt/surat_pengajuan/'.$detail->surat_pengajuan) }}" width="100%" height="400px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sktm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SKTM (Surat Keterangan Tidak Mampu)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset('dokumen_penurunan_ukt/sktm/'.$detail->sktm) }}" width="100%" height="400px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="khs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">KHS (Semester Yang Sedang Berjalan)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset('dokumen_penurunan_ukt/khs/'.$detail->khs) }}" width="100%" height="400px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="struk_listrik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Struk Listrik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset('dokumen_penurunan_ukt/struk_listrik/'.$detail->struk_listrik) }}" width="100%" height="400px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="slip_gaji" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Slip Gaji / Keterangan Penghasilan Orang Tua</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset('dokumen_penurunan_ukt/slip_gaji/'.$detail->slip_gaji) }}" width="100%" height="400px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="foto_rumah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto Rumah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset('dokumen_penurunan_ukt/foto_rumah/'.$detail->foto_rumah) }}" width="100%" height="400px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kirim" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/kirim-pengajuan-penurunan-ukt/{{$detail->id_penurunan_ukt}}" type="button" class="btn btn-primary">Kirim</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="jadwalSurvey" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jadwal Survey</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        @if ($detail->tanggal_survey === null)
                        <p>Anda belum menerima jadwal survey pengajuan penurunan UKT. Silahkan ditunggu!</p> 
                        @else
                        <table>
                            <tr>
                                <th>Tanggal</th>
                                <td>:</td>
                                <td>{{date('d F Y', strtotime($detail->tanggal_survey))}}</td>
                            </tr>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

@endsection