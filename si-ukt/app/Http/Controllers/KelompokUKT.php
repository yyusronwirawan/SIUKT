<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelKelompokUKT;
use App\Models\ModelUser;
use App\Models\ModelLog;

class KelompokUKT extends Controller
{

    private $ModelKelompokUKT;
    private $ModelUser;
    private $ModelLog;

    public function __construct()
    {
        $this->ModelKelompokUKT = new ModelKelompokUKT();
        $this->ModelUser = new ModelUser();
        $this->ModelLog = new ModelLog();
    }

    public function index()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'             => 'Data Kelompok UKT',
            'subTitle'          => 'Daftar Kelompok UKT',
            'daftarKelompokUKT' => $this->ModelKelompokUKT->dataKelompokUKT(),
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
        ];

        return view('bagianKeuangan.kelompokUKT.dataKelompokUKT', $data);
    }

    public function tambah()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'     => 'Data Kelompok UKT',
            'subTitle'  => 'Tambah Kelompok UKT',
            'user'      => $this->ModelUser->detail(Session()->get('id_user')),
            'form'      => 'Tambah',
        ];

        return view('bagianKeuangan.kelompokUKT.form', $data);
    }

    public function prosesTambah()
    {
        Request()->validate([
            'kelompok_ukt'      => 'required|numeric',
            'program_studi'     => 'required',
            'nominal'           => 'required|numeric',
        ], [
            'kelompok_ukt.required'     => 'Kelompok UKT harus diisi!',
            'kelompok_ukt.numeric'      => 'Kelompok UKT harus angka!',
            'program_studi.required'    => 'Program Studi harus diisi!',
            'nominal.required'          => 'Nominal harus diisi!',
            'nominal.numeric'           => 'Nominal harus angka!',
        ]);

        $data = [
            'kelompok_ukt'      => Request()->kelompok_ukt,
            'program_studi'     => Request()->program_studi,
            'nominal'           => Request()->nominal,
        ];

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan tambah Kelompok UKT ' . Request()->kelompok_ukt . ' dengan nominal Rp ' . number_format(Request()->nominal, 0, ',', '.'),
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelKelompokUKT->tambah($data);
        return redirect()->route('daftar-kelompok-ukt')->with('success', 'Data kelompok UKT berhasil ditambahkan !');
    }

    public function edit($id_kelompok_ukt)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'         => 'Data Kelompok UKT',
            'subTitle'      => 'Edit Kelompok UKT',
            'form'          => 'Edit',
            'user'          => $this->ModelUser->detail(Session()->get('id_user')),
            'detail'        => $this->ModelKelompokUKT->detail($id_kelompok_ukt)
        ];

        return view('bagianKeuangan.kelompokUKT.form', $data);
    }

    public function prosesEdit($id_kelompok_ukt)
    {
        Request()->validate([
            'kelompok_ukt'      => 'required|numeric',
            'program_studi'     => 'required',
            'nominal'           => 'required|numeric',
        ], [
            'kelompok_ukt.required'     => 'Kelompok UKT harus diisi!',
            'kelompok_ukt.numeric'      => 'Kelompok UKT harus angka!',
            'kelompok_ukt.unique'       => 'Kelompok UKT sudah digunakan!',
            'program_studi.required'    => 'Program Studi harus diisi!',
            'nominal.required'          => 'Nominal harus diisi!',
            'nominal.numeric'           => 'Nominal harus angka!',
        ]);

        $data = [
            'id_kelompok_ukt'   => $id_kelompok_ukt,
            'kelompok_ukt'      => Request()->kelompok_ukt,
            'nominal'           => Request()->nominal,
        ];

        $this->ModelKelompokUKT->edit($data);

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan edit Kelompok UKT ' . Request()->kelompok_ukt . ' dengan nominal Rp ' . number_format(Request()->nominal, 0, ',', '.'),
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        return redirect()->route('daftar-kelompok-ukt')->with('success', 'Data kelompok UKT berhasil diedit!');
    }

    public function prosesHapus($id_kelompok_ukt)
    {

        $detail = $this->ModelKelompokUKT->detail($id_kelompok_ukt);

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan hapus Kelompok UKT ' . $detail->kelompok_ukt . ' dengan nominal Rp ' . number_format($detail->nominal, 0, ',', '.'),
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelKelompokUKT->hapus($id_kelompok_ukt);
        return redirect()->route('daftar-kelompok-ukt')->with('success', 'Data kelompok UKT berhasil dihapus !');
    }
}
