<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use App\Models\ModelLog;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{

    private $ModelUser;
    private $ModelLog;
    private $public_path;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelLog = new ModelLog();
        $this->public_path = 'foto_user';
    }

    public function index()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'             => 'Data User',
            'subTitle'          => 'Daftar User',
            'daftarUser'        => $this->ModelUser->dataUser(),
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
        ];

        return view('bagianKeuangan.user.dataUser', $data);
    }

    public function tambah()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'     => 'Data User',
            'subTitle'  => 'Tambah User',
            'user'      => $this->ModelUser->detail(Session()->get('id_user')),
            'form'      => 'Tambah',
        ];

        return view('bagianKeuangan.user.form', $data);
    }

    public function prosesTambah()
    {
        Request()->validate([
            'nama_user'         => 'required',
            'nomor_telepon'     => 'required',
            'nik'               => 'required|numeric|unique:user,nik',
            'email'             => 'required|unique:user,email|unique:user,email|email',
            'password'          => 'min:6|required',
            'status'            => 'required',
            'foto_user'         => 'required|mimes:jpeg,png,jpg|max:2048'
        ], [
            'nama_user.required'        => 'Nama lengkap harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nik.required'              => 'NIK.NIP harus diisi!',
            'nik.numeric'               => 'NIK/NIP harus angka!',
            'nik.unique'                => 'nik sudah digunakan!',
            'email.required'            => 'Email harus diisi!',
            'email.unique'              => 'Email sudah digunakan!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'password.required'         => 'Password harus diisi!',
            'password.min'              => 'Password minikal 6 karakter!',
            'status.required'           => 'Role harus diisi!',
            'foto_user.required'        => 'Foto Anda harus diisi!',
            'foto_user.mimes'           => 'Format Foto User harus jpg/jpeg/png!',
            'foto_user.max'             => 'Ukuran Foto User maksimal 2 mb',
        ]);

        $file1 = Request()->foto_user;
        $fileUser = date('mdYHis') . ' ' . Request()->nama_user . '.' . $file1->extension();
        $file1->move(public_path($this->public_path), $fileUser);

        $data = [
            'nama_user'         => Request()->nama_user,
            'nomor_telepon'     => Request()->nomor_telepon,
            'nik'               => Request()->nik,
            'email'             => Request()->email,
            'foto_user'         => $fileUser,
            'status'            => Request()->status,
            'password'          => Hash::make(Request()->password),
        ];

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'   => 'Melakukan tambah user dengan role ' . Request()->role,
            'status_user'  => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelUser->tambah($data);
        return redirect()->route('daftar-user')->with('success', 'Data user berhasil ditambahkan !');
    }

    public function edit($id_user)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'         => 'Data User',
            'subTitle'      => 'Edit User',
            'form'          => 'Edit',
            'user'          => $this->ModelUser->detail(Session()->get('id_user')),
            'detail'        => $this->ModelUser->detail($id_user)
        ];

        return view('bagianKeuangan.user.form', $data);
    }

    public function prosesEdit($id_user)
    {
        Request()->validate([
            'nama_user'    => 'required',
            'nomor_telepon'     => 'required',
            'nik'               => 'required|numeric',
            'email'             => 'required|unique:mahasiswa,email|email',
            'status'            => 'required',
            'foto_user'         => 'mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_user.required'   => 'Nama lengkap harus diisi!',
            'nomor_telepon.required'    => 'Nomor telepon harus diisi!',
            'nik.required'              => 'NIK/NIP harus diisi!',
            'nik.numeric'               => 'NIK/NIP harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.unique'              => 'Email sudah digunakan!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'status.required'           => 'Role harus diisi!',
            'foto_user.mimes'           => 'Format Foto User harus jpg/jpeg/png!',
            'foto_user.max'             => 'Ukuran Foto User maksimal 2 mb',
        ]);

        if (Request()->password) {

            $user = $this->ModelUser->detail($id_user);

            if (Request()->foto_user <> "") {
                if ($user->foto_user <> "") {
                    unlink(public_path($this->public_path) . '/' . $user->foto_user);
                }

                $file = Request()->foto_user;
                $fileUser = date('mdYHis') . Request()->nama_user . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileUser);

                $data = [
                    'id_user'           => $id_user,
                    'nama_user'         => Request()->nama_user,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'nik'               => Request()->nik,
                    'email'             => Request()->email,
                    'status'            => Request()->status,
                    'foto_user'         => $fileUser,
                    'password'          => Hash::make(Request()->password),
                ];
                $this->ModelUser->edit($data);
            } else {
                $data = [
                    'id_user'           => $id_user,
                    'nama_user'         => Request()->nama_user,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'nik'               => Request()->nik,
                    'email'             => Request()->email,
                    'status'            => Request()->status,
                    'password'          => Hash::make(Request()->password),
                ];
                $this->ModelUser->edit($data);
            }
        } else {
            $user = $this->ModelUser->detail($id_user);

            if (Request()->foto_user <> "") {
                if ($user->foto_user <> "") {
                    unlink(public_path($this->public_path) . '/' . $user->foto_user);
                }

                $file = Request()->foto_user;
                $fileUser = date('mdYHis') . Request()->nama_user . '.' . $file->extension();
                $file->move(public_path($this->public_path), $fileUser);

                $data = [
                    'id_user'           => $id_user,
                    'nama_user'         => Request()->nama_user,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'nik'               => Request()->nik,
                    'email'             => Request()->email,
                    'status'            => Request()->status,
                    'foto_user'         => $fileUser,
                ];
                $this->ModelUser->edit($data);
            } else {
                $data = [
                    'id_user'           => $id_user,
                    'nama_user'         => Request()->nama_user,
                    'nomor_telepon'     => Request()->nomor_telepon,
                    'nik'               => Request()->nik,
                    'email'             => Request()->email,
                    'status'            => Request()->status,
                ];
                $this->ModelUser->edit($data);
            }
        }

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan edit user dengan role ' . Request()->role,
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        return redirect()->route('daftar-user')->with('success', 'Data user berhasil diedit!');
    }

    public function prosesHapus($id_user)
    {
        $user = $this->ModelUser->detail($id_user);

        if ($user->foto_user <> "") {
            unlink(public_path($this->public_path) . '/' . $user->foto_user);
        }

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan hapus user dengan role ' . Request()->role,
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelUser->hapus($id_user);
        return redirect()->route('daftar-user')->with('success', 'Data user berhasil dihapus !');
    }

    public function profil()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'     => 'Profil',
            'subTitle'  => 'Edit Profil',
            'user'      => $this->ModelUser->detail(Session()->get('id_user'))
        ];

        return view('profil.dataProfil', $data);
    }

    public function prosesEditProfil($id_user)
    {
        Request()->validate([
            'nama_user'         => 'required',
            'nik'               => 'required|numeric',
            'nomor_telepon'     => 'required|numeric',
            'email'             => 'required|unique:mahasiswa,email|email',
            'foto_user'         => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama_user.required'        => 'Nama lengkap harus diisi!',
            'nik.required'              => 'NIP/NIK harus diisi!',
            'nik.numeric'               => 'NIP/NIK harus angka!',
            'nomor_telepon.required'    => 'Nomor Telepon harus diisi!',
            'nomor_telepon.numeric'     => 'Nomor Telepon harus angka!',
            'email.required'            => 'Email harus diisi!',
            'email.unique'              => 'Email sudah digunakan!',
            'email.email'               => 'Email harus sesuai format! Contoh: contoh@gmail.com',
            'foto_user.mimes'           => 'Format Foto Anda harus jpg/jpeg/png!',
            'foto_user.max'             => 'Ukuran Foto Anda maksimal 2 mb',
        ]);

        if (Request()->foto_user <> "") {
            $user = $this->ModelUser->detail($id_user);
            if ($user->foto_user <> "") {
                unlink(public_path($this->public_path) . '/' . $user->foto_user);
            }

            $file = Request()->foto_user;
            $fileName = date('mdYHis') . ' ' . Request()->nama_user . '.' . $file->extension();
            $file->move(public_path($this->public_path), $fileName);

            $data = [
                'id_user'          => $id_user,
                'nama_user'        => Request()->nama_user,
                'nik'               => Request()->nik,
                'nomor_telepon'     => Request()->nomor_telepon,
                'email'             => Request()->email,
                'foto_user'         => $fileName,
            ];
        } else {
            $data = [
                'id_user'          => $id_user,
                'nama_user'        => Request()->nama_user,
                'nik'               => Request()->nik,
                'nomor_telepon'     => Request()->nomor_telepon,
                'email'             => Request()->email,
            ];
        }

        // log
        $dataLog = [
            'id_user'       => Session()->get('id_user'),
            'keterangan'    => 'Melakukan edit profil',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelUser->edit($data);
        return redirect()->route('profil')->with('success', 'Profil berhasil diedit !');
    }

    public function ubahPassword()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'     => 'Profil',
            'subTitle'  => 'Ubah Password',
            'user'      => $this->ModelUser->detail(Session()->get('id_user'))
        ];

        return view('profil.ubahPassword', $data);
    }

    public function prosesUbahPassword($id_user)
    {
        Request()->validate([
            'password_lama'     => 'required|min:6',
            'password_baru'     => 'required|min:6',
        ], [
            'password_lama.required'    => 'Password Lama harus diisi!',
            'password_lama.min'         => 'Password Lama minikal 6 karakter!',
            'password_baru.required'    => 'Password Baru harus diisi!',
            'password_baru.min'         => 'Password Lama minikal 6 karakter!',
        ]);

        $user = $this->ModelUser->detail($id_user);

        if (Hash::check(Request()->password_lama, $user->password)) {
            $data = [
                'id_user'         => $id_user,
                'password'         => Hash::make(Request()->password_baru)
            ];

            $this->ModelUser->edit($data);
            return back()->with('success', 'Password berhasil diubah !');
        } else {
            return back()->with('fail', 'Password Lama tidak sesuai.');
        }
    }
}
