<?php
include 'db.php';

$id = $_GET['id'];
$sql_select = "SELECT * FROM students WHERE id = ?";
$stmt_select = mysqli_prepare($conn, $sql_select);
mysqli_stmt_bind_param($stmt_select, "i", $id);
mysqli_stmt_execute($stmt_select);
$result = mysqli_stmt_get_result($stmt_select);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    die("Student not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $final_grade = $_POST['final_grade'];

    $sql_update = "UPDATE students SET name = ?, birth_date = ?, final_grade = ? WHERE id = ?";
    $stmt_update = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "sssi", $name, $birth_date, $final_grade, $id);

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
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Edit Student</h1>
    <p><a href="index.php" class="back-link">&larr; Back to List</a></p>

    <form method="POST" enctype="multipart/form-data">
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
        </div>
        <div>
            <label>Birth Date:</label>
            <input type="date" name="birth_date" value="<?php echo $student['birth_date']; ?>" required>
        </div>
        <div>
            <label>Final Grade:</label>
            <input type="decimal" name="final_grade" value="<?php echo $student['final_grade']; ?>" required>
        </div>
        <button type="submit">Update Student</button>
    </form>
</body>

</html>