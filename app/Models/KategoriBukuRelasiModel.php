<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriBukuRelasiModel extends Model
{
    protected $table = 'kategoribuku_relasi';
    protected $primaryKey = 'KategoriBukuID';
    protected $allowedFields = ['BukuID', 'KategoriID'];
    protected $returnType = 'array';
}
