<?php
include 'db.php';


function calculate_average()
{
    global $conn;
    $sql = "SELECT AVG(final_grade) as average FROM students";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['average'];
}

function calculate_max()
{
    global $conn;
    $sql = 'SELECT MAX(final_grade) as max FROM students';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['max'];
}

function calculate_min()
{
    global $conn;
    $sql = 'SELECT MIN(final_grade) as min FROM students';
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['min'];
}

