@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$subTitle}}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="new-user-info">
                    <form action="@if($form === 'Tambah') /tambah-kelompok-ukt @elseif($form === 'Edit') /edit-kelompok-ukt/{{$detail->id_kelompok_ukt}} @endif" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="program_studi">Program Studi</label>
                            <select name="program_studi" id="program_studi" class="selectpicker form-control @error('program_studi') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif>
                                @if ($form === 'Tambah')
                                    <option>-- Pilih --</option>    
                                @elseif ($form === 'Edit' || $form === 'Detail')
                                    <option value="{{$detail->program_studi}}">{{$detail->program_studi}}</option>
                                @endif
                                <option value="D3 Keperawatan">D3 Keperawatan</option>
                                <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                                <option value="D3 Agroindustri">D3 Agroindustri</option>
                                <option value="D3 Pemeliharaan Mesin">D3 Pemeliharaan Mesin</option>
                                <option value="D4 Teknologi Produksi Tanaman Pangan">D4 Teknologi Produksi Tanaman Pangan</option>
                                <option value="D4 Teknologi Rekayasa Manufaktur">D4 Teknologi Rekayasa Manufaktur</option>
                                <option value="D4 Teknologi Rekayasa Perangkat Lunak">D4 Teknologi Rekayasa Perangkat Lunak</option>
                            </select>
                            @error('program_studi')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="kelompok_ukt">Kelompok UKT</label>
                            <select name="kelompok_ukt" id="kelompok_ukt" class="selectpicker form-control @error('kelompok_ukt') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif>
                                @if ($form === 'Tambah')
                                    <option>-- Pilih --</option>    
                                @elseif ($form === 'Edit' || $form === 'Detail')
                                    <option value="{{$detail->kelompok_ukt}}">{{$detail->kelompok_ukt}}</option>
                                @endif
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                            </select>
                            @error('kelompok_ukt')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nominal">Nominal UKT</label>
                            <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="@if($form === 'Tambah'){{ old('nominal') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->nominal}}@endif"  @if($form === 'Detail') disabled @endif placeholder="Masukkan Nominal UKT">
                            @error('nominal')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <a href="/daftar-kelompok-ukt" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection