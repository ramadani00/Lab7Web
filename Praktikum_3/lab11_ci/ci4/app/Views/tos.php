<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1><?= $title; ?></h1><br>
<hr>
<br><p><?= $content; ?></p>

<?= $this->endSection() ?>