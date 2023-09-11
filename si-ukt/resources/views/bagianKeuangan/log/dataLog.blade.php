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
            <div class="card-body px-0">
                <div class="table-responsive">
                <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                    <thead>
                        <tr class="ligth">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($daftarLog as $item)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>@if($item->status_user !== 'Mahasiswa'){{$item->nama_user}}@else{{$item->nama_mahasiswa}}@endif</td>
                            <td>{{$item->status_user}}</td>
                            <td>{{$item->keterangan}}</td>
                            <td>{{$item->waktu}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection