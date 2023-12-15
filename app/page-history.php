<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user'])) {
    header("Location: auth-sign-in.php");
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TeMan | History</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/logo.svg" />
    <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">

    <script src="https://kit.fontawesome.com/b04c2e8e37.js" crossorigin="anonymous"></script>

</head>


<?php


    $user_id = $_SESSION['user']['user_id'];

    // Ambil data pengguna dari basis data berdasarkan ID
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id = '$user_id'");
    $user = mysqli_fetch_assoc($query);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Proses formulir saat dikirim
        $new_email = $_POST['email'];
        $new_name = $_POST['name'];

        // Periksa apakah file gambar diupload
        if ($_FILES['profile_picture']['error'] == 0) {
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
            
            // Pindahkan file yang diupload ke direktori tujuan
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);

            // Simpan nama file ke dalam basis data
            $profile_picture = basename($_FILES['profile_picture']['name']);
            $update_query = "UPDATE user SET email = '$new_email', name = '$new_name', profile_picture = '$profile_picture' WHERE user_id = '$user_id'";
        } else {
            // Jika tidak ada file yang diupload, hanya perbarui email dan username
            $update_query = "UPDATE user SET email = '$new_email', name = '$new_name' WHERE user_id = '$user_id'";
        }

        mysqli_query($koneksi, $update_query);
        header("Location:  user-profile-edit.php"); // Redirect ke halaman setelah edit profil
        exit();
    }

if (!empty($user['profile_picture'])) {
    $profile_picture_path = "img/" . $user['profile_picture'];
} else {
    $profile_picture_path = "https://th.bing.com/th/id/OIP.OiZkpsW6kU5ZirNR0vYKKQHaHa?pid=ImgDet&w=206&h=206&c=7&dpr=1,3";
}

?>

    <!-- loader Start -->

    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        <div class="iq-sidebar  sidebar-default ">
            <div class="iq-sidebar-logo d-flex align-items-center">
                <a href="index.php" class="header-logo">
                    <img src="../img/logo.svg" alt="logo">
                    <h3><b>TeMan</b></h3>
                </a>
                <div class="iq-menu-bt-sidebar ml-0">
                    <i class="las la-bars wrapper-menu"></i>
                </div>
            </div>
            <div class="data-scrollbar" data-scroll="1">
                <nav class="iq-sidebar-menu">
                    <ul id="iq-sidebar-toggle" class="iq-menu">
                        <li class="">
                            <a href="index.php" class="svg-icon">
                                <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span class="ml-4">Dashboard</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="page-task.php" class="svg-icon">
                                <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                <span class="ml-4">Task</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="page-calender.php" class="svg-icon">
                                <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <span class="ml-4">Calender</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="pt-5 pb-2"></div>
            </div>
        </div>
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                        <i class="ri-menu-line wrapper-menu"></i>
                        <a href="index.php" class="header-logo">
                            <h4 class="logo-title text-uppercase">TeMan</h4>
                        </a>
                    </div>
                    <div class="navbar-breadcrumb">
                    </div>

                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                            <i class="ri-menu-3-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li>
                                 
                                </li>
                                <li class="nav-item nav-icon search-content">
                                    <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-search-line"></i>
                                    </a>
                                    <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                        <form action="#" class="searchbox p-2">
                                            <div class="form-group mb-0 position-relative">
                                                <input type="text" class="text search-input font-size-12" placeholder="type here to search...">
                                                <a href="#" class="search-link"><i class="las la-search"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon nav-item-icon dropdown">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg>
                                        <span class="bg-primary "></span>
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 ">
                                                <div class="cust-title p-3">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h5 class="mb-0">Notifications</h5>
                                                        <a class="badge badge-primary badge-card" href="#">3</a>
                                                    </div>
                                                </div>
                                                <div class="px-3 pt-0 pb-0 sub-card">
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center cust-card py-3 border-bottom">
                                                            <!--isi-->
                                                        </div>
                                                    </a>
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center cust-card py-3 border-bottom">
                                                            <!--isi-->
                                                        </div>
                                                    </a>
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center cust-card py-3">
                                                            <!--isi-->
                                                        </div>
                                                    </a>
                                                </div>
                                                <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#" role="button">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon dropdown caption-content">
                                    <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo $profile_picture_path; ?>" class="img-fluid rounded-circle" alt="profil picture">
                                        <div class="caption ml-3">
                                            <h6 class="mb-0 line-height"><?php echo $user['name']; ?><i class="las la-angle-down ml-2"></i></h6>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right border-none" aria-labelledby="dropdownMenuButton">
                                        <li class="dropdown-item d-flex svg-icon">
                                            <svg class="svg-icon mr-0 text-primary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <a href="user-profile.php">My Profile</a>
                                        </li>
                                        <li class="dropdown-item d-flex svg-icon">
                                            <svg class="svg-icon mr-0 text-primary" id="h-02-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <a href="user-profile-edit.php">Edit Profile</a>
                                        </li>
                                        <li class="dropdown-item  d-flex svg-icon border-top">
                                            <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <a href="logout.php">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                                    <h5>Task History</h5>
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="dropdown dropdown-project mr-3">
                                            <div class="dropdown-toggle" id="dropdownMenuButton03" data-toggle="dropdown">
                                               
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton03">
                                                <a class="dropdown-item" href="#"><i class="ri-attachment-line mr-2"></i></a>
                                                <a class="dropdown-item" href="#"><i class="ri-file-copy-line mr-2"></i></a>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-primary" data-target="#new-task-modal" data-toggle="modal" margin-top="10px"><i class="fa-solid fa-file-circle-plus"></i>New Task</a>
                                        <div>
                                            <a href="history.php" class="btn btn-primary ml-1"><i class="fa-solid fa-clock-rotate-left"></i>history task</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="collapseEdit1">
                        <div class="card card-list task-card">
                            <div class="card-header d-flex align-items-center justify-content-between px-0 mx-3">
                                <div class="header-title">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="customCheck05">
                                        <label class="custom-control-label h5" for="customCheck05">Mark as done</label>
                                    </div>
                                </div>
                                <div><a href="#" class="btn bg-secondary-light">Design</a></div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3 position-relative">
                                    <input type="text" class="form-control bg-white" placeholder="Design landing page of TeMan">
                                    <a href="#" class="task-edit task-simple-edit text-body"><i class="ri-edit-box-line"></i></a>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5 class="mb-2">Description</h5>
                                                <p class="mb-0">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
                                            </div>
                                            <div class="col-lg-6">
                                                <h5 class="mb-2">Checklist</h5>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                            <label class="custom-control-label mb-1" for="customCheck1">Design mobile version</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck02">
                                                            <label class="custom-control-label mb-1" for="customCheck02">Use images of unsplash.com</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                            <label class="custom-control-label" for="customCheck3">Vector images of small size.</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck04">
                                                            <label class="custom-control-label mb-1" for="customCheck04">Design mobile version of landing page</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                                                            <label class="custom-control-label mb-1" for="customCheck5">Use images of unsplash.com</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox custom-control-inline mr-0">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck06">
                                                            <label class="custom-control-label" for="customCheck06">Vector images of small size..</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="exampleInputText01" class="h5">Attachments</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile001">
                                        <label class="custom-file-label" for="inputGroupFile001">Upload media</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <?php
                    if (isset($_SESSION['user'])) {
                        // Ambil user_id dari sesi
                        $user_id = $_SESSION['user']['user_id'];

                        // Retrieve tasks for the logged-in user
                        $query = "SELECT * FROM task WHERE user_id = ? AND status='finished'";
                        $stmt = mysqli_prepare($koneksi, $query);
                        mysqli_stmt_bind_param($stmt, "i", $user_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                    ?>

                        <?php if (mysqli_num_rows($result) > 0) : ?>
                            <h2>Tasks History</h2>
                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col"><strong>Task Name</strong></th>
                                        <th scope="col"><strong>Priority</strong></th>
                                        <th scope="col"><strong>End Date</strong></th>
                                        <th scope="col"><strong>Status</strong></th>
                                        <th scope="col"><strong>Description</strong></th>
                                        <th scope="col"><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <tr>
                                            <td><strong><?= $row['name_task']; ?></strong></td>
                                            <td><?= $row['priority']; ?></td>
                                            <td><?= $row['end_date']; ?></td>
                                            <td><?= $row['status']; ?></td>
                                            <td><?= $row['description']; ?></td>
                                            <td>
                                                <div class="row mb-3">
                                                    <form method='post' action='edit-task.php' class='action-form'>
                                                        <input type='hidden' name='task_id' value='<?= $row['task_id']; ?>'>
                                                        <button type='submit' name='edit' class='btn btn-action btn-primary'>
                                                            <i class='fa-solid fa-pen-to-square'></i>
                                                        </button>
                                                    </form>
                                                    <form method='post' action='delete-task.php' onsubmit="return confirm('Are you sure you want to delete this task?');" class='action-form'>
                                                        <input type='hidden' name='task_id' value='<?= $row['task_id']; ?>'>
                                                        <button type='submit' name='delete' class='btn btn-action btn-danger'><i class="fa-regular fa-trash-can"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>No history yet.</p>
                        <?php endif; ?>

                    <?php
                        mysqli_stmt_close($stmt);
                    } else {
                        // Handle if user_id is not available in the session
                        echo "User not logged in.";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Page end  -->
    </div>
    </div>
    </div>
    <!-- Wrapper End-->

    <div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-task-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block text-center pb-3 border-bottom">
                    <h3 class="modal-title" id="exampleModalCenterTitle">New Task</h3>
                </div>


                <!--ini formulir untuk input-->
                <form action="upload-task.php" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="exampleInputText02" class="h5">Task Name</label>
                                    <input type="text" class="form-control" id="exampleInputText02" placeholder="Enter task Name" name="name_task" required>
                                    <a href="#" class="task-edit text-body"><i class="ri-edit-box-line"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="exampleInputText2" class="h5">Priority</label>
                                    <select name="priority" class="selectpicker form-control" data-style="py-0" required>
                                        <option value="Hig">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="exampleInputText05" class="h5">Deadline*</label>
                                    <input type="datetime-local" class="form-control" id="exampleInputText05" value="dd/mm/yy" name="end_date">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="exampleInputText2" class="h5">Status</label>
                                    <select name="status" class="selectpicker form-control" data-style="py-0">
                                        <option value="Not Started">Not Started</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Finishe">Finished</option>
                                    </select>
                                </div>
                            </div>
                
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="exampleInputText040" class="h5">Description</label>
                                    <textarea name="description" class="form-control" id="exampleInputText040" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex flex-wrap align-items-center justify-content-center mt-4">
                                    <button type="submit" class="btn btn-primary mr-3" name="submit">Save</button>
                                    <div class="btn btn-primary" data-dismiss="modal">Cancel</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <script>
                    function moveToHistory(taskId, buttonId) {
                        var result = confirm("Are you sure you want to move this task to history?");
                        if (result) {
                            // Kirim permintaan AJAX ke server untuk memindahkan tugas ke history
                            var xhr = new XMLHttpRequest();
                            var params = "task_id=" + encodeURIComponent(taskId);
                            xhr.open("POST", "move_to_history.php", true);
                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    // Ubah warna tombol setelah pemindahan berhasil
                                    document.getElementById(buttonId).style.backgroundColor = "green";
                                    document.getElementById(buttonId).disabled = true; // Menonaktifkan tombol setelah diklik
                                }
                            };
                            xhr.send(params);
                        }
                    }
                </script>

                <!-- Backend Bundle JavaScript -->
                <script src="../assets/js/backend-bundle.min.js"></script>

                <!-- Table Treeview JavaScript -->
                <script src="../assets/js/table-treeview.js"></script>

                <!-- Chart Custom JavaScript -->
                <script src="../assets/js/customizer.js"></script>

                <!-- Chart Custom JavaScript -->
                <script async src="../assets/js/chart-custom.js"></script>
                <!-- Chart Custom JavaScript -->
                <script async src="../assets/js/slider.js"></script>

                <!-- app JavaScript -->
                <script src="../assets/js/app.js"></script>

                <script src="../assets/vendor/moment.min.js"></script>
</body>
<script>
    function moveToHistory(taskId) {
        var result = confirm("Are you sure you want to move this task to history?");
        if (result) {
            var xhr = new XMLHttpRequest();
            var params = "task_id=" + encodeURIComponent(taskId);
            xhr.open("POST", "move_to_history.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Refresh halaman setelah pemindahan berhasil
                    location.reload();
                }
            };
            xhr.send(params);
        }
    }
</script>


</html>