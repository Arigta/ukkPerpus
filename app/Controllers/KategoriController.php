<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\KategoriBukuRelasiModel;

class KategoriController extends BaseController
{
    protected $kategoriModel;
    protected $kategoriRelasiModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->kategoriRelasiModel = new KategoriBukuRelasiModel();
    }

    public function index()
    {
        // Menggunakan builder untuk query yang lebih aman
        $builder = $this->kategoriModel->builder();
        $builder->select('kategoribuku.*, COALESCE(COUNT(kategoribuku_relasi.BukuID), 0) as jumlah_buku');
        $builder->join('kategoribuku_relasi', 'kategoribuku.KategoriID = kategoribuku_relasi.KategoriID', 'left');
        $builder->groupBy('kategoribuku.KategoriID, kategoribuku.NamaKategori');
        
        $query = $builder->get();
        $data['kategoriBuku'] = $query->getResultArray();

        return view('admin/kategori', $data);
    }

    public function save()
    {
        $data = [
            'NamaKategori' => $this->request->getPost('namaKategori')
        ];

        $this->kategoriModel->insert($data);
        session()->setFlashdata('success', 'Kategori berhasil ditambahkan');
        return redirect()->to('/admin/kategori');
    }

    public function update($id)
    {
        $data = [
            'NamaKategori' => $this->request->getPost('namaKategori')
        ];

        $this->kategoriModel->update($id, $data);
        session()->setFlashdata('success', 'Kategori berhasil diupdate');
        return redirect()->to('/admin/kategori');
    }

    public function delete($id)
    {
        // Hapus relasi terlebih dahulu
        $this->kategoriRelasiModel->where('KategoriID', $id)->delete();
        
        // Kemudian hapus kategori
        $this->kategoriModel->delete($id);
        session()->setFlashdata('success', 'Kategori berhasil dihapus');
        return redirect()->to('/admin/kategori');
    }
}