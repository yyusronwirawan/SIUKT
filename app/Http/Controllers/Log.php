<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ModelUser;
use App\Models\ModelLog;

class Log extends Controller
{

    private $ModelUser;
    private $ModelLog;

    public function __construct()
    {
        $this->ModelUser = new ModelUser();
        $this->ModelLog = new ModelLog();
    }

    public function index()
    {
        if (!Session()->get('status')) {
            return redirect()->route('admin');
        }

        $data = [
            'title'             => 'Data Log',
            'subTitle'          => 'Daftar Log',
            'daftarLog'         => $this->ModelLog->dataLog(),
            'user'              => $this->ModelUser->detail(Session()->get('id_user')),
        ];
        // dd($data);

        return view('bagianKeuangan.log.dataLog', $data);
    }
}
