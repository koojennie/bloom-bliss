<?php
$server = "rm-d9jkah62jypc32943vo.mysql.ap-southeast-5.rds.aliyuncs.com:3306";
$user = "root";
$pass = "270819@Alia";
$database = "bloom_bliss";

// membuat variabel untuk koneksi
$conn = mysqli_connect($server, $user, $pass, $database);

// cek koneksi disini 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>