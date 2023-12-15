<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TeMan | Edit profile</title>

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

    <body>
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

        // Periksa apakah ada file gambar profil
if (!empty($user['profile_picture'])) {
    $profile_picture_path = "img/" . $user['profile_picture'];
} else {
    // Jika tidak ada, gunakan gambar default
    $profile_picture_path = "https://th.bing.com/th/id/OIP.OiZkpsW6kU5ZirNR0vYKKQHaHa?pid=ImgDet&w=206&h=206&c=7&dpr=1,3";
}
?>
        <!-- loader Start -->
        <!--isi loding-->
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
                                    <span class="ml-4">Dashboards</span>
                                </a>
                            </li>

                            <li class="">
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

                            <ul id="otherpage" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <li class=" ">
                                    <a href="#user" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                        <svg class="svg-icon" id="p-dash10" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                            <polyline points="17 11 19 13 23 9"></polyline>
                                        </svg>
                                        <span class="ml-4">User Details</span>
                                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                    </a>
                                    <ul id="user" class="iq-submenu collapse" data-parent="#otherpage">
                                        <li class="">
                                            <a href="user-profile.php">
                                                <i class="las la-minus"></i><span>User Profile</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="user-add.html">
                                                <i class="las la-minus"></i><span>User Add</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="user-list.html">
                                                <i class="las la-minus"></i><span>User List</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class=" ">
                                    <a href="#ui" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                        <svg class="svg-icon" id="p-dash11" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                        </svg>
                                        <span class="ml-4">UI Elements</span>
                                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                    </a>
                                    <ul id="ui" class="iq-submenu collapse" data-parent="#otherpage">
                                        <li class="">
                                            <a href="ui-avatars.html">
                                                <i class="las la-minus"></i><span>Avatars</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-alerts.html">
                                                <i class="las la-minus"></i><span>Alerts</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-badges.html">
                                                <i class="las la-minus"></i><span>Badges</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-breadcrumb.html">
                                                <i class="las la-minus"></i><span>Breadcrumb</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-buttons.html">
                                                <i class="las la-minus"></i><span>Buttons</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-buttons-group.html">
                                                <i class="las la-minus"></i><span>Buttons Group</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-boxshadow.html">
                                                <i class="las la-minus"></i><span>Box Shadow</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-colors.html">
                                                <i class="las la-minus"></i><span>Colors</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-cards.html">
                                                <i class="las la-minus"></i><span>Cards</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-carousel.html">
                                                <i class="las la-minus"></i><span>Carousel</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-grid.html">
                                                <i class="las la-minus"></i><span>Grid</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-helper-classes.html">
                                                <i class="las la-minus"></i><span>Helper classes</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-images.html">
                                                <i class="las la-minus"></i><span>Images</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-list-group.html">
                                                <i class="las la-minus"></i><span>list Group</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-media-object.html">
                                                <i class="las la-minus"></i><span>Media</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-modal.html">
                                                <i class="las la-minus"></i><span>Modal</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-notifications.html">
                                                <i class="las la-minus"></i><span>Notifications</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-pagination.html">
                                                <i class="las la-minus"></i><span>Pagination</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-popovers.html">
                                                <i class="las la-minus"></i><span>Popovers</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-progressbars.html">
                                                <i class="las la-minus"></i><span>Progressbars</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-typography.html">
                                                <i class="las la-minus"></i><span>Typography</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-tabs.html">
                                                <i class="las la-minus"></i><span>Tabs</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-tooltips.html">
                                                <i class="las la-minus"></i><span>Tooltips</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="ui-embed-video.html">
                                                <i class="las la-minus"></i><span>Video</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class=" ">
                                    <a href="#auth" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                        <svg class="svg-icon" id="p-dash12" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                        <span class="ml-4">Authentication</span>
                                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                    </a>
                                    <ul id="auth" class="iq-submenu collapse" data-parent="#otherpage">
                                        <li class="">
                                            <a href="auth-sign-in.php">
                                                <i class="las la-minus"></i><span>Login</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="auth-sign-up.php">
                                                <i class="las la-minus"></i><span>Register</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="auth-recoverpw.html">
                                                <i class="las la-minus"></i><span>Recover Password</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="auth-confirm-mail.html">
                                                <i class="las la-minus"></i><span>Confirm Mail</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="auth-lock-screen.html">
                                                <i class="las la-minus"></i><span>Lock Screen</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="">
                                    <a href="#form" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                                        <svg class="svg-icon" id="p-dash13" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                        </svg>
                                        <span class="ml-4">Forms</span>
                                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                    </a>
                                    <ul id="form" class="iq-submenu collapse" data-parent="#otherpage">
                                        <li class="">
                                            <a href="form-layout.html">
                                                <i class="las la-minus"></i><span class="">Form Elements</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="form-input-group.html" class="svg-icon">
                                                <i class="las la-minus"></i><span class="">Form Input</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="form-validation.html" class="svg-icon">
                                                <i class="las la-minus"></i><span class="">Form Validation</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="form-switch.html" class="svg-icon">
                                                <i class="las la-minus"></i><span class="">Form Switch</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="form-chechbox.html" class="svg-icon">
                                                <i class="las la-minus"></i><span class="">Form Checkbox</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="form-radio.html" class="svg-icon">
                                                <i class="las la-minus"></i><span class="">Form Radio</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="form-textarea.html" class="svg-icon">
                                                <i class="las la-minus"></i><span class="">Form Textarea</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class=" ">
                                    <a href="#table" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                        <svg class="svg-icon" id="p-dash14" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="3" width="7" height="7"></rect>
                                            <rect x="14" y="3" width="7" height="7"></rect>
                                            <rect x="14" y="14" width="7" height="7"></rect>
                                            <rect x="3" y="14" width="7" height="7"></rect>
                                        </svg>
                                        <span class="ml-4">Table</span>
                                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                    </a>
                                    <ul id="table" class="iq-submenu collapse" data-parent="#otherpage">
                                        <li class="">
                                            <a href="tables-basic.html">
                                                <i class="las la-minus"></i><span>Basic Tables</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="table-data.html">
                                                <i class="las la-minus"></i><span>Data Table</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="table-tree.html">
                                                <i class="las la-minus"></i><span>Table Tree</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class=" ">
                                    <a href="#pricing" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                        <svg class="svg-icon" id="p-dash16" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                                        </svg>
                                        <span class="ml-4">Pricing</span>
                                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                                    </a>
                                    <ul id="pricing" class="iq-submenu collapse" data-parent="#otherpage">
                                        <li class="">
                                            <a href="pricing.html">
                                                <i class="las la-minus"></i><span>Pricing 1</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="pricing-2.html">
                                                <i class="las la-minus"></i><span>Pricing 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="">
                                    <a href="timeline.html" class="svg-icon">
                                        <svg class="svg-icon" id="p-dash016" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        <span class="ml-4">Timeline</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="pages-invoice.html" class="svg-icon">
                                        <svg class="svg-icon" id="p-dash07" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                        <span class="ml-4">Invoice</span>
                                    </a>
                                </li>
                                <li class=" ">
                                    <a href="#pages-error" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                        <svg class="svg-icon" id="p-dash17" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                            <line x1="12" y1="9" x2="12" y2="13"></line>
                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                        </svg>
                                

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
                            <h5>Edit Profile</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                                <i class="ri-menu-3-line"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto navbar-list align-items-center">


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
                                                                <div class="">
                                                                    <img class="avatar-50 rounded-small" src="../assets/images/user/01.jpg" alt="01">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Emma Watson</h6>
                                                                        <small class="text-dark"><b>12 : 47 pm</b></small>
                                                                    </div>
                                                                    <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="iq-sub-card">
                                                            <div class="media align-items-center cust-card py-3 border-bottom">
                                                                <div class="">
                                                                    <img class="avatar-50 rounded-small" src="../assets/images/user/02.jpg" alt="02">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Ashlynn Franci</h6>
                                                                        <small class="text-dark"><b>11 : 30 pm</b></small>
                                                                    </div>
                                                                    <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="#" class="iq-sub-card">
                                                            <div class="media align-items-center cust-card py-3">
                                                                <div class="">
                                                                    <img class="avatar-50 rounded-small" src="../assets/images/user/03.jpg" alt="03">
                                                                </div>
                                                                <div class="media-body ml-3">
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <h6 class="mb-0">Kianna Carder</h6>
                                                                        <small class="text-dark"><b>11 : 21 pm</b></small>
                                                                    </div>
                                                                    <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                                </div>
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
                                <div class="card-body p-0">
                                    <div class="iq-edit-list usr-edit">
                                        <ul class="iq-edit-profile d-flex nav nav-pills">
                                            <li class="col-md-3 p-0">
                                                <a class="nav-link active" href="user-profile-edit.php">Personal Information</a>
                                            </li>
                                            <li class="col-md-3 p-0">
                                                <a class="nav-link" href="user-change-password.php">Change Password</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form enctype="multipart/form-data" method="post">
                                <div class="form-group row align-items-center">
                                    <div class="col-md-12">
                                        <div class="profile-img-edit">
                                            <div class="crm-profile-img-edit">

                                                <img class="crm-profile-pic rounded-circle avatar-100" src="<?php echo $profile_picture_path; ?>" alt="Profile Picture">
                                                <div class="crm-p-image bg-primary">
                                                    <i class="las la-pen upload-button"></i>
                                                    <input class="file-upload" type="file" accept="image/*" name="profile_picture">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">EMAIL :</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $user['name']; ?>" required">
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn iq-bg-danger">Cancel</button>
                            </form>

                            <?php

                            include "koneksi.php";

                            if (!isset($_SESSION['user'])) {
                                header("Location: user-profile-edit.php");
                                exit();
                            }

                            $user_id = $_SESSION['user']['user_id'];

                            $query = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id = '$user_id'");
                            $user = mysqli_fetch_assoc($query);
                            ?>

                          
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