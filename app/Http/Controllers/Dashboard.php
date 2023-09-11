<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use App\Models\ModelMahasiswa;
use App\Models\ModelPenurunanUKT;
use App\Models\ModelPenangguhanUKT;
use App\Models\ModelPenentuanUKT;
use App\Models\ModelKelompokUKT;

class Dashboard extends Controller
{

    private $ModelMahasiswa;
    private $ModelUser;
    private $ModelPenurunanUKT;
    private $ModelPenangguhanUKT;
    private $ModelPenentuanUKT;
    private $ModelKelompokUKT;

    public function __construct()
    {
        $this->ModelMahasiswa = new ModelMahasiswa();
        $this->ModelUser = new ModelUser();
        $this->ModelPenurunanUKT = new ModelPenurunanUKT();
        $this->ModelPenangguhanUKT = new ModelPenangguhanUKT();
        $this->ModelPenentuanUKT = new ModelPenentuanUKT();
        $this->ModelKelompokUKT = new ModelKelompokUKT();
    }

    public function index()
    {

        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $status = Session()->get('status');

        if ($status === 'Bagian Keuangan') {
            $route = 'bagianKeuangan.dashboard';
            $user = $this->ModelUser->detail(Session()->get('id_user'));

            $data = [
                'title'                 => null,
                'user'                  => $user,
                'totalAlumni'           => $this->ModelMahasiswa->jumlah('Tidak Aktif'),
                'totalMahasiswa'        => $this->ModelMahasiswa->jumlah('Aktif'),
                'totalPenentuan'        => $this->ModelPenentuanUKT->jumlah('Proses'),
                'totalPenurunan'        => $this->ModelPenurunanUKT->jumlah('Proses di Bagian Keuangan'),
                'totalPenangguhan'      => $this->ModelPenangguhanUKT->jumlah('Proses di Bagian Keuangan'),
                'subTitle'              => 'Dashboard',
            ];
        } elseif ($status === 'Mahasiswa') {
            $route = 'mahasiswa.dashboard';
            $user = $this->ModelMahasiswa->detail(Session()->get('id_mahasiswa'));

            $data = [
                'title'                 => null,
                'user'                  => $user,
                'detailPenurunanUKT'    => $this->ModelPenurunanUKT->detailByMahasiswa(Session()->get('id_mahasiswa')),
                'subTitle'              => 'Dashboard',
            ];
        } elseif ($status === 'Akademik') {
            $route = 'akademik.dashboard';
            $user = $this->ModelUser->detail(Session()->get('id_user'));

            $data = [
                'title'                 => null,
                'user'                  => $user,
                'totalAlumni'           => $this->ModelMahasiswa->jumlah('Tidak Aktif'),
                'totalMahasiswa'        => $this->ModelMahasiswa->jumlah('Aktif'),
                'totalKelompokUKT'      => 8,
                'subTitle'              => 'Dashboard',
            ];
        } elseif ($status === 'Kabag Umum & Akademik') {
            $route = 'kepalaBagian.dashboard';
            $user = $this->ModelUser->detail(Session()->get('id_user'));

            $data = [
                'title'                 => null,
                'user'                  => $user,
                'totalApprovePenurunan' => $this->ModelPenurunanUKT->jumlah('Proses di Kepala Bagian'),
                'totalApprovePenangguhan' => $this->ModelPenangguhanUKT->jumlah('Proses di Kepala Bagian'),
                'totalKelompokUKT'      => 8,
                'subTitle'              => 'Dashboard',
            ];
        }

        return view($route, $data);
    }
}
