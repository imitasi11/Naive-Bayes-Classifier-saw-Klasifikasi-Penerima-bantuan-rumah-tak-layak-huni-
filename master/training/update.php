  
<?php 

include "../koneksi.php";
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

$id = $_POST['id'];
$nama = $_POST['nama'];

print_r($tampung);
print_r($noatribut);

for($i=1;$i<=$jml_atribut;$i++){
	$query_mysql = "UPDATE tb_data SET id_parameter ='$tampung[$i]' WHERE id_responden='$id' AND id_atribut='$noatribut[$i]'";
	$result = $db->query($query_mysql);
	if($result){
		

	}
	
}
$querys_mysql = "UPDATE tb_responden SET responden ='$nama' WHERE id_responden='$id'";
$resultname= $db->query($querys_mysql);
if($resultname){
				
}
 header('Location: ../training.php');
?>