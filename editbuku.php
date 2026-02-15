<?php
include '../../../koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = intval($_GET['id']); // pastikan ID adalah angka

// Ambil data buku dari database
$query = mysqli_query($conn, "SELECT * FROM buku WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data buku tidak ditemukan!";
    exit;
}

// Proses jika form disubmit
if (isset($_POST['submit'])) {
    $judul        = mysqli_real_escape_string($conn, $_POST['judul']);
    $pengarang    = mysqli_real_escape_string($conn, $_POST['pengarang']);
    $penerbit     = mysqli_real_escape_string($conn, $_POST['penerbit']);
    $tahun_terbit = intval($_POST['tahun_terbit']);

    $update = mysqli_query($conn, "UPDATE buku SET 
        judul = '$judul',
        pengarang = '$pengarang',
        penerbit = '$penerbit',
        tahun_terbit = '$tahun_terbit'
        WHERE id = $id
    ");

    if ($update) {
        echo "<script>alert('Data buku berhasil diperbarui!'); window.location.href='../index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>Edit Data Buku</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="pengarang" class="form-label">Pengarang</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= htmlspecialchars($data['pengarang']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= htmlspecialchars($data['penerbit']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?= htmlspecialchars($data['tahun_terbit']) ?>" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>
