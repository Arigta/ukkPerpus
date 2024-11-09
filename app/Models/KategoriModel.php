<?php
// Models/KategoriModel.php
namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategoribuku';
    protected $primaryKey = 'KategoriID';
    protected $allowedFields = ['NamaKategori'];
}

