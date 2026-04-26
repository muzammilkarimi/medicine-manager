<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Using prepared statement for security
    $stmt = $con->prepare("DELETE FROM add_med WHERE `s.no` = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Medicine deleted successfully'); window.location.href='show.php';</script>";
    } else {
        echo "<script>alert('Failed to delete medicine'); window.location.href='show.php';</script>";
    }
    
    $stmt->close();
} else {
    header("Location: show.php");
}
$con->close();
?>
