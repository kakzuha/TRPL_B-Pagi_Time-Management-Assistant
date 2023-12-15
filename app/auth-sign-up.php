<?php
session_start();
include 'koneksi.php';


if(isset($_POST['email'])){
    $nama = $_POST['name']; // Mengambil nilai 'name' dari form
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Mengambil nilai 'password' dari form

    $query = mysqli_query($koneksi, "INSERT INTO user(name, email, password) VALUES('$nama', '$email', '$password')");
    
    if($query){
        echo '<script>alert("Congratulations on your successful registration...!"); window.location.href="auth-sign-in.php";</script>';
    }else{
        echo '<script>alert("sorry you failed to register...!"); window.location.href="auth-sign-up.php";</script>';
    }
}
?>

<!doctype html>
<html lang="en">      
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>TeMan | Sign Up</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../img/logo.svg" />
      <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
      <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">
      <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">
      
      <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
      <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
      <link rel="stylesheet" href="../assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">  </head>
  <body class=" "> 
      <div class="wrapper">
      <section class="login-content">
         <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
               <div class="col-lg-8">
                  <div class="card auth-card">
                     <div class="card-body p-0">
                        <div class="d-flex align-items-center auth-content">
                           <div class="col-lg-6 bg-primary content-left">
                              <div class="p-3">
                                 <h2 class="mb-2 text-white">Sign Up</h2>
                                 <p>Create your TeMan account.</p>
                                 <form method="post">
                                    <div class="row">
                                       <br>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input type="text" class="floating-input form-control"  name="name" maxlength="50" required>
                                             <label>Name</label>
                                          </div>
                                       </div>
                                       <br>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="email" name="email" maxlength="64" required>
                                             <label>Email</label>
                                          </div>
                                       </div>
                                       <br>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="password" placeholder=" " name="password" minlength="8" required>
                                             <label>Password</label>
                                          </div>
                                       </div>
                                     <br>
                                       <div class="col-lg-12">
                                          <div class="custom-control custom-checkbox mb-3">
                                            
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-white">Sign Up</button>
                                    <p class="mt-3">
                                       Already have an Account 
                                       <a href="auth-sign-in.php" class="text-white text-underline" type="submit" >Sign In</a>
                                    </p>
                                 </form>
                              </div>
                           </div>
                           <div class="col-lg-6 content-right">
                              <img src="../img/signup.png" class="img-fluid image-right" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
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
</html>