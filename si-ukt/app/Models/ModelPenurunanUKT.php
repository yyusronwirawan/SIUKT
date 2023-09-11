<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelPenurunanUKT extends Model
{
    use HasFactory;

    public function dataPenurunanUKT()
    {
        return DB::table('penurunan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penurunan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->orderBy('id_penurunan_ukt', 'DESC')->get();
    }

    // NOW
    public function dataPenurunanUKTTanggal($tanggal_mulai, $tanggal_akhir)
    {
        return DB::table('penurunan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penurunan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->whereBetween('tanggal_pengajuan', [$tanggal_mulai, $tanggal_akhir])
            ->orderBy('id_penurunan_ukt', 'DESC')->get();
    }
    // NOW

    // NOW
    public function detailByMahasiswa($id_mahasiswa)
    {
        return DB::table('penurunan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penurunan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->where('penurunan_ukt.id_mahasiswa', $id_mahasiswa)->first();
    }
    // NOW

    public function detail($id_penurunan_ukt)
    {
        return DB::table('penurunan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penurunan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->where('id_penurunan_ukt', $id_penurunan_ukt)->first();
    }

    // public function dataPenangguhanUKTByMahasiswa($id_mahasiswa)
    // {
    //     return DB::table('penurunan_ukt')
    //         ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penurunan_ukt.id_mahasiswa', 'left')
    //         ->where('penurunan_ukt.id_mahasiswa', $id_mahasiswa)
    //         ->orderBy('id_penurunan_ukt', 'ASC')->get();
    // }

    public function tambah($data)
    {
        DB::table('penurunan_ukt')->insert($data);
    }

    public function edit($data)
    {
        DB::table('penurunan_ukt')->where('id_penurunan_ukt', $data['id_penurunan_ukt'])->update($data);
    }

    // public function hapus($id_penurunan_ukt)
    // {
    //     DB::table('penurunan_ukt')->where('id_penurunan_ukt', $id_penurunan_ukt)->delete();
    // }

    public function dataTerakhir()
    {
        return DB::table('penurunan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penurunan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->limit(1)
            ->orderBy('id_penurunan_ukt', 'DESC')->first();
    }

    public function jumlah($status)
    {
        return DB::table('penurunan_ukt')->where('status_penurunan', $status)->count();
    }
}
