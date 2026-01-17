<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_get = "SELECT cover_image FROM books WHERE id = ?";
    $stmt_get = mysqli_prepare($conn, $sql_get);
    mysqli_stmt_bind_param($stmt_get, "i", $id);
    mysqli_stmt_execute($stmt_get);
    $result = mysqli_stmt_get_result($stmt_get);
    $book = mysqli_fetch_assoc($result);

    if ($book) {
        if ($book['cover_image'] && file_exists("uploads/" . $book['cover_image'])) {
            unlink("uploads/" . $book['cover_image']);
        }
        
        $sql_del = "DELETE FROM books WHERE id = ?";
        $stmt_del = mysqli_prepare($conn, $sql_del);
        mysqli_stmt_bind_param($stmt_del, "i", $id);
        mysqli_stmt_execute($stmt_del);
    }
}

header("Location: index.php");
exit();
?>