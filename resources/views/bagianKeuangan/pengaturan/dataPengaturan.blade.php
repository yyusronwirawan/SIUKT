@extends('layout.main')

@section('content')

<div class="col-xl-12 col-lg-12">
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
        </div>
        <div class="card-body">
            <div class="new-user-info">
               <form action="/edit-pengaturan/{{$detail->id_setting}}" class="was-validated" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="row">
                     <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                           <label class="form-label"><strong>Data Tambahan</strong></label>
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label" for="tanda_tangan_kabag">Tanda Tangan Kabag (QR Code)</label>
                        <input type="file" class="form-control @error('tanda_tangan_kabag') is-invalid @enderror" id="preview_image" name="tanda_tangan_kabag">
                        @error('tanda_tangan_kabag')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label" for="tanda_tangan_kabag"></label>
                        <div class="profile-img-edit position-relative">
                              <img src="@if($detail->tanda_tangan_kabag){{ asset('gambar/'.$detail->tanda_tangan_kabag) }}@else{{ asset('gambar/default1.jpg') }}@endif" alt="Tanda Tangan Kabag" id="load_image" class="theme-color-default-img profile-pic rounded avatar-100">
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Edit Penentuan UKT</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->penentuan_edit_ukt == 1) checked @endif name="penentuan_edit_ukt" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="penentuan_edit_ukt" @if($detail->penentuan_edit_ukt == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('penentuan_edit_ukt')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                  </div>

                  <br>

                  <div class="row">
                     <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                           <label class="form-label"><strong>Form Penentuan UKT</strong></label>
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Berkas Slip Gaji / Keterangan Penghasilan Orang Tua</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->form_penentuan_slip_gaji == 1) checked @endif name="form_penentuan_slip_gaji" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="form_penentuan_slip_gaji" @if($detail->form_penentuan_slip_gaji == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('form_penentuan_slip_gaji')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Berkas Rekening Listrik (Maksimal 3 Bulan Terakhir)</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->form_penentuan_struk_listrik == 1) checked @endif name="form_penentuan_struk_listrik" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="form_penentuan_struk_listrik" @if($detail->form_penentuan_struk_listrik == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('form_penentuan_struk_listrik')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Berkas Rekening Air (Maksimal 3 Bulan Terakhir)</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->form_penentuan_struk_air == 1) checked @endif name="form_penentuan_struk_air" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="form_penentuan_struk_air" @if($detail->form_penentuan_struk_air == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('form_penentuan_struk_air')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Berkas Kartu Keluarga</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->form_penentuan_kk == 1) checked @endif name="form_penentuan_kk" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="form_penentuan_kk" @if($detail->form_penentuan_kk == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('form_penentuan_kk')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                  </div>

                  <br>

                  <div class="row">
                     <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                           <label class="form-label"><strong>Form Pengajuan Penangguhan UKT</strong></label>
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label" for="batas_ukt_penangguhan">Batas Kelompok UKT PenangguhanT</label>
                            <select name="batas_ukt_penangguhan" id="batas_ukt_penangguhan" class="selectpicker form-control @error('batas_ukt_penangguhan') is-invalid @enderror" data-style="py-0" required>
                                 <option value="{{$detail->batas_ukt_penangguhan}}">{{$detail->batas_ukt_penangguhan}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                            </select>
                            @error('batas_ukt_penangguhan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                           <label class="form-label" for="persen_denda">Denda (%)</label>
                           <input type="number" class="form-control @error('persen_denda') is-invalid @enderror" id="persen_denda" name="persen_denda" value="{{$detail->persen_denda}}" placeholder="Masukkan Denda Penangguhan " required>
                           @error('persen_denda')
                               <div class="invalid-feedback">
                               {{ $message }}
                               </div>
                           @enderror
                       </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                           <label class="form-label" for="persen_angsuran_pertama">Angsuran Pertama (%)</label>
                           <input type="number" class="form-control @error('persen_angsuran_pertama') is-invalid @enderror" id="persen_angsuran_pertama" name="persen_angsuran_pertama" value="{{$detail->persen_angsuran_pertama}}" placeholder="Masukkan Angsuran Pertama" required>
                           @error('persen_angsuran_pertama')
                               <div class="invalid-feedback">
                               {{ $message }}
                               </div>
                           @enderror
                       </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                           <label class="form-label" for="batas_tanggal_angsuran">Jumlah Hari Batas Angsuran (hari)</label>
                           <input type="number" class="form-control @error('batas_tanggal_angsuran') is-invalid @enderror" id="batas_tanggal_angsuran" name="batas_tanggal_angsuran" value="{{$detail->batas_tanggal_angsuran}}" placeholder="Masukkan Jumlah Hari Batas Angsuran" required>
                           @error('batas_tanggal_angsuran')
                               <div class="invalid-feedback">
                               {{ $message }}
                               </div>
                           @enderror
                       </div>
                     </div>
                  </div>

                  <br>

                  <div class="row">
                     <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                           <label class="form-label"><strong>Form Pengajuan Penurunan UKT</strong></label>
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label" for="batas_ukt_penurunan">Batas Kelompok UKT Penurunan</label>
                            <select name="batas_ukt_penurunan" id="batas_ukt_penurunan" class="selectpicker form-control @error('batas_ukt_penurunan') is-invalid @enderror" data-style="py-0" required>
                                 <option value="{{$detail->batas_ukt_penurunan}}">{{$detail->batas_ukt_penurunan}}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                            </select>
                            @error('batas_ukt_penurunan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Berkas SKTM (Surat Keterangan Tidak Mampu)</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->form_penurunan_sktm == 1) checked @endif name="form_penurunan_sktm" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="form_penurunan_sktm" @if($detail->form_penurunan_sktm == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('form_penurunan_sktm')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Berkas KHS (Semester Yang Sedang Berjalan)</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->form_penurunan_khs == 1) checked @endif name="form_penurunan_khs" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="form_penurunan_khs" @if($detail->form_penurunan_khs == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('form_penurunan_khs')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Berkas Struk Listrik</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->form_penurunan_struk_listrik == 1) checked @endif name="form_penurunan_struk_listrik" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="form_penurunan_struk_listrik" @if($detail->form_penurunan_struk_listrik == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('form_penurunan_struk_listrik')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Berkas Slip Gaji / Keterangan Penghasilan Orang Tua</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->form_penurunan_slip_gaji == 1) checked @endif name="form_penurunan_slip_gaji" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="form_penurunan_slip_gaji" @if($detail->form_penurunan_slip_gaji == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('form_penurunan_slip_gaji')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Berkas Foto Rumah</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->form_penurunan_foto_rumah == 1) checked @endif name="form_penurunan_foto_rumah" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="form_penurunan_foto_rumah" @if($detail->form_penurunan_foto_rumah == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('form_penurunan_foto_rumah')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-6">
                        <label class="form-label">Berkas Surat Pengajuan Penurunan UKT</label>
                        <div class="form-check">
                           <input type="radio" class="form-check-input" id="validationFormCheck2" @if($detail->form_penurunan_surat_pengajuan == 1) checked @endif name="form_penurunan_surat_pengajuan" value="1" required>
                           <label class="form-check-label" for="validationFormCheck2">Show</label>
                        </div>
                        <div class="form-check form-group">
                           <input type="radio" class="form-check-input" id="validationFormCheck3" name="form_penurunan_surat_pengajuan" @if($detail->form_penurunan_surat_pengajuan == 0) checked @endif value="0" required>
                           <label class="form-check-label" for="validationFormCheck3">Hide</label>
                           @error('form_penurunan_surat_pengajuan')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                  </div>

                  <br>

                  <div class="row">
                     <div class="col-sm-12 col-lg-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                     </div>
                  </div>
               </form>
            </div>
        </div>
    </div>
</div>

@endsection