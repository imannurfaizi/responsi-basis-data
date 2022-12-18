<?php
session_start();
include 'config.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>Dashboard | Code B</title>
</head>

<body>
    <!-- header -->
    <header>
        <div class="wrap">
            <h1><a href="dashboard.php">Bolu Skuy</a></h1>
            <ul>
                <li><a href="dashboard.php">Dasboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="wrap">
            <h3>Laporan Keuangan</h3>
            <div class="box">
                <form action="laporan.php" method="POST">
                    <table border="1" cellspacing="0" " width="" class=" table">
                        <thead>
                            <tr>
                                <th widht="60px">No</th>
                                <th>Nama Kue</th>
                                <th>Harga Jual</th>
                                <th>Modal / 1pcs</th>
                                <th>Terjual</th>
                                <th>Tersisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $modal = 0;
                            $jual = 0;
                            $produk = mysqli_query($conn, "SELECT * FROM kue ORDER BY id_kue ASC");
                            if (mysqli_num_rows($produk) > 0) {
                                while ($row = mysqli_fetch_array($produk)) {
                            ?>
                                    <tr>
                                        <td align="center"><?php echo $no++ ?></td>
                                        <td><?php echo $row['nama_kue'] ?></td>
                                        <td>Rp <?php echo number_format($row['harga_kue']) . ',-' ?></td>
                                        <td>Rp <?php echo number_format($row['modal']) . ',-' ?></td>
                                        <td align="center"><?php echo $row['terjual'] ?> pcs</td>
                                        <td align="center"><?php echo ($row['stok'] - $row['terjual']) ?></td>
                                        <?php
                                        $modal = $modal + ($row['modal'] * $row['terjual']);
                                        $jual = $jual + ($row['harga_kue'] * $row['terjual']);
                                        ?>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th align="center" colspan="2">Keuntungan</th>
                                    <th align="center" colspan="4" style="color: red;">Rp <?php echo number_format($jual - $modal) ?> ,-</th>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="8">Tidak Ada Data</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="wrap">
            <small>Copyright &copy; 2020 - Bolu Skuy Coorporation</small>
        </div>
    </footer>
</body>

</html>