<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelKriteria extends Model
{
    use HasFactory;

    public function dataKriteria()
    {
        return DB::table('kriteria')->orderBy('id_kriteria', 'DESC')->get();
    }

    public function detail($id_kriteria)
    {
        return DB::table('kriteria')->where('id_kriteria', $id_kriteria)->first();
    }

    public function tambah($data)
    {
        DB::table('kriteria')->insert($data);
    }

    public function edit($data)
    {
        DB::table('kriteria')->where('id_kriteria', $data['id_kriteria'])->update($data);
    }

    public function hapus($id_kriteria)
    {
        DB::table('kriteria')->where('id_kriteria', $id_kriteria)->delete();
    }

    public function totalBobot()
    {
        return DB::table('kriteria')->sum('bobot');
    }

    public function jumlahKriteria()
    {
        return DB::table('kriteria')->count();
    }
}
