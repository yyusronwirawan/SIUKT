<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelKriteria;
use App\Models\ModelUser;
use App\Models\ModelLog;

class Kriteria extends Controller
{

    private $ModelKriteria;
    private $ModelUser;
    private $ModelLog;

    public function __construct()
    {
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
            'title'             => 'Data Kriteria',
            'subTitle'          => 'Daftar Kriteria',
            'daftarKriteria'    => $this->ModelKriteria->dataKriteria(),
            'totalBobot'        => $this->ModelKriteria->totalBobot(),
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
        ];

        return view('bagianKeuangan.kriteria.dataKriteria', $data);
    }

    public function tambah()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'     => 'Data Kriteria',
            'subTitle'  => 'Tambah Kriteria',
            'user'      => $this->ModelUser->detail(Session()->get('id_user')),
            'form'      => 'Tambah',
        ];

        return view('bagianKeuangan.kriteria.form', $data);
    }

    public function prosesTambah()
    {
        Request()->validate([
            'nama_kriteria'   => 'required',
            'bobot'           => 'required|numeric',
        ], [
            'nama_kriteria.required'  => 'Kriteria harus diisi!',
            'bobot.required'          => 'Bobot harus diisi!',
            'bobot.numeric'           => 'Bobot harus angka!',
        ]);


        $bobot = Request()->bobot / 100;
        $totalBobot = $this->ModelKriteria->totalBobot();
        $kurangBobot = 1 - $totalBobot;

        if ($totalBobot < 1) {
            if ($bobot < $kurangBobot + 0.1) {
                $data = [
                    'nama_kriteria' => Request()->nama_kriteria,
                    'bobot'         => $bobot,
                    'ideal'         => Request()->ideal,
                ];

                // log
                $dataLog = [
                    'id_user'      => Session()->get('id_user'),
                    'keterangan'    => 'Melakukan tambah Kriteria',
                    'status_user'   => session()->get('status')
                ];
                $this->ModelLog->tambah($dataLog);
                // end log

                $this->ModelKriteria->tambah($data);
                return redirect()->route('daftar-kriteria')->with('success', 'Data Kriteria berhasil ditambahkan !');
            } else {
                return back()->with('fail', 'Total bobot harus 1!');
            }
        } else {
            return back()->with('fail', 'Total bobot sudah 1!');
        }
    }

    public function edit($id_kriteria)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'         => 'Data Kriteria',
            'subTitle'      => 'Edit Kriteria',
            'form'          => 'Edit',
            'user'          => $this->ModelUser->detail(Session()->get('id_user')),
            'detail'        => $this->ModelKriteria->detail($id_kriteria)
        ];

        return view('bagianKeuangan.kriteria.form', $data);
    }

    public function prosesEdit($id_kriteria)
    {
        Request()->validate([
            'nama_kriteria'   => 'required',
            'bobot'           => 'required|numeric',
        ], [
            'nama_kriteria.required'  => 'Kriteria harus diisi!',
            'bobot.required'          => 'Bobot harus diisi!',
            'bobot.numeric'           => 'Bobot harus angka!',
        ]);

        $kriteria = $this->ModelKriteria->detail($id_kriteria);
        $bobot = Request()->bobot / 100;
        $totalBobot = $this->ModelKriteria->totalBobot() - $kriteria->bobot;
        $kurangBobot = 1 - $totalBobot;

        if ($totalBobot < 1) {
            if ($bobot < $kurangBobot + 0.1) {
                $data = [
                    'id_kriteria'   => $id_kriteria,
                    'nama_kriteria' => Request()->nama_kriteria,
                    'ideal'         => Request()->ideal,
                    'bobot'         => $bobot,
                ];

                // log
                $dataLog = [
                    'id_user'      => Session()->get('id_user'),
                    'keterangan'    => 'Melakukan edit Kriteria',
                    'status_user'   => session()->get('status')
                ];
                $this->ModelLog->tambah($dataLog);
                // end log

                $this->ModelKriteria->edit($data);
                return redirect()->route('daftar-kriteria')->with('success', 'Data Kriteria berhasil diedit !');
            } else {
                return back()->with('fail', 'Total bobot harus 1!');
            }
        } else {
            return back()->with('fail', 'Total bobot sudah 1!');
        }
    }

    public function prosesHapus($id_kriteria)
    {

        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan hapus Kriteria',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelKriteria->hapus($id_kriteria);
        return redirect()->route('daftar-kriteria')->with('success', 'Data Kriteria berhasil dihapus !');
    }
}
