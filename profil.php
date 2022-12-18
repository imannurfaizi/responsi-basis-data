<?php
session_start();
include 'config.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

$query = mysqli_query($conn, "SELECT * FROM admin WHERE admin_id = '" . $_SESSION['id'] . "'");
$obj = mysqli_fetch_object($query);
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
    <title>Profil | Code B</title>
</head>

<body>
    <!-- header -->
    <header>
        <div class="wrap">
            <h1><a href="dashboard.php">Bolu Skuy</a></h1>
            <ul>
                <li><a href="dashboard.php">Dasboard</a></li>
                <li><a href="">Profil</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="wrap">
            <h3>Ubah Profil</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $obj->admin_name ?>" required>
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $obj->username ?>" required>
                    <input type="text" name="hp" placeholder="Nomor Hp" class="input-control" value="<?php echo $obj->admin_telp ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $obj->admin_email ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $obj->address ?>" required>
                    <input type="submit" name="submit" value="Ubah Profil" class="btn-input">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama = $_POST['nama'];
                    $user = $_POST['user'];
                    $hp = $_POST['hp'];
                    $email = $_POST['email'];
                    $alamat = $_POST['alamat'];

                    $update = mysqli_query($conn, "UPDATE admin SET
                                    admin_name = '" . $nama . "',
                                    username = '" . $user . "',
                                    admin_telp = '" . $hp . "',
                                    admin_email = '" . $email . "',
                                    address = '" . $alamat . "'   
                                    WHERE admin_id = '" . $obj->admin_id . "'");
                    if ($update) {
                        echo '<script>alert("Data Berhasil Diubah")</script>';
                        echo '<script>window.location="profil.php"</script>';
                    } else {
                        echo '<script>alert("Perubahan Data Gagal")</script>';
                    }
                }

                ?>
            </div>
        </div>
        <div class="wrap">
            <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pw1" placeholder="Password Baru" class="input-control">
                    <input type="password" name="pw2" placeholder="Konfirmasi Password Baru" class="input-control">
                    <input type="submit" name="ubah" value="Ubah Password" class="btn-input">
                </form>
                <?php
                if (isset($_POST['ubah'])) {
                    $pw1 = $_POST['pw1'];
                    $pw2 = $_POST['pw2'];

                    if ($pw2 != $pw1) {
                        echo '<script>alert("Konfirmasi Passowrd Tidak Sesuai")</script>';
                    } elseif ($pw1 == '' && $pw2 == '') {
                        echo '<script>alert("Isikan Terlebih Dahulu Password Baru Anda!")</script>';
                    } else {
                        $ubahpw = mysqli_query($conn, "UPDATE admin SET password = '" . MD5($pw1) . "'
                                WHERE admin_id = '" . $obj->admin_id . "'");

                        if ($ubahpw) {
                            echo '<script>alert("Password Berhasil Diubah")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        } else {
                            echo '<script>alert("Perubahan Password Gagal")</script>';
                            echo mysqli_error($conn);
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