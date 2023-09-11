<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelLog extends Model
{
    use HasFactory;

    public function dataLog()
    {
        return DB::table('log')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa', '=', 'log.id_mahasiswa', 'left')
            ->join('user', 'user.id_user', '=', 'log.id_user', 'left')
            ->orderBy('id_log', 'DESC')
            ->get();
    }

    public function tambah($data)
    {
        DB::table('log')->insert($data);
    }
}
