<?php

namespace App\Models;

use CodeIgniter\Model;

class KoleksiModel extends Model
{
    protected $table = 'koleksipribadi';
    protected $primaryKey = 'KoleksiID';
    protected $allowedFields = ['UserID', 'BukuID', 'TanggalDitambahkan'];
    protected $useTimestamps = false;
}