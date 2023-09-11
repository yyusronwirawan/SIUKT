<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelPenangguhanUKT extends Model
{
    use HasFactory;

    public function dataPenangguhanUKT()
    {
        return DB::table('penangguhan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penangguhan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->orderBy('id_penangguhan_ukt', 'ASC')->get();
    }

    // NOW
    public function dataPenangguhanUKTTanggal($tanggal_mulai, $tanggal_akhir)
    {
        return DB::table('penangguhan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penangguhan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->whereBetween('tanggal_pengajuan', [$tanggal_mulai, $tanggal_akhir])
            ->orderBy('id_penangguhan_ukt', 'ASC')->get();
    }
    // NOW

    public function detail($id_penangguhan_ukt)
    {
        return DB::table('penangguhan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penangguhan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->where('id_penangguhan_ukt', $id_penangguhan_ukt)->first();
    }

    // NOW
    public function dataPenangguhanUKTByMahasiswa($id_mahasiswa)
    {
        return DB::table('penangguhan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penangguhan_ukt.id_mahasiswa', 'left')
            ->where('penangguhan_ukt.id_mahasiswa', $id_mahasiswa)
            ->orderBy('id_penangguhan_ukt', 'ASC')->get();
    }
    // NOW

    public function tambah($data)
    {
        DB::table('penangguhan_ukt')->insert($data);
    }

    public function edit($data)
    {
        DB::table('penangguhan_ukt')->where('id_penangguhan_ukt', $data['id_penangguhan_ukt'])->update($data);
    }

    public function hapus($id_penangguhan_ukt)
    {
        DB::table('penangguhan_ukt')->where('id_penangguhan_ukt', $id_penangguhan_ukt)->delete();
    }

    public function jumlah($status)
    {
        return DB::table('penangguhan_ukt')->where('status_penangguhan', $status)->count();
    }
}
