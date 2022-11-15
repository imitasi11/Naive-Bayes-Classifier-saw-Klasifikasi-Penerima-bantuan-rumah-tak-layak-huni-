  
<?php 

include "../koneksi.php";
$jalan=0;
$jml_atribut=0;
$count=1;
$well="";
$sql = 'SELECT * FROM tb_atribut order by id_atribut';
$result = $db->query($sql);
$noatribut=array();
foreach ($result as $row) {
    $noatribut[$count]=$row['id_atribut'];
    $jml_atribut=$jml_atribut+1 ;
    $count=$count+1;
    }

$tampung=array();
for($i=1;$i<=$jml_atribut;$i++){
	$tampung[$i] = $_POST[$noatribut[$i]];
}

$nama = $_POST['nama'];

$id_responden=rand(1,300);
$cek_result = mysqli_query($connect,"SELECT * FROM tb_responden where id_responden ='$id_responden' ")or die(mysqli_error());
$numrow = mysqli_num_rows($cek_result);


while($numrow > 0){
    $id_responden=0;
	$id_responden=rand(1,300);
	$cek_id= "SELECT * FROM tb_responden where id_responden ='$id_responden' ";
	$cek_result = mysqli_query($connect,"SELECT * FROM tb_responden where id_responden ='$id_responden' ")or die(mysqli_error());
$numrow = mysqli_num_rows($cek_result);

}
	if($numrow == 0){
		$input_responden = "INSERT INTO tb_responden VALUES('$id_responden','$nama') ";
	$responden_result = $db->query($input_responden);
	for($i=1;$i<=$jml_atribut;$i++){
		$a=$noatribut[$i];
		$b=$tampung[$i];
	$input_data = "INSERT INTO tb_data (id_data,id_responden,id_atribut,id_parameter) VALUES(NULL,'$id_responden','$a','$b') ";
	$data_result = $db->query($input_data);
		
	}
	header('Location: ../training.php');
	}



	 

?>