<?php
include 'db.php';
require_once 'statistics.php';
$average_grade = calculate_average();
$min_grade = calculate_min();
$max_grade = calculate_max();



$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
$students = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Student List</h1>
        <p><a href="add.php" class="back-link">+ Add New Student</a></p>
    </header>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birth Date</th>
                <th>Final Grade</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($student['birth_date'])); ?></td>
                    <td><?php echo $student['final_grade']; ?></td>
                    <td class="actions">
                        <a href="edit.php?id=<?php echo $student['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $student['id']; ?>"
                            onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>Average Grade: <?php echo $average_grade; ?></p>
    <p>Min Grade: <?php echo $min_grade; ?></p>
    <p>Max Grade: <?php echo $max_grade; ?></p>
</body>

</html>