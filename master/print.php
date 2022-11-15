<!doctype html>
<html>
<?php
include "koneksi.php";
session_start();
if(!empty($_SESSION['username'])) {
    
}else{
            header("location:login.php?pesan=gagal");

}


?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1">

	<title>Homepage</title>
	<link rel="icon" href="favicon.png" type="image/png">
	<link rel="shortcut icon" href="favicon.ico" type="img/x-icon">

	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600' rel='stylesheet' type='text/css'>

	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
	<link href="css/responsive.css" rel="stylesheet" type="text/css">
	<link href="css/magnific-popup.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="js/jquery.1.8.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery-scrolltofixed.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery.isotope.js"></script>
	<script type="text/javascript" src="js/wow.js"></script>
	<script type="text/javascript" src="js/classie.js"></script>
	<script type="text/javascript" src="js/magnific-popup.js"></script>
	<script src="contactform/contactform.js"></script>

	<script type="text/javascript" src="main.js"></script>
	<script type="text/javascript">
       function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
  </script>
<?php 

$a=1;
$jml_atribut= 0;
$sum = 0;
$tambah= 0;
$count=1;
$count1=1;

$isi=array();
include "koneksi.php";


$sql = 'SELECT * FROM tb_atribut';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut=array();
$bencost=array();
$bobot=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $noatribut[$count]=$row['id_atribut'];
    $bencost[$row['id_atribut']]=$row['bencost'];
    $bobot[$row['id_atribut']]=$row['bobot'];
    $count=$count+1;
    $jml_atribut=$jml_atribut+1 ;
    }
?>

<?php
//-- query untuk mendapatkan semua data atribut di tabel tb_atribut
$sql = 'SELECT * FROM tb_parameter ORDER BY id_atribut,id_parameter';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$parameter=array();
$id_atribut=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_atribut!=$row['id_atribut']){
        $parameter[$row['id_atribut']]=array();
        $id_atribut=$row['id_atribut'];
    }
    $parameter[$row['id_atribut']][$row['nilai']]=$row['parameter'];
}

?>

<?php

//-- query untuk mendapatkan semua data training di tabel tb_responden dan tb_data
$sql = 'SELECT * FROM tb_data_test a JOIN tb_responden_test b USING(id_responden) ORDER BY b.id_responden';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$data=array();
$responden=array();
$noresponden=array();
$id_responden=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_responden!=$row['id_responden']){
        $responden[$row['id_responden']]=$row['responden'];
        $data[$row['id_responden']]=array();
        $id_responden=$row['id_responden'];
        $noresponden[$count1]=$row['id_responden'];
        $count1=$count1+1;
    }
    $data[$row['id_responden']][$row['id_atribut']]=$row['id_parameter'];
}



   $tampung =array();
   $tampung=$data;
    $lilsave=array();
    $save=array();
    for($i=2;$i<=$jml_atribut;$i++){
    	for($j=1;$j<=count($tampung);$j++){
    	$lilsave[$j][$i]=$tampung[$noresponden[$j]][$noatribut[$i]];
    }
	}
	for($j=1;$j<=count($tampung);$j++){
		for($i=2;$i<=$jml_atribut;$i++){
			$x=$i-1;
    	$save[$x][$j]=$lilsave[$j][$i];
    }
    }	
	$lastsave=array();
    for($j=1;$j<=count($tampung);$j++){
    for($i=2;$i<=$jml_atribut;$i++){
    	if($bencost[$noatribut[$i]]=="benefit"){
    		$x=$i-1;
    		$lastsave[$j][$i]=$lilsave[$j][$i]/max($save[$x]);
    	}else{
    		$x=$i-1;
    		$lastsave[$j][$i]=$lilsave[$j][$i]/max($save[$x]);
    	}
    }
    }  

    
    for($j=1;$j<=count($tampung);$j++){
    	for($i=2;$i<=$jml_atribut;$i++){
    		$lastsave[$j][$i]=$lastsave[$j][$i]*$bobot[$noatribut[$i]];
    	}
    }
	for($j=1;$j<=count($tampung);$j++){


		$saveagain[$j]=
	["id" => $noresponden[$j],
	"hasil"=> number_format(array_sum($lastsave[$j]), 2) ];
	}
	
  function disortseklur($nilai_a, $nilai_b) {
	if ($nilai_a["hasil"]==$nilai_b["hasil"]) return 0;
  	return ($nilai_a["hasil"]>$nilai_b["hasil"])?-1:1;
	}

	usort($saveagain, "disortseklur");
?>
    <!--header start-->
 </head>

<body>
	<section class="main-section paddind" id="Portfolio">
		<!--main-section-start-->
		<div class="container" style="margin-top: -50px;">
			<div class="c-logo-part" style=" width:1179px; background-image: url('img/pw_maze_black.png');">
		<!--c-logo-part-start-->
		<div class="container" align="right">
        <h2 style="color: white;">Print Preview</h2>     
        <a align="right" style="float: right;margin-top: -50px;margin-right: 70px; " class="btn btn-success" href="saw.php">Kembali</a> 
        	<a align="right" style="float: right;margin-top: -50px;" class="btn btn-danger" onclick="printContent('div1')">Print</a>
    	</div>
    </div>
    <div id="div1">
        <div align="center" style="margin-top: 13px;">
                                    <h3 align="left" ><img style="width: 70px; margin-left: 1%; float:left;position: absolute;" src="img/small-logo.png" alt="logo">
                                    </h3>
                                    <b style="margin-top: 40px;">PEMERINTAH KABUPATEN BOYOLALI<BR>KECAMATAN WONOSEGORO</b><BR>DESA GUWO
                                    <BR><b style="font-size: 15px;">Jl. Raya Guwo - Juwangi Km 02 Klampok, Guwo, Wonosegoro, Boyolali Kode Pos 57382</b></BR></div>
                                    <b><hr style=" display: block;
    height: 1px;
    background: black;
    width: 100%;
    border: none;
    margin-top: 40px;
    border-top: solid 1px #aaa;"></b>
                                    <p align="left"> REKOMENDASI PENERIMA BANTUAN RTLH MENGGUNAKAN NAIVE BAYES</p>

    	<div class="table-responsive" style="width: 1179px;">

	<table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                  <tr>
				<th>Rank</th>
				<th>Responden</th>
        		<?php 
                        //-- menampilkan header table
                        for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$i]}</th>";
                        }
                        ?>
				<th>Nilai</th>
			</tr>
                </thead>
                   <tbody>
                        <?php for($i=0;$i<count($tampung);$i++){
    						$a=$i+1;

    						if($data[$saveagain[$i]['id']][1]==1){
								?>
								<tr>
									<td><?php echo $a; ?></td>
										<td><?php echo $responden[$saveagain[$i]['id']]; ?></td>
        
										<?php
        						for($j=2;$j<=$jml_atribut;$j++){ 
        						  ?>
        						<td>  <?php echo $parameter[$j][$data[$saveagain[$i]['id']][$j]]; ?></td> 
        						<?php
        						}
        						?>
        						<td><?php echo $saveagain[$i]['hasil']; ?></td>
        
								</tr>	
							<?php }
						}
						?>

                </tbody>
              </table>
 </div>
</div>
    	</div>
		</div>
	</section>
</body>
</html>