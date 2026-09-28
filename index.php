<?php
// ===== DATA PRODUK (array PHP) =====
$produk = [
    ["nama" => "Monitor 12 Inch", "kategori" => "Monitor", "harga" => 1800000, "stok" => 4],
    ["nama" => "Laptop Productivity", "kategori" => "Laptop", "harga" => 8500000, "stok" => 3],
    ["nama" => "Mouse Wireless", "kategori" => "Aksesoris", "harga" => 150000, "stok" => 12],
    ["nama" => "Keyboard", "kategori" => "Aksesoris", "harga" => 750000, "stok" => 0],
    ["nama" => "Headset Gaming", "kategori" => "Audio", "harga" => 1200000, "stok" => 6],
    ["nama" => "Flashdisk 512GB",  "kategori" => "Storage", "harga" => 85000, "stok" => 0],
];

// ===== FUNGSI =====
function rupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}

const BATAS_DISKON = 1000000;
const PERSEN_DISKON = 10;

$totalProduk = count($produk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cia Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="container">
        <nav>
            <span class="logo">Cia Store</span>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#produk">Products</a></li>
                <li><a href="#footer">About</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="container">
    <section class="hero" id="home">
        <small>CIA STORE</small>
        <h1>Simple Tech Store.</h1>
        <p>Temukan berbagai perangkat dan aksesoris teknologi untuk kebutuhanmu.</p>
        <a class="btn-hero" href="#produk">Lihat Produk</a>
    </section>

    <section id="produk">
        <div class="catalog-head">
            <div>
                <small>OUR PRODUCTS</small>
                <h2>Katalog Produk</h2>
            </div>
            <div class="total">Total Produk: <strong><?= $totalProduk ?></strong></div>
        </div>

        <div class="grid">
            <?php foreach ($produk as $p): ?>
                <?php
                    $tersedia = $p["stok"] > 0;
                    $diskon   = $p["harga"] >= BATAS_DISKON;
                    $hargaAkhir = $diskon ? $p["harga"] - ($p["harga"] * PERSEN_DISKON / 100) : $p["harga"];
                ?>
                <article class="card">
                    <div class="kategori">
                        <?= htmlspecialchars($p["kategori"]) ?>
                        <?php if ($diskon): ?>
                            <strong>DISKON <?= PERSEN_DISKON ?>%</strong>
                        <?php endif; ?>
                    </div>
                    <h3><?= htmlspecialchars($p["nama"]) ?></h3>

                    <div class="harga-wrap">
                        <?php if ($diskon): ?>
                            <div class="harga-lama"><?= rupiah($p["harga"]) ?></div>
                        <?php endif; ?>
                        <div class="harga"><?= rupiah($hargaAkhir) ?></div>
                    </div>

                    <div class="meta">
                        <span>Stok: <?= $p["stok"] ?></span>
                        <?php if ($tersedia): ?>
                            <span class="badge ok">Tersedia</span>
                        <?php else: ?>
                            <span class="badge out">Stok Habis</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($tersedia): ?>
                        <button class="btn" type="button">Beli Sekarang</button>
                    <?php else: ?>
                        <button class="btn" type="button" disabled>Beli Sekarang</button>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<footer id="footer">
    <div class="container">&copy; <?= date("Y") ?> Cia Store. Simple Tech Store.</div>
</footer>

</body>
</html>