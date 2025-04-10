<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class Home extends BaseController
{
    public function index()
    {
        $title = 'Beranda';
        $content = 'Selamat datang di halaman beranda!';
        
        $model = new ArtikelModel();
        $artikel = $model->orderBy('tanggal', 'DESC')->findAll();
        $artikel_terkini = $model->orderBy('tanggal', 'DESC')->findAll(3);

        return view('home', compact('artikel', 'artikel_terkini', 'title', 'content'));
    }

    public function postAdmin()
    {
        return view('admin/upload');
    }
}
