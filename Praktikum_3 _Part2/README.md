<img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExbmhmaTQzeTkyM2thcjd1Mnlwa2d5eWp5cTU3Nnk4ZGpnc2RocTdnZiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/lM2TNaYAer3NN4d6eF/giphy.gif"  
     style="width: 500px; height: auto;" 
     alt="Gambar Ilustrasi"/>

### Dini Ramadani | Universitas Pelita Bangsa

<h1 style="color: blue; font-size: 36px; text-align: center;">Praktikum 3 Part 2 | Menampilkan Artikel Berdasarkan Kategori</h1>
<br>

<div class="navbar">
  <h2>📚 Daftar Isi</h2>
  <ul class="toc-list">
    <li><a href="#menampilkan-post-dengan-kategori">📰 Menampilkan Post dengan Kategori</a></li>
    <li><a href="#menambahkan-parameter-kategori">⚙️ Menambahkan Parameter Kategori</a></li>
  </ul>
</div>

<br>

---

# Tutorial: Membuat View Cell untuk Menampilkan Artikel Berdasarkan Kategori

Dalam pengembangan aplikasi berbasis PHP dengan framework seperti CodeIgniter, sering kali kita membutuhkan fitur dinamis untuk menampilkan data tertentu berdasarkan kategori yang dipilih oleh pengguna. Dalam tutorial ini, kita akan membahas langkah-langkah untuk membuat **View Cell** yang dapat menampilkan artikel terkini berdasarkan kategori yang diinginkan.

---

## Pendahuluan

View Cell adalah fitur yang sangat berguna untuk memisahkan logika kecil tertentu dari controller atau view utama. Dalam kasus ini, kita akan menggunakan View Cell untuk menampilkan artikel terkini berdasarkan kategori. Dengan implementasi ini, Anda akan memungkinkan pengguna memilih kategori tertentu melalui dropdown, dan konten artikel akan diperbarui secara dinamis.

---

## Langkah-langkah Implementasi

### 1. Pastikan View Cell Mendukung Parameter Kategori

Langkah pertama adalah memastikan bahwa View Cell Anda mendukung parameter `kategori`. Parameter ini akan digunakan untuk memfilter data artikel yang ditampilkan.

**Contoh Implementasi View Cell:**
```php name=ArtikelTerkini.php
<?php
namespace App\Cells;

use App\Models\ArtikelModel;

class ArtikelTerkini
{
    protected $artikelModel;
    
    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
    }

    public function render($kategori = null)
    {
        $artikel = $this->artikelModel->getArtikelByKategori($kategori);
        return view('components/artikel_terkini', [
            'kategori' => $kategori,
            'artikel' => $artikel,
        ]);
    }
}
```

Kode di atas menunjukkan bahwa View Cell `ArtikelTerkini` menerima parameter `kategori` dan menggunakannya untuk memproses data artikel.

---

### 2. Pastikan View Menampilkan Data Berdasarkan Kategori

Selanjutnya, pastikan bahwa view yang digunakan oleh View Cell mendukung parameter `kategori`. View ini akan menampilkan data artikel berdasarkan kategori tertentu.

**Contoh View:**
```php name=artikel_terkini.php
<div class="widget-box">
    <h3 class="title">Artikel Terkini<?= $kategori ? ' - ' . ucfirst(esc($kategori)) : ''; ?></h3>
    <ul>
        <?php if (!empty($artikel)): ?>
            <?php foreach ($artikel as $item): ?>
                <li>
                    <a href="<?= esc($item['url']); ?>"><?= esc($item['judul']); ?></a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Tidak ada artikel untuk kategori ini.</li>
        <?php endif; ?>
    </ul>
</div>
```

Penjelasan:
- Menampilkan judul artikel terkini sesuai dengan kategori.
- Jika kategori ada, maka judul akan menampilkan nama kategori.

---

### 3. Gunakan View Cell dengan Parameter Kategori

Untuk menampilkan data artikel terkini dengan kategori tertentu, gunakan View Cell di bagian kode yang sesuai.

**Contoh Implementasi di Sidebar:**
```php name=sidebar.php
<aside id="sidebar">
    <?= view_cell('App\\Cells\\ArtikelTerkini::render', ['kategori' => 'teknologi']) ?>
</aside>
```

Kode di atas memanggil View Cell `ArtikelTerkini` dan menyertakan parameter `kategori` dengan nilai `teknologi`.

---

### 4. Menambahkan Dropdown untuk Memilih Kategori

Jika Anda ingin memberikan opsi kepada pengguna untuk memilih kategori melalui dropdown, ikuti langkah berikut:

**Tambahkan Dropdown di Sidebar:**
```php name=sidebar.php
<aside id="sidebar">
    <form action="" method="get">
        <select name="kategori" onchange="this.form.submit()" class="form-select">
            <option value="">Semua Kategori</option>
            <option value="teknologi" <?= request()->getGet('kategori') === 'teknologi' ? 'selected' : ''; ?>>Teknologi</option>
            <option value="politik" <?= request()->getGet('kategori') === 'politik' ? 'selected' : ''; ?>>Politik</option>
            <option value="olahraga" <?= request()->getGet('kategori') === 'olahraga' ? 'selected' : ''; ?>>Olahraga</option>
        </select>
    </form>
</aside>
```

Penjelasan:
- Dropdown memungkinkan pengguna memilih kategori.
- Ketika kategori dipilih, form akan otomatis dikirimkan menggunakan `onchange="this.form.submit()"`.
- Parameter `kategori` akan diambil dari URL dengan `request()->getGet('kategori')`.

---

### 5. Hasil Akhir

Dengan implementasi ini:
- Sidebar akan menampilkan dropdown untuk memilih kategori.
- Setelah kategori dipilih, daftar artikel akan diperbarui sesuai kategori yang dipilih.
- Jika tidak ada kategori yang dipilih, semua artikel akan ditampilkan.

---

### 6. Catatan Tambahan

- **Validasi Input:** Pastikan bahwa parameter `kategori` yang diterima valid dan sesuai dengan data di database.
- **Default Kategori:** Jika kategori tidak dipilih, tampilkan semua artikel.
- **Pagination:** Jika jumlah artikel terlalu banyak, pertimbangkan untuk menambahkan pagination.

---

Dengan langkah-langkah di atas, Anda telah berhasil membuat View Cell yang dinamis untuk menampilkan artikel terkini berdasarkan kategori. Fitur ini akan memberikan pengalaman yang lebih baik bagi pengguna dalam menjelajahi artikel di aplikasi Anda.

<br>

<div class="centered">
  <img src="https://media.giphy.com/media/XLx9jXZXzm8Sv415Tf/giphy.gif?cid=ecf05e47hk6i4tunpqmceczwxjzujix9sxxpbjv2f4woa33v&ep=v1_stickers_search&rid=giphy.gif&ct=s" 
       style="width: 400px; height: auto;" 
       alt="Gambar Ilustrasi Tambahan"/>
</div>