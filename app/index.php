<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TeMan | Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/logo.svg" />
    <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">

    <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
    <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
    <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">
</head>

<body class="  ">
    <?php
    session_start();
    include "koneksi.php";
    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['user'])) {
        header("Location: auth-sign-in.php");
        exit();
    }

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
    ?>
    <?php
    // Periksa apakah ada file gambar profil
if (!empty($user['profile_picture'])) {
    $profile_picture_path = "img/" . $user['profile_picture'];
} else {
    // Jika tidak ada, gunakan gambar default
    $profile_picture_path = "https://th.bing.com/th/id/OIP.OiZkpsW6kU5ZirNR0vYKKQHaHa?pid=ImgDet&w=206&h=206&c=7&dpr=1,3";
}
?>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="iq-sidebar sidebar-default ">
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
                        <li class="active">
                            <a href="index.php" class="svg-icon">
                                <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span class="ml-4">Dashboards</span>
                            </a>
                        </li>
                        <li>
                            <a href="page-task.php" class="svg-icon">
                                <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                    </path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                <span class="ml-4">Task</span>
                            </a>
                        </li>
                        <li>
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
            </div>
        </div>
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                        <i class="ri-menu-line wrapper-menu"></i>
                        <a href="index.php" class="header-logo">
                        <h4 class="logo-title">TeMan</h4>
                        </a>
                    </div>
                    <div class="navbar-breadcrumb">
                        <h5>Dashboard</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                            <i class="ri-menu-3-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <!--bell notif-->
                                <li class="nav-item nav-icon nav-item-icon dropdown">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg>
                                        <span class="bg-primary "></span>
                                    </a>

                                    <?php
                                    $query1 = mysqli_query($koneksi, "SELECT * FROM task WHERE user_id = '$user_id' AND end_date < DATE_ADD(NOW(), INTERVAL 1 HOUR) and end_date >= NOW()");
                                    $count = mysqli_num_rows($query1);
                                    ?>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 ">
                                                <div class="cust-title p-3">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h5 class="mb-0">Notifikasi</h5>
                                                        <a class="badge badge-primary badge-card" href="#"><?php echo $count ?></a>
                                                    </div>
                                                </div>
                                                <div class="px-3 pt-0 pb-0 sub-card">

                                                <?php
                                                    $query2 = mysqli_query($koneksi, "SELECT * FROM task WHERE user_id = '$user_id' AND end_date < DATE_ADD(NOW(), INTERVAL 1 HOUR) and end_date >= NOW()");
                                                    while($row = mysqli_fetch_array($query2)) {
                                                ?>
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center cust-card py-3 border-bottom">
                                                            <p>Segera kerjakan task <?php echo $row['name_task'] ?></p>
                                                        </div>
                                                    </a>
                                                <?php } ?>
                                                </div>
                                                <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#" role="button">See All</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon dropdown caption-content">
                                    <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?php echo $profile_picture_path; ?>" class="img-fluid rounded-circle" alt="profil picture">
                                        <div class="caption ml-3">
                                            <h6 class="mb-0 line-height">
                                            <?php echo $user['name']; ?>
                                            <i class="las la-angle-down ml-2"></i>
                                            </h6>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right border-none" aria-labelledby="dropdownMenuButton">

                                        <li class="dropdown-item d-flex svg-icon">
                                            <a href="user-profile.php">My Profile
                                                <svg class="svg-icon mr-0 text-primary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </a>
                                        </li>

                                        <li class="dropdown-item d-flex svg-icon">
                                            <a href="user-profile-edit.php">Edit Profile
                                                <svg class="svg-icon mr-0 text-primary" id="h-02-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        </li>

                                        <li class="dropdown-item  d-flex svg-icon border-top">
                                            <a href="logout.php">Logout
                                                <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!--ISI HALAMAN-->
        <div class="content-page">
            <div class="p-3 mb-2 bg-primary rounded">
                <h2 style="color: white;">Welcome to TeMan!</h2>
            </div>
            <div class="card-body p-0">
                <ul class="list-unstyled row mb-0">
                    <li class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Manual Book</h5>
                                <p class="mb-3"><i class="las la-calendar-check mr-2"></i>15/12/2023</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <p>See the manual book <a href="https://polnebat-my.sharepoint.com/:b:/g/personal/kavita_4342301050_students_polibatam_ac_id/EVCLUOWwTPBFvnzMK1v_VOIBTDFo1ocY3STLjvQrYLvlMQ?e=rl0j4V">here.</a></p>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div>
        
    <!--Footer-->
        <footer class="iq-footer">
            <div class="container-fluid">
                <div class="col-lg-6 text-right">
                    <span class="mr-1">
                        <script>
                            document.write(new Date().getFullYear())
                        </script>©
                    </span>
                    <a href="#" class="">TeMan</a>.
                </div>
            </div>
        </footer>
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
</html>