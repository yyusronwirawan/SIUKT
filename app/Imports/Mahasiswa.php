<?php

namespace App\Imports;

use App\Models\ModelMahasiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Mahasiswa implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ModelMahasiswa([
            'nama_mahasiswa' => $row[0],
            'prodi' => $row[1],
            'nomor_telepon' => '0' . $row[2],
            'tahun_angkatan' => $row[3],
            'nim' => $row[4],
            'email' => $row[5],
            'password' => Hash::make($row[6])
            // 'tanggal_import' => date('Y-m-d H:i:s'),
        ]);
    }

    public function startRow(): int
    {
        return 2; // Mulai import dari baris ke-2
    }
}
