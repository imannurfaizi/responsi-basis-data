<?php
include 'config.php';
error_reporting(0);
$contact = mysqli_query($conn, "SELECT admin_telp, admin_email, address FROM admin
            WHERE admin_id = 1");
$adm = mysqli_fetch_object($contact);
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
                <li><a href="produk.php">Produk</a></li>
            </ul>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="wrap">
            <form action="produk.php" method="GET">
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- produk -->
    <div class="section">
        <div class="wrap">
            <h3>Produk</h3>
            <div class="box">
                <?php
                if ($_GET['search'] != '') {
                    $where = "AND nama_kue LIKE '%" . $_GET['search'] . "%' ";
                }
                $produk = mysqli_query($conn, "SELECT * FROM kue WHERE status_kue = 1 $where ORDER BY id_kue DESC");
                if (mysqli_num_rows($produk) > 0) {
                    while ($obj = mysqli_fetch_array($produk)) {
                ?>
                        <a href="detail-produk.php?id=<?php echo $obj['id_kue'] ?>">
                            <div class="col-4">
                                <img src="produk/<?php echo $obj['gambar_kue'] ?>">
                                <p class="nama"> <?php echo $obj['nama_kue'] ?></p>
                                <p class="harga">Rp <?php echo number_format($obj['harga_kue']) . ',-' ?></p>
                            </div>
                        </a>
                    <?php }
                } else { ?>
                    <p>Produk Tidak Ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="wrap">
            <h4>Alamat</h4>
            <p><?php echo $adm->address ?></p>

            <h4>Email</h4>
            <p><?php echo $adm->admin_email ?></p>

            <h4>No. Hp</h4>
            <p><?php echo $adm->admin_telp ?></p>


            <small>Copyright &copy; 2020 - Bolu Skuy Coorporation</small>
        </div>
    </div>
</body>

</html>