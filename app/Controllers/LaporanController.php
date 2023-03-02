<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Pengaduan;

class LaporanController extends BaseController
{

    protected $laporans;
    public function __construct()
    {
       $this->laporans= new Pengaduan();
    }

    public function laporan()
    {
        $data['laporan'] = $this->laporans->findAll();
        return view('laporan_view', $data);
    }
}
