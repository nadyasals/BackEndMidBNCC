<?php
include 'koneksi.php';

// Check if 'id' is set and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statement for deletion to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);  // 'i' means the parameter is an integer

    if ($stmt->execute()) {
        header("Location: dashboard.php");  // Redirect after successful deletion
        exit;
    } else {
        echo "Error: " . $stmt->error;  // Display error if deletion fails
    }
} else {
    echo "Invalid ID.";  // In case the 'id' is not present or not numeric
}
?>
