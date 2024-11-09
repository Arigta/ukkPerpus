<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PeminjamanModel;
use App\Models\BukuModel;

class PeminjamanController extends Controller
{
    protected $peminjamanModel;
    protected $bukuModel;
   
    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->bukuModel = new BukuModel();
    }

    public function pinjam($bukuId)
    {
        $userId = session()->get('UserID');
        $tanggalPengembalian = $this->request->getPost('tanggalPengembalian');

        // 1. Validasi input tanggal
        if (!$tanggalPengembalian) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Tanggal pengembalian harus diisi'
            ]);
        }

        // 2. Cek apakah buku sedang dipinjam


        // 3. Cek apakah user sudah pernah meminjam buku ini dan belum mengembalikan
        $existingLoan = $this->peminjamanModel
            ->where('UserID', $userId)
            ->where('BukuID', $bukuId)
            ->where('StatusPeminjaman', 'Dipinjam')
            ->first();

        if ($existingLoan) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Anda masih meminjam buku ini. Harap kembalikan terlebih dahulu'
            ]);
        }

        // 4. Cek jumlah buku yang sedang dipinjam oleh user
        $activeBorrows = $this->peminjamanModel
            ->where('UserID', $userId)
            ->where('StatusPeminjaman', 'Dipinjam')
            ->countAllResults();

        if ($activeBorrows >= 10) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Anda telah mencapai batas maksimal peminjaman buku (10 buku)'
            ]);
        }

        // 5. Cek riwayat keterlambatan pengembalian
        $lateReturns = $this->peminjamanModel
            ->where('UserID', $userId)
            ->where('TanggalPengembalianAktual >', 'TanggalPengembalian', false)
            ->countAllResults();

        if ($lateReturns > 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Anda memiliki riwayat keterlambatan pengembalian buku. Harap selesaikan dahulu'
            ]);
        }

        // 6. Proses peminjaman jika semua validasi berhasil
        $data = [
            'UserID' => $userId,
            'BukuID' => $bukuId,
            'TanggalPeminjaman' => date('Y-m-d'),
            'TanggalPengembalian' => $tanggalPengembalian,
            'StatusPeminjaman' => 'Dipinjam'
        ];

        try {
            $this->peminjamanModel->insert($data);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Buku berhasil dipinjam'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error saat meminjam buku: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal meminjam buku'
            ]);
        }
    }

    public function kembalikan($peminjamanID, $userID)
    {
        try {
            // Update dengan tanggal pengembalian aktual
            $this->peminjamanModel->update($peminjamanID, [
                'StatusPeminjaman' => 'Dikembalikan',
                'TanggalPengembalianAktual' => date('Y-m-d')
            ]);

            return redirect()->to(base_url("peminjaman/{$userID}"))
                ->with('success', 'Buku berhasil dikembalikan');
        } catch (\Exception $e) {
            log_message('error', 'Error saat mengembalikan buku: ' . $e->getMessage());
            return redirect()->to(base_url("peminjaman/{$userID}"))
                ->with('error', 'Gagal mengembalikan buku');
        }
    }

    public function index($userID)
    {
        $peminjaman = $this->peminjamanModel
            ->select('peminjaman.*, buku.Judul')
            ->join('buku', 'buku.BukuID = peminjaman.BukuID')
            ->where('peminjaman.UserID', $userID)
            ->findAll();

        $data = [
            'title' => 'Daftar Peminjaman',
            'peminjaman' => $peminjaman,
            'UserID' => $userID
        ];

        return view('peminjam/peminjaman', $data);
    }
}