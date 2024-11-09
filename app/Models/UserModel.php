<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'UserID';
    protected $allowedFields = ['Username', 'Password', 'Email', 'NamaLengkap', 'Alamat', 'role'];

    // Enkripsi password sebelum simpan
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['Password'])) {
            $data['data']['Password'] = password_hash($data['data']['Password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
