<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TeMan | Calender</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/logo.svg" />
    <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">
    <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">

    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/fullcalendar.css">
    <link rel="stylesheet" href="../assets/fullcalendar.print.css" media="print">
    <link rel="stylesheet" href="../assets/bootstrap.css">
    <script src="../assets/jquery.min.js"></script>
    <script src="../assets/jquery-ui.min.js"></script>
    <script src="../assets/moment.min.js"></script>
    <script src="../assets/fullcalendar.min.js"></script>
    
    
</head>
<body>

    <?php
    session_start();
    include "koneksi.php";

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
        <div class="iq-sidebar  sidebar-default ">
            <div class="iq-sidebar-logo d-flex align-items-center">
                <a href="index.php" class="header-logo">
                    <img src="../img/logo.svg" alt="logo">
                    <h3><b>TeMan</b></h3>
                </a>
            </div>
            <div class="iq-menu-bt-sidebar ml-0">
                    <i class="las la-bars wrapper-menu"></i>
            </div>
            <div class="data-scrollbar" data-scroll="1">
                <nav class="iq-sidebar-menu">
                    <ul id="iq-sidebar-toggle" class="iq-menu">
                        <li class="">
                            <a href="index.php" class="svg-icon">
                                <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span class="ml-4">Dashboard</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="page-task.php" class="svg-icon">
                                <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                    </path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                <span class="ml-4">Task</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="page-calender.php" class="svg-icon">
                                <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
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
    </div>
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-auto justify-content-between">
                        <i class="ri-menu-line wrapper-menu"></i>
                        </a>
                    </div>
                    <div class="navbar-breadcrumb">
                        <div id="calendar" style="width: 77% !important; margin: top 10%;">\
                    </div>
                    <div width="30%"></div><div width="10%"></div>

    <script>
        // Preparation for jQuery
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                // Table permission
                editable: true,
                // Schedule rules
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                //tampilkan data dari databases
                events: 'tampil.php',
                // Tampilkan data dari databases
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    //tampilkan pesan input
              
                    
                }
            });
        });
    </script>
</body>
</html>
