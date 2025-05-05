<div class="widget-box">
    <h3 class="title">Artikel Terkini<?= $kategori ? ' - ' . ucfirst(esc($kategori)) : ''; ?></h3>
    <ul>
        <?php if (!empty($artikel)): ?>
            <?php foreach ($artikel as $item): ?>
                <li>
                    <a href="<?= site_url('artikel/' . $item['slug']) ?>">
                        <?= esc($item['judul']) ?>
                    </a>
                    <p><?= date('d M Y', strtotime($item['tanggal'])) ?></p>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada artikel dalam kategori ini.</p>
        <?php endif; ?>
    </ul>
</div>