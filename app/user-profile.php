<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>TeMan | Profil</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../img/logo.svg" />
      <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
      <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">
      <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">
      
      <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
      <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
      <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css"> 
      
      <script src="https://kit.fontawesome.com/b04c2e8e37.js" crossorigin="anonymous"></script>
    </head>
  <body class="  ">
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


    <!-- loader Start -->
       <!--isi loading-->
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
                          <a href="page-calender.html" class="svg-icon">                        
                              <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line>
                              </svg>
                              <span class="ml-4">Calender</span>
                          </a>
                      </li>
                          </div>
                      </div>
                  </div>
              </div>
    
          
      <!--navbar-->  
      <div class="iq-top-navbar" style="background-color: light; box-shadow: none;">
          <div class="iq-navbar-custom">
              <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                      <i class="ri-menu-line wrapper-menu"></i>
                      <a href="index.php" class="header-logo">
                          <h4 class="logo-title text-uppercase">TeMan</h4>
      
                      </a>
                  </div>
                  <div class="navbar-breadcrumb">
                      <h5><strong>My Profile</strong></h5>
                  </div>
                  <div class="d-flex align-items-center">
                      <button class="navbar-toggler" type="button" data-toggle="collapse"
                          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                          aria-label="Toggle navigation">
                          <i class="ri-menu-3-line"></i>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav ml-auto navbar-list align-items-center">
                              <li class="nav-item nav-icon dropdown caption-content">
                                  <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center" id="dropdownMenuButton4"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="<?php echo $profile_picture_path; ?>" class="img-fluid rounded-circle" alt="profile picture">
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
      <div class="container mt-8 fixed-left" >
        <div class="row justify-content-center">
            <div class="col-lg-5" >
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?php echo $profile_picture_path; ?>" width="200" height="200" class="rounded-circle" alt="profile picture">
                        <h4 class="card-title mt-2"><?php echo $user['name']; ?></h4>
                        <a href="user-profile-edit.php" class="btn btn-primary font-size-14">
                            <i class="fa-solid fa-pen-to-square"></i>Edit Profil
                        </a>
                        <table>
                            <tr>
                                <td></td>
                                        <td><strong>Email address:</strong></td>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <td>
                                            <h6><p class="mb-0"><?php echo $user['email']; ?></p></h6></td>
                                    </tr>
                            </tr>
                        </table>
                    
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
                       

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
  <style>
        .rounded-image {
            border-radius: 50%;
            width: 50px; /* Sesuaikan ukuran gambar */
            height: 50px; /* Sesuaikan ukuran gambar */
            object-fit: cover; /* Untuk memastikan gambar tidak terdistorsi */
        }
    </style>
</html>