<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $publisher = $_POST["publisher"];
    $pageNum = $_POST["pageNum"];

    if ($title && $author && $publisher && $pageNum) {
        $sql = "INSERT INTO books (title, author, publisher, pageNum) VALUES ('$title', '$author', '$publisher', '$pageNum')";
        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Semua field harus diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Main Container -->
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h3>Tambah Buku</h3>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Penulis</label>
                        <input type="text" class="form-control" name="author" id="author" required>
                    </div>
                    <div class="mb-3">
                        <label for="publisher" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" name="publisher" id="publisher" required>
                    </div>
                    <div class="mb-3">
                        <label for="pageNum" class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control" name="pageNum" id="pageNum" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="dashboard.php" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
