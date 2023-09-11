<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use App\Models\ModelMahasiswa;
use App\Models\ModelLog;
use App\Models\ModelUser;
use App\Models\ModelKelompokUKT;
use Excel;

class KelolaMahasiswa extends Controller
{

    private $ModelMahasiswa;
    private $ModelLog;
    private $ModelUser;
    private $ModelKelompokUKT;
    private $public_path;

    public function __construct()
    {
        $this->ModelMahasiswa = new ModelMahasiswa();
        $this->ModelLog = new ModelLog();
        $this->ModelUser = new ModelUser();
        $this->ModelKelompokUKT = new ModelKelompokUKT();
        $this->public_path = 'foto_user';
    }

    public function index()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'             => 'Data Mahasiswa',
            'subTitle'          => 'Daftar Mahasiswa',
            'tahunAngkatan'     => null,
            'daftarMahasiswa'   => $this->ModelMahasiswa->dataMahasiswa(),
            'dataTahunAngkatan' => $this->ModelMahasiswa->dataTahunAngkatan(),
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
        ];

        return view('bagianKeuangan.kelolaMahasiswa.dataMahasiswa', $data);
    }

    public function filter()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        if (Request()->status_mahasiswa === 'Aktif') {
            $title = 'Data Mahasiswa';
            $subTitle = 'Edit Mahasiswa';
            $view = 'bagianKeuangan.kelolaMahasiswa.dataMahasiswa';
        } else {
            $title = 'Data Alumni';
            $subTitle = 'Edit Alumni';
            $view = 'bagianKeuangan.kelolaMahasiswa.dataAlumni';
        }

        $data = [
            'title'             => $title,
            'subTitle'          => $subTitle,
            'tahunAngkatan'     => Request()->tahun_angkatan,
            'daftarMahasiswa'   => $this->ModelMahasiswa->dataMahasiswaByTahun(Request()->tahun_angkatan),
            'dataTahunAngkatan' => $this->ModelMahasiswa->dataTahunAngkatan(),
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
        ];

        return view($view, $data);
    }

    public function tambah()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'     => 'Data Mahasiswa',
            'subTitle'  => 'Tambah Mahasiswa',
            'form'      => 'Tambah',
            'user'      => $this->ModelUser->detail(Session()->get('id_user')),
            'dataProdi' => $this->ModelMahasiswa->dataProdi(),
        ];

        return view('bagianKeuangan.kelolaMahasiswa.form', $data);
    }

    public function prosesTambah()
    {
        Request()->validate([
            'nama_mahasiswa'    => 'required',
            'prodi'             => 'required',
            'nomor_telepon'     => 'required',
            'tahun_angkatan'    => 'required',
            'nim'               => 'required|numeric|unique:mahasiswa,nim',
            'email'             => 'required|unique:user,email|unique:mahasiswa,email|email',
            'password'          => 'min:6|required',
            'foto_user'         => 'required|mimes:jpeg,png,jpg|max:2048',
            'status_pengajuan'  => 'required',
        ], [
            'nama_mahasiswa.required'   => 'Nama lengkap harus diisi!',
            'prodi.required'            => 'Program studi harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'tahun_angkatan.required'   => 'Tahun angkatan harus diisi!',
            'nim.required'              => 'NIM harus diisi!',
            'nim.numeric'               => 'NIM harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.unique'              => 'Email sudah digunakan!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'nim.unique'                => 'NIM sudah digunakan!',
            'password.required'         => 'Password harus diisi!',
            'password.min'              => 'Password minimal 6 karakter!',
            'foto_user.required'        => 'Foto Anda harus diisi!',
            'foto_user.mimes'           => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto_user.max'             => 'Ukuran Foto Anda maksimal 2 mb',
            'status_pengajuan.required' => 'Status pengajuan harus diisi!',
        ]);

        $file1 = Request()->foto_user;
        $fileUser = date('mdYHis') . ' ' . Request()->nama_mahasiswa . '.' . $file1->extension();
        $file1->move(public_path($this->public_path), $fileUser);

        $data = [
            'nama_mahasiswa'    => Request()->nama_mahasiswa,
            'prodi'             => Request()->prodi,
            'nomor_telepon'     => Request()->nomor_telepon,
            'tahun_angkatan'    => Request()->tahun_angkatan,
            'nim'               => Request()->nim,
            'email'             => Request()->email,
            'status_pengajuan'  => Request()->status_pengajuan,
            'foto_user'         => $fileUser,
            'password'          => Hash::make(Request()->password),
        ];

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan tambah mahasiswa dengan NIM ' . Request()->nim,
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelMahasiswa->tambah($data);
        return redirect()->route('daftar-mahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan !');
    }

    public function edit($id_mahasiswa)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $detail = $this->ModelMahasiswa->detail($id_mahasiswa);
        if ($detail->status_mahasiswa === 'Aktif') {
            $title = 'Data Mahasiswa';
            $subTitle = 'Edit Mahasiswa';
        } else {
            $title = 'Data Alumni';
            $subTitle = 'Edit Alumni';
        }

        $data = [
            'title'         => $title,
            'subTitle'      => $subTitle,
            'form'          => 'Edit',
            'dataUKT'       => $this->ModelKelompokUKT->dataKelompokUKT(),
            'user'          => $this->ModelUser->detail(Session()->get('id_user')),
            'dataProdi'     => $this->ModelMahasiswa->dataProdi(),
            'detail'        => $detail
        ];

        return view('bagianKeuangan.kelolaMahasiswa.form', $data);
    }

    public function prosesEdit($id_mahasiswa)
    {
        Request()->validate([
            'nama_mahasiswa'    => 'required',
            'prodi'             => 'required',
            'nomor_telepon'     => 'required',
            'tahun_angkatan'    => 'required',
            'nim'               => 'required|numeric',
            'email'             => 'required|unique:user,email|email',
            'foto_user'         => 'mimes:jpeg,png,jpg|max:2048',
            'status_pengajuan'  => 'required',
            'status_mahasiswa'  => 'required',
        ], [
            'nama_mahasiswa.required'   => 'Nama lengkap harus diisi!',
            'prodi.required'            => 'Program studi harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'tahun_angkatan.required'   => 'Tahun angkatan harus diisi!',
            'nim.required'              => 'Nim harus diisi!',
            'nim.numeric'               => 'Nim harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.unique'              => 'Email sudah digunakan!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'foto_user.mimes'           => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto_user.max'             => 'Ukuran Foto Anda maksimal 2 mb',
            'status_pengajuan.required' => 'Status pengajuan harus diisi!',
            'status_mahasiswa.required' => 'Status mahasiswa harus diisi!',
        ]);

        if (Request()->password) {

            $user = $this->ModelMahasiswa->detail($id_mahasiswa);

            if (Request()->foto_user <> "") {
                if ($user->foto_user <> "") {
                    unlink(public_path($this->public_path) . '/' . $user->foto_user);
                }

                $file = Request()->foto_user;
                $fileUser = date('mdYHis') . Request()->nama_mahasiswa . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileUser);

                $data = [
                    'id_mahasiswa'      => $id_mahasiswa,
                    'nama_mahasiswa'    => Request()->nama_mahasiswa,
                    'prodi'             => Request()->prodi,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'tahun_angkatan'    => Request()->tahun_angkatan,
                    'id_kelompok_ukt'    => Request()->id_kelompok_ukt,
                    'nim'               => Request()->nim,
                    'email'             => Request()->email,
                    'status_pengajuan'  => Request()->status_pengajuan,
                    'status_mahasiswa'  => Request()->status_mahasiswa,
                    'foto_user'         => $fileUser,
                    'password'          => Hash::make(Request()->password),
                ];
                $this->ModelMahasiswa->edit($data);
            } else {
                $data = [
                    'id_mahasiswa'      => $id_mahasiswa,
                    'nama_mahasiswa'    => Request()->nama_mahasiswa,
                    'prodi'             => Request()->prodi,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'tahun_angkatan'    => Request()->tahun_angkatan,
                    'id_kelompok_ukt'    => Request()->id_kelompok_ukt,
                    'nim'               => Request()->nim,
                    'email'             => Request()->email,
                    'status_pengajuan'  => Request()->status_pengajuan,
                    'status_mahasiswa'  => Request()->status_mahasiswa,
                    'password'          => Hash::make(Request()->password),
                ];
                $this->ModelMahasiswa->edit($data);
            }
        } else {
            $user = $this->ModelMahasiswa->detail($id_mahasiswa);

            if (Request()->foto_user <> "") {
                if ($user->foto_user <> "") {
                    unlink(public_path($this->public_path) . '/' . $user->foto_user);
                }

                $file = Request()->foto_user;
                $fileUser = date('mdYHis') . Request()->nama_mahasiswa . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileUser);

                $data = [
                    'id_mahasiswa'      => $id_mahasiswa,
                    'nama_mahasiswa'    => Request()->nama_mahasiswa,
                    'prodi'             => Request()->prodi,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'tahun_angkatan'    => Request()->tahun_angkatan,
                    'id_kelompok_ukt'    => Request()->id_kelompok_ukt,
                    'nim'               => Request()->nim,
                    'email'             => Request()->email,
                    'status_pengajuan'  => Request()->status_pengajuan,
                    'status_mahasiswa'  => Request()->status_mahasiswa,
                    'foto_user'         => $fileUser,
                ];
                $this->ModelMahasiswa->edit($data);
            } else {
                $data = [
                    'id_mahasiswa'      => $id_mahasiswa,
                    'nama_mahasiswa'    => Request()->nama_mahasiswa,
                    'prodi'             => Request()->prodi,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'tahun_angkatan'    => Request()->tahun_angkatan,
                    'id_kelompok_ukt'    => Request()->id_kelompok_ukt,
                    'nim'               => Request()->nim,
                    'email'             => Request()->email,
                    'status_pengajuan'  => Request()->status_pengajuan,
                    'status_mahasiswa'  => Request()->status_mahasiswa,
                ];
                $this->ModelMahasiswa->edit($data);
            }
        }

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan edit mahasiswa dengan NIM ' . Request()->nim,
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        return redirect()->route('daftar-mahasiswa')->with('success', 'Data mahasiswa berhasil diedit!');
    }

    public function prosesHapus($id_mahasiswa)
    {
        $user = $this->ModelMahasiswa->detail($id_mahasiswa);

        if ($user->foto_user <> "") {
            unlink(public_path($this->public_path) . '/' . $user->foto_user);
        }

        if ($user->status_mahasiswa === 'Aktif') {
            $route = 'daftar-mahasiswa';
        } else {
            $route = 'daftar-alumni';
        }

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan hapus mahasiswa dengan NIM ' . $user->nim,
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelMahasiswa->hapus($id_mahasiswa);
        return redirect()->route($route)->with('success', 'Data mahasiswa berhasil dihapus !');
    }

    public function profil()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'     => 'Profil',
            'subTitle'  => 'Edit Profil',
            'user'      => $this->ModelMahasiswa->detail(Session()->get('id_mahasiswa'))
        ];

        return view('mahasiswa.profil.dataProfil', $data);
    }

    public function prosesEditProfil($id_mahasiswa)
    {
        Request()->validate([
            'nama_mahasiswa'    => 'required',
            'nomor_telepon'     => 'required',
            'nim'               => 'required|numeric',
            'email'             => 'required|unique:user,email|email',
            'foto_user'         => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama_mahasiswa.required'   => 'Nama lengkap harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nim.required'              => 'Nim harus diisi!',
            'nim.numeric'               => 'Nim harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.unique'              => 'Email sudah digunakan!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'foto_user.mimes'           => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto_user.max'             => 'Ukuran Foto Anda maksimal 2 mb',
        ]);

        if (Request()->foto_user <> "") {

            $mahasiswa = $this->ModelMahasiswa->detail($id_mahasiswa);
            if ($mahasiswa->foto_user <> "") {
                unlink(public_path($this->public_path) . '/' . $mahasiswa->foto_user);
            }

            $file = Request()->foto_user;
            $fileName = date('mdYHis') . Request()->nama_mahasiswa . '.' . $file->extension();
            $file->move(public_path($this->public_path), $fileName);

            $data = [
                'id_mahasiswa'      => $id_mahasiswa,
                'nama_mahasiswa'    => Request()->nama_mahasiswa,
                'nomor_telepon'     => Request()->nomor_telepon,
                'nim'               => Request()->nim,
                'email'             => Request()->email,
                'foto_user'         => $fileName,
            ];
        } else {
            $data = [
                'id_mahasiswa'      => $id_mahasiswa,
                'nama_mahasiswa'    => Request()->nama_mahasiswa,
                'nomor_telepon'     => Request()->nomor_telepon,
                'nim'               => Request()->nim,
                'email'             => Request()->email,
            ];
        }

        // log
        $dataLog = [
            'id_mahasiswa'  => Session()->get('id_mahasiswa'),
            'keterangan'    => 'Melakukan edit profil',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelMahasiswa->edit($data);
        return redirect()->route('profil-mahasiswa')->with('success', 'Profil berhasil diedit !');
    }

    public function ubahPassword()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }


        $data = [
            'title'     => 'Profil',
            'subTitle'  => 'Ubah Password',
            'user'      => $this->ModelMahasiswa->detail(Session()->get('id_mahasiswa'))
        ];

        return view('mahasiswa.profil.ubahPassword', $data);
    }

    public function prosesUbahPassword($id_mahasiswa)
    {
        Request()->validate([
            'password_lama'     => 'required|min:6',
            'password_baru'     => 'required|min:6',
        ], [
            'password_lama.required'    => 'Password Lama harus diisi!',
            'password_lama.min'         => 'Password Lama minimal 6 karakter!',
            'password_baru.required'    => 'Passwofd Baru harus diisi!',
            'password_baru.min'         => 'Password Lama minimal 6 karakter!',
        ]);

        $user = $this->ModelMahasiswa->detail($id_mahasiswa);

        if (Hash::check(Request()->password_lama, $user->password)) {
            $data = [
                'id_mahasiswa'      => $id_mahasiswa,
                'password'          => Hash::make(Request()->password_baru)
            ];

            $this->ModelMahasiswa->edit($data);
            return back()->with('success', 'Password berhasil diubah !');
        } else {
            return back()->with('fail', 'Password Lama tidak sesuai.');
        }
    }

    public function prosesImport()
    {
        if (!Session()->get('email')) {
            return redirect()->route('admin');
        }

        $file = Request()->file('file');

        Excel::import(new Mahasiswa, $file);

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diimport!');
    }

    public function unduhFormatExcel()
    {
        if (!Session()->get('email')) {
            return redirect()->route('login');
        }

        // dd('masuk');
        $filepath = 'Data Mahasiswa.xlsx';
        return response()->download(public_path('gambar') . '/' . $filepath);
    }

    public function alumni()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'             => 'Data Mahasiswa',
            'subTitle'          => 'Daftar Alumni',
            'tahunAngkatan'     => null,
            'daftarMahasiswa'   => $this->ModelMahasiswa->dataMahasiswa(),
            'dataTahunAngkatan' => $this->ModelMahasiswa->dataTahunAngkatan(),
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
        ];

        return view('bagianKeuangan.kelolaMahasiswa.dataAlumni', $data);
    }
}
