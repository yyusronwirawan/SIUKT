<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelMahasiswa extends Model
{
    use HasFactory;
    protected $guarded = ['id_mahasiswa'];
    public $table = 'mahasiswa';

    public function dataMahasiswa()
    {
        return DB::table('mahasiswa')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->orderBy('id_mahasiswa', 'DESC')->get();
    }

    public function dataMahasiswaByTahun($tahun_angkatan)
    {
        return DB::table('mahasiswa')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->orderBy('id_mahasiswa', 'DESC')
            ->where('tahun_angkatan', $tahun_angkatan)
            ->get();
    }

    public function dataProdi()
    {
        return DB::table('kelompok_ukt')
            ->select('program_studi')
            ->distinct('program_studi')
            ->get();
    }

    public function detail($id_mahasiswa)
    {
        return DB::table('mahasiswa')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->where('id_mahasiswa', $id_mahasiswa)
            ->first();
    }

    public function tambah($data)
    {
        DB::table('mahasiswa')->insert($data);
    }

    public function edit($data)
    {
        DB::table('mahasiswa')->where('id_mahasiswa', $data['id_mahasiswa'])->update($data);
    }

    public function hapus($id_mahasiswa)
    {
        DB::table('mahasiswa')->where('id_mahasiswa', $id_mahasiswa)->delete();
    }

    public function jumlahMahasiswa()
    {
        return DB::table('mahasiswa')->count();
    }

    public function dataTahunAngkatan()
    {
        return DB::table('mahasiswa')
            ->select('tahun_angkatan', 'status_mahasiswa')
            ->distinct()
            ->orderBy('tahun_angkatan', 'DESC')->get();
    }

    public function jumlah($status)
    {
        return DB::table('mahasiswa')->where('status_mahasiswa', $status)->count();
    }
}
