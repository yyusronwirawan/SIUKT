<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('user')->insert([
            'nama_user' => 'Bagian Keuangan',
            'email' => 'renaldinoviandi9@gmail.com',
            'nik' => '1111111111',
            'password' => bcrypt('password'),
            'status' => 'Bagian Keuangan',
        ]);
    }
}
