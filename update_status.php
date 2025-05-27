<?php 
require_once("dbConnect.php");

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = intval($_POST['status']);

    $sql = "UPDATE tasks SET status = '$status' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>