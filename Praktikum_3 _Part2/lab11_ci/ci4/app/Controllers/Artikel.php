<?php
namespace App\Controllers;
use App\Models\ArtikelModel;
class Artikel extends BaseController
{
    public function index()
    {
        $model = new \App\Models\ArtikelModel();
        $kategori = $this->request->getGet('kategori'); 

        if ($kategori) {
            $artikel = $model->where('kategori', $kategori)->findAll();
        } else {
            $artikel = $model->findAll();
        }

        $data = [
            'artikel' => $artikel,
            'kategori' => $kategori,
        ];

        return view('artikel/index', $data);
    }
    public function view($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model->where([
            'slug' => $slug
        ])->first();
        if (!$artikel) 
        {
            throw PageNotFoundException::forPageNotFound();
        }
        $title = $artikel['judul'];
        return view('artikel/detail', compact('artikel', 'title'));
    }

    public function admin_index() 
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        return view('artikel/admin_index', compact('artikel', 'title'));
    }

    public function add()
    {
        $model = new ArtikelModel();

        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'judul' => 'required',
                'isi' => 'required',
                'kategori' => 'required',
                'gambar' => 'mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,2048]',
            ]);

            if ($validation->withRequest($this->request)->run()) {
                // Handle uploaded image
                $gambar = $this->request->getFile('gambar');
                $gambarName = null;
                if ($gambar && $gambar->isValid()) {
                    $gambarName = $gambar->getRandomName();
                    $gambar->move('uploads', $gambarName);
                }

                // Save data to database
                $model->insert([
                    'judul' => $this->request->getPost('judul'),
                    'isi' => $this->request->getPost('isi'),
                    'kategori' => $this->request->getPost('kategori'),
                    'gambar' => $gambarName,
                ]);

                return redirect()->to('/admin/artikel')->with('success', 'Artikel berhasil ditambahkan.');
            } else {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }

        $data['title'] = 'Tambah Artikel';
        return view('artikel/form', $data);
    }

    public function edit($id) 
    {
        $artikel = new ArtikelModel();
    
        // Validasi data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'isi' => 'required',
            'kategori' => 'required',
            'gambar' => 'mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,2048]',
        ]);
    
        $isDataValid = $validation->withRequest($this->request)->run();
    
        if ($isDataValid) {
            // Handle upload gambar jika ada file baru
            $gambar = $this->request->getFile('gambar');
            $gambarName = $this->request->getPost('gambar_lama'); // Ambil nama gambar lama sebagai default
    
            if ($gambar && $gambar->isValid()) {
                $gambarName = $gambar->getRandomName(); // Generate nama acak untuk file baru
                $gambar->move('uploads', $gambarName); // Pindahkan file ke folder uploads
            }
    
            // Update data artikel
            $artikel->update($id, [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'kategori' => $this->request->getPost('kategori'),
                'status' => 'publish',
                'slug' => url_title($this->request->getPost('judul')),
                'gambar' => $gambarName,
            ]);
    
            return redirect()->to('/admin/artikel')->with('success', 'Artikel berhasil diperbarui.');
        }
    
        // Ambil data lama
        $data = $artikel->where('id', $id)->first();
        $title = "Edit Artikel";
    
        return view('artikel/form_edit', compact('title', 'data'));
    }

    public function delete($id) 
    {
        $artikel = new ArtikelModel();
        $artikel->delete($id);
        return redirect('admin/artikel');
    }
    public function terkini()
    {
        $model = new ArtikelModel();
        $artikel = $model->orderBy('tanggal', 'DESC')->findAll(5);
        $title = 'Artikel Terkini';
        return view('artikel/terkini', compact('artikel', 'title'));
    }


}