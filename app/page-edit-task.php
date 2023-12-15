<?php
session_start();
include "koneksi.php";

if (isset($_POST['update'])) {

    $task_id = $_POST['task_id'];
    $name_task = $_POST['name_task'];
    $priority = $_POST['priority'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    // Gunakan prepared statements untuk menghindari SQL injection
    $query = "UPDATE task SET name_task = ?, priority = ?, end_date = ?, status = ?, description = ? WHERE task_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sssssi", $name_task, $priority, $end_date, $status, $description, $task_id);

    // Eksekusi statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo '<script>alert("Task updated successfully"); window.location.href="page-task.php";</script>';
    } else {
        // Tampilkan informasi lebih lanjut untuk debug
        echo "Error: " . mysqli_error($koneksi);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}
?>
