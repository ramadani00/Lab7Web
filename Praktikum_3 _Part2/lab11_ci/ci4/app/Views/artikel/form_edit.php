<?= $this->include('template/admin_header'); ?>

<div class="container mt-4">
    <h2 class="mb-4"><?= esc($title); ?></h2>

    <form action="" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Artikel</label>
            <input type="text" name="judul" id="judul" class="form-control" value="<?= esc($data['judul']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi Artikel</label>
            <textarea name="isi" id="isi" rows="10" class="form-control" style="width: 100%;" required><?= esc($data['isi']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Upload Gambar Baru (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
        </div>
        <p>
            <select name="kategori" class="form-control">
                <option value="teknologi" <?= $data['kategori'] == 'teknologi' ? 'selected' : ''; ?>>Teknologi</option>
                <option value="pendidikan" <?= $data['kategori'] == 'pendidikan' ? 'selected' : ''; ?>>Pendidikan</option>
                <option value="hiburan" <?= $data['kategori'] == 'hiburan' ? 'selected' : ''; ?>>Hiburan</option>
            </select>
        </p>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>

<?= $this->include('template/admin_footer'); ?>
