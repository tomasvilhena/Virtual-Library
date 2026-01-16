<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_del = "DELETE FROM students WHERE id = ?";
    $stmt_del = mysqli_prepare($conn, $sql_del);
    mysqli_stmt_bind_param($stmt_del, "i", $id);
    mysqli_stmt_execute($stmt_del);
}

header("Location: index.php");
exit();
?>