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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $publisher = $_POST["publisher"];
    $pageNum = $_POST["pageNum"];

    // Validate the form data
    if ($title && $author && $publisher && $pageNum) {
        // Use prepared statement for the UPDATE query
        $stmt = $conn->prepare("UPDATE books SET title = ?, author = ?, publisher = ?, pageNum = ? WHERE id = ?");
        $stmt->bind_param("sssii", $title, $author, $publisher, $pageNum, $id);  // 'sssii' means string, string, string, integer, integer
        if ($stmt->execute()) {
            header("Location: dashboard.php");  // Redirect to the dashboard after successful update
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "All fields must be filled!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-update {
            background-color: #28a745;
            color: white;
            border-radius: 5px;
        }
        .btn-back {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        .btn-back:hover, .btn-update:hover {
            opacity: 0.9;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Book</h1>
        <form method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($row['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author:</label>
                <input type="text" name="author" class="form-control" value="<?= htmlspecialchars($row['author']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="publisher" class="form-label">Publisher:</label>
                <input type="text" name="publisher" class="form-control" value="<?= htmlspecialchars($row['publisher']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="pageNum" class="form-label">Number of Pages:</label>
                <input type="number" name="pageNum" class="form-control" value="<?= htmlspecialchars($row['pageNum']); ?>" required>
            </div>
            <button type="submit" class="btn btn-update w-100">Update</button>
        </form>
        <a href="dashboard.php" class="btn btn-back w-100 mt-3">Back to Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
