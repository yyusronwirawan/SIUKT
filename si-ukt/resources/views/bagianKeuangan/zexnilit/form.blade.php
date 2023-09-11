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
                    <form action="@if($form === 'Tambah') /tambah-nilai-kriteria @elseif($form === 'Edit') /edit-nilai-kriteria/{{$detail->id_nilai_kriteria}} @endif" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="id_kriteria">Kriteria</label>
                            <select name="id_kriteria" id="id_kriteria" class="selectpicker form-control @error('id_kriteria') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif>
                                @if ($form === 'Tambah')
                                    <option>-- Pilih --</option>    
                                @elseif ($form === 'Edit' || $form === 'Detail')
                                    <option value="{{$detail->id_kriteria}}">{{$detail->nama_kriteria}}</option>
                                @endif
                                @foreach ($kriteria as $item)
                                    <option value="{{$item->id_kriteria}}">{{$item->nama_kriteria}}</option>
                                @endforeach
                            </select>
                            @error('id_kriteria')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="nilai_kriteria">Nilai Kriteria</label>
                            <input type="text" class="form-control @error('nilai_kriteria') is-invalid @enderror" id="nilai_kriteria" name="nilai_kriteria" value="@if($form === 'Tambah'){{ old('nilai_kriteria') }}@elseif($form === 'Edit' || $form === 'Detail'){{$detail->nilai_kriteria}}@endif"  @if($form === 'Detail') disabled @endif placeholder="Masukkan Nilai Kriteria">
                            @error('nilai_kriteria')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="ukt">No UKT</label>
                            <select name="ukt" id="ukt" class="selectpicker form-control @error('ukt') is-invalid @enderror" data-style="py-0" @if($form === 'Detail') disabled @endif>
                                @if ($form === 'Tambah')
                                    <option>-- Pilih --</option>    
                                @elseif ($form === 'Edit' || $form === 'Detail')
                                    <option value="{{$detail->ukt}}">{{$detail->ukt}}</option>
                                @endif
                                @foreach ($dataUKT as $item)
                                    <option value="{{$item->kelompok_ukt}}">{{$item->kelompok_ukt}}</option>
                                @endforeach
                            </select>
                            @error('ukt')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <a href="/daftar-nilai-kriteria" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection