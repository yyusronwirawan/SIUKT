<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelAuth extends Model
{
    use HasFactory;

    public function cekNimMahasiswa($nim)
    {
        return DB::table('mahasiswa')->where('nim', $nim)->first();
    }

    public function cekEmailMahasiswa($email)
    {
        return DB::table('mahasiswa')->where('email', $email)->first();
    }

    public function cekEmail($email)
    {
        return DB::table('user')->where('email', $email)->first();
    }

    public function cekNik($nik)
    {
        return DB::table('user')->where('nik', $nik)->first();
    }
}
