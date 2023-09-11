@extends('layout.main')

@section('content')

@php
    date_default_timezone_set('Asia/Jakarta');

    $currentDate = date('Y-m-d'); 
    $tambahHari = '+'.$setting->batas_tanggal_angsuran.' days';
    $batasTanggalAngsuran  = date('d F Y', strtotime($tambahHari, strtotime($currentDate)));

    $denda = $user->nominal * $setting->persen_denda / 100;
    $totalNominal = $user->nominal + $denda;
    $angsuranPertama = $totalNominal * $setting->persen_angsuran_pertama / 100;
    $angsuranKedua = $totalNominal - $angsuranPertama;

@endphp

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            @if ($user->id_kelompok_ukt === null )
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda belum mempunyai kelompok UKT. Silahkan melakukan penentuan UKT terlebih dahulu!</h4>
                </div>
            </div>
            @elseif ($user->kelompok_ukt < $setting->batas_ukt_penangguhan )
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak dapat melakukan pengajuan penangguhan UKT, karena Anda termasuk kelompok UKT {{$user->kelompok_ukt}}!</h4>
                </div>
            </div>
            @elseif ($user->status_pengajuan === 'Penangguhan' && $form !== 'Edit')
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak dapat mengisi form penangguhan UKT, karena Anda sedang melakukan proses penangguhan UKT!</h4>
                </div>
            </div>
            @elseif ($user->status_pengajuan === 'Penurunan')
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak dapat mengisi form penangguhan UKT, karena Anda sedang melakukan proses penurunan UKT!</h4>
                </div>
            </div>
            @elseif ($penentuan!== null && $penentuan->status_laporan === 'Belum')
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak dapat mengisi form penangguhan UKT, karena proses penentuan UKT masih dilakukan!</h4>
                </div>
            </div>
            @elseif ($user->status_pengajuan === 'Tidak' || $form === 'Edit')
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$subTitle}}</h4>
                </div>
            </div>
            <div class="card-body px-4" style="margin-bottom: -50px;">
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
            <div class="card-body">
                <div class="new-user-info">
                    <form action="@if($form === 'Tambah') /pengajuan-penangguhan-ukt @elseif($form === 'Edit') /edit-pengajuan-penangguhan-ukt/{{$detail->id_penangguhan_ukt}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nama_mahasiswa">Nama Mahasiswa</label>
                            <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ $user->nama_mahasiswa }}" readonly placeholder="Masukkan Nama Lengkap ">
                            @error('nama_mahasiswa')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nim">NIM</label>
                            <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ $user->nim }}" readonly placeholder="Masukkan NIM ">
                            @error('nim')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="program_studi">Program Studi</label>
                            <input type="text" class="form-control @error('program_studi') is-invalid @enderror" id="program_studi" name="program_studi" value="{{ $user->prodi }}" readonly placeholder="Masukkan Program Studi ">
                            @error('program_studi')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nomor_telepon">No. HP</label>
                            <input type="number" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ $user->nomor_telepon }}" readonly placeholder="Masukkan No. HP ">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"><strong>Orang Tua/Wali dari Mahasiswa Politeknik Negeri Subang:</strong></label>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nama_orang_tua">Nama Orang Tua/Wali <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_orang_tua') is-invalid @enderror" id="nama_orang_tua" name="nama_orang_tua" value="@if($form === 'Tambah'){{ old('nama_orang_tua') }}@elseif($form === 'Edit'){{$detail->nama_orang_tua}}@endif" autofocus placeholder="Masukkan Nama Orang Tua/Wali">
                            @error('nama_orang_tua')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="alamat_orang_tua">Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('alamat_orang_tua') is-invalid @enderror" id="alamat_orang_tua" name="alamat_orang_tua" value="@if($form === 'Tambah'){{ old('alamat_orang_tua') }}@elseif($form === 'Edit'){{$detail->alamat_orang_tua}}@endif" placeholder="Masukkan Alamat">
                            @error('alamat_orang_tua')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nomor_telepon_orang_tua">No. HP <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('nomor_telepon_orang_tua') is-invalid @enderror" id="nomor_telepon_orang_tua" name="nomor_telepon_orang_tua" value="@if($form === 'Tambah'){{ old('nomor_telepon_orang_tua') }}@elseif($form === 'Edit'){{$detail->nomor_telepon_orang_tua}}@endif" placeholder="Masukkan No. HP">
                            @error('nomor_telepon_orang_tua')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"><strong>Data Tambahan:</strong></label>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nominal_ukt">Nominal UKT</label>
                            <input type="text" class="form-control @error('nominal_ukt') is-invalid @enderror" id="nominal_ukt" name="nominal_ukt" value="{{ $user->nominal }}" readonly placeholder="Masukkan Nominal UKT ">
                            @error('nominal_ukt')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="denda">Nominal Denda ({{$setting->persen_denda}}% dari Nominal UKT)</label>
                            <input type="text" class="form-control @error('denda') is-invalid @enderror" id="denda" name="denda" value="{{ $user->nominal * $setting->persen_denda / 100 }}" readonly placeholder="Masukkan Nominal Denda ">
                            @error('denda')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="semester">Semester <span class="text-danger">*</span></label>
                            <select name="semester" id="semester" class="selectpicker form-control @error('semester') is-invalid @enderror" data-style="py-0">
                                @if ($form === 'Tambah')
                                    <option>-- Pilih --</option>
                                @elseif($form === 'Edit')
                                    <option value="{{$detail->semester}}">{{$detail->semester}}</option>
                                @endif
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="alasan">Alasan Penangguhan UKT <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" value="@if($form === 'Tambah'){{ old('alasan') }}@elseif($form === 'Edit'){{$detail->alasan}}@endif" placeholder="Masukkan Alasan Penangguhan UKT ">
                            @error('alasan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="angsuran_pertama">Angsuran Pertama (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('angsuran_pertama') is-invalid @enderror" id="angsuran_pertama" name="angsuran_pertama" value="@if($form === 'Tambah'){{ $angsuranPertama }}@elseif($form === 'Edit'){{$detail->angsuran_pertama}}@endif" readonly placeholder="Masukkan Angsuran Pertama ">
                            @error('angsuran_pertama')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div><div class="form-group col-md-6">
                            <label class="form-label" for="angsuran_kedua">Angsuran Kedua (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('angsuran_kedua') is-invalid @enderror" id="angsuran_kedua" name="angsuran_kedua" value="@if($form === 'Tambah'){{ $angsuranKedua }}@elseif($form === 'Edit'){{$detail->angsuran_kedua}}@endif" readonly placeholder="Masukkan Angsuran Kedua ">
                            @error('angsuran_kedua')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-label"><strong>Batas tanggal angsuran {{ $batasTanggalAngsuran }}</strong></label>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tanggal_angsuran_pertama">Tanggal Angsuran Pertama <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_angsuran_pertama') is-invalid @enderror" id="tanggal_angsuran_pertama" name="tanggal_angsuran_pertama" value="@if($form === 'Tambah'){{ old('tanggal_angsuran_pertama') }}@elseif($form === 'Edit'){{$detail->tanggal_angsuran_pertama}}@endif" placeholder="Masukkan Tanggal Angsuran Pertama ">
                            @error('tanggal_angsuran_pertama')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="tanggal_angsuran_kedua">Tanggal Angsuran Kedua <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_angsuran_kedua') is-invalid @enderror" id="tanggal_angsuran_kedua" name="tanggal_angsuran_kedua" value="@if($form === 'Tambah'){{ old('tanggal_angsuran_kedua') }}@elseif($form === 'Edit'){{$detail->tanggal_angsuran_kedua}}@endif" placeholder="Masukkan Tanggal Angsuran Kedua ">
                            @error('tanggal_angsuran_kedua')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="jenis_wawancara">Jenis Wawancara <span class="text-danger">*</span></label>
                            <select name="jenis_wawancara" id="jenis_wawancara" class="selectpicker form-control @error('jenis_wawancara') is-invalid @enderror" required data-style="py-0">
                                @if ($form === 'Tambah')
                                    <option>-- Pilih --</option>
                                @elseif($form === 'Edit')
                                    <option value="{{$detail->jenis_wawancara}}">{{$detail->jenis_wawancara}}</option>
                                @endif
                                <option value="Online">Online</option>
                                <option value="Offline">Offline</option>
                            </select>
                            @error('jenis_wawancara')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <a href="/riwayat-pengajuan-penangguhan-ukt" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection