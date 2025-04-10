<?= $this->include('template/admin_header'); ?>

<div class="container mt-4">
    <h2 class="mb-4"><?= esc($title); ?></h2>

    <form action="" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Artikel</label>
            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul artikel" required>
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi Artikel</label>
            <textarea name="isi" id="isi" cols="50" rows="10" class="form-control" placeholder="Tulis isi artikel..." required></textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Upload Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
        </div>
        <button type="submit" name="upload" class="btn btn-primary">Kirim</button>
    </form>
</div>

<?= $this->include('template/admin_footer'); ?>