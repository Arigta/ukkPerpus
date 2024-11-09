<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PeminjamanModel;
use App\Models\UlasanModel;
use App\Models\KoleksiModel;
use App\Models\BukuModel;

class PeminjamController extends BaseController
{
    protected $userModel;
    protected $peminjamanModel;
    protected $ulasanModel;
    protected $koleksiModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->ulasanModel = new UlasanModel();
        $this->koleksiModel = new KoleksiModel();
        $this->bukuModel = new BukuModel();
    }

    public function dashboard($userID)
    {
        // Cek apakah user sudah login dan memiliki role peminjam
        if (!session()->get('loggedIn') || session()->get('role') !== 'peminjam') {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil data user berdasarkan UserID
        $user = $this->userModel->find($userID);
        if (!$user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan.');
        }

        try {
            // Hitung total peminjaman aktif
            $totalPeminjamanAktif = $this->peminjamanModel
                ->where('UserID', $userID)
                ->where('StatusPeminjaman', 'Dipinjam')
                ->countAllResults();

            // Hitung total semua peminjaman
            $totalSemuaPeminjaman = $this->peminjamanModel
                ->where('UserID', $userID)
                ->countAllResults();

            // Hitung total ulasan
            $totalUlasan = $this->ulasanModel
                ->where('UserID', $userID)
                ->countAllResults();

            // Hitung total koleksi pribadi
            $totalKoleksi = $this->koleksiModel
                ->where('UserID', $userID)
                ->countAllResults();

            // Ambil data peminjaman terbaru
            $peminjamanTerbaru = $this->peminjamanModel
                ->select('peminjaman.*, buku.Judul')
                ->join('buku', 'buku.BukuID = peminjaman.BukuID')
                ->where('peminjaman.UserID', $userID)
                ->orderBy('TanggalPeminjaman', 'DESC')
                ->limit(5)
                ->find();

            // Ambil data ulasan terbaru
            $ulasanTerbaru = $this->ulasanModel
                ->select('ulasanbuku.*, buku.Judul')
                ->join('buku', 'buku.BukuID = ulasanbuku.BukuID')
                ->where('ulasanbuku.UserID', $userID)
                ->orderBy('UlasanID', 'DESC')
                ->limit(5)
                ->find();

            // Siapkan data untuk view
            $data = [
                'user' => $user,
                'UserID' => $userID,
                'total_peminjaman_aktif' => $totalPeminjamanAktif,
                'total_semua_peminjaman' => $totalSemuaPeminjaman,
                'total_ulasan' => $totalUlasan,
                'total_koleksi' => $totalKoleksi,
                'peminjaman_terbaru' => $peminjamanTerbaru,
                'ulasan_terbaru' => $ulasanTerbaru,
                'title' => 'Dashboard Peminjam' // Untuk judul halaman
            ];

            return view('peminjam/dashboard', $data);

        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            log_message('error', '[PeminjamController::dashboard] Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat dashboard.');
        }
    }
}