
<?php 
include 'koneksi.php';
include "include/SimpleImage.php";
$alamat="";
$id = $_POST['id'];
$nama = $_POST['nama'];
$jenjang = $_POST['jenjang'];
$lat = $_POST['latitude'];
$long = $_POST['longitude'];
$kecamatan = $_POST['kecamatan'];
$kelurahan = $_POST['kelurahan'];
$jalan = $_POST['jalan'];
$telefon = $_POST['telefon'];
$gambar = $_POST['gambar'];
$email = $_POST['email'];
   if($_POST['upload']){
	$ekstensi_diperbolehkan	= array('png','jpg');
	$nama_file = $_FILES['file']['name'];
	$x = explode('.', $nama_file);
	$titik = '.';
	$ekstensi = strtolower(end($x));
	$ex = $titik.$ekstensi;
	$ukuran	= $_FILES['file']['size'];
	$file_tmp = $_FILES['file']['tmp_name'];	
		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		    if($ukuran < 2044070){		
		    $alamat= $kecamatan.','.$kelurahan.','.$jalan;
			$query=mysqli_query($connect,"UPDATE tb_tempat set nama_tempat='$nama',gambar='$ex',lat='$lat',lng='$long',lokasi='$alamat',telp='$telefon',email='$email',tingkat='$jenjang' where id_tempat='$id' ");
			
			if($query){

		$img = new SimpleImage($file_tmp);
           $img->resize(300, 350);

				 $img->save('upload/' .$nama.$titik.$ekstensi);            
            
			header("Location: CRUD.php");
			}else{
				echo 'GAGAL MENGUPLOAD GAMBAR';
			}
		    }else{
			echo 'UKURAN FILE TERLALU BESAR';
		    }
	       }else{
		echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
		if ($nama_file=='') {
	    	$alamat= $kecamatan.','.$kelurahan.','.$jalan;
			$query=mysqli_query($connect,"UPDATE tb_tempat set nama_tempat='$nama',gambar='$gambar',lat='$lat',lng='$long',lokasi='$alamat',telp='$telefon',email='$email',tingkat='$jenjang' where id_tempat='$id' ");
			header("Location: CRUD.php");
	    }
	       }

    }
?>