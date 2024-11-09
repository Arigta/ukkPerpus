<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function storeRegister()
    {
        $userModel = new UserModel();

        $data = [
            'Username'    => $this->request->getPost('username'),
            'Password'    => $this->request->getPost('password'),
            'Email'       => $this->request->getPost('email'),
            'NamaLengkap' => $this->request->getPost('nama_lengkap'),
            'Alamat'      => $this->request->getPost('alamat'),
            'role'        => 'peminjam' // Role default untuk user baru
        ];

        $userModel->insert($data);
        session()->setFlashdata('message', 'Registrasi berhasil, silakan loginss.');
        return redirect()->to('/login');

        // Cek apakah flash data diset
        if (session()->getFlashdata('message')) {
            echo 'Flash data set!';
        }
    }

    public function login()
    {
        // Tambahkan debug untuk memastikan session berfungsi
        $sessionMessage = session()->getFlashdata('message');
        if ($sessionMessage) {
            echo "Flash Message: " . $sessionMessage; // Debug output
        }
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        // Ambil data pengguna berdasarkan username
        $user = $userModel->where('Username', $username)->first();
        
        // Verifikasi password
        if ($user && password_verify($password, $user['Password'])) {
            // Simpan data sesi berdasarkan role
            session()->set([
                'UserID' => $user['UserID'],
                'username' => $user['Username'],
                'role'     => $user['role'],
                'loggedIn' => true,
            ]);
    
            // Redirect berdasarkan role
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard')->with('message', 'ADMIN DATANG' . '!');
            } elseif ($user['role'] === 'peminjam') {
                return redirect()->to('/peminjam/dashboard/' . $user['UserID'])->with('message', 'Selamat datang, ' . $user['NamaLengkap'] . '!');
} else {
            }
        } else {
            return redirect()->back()->with('error', 'Username atau password salah');
        }
    }
    
    



    public function logout()
    {
        log_message('info', 'User logging out');
        session()->destroy();
        log_message('info', 'Session destroyed');
        return redirect()->to('/login')->with('message', 'Anda telah berhasil logout.');
    }
    
    
}
