<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?php if ($artikel): foreach ($artikel as $row): ?>
<article class="entry">
    <h2>
        <a href="<?= base_url('/artikel/' . $row['slug']); ?>">
            <?= esc($row['judul']); ?>
        </a>
    </h2>
    <img src="<?= base_url('uploads/' . $row['gambar']); ?>" alt="<?= esc($row['judul']); ?>">
    <p><?= esc(substr($row['isi'], 0, 200)); ?>...</p>
    <small>Diterbitkan pada: <?= date('d M Y', strtotime($row['tanggal'])) ?></small>
</article>
<hr class="divider" />
<?php endforeach; else: ?>
<article class="entry">
    <h2>Belum ada data.</h2>
</article>
<?php endif; ?>

<?= $this->endSection() ?>
