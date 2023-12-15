<?php
include "koneksi.php";

if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    // Ambil data tugas yang akan dipindahkan
    $query_select_task = "SELECT * FROM task WHERE task_id = ?";
    $stmt_select_task = mysqli_prepare($koneksi, $query_select_task);
    mysqli_stmt_bind_param($stmt_select_task, "i", $task_id);
    mysqli_stmt_execute($stmt_select_task);
    $result_select_task = mysqli_stmt_get_result($stmt_select_task);
    $task_data = mysqli_fetch_assoc($result_select_task);

    // Pindahkan data tugas ke tabel task_history
    $query_insert_history = "INSERT INTO task_history (user_id, name_task, priority, end_date, status, description) 
                            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert_history = mysqli_prepare($koneksi, $query_insert_history);
    mysqli_stmt_bind_param($stmt_insert_history, "isssss", $task_data['user_id'], $task_data['name_task'], $task_data['priority'], $task_data['end_date'], $task_data['status'], $task_data['description']);
    mysqli_stmt_execute($stmt_insert_history);

    // Hapus tugas dari tabel task
    $query_delete_task = "DELETE FROM task WHERE task_id = ?";
    $stmt_delete_task = mysqli_prepare($koneksi, $query_delete_task);
    mysqli_stmt_bind_param($stmt_delete_task, "i", $task_id);
    mysqli_stmt_execute($stmt_delete_task);

    echo "Task moved to history successfully.";
} else {
    echo "Task ID not provided.";
}
?>
