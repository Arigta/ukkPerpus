<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
  public function dashboard()
  {
      if (!session()->get('loggedIn') || session()->get('role') !== 'admin') {
          return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu.');
      }
  
      return view('admin/dashboard');
  }
  

}
