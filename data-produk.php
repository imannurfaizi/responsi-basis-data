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
    <meta name="viewport" content="width=device-widht, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>Data Produk | Code B</title>
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
            <h3>Data Produk</h3>
            <div class="box">
                <a href="tambah-produk.php"><input type="button" value="Tambah Data" class="btn-input2"></a><br><br>
                <a href="laporan.php"><input type="button" value="Buat Laporan" class="btn-input3"></a>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th widht="60px">No</th>
                            <th>Nama Kue</th>
                            <th>Jenis Kue</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th widht="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $produk = mysqli_query($conn, "SELECT * FROM kue ORDER BY id_kue ASC");
                        if (mysqli_num_rows($produk) > 0) {
                            while ($row = mysqli_fetch_array($produk)) {
                        ?>
                                <tr>
                                    <td align="center"><?php echo $no++ ?></td>
                                    <td align="center"><?php echo $row['nama_kue'] ?></td>
                                    <td align="center"><?php echo $row['jenis_kue'] ?></td>
                                    <td align="center">Rp <?php echo number_format($row['harga_kue']) . ',-' ?></td>
                                    <td align="center"><?php echo $row['stok'] ?> pcs</td>
                                    <td align="center"><a href="produk/<?php echo $row['gambar_kue'] ?>" target="blank"><img src="produk/<?php echo $row['gambar_kue'] ?>" width="200px"></td></a>
                                    <td align="center"><?php echo ($row['status_kue'] == 0) ? 'Tidak Aktif' : 'Aktif'; ?></td>
                                    <td align="center"><a href="edit-produk.php?id=<?php echo $row['id_kue'] ?>">Edit</a> || <a href="
                                    hapus-produk.php?idp=<?php echo $row['id_kue'] ?>" onclick="return confirm('Yakin ingin dihapus?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="8">Tidak Ada Data</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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