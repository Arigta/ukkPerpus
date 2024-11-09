<?php
// application/controllers/Peminjam/Buku.php

namespace App\Controllers\Peminjam;

use App\Controllers\BaseController;

class buku extends BaseController
{
    protected $bukuModel;
    
    public function __construct()
    {
        $this->bukuModel = new \App\Models\BukuModel();
    }

    public function index()
    {
        $data['buku'] = $this->bukuModel->findAll();
        return view('peminjam/buku/index', $data);
    }

    public function detail($id)
    {
        $buku = $this->bukuModel->find($id);
        
        if ($buku) {
            return $this->response->setJSON($buku);
        }
        
        return $this->response->setStatusCode(404)->setJSON([
            'status' => 'error',
            'message' => 'Buku tidak ditemukan'
        ]);
    }
}