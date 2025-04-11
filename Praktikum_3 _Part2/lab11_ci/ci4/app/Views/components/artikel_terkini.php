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
