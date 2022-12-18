<?php
include 'config.php';

if (isset($_GET['idp'])) {
    $produk = mysqli_query($conn, "SELECT gambar_kue FROM kue WHERE id_kue = '" . $_GET['idp'] . "'");
    $obj = mysqli_fetch_object($produk);

    unlink('./produk/' . $obj->gambar_kue);

    $delete = mysqli_query($conn, "DELETE FROM kue WHERE id_kue = '" . $_GET['idp'] . "'");
    if ($delete) {
        echo '<script>alert("Data Berhasil Dihapus!")</script>';
        echo '<script>window.location="data-produk.php"</script>';
    } else {
        echo 'Gagal Dihapus' . mysqli_error($conn);
    }
}
