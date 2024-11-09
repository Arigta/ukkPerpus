<?php

namespace App\Controllers;

class Home extends BaseController
{
   // public function index(): string
    //{
    //    return view('welcome_message');
    //}
    public function dashboard()
    {
        if (session()->get('role') !== 'peminjam') {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }
        return view('peminjam/dashboard');
    }
}
