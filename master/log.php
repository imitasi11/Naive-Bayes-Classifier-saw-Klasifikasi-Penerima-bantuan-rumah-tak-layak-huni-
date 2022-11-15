<?php
	include "koneksi.php";
	
	$user=$_POST['username'];
	$pass=$_POST['password'];
	
	
	$query = "select * from login where id = '".$_POST['username']."' and password ='".$_POST['password']."'";
	$hasil = mysqli_query($connect,$query);
	$row  = mysqli_fetch_array($hasil);
	$cekrow = mysqli_num_rows($hasil);
	
	//session_destroy();
	//profil echo
	
	
	if ($cekrow ==1){
	session_start();
	
	$_SESSION['username'] = $user;
	header("location:training.php");
	}
	else{
	echo "<script>alert('gagal');window.location='LOGIN.php'</script>";
}
?>