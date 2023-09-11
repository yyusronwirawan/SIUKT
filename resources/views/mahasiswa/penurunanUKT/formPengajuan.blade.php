@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            @if ($user->id_kelompok_ukt === null )
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda belum mempunyai kelompok UKT. Silahkan melakukan penentuan UKT terlebih dahulu!</h4>
                </div>
            </div>
            @elseif ($user->kelompok_ukt < $setting->batas_ukt_penurunan )
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak dapat melakukan pengajuan penurunan UKT, karena Anda termasuk kelompok UKT {{$user->kelompok_ukt}}!</h4>
                </div>
            </div>
            @elseif ($user->status_pengajuan === 'Penangguhan' && $form !== 'Edit')
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak dapat mengisi form penurunan UKT, karena Anda sedang melakukan proses penangguhan UKT!</h4>
                </div>
            </div>
            @elseif ($user->status_pengajuan === 'Penurunan' && $dataPenurunanUKT !== null && $form !== 'Edit')
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak dapat mengisi form penurunan UKT, karena Anda sedang melakukan proses penurunan UKT!</h4>
                    <a href="/informasi-pengajuan-penurunan-ukt/{{$dataPenurunanUKT->id_penurunan_ukt}}" class="btn btn-primary mt-3">Informasi Pengajuan Penurunan UKT</a>
                </div>
            </div>
            @elseif ($penentuan!== null && $penentuan->status_laporan === 'Belum')
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak dapat mengisi form penangguhan UKT, karena proses penentuan UKT masih dilakukan!</h4>    
                </div>
            </div>
            @elseif ($user->status_pengajuan === 'Tidak' && $dataPenurunanUKT === null || $form === 'Edit')
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$subTitle}}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <form action="@if($form === 'Tambah') /pengajuan-penurunan-ukt @elseif($form === 'Edit') /edit-pengajuan-penurunan-ukt/{{$detail->id_penurunan_ukt}} @endif" method="POST" enctype="multipart/form-data">
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
                            <label class="form-label"><strong>Data Tambahan:</strong></label>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="semester">Semester <span class="text-danger">*</span></label>
                            <select name="semester" id="semester" class="selectpicker form-control @error('semester') is-invalid @enderror" autofocus data-style="py-0" required>
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
                            <label class="form-label" for="alamat_rumah">Alamat Rumah Lengkap (Untuk Kebutuhan Survey)</label>
                            <input type="text" class="form-control @error('alamat_rumah') is-invalid @enderror" id="alamat_rumah" name="alamat_rumah" value="@if($form == 'Tambah'){{old('alamat_rumah')}}@elseif($form == 'Edit'){{$detail->alamat_rumah}}@endif" placeholder="Masukkan Alamat Rumah Lengkap" required>
                            @error('alamat_rumah')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if ($setting->form_penurunan_sktm == 1)
                            <div class="form-group col-md-6">
                                <label class="form-label" for="sktm">SKTM (Surat Keterangan Tidak Mampu) <span class="text-danger">* PDF</span></label>
                                <input type="file" class="form-control @error('sktm') is-invalid @enderror" id="sktm" name="sktm" placeholder="Masukkan SKTM" required>
                                @error('sktm')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        @if ($setting->form_penurunan_khs == 1)
                            <div class="form-group col-md-6">
                                <label class="form-label" for="khs">KHS (Semester Berjalan) <span class="text-danger">* PDF</span></label>
                                <input type="file" class="form-control @error('khs') is-invalid @enderror" id="khs" name="khs" placeholder="Masukkan KHS" required>
                                @error('khs')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        @if ($setting->form_penurunan_struk_listrik == 1)
                            <div class="form-group col-md-6">
                                <label class="form-label" for="struk_listrik">Struk Listrik <span class="text-danger">* PDF</span></label>
                                <input type="file" class="form-control @error('struk_listrik') is-invalid @enderror" id="struk_listrik" name="struk_listrik" placeholder="Masukkan Struk Listrik" required>
                                @error('struk_listrik')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        @if ($setting->form_penurunan_foto_rumah == 1)
                            <div class="form-group col-md-6">
                                <label class="form-label" for="foto_rumah">Foto Rumah <span class="text-danger">* PDF</span></label>
                                <input type="file" class="form-control @error('foto_rumah') is-invalid @enderror" id="foto_rumah" name="foto_rumah" placeholder="Masukkan Foto Rumah" required>
                                @error('foto_rumah')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        @if ($setting->form_penurunan_slip_gaji == 1)
                            <div class="form-group col-md-6">
                                <label class="form-label" for="slip_gaji">Slip Gaji / Keterangan Penghasilan Orang Tua <span class="text-danger">* PDF</span></label>
                                <input type="file" class="form-control @error('slip_gaji') is-invalid @enderror" id="slip_gaji" name="slip_gaji" placeholder="Masukkan Foto Rumah" required>
                                @error('slip_gaji')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif
                        @if ($setting->form_penurunan_surat_pengajuan == 1)
                            <div class="form-group col-md-6">
                                <label class="form-label" for="surat_pengajuan">Surat Pengajuan (Anda buat sendiri dengan format bebas dengan tujuan ke Wadir II) <span class="text-danger">* PDF</span></label>
                                <input type="file" class="form-control @error('surat_pengajuan') is-invalid @enderror" id="surat_pengajuan" name="surat_pengajuan" placeholder="Masukkan Surat Pengajuan" required>
                                @error('surat_pengajuan')
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
                            <a href="/informasi-pengajuan-penurunan-ukt/{{$detail->id_penurunan_ukt}}"" class="btn btn-secondary">Kembali</a>
                        @endif
                    </form>
                </div>
            </div>
            @elseif ($user->status_pengajuan === 'Tidak' && $dataPenurunanUKT !== null)
            <div class="card-header d-flex justify-content-between mb-4">
                <div class="header-title text-center">
                    <h4 class="card-title ">Anda tidak dapat mengisi form penurunan UKT, karena Anda sudah pernah melakukan proses penurunan UKT!</h4>
                    <a href="/informasi-pengajuan-penurunan-ukt/{{$dataPenurunanUKT->id_penurunan_ukt}}" class="btn btn-primary mt-3">Informasi Pengajuan Penurunan UKT</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection