<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];
    $image_name = null;

    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        $filename = $_FILES['cover']['name'];
        if ($_FILES['cover']['size'] <= 2 * 1024 * 1024) {
            $image_name = time() . "_" . $filename;
            move_uploaded_file($_FILES['cover']['tmp_name'], "uploads/" . $image_name);
        }
    }

    $sql = "INSERT INTO books (title, author, year, isbn, cover_image) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssiss", $title, $author, $year, $isbn, $image_name);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Book</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Add New Book</h1>
    <p><a href="index.php" class="back-link">&larr; Back to List</a></p>

    <form method="POST" enctype="multipart/form-data">
        <div>
            <label>Title:</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>Author:</label>
            <input type="text" name="author" required>
        </div>
        <div>
            <label>Year:</label>
            <input type="number" name="year" required>
        </div>
        <div>
            <label>ISBN:</label>
            <input type="text" name="isbn" required>
        </div>
        <div>
            <label>Cover Image:</label>
            <input type="file" name="cover" accept="image/*">
        </div>
        <button type="submit">Save Book</button>
    </form>
</body>

</html>