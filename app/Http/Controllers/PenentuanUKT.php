<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelMahasiswa;
use App\Models\ModelUser;
use App\Models\ModelLog;
use App\Models\ModelPenentuanUKT;
use App\Models\ModelSetting;
use App\Models\ModelKriteria;
use App\Models\ModelNilaiKriteria;
use App\Models\ModelKelompokUKT;
use PDF;
use Twilio\Rest\Client;

class PenentuanUKT extends Controller
{

    private $ModelMahasiswa;
    private $ModelUser;
    private $ModelLog;
    private $ModelPenentuanUKT;
    private $ModelSetting;
    private $ModelKriteria;
    private $ModelNilaiKriteria;
    private $ModelKelompokUKT;
    private $public_path_gaji, $public_path_listrik, $public_path_air, $public_path_kk;

    public function __construct()
    {
        $this->ModelMahasiswa = new ModelMahasiswa();
        $this->ModelUser = new ModelUser();
        $this->ModelLog = new ModelLog();
        $this->ModelPenentuanUKT = new ModelPenentuanUKT();
        $this->ModelSetting = new ModelSetting();
        $this->ModelKriteria = new ModelKriteria();
        $this->ModelNilaiKriteria = new ModelNilaiKriteria();
        $this->ModelKelompokUKT = new ModelKelompokUKT();
        $this->public_path_gaji = 'dokumen_penentuan_ukt/slip_gaji';
        $this->public_path_listrik = 'dokumen_penentuan_ukt/rekening_listrik';
        $this->public_path_air = 'dokumen_penentuan_ukt/rekening_air';
        $this->public_path_kk = 'dokumen_penentuan_ukt/kk';
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if (!Session()->get('status')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Penentuan UKT',
            'subTitle'          => 'Proses Penentuan UKT',
            'form'              => 'Tambah',
            'setting'           => $this->ModelSetting->dataSetting(),
            'kriteria'          => $this->ModelKriteria->dataKriteria(),
            'nilaiKriteria'     => $this->ModelNilaiKriteria->dataNilaiKriteria(),
            'dataPenentuanUKT'  => $this->ModelPenentuanUKT->detailByMahasiswa(Session()->get('id_mahasiswa')),
            'user'              => $this->ModelMahasiswa->detail(Session()->get('id_mahasiswa')),
        ];

        return view('mahasiswa.penentuanUKT.formPenentuan', $data);
    }

    public function prosesPenentuan()
    {

        // TOPSIS

        $jumlahKriteria = $this->ModelKriteria->jumlahKriteria();
        for ($i = $jumlahKriteria; $i > 0; $i--) {
            // id_kriteria
            $id_kriteria[$i] = Request()->{"id_kriteria" . $i};
            // Nilai Kriteria
            $nama_kriteria[$i] = Request()->{"nama_kriteria" . $i};
            // bobot
            $bobot[$i] = Request()->{"bobot" . $i};
            // bobot
            $ideal[$i] = Request()->{"ideal" . $i};

            // Nilai Kriteria
            $kriteria[$i] = Request()->{"nilai_kriteria" . $i};
            $kata = explode(";", $kriteria[$i]);

            // Hasil Nikai Kriteria
            $data_nilai_kriteria[$i] = $kata[1];

            // Nilai Target
            $nilai_target[$i] = $kata[0];

            // Nilai Kriteria
            $nilai_kriteria[$i]   = $this->ModelNilaiKriteria->dataNilaiKriteriaBykriteria($id_kriteria[$i]);

            // hasil gap
            $gap = [];
            foreach ($nilai_kriteria[$i] as $item[$i]) {
                $gap[] = intval($item[$i]->ukt) - intval($nilai_target[$i]);
            }
            $hasil_gap[$i] = $gap;

            // nilai bobot dari hasil gap
            $bobot_hasil_gap = [];
            foreach ($hasil_gap[$i] as $row) {
                switch ($row) {
                    case 0:
                        $nilai_hasil = 8;
                        break;
                    case 1:
                        $nilai_hasil = 7.5;
                        break;
                    case -1:
                        $nilai_hasil = 7;
                        break;
                    case 2:
                        $nilai_hasil = 6.5;
                        break;
                    case -2:
                        $nilai_hasil = 6;
                        break;
                    case 3:
                        $nilai_hasil = 5.5;
                        break;
                    case -3:
                        $nilai_hasil = 5;
                        break;
                    case 4:
                        $nilai_hasil = 4.5;
                        break;
                    case -4:
                        $nilai_hasil = 4;
                        break;
                    case 5:
                        $nilai_hasil = 3.5;
                        break;
                    case -5:
                        $nilai_hasil = 3;
                        break;
                    case 6:
                        $nilai_hasil = 2.5;
                        break;
                    case -6:
                        $nilai_hasil = 2;
                        break;
                    case 7:
                        $nilai_hasil = 1.5;
                        break;
                    case -7:
                        $nilai_hasil = 1;
                        break;
                }

                $bobot_hasil_gap[] = $nilai_hasil;
            }
            $nilai_bobot_hasil_gap[$i] = $bobot_hasil_gap;

            // pembagi
            $pem = null;
            foreach ($nilai_bobot_hasil_gap[$i] as $row) {
                $pem = $pem + pow($row, 2);
            }
            $pembagi[$i] = sqrt($pem);

            // normalisasi keputusan
            $normalisasi = [];
            foreach ($nilai_bobot_hasil_gap[$i] as $row) {
                $normalisasi[] = $row / $pembagi[$i];
            }
            $normalisasi_keputusan[$i] = $normalisasi;

            // normalisasi bobot
            $bobot_normal = [];
            foreach ($normalisasi_keputusan[$i] as $row) {
                $bobot_normal[] = $row * $bobot[$i];
            }
            $normalisasi_bobot[$i] = $bobot_normal;

            // ideal positif negatif
            // $positif = max($normalisasi_bobot[$i]);
            $positif = [];
            $negatif = [];
            if ($ideal[$i] == 'Benefit') {
                $positif[] = max($normalisasi_bobot[$i]);
                $negatif[] = min($normalisasi_bobot[$i]);
            } else {
                $positif[] = min($normalisasi_bobot[$i]);
                $negatif[] = max($normalisasi_bobot[$i]);
            }
            $ideal_positif[$i] = $positif;
            $ideal_negatif[$i] = $negatif;
        }

        $jumlahNormalBobot = count($normalisasi_bobot[1]);

        // keputusan pemisahan = ideal positif = D+
        for ($i = 0; $i < $jumlahNormalBobot; $i++) {
            $d = 0;
            for ($j = $jumlahKriteria; $j > 0; $j--) {
                $d = $d + pow($ideal_positif[$j][0] - $normalisasi_bobot[$j][$i], 2);
            }
            $hasil_ideal_positif[] = sqrt($d);
        }

        // keputusan pemisahan = ideal positif = D+
        for ($i = 0; $i < $jumlahNormalBobot; $i++) {
            $d = 0;
            for ($j = $jumlahKriteria; $j > 0; $j--) {
                $d = $d + pow($ideal_negatif[$j][0] - $normalisasi_bobot[$j][$i], 2);
            }
            $hasil_ideal_negatif[] = sqrt($d);
        }

        // PREFERENSI
        $preferensi = [];
        for ($i = 0; $i < $jumlahNormalBobot; $i++) {
            $preferensi[] = $hasil_ideal_negatif[$i] / ($hasil_ideal_negatif[$i] + $hasil_ideal_positif[$i]);
        }
        $hasil_preferensi[] = $preferensi;

        $rank[] = $hasil_preferensi[0];

        $n = count($rank[0]);

        // RANKING
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($rank[0][$j] > $rank[0][$j + 1]) {
                    // Swap elements
                    $temp = $rank[0][$j];
                    $rank[0][$j] = $rank[0][$j + 1];
                    $rank[0][$j + 1] = $temp;
                }
            }
        }

        $ranking_ukt = null;
        for ($i = $jumlahNormalBobot - 1; $i > -1; $i--) {
            for ($j = 0; $j < $jumlahNormalBobot; $j++) {
                if ($hasil_preferensi[0][$j] == $rank[0][$i]) {
                    $ranking_ukt = $j;
                    break;
                }
            }
            $ranking[] = $ranking_ukt;
        }


        for ($i = 0; $i < $jumlahNormalBobot; $i++) {
            $ranking_final[$ranking[$i]] = $i;
        }

        for ($i = 0; $i < $jumlahNormalBobot; $i++) {
            $hasil[$i + 1]['Alternatif'] = $i + 1;
            $hasil[$i + 1]['Preferensi'] = $hasil_preferensi[0][$i];
            $hasil[$i + 1]['Ranking'] = $ranking_final[$i] + 1;
        }

        // TUTUP TOPSIS


        foreach ($hasil as $item) {
            if ($item['Ranking'] == 1) {
                $hasil_ukt = $item['Alternatif'];
            }
        }

        $setting = $this->ModelSetting->dataSetting();
        $mahasiswa = $this->ModelMahasiswa->detail(Session()->get('id_mahasiswa'));

        if ($setting->form_penentuan_slip_gaji == 1) {
            $fileSlipGaji = Request()->slip_gaji;
            $fileNameSlipGaji = date('mdYHis') . ' Slip Gaji ' . $mahasiswa->nama_mahasiswa . '.' . $fileSlipGaji->extension();
            $fileSlipGaji->move(public_path($this->public_path_gaji), $fileNameSlipGaji);
        } else {
            $fileNameSlipGaji = null;
        }

        if ($setting->form_penentuan_struk_listrik == 1) {
            $fileStrukListrik = Request()->struk_listrik;
            $fileNameStrukListrik = date('mdYHis') . ' Struk Listrik ' . $mahasiswa->nama_mahasiswa . '.' . $fileStrukListrik->extension();
            $fileStrukListrik->move(public_path($this->public_path_listrik), $fileNameStrukListrik);
        } else {
            $fileNameStrukListrik = null;
        }

        if ($setting->form_penentuan_struk_air == 1) {
            $fileStrukAir = Request()->struk_air;
            $fileNameStrukAir = date('mdYHis') . ' Struk Air ' . $mahasiswa->nama_mahasiswa . '.' . $fileStrukAir->extension();
            $fileStrukAir->move(public_path($this->public_path_air), $fileNameStrukAir);
        } else {
            $fileNameStrukAir = null;
        }

        if ($setting->form_penentuan_kk == 1) {
            $fileKk = Request()->kk;
            $fileNameKk = date('mdYHis') . ' Kartu Keluarga ' . $mahasiswa->nama_mahasiswa . '.' . $fileKk->extension();
            $fileKk->move(public_path($this->public_path_kk), $fileNameKk);
        } else {
            $fileNameKk = null;
        }

        $string_nama_kriteria = implode(';', $nama_kriteria);
        $string_data_nilai_kriteria = implode(';', $data_nilai_kriteria);
        $stringnilai_target = implode(';', $nilai_target);

        $data = [
            'id_mahasiswa'              => Session()->get('id_mahasiswa'),
            'label_kriteria'            => $string_nama_kriteria,
            'value_kriteria'            => $string_data_nilai_kriteria,
            'target_kriteria'           => $stringnilai_target,
            'tanggal_penentuan'         => date('Y-m-d H:i:s'),
            'status_penentuan'          => 'Belum Dikirim',
            'hasil_ukt'                 => $hasil_ukt,
            'slip_gaji'                 => $fileNameSlipGaji,
            'struk_listrik'             => $fileNameStrukListrik,
            'struk_air'                 => $fileNameStrukAir,
            'kk'                        => $fileNameKk,
        ];

        $dataMahasiswa = [
            'id_mahasiswa'      => Session()->get('id_mahasiswa'),
            'status_pengajuan'  => 'Penentuan'
        ];
        $this->ModelMahasiswa->edit($dataMahasiswa);

        // wa gateway
        // $sid    = "AC944f941fef8a459f011bb10c3236df78";
        // $token  = "df97bc683bb53f68b7bb6e2dd0274dc4";
        // $twilio = new Client($sid, $token);

        // $message = $twilio->messages
        //     ->create(
        //         "whatsapp:+62895336928026", // to
        //         array(
        //             "from" => "whatsapp:+14155238886",
        //             "body" => "Your appointment is coming up on July 21 at 3PM",
        //         )
        //     );

        // print($message->sid);


        // log
        $dataLog = [
            'id_mahasiswa'  => Session()->get('id_mahasiswa'),
            'keterangan'    => 'Melakukan proses penentuan UKT ',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelPenentuanUKT->tambah($data);
        $dataPenentuanUKT = $this->ModelPenentuanUKT->dataTerakhir();
        return redirect('informasi-penentuan-ukt/' . $dataPenentuanUKT->id_penentuan_ukt)->with('success', 'Anda berhasil menyimpan data penentuan UKT!');
    }

    public function edit($id_penentuan_ukt)
    {
        if (!Session()->get('status')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Penentuan UKT',
            'subTitle'          => 'Edit Proses Penentuan UKT',
            'form'              => 'Edit',
            'detail'            => $this->ModelPenentuanUKT->detail($id_penentuan_ukt),
            'setting'           => $this->ModelSetting->dataSetting(),
            'kriteria'          => $this->ModelKriteria->dataKriteria(),
            'nilaiKriteria'     => $this->ModelNilaiKriteria->dataNilaiKriteria(),
            'dataPenentuanUKT'  => $this->ModelPenentuanUKT->detailByMahasiswa(Session()->get('id_mahasiswa')),
            'user'              => $this->ModelMahasiswa->detail(Session()->get('id_mahasiswa')),
        ];

        return view('mahasiswa.penentuanUKT.formPenentuan', $data);
    }

    public function prosesEdit($id_penentuan_ukt)
    {

        // TOPSIS

        $jumlahKriteria = $this->ModelKriteria->jumlahKriteria();
        for ($i = $jumlahKriteria; $i > 0; $i--) {
            // id_kriteria
            $id_kriteria[$i] = Request()->{"id_kriteria" . $i};
            // Nilai Kriteria
            $nama_kriteria[$i] = Request()->{"nama_kriteria" . $i};
            // bobot
            $bobot[$i] = Request()->{"bobot" . $i};
            // bobot
            $ideal[$i] = Request()->{"ideal" . $i};

            // Nilai Kriteria
            $kriteria[$i] = Request()->{"nilai_kriteria" . $i};
            $kata = explode(";", $kriteria[$i]);

            // Hasil Nikai Kriteria
            $data_nilai_kriteria[$i] = $kata[1];

            // Nilai Target
            $nilai_target[$i] = $kata[0];

            // Nilai Kriteria
            $nilai_kriteria[$i]   = $this->ModelNilaiKriteria->dataNilaiKriteriaBykriteria($id_kriteria[$i]);

            // hasil gap
            $gap = [];
            foreach ($nilai_kriteria[$i] as $item[$i]) {
                $gap[] = intval($item[$i]->ukt) - intval($nilai_target[$i]);
            }
            $hasil_gap[$i] = $gap;

            // nilai bobot dari hasil gap
            $bobot_hasil_gap = [];
            foreach ($hasil_gap[$i] as $row) {
                switch ($row) {
                    case 0:
                        $nilai_hasil = 8;
                        break;
                    case 1:
                        $nilai_hasil = 7.5;
                        break;
                    case -1:
                        $nilai_hasil = 7;
                        break;
                    case 2:
                        $nilai_hasil = 6.5;
                        break;
                    case -2:
                        $nilai_hasil = 6;
                        break;
                    case 3:
                        $nilai_hasil = 5.5;
                        break;
                    case -3:
                        $nilai_hasil = 5;
                        break;
                    case 4:
                        $nilai_hasil = 4.5;
                        break;
                    case -4:
                        $nilai_hasil = 4;
                        break;
                    case 5:
                        $nilai_hasil = 3.5;
                        break;
                    case -5:
                        $nilai_hasil = 3;
                        break;
                    case 6:
                        $nilai_hasil = 2.5;
                        break;
                    case -6:
                        $nilai_hasil = 2;
                        break;
                    case 7:
                        $nilai_hasil = 1.5;
                        break;
                    case -7:
                        $nilai_hasil = 1;
                        break;
                }

                $bobot_hasil_gap[] = $nilai_hasil;
            }
            $nilai_bobot_hasil_gap[$i] = $bobot_hasil_gap;

            // pembagi
            $pem = null;
            foreach ($nilai_bobot_hasil_gap[$i] as $row) {
                $pem = $pem + pow($row, 2);
            }
            $pembagi[$i] = sqrt($pem);

            // normalisasi keputusan
            $normalisasi = [];
            foreach ($nilai_bobot_hasil_gap[$i] as $row) {
                $normalisasi[] = $row / $pembagi[$i];
            }
            $normalisasi_keputusan[$i] = $normalisasi;

            // normalisasi bobot
            $bobot_normal = [];
            foreach ($normalisasi_keputusan[$i] as $row) {
                $bobot_normal[] = $row * $bobot[$i];
            }
            $normalisasi_bobot[$i] = $bobot_normal;

            // ideal positif negatif
            // $positif = max($normalisasi_bobot[$i]);
            $positif = [];
            $negatif = [];
            if ($ideal[$i] == 'Benefit') {
                $positif[] = max($normalisasi_bobot[$i]);
                $negatif[] = min($normalisasi_bobot[$i]);
            } else {
                $positif[] = min($normalisasi_bobot[$i]);
                $negatif[] = max($normalisasi_bobot[$i]);
            }
            $ideal_positif[$i] = $positif;
            $ideal_negatif[$i] = $negatif;
        }

        $jumlahNormalBobot = count($normalisasi_bobot[1]);

        // keputusan pemisahan = ideal positif = D+
        for ($i = 0; $i < $jumlahNormalBobot; $i++) {
            $d = 0;
            for ($j = $jumlahKriteria; $j > 0; $j--) {
                $d = $d + pow($ideal_positif[$j][0] - $normalisasi_bobot[$j][$i], 2);
            }
            $hasil_ideal_positif[] = sqrt($d);
        }

        // keputusan pemisahan = ideal positif = D+
        for ($i = 0; $i < $jumlahNormalBobot; $i++) {
            $d = 0;
            for ($j = $jumlahKriteria; $j > 0; $j--) {
                $d = $d + pow($ideal_negatif[$j][0] - $normalisasi_bobot[$j][$i], 2);
            }
            $hasil_ideal_negatif[] = sqrt($d);
        }

        // PREFERENSI
        $preferensi = [];
        for ($i = 0; $i < $jumlahNormalBobot; $i++) {
            $preferensi[] = $hasil_ideal_negatif[$i] / ($hasil_ideal_negatif[$i] + $hasil_ideal_positif[$i]);
        }
        $hasil_preferensi[] = $preferensi;

        $rank[] = $hasil_preferensi[0];

        $n = count($rank[0]);

        // RANKING
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($rank[0][$j] > $rank[0][$j + 1]) {
                    // Swap elements
                    $temp = $rank[0][$j];
                    $rank[0][$j] = $rank[0][$j + 1];
                    $rank[0][$j + 1] = $temp;
                }
            }
        }

        $ranking_ukt = null;
        for ($i = $jumlahNormalBobot - 1; $i > -1; $i--) {
            for ($j = 0; $j < $jumlahNormalBobot; $j++) {
                if ($hasil_preferensi[0][$j] == $rank[0][$i]) {
                    $ranking_ukt = $j;
                    break;
                }
            }
            $ranking[] = $ranking_ukt;
        }


        for ($i = 0; $i < $jumlahNormalBobot; $i++) {
            $ranking_final[$ranking[$i]] = $i;
        }

        for ($i = 0; $i < $jumlahNormalBobot; $i++) {
            $hasil[$i + 1]['Alternatif'] = $i + 1;
            $hasil[$i + 1]['Preferensi'] = $hasil_preferensi[0][$i];
            $hasil[$i + 1]['Ranking'] = $ranking_final[$i] + 1;
        }

        // TUTUP TOPSIS


        foreach ($hasil as $item) {
            if ($item['Ranking'] == 1) {
                $hasil_ukt = $item['Alternatif'];
            }
        }

        $setting = $this->ModelSetting->dataSetting();
        $mahasiswa = $this->ModelMahasiswa->detail(Session()->get('id_mahasiswa'));
        $penentuanUKT = $this->ModelPenentuanUKT->detail($id_penentuan_ukt);

        if ($setting->form_penentuan_slip_gaji == 1) {
            if ($penentuanUKT->slip_gaji <> "") {
                unlink(public_path($this->public_path_gaji) . '/' . $penentuanUKT->slip_gaji);
            }

            $fileSlipGaji = Request()->slip_gaji;
            $fileNameSlipGaji = date('mdYHis') . ' Slip Gaji ' . $mahasiswa->nama_mahasiswa . '.' . $fileSlipGaji->extension();
            $fileSlipGaji->move(public_path($this->public_path_gaji), $fileNameSlipGaji);
        } else {
            $fileNameSlipGaji = null;
        }

        if ($setting->form_penentuan_struk_listrik == 1) {
            if ($penentuanUKT->struk_listrik <> "") {
                unlink(public_path($this->public_path_listrik) . '/' . $penentuanUKT->struk_listrik);
            }

            $fileStrukListrik = Request()->struk_listrik;
            $fileNameStrukListrik = date('mdYHis') . ' Struk Listrik ' . $mahasiswa->nama_mahasiswa . '.' . $fileStrukListrik->extension();
            $fileStrukListrik->move(public_path($this->public_path_listrik), $fileNameStrukListrik);
        } else {
            $fileNameStrukListrik = null;
        }

        if ($setting->form_penentuan_struk_air == 1) {
            if ($penentuanUKT->struk_air <> "") {
                unlink(public_path($this->public_path_air) . '/' . $penentuanUKT->struk_air);
            }

            $fileStrukAir = Request()->struk_air;
            $fileNameStrukAir = date('mdYHis') . ' Struk Air ' . $mahasiswa->nama_mahasiswa . '.' . $fileStrukAir->extension();
            $fileStrukAir->move(public_path($this->public_path_air), $fileNameStrukAir);
        } else {
            $fileNameStrukAir = null;
        }

        if ($setting->form_penentuan_kk == 1) {
            if ($penentuanUKT->kk <> "") {
                unlink(public_path($this->public_path_kk) . '/' . $penentuanUKT->kk);
            }

            $fileKk = Request()->kk;
            $fileNameKk = date('mdYHis') . ' Kartu Keluarga ' . $mahasiswa->nama_mahasiswa . '.' . $fileKk->extension();
            $fileKk->move(public_path($this->public_path_kk), $fileNameKk);
        } else {
            $fileNameKk = null;
        }

        $string_nama_kriteria = implode(';', $nama_kriteria);
        $string_data_nilai_kriteria = implode(';', $data_nilai_kriteria);
        $stringnilai_target = implode(';', $nilai_target);

        $data = [
            'id_penentuan_ukt'          => $id_penentuan_ukt,
            'id_mahasiswa'              => Session()->get('id_mahasiswa'),
            'label_kriteria'            => $string_nama_kriteria,
            'value_kriteria'            => $string_data_nilai_kriteria,
            'target_kriteria'           => $stringnilai_target,
            'tanggal_penentuan'         => date('Y-m-d H:i:s'),
            'status_penentuan'          => 'Belum Dikirim',
            'hasil_ukt'                 => $hasil_ukt,
            'slip_gaji'                 => $fileNameSlipGaji,
            'struk_listrik'             => $fileNameStrukListrik,
            'struk_air'                 => $fileNameStrukAir,
            'kk'                        => $fileNameKk,
        ];

        $dataMahasiswa = [
            'id_mahasiswa'      => Session()->get('id_mahasiswa'),
            'status_pengajuan'  => 'Penentuan'
        ];
        $this->ModelMahasiswa->edit($dataMahasiswa);


        // log
        $dataLog = [
            'id_mahasiswa'  => Session()->get('id_mahasiswa'),
            'keterangan'    => 'Melakukan edit proses penentuan UKT ',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelPenentuanUKT->edit($data);
        return redirect('informasi-penentuan-ukt/' . $id_penentuan_ukt)->with('success', 'Anda berhasil melakukan edit penentuan UKT!');
    }

    public function informasiPenentuanUKT($id_penentuan_ukt)
    {
        if (!Session()->get('status')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Penentuan UKT',
            'subTitle'          => 'Informasi Penentuan UKT',
            'setting'           => $this->ModelSetting->dataSetting(),
            'detail'            => $this->ModelPenentuanUKT->detail($id_penentuan_ukt),
            'user'              => $this->ModelMahasiswa->detail(Session()->get('id_mahasiswa')),
        ];

        return view('mahasiswa.penentuanUKT.informasi', $data);
    }

    public function ulangi($id_penentuan_ukt)
    {
        if (!Session()->get('status')) {
            return redirect()->route('login');
        }

        $detail = $this->ModelPenentuanUKT->detail($id_penentuan_ukt);

        if ($detail->slip_gaji <> "") {
            unlink(public_path($this->public_path_gaji) . '/' . $detail->slip_gaji);
        }

        if ($detail->struk_listrik <> "") {
            unlink(public_path($this->public_path_listrik) . '/' . $detail->struk_listrik);
        }

        if ($detail->struk_air <> "") {
            unlink(public_path($this->public_path_air) . '/' . $detail->struk_air);
        }

        if ($detail->kk <> "") {
            unlink(public_path($this->public_path_kk) . '/' . $detail->kk);
        }

        $dataMahasiswa = [
            'id_mahasiswa'      => $detail->id_mahasiswa,
            'status_pengajuan'  => 'Tidak'
        ];
        $this->ModelMahasiswa->edit($dataMahasiswa);


        // log
        $dataLog = [
            'id_mahasiswa'  => Session()->get('id_mahasiswa'),
            'keterangan'    => 'Mengulangi proses penentuan UKT ',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelPenentuanUKT->hapus($id_penentuan_ukt);
        return redirect('/penentuan-ukt')->with('success', 'Anda akan mengulangi proses penentuan UKT. Silahkan isi dengan data yang sesuai dengan data yang dimiliki!');
    }

    public function kirim($id_penentuan_ukt)
    {
        if (!Session()->get('status')) {
            return redirect()->route('login');
        }

        $detail = $this->ModelPenentuanUKT->detail($id_penentuan_ukt);

        $data = [
            'id_penentuan_ukt'  => $id_penentuan_ukt,
            'status_penentuan'  => 'Proses'
        ];


        // log
        $dataLog = [
            'id_mahasiswa'  => Session()->get('id_mahasiswa'),
            'keterangan'    => 'Mengirim data penentuan UKT ',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelPenentuanUKT->edit($data);
        return redirect('/informasi-penentuan-ukt/' . $id_penentuan_ukt)->with('success', 'Anda telah mengirim data penentuan UKT. Silahkan ditunggu hasilnya!');
    }

    // Bagian Keuangan
    public function kelolaPenentuanUKT()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'             => 'Penentuan UKT',
            'subTitle'          => 'Kelola Penentuan UKT',
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
            'setting'           => $this->ModelSetting->dataSetting(),
            'dataPenentuanUKT' => $this->ModelPenentuanUKT->dataPenentuanUKT(),
        ];

        return view('bagianKeuangan.penentuanUKT.kelola', $data);
    }

    public function cekPemberkasan($id_penentuan_ukt)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'             => 'Penentuan UKT',
            'subTitle'          => 'Cek Berkas',
            'setting'           => $this->ModelSetting->dataSetting(),
            'detail'            => $this->ModelPenentuanUKT->detail($id_penentuan_ukt),
            'ukt'               => $this->ModelKelompokUKT->dataKelompokUKT(),
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
        ];

        return view('bagianKeuangan.penentuanUKT.cekBerkas', $data);
    }

    public function tidakSetuju($id_penentuan_ukt)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $detail = $this->ModelPenentuanUKT->detail($id_penentuan_ukt);

        $data = [
            'id_penentuan_ukt'  => $detail->id_penentuan_ukt,
            'status_penentuan'  => 'Tidak Setuju'
        ];

        $dataMahasiswa = [
            'id_mahasiswa'      => $detail->id_mahasiswa,
            'status_pengajuan'  => 'Tidak'
        ];
        $this->ModelMahasiswa->edit($dataMahasiswa);

        // WA GATEWAY
        $noHp = substr($detail->nomor_telepon, 1);
        $sid    = "AC944f941fef8a459f011bb10c3236df78";
        $token  = "df97bc683bb53f68b7bb6e2dd0274dc4";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "whatsapp:+62" . $noHp, // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => "Hallo {$detail->nama_mahasiswa}!\n\nAnda telah menerima hasil pengumuman proses penentuan UKT yang telah Anda lakukan. Untuk lebih jelasnya Anda bisa kunjungi menu penentuan UKT di website SI UKT atau klik link dibawah ini.\n\nLink:\nhttps://himmi-polsub.com/penentuan-ukt \n\nTerima kasih."
                )
            );

        print($message->sid);


        // log
        $dataLog = [
            'id_user'       => Session()->get('id_user'),
            'keterangan'    => 'Memberikan keputusan tidak setuju penentuan UKT kepada ' . $detail->nama_mahasiswa,
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelPenentuanUKT->edit($data);
        return redirect('/kelola-penentuan-ukt')->with('success', 'Berhasil memberikan keputusan tidak setuju.');
    }

    public function setuju($id_penentuan_ukt)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $detail = $this->ModelPenentuanUKT->detail($id_penentuan_ukt);

        $kelompokUKT = $this->ModelKelompokUKT->dataKelompokUKTByProdi($detail->prodi);
        foreach ($kelompokUKT as $item) {
            if ($detail->hasil_ukt == $item->kelompok_ukt) {
                $id_kelompok_ukt = $item->id_kelompok_ukt;
            }
        }

        $data = [
            'id_penentuan_ukt'  => $detail->id_penentuan_ukt,
            'status_penentuan'  => 'Setuju'
        ];

        $dataMahasiswa = [
            'id_mahasiswa'      => $detail->id_mahasiswa,
            'status_pengajuan'  => 'Tidak',
            'id_kelompok_ukt'   => $id_kelompok_ukt
        ];
        $this->ModelMahasiswa->edit($dataMahasiswa);

        // WA GATEWAY
        $noHp = substr($detail->nomor_telepon, 1);
        $sid    = "AC944f941fef8a459f011bb10c3236df78";
        $token  = "df97bc683bb53f68b7bb6e2dd0274dc4";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "whatsapp:+62" . $noHp, // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => "Hallo {$detail->nama_mahasiswa}!\n\nAnda telah menerima hasil pengumuman proses penentuan UKT yang telah Anda lakukan. Untuk lebih jelasnya Anda bisa kunjungi menu penentuan UKT di website SI UKT atau klik link dibawah ini.\n\nLink:\nhttps://himmi-polsub.com/penentuan-ukt \n\nTerima kasih."
                )
            );

        print($message->sid);

        // log
        $dataLog = [
            'id_user'       => Session()->get('id_user'),
            'keterangan'    => 'Memberikan keputusan setuju penentuan UKT kepada ' . $detail->nama_mahasiswa,
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelPenentuanUKT->edit($data);
        return redirect('/kelola-penentuan-ukt')->with('success', 'Berhasil memberikan keputusan setuju.');
    }

    public function kirimKeLaporan()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'status_laporan'    => 'Sudah'
        ];

        $this->ModelPenentuanUKT->editStatusLaporan($data);
        return redirect('/kelola-penentuan-ukt')->with('success', 'Anda berhasil memindahkan data penentuan UKT ke Laporan.');
    }

    public function editHasilUKT($id_penentuan_ukt)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'id_penentuan_ukt'  => $id_penentuan_ukt,
            'hasil_ukt'         => Request()->hasil_ukt,
        ];

        $this->ModelPenentuanUKT->edit($data);
        return redirect('/cek-berkas-penentuan-ukt/' . $id_penentuan_ukt)->with('success', 'Berhasil edit hasil Uang Kuliah Tunggal (UKT).');
    }

    public function laporanPenentuanUKT()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'             => 'Penentuan UKT',
            'subTitle'          => 'Laporan Penentuan UKT',
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
            'setting'           => $this->ModelSetting->dataSetting(),
            'dataPenentuanUKT' => $this->ModelPenentuanUKT->dataPenentuanUKT(),
        ];

        return view('bagianKeuangan.penentuanUKT.laporan', $data);
    }

    public function cetakSemua()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'             => 'Rekap Penentuan UKT',
            'tahunAngkatan'     => Request()->tahun_angkatan,
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
            'setting'           => $this->ModelSetting->dataSetting(),
            'dataPenentuanUKT'  => $this->ModelPenentuanUKT->dataPenentuanUKTTanggal(Request()->tanggal_mulai, Request()->tanggal_akhir, Request()->tahun_angkatan),
        ];

        $pdf = PDF::loadview('cetak/penentuan/cetakSemua', $data);
        return $pdf->download($data['title'] . ' ' . date('d F Y') . '.pdf');
    }

    public function cetakSatuan($id_penentuan_ukt)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $detail = $this->ModelPenentuanUKT->detail($id_penentuan_ukt);

        $data = [
            'title'             => 'Detail Penentuan UKT',
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
            'setting'           => $this->ModelSetting->dataSetting(),
            'detail'            => $detail,
        ];

        $pdf = PDF::loadview('cetak/penentuan/cetakSatuan', $data);
        return $pdf->download($data['title'] . ' ' . $detail->nama_mahasiswa . ' ' . date('d F Y') . '.pdf');
    }

    public function downloadPengumumanUKT($tahunAngkatan)
    {
        if (!Session()->get('status')) {
            return redirect()->route('login');
        }

        $data = [
            'title'             => 'Rekap Penentuan UKT',
            'tahunAngkatan'     => $tahunAngkatan,
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
            'setting'           => $this->ModelSetting->dataSetting(),
            'dataPenentuanUKT'  => $this->ModelPenentuanUKT->dataPenentuanUKTAngkatan($tahunAngkatan),
        ];

        $pdf = PDF::loadview('cetak/penentuan/cetakSemua', $data);
        return $pdf->download($data['title'] . ' ' . date('d F Y') . '.pdf');
    }
}
