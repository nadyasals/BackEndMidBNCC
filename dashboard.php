<?php
    include 'koneksi.php';
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f2f5;
            padding-top: 50px;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #009570;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-size: 24px;
            color: #fff;
        }
        .navbar .btn-danger {
            font-size: 14px;
            color: #fff;
        }

        /* Card Styles */
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }
        .card-img {
            object-fit: cover;
            height: 250px;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-title {
            font-size: 20px;
            font-weight: bold;
        }
        .card-text {
            font-size: 14px;
            color: #6c757d;
        }
        .card-footer {
            background-color: #fff;
            border-top: 1px solid #f1f1f1;
            text-align: center;
            padding: 1rem;
        }

        /* Button Styles */
        .btn {
            transition: 0.3s;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #009570;
            border: none;
        }
        .btn-primary:hover {
            background-color: #009570;
        }
        .btn-warning {
            background-color: #ffc107;
            border: none;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Footer Styles */
        footer {
            background-color: #009570;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        /* Responsive Layout for Mobile */
        @media (max-width: 768px) {
            .card {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Book Dashboard</a>
            <div class="ms-auto">
                <a href="#" class="btn btn-danger" onclick="confirmLogOut()">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h1 class="display-4">Book List</h1>
            <a href="create.php" class="btn btn-primary">Add New Book</a>
        </div>

        <!-- Books Grid Layout -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col">
                        <div class="card">
                            <img src="<?= !empty($row['imagePath']) ? $row['imagePath'] : 'default_image.png' ?>" class="card-img" alt="<?= htmlspecialchars($row['title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                                <p class="card-text">Author: <?= htmlspecialchars($row['author']) ?></p>
                                <p class="card-text">Publisher: <?= htmlspecialchars($row['publisher']) ?></p>
                                <p class="card-text">Pages: <?= htmlspecialchars($row['pageNum']) ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">View</a>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        No books available in the database.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; kit nadya | 2025 BNCC HRD X EEO</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmLogOut() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = 'logout.php';  // Redirect to logout page
            }
        }
    </script>
</body>
</html>
