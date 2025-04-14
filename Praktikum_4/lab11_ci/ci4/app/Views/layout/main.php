<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Halaman Artikel' ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
    <div id="container">
        <header>
            <h1>InfoTerkini.id</h1>
        </header>
        <nav>
            <a href="<?= base_url('/');?>">Home</a>
            <a href="<?= base_url('/artikel');?>">Artikel</a>
            <a href="<?= base_url('/about');?>">About</a>
            <a href="<?= base_url('/contact');?>">Kontak</a>
        </nav>
        <section id="wrapper">
            <section id="main">
                <?= $this->renderSection('content') ?>
            </section>
            <aside id="sidebar">
                <form action="" method="get">
                    <select name="kategori" onchange="this.form.submit()" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="teknologi" <?= request()->getGet('kategori') === 'teknologi' ? 'selected' : ''; ?>>Teknologi</option>
                        <option value="politik" <?= request()->getGet('kategori') === 'politik' ? 'selected' : ''; ?>>Politik</option>
                        <option value="pendidikan" <?= request()->getGet('kategori') === 'pendidikan' ? 'selected' : ''; ?>>Pendidikan</option>
                        <option value="hiburan" <?= request()->getGet('kategori') === 'hiburan' ? 'selected' : ''; ?>>Hiburan</option>
                    </select>
                </form>
                <?= view_cell('App\\Cells\\ArtikelTerkini::render', ['kategori' => request()->getGet('kategori')]) ?>
            </aside>
        </section>
        <footer>
            <p>&copy; 2025 - Universitas Pelita Bangsa</p>
        </footer>
    </div>
</body>
</html>