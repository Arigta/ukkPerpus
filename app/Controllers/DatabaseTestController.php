<?php

namespace App\Controllers;

use App\Models\DatabaseTestModel;

class DatabaseTestController extends BaseController
{
    public function index()
    {
        $model = new DatabaseTestModel();
        $data = $model->findAll(); // Ambil semua data dari tabel

        // Tampilkan data ke view untuk pengecekan
        return view('database_test', ['data' => $data]);
    }
}
