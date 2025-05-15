<?php
namespace App\Controllers;

use App\Models\ArtikelModel;
use Parsedown;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    public function index()
    {
        $model = new ArtikelModel();
        $kategori = $this->request->getGet('kategori');

        $artikel = $kategori
            ? $model->where('kategori', $kategori)->orderBy('tanggal', 'DESC')->findAll()
            : $model->orderBy('tanggal', 'DESC')->findAll();

        $data = [
            'artikel' => $artikel,
            'kategori' => $kategori,
        ];

        return view('artikel/index', $data);
    }

    public function view($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model->where(['slug' => $slug])->first();

        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound();
        }

        $parsedown = new Parsedown();
        $artikel['isi'] = $parsedown->text($artikel['isi']);

        $title = $artikel['judul'];
        return view('artikel/detail', compact('artikel', 'title'));
    }

    public function admin_index()
    {
        $title = 'Daftar Artikel';
        $q = $this->request->getVar('q') ?? '';
        $model = new ArtikelModel();
        $data = [
            'title' => $title,
            'q' => $q,
            'artikel' => $model->like('judul', $q)->paginate(10),
            'pager' => $model->pager,
        ];

        return view('artikel/admin_index', $data);
    }

    public function add() 
    {
        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid)
        {
            $artikel = new ArtikelModel();
            $artikel->insert([
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'status' => 'publish',
                'slug' => url_title($this->request->getPost('judul')),
                'gambar' => $this->request->getPost('gambar'),
                'kategori' => $this->request->getPost('kategori'),
            ]);
            return redirect('admin/artikel');
        }
        $title = "Tambah Artikel";
        return view('artikel/form_add', compact('title'));
    }

    public function edit($id) 
    {
        $artikel = new ArtikelModel();

        $validation = \Config\Services::validation();
        $validation->setRules(['judul' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid)
        {
            $artikel->update($id, [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'status' => 'publish',
                'slug' => url_title($this->request->getPost('judul')),
                'gambar' => $this->request->getPost('gambar'),
                'kategori' => $this->request->getPost('kategori'),
            ]);
            return redirect('admin/artikel');
        }
        $data = $artikel->where('id', $id)->first();
        $title = "Edit Artikel";
        return view('artikel/form_edit', compact('title', 'data'));
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $artikel = $model->find($id);

        if (!$artikel) {
            return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
        }

        $model->delete($id);
        return redirect()->to('/admin/artikel')->with('success', 'Artikel berhasil dihapus.');
    }

    public function terkini()
    {
        $model = new ArtikelModel();
        $artikel = $model->orderBy('tanggal', 'DESC')->findAll(15);
        $title = 'Artikel Terkini';

        return view('artikel/terkini', compact('artikel', 'title'));
    }
}