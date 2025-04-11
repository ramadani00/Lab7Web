<?= $this->include('template/admin_header'); ?>

<div class="container mt-4">

    <table class="table table-bordered table-hover align-middle" style="table-layout: fixed; width: 100%;">
        <thead class="table-primary text-center">
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 55%;">Judul & Isi</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 25%;">Aksi</th>
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
                            <?php if ($row['status'] === 'publish'): ?>
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle-fill me-1"></i>Publish
                                </span>
                            <?php elseif ($row['status'] === 'draft'): ?>
                                <span class="badge bg-secondary">
                                    <i class="bi bi-pencil-fill me-1"></i>Draft
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-question-circle-fill me-1"></i><?= esc(ucfirst($row['status'])); ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('/admin/artikel/edit/' . $row['id']); ?>" class="btn btn-sm btn-warning me-1">Ubah</a>
                            <a href="<?= base_url('/admin/artikel/delete/' . $row['id']); ?>" 
                               onclick="return confirm('Yakin ingin menghapus artikel ini?');" 
                               class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Belum ada data artikel.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot class="table-light text-center">
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 50%;">Judul & Isi</th>
                <th style="width: 20%;">Status</th>
                <th style="width: 25%;">Aksi</th>
            </tr>
        </tfoot>
    </table>
</div>

<?= $this->include('template/admin_footer'); ?>
