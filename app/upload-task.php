<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['user'])) {
    // Ambil user_id dari sesi
    $user_id = $_SESSION['user']['user_id'];

    // Ambil nilai dari formulir atau sumber data lainnya
    $name_task = $_POST['name_task'];
    $priority = $_POST['priority'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    // Gunakan prepared statements untuk menghindari SQL injection
    $query = "INSERT INTO task (user_id, name_task, priority, end_date, status, description) VALUES (?, ?, ?, ?, ?, ?)";

    // Persiapkan statement
    $stmt = mysqli_prepare($koneksi, $query);

    // Bind parameter ke statement dengan jenis data yang sesuai
    mysqli_stmt_bind_param($stmt, "isssss", $user_id, $name_task, $priority, $end_date, $status, $description);

    // Eksekusi statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo '<script>alert("You successfully added a task"); window.location.href="page-task.php";</script>';

    } else {
        // Tampilkan informasi lebih lanjut untuk debug
        echo "Error: " . mysqli_error($koneksi);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    // Handle jika user_id tidak tersedia di sesi
    echo "User not logged in.";
}
?>

