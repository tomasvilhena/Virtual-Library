<?php
include 'db.php';

$id = $_GET['id'];
$sql_select = "SELECT * FROM books WHERE id = ?";
$stmt_select = mysqli_prepare($conn, $sql_select);
mysqli_stmt_bind_param($stmt_select, "i", $id);
mysqli_stmt_execute($stmt_select);
$result = mysqli_stmt_get_result($stmt_select);
$book = mysqli_fetch_assoc($result);

if (!$book) {
    die("Book not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];
    $image_name = $book['cover_image'];

    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
        if ($_FILES['cover']['size'] <= 2 * 1024 * 1024) {
            if ($image_name && file_exists("uploads/" . $image_name)) {
                unlink("uploads/" . $image_name);
            }
            $image_name = time() . "_" . $_FILES['cover']['name'];
            move_uploaded_file($_FILES['cover']['tmp_name'], "uploads/" . $image_name);
        }
    }

    $sql_update = "UPDATE books SET title = ?, author = ?, year = ?, isbn = ?, cover_image = ? WHERE id = ?";
    $stmt_update = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "ssissi", $title, $author, $year, $isbn, $image_name, $id);

    if (mysqli_stmt_execute($stmt_update)) {
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
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Edit Book</h1>
    <p><a href="index.php" class="back-link">&larr; Back to List</a></p>

    <form method="POST" enctype="multipart/form-data">
        <div>
            <label>Title:</label>
            <input type="text" name="title" value="<?php echo $book['title']; ?>" required>
        </div>
        <div>
            <label>Author:</label>
            <input type="text" name="author" value="<?php echo $book['author']; ?>" required>
        </div>
        <div>
            <label>Year:</label>
            <input type="number" name="year" value="<?php echo $book['year']; ?>" required>
        </div>
        <div>
            <label>ISBN:</label>
            <input type="text" name="isbn" value="<?php echo $book['isbn']; ?>" required>
        </div>
        <div>
            <label>Current Cover:</label><br>
            <?php if ($book['cover_image'] && file_exists("uploads/" . $book['cover_image'])): ?>
                <img src="uploads/<?php echo $book['cover_image']; ?>" class="thumbnail" alt="Cover"><br>
            <?php else: ?>
                <div class="thumbnail">No Image</div><br>
            <?php endif; ?>
            <label>Change Cover:</label>
            <input type="file" name="cover" accept="image/*">
        </div>
        <button type="submit">Update Book</button>
    </form>
</body>

</html>