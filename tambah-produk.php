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
            <h3>Tambah Data</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="nama" class="input-control" placeholder="Nama Kue" required>
                    <input type="text" name="jenis" class="input-control" placeholder="Jenis Kue" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga Jual" required>
                    <input type="text" name="modal" class="input-control" placeholder="Modal Buat" required>
                    <input type="text" name="stok" class="input-control" placeholder="Stok" required>
                    <input type="text" name="jual" class="input-control" placeholder="Terjual" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value="Tambah Data" class="btn-input2">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    // print_r($_FILES);
                    $nama = $_POST['nama'];
                    $jenis = $_POST['jenis'];
                    $harga = $_POST['harga'];
                    $modal = $_POST['modal'];
                    $stok = $_POST['stok'];
                    $jual = $_POST['jual'];
                    $status = $_POST['status'];

                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1 = explode('.', $filename);
                    $type2 = $type1[1];

                    $new = 'produk' . time() . '.' . $type2;

                    $allow = array('jpg', 'jpeg', 'png');

                    if (!in_array($type2, $allow)) {
                        echo '<script>alert("Format File Tidak Diizikan!")<script>';
                    } else {
                        move_uploaded_file($tmp_name, './produk/' . $new);

                        $insert = mysqli_query($conn, "INSERT INTO kue VALUES (
                                    null,
                                  '" . $nama . "',
                                  '" . $jenis . "',
                                  '" . $harga . "',
                                  '" . $stok . "',
                                  '" . $new . "',
                                  '" . $status . "',
                                  '" . $modal . "',
                                  null, '" . $jual . "')");

                        if ($insert) {
                            echo '<script>alert("Data Berhasil Ditambahkan")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        } else {
                            echo 'gagal' . mysqli_error($conn);
                        }
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