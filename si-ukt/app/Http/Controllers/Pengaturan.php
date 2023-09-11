<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use App\Models\ModelLog;
use App\Models\ModelSetting;

class Pengaturan extends Controller
{

    private $ModelUser;
    private $ModelLog;
    private $ModelSetting;
    private $public_path;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelLog = new ModelLog();
        $this->ModelSetting = new ModelSetting();
        $this->public_path = 'gambar';
    }

    public function index()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'             => 'Data Pengaturan',
            'subTitle'          => 'Pengaturan',
            'daftarLog'         => $this->ModelLog->dataLog(),
            'detail'            => $this->ModelSetting->dataSetting(),
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
        ];

        return view('bagianKeuangan.pengaturan.dataPengaturan', $data);
    }

    public function prosesEdit($id_setting)
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        if (Request()->tanda_tangan_kabag <> "") {
            $detail = $this->ModelSetting->dataSetting();
            if ($detail->tanda_tangan_kabag <> "") {
                unlink(public_path($this->public_path) . '/' . $detail->tanda_tangan_kabag);
            }

            $file = Request()->tanda_tangan_kabag;
            $fileName = ' Tanda Tangan Kepala Bagian' . '.' . $file->extension();
            $file->move(public_path($this->public_path), $fileName);

            $data = [
                'id_setting'                    => $id_setting,
                'batas_ukt_penangguhan'         => Request()->batas_ukt_penangguhan,
                'batas_ukt_penurunan'           => Request()->batas_ukt_penurunan,
                'persen_denda'                  => Request()->persen_denda,
                'persen_angsuran_pertama'       => Request()->persen_angsuran_pertama,
                'batas_tanggal_angsuran'        => Request()->batas_tanggal_angsuran,
                'form_penurunan_sktm'           => Request()->form_penurunan_sktm,
                'form_penurunan_khs'            => Request()->form_penurunan_khs,
                'form_penurunan_struk_listrik'  => Request()->form_penurunan_struk_listrik,
                'form_penurunan_slip_gaji'      => Request()->form_penurunan_slip_gaji,
                'form_penurunan_foto_rumah'     => Request()->form_penurunan_foto_rumah,
                'form_penurunan_surat_pengajuan' => Request()->form_penurunan_surat_pengajuan,
                'form_penentuan_slip_gaji'      => Request()->form_penentuan_slip_gaji,
                'form_penentuan_struk_listrik'  => Request()->form_penentuan_struk_listrik,
                'form_penentuan_struk_air'      => Request()->form_penentuan_struk_air,
                'form_penentuan_kk'             => Request()->form_penentuan_kk,
                'tanda_tangan_kabag'            => $fileName
            ];
        } else {
            $data = [
                'id_setting'                    => $id_setting,
                'batas_ukt_penangguhan'         => Request()->batas_ukt_penangguhan,
                'batas_ukt_penurunan'           => Request()->batas_ukt_penurunan,
                'persen_denda'                  => Request()->persen_denda,
                'persen_angsuran_pertama'       => Request()->persen_angsuran_pertama,
                'batas_tanggal_angsuran'        => Request()->batas_tanggal_angsuran,
                'form_penurunan_sktm'           => Request()->form_penurunan_sktm,
                'form_penurunan_khs'            => Request()->form_penurunan_khs,
                'form_penurunan_struk_listrik'  => Request()->form_penurunan_struk_listrik,
                'form_penurunan_slip_gaji'      => Request()->form_penurunan_slip_gaji,
                'form_penurunan_foto_rumah'     => Request()->form_penurunan_foto_rumah,
                'form_penurunan_surat_pengajuan' => Request()->form_penurunan_surat_pengajuan,
                'form_penentuan_slip_gaji'      => Request()->form_penentuan_slip_gaji,
                'form_penentuan_struk_listrik'  => Request()->form_penentuan_struk_listrik,
                'form_penentuan_struk_air'      => Request()->form_penentuan_struk_air,
                'form_penentuan_kk'             => Request()->form_penentuan_kk,
            ];
        }


        // log
        $dataLog = [
            'id_user'      => Session()->get('id_user'),
            'keterangan'    => 'Melakukan edit pengaturan',
            'status_user'   => session()->get('status')
        ];
        $this->ModelLog->tambah($dataLog);
        // end log

        $this->ModelSetting->edit($data);
        return redirect()->route('pengaturan')->with('success', 'Data pengaturan berhasil diedit!');
    }
}
