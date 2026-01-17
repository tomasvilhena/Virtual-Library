<?php
include 'db.php';

/**
 * EXPLAINING SELECT WITH MySQLi:
 * We use mysqli_query to get all records from the table.
 * mysqli_fetch_all returns the data as an associative array.
 */
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Library - Book List</h1>
    <p><a href="add.php" class="back-link">+ Add New Book</a></p>

    <table>
        <thead>
            <tr>
                <th>Cover</th>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>ISBN</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td>
                        <?php if ($book['cover_image'] && file_exists("uploads/" . $book['cover_image'])): ?>
                            <img src="uploads/<?php echo $book['cover_image']; ?>" class="thumbnail" alt="Cover">
                        <?php else: ?>
                            <div class="thumbnail">No Image</div>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $book['id']; ?></td>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['year']; ?></td>
                    <td><?php echo $book['isbn']; ?></td>
                    <td class="actions">
                        <a href="edit.php?id=<?php echo $book['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $book['id']; ?>"
                            onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>