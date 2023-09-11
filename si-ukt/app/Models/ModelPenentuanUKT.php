<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelPenentuanUKT extends Model
{
    use HasFactory;

    public function dataPenentuanUKT()
    {
        return DB::table('penentuan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penentuan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->orderBy('id_penentuan_ukt', 'ASC')->get();
    }

    // NOW
    public function dataPenentuanUKTTanggal($tanggal_mulai, $tanggal_akhir, $tahun_angkatan)
    {
        return DB::table('penentuan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penentuan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->whereBetween('tanggal_penentuan', [$tanggal_mulai, $tanggal_akhir])
            ->where('mahasiswa.tahun_angkatan', $tahun_angkatan)
            ->orderBy('mahasiswa.prodi', 'ASC')->get();
    }

    public function dataPenentuanUKTAngkatan($tahun_angkatan)
    {
        return DB::table('penentuan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penentuan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->where('mahasiswa.tahun_angkatan', $tahun_angkatan)
            ->orderBy('mahasiswa.prodi', 'ASC')->get();
    }
    // NOW

    // NOW
    public function detailByMahasiswa($id_mahasiswa)
    {
        return DB::table('penentuan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penentuan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->where('penentuan_ukt.id_mahasiswa', $id_mahasiswa)
            ->orderBy('id_penentuan_ukt', 'DESC')->first();
    }
    // NOW

    public function detail($id_penentuan_ukt)
    {
        return DB::table('penentuan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penentuan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->where('id_penentuan_ukt', $id_penentuan_ukt)
            ->first();
    }

    public function tambah($data)
    {
        DB::table('penentuan_ukt')->insert($data);
    }

    public function edit($data)
    {
        DB::table('penentuan_ukt')->where('id_penentuan_ukt', $data['id_penentuan_ukt'])->update($data);
    }

    public function editStatusLaporan($data)
    {
        DB::table('penentuan_ukt')->where('status_laporan', 'Belum')->update($data);
    }

    public function dataTerakhir()
    {
        return DB::table('penentuan_ukt')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'penentuan_ukt.id_mahasiswa', 'left')
            ->join('kelompok_ukt', 'kelompok_ukt.id_kelompok_ukt', '=', 'mahasiswa.id_kelompok_ukt', 'left')
            ->limit(1)
            ->orderBy('id_penentuan_ukt', 'DESC')->first();
    }

    public function hapus($id_penentuan_ukt)
    {
        DB::table('penentuan_ukt')->where('id_penentuan_ukt', $id_penentuan_ukt)->delete();
    }

    public function jumlah($status)
    {
        return DB::table('penentuan_ukt')->where('status_penentuan', $status)->count();
    }
}
