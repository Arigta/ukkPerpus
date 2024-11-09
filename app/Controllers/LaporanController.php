<?php
// Controllers/LaporanController.php
namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\UserModel;
use App\Models\UlasanModel;

class LaporanController extends BaseController
{
    public function index()
    {
        return view('admin/Laporan/laporan');
    }
    public function generateLaporanPeminjaman()
    {
        $peminjamanModel = new PeminjamanModel();
        $data['peminjaman'] = $peminjamanModel->findAll();

        return view('admin/Laporan/laporan_peminjaman', $data);
    }
    public function generateLaporanKeanggotaan()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('admin/Laporan/laporan_keanggotaan', $data);
    }
    public function generateLaporanUlasan()
    {
        $ulasanModel = new UlasanModel();
        $data['ulasan'] = $ulasanModel->findAll();

        return view('admin/Laporan/laporan_ulasan', $data);
    }
}
