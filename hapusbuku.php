<?php
include '../../../koneksi.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Pastikan data buku ada
    $cek = mysqli_query($conn, "SELECT * FROM buku WHERE id=$id");
    if (mysqli_num_rows($cek) == 0) {
        echo "<script>alert('Data buku tidak ditemukan!'); window.location='../index.php';</script>";
        exit;
    }

    // Hapus data
    $hapus = mysqli_query($conn, "DELETE FROM buku WHERE id=$id");

    if ($hapus) {
        echo "<script>alert('Data buku berhasil dihapus!'); window.location='../index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='../index.php';</script>";
    }
} else {
    echo "<script>alert('ID buku tidak ditemukan!'); window.location='../index.php';</script>";
}
?>
