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
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori Artikel</label>
            <select name="kategori" id="kategori" class="form-control" required>
                <option value="teknologi" <?= (old('kategori') ?? $data['kategori'] ?? '') == 'teknologi' ? 'selected' : ''; ?>>Teknologi</option>
                <option value="teknologi" <?= (old('kategori') ?? $data['kategori'] ?? '') == 'politik' ? 'selected' : ''; ?>>Politik</option>
                <option value="pendidikan" <?= (old('kategori') ?? $data['kategori'] ?? '') == 'pendidikan' ? 'selected' : ''; ?>>Pendidikan</option>
                <option value="hiburan" <?= (old('kategori') ?? $data['kategori'] ?? '') == 'hiburan' ? 'selected' : ''; ?>>Hiburan</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>

<?= $this->include('template/admin_footer'); ?>
