<img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExbmhmaTQzeTkyM2thcjd1Mnlwa2d5eWp5cTU3Nnk4ZGpnc2RocTdnZiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/lM2TNaYAer3NN4d6eF/giphy.gif"  style="width: 500px; height: auto;" alt="Description"/>

### Dini Ramadani | Universitas Pelita Bangsa

<h1 style="color: blue; font-size: 36px; text-align: center;">Praktikum 5 | Pagination Dan Pencarian</h1>
<br>

<div class="navbar">
  <h2>📚 Daftar Isi</h2>
  <ul class="toc-list">
    <li><a href="#langkah-langkah-praktikum">Langkah-langkah Praktikum</a></li>
    <li><a href="#membuat-pagination">Membuat Pagination</a></li>
    <li><a href="#membuat-pencarian">Membuat Pencarian</a></li>
    <li><a href="#hasil-uji-coba">Hasil Uji Coba</a></li>
  </ul>
</div>

<br>

## Langkah-langkah Praktikum


## Membuat Pagination
Pagination merupakan proses yang digunakan untuk membatasi tampilan yang panjang dari data yang banyak pada sebuah website. Fungsi pagination adalah memecah tampilan menjadi beberapa halaman tergantung banyaknya data yang akan ditampilkan pada setiap halaman. Pada Codeigniter 4, fungsi pagination sudah tersedia pada Library sehingga cukup mudah menggunakannya.
Untuk membuat pagination, buka Kembali ``Controller Artikel``, kemudian modifikasi kode pada method ``admin_index`` seperti berikut.

```php
   public function admin_index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $data = [
            'title' => $title,
            'artikel' => $model->paginate(10),
            'pager' => $model->pager,
        ];

        return view('artikel/admin_index', $data);
    }
```
![img1](assets/img/adminindex.png)
<br>

<br>

Kemudian buka file ``views/artikel/admin_index.php`` dan tambahkan kode berikut dibawah deklarasi tabel data.

```php
<?= $pager->links(); ?>
```

![img2](assets/img/viewsadminindex.png)
<br>


<br>
Selanjutnya buka kembali menu daftar artikel, tambahkan data lagi untuk melihat hasilnya.

![img3](assets/img/adminartikel.png)
<br>

<br>

## Membuat Pencarian
Pencarian data digunakan untuk memfilter data. Untuk membuat pencarian data, buka kembali ``Controller Artikel``, pada method ``admin_index`` ubah kodenya seperti berikut

```php
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
```

![img4](assets/img/admin_index.png)
<br>

<br>

Kemudian buka kembali file ``views/artikel/admin_index.php`` dan tambahkan form pencarian sebelum deklarasi tabel seperti berikut:

```php
<form method="get" class="form-search">
  <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari data">
  <input type="submit" value="Cari" class="btn btn-primary">
</form>
```

![img5](assets/img/search.png)
<br>

<br>

Dan pada link pager ubah seperti berikut.

```php
<?= $pager->only(['q'])->links(); ?>
```

![img6](assets/img/pager.png)
<br>


<br>

<br>

## Hasil Uji Coba
Selanjutnya ujicoba dengan membuka kembali halaman admin artikel, masukkan kata kunci tertentu pada form pencarian.


![img7](assets/img/ujicoba.png)
<br>

<br>

![img7](assets/img/ujicobasearch.png)
<br>

<br>


<br>

  <div class="centered">
    <img src="https://media.giphy.com/media/XLx9jXZXzm8Sv415Tf/giphy.gif?cid=ecf05e47hk6i4tunpqmceczwxjzujix9sxxpbjv2f4woa33v&ep=v1_stickers_search&rid=giphy.gif&ct=s" 
         style="width: 400px; height: auto;" 
         alt="Description"/>
  </div>