<?php

namespace App\Controllers;

use App\Models\KoleksiModel;
use CodeIgniter\RESTful\ResourceController;

class KoleksiController extends ResourceController
{
    protected $koleksiModel;
    protected $db;

    public function __construct()
    {
        $this->koleksiModel = new KoleksiModel();
        $this->db = \Config\Database::connect();
    }

    public function koleksi($UserID = null)
    {
        if (!$UserID) {
            $UserID = session()->get('UserID');
        }

        // Gunakan query builder untuk join tabel
        $query = $this->db->table('koleksipribadi')
            ->select('buku.*, koleksipribadi.KoleksiID')
            ->join('buku', 'buku.BukuID = koleksipribadi.BukuID')
            ->where('koleksipribadi.UserID', $UserID)
            ->get();

        $buku = $query->getResultArray();
;

        // Kirim data ke view dengan nama variabel 'buku'
        return view('peminjam/koleksi', ['buku' => $buku, 'UserID' => $UserID]);
    }


    public function check($bukuId)
    {
        $userId = session()->get('UserID'); // Sesuaikan dengan session key yang Anda gunakan

        if (!$userId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User tidak terautentikasi',
                'isInCollection' => false
            ])->setStatusCode(401);
        }

        $koleksi = $this->koleksiModel->where([
            'UserID' => $userId,
            'BukuID' => $bukuId
        ])->first();

        return $this->response->setJSON([
            'status' => 'success',
            'isInCollection' => (bool) $koleksi
        ]);
    }

    public function toggle()
    {
        $userId = session()->get('UserID'); // Sesuaikan dengan session key yang Anda gunakan
        $bukuId = $this->request->getPost('bukuID');

        if (!$userId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User tidak terautentikasi'
            ])->setStatusCode(401);
        }

        if (!$bukuId) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID Buku tidak valid'
            ])->setStatusCode(400);
        }

        $existingKoleksi = $this->koleksiModel->where([
            'UserID' => $userId,
            'BukuID' => $bukuId
        ])->first();

        try {
            if ($existingKoleksi) {
                // Hapus dari koleksi
                $this->koleksiModel->where([
                    'UserID' => $userId,
                    'BukuID' => $bukuId
                ])->delete();

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Buku dihapus dari koleksi',
                    'isInCollection' => false
                ]);
            } else {
                // Tambah ke koleksi
                $this->koleksiModel->insert([
                    'UserID' => $userId,
                    'BukuID' => $bukuId,
                    'TanggalDitambahkan' => date('Y-m-d H:i:s')
                ]);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Buku ditambahkan ke koleksi',
                    'isInCollection' => true
                ]);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
