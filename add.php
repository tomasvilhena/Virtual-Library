<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $final_grade = $_POST['final_grade'];

    $sql = "INSERT INTO students (name, birth_date, final_grade) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $birth_date, $final_grade);

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
    <title>Add New Student</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Add New Student</h1>
    <p><a href="index.php" class="back-link">&larr; Back to List</a></p>

    <form method="POST" enctype="multipart/form-data">
        <div>
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Birth Date:</label>
            <input type="date" name="birth_date" required>
        </div>
        <div>
            <label>Final Grade:</label>
            <input type="decimal" name="final_grade" required>
        </div>
        <button type="submit">Save Student</button>
    </form>
</body>

</html>