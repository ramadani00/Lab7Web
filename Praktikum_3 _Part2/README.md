<img src="https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExbmhmaTQzeTkyM2thcjd1Mnlwa2d5eWp5cTU3Nnk4ZGpnc2RocTdnZiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/lM2TNaYAer3NN4d6eF/giphy.gif"  style="width: 500px; height: auto;" alt="Description"/>

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


# Menampilkan Artikel Berdasarkan Kategori dengan View Cell

Berikut adalah penjelasan dan langkah-langkah untuk membuat View Cell menampilkan artikel berdasarkan kategori tertentu:

## 1. Tambahkan Parameter `kategori` pada Method `render`
Pada langkah ini, Anda perlu memperbarui method `render` di dalam class `ArtikelTerkini` agar dapat menerima parameter `kategori`. Parameter ini digunakan untuk memfilter artikel berdasarkan kategori tertentu.

### Contoh Kode:
```php name=app/Cells/ArtikelTerkini.php
namespace App\Cells;

use App\Models\ArtikelModel;

class ArtikelTerkini
{
    public function render($kategori = null)
    {
        $model = new ArtikelModel();
        $query = $model->orderBy('tanggal', 'DESC')->limit(5);

        // Filter berdasarkan kategori jika parameter kategori diberikan
        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $artikel = $query->findAll();
        return view('components/artikel_terkini', ['artikel' => $artikel]);
    }
}
```

### Penjelasan Kode:
- **`$kategori = null`**:  
  Parameter ini bersifat opsional. Jika tidak diberikan, semua artikel akan ditampilkan.

- **`$query->where('kategori', $kategori)`**:  
  Menambahkan filter pada query untuk hanya mengambil artikel dengan kategori tertentu.

- **`$query->orderBy('tanggal', 'DESC')->limit(5)`**:  
  Mengurutkan artikel berdasarkan tanggal secara menurun (artikel terbaru di atas). Membatasi jumlah artikel yang ditampilkan hingga maksimal 5 artikel.

---

## 2. Perbarui Pemanggilan View Cell pada Layout
Pada layout utama (misalnya, `main.php`), tambahkan parameter `kategori` saat memanggil View Cell untuk menentukan kategori artikel yang ingin ditampilkan.

### Contoh Kode:
```php name=app/Views/layouts/main.php
<?= view_cell('App\\Cells\\ArtikelTerkini::render', ['kategori' => 'teknologi']) ?>
```

### Penjelasan Kode:
- **`view_cell('App\\Cells\\ArtikelTerkini::render', ['kategori' => 'teknologi'])`**:  
  Memanggil View Cell `ArtikelTerkini` dan menyertakan parameter `kategori` dengan nilai `'teknologi'`.  
  Hasilnya, hanya artikel dengan kategori `'teknologi'` yang akan ditampilkan.  
  Anda dapat mengganti `'teknologi'` dengan kategori lain sesuai kebutuhan.

---

## 3. Perbarui View `artikel_terkini.php`
Pada file view (`artikel_terkini.php`), tidak diperlukan banyak perubahan karena fungsinya tetap untuk menampilkan daftar artikel. Pastikan view ini sudah menerima data artikel yang difilter sebelumnya.

### Contoh Kode:
```php name=app/Views/components/artikel_terkini.php
<?php if (!empty($artikel)): ?>
    <ul>
        <?php foreach ($artikel as $item): ?>
            <li>
                <a href="<?= site_url('artikel/' . $item['slug']) ?>">
                    <?= esc($item['judul']) ?>
                </a>
                <p><?= date('d M Y', strtotime($item['tanggal'])) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Tidak ada artikel dalam kategori ini.</p>
<?php endif; ?>
```

### Penjelasan Kode:
- **`if (!empty($artikel))`**:  
  Mengecek apakah ada artikel yang telah difilter.

- **`foreach ($artikel as $item)`**:  
  Menampilkan daftar artikel yang diterima dari View Cell.

- **`$item['slug']` dan `$item['judul']`**:  
  Menampilkan slug dan judul artikel.

---

## Kesimpulan
1. **Perbarui class `ArtikelTerkini`**:  
   Tambahkan parameter `kategori` untuk memfilter artikel berdasarkan kategori tertentu.

2. **Perbarui layout utama**:  
   Tambahkan pemanggilan View Cell dengan parameter `kategori`.

3. **Gunakan kembali View `artikel_terkini.php`**:  
   Tidak banyak perubahan, cukup menampilkan artikel yang telah difilter.

Dengan langkah-langkah di atas, Anda dapat menampilkan artikel berdasarkan kategori tertentu menggunakan View Cell di CodeIgniter.
<br>

<br>

  <div class="centered">
    <img src="https://media.giphy.com/media/XLx9jXZXzm8Sv415Tf/giphy.gif?cid=ecf05e47hk6i4tunpqmceczwxjzujix9sxxpbjv2f4woa33v&ep=v1_stickers_search&rid=giphy.gif&ct=s" 
         style="width: 400px; height: auto;" 
         alt="Description"/>
  </div>
