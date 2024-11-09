<?php

namespace App\Models;

use CodeIgniter\Model;

class DatabaseTestModel extends Model
{
    protected $table = 'user'; // Ganti dengan nama tabel yang ada di database kamu
    protected $primaryKey = 'UserID'; // Ganti dengan primary key tabel
}
