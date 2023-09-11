@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
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
            @if ($user->id_kelompok_ukt !== null && $dataPenentuanUKT!== null && $dataPenentuanUKT->status_laporan === 'Sudah' )
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak bisa mengakses form penentuan UKT, karena Anda sudah memiliki kelompok UKT. Kelompok UKT Anda yaitu {{$user->kelompok_ukt}} / {{'Rp '.number_format($user->nominal, 0, ',', '.')}}.</h4>
                    <a href="/download-pengumuman-ukt/{{$dataPenentuanUKT->tahun_angkatan}}" class="btn btn-primary mt-3">Download Pengumuman UKT</a>
                </div>
            </div>
            @elseif ($dataPenentuanUKT !== null && $dataPenentuanUKT->status_penentuan === 'Proses' )
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Proses penentuan UKT yang Anda lakukan sedang diproses. Silahkan ditunggu!</h4>
                    <a href="/informasi-penentuan-ukt/{{$dataPenentuanUKT->id_penentuan_ukt}}" class="btn btn-primary mt-3">Informasi Penentuan UKT</a>
                </div>
            </div>
            @elseif ($dataPenentuanUKT !== null && $dataPenentuanUKT->status_penentuan === 'Tidak Setuju' )
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Proses penentuan UKT yang Anda lakukan tidak disetujui, karena data yang Anda input tidak sesuai dengan berkas. Silahkan cek!.</h4>
                    <a href="/informasi-penentuan-ukt/{{$dataPenentuanUKT->id_penentuan_ukt}}" class="btn btn-primary mt-3">Informasi Penentuan UKT</a>
                </div>
            </div>
            @elseif ($dataPenentuanUKT !== null && $dataPenentuanUKT->status_penentuan === 'Belum Dikirim' && $form !== 'Edit')
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Proses penentuan UKT yang Anda lakukan datanya belum dikirim. Silahkan dicek dan segera kirim!</h4>
                    <a href="/informasi-penentuan-ukt/{{$dataPenentuanUKT->id_penentuan_ukt}}" class="btn btn-primary mt-3">Informasi Penentuan UKT</a>
                </div>
            </div>
            @elseif ($user->id_kelompok_ukt !== null && $dataPenentuanUKT!== null && $dataPenentuanUKT->status_laporan === 'Belum')
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak bisa mengakses form penentuan UKT, karena proses penentuan UKT masih sedang dilakukan. Silahkan ditunggu!</h4>
                </div>
            </div>
            @else
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$subTitle}}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <form action="@if($form === 'Tambah') /penentuan-ukt @elseif($form === 'Edit') /edit-penentuan-ukt/{{$detail->id_penentuan_ukt}} @endif" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @if ($form === 'Edit')
                        <div class="form-group col-md-12 mt-4">
                            <label class="form-label"><strong>Silahkan isi ulang dan pastikan data yang akan disimpan sudah sesuai!</strong></label>
                        </div>
                        @endif
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
                        <div class="form-group col-md-12 mt-4">
                            <label class="form-label"><strong>Data Penentaun UKT:</strong></label>
                        </div>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($kriteria as $row)
                        {{-- @php
                            dd($row->bobot);
                        @endphp --}}
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nilai_kriteria{{$no}}">{{ $row->nama_kriteria }} <span class="text-danger">*</span></label>
                            <input type="hidden" name="id_kriteria{{$no}}" value="{{$row->id_kriteria}}">
                            <input type="hidden" name="nama_kriteria{{$no}}" value="{{$row->nama_kriteria}}">
                            <input type="hidden" name="bobot{{$no}}" value="{{$row->bobot}}">
                            <input type="hidden" name="ideal{{$no}}" value="{{$row->ideal}}">
                            <select name="nilai_kriteria{{$no}}" id="nilai_kriteria{{$no}}" class="selectpicker form-control" data-style="py-0" required>
                                @if ($form == 'Tambah')
                                    <option value="">-- Pilih --</option>
                                @else
                                    <option value="">-- Pilih --</option>
                                @endif
                                @foreach ($nilaiKriteria as $item)
                                    @if ($item->id_kriteria == $row->id_kriteria)
                                        <option value="{{$item->ukt}};{{$item->nilai_kriteria}}">{{$item->nilai_kriteria}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('nilai_kriteria{{$no}}')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @php
                        $no = $no+1;
                        @endphp
                        @endforeach

                        @if ($setting->form_penentuan_slip_gaji == 1 || $setting->form_penentuan_struk_listrik == 1 || $setting->form_penentuan_struk_air == 1 || $setting->form_penentuan_kk == 1)
                        <div class="form-group col-md-12 mt-4">
                            <label class="form-label"><strong>Data Berkas Pendukung <span class="text-danger">* Harus diisi sesuai dengan data yang dimiliki</span></strong></label>
                        </div>
                        @endif
                        @if ($setting->form_penentuan_slip_gaji == 1)
                            <div class="form-group col-md-6">
                                <label class="form-label" for="slip_gaji">Slip Gaji / Keterangan Penghasilan Orang Tua<span class="text-danger">* PDF</span></label>
                                <input type="file" class="form-control @error('slip_gaji') is-invalid @enderror" id="slip_gaji" name="slip_gaji" placeholder="Masukkan Foto Rumah" required>
                                @error('slip_gaji')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        @if ($setting->form_penentuan_struk_listrik == 1)
                            <div class="form-group col-md-6">
                                <label class="form-label" for="struk_listrik">Rekening Listrik (Maksimal 3 bulan terakhir) <span class="text-danger">* PDF</span></label>
                                <input type="file" class="form-control @error('struk_listrik') is-invalid @enderror" id="struk_listrik" name="struk_listrik" placeholder="Masukkan Foto Rumah" required>
                                @error('struk_listrik')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        @if ($setting->form_penentuan_struk_air == 1)
                            <div class="form-group col-md-6">
                                <label class="form-label" for="struk_air">Rekening Air (Maksimal 3 bulan terakhir) <span class="text-danger">* PDF</span></label>
                                <input type="file" class="form-control @error('struk_air') is-invalid @enderror" id="struk_air" name="struk_air" placeholder="Masukkan Foto Rumah" required>
                                @error('struk_air')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        @if ($setting->form_penentuan_kk == 1)
                            <div class="form-group col-md-6">
                                <label class="form-label" for="kk">Kartu Keluarga <span class="text-danger">* PDF</span></label>
                                <input type="file" class="form-control @error('kk') is-invalid @enderror" id="kk" name="kk" placeholder="Masukkan Foto Rumah" required>
                                @error('kk')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                    </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        @if ($form == 'Edit')
                            <a href="/informasi-penentuan-ukt/{{$detail->id_penentuan_ukt}}"" class="btn btn-secondary">Kembali</a>
                        @endif
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection