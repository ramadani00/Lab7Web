<?php
namespace App\Cells;

use App\Models\ArtikelModel;

class ArtikelTerkini
{
    public function render($kategori = null)
    {
        $model = new ArtikelModel();
        $query = $model->orderBy('tanggal', 'DESC')->limit(5);


        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $artikel = $query->findAll();
        
        return view('components/artikel_terkini', [
            'artikel' => $artikel,
            'kategori' => $kategori,
        ]);
    }
}