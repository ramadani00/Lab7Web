<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<form action="" method="post">
    <p><input type="text" name="judul" class="form-control"  value="<?= $data['judul'];?>" ></p>
    <p>
        <textarea name="isi" id="isi" rows="10" style="width: 600px;" class="form-control"><?= $data['isi']; ?></textarea>
    </p>
    <p>
        <input type="submit" value="Kirim" class="btn btn-primary btn-lg">
    </p>
</form>

<?= $this->include('template/admin_footer'); ?>
