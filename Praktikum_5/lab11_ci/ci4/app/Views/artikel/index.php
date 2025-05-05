<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>


<?php if ($artikel && count($artikel) > 0): ?>
    <?php foreach ($artikel as $row): ?>
        <article class="entry mb-4">
            <h2>
                <a href="<?= base_url('/artikel/' . esc($row['slug'])); ?>">
                    <?= esc($row['judul']); ?>
                </a>
            </h2>
            <?php if (!empty($row['gambar'])): ?>
                <img src="<?= base_url('uploads/' . esc($row['gambar'])); ?>" alt="<?= esc($row['judul']); ?>" class="img-fluid mb-3">
            <?php endif; ?>
            <p class="mb-2">Kategori: <strong><?= esc(ucfirst($row['kategori'])); ?></strong></p>
            <p><?= substr($row['isi'], 0, 200); ?>...</p>
            <small class="text-muted">Diterbitkan pada: <?= date('d M Y', strtotime($row['tanggal'] ?? 'now')); ?></small>
        </article>
        <hr class="divider">
    <?php endforeach; ?>
<?php else: ?>
    <article class="entry">
        <h2>Belum ada artikel dalam kategori ini.</h2>
    </article>
<?php endif; ?>

<?= $this->endSection() ?>