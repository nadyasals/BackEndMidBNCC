<?php
include 'koneksi.php';

// Check if the 'id' is set in the URL and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);  // 'i' means the parameter is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the book exists in the database
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No data found for this book.";
        exit;
    }
} else {
    echo "Invalid book ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fc;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #009570;
            color: #fff;
            border-radius: 15px 15px 0 0;
        }

        .card-body {
            background-color: #ffffff;
            border-radius: 0 0 15px 15px;
            padding: 30px;
        }

        .card-footer {
            background-color: #ffffff;
            text-align: center;
            border-top: 1px solid #ddd;
            padding: 20px;
        }

        .btn-back {
            background-color: #009570;
            color: white;
            border-radius: 20px;
            padding: 10px 30px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #007e5e;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 15px;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Detail Buku</h2>
                    </div>
                    <div class="card-body">
                        <h1><?= htmlspecialchars($row['title']); ?></h1>
                        <p><strong>Penulis:</strong> <?= htmlspecialchars($row['author']); ?></p>
                        <p><strong>Penerbit:</strong> <?= htmlspecialchars($row['publisher']); ?></p>
                        <p><strong>Jumlah Halaman:</strong> <?= htmlspecialchars($row['pageNum']); ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="dashboard.php" class="btn btn-back">Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
