<?php
// BukuController.php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\PeminjamanModel;

class BukuController extends BaseController
{
    protected $bukuModel;
    protected $peminjamanModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function index($userID, $bukuID = null)
    {
        // Get all books
        $books = $this->bukuModel->findAll();
        
        // Check borrowed status for each book
        foreach ($books as &$book) {
            $book['isDipinjam'] = $this->peminjamanModel->isBookBorrowed($book['BukuID']);
            
            // Optional: Get borrower info if needed
            if ($book['isDipinjam']) {
                $borrowInfo = $this->peminjamanModel
                    ->where('BukuID', $book['BukuID'])
                    ->where('StatusPeminjaman', 'Dipinjam')
                    ->first();
                $book['tanggalPengembalian'] = $borrowInfo['TanggalPengembalian'] ?? null;
            }
        }

        $data = [
            'buku' => $books,
            'UserID' => $userID
        ];

        // If specific book detail is requested
        if ($bukuID !== null) {
            $bukuDetail = $this->bukuModel->find($bukuID);
            if ($bukuDetail) {
                $bukuDetail['isDipinjam'] = $this->peminjamanModel->isBookBorrowed($bukuID);
                $data['bukuDetail'] = $bukuDetail;
            } else {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan');
            }
        }

        return view('peminjam/buku', $data);
    }

    // Add method to get book status via AJAX
    public function checkStatus($bukuID)
    {
        $status = $this->peminjamanModel->isBookBorrowed($bukuID);
        return $this->response->setJSON([
            'isDipinjam' => $status
        ]);
    }
}