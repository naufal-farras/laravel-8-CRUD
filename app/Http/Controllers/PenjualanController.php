<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PenjualanModel;

class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->PenjualanModel = new PenjualanModel();
    }
    public function index()
    {
        $data = [
            'penjualan' => $this->PenjualanModel->allData(),
        ];
        return view('v_penjualan', $data);
    }
}
