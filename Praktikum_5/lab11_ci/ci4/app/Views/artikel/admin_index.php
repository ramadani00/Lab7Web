<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<?= $this->include('template/admin_header'); ?>

<div class="container mt-4">
    <table class="table table-hover align-middle" style="table-layout: auto; width: 100%;">
        <thead class="table-primary text-center">
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 40%;">Judul & Isi</th>
                <th style="width: 10%;">Kategori</th>
                <th style="width: 5%;">Status</th>
                <th style="width: 40%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($artikel && count($artikel) > 0): ?>
                <?php foreach ($artikel as $row): ?>
                    <tr>
                        <td class="text-center"><?= esc($row['id']); ?></td>
                        <td style="word-wrap: break-word;">
                            <strong><?= esc($row['judul']); ?></strong>
                            <p class="mb-0"><small><?= esc(substr($row['isi'], 0, 50)); ?>...</small></p>
                        </td>
                        <td class="text-center">
                            <?php if ($row['kategori'] === 'teknologi'): ?>
                                <span class="badge bg-light text-dark">Teknologi</span>
                            <?php elseif ($row['kategori'] === 'politik'): ?>
                                    <span class="badge bg-light text-dark">Politik</span>
                            <?php elseif ($row['kategori'] === 'pendidikan'): ?>
                                <span class="badge bg-light text-dark">Pendidikan</span>
                            <?php elseif ($row['kategori'] === 'hiburan'): ?>
                                <span class="badge bg-light text-dark">Hiburan</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Lainnya</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($row['status'] === 'publish'): ?>
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-check-circle-fill me-1"></i>Publish
                                </span>
                            <?php elseif ($row['status'] === 'draft'): ?>
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-pencil-fill me-1"></i>Draft
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-question-circle-fill me-1"></i><?= esc(ucfirst($row['status'])); ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('/admin/artikel/edit/' . $row['id']); ?>" class="btn btn-sm btn-warning me-1"   style="margin-bottom: 10px;">
                                <i class="bi bi-pencil-fill"></i> Ubah
                            </a>
                            <a href="<?= base_url('/admin/artikel/delete/' . $row['id']); ?>" 
                            onclick="return confirm('Yakin ingin menghapus artikel ini?');" 
                            class="btn btn-sm btn-danger">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada data artikel.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot class="table-light text-center">
            <tr>
            <th style="width: 5%;">ID</th>
                <th style="width: 40%;">Judul & Isi</th>
                <th style="width: 10%;">Kategori</th>
                <th style="width: 5%;">Status</th>
                <th style="width: 40%;">Aksi</th>
            </tr>
        </tfoot>
    </table>
</div>

<?= $this->include('template/admin_footer'); ?>