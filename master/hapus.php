<?php 
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($connect,"DELETE FROM tb_tempat WHERE id_tempat='$id'")or die(mysql_error());

header("location:crud.php");
?>