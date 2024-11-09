<?php
namespace App\Controllers;

use App\Models\UsersModel;

class UserController extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function pengguna()
    {
        $data['users'] = $this->usersModel->findAll();
        return view('admin/data_anggota', $data);
    }

    // Fungsi untuk hapus anggota
    public function delete($id)
    {
        $this->usersModel->delete($id);
        return redirect()->to('/admin/users')->with('message', 'Anggota berhasil dihapus.');
    }

    // Fungsi untuk menambah anggota
    public function store()
    {
        log_message('info', 'Masuk ke metode store');
    
        // Validasi input
        if (!$this->validate([
            'Username' => 'required',
            'Password' => 'required',
            'Email' => 'required|valid_email',
            'NamaLengkap' => 'required',
            'Alamat' => 'required',
            'role' => 'required'
        ])) {
            log_message('error', 'Validasi gagal: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Ambil data dari form
        $data = [
            'Username'    => $this->request->getPost('Username'), // Pastikan nama field sesuai
            'Password'    => password_hash($this->request->getPost('Password'), PASSWORD_DEFAULT),
            'Email'       => $this->request->getPost('Email'), // Pastikan nama field sesuai
            'NamaLengkap' => $this->request->getPost('NamaLengkap'), // Pastikan nama field sesuai
            'Alamat'      => $this->request->getPost('Alamat'), // Pastikan nama field sesuai
            'role'        =>  $this->request->getPost('role')
        ];
    
        $this->usersModel->insert($data); // Gunakan $this->usersModel
        session()->setFlashdata('message', 'Registrasi berhasil, silakan login.');
        return redirect()->to('/login');
    }
    
   
    public function update($id)
    {
        // Validasi input
        $this->validate([
            'Username' => 'required',
            'Email' => 'required|valid_email',
            'NamaLengkap' => 'required',
            'Alamat' => 'required',
            'role' => 'required'
        ]);

        // Ambil data dari form
        $data = [
            'Username' => $this->request->getPost('Username'),
            'Email' => $this->request->getPost('Email'),
            'NamaLengkap' => $this->request->getPost('NamaLengkap'),
            'Alamat' => $this->request->getPost('Alamat'),
            'role' => $this->request->getPost('role'),
        ];

        // Perbarui data anggota
        $this->usersModel->update($id, $data);

        return redirect()->to('/admin/users')->with('message', 'Anggota berhasil diperbarui.');
    }
    
}


