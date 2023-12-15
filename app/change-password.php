<?php
session_start();
include 'koneksi.php';

$password = md5($_POST['password']);
echo "Password Lama yang dimasukkan: $password <br>";

$tampil = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id =  password = '$password'");
$data = mysqli_fetch_array($tampil);

if ($data) {
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    if ($password_baru == $konfirmasi_password) {
        $password_ok = md5($password_baru);
        $ubah = mysqli_query($koneksi, "UPDATE user SET password = '$password_ok' WHERE user_id = '$data[user_id]'");

        if ($ubah) {
            echo "<script>alert('Your password was successfully changed'); 
            document.location.href='user-change-password.php';</script>";
        } else {
            echo "<script>alert('failed to change password'); 
            document.location.href='user-change-password.php';</script>";
        }
    } else {
        echo "<script>alert('New Password and Confirm password are not the same'); 
        document.location.href='user-change-password.php';</script>";
    }
} else {
    echo "<script>alert('The old password you entered is incorrect/not registered'); 
    document.location.href='user-change-password.php';</script>";
}
?>

