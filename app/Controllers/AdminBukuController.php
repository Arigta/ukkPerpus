<?php
namespace App\Controllers;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use CodeIgniter\Controller;

class AdminBukuController extends Controller
{
    public function adbuku()
    {
        $model = new BukuModel();
        $kategoriModel = new KategoriModel();
        $data['buku'] = $model->getBookWithCategories();
        $data['kategori'] = $kategoriModel->findAll();
        return view('admin/bukuAd', $data);
    }

    public function detail($id)
    {
        $model = new BukuModel();
        $buku = $model->getBookWithCategories($id);
        
        return $this->response->setJSON($buku ?? ['error' => 'Buku tidak ditemukan']);
    }

    public function save()
    {
        $bukuModel = new BukuModel();
        $db = \Config\Database::connect();
        
        try {
            // Start transaction
            $db->transStart();
            
            $id = $this->request->getPost('id');
            $kategori = $this->request->getPost('kategori');
            
            // Prepare book data
            $bukuData = [
                'Judul' => $this->request->getPost('judul'),
                'Penulis' => $this->request->getPost('penulis'),
                'Penerbit' => $this->request->getPost('penerbit'),
                'TahunTerbit' => $this->request->getPost('tahun_terbit'),
                'Deskripsi' => $this->request->getPost('deskripsi')
            ];

            // Handle file upload
            $fileGambar = $this->request->getFile('gambar');
            if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
                $newName = $fileGambar->getRandomName();
                $fileGambar->move('assets/img/buku', $newName);
                $bukuData['gambar'] = $newName;
            } elseif (!$id) {
                // Only set default image for new books
                $bukuData['gambar'] = 'default.jpg';
            }

            // Update or Insert book
            if ($id) {
                // If editing, only update if successful
                if (!$bukuModel->update($id, $bukuData)) {
                    throw new \Exception('Gagal mengupdate buku');
                }
                
                // Delete existing category relations
                $db->table('kategoribuku_relasi')->where('BukuID', $id)->delete();
            } else {
                // If adding new book
                if (!$bukuModel->insert($bukuData)) {
                    throw new \Exception('Gagal menambah buku');
                }
                $id = $bukuModel->getInsertID();
            }

            // Insert new category relations
            if (!empty($kategori)) {
                $kategoriData = [];
                foreach ($kategori as $katId) {
                    $kategoriData[] = [
                        'BukuID' => $id,
                        'KategoriID' => $katId
                    ];
                }
                $db->table('kategoribuku_relasi')->insertBatch($kategoriData);
            }

            // Commit transaction
            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan data');
            }

            session()->setFlashdata('message', 'Data buku berhasil disimpan');
            return redirect()->to('/admin/buku')->with('success', 'Data berhasil disimpan');

        } catch (\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $bukuModel = new BukuModel();
            $db = \Config\Database::connect();
            
            $db->transStart();
            
            // Delete category relations first
            $db->table('kategoribuku_relasi')->where('BukuID', $id)->delete();
            
            // Then delete the book
            if (!$bukuModel->delete($id)) {
                throw new \Exception('Gagal menghapus buku');
            }
            
            $db->transComplete();
            
            session()->setFlashdata('message', 'Buku berhasil dihapus');
            return redirect()->to('/admin/buku');
            
        } catch (\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back();
        }
    }
}