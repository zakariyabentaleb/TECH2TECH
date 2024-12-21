<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $connection = new mysqli("localhost", "root", "root", "blog");
    $stmt = $connection->query("DELETE FROM articles WHERE id=$id");
    if ($result === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    header("Location: admin.php");
}
