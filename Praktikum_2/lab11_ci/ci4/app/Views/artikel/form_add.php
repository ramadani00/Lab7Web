<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<form action="" method="post">
    <p><input type="text" name="judul" class="form-control" placeholder="Judul"></p>
    <p><textarea name="isi" cols="50" rows="10" class="form-control" placeholder="Isi"></textarea></p>
    <p>
        <input type="submit" value="Kirim" class="btn btn-primary btn-lg">
    </p>
</form>

<?= $this->include('template/admin_footer'); ?>
