<?php
// app/Models/PeminjamanModel.php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'PeminjamanID';
    protected $allowedFields = ['UserID', 'BukuID', 'TanggalPeminjaman', 'TanggalPengembalian', 'StatusPeminjaman'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

        // Add method to check if book is currently borrowed
        public function isBookBorrowed($bukuID) 
        {
            return $this->where('BukuID', $bukuID)
                        ->where('StatusPeminjaman', 'Dipinjam')
                        ->countAllResults() > 0;
        }
        
        // Get all borrowed books
        public function getBorrowedBooks() 
        {
            return $this->where('StatusPeminjaman', 'Dipinjam')
                        ->findAll();
        }
}