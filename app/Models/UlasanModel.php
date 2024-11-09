<?php

namespace App\Models;

use CodeIgniter\Model;

class UlasanModel extends Model
{
    protected $table = 'ulasanbuku';
    protected $primaryKey = 'UlasanID';
    protected $allowedFields = ['UserID', 'BukuID', 'Ulasan', 'Rating'];
    protected $returnType = 'array';
    
    public function getUlasanBuku($bukuId)
    {
        return $this->select('ulasanbuku.*, users.Username')
                    ->join('users', 'users.UserID = ulasanbuku.UserID')
                    ->where('BukuID', $bukuId)
                    ->findAll();
    }
}