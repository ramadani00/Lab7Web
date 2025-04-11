<?php

namespace App\Controllers;

use App\Models\ArtikelModel;

class Home extends BaseController
{
    public function index()
    {
        $title = 'InfoTerkini.id';
        $content = 'Selamat datang di InfoTerkini.id —   Sumber Berita Terkini, Akurat, dan Terpercaya! Temukan informasi terbaru seputar politik, teknologi, hiburan, olahraga, ekonomi, dan gaya hidup dari berbagai penjuru dunia. Kami hadir 24/7 untuk menyajikan kabar yang penting dan relevan untuk Anda.';
        
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

