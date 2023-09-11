<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelKelompokUKT;
use App\Models\ModelNilaiKriteria;
use App\Models\ModelKriteria;
use App\Models\ModelUser;
use App\Models\ModelLog;

class NilaiKriteria extends Controller
{

    private $ModelKelompokUKT;
    private $ModelNilaiKriteria;
    private $ModelKriteria;
    private $ModelUser;
    private $ModelLog;

    public function __construct()
    {
        $this->ModelKelompokUKT = new ModelKelompokUKT();
        $this->ModelNilaiKriteria = new ModelNilaiKriteria();
        $this->ModelKriteria = new ModelKriteria();
        $this->ModelUser = new ModelUser();
        $this->ModelLog = new ModelLog();
    }

    public function index()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'                 => 'Data Nilai Kriteria',
            'subTitle'              => 'Daftar Nilai Kriteria',
            'daftarNilaiKriteria'   => $this->ModelNilaiKriteria->dataNilaiKriteria(),
            'user'                  => $this->ModelUser->detail(Session()->get('id_user')),
        ];

        return view('bagianKeuangan.nilaiKriteria.dataNilaiKriteria', $data);
    }

    public function tambah()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'     => 'Data Nilai Kriteria',
            'subTitle'  => 'Tambah Nilai Kriteria',
            'user'      => $this->ModelUser->detail(Session()->get('id_user')),
            'kriteria'  => $this->ModelKriteria->dataKriteria(),
            'dataUKT'   => $this->ModelKelompokUKT->dataKelompokUKTPerSelect(),
            'form'      => 'Tambah',
        ];

        return view('bagianKeuangan.nilaiKriteria.form', $data);
    }

    public function prosesTambah()
    {
        Request()->validate([
            'id_kriteria'       => 'required',
            'nilai_kriteria'    => 'required',
            'ukt'               => 'required|numeric',
        ], [
            'id_kriteria.required'    => 'Kriteria harus diisi!',
            'nilai_kriteria.required' => 'Nilai Kriteria harus diisi!',
            'ukt.required'            => 'UKT harus diisi!',
            'ukt.numeric'             => 'UKT harus angka!',
        ]);

        $data = [
            'id_kriteria'       => Request()->id_kriteria,
            'nilai_kriteria'    => Request()->nilai_kriteria,
            'ukt'               => Request()->ukt,
        ];

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan tambah nilai kriteria',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelNilaiKriteria->tambah($data);
        return redirect()->route('daftar-nilai-kriteria')->with('success', 'Data nilai kriteria berhasil ditambahkan!');
    }

    public function edit($id_nilai_kriteria)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'         => 'Data Nilai Kriteria',
            'subTitle'      => 'Edit Nilai Kriteria',
            'form'          => 'Edit',
            'user'          => $this->ModelUser->detail(Session()->get('id_user')),
            'detail'        => $this->ModelNilaiKriteria->detail($id_nilai_kriteria),
            'kriteria'      => $this->ModelKriteria->dataKriteria(),
            'dataUKT'       => $this->ModelKelompokUKT->dataKelompokUKTPerSelect(),
        ];

        return view('bagianKeuangan.nilaiKriteria.form', $data);
    }

    public function prosesEdit($id_nilai_kriteria)
    {
        Request()->validate([
            'id_kriteria'       => 'required',
            'nilai_kriteria'    => 'required',
            'ukt'               => 'required|numeric',
        ], [
            'id_kriteria.required'    => 'Kriteria harus diisi!',
            'nilai_kriteria.required' => 'Nilai Kriteria harus diisi!',
            'ukt.required'            => 'UKT harus diisi!',
            'ukt.numeric'             => 'UKT harus angka!',
        ]);

        $data = [
            'id_nilai_kriteria' => $id_nilai_kriteria,
            'id_kriteria'       => Request()->id_kriteria,
            'nilai_kriteria'    => Request()->nilai_kriteria,
            'ukt'               => Request()->ukt,
        ];

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan edit nilai kriteria',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelNilaiKriteria->edit($data);
        return redirect()->route('daftar-nilai-kriteria')->with('success', 'Data nilai kriteria berhasil diedit!');
    }

    public function prosesHapus($id_nilai_kriteria)
    {

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan hapus nilai kriteria',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelNilaiKriteria->hapus($id_nilai_kriteria);
        return redirect()->route('daftar-nilai-kriteria')->with('success', 'Data nilai kriteria berhasil dihapus!');
    }
}
