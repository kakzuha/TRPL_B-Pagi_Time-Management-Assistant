<?php
session_start();
include "koneksi.php";

if (isset($_POST['delete'])) {
    $task_id = $_POST['task_id'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TeMan | Delete Task</title>
        <!-- Tambahkan stylesheet atau gunakan framework CSS seperti Bootstrap -->
        <link rel="stylesheet" href="path/to/your/styles.css">
        <script>
            function confirmDelete() {
                var result = confirm("Are you sure you want to delete this task?");
                if (result) {
                    // Redirect jika pengguna mengonfirmasi penghapusan
                    window.location.href = "delete_task.php?task_id=<?= $task_id; ?>";
                }
            }
        </script>
    </head>

    <body>
        <h2>Delete Task</h2>
        <!-- Tampilkan pesan dan konfirmasi -->
        <p>Are you sure you want to delete this task?</p>
        <button onclick="confirmDelete()">Yes, Delete</button>
        <button onclick="history.go(-1)">No, Cancel</button>
    </body>

    </html>
<?php
}
?>

<?php
if (isset($_POST['delete'])) {
    $task_id = $_POST['task_id'];

    // Lakukan apa yang diperlukan untuk proses delete, misalnya:
    $query = "DELETE FROM task WHERE task_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $task_id);
    mysqli_stmt_execute($stmt);

    // Tampilkan pesan atau lakukan redirect setelah menghapus
    header("Location: page-task.php");
    exit();
} else {
    echo "Task ID not provided.";
    exit();
}
?>
