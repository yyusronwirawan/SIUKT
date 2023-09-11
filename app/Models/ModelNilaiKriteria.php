<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelNilaiKriteria extends Model
{
    use HasFactory;

    public function dataNilaiKriteria()
    {
        return DB::table('nilai_kriteria')
            ->join('kriteria', 'kriteria.id_kriteria', '=', 'nilai_kriteria.id_kriteria', 'left')
            ->orderBy('nilai_kriteria.ukt', 'ASC')
            ->get();
    }

    // NOWW
    public function dataNilaiKriteriaByKriteria($id_kriteria)
    {
        return DB::table('nilai_kriteria')
            ->select('ukt')
            ->where('nilai_kriteria.id_kriteria', $id_kriteria)
            ->distinct('ukt')
            ->orderBy('nilai_kriteria.ukt', 'ASC')
            ->get();
    }
    // NOWW

    public function detail($id_nilai_kriteria)
    {
        return DB::table('nilai_kriteria')
            ->join('kriteria', 'kriteria.id_kriteria', '=', 'nilai_kriteria.id_kriteria', 'left')
            ->where('id_nilai_kriteria', $id_nilai_kriteria)->first();
    }

    public function tambah($data)
    {
        DB::table('nilai_kriteria')->insert($data);
    }

    public function edit($data)
    {
        DB::table('nilai_kriteria')->where('id_nilai_kriteria', $data['id_nilai_kriteria'])->update($data);
    }

    public function hapus($id_nilai_kriteria)
    {
        DB::table('nilai_kriteria')->where('id_nilai_kriteria', $id_nilai_kriteria)->delete();
    }
}
