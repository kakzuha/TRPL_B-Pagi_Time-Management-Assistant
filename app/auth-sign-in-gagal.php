<?php
session_start();
include "koneksi.php";
?>

<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>TeMan | Sign In</title>

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
   <link rel="stylesheet"  href="style.css">
</head>

<body >
 
<?php
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email' and password = '$password'");

    if(mysqli_num_rows($query) > 0){
        $data = mysqli_fetch_array($query);

        $_SESSION['user'] = $data;
        header("Location: index.php");
    }else {
        $error_message = "Email or password is incorrect."; // Pesan kesalahan

        // Simpan pesan kesalahan di session untuk ditampilkan di halaman auth-sign-in-gagal.php
        $_SESSION['error_message'] = $error_message;

        header("Location: auth-sign-in-gagal.php");
    }
}
?>
   <!-- loader Start -->
   
   <!-- loader END -->
   

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
                                 <h2 class="mb-2 text-white">Sign In</h2>
                                 <p>Login to stay connected.</p>


                                 <form method="post">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input name="email" class="floating-input form-control" type="email">
                                             <label>Email</label>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input name="password" class="floating-input form-control" type="password" placeholder=" " >
                                             <label>Password</label>
                                             
                                          </div>
                                          <p class="error-message"><i class="fa-solid fa-circle-exclamation"></i> Email or password does not match</p>
                                       </div>
                                       
                                       <div class="col-lg-6">
                                          <div class="custom-control custom-checkbox mb-3">
                                             <input type="checkbox" class="custom-control-input" id="customCheck1">
                                             <label class=""
                                                for="customCheck1"></label>
                                          </div>
                                       </div>
                                    </div>
            
            
        
                                    <button type="submit" class="btn btn-white">Sign In</button>
                                    <p class="mt-3">
                                       Create an Account <a href="auth-sign-up.php"
                                          class="text-white text-underline">Sign Up</a>
                                    </p>

                                 </form>
                              </div>
                           </div>
                           <div class="col-lg-6 content-right">
                              <img src="../img/login.png" class="img-fluid image-right" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
   <style>
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }
</style>




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