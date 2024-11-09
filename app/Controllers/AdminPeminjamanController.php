<?php 
// app/Controllers/AdminPeminjamanController.php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use CodeIgniter\Controller;

class AdminPeminjamanController extends Controller
{
    public function index()
    {
        $peminjamanModel = new PeminjamanModel();
        $data['peminjaman'] = $peminjamanModel->findAll();
        
        return view('admin/peminjaman', $data);
    }
}
