<?php

namespace App\Controllers;

use App\Models\UlasanModel;
use CodeIgniter\Controller;

class UlasanController extends Controller
{
    protected $ulasanModel;

    public function __construct()
    {
        $this->ulasanModel = new UlasanModel();
    }

    public function save()
    {
        $session = session();

        // Pastikan user sudah login

        $data = [
            'UserID' => $session->get('UserID'),
            'BukuID' => $this->request->getPost('BukuID'),
            'Ulasan' => $this->request->getPost('Ulasan'),
            'Rating' => $this->request->getPost('Rating')
        ];

        // Validasi rating
        if ($data['Rating'] < 1 || $data['Rating'] > 10) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Rating harus antara 1-10'
            ]);
        }

        try {
            // Cek apakah user sudah pernah memberikan ulasan untuk buku ini
            $existingUlasan = $this->ulasanModel->where([
                'UserID' => $data['UserID'],
                'BukuID' => $data['BukuID']
            ])->first();

            if ($existingUlasan) {
                // Update ulasan yang ada
                $this->ulasanModel->update($existingUlasan['UlasanID'], $data);
                $message = 'Ulasan berhasil diperbarui';
            } else {
                // Buat ulasan baru
                $this->ulasanModel->insert($data);
                $message = 'Ulasan berhasil ditambahkan';
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan ulasan'
            ]);
        }
    }

    public function getUlasan($bukuId)
    {
        $ulasan = $this->ulasanModel->getUlasanBuku($bukuId);
        return $this->response->setJSON($ulasan);
    }

    public function index()
    {
        // Ambil UserID dari session
        $userID = session()->get('UserID');

        $data = [
            'UserID' => $userID, // Tambahkan UserID ke array data
            'ulasan' => $this->ulasanModel->select('ulasanbuku.*, buku.Judul')
                ->join('buku', 'buku.BukuID = ulasanbuku.BukuID')
                ->where('ulasanbuku.UserID', $userID)
                ->findAll()
        ];

        return view('peminjam/ulasan', $data);
    }

    public function update($id)
    {
        // Validasi bahwa ulasan ini milik user yang sedang login
        $userID = session()->get('UserID');
        $ulasan = $this->ulasanModel->where('UlasanID', $id)
            ->where('UserID', $userID)
            ->first();

        if (!$ulasan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'Ulasan' => $this->request->getPost('ulasan'),
            'Rating' => $this->request->getPost('rating')
        ];

        $this->ulasanModel->update($id, $data);

        session()->setFlashdata('success', 'Ulasan berhasil diperbarui');
        return redirect()->to('ulasan');
    }

    public function hapus($id)
    {
        // Validasi bahwa ulasan ini milik user yang sedang login
        $userID = session()->get('UserID');
        $ulasan = $this->ulasanModel->where('UlasanID', $id)
            ->where('UserID', $userID)
            ->first();

        if (!$ulasan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $this->ulasanModel->delete($id);

        session()->setFlashdata('success', 'Ulasan berhasil dihapus');
        return redirect()->to('ulasan');
    }
}
