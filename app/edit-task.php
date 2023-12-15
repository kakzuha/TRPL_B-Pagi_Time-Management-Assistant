<?php
session_start();
include "koneksi.php";

// Pastikan task_id tersedia dan bukan kosong
if (isset($_POST['edit']) && isset($_POST['task_id']) && !empty($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    // Ambil informasi tugas berdasarkan task_id
    $query = "SELECT * FROM task WHERE task_id = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $task_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Periksa apakah data tugas ditemukan
    if ($row = mysqli_fetch_assoc($result)) {
        $name_task = $row['name_task'];
        $priority = $row['priority'];
        $end_date = $row['end_date'];
        $status = $row['status'];
        $description = $row['description'];
    } else {
        echo "Task not found.";
        exit();
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Task ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teman | Edit Task</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        textarea.form-control {
            resize: none;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center text-primary">Edit Task</h2>

        <form action="page-edit-task.php" method="post">
            <div class="modal-body">
                <div class="row">

                    <div class="form-group">
                        <input type="hidden" name="task_id" value="<?= $task_id; ?>">
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="name_task" class="h5">Task Name</label>
                            <input type="text" class="form-control" id="exampleInputText02" placeholder="Enter task Name" name="name_task" value="<?= $name_task; ?>" required>
                            <a href="#" class="task-edit text-body"><i class="ri-edit-box-line"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label for="exampleInputText2" class="h5">Priority</label>
                            <select name="priority" class="selectpicker form-control" data-style="py-0" name="priority" value="<?= $priority; ?>" required>
                                <option>High</option>
                                <option>Medium</option>
                                <option>Low</option>
                                <option>Urgent</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label for="exampleInputText05" class="h5">Deadline*</label>
                            <input type="datetime-local" class="form-control" id="exampleInputText05" value="<?= $end_date; ?>" name="end_date" required>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label for="exampleInputText2" class="h5">Status</label>
                            <select class="selectpicker form-control" data-style="py-0" name="status" value="<?= $status; ?>" required>
                                <option>Not Started</option>
                                <option>In Progress</option>
                                <option>Compleatd</option>
                                <option>Delayed</option>
                                <option>Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText040" class="h5">Description</label>
                            <textarea class="form-control" id="exampleInputText040" rows="2" name="description" required><?= $description; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="update">Update Task</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js (Optional) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>