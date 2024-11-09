<?php

namespace App\Controllers;

use App\Models\UlasanModel;

class AdminUlasanController extends BaseController
{
    public function index()
    {
        $ulasanModel = new UlasanModel();

        // Ambil semua data ulasan dari database
        $data['ulasan'] = $ulasanModel->findAll();

        // Load view dengan data ulasan
        return view('admin/data_ulasan', $data);
    }
}
