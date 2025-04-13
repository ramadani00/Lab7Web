<img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExbmhmaTQzeTkyM2thcjd1Mnlwa2d5eWp5cTU3Nnk4ZGpnc2RocTdnZiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/lM2TNaYAer3NN4d6eF/giphy.gif"  style="width: 500px; height: auto;" alt="Description"/>

### Dini Ramadani | Universitas Pelita Bangsa

<h1 style="color: blue; font-size: 36px; text-align: center;">Praktikum 3 Part 1 | View Layout dan View Cell</h1>

<br>

<div class="navbar">
  <h2>📚 Daftar Isi</h2>
  <ul class="toc-list">
    <li><a href="#persiapan">📌 Persiapan</a></li>
    <li><a href="#membuat-layout-utama">🗂️ Membuat Layout Utama</a></li>
    <li><a href="#membuat-file-view">📝 Membuat File View</a></li>
    <li><a href="#menampilkan-data-dinamis-dengan-view-cell">🔄 Menampilkan Data Dinamis dengan View Cell</a></li>
    <li><a href="#membuat-class-view-cell">🔧 Membuat Class View Cell</a></li>
    <li><a href="#membuat-view-untuk-view-cell">🖼️ Membuat View untuk View Cell</a></li>
    <li><a href="#menambahkan-field-tanggal">🕒 Menambahkan Field Tanggal</a></li>
    <li><a href="#perbarui-struktur-database">💾 Perbarui Struktur Database</a></li>
    <li><a href="#perbarui-model-artikel">🛠️ Perbarui Model Artikel</a></li>
    <li><a href="#tampilan-view-cell">🔲 Tampilan View Cell</a></li>
    <li><a href="#manfaat-penggunaan-view-layout">✨ Manfaat Penggunaan View Layout</a></li>
    <li><a href="#perbedaan-view-cell-dan-view-biasa">📊 Perbedaan View Cell dan View Biasa</a></li>
  </ul>
</div>


<br>

## Persiapan :
Pada praktikum sebelumnya kita telah menggunakan template layout dengan konsep parsial atau memecah bagian template menjadi beberapa bagian untuk kemudian di include pada view yang lain. Praktikum kali ini kita akan mengunakan konsep View Layout dan View Cell untuk memudahkan dalam penggunaan layout.

<br>

## Membuat Layout Utama
- Buat folder ``layout`` di dalam ``app/Views/``.
- Buat file ``main.php`` di dalam folder ``layout`` dengan kode berikut :
  
    ```php
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $title ?? 'Dini Website' ?></title>
        <link rel="stylesheet" href="<?= base_url('/style.css');?>">
    </head>
    <body>
        <div id="container">
            <header>
                <h1>Layout Sederhana</h1>
            </header>
            <nav>
                <a href="<?= base_url('/');?>">Home</a>
                <a href="<?= base_url('/artikel');?>">Artikel</a>
                <a href="<?= base_url('/about');?>">About</a>
                <a href="<?= base_url('/contact');?>">Kontak</a>
            </nav>
            <section id="wrapper">
                <section id="main">
                    <?= $this->renderSection('content') ?>
                </section>
                <aside id="sidebar">
                    <?= view_cell('App\\Cells\\ArtikelTerkini::render') ?>
                    <div class="widget-box">
                        <h3 class="title">Widget Header</h3>
                        <ul>
                            <li><a href="#">Widget Link</a></li>
                            <li><a href="#">Widget Link</a></li>
                        </ul>
                    </div>
                    <div class="widget-box">
                        <h3 class="title">Widget Text</h3>
                        <p>Vestibulum lorem elit, iaculis in nisl volutpat, malesuada tincidunt arcu. Proin in leo fringilla, 
                            vestibulum mi porta, faucibus felis. Integer pharetra est nunc, nec pretium nunc pretium ac.</p>
                    </div>
                </aside>
            </section>
            <footer>
                <p>&copy; 2021 - Universitas Pelita Bangsa</p>
            </footer>
        </div>
    </body>
    </html>
    ```
    
![img1](assets/img/mainphp.png)
<br>

<br>

## Membuat File View
- Ubah ``app/Views/home.php`` agar sesuai dengan layout baru :

```php
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h1><?= $title; ?></h1><br>
<hr>
<br><p><?= $content; ?></p>

<?= $this->endSection() ?>
```

![img2](assets/img/homephp.png)
<br>
Sesuaikan juga untuk halaman lainnya yang ingin menggunakan format layout yang baru.
<br>

## Menampilkan Data Dinamis dengan View Cell
View Cell adalah fitur yang memungkinkan pemanggilan tampilan dalam bentuk komponen yang dapat digunakan ulang. Cocok digunakan untuk elemen-elemen yang sering muncul di berbagai halaman seperti sidebar, widget, atau menu navigasi.


<br>

## Membuat Class View Cell
- Buat folder ``Cells`` di dalam ``app/``
- Buat file ``ArtikelTerkini.php`` di dalam ``app/Cells/`` dengan kode berikut:

```php
<?php
namespace App\Cells;

use App\Models\ArtikelModel;

class ArtikelTerkini
{
    public function render()
    {
        $model = new ArtikelModel();
        $artikel = $model->orderBy('tanggal', 'DESC')->limit(5)->findAll();
        return view('components/artikel_terkini', ['artikel' => $artikel]);
    }
}
```

![img3](assets/img/artikelterkiniphp.png)
<br>

<br>

## Membuat View untuk View Cell
- Buat folder ``components`` di dalam ``app/Views/``
- Buat file ``artikel_terkini.php`` di dalam ``app/Views/components/`` dengan kode berikut :

```php
<div class="widget-box">
    <h3 class="title">Artikel Terkini</h3>
    <ul>
        <?php foreach ($artikel as $row): ?>
        <li>
            <a href="<?= base_url('/artikel/' . $row['slug']) ?>">
                <?= esc($row['judul']) ?>
            </a>
            <span class="tanggal">Diterbitkan pada: <?= date('d M Y', strtotime($row['tanggal'])) ?></span>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
```

<br>

![img4](assets/img/artikel_terkini.png)
<br>

<br>

## Menambahkan field Tanggal
Sesuaikan data dengan praktikum sebelumnya, perlu melakukan perubahan field pada database dengan menambahkan tanggal agar dapat mengambil data artikel terbaru.

<br>

## Perbarui Struktur Database
Langkah ini bertujuan untuk menambahkan kolom baru ke dalam tabel artikel di database Anda. Kolom tersebut akan menyimpan data tanggal dalam format ``DATETIME``.

```sql
ALTER TABLE artikel ADD COLUMN tanggal DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
```

<br>

![img4](assets/img/addtanggal.png)
<br>

<br>

## Perbarui Model Artikel
Setelah struktur tabel diperbarui, Anda perlu memastikan bahwa model ``ArtikelModel`` yang digunakan dalam aplikasi telah diperbarui untuk mendukung kolom baru ini. 
- Terletak pada ``app/Models/`` ubah file ``ArtikelModel.php``.

```php
<?php
namespace App\Models;
use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'isi', 'status', 'slug', 'gambar', 'tanggal'];
}
```

<br>

![img4](assets/img/artikelmodel.png)
<br>



## Tampilan View Cell
Berikut adalah tampilan ``View Cell`` di setiap halaman. Komponen ``Artikel Terkini`` ditampilkan di sisi kanan layout pada seluruh halaman, lengkap dengan tanggal publikasinya."

- Page ``Home``
<br>

![img5](assets/img/dashboard.png)
<br>

- Page ``Artikel``
<br>

![img6](assets/img/artikel.png)
<br>

- Page ``About``
<br>

![img7](assets/img/about.png)
<br>

- Page ``Kontak``
<br>

![img8](assets/img/kontak.png)
<br>

- Tampilan View Cell Wigdet Ketika di Klik
<br>

![img8](assets/img/cell1.png)
<br>


![img8](assets/img/cell2.png)
<br>

<br>

<br>

## Manfaat Penggunaan View Layout
Penggunaan View Layout dalam pengembangan aplikasi web memiliki berbagai keuntungan yang signifikan, terutama dalam hal efisiensi dan keteraturan pengkodean. Berikut adalah beberapa manfaat utamanya:

- Konsistensi Antar Halaman : Semua halaman menggunakan struktur layout yang sama, sehingga tampilan dan pengalaman pengguna menjadi seragam di seluruh situs.
- Efisiensi dalam Pengembangan : Developer tidak perlu menyalin ulang struktur layout untuk setiap halaman. Cukup dengan perintah extend, konten spesifik dapat disisipkan ke dalam layout utama.
- Kemudahan Pemeliharaan : Jika ada perubahan pada bagian umum seperti header, footer, atau sidebar, cukup ubah di satu file layout utama. Hal ini sangat menghemat waktu dan mengurangi risiko kesalahan.
- Modularitas : Dengan memisahkan antara layout dan konten utama, struktur kode menjadi lebih terorganisir, modular, dan mudah dikelola.
- Reusability (Dapat Digunakan Kembali) : Layout yang sudah dibuat dapat digunakan di berbagai halaman tanpa perlu menulis ulang kode, sehingga meningkatkan produktivitas dan menghindari duplikasi.

<br>

## Perbedaan View Cell dan View Biasa
Tabel berikut menjelaskan secara ringkas perbedaan mendasar antara View Cell dan View Biasa dalam konteks pengembangan aplikasi menggunakan CodeIgniter:
<br>

<table border="1" cellpadding="10" cellspacing="0">
  <thead>
    <tr>
      <th><strong>Aspek</strong></th>
      <th><strong>View Cell</strong></th>
      <th><strong>View Biasa</strong></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Definisi</strong></td>
      <td>Komponen kecil dan dinamis yang digunakan untuk menampilkan bagian tertentu dari halaman, biasanya berisi data dari DB.</td>
      <td>View utama halaman yang menampilkan konten statis atau dinamis langsung dari controller.</td>
    </tr>
    <tr>
      <td><strong>Tujuan</strong></td>
      <td>Untuk menampilkan elemen reusable seperti sidebar, widget, atau komponen kecil yang sering digunakan ulang.</td>
      <td>Untuk menampilkan konten utama dari sebuah halaman seperti home, artikel, atau tentang.</td>
    </tr>
    <tr>
      <td><strong>Struktur</strong></td>
      <td>Menggunakan class tersendiri di folder <code>app/Cells/</code> dan view khusus di folder <code>views/components</code>.</td>
      <td>Hanya berupa file view di folder <code>views/</code> tanpa class logika tambahan.</td>
    </tr>
    <tr>
      <td><strong>Logika</strong></td>
      <td>Memiliki logika sendiri yang memungkinkan pengambilan atau pengolahan data sebelum ditampilkan.</td>
      <td>Logika ditangani sepenuhnya di controller. View hanya menampilkan hasilnya.</td>
    </tr>
    <tr>
      <td><strong>Reusability</strong></td>
      <td>Sangat tinggi – dapat digunakan di banyak halaman/layout tanpa duplikasi kode.</td>
      <td>Terbatas – biasanya hanya digunakan pada halaman tertentu.</td>
    </tr>
    <tr>
      <td><strong>Contoh Penggunaan</strong></td>
      <td>Widget Artikel Terkini, Daftar Kategori, Komentar Terbaru.</td>
      <td>View untuk halaman seperti <code>home.php</code>, <code>about.php</code>, <code>contact.php</code>.</td>
    </tr>
    <tr>
      <td><strong>Pemanggilan</strong></td>
      <td>Menggunakan <code>view_cell('NamaClass::render')</code> di dalam layout.</td>
      <td>Dipanggil melalui <code>return view('nama_view')</code> dari controller.</td>
    </tr>
  </tbody>
</table>


<br>

<br>

  <div class="centered">
    <img src="https://media.giphy.com/media/XLx9jXZXzm8Sv415Tf/giphy.gif?cid=ecf05e47hk6i4tunpqmceczwxjzujix9sxxpbjv2f4woa33v&ep=v1_stickers_search&rid=giphy.gif&ct=s" 
         style="width: 400px; height: auto;" 
         alt="Description"/>
  </div>
