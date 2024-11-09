<?php
namespace App\Models;
use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'BukuID';
    protected $allowedFields = ['Judul', 'Penulis', 'Penerbit', 'TahunTerbit', 'Deskripsi', 'gambar'];
    
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Add method to get book with categories
    public function getBookWithCategories($id = null)
    {
        if ($id === null) {
            $query = $this->db->table('buku b')
                ->select('b.*, GROUP_CONCAT(k.NamaKategori) as categories')
                ->join('kategoribuku_relasi kr', 'b.BukuID = kr.BukuID', 'left')
                ->join('kategoribuku k', 'kr.KategoriID = k.KategoriID', 'left')
                ->groupBy('b.BukuID')
                ->get();
            return $query->getResultArray();
        }

        $query = $this->db->table('buku b')
            ->select('b.*, GROUP_CONCAT(k.NamaKategori) as categories')
            ->join('kategoribuku_relasi kr', 'b.BukuID = kr.BukuID', 'left')
            ->join('kategoribuku k', 'kr.KategoriID = k.KategoriID', 'left')
            ->where('b.BukuID', $id)
            ->groupBy('b.BukuID')
            ->get();
        return $query->getRowArray();
    }

}