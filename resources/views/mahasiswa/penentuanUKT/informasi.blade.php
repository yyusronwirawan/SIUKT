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
                        <div class="table-responsive p-3">
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
                                    <th>Uang Kuliah Tunggal (UKT)</th>
                                    <td>:</td>
                                    <td>
                                        @if ($detail->status_penentuan == 'Proses')
                                            <strong>UKT Anda belum ada.</strong>
                                        @elseif($detail->status_penentuan == 'Tidak Setuju')    
                                            <strong>Data penentuan UKT Anda tidak disetujui.</strong>
                                        @elseif($detail->status_penentuan == 'Belum Dikirim')    
                                            <strong>UKT Anda belum ada.!</strong>  
                                        @else
                                            {{$detail->kelompok_ukt}} / {{'Rp '.number_format($detail->nominal, 0, ',', '.')}}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header mx-2">
                @if ($detail->status_penentuan == 'Tidak Setuju')
                    <p><strong>Keterangan:</strong></p>
                    <p>Data penentuan UKT Anda <strong>Tidak Disetujui</strong>. Silahkan klik tombol ulangi dan isi sesuai dengan data yang dimiliki!.</p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ulangi" class="btn btn-primary">Ulangi</button>
                @elseif($detail->status_penentuan == 'Proses')
                    <p><strong>Keterangan:</strong></p>
                    <p>Data penentuan UKT Anda sedang dilakukan pengecekan berkas terlebih dahulu. Silahkan ditunggu!</p>
                @elseif($detail->status_penentuan == 'Belum Dikirim')
                    <p><strong>Keterangan:</strong></p>
                    <p>Data penentuan UKT Anda <strong>Belum Dikirim</strong>. Silahkan cek data penentaun UKT dengan berkas yang disimpan! Jika sudah sesuai, klik tombol kirim!.</p>
                    <a href="/edit-penentuan-ukt/{{$detail->id_penentuan_ukt}}" class="btn btn-success">Edit</a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#kirim" class="btn btn-primary">Kirim</button>
                @endif
            </div>
            <div class="card-body mx-2">
                <p><strong>Data penentuan UKT yang diinput:</strong></p>
                @php
                    $label_kriteria = explode(";", $detail->label_kriteria);
                    $value_kriteria = explode(";", $detail->value_kriteria);
                @endphp
                <div class="table-responsive">
                    <table class="table table-striped" role="grid">
                        <thead>
                            <tr>
                                @foreach ($label_kriteria as $item)
                                    <th>{{$item}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($value_kriteria as $item)
                                    <td>{{$item}}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
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
                        @if ($detail->slip_gaji != null)
                        <tr>
                            <td>Slip Gaji / Keterangan Penghasilan orang Tua</td>
                            <td>
                                @if ($detail->slip_gaji)
                                    Terlampir
                                @else
                                    Tidak Terlampir
                                @endif
                            </td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#slipGaji" data-placement="top" title="Lihat Dokumen" data-original-title="Lihat Dokumen">
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
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#strukListrik" data-placement="top" title="Lihat Dokumen" data-original-title="Lihat Dokumen">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if ($detail->struk_air != null)
                        <tr>
                            <td>Struk Air</td>
                            <td>
                                @if ($detail->struk_air)
                                    Terlampir
                                @else
                                    Tidak Terlampir
                                @endif
                            </td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#strukAir" data-placement="top" title="Lihat Dokumen" data-original-title="Lihat Dokumen">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" stroke="currentColor"></path>                                    <circle cx="12" cy="12" r="5" stroke="currentColor"></circle>                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    <mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6">                                    <circle cx="12" cy="12" r="3" fill="#130F26"></circle>                                    </mask>                                    <circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white"></circle>                                    </svg>                                
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @if ($detail->kk != null)
                        <tr>
                            <td>Kartu Keluarga</td>
                            <td>
                                @if ($detail->kk)
                                    Terlampir
                                @else
                                    Tidak Terlampir
                                @endif
                            </td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#kk" data-placement="top" title="Lihat Dokumen" data-original-title="Lihat Dokumen">
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

<div class="modal fade" id="slipGaji" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Slip Gaji / Keterangan Penghasilan Orang Tua</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset('dokumen_penentuan_ukt/slip_gaji/'.$detail->slip_gaji) }}" width="100%" height="400px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="strukListrik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Struk Listrik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset('dokumen_penentuan_ukt/rekening_listrik/'.$detail->struk_listrik) }}" width="100%" height="400px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="strukAir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Struk Air</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset('dokumen_penentuan_ukt/rekening_air/'.$detail->struk_air) }}" width="100%" height="400px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kartu Keluarga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe src="{{ asset('dokumen_penentuan_ukt/kk/'.$detail->kk) }}" width="100%" height="400px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ulangi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ulangi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan mengulang proses penentuan UKT?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <a href="/ulangi-penentuan-ukt/{{$detail->id_penentuan_ukt}}" type="button" class="btn btn-primary">Ulangi</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kirim" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kirim</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan mengirim data penentuan UKT ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <a href="/kirim-penentuan-ukt/{{$detail->id_penentuan_ukt}}" type="button" class="btn btn-primary">Kirim</a>
            </div>
        </div>
    </div>
</div>

@endsection