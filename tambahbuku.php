<?php
include '../../../koneksi.php';

if (isset($_POST['simpan'])) {
   
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($conn, $_POST['pengarang']);
    $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
    $tahun = (int) $_POST['tahun_terbit'];

  
    if ($tahun < 1900 || $tahun > date('Y')) {
        echo "<script>alert('Tahun terbit tidak valid!');</script>";
    } else {
        $query = mysqli_query($conn, "
            INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit)
            VALUES ('$judul', '$pengarang', '$penerbit', '$tahun')
        ");

        if ($query) {
            echo "<script>alert('Data buku berhasil disimpan!'); window.location='../index.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Tambah Buku - Aplikasi Perpustakaan</title>
    <link href="dist/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="sb-nav-fixed">
<div id="layoutSidenav">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tambah Data Buku</h1>
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul Buku</label>
                                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pengarang</label>
                                <input type="text" name="pengarang" class="form-control" placeholder="Masukkan nama pengarang" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" placeholder="Masukkan nama penerbit" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" class="form-control" placeholder="Contoh: 2024" min="1900" max="<?= date('Y') ?>" required>
                            </div>
                            <button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
                            <a href="../index.php" class="btn btn-secondary">⬅ Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>

    </div>
</div>

</body>
</html>
