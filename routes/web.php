<?php

use App\Http\Controllers\KelolaAdmin;
use App\Http\Controllers\KelolaMahasiswa;
use App\Http\Controllers\User;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Log;
use App\Http\Controllers\Pengaturan;
use App\Http\Controllers\KelompokUKT;
use App\Http\Controllers\Kriteria;
use App\Http\Controllers\NilaiKriteria;
use App\Http\Controllers\Login;
use App\Http\Controllers\PenangguhanUKT;
use App\Http\Controllers\PenurunanUKT;
use App\Http\Controllers\PenentuanUKT;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/unduh-format-excel', [KelolaMahasiswa::class, 'unduhFormatExcel']);

Route::group(['middleware' => 'revalidate'], function () {

    // Home
    // Route::get('/', [Home::class, 'index'])->name('landing');

    // Login User
    Route::get('/', [Login::class, 'index'])->name('login');
    Route::get('/admin', [Login::class, 'admin'])->name('admin');
    Route::post('/login', [Login::class, 'loginProcess']);
    // Route::get('/admin', [Login::class, 'admin'])->name('admin');

    // lupa password
    Route::get('/lupa-password-mahasiswa', [Login::class, 'lupaPasswordMahasiswa'])->name('lupa-password-mahasiswa');
    Route::get('/lupa-password', [Login::class, 'lupaPassword'])->name('lupa-password');
    Route::post('/lupa-password', [Login::class, 'prosesLupaPassword']);

    // reset password
    Route::get('/reset-password-mahasiswa/{id}', [Login::class, 'resetPasswordMahasiswa'])->name('reset-password-mahasiswa');
    Route::get('/reset-password/{id}', [Login::class, 'resetPassword'])->name('reset-password');
    Route::post('/reset-password/{id}', [Login::class, 'prosesResetPassword']);

    // Logout
    Route::get('/logout', [Login::class, 'logout'])->name('logout');

    // dashboard
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');

    // PROFIL
    Route::get('/profil', [User::class, 'profil'])->name('profil');
    Route::post('/edit-profil/{id}', [User::class, 'prosesEditProfil']);
    Route::get('/ubah-password', [User::class, 'ubahPassword'])->name('ubah-password');
    Route::post('/ubah-password/{id}', [User::class, 'prosesUbahPassword']);

    Route::group(['middleware' => 'mahasiswa'], function () {

        // PROFIL
        Route::get('/profil-mahasiswa', [KelolaMahasiswa::class, 'profil'])->name('profil-mahasiswa');
        Route::post('/edit-profil-mahasiswa/{id}', [KelolaMahasiswa::class, 'prosesEditProfil']);
        Route::get('/ubah-password-mahasiswa', [KelolaMahasiswa::class, 'ubahPassword'])->name('ubah-password-mahasiswa');
        Route::post('/ubah-password-mahasiswa/{id}', [KelolaMahasiswa::class, 'prosesUbahPassword']);

        // pengajuan penangguhan UKT
        Route::get('/pengajuan-penangguhan-ukt', [PenangguhanUKT::class, 'index'])->name('pengajuan-penangguhan-ukt');
        Route::post('/pengajuan-penangguhan-ukt', [PenangguhanUKT::class, 'prosesTambah']);
        Route::get('/edit-pengajuan-penangguhan-ukt/{id}', [PenangguhanUKT::class, 'edit']);
        Route::post('/edit-pengajuan-penangguhan-ukt/{id}', [PenangguhanUKT::class, 'prosesEdit']);
        Route::get('/riwayat-pengajuan-penangguhan-ukt', [PenangguhanUKT::class, 'riwayat'])->name('riwayat-pengajuan-penangguhan-ukt');
        Route::get('/hapus-pengajuan-penangguhan-ukt/{id}', [PenangguhanUKT::class, 'prosesHapus']);
        Route::get('/kirim-pengajuan-penangguhan-ukt/{id}', [PenangguhanUKT::class, 'prosesKirim']);

        // pengajuan penangguhan UKT
        Route::get('/pengajuan-penurunan-ukt', [PenurunanUKT::class, 'index'])->name('pengajuan-penurunan-ukt');
        Route::post('/pengajuan-penurunan-ukt', [PenurunanUKT::class, 'prosesTambah']);
        Route::get('/informasi-pengajuan-penurunan-ukt/{id}', [PenurunanUKT::class, 'informasiPenurunanUKT']);
        Route::get('/edit-pengajuan-penurunan-ukt/{id}', [PenurunanUKT::class, 'edit'])->name('edit-pengajuan-penurunan-ukt');
        Route::post('/edit-pengajuan-penurunan-ukt/{id}', [PenurunanUKT::class, 'prosesEdit']);
        Route::get('/kirim-pengajuan-penurunan-ukt/{id}', [PenurunanUKT::class, 'prosesKirim'])->name('kirim-pengajuan-penurunan-ukt');

        // penentuan UKT
        Route::get('/penentuan-ukt', [PenentuanUKT::class, 'index'])->name('penentuan-ukt');
        Route::post('/penentuan-ukt', [PenentuanUKT::class, 'prosesPenentuan']);
        Route::get('/informasi-penentuan-ukt/{id}', [PenentuanUKT::class, 'informasiPenentuanUKT']);
        Route::get('/ulangi-penentuan-ukt/{id}', [PenentuanUKT::class, 'ulangi']);
        Route::get('/edit-penentuan-ukt/{id}', [PenentuanUKT::class, 'edit'])->name('edit-penentuan-ukt');
        Route::post('/edit-penentuan-ukt/{id}', [PenentuanUKT::class, 'prosesEdit']);
        Route::get('/kirim-penentuan-ukt/{id}', [PenentuanUKT::class, 'kirim']);
        Route::get('/download-pengumuman-ukt/{tahun_angkatan}', [PenentuanUKT::class, 'downloadPengumumanUKT']);
    });

    Route::group(['middleware' => 'bagiankeuangan'], function () {

        // Kelola user
        Route::get('/daftar-user', [User::class, 'index'])->name('daftar-user');
        Route::get('/tambah-user', [User::class, 'tambah'])->name('tambah-user');
        Route::post('/tambah-user', [User::class, 'prosesTambah']);
        Route::get('/edit-user/{id}', [User::class, 'edit'])->name('edit-user');
        Route::post('/edit-user/{id}', [User::class, 'prosesEdit']);
        Route::get('/hapus-user/{id}', [User::class, 'prosesHapus']);

        // data log
        Route::get('/daftar-log', [Log::class, 'index'])->name('daftar-log');

        // data pengatuaran
        Route::get('/pengaturan', [Pengaturan::class, 'index'])->name('pengaturan');
        Route::post('/edit-pengaturan/{id}', [Pengaturan::class, 'prosesEdit']);

        // kelola kelompok UKT
        Route::get('/daftar-kelompok-ukt', [KelompokUKT::class, 'index'])->name('daftar-kelompok-ukt');
        Route::get('/tambah-kelompok-ukt', [KelompokUKT::class, 'tambah'])->name('tambah-kelompok-ukt');
        Route::post('/tambah-kelompok-ukt', [KelompokUKT::class, 'prosesTambah']);
        Route::get('/edit-kelompok-ukt/{id}', [KelompokUKT::class, 'edit'])->name('edit-kelompok-ukt');
        Route::post('/edit-kelompok-ukt/{id}', [KelompokUKT::class, 'prosesEdit']);
        Route::get('/hapus-kelompok-ukt/{id}', [KelompokUKT::class, 'prosesHapus']);

        // kelola kriteria
        Route::get('/daftar-kriteria', [Kriteria::class, 'index'])->name('daftar-kriteria');
        Route::get('/tambah-kriteria', [Kriteria::class, 'tambah'])->name('tambah-kriteria');
        Route::post('/tambah-kriteria', [Kriteria::class, 'prosesTambah']);
        Route::get('/edit-kriteria/{id}', [Kriteria::class, 'edit'])->name('edit-kriteria');
        Route::post('/edit-kriteria/{id}', [Kriteria::class, 'prosesEdit']);
        Route::get('/hapus-kriteria/{id}', [Kriteria::class, 'prosesHapus']);

        // kelola nilai kriteria
        Route::get('/daftar-nilai-kriteria/{id}', [NilaiKriteria::class, 'index'])->name('daftar-nilai-kriteria');
        Route::get('/tambah-nilai-kriteria', [NilaiKriteria::class, 'tambah'])->name('tambah-nilai-kriteria');
        Route::post('/tambah-nilai-kriteria', [NilaiKriteria::class, 'prosesTambah']);
        Route::get('/edit-nilai-kriteria/{id}', [NilaiKriteria::class, 'edit'])->name('edit-nilai-kriteria');
        Route::post('/edit-nilai-kriteria/{id}', [NilaiKriteria::class, 'prosesEdit']);
        Route::get('/hapus-nilai-kriteria/{id}', [NilaiKriteria::class, 'prosesHapus']);
        // Route::get('/daftar-nilai-kriteria', [NilaiKriteria::class, 'index'])->name('daftar-nilai-kriteria');
        // Route::get('/tambah-nilai-kriteria', [NilaiKriteria::class, 'tambah'])->name('tambah-nilai-kriteria');
        // Route::post('/tambah-nilai-kriteria', [NilaiKriteria::class, 'prosesTambah']);
        // Route::get('/edit-nilai-kriteria/{id}', [NilaiKriteria::class, 'edit'])->name('edit-nilai-kriteria');
        // Route::post('/edit-nilai-kriteria/{id}', [NilaiKriteria::class, 'prosesEdit']);
        // Route::get('/hapus-nilai-kriteria/{id}', [NilaiKriteria::class, 'prosesHapus']);

        // kelola penentuan UKt
        Route::get('/kelola-penentuan-ukt', [PenentuanUKT::class, 'kelolaPenentuanUKT'])->name('kelola-penentuan-ukt');
        Route::get('/cek-berkas-penentuan-ukt/{id}', [PenentuanUKT::class, 'cekPemberkasan'])->name('cek-berkas-penentuan-ukt');
        Route::get('/tidak-setuju-penentuan/{id}', [PenentuanUKT::class, 'tidakSetuju']);
        Route::get('/setuju-penentuan/{id}', [PenentuanUKT::class, 'setuju']);
        Route::get('/kirim-laporan', [PenentuanUKT::class, 'kirimKeLaporan']);
        Route::get('/laporan-penentuan-ukt', [PenentuanUKT::class, 'laporanPenentuanUKT'])->name('laporan-penentuan-ukt');
        Route::post('/cetak-semua-penentuan', [PenentuanUKT::class, 'cetakSemua']);
        Route::get('/cetak-satuan-penentuan/{id}', [PenentuanUKT::class, 'cetakSatuan']);
        Route::post('/edit-hasil-ukt/{id}', [PenentuanUKT::class, 'editHasilUKT']);

        // kelola penangguhan UKt
        Route::get('/kelola-penangguhan-ukt', [PenangguhanUKT::class, 'kelolaPenangguhanUKT'])->name('kelola-penangguhan-ukt');
        Route::post('/beri-jadwal/{id}', [PenangguhanUKT::class, 'beriJadwal']);
        Route::get('/tidak-setuju-bagian-keuangan/{id}', [PenangguhanUKT::class, 'tidakSetuju']);
        Route::get('/setuju-bagian-keuangan/{id}', [PenangguhanUKT::class, 'setujuBagianKeuangan']);
        Route::get('/laporan-penangguhan-ukt', [PenangguhanUKT::class, 'laporanPenangguhanUKT'])->name('laporan-penangguhan-ukt');
        Route::post('/cetak-semua-penangguhan', [PenangguhanUKT::class, 'cetakSemua']);
        Route::get('/cetak-satuan-penangguhan/{id}', [PenangguhanUKT::class, 'cetakSatuan']);

        // kelola penurunan UKt
        Route::get('/kelola-penurunan-ukt', [PenurunanUKT::class, 'kelolaPenurunanUKT'])->name('kelola-penurunan-ukt');
        Route::get('/cek-berkas-penurunan-ukt/{id}', [PenurunanUKT::class, 'cekPemberkasan'])->name('cek-berkas-penurunan-ukt');
        Route::post('/beri-jadwal-survey/{id}', [PenurunanUKT::class, 'beriJadwalSurvey']);
        Route::get('/tidak-setuju-bagian-keuangan-penurunan/{id}', [PenurunanUKT::class, 'tidakSetuju']);
        Route::get('/setuju-bagian-keuangan-penurunan/{id}', [PenurunanUKT::class, 'setujuBagianKeuangan']);
        Route::get('/laporan-penurunan-ukt', [PenurunanUKT::class, 'laporanPenurunanUKT'])->name('laporan-penurunan-ukt');
        Route::post('/cetak-semua-penurunan', [PenurunanUKT::class, 'cetakSemua']);
        Route::get('/cetak-satuan-penurunan/{id}', [PenurunanUKT::class, 'cetakSatuan']);
        Route::post('/ubah-kelompok-ukt/{id}', [PenurunanUKT::class, 'ubahKelompokUKT']);

        // Kelola Admin
        // Route::get('/daftar-admin', [KelolaAdmin::class, 'index'])->name('daftar-admin');
        // Route::get('/tambah-admin', [KelolaAdmin::class, 'tambah'])->name('tambah-admin');
        // Route::post('/tambah-admin', [KelolaAdmin::class, 'prosesTambah']);
        // Route::get('/edit-admin/{id}', [KelolaAdmin::class, 'edit'])->name('edit-admin');
        // Route::post('/edit-admin/{id}', [KelolaAdmin::class, 'prosesEdit']);
        // Route::get('/hapus-admin/{id}', [KelolaAdmin::class, 'prosesHapus']);
        // Route::get('/profil-admin', [KelolaAdmin::class, 'profil'])->name('profil-admin');
        // Route::post('/edit-profil-admin/{id}', [KelolaAdmin::class, 'prosesEditProfil']);

        // Kelola staff
        // Route::get('/daftar-staff', [User::class, 'index'])->name('daftar-staff');
        // Route::get('/tambah-staff', [User::class, 'tambah'])->name('tambah-staff');
        // Route::post('/tambah-staff', [User::class, 'prosesTambah']);
        // Route::get('/edit-staff/{id}', [User::class, 'edit'])->name('edit-staff');
        // Route::post('/edit-staff/{id}', [User::class, 'prosesEdit']);
        // Route::get('/hapus-staff/{id}', [User::class, 'prosesHapus']);
    });

    Route::group(['middleware' => 'akademik'], function () {

        // Kelola mahasiswa
        Route::get('/daftar-mahasiswa', [KelolaMahasiswa::class, 'index'])->name('daftar-mahasiswa');
        Route::get('/tambah-mahasiswa', [KelolaMahasiswa::class, 'tambah'])->name('tambah-mahasiswa');
        Route::post('/tambah-mahasiswa', [KelolaMahasiswa::class, 'prosesTambah']);
        Route::get('/edit-mahasiswa/{id}', [KelolaMahasiswa::class, 'edit'])->name('edit-mahasiswa');
        Route::post('/edit-mahasiswa/{id}', [KelolaMahasiswa::class, 'prosesEdit']);
        Route::get('/hapus-mahasiswa/{id}', [KelolaMahasiswa::class, 'prosesHapus']);
        Route::post('/import-mahasiswa', [KelolaMahasiswa::class, 'prosesImport']);
        Route::POST('/filter-data-mahasiswa', [KelolaMahasiswa::class, 'filter'])->name('filter-data-mahasiswa');

        Route::get('/daftar-alumni', [KelolaMahasiswa::class, 'alumni'])->name('daftar-alumni');
    });

    Route::group(['middleware' => 'kepalabagian'], function () {

        // approve penangguhan UKt
        Route::get('/approve-penangguhan-ukt', [PenangguhanUKT::class, 'approvePenangguhanUKT'])->name('approve-penangguhan-ukt');
        Route::get('/tidak-setuju-kepala-bagian/{id}', [PenangguhanUKT::class, 'tidakSetuju']);
        Route::get('/setuju-kepala-bagian/{id}', [PenangguhanUKT::class, 'setujuKepalaBagian']);

        // approve penurunan UKt
        Route::get('/approve-penurunan-ukt', [PenurunanUKT::class, 'approvePenurunanUKT'])->name('approve-penurunan-ukt');
        Route::get('/cek-berkas-penurunan-ukt-kabag/{id}', [PenurunanUKT::class, 'cekPemberkasan'])->name('cek-berkas-penurunan-ukt-kabag');
        Route::get('/tidak-setuju-kepala-bagian-penurunan/{id}', [PenurunanUKT::class, 'tidakSetuju']);
        Route::get('/setuju-kepala-bagian-penurunan/{id}', [PenurunanUKT::class, 'setujuKepalaBagian']);
    });
});
