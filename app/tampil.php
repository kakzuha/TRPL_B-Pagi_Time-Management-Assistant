<?php
// Panggil koneksi
session_start();
include "koneksi.php";

$user_id = $_SESSION['user']['user_id'];

$tampil = mysqli_query($koneksi, "SELECT * FROM `task` WHERE user_id = '$user_id' ORDER BY task_id ");

$dataArr = array();
while ($data = mysqli_fetch_array($tampil)) {

    $dataArr[] = array(
        'id' => $data['task_id'],
        'title' => $data['name_task'],
        'start' => $data['end_date'],
        'end' => $data['end_date'],
        'allDay' => true, // Atur ke true jika tugas berlangsung sepanjang hari
        'color' => ($data['status'] == 'completed') ? 'green' : 'salmon blue', // Sesuaikan warna sesuai status
        'description' => $data['description'], // Tambahkan deskripsi tugas
    );
}

echo json_encode($dataArr);
?>
