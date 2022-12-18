<?php
session_start();
include 'config.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$produk = mysqli_query($conn, "SELECT * FROM kue WHERE id_kue = '" . $_GET['id'] . "'");
if (mysqli_num_rows($produk) == 0) {
    echo '<script>window.location="data-produk.php"</script>';
}
$obj = mysqli_fetch_object($produk);
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
            <h1><a href="dashboard.php">Dashboard</a>Bolu Skuy</a></h1>
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
            <h3>Edit Data Produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="nama" class="input-control" placeholder="Nama Kue" value="<?php echo $obj->nama_kue ?>" required>
                    <input type="text" name="jenis" class="input-control" placeholder="Jenis Kue" value="<?php echo $obj->jenis_kue ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $obj->harga_kue ?>" required>
                    <input type="text" name="stok" class="input-control" placeholder="Stok" value="<?php echo $obj->stok ?>" required>
                    <img src="produk/<?php echo $obj->gambar_kue ?>" width="150px">
                    <input type="hidden" name="foto" value="<?php echo $obj->gambar_kue ?>">
                    <input type="file" name="gambar" class="input-control" required>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($obj->status_kue == 1) ? 'selected' : '' ?>>Aktif</option>
                        <option value="0" <?php echo ($obj->status_kue == 0) ? 'selected' : '' ?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Ubah Data" class="btn-input2">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama = $_POST['nama'];
                    $jenis = $_POST['jenis'];
                    $harga = $_POST['harga'];
                    $stok = $_POST['stok'];
                    $status = $_POST['status'];
                    $lama   = $_POST['foto'];

                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];


                    if ($filename != '') {

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $new = 'produk' . time() . '.' . $type2;

                        $allow = array('jpg', 'jpeg', 'png');

                        if (!in_array($type2, $allow)) {
                            echo '<script>alert("Format File Tidak Diizikan!")<script>';
                        } else {
                            unlink('./produk/' . $lama);
                            move_uploaded_file($tmp_name, './produk/' . $new);
                            $namagambar = $new;
                        }
                    } else {
                        $namagambar = $lama;
                    }
                    $update = mysqli_query($conn, "UPDATE kue SET
                                    nama_kue = '" . $nama . "',
                                    jenis_kue = '" . $jenis . "',
                                    stok = '" . $stok . "',
                                    harga_kue = '" . $harga . "',
                                    status_kue = '" . $status . "',
                                    gambar_kue = '" . $namagambar . "'
                                    WHERE id_kue = '" . $obj->id_kue . "'

                                ");

                    if ($update) {
                        echo '<script>alert("Edit Data Berhasil")</script>';
                        echo '<script>window.location="data-produk.php"</script>';
                    } else {
                        echo 'gagal' . mysqli_error($conn);
                    }
                }
                ?>
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