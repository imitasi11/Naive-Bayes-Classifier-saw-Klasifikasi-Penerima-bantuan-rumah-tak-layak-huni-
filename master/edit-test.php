<!doctype html>
<html>

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

	<!-- =======================================================
    Theme Name: Knight
    Theme URL: https://bootstrapmade.com/knight-free-bootstrap-theme/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
	======================================================= -->

</head>
 <?php
$layak = 0;
$tidaklayak = 0;
$nomor = 1;
$probtidaklayak= 0;
$problayak= 0;
$jml_atribut= 0;
$sum = 0;
$tambah= 0;

$isi=array();
include "koneksi.php";
$count=1;


$sql = 'SELECT * FROM tb_atribut';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $jml_atribut=$jml_atribut+1 ;
    $noatribut[$count]=$row['id_atribut'];
    $count=$count+1;
    }
?>

<?php
//-- query untuk mendapatkan semua data atribut di tabel nbc_atribut
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
<body>
	
	<!--main-nav-end-->
<section class="main-section paddind" id="Portfolio">
		<!--main-section-start-->
		<div class="container" style="margin-top: -50px;">
			<h2>Edit data testing</h2>
			<h6>Form Edit Data Testing</h6>
	
	<?php 
	if(isset($_GET['berhasil'])){
		echo "<p>".$_GET['berhasil']." Data berhasil di tambahkan.</p>";
	}
	?>
 
	<div>
		<!--c-logo-part-start-->
		<div class="container" style="margin-top: -50px;">      
         <section id="main-content">
      <section class="wrapper">
         <div class="row" style="margin-left: 130px;">
          <div class="col-lg-6"style="padding: 0px;width: 850px;">
            <section class="panel" >
              
              <div class="panel-body">
                     <form action="testing/update.php" method="post" enctype="multipart/form-data">   
                     	<?php 

  $ids = $_GET['id'];
  $query_mysql = "SELECT * FROM tb_responden_test WHERE id_responden='$ids'";
  $result = $db->query($query_mysql);

  foreach($result as $id){
?>
                  <div class="form-group">
                    <label>Nama Responden</label>
                    <input type="hidden" name="id" value="<?php echo $id['id_responden'] ?>">
                    <input type="text" class="form-control" name="nama" id="exampleInputEmail1" value="<?php echo $id['responden'] ?>" placeholder="Nama Responden">
                  </div>
            
      <div style="display: inline-block;" align="center">
      	<?php
      $querydata_mysql = "SELECT * FROM tb_data_test WHERE id_responden='$ids' order by id_atribut";
      $rslt = $db->query($querydata_mysql);
       foreach($rslt as $data){
          ?>
     <?php
              if($atribut[$data['id_atribut']]=="Ketentuan"){

              }else{

              ?>
      <div style="display:inline;width: 220px; float: left;margin-right: 52px;margin-top:  23px;">
      <?php echo $atribut[$data['id_atribut']];
              $ini=$data['id_atribut'];
        ?>
            <?php echo '<select class="form-control input-sm m-bot15" name="'.$ini.'">' ?>
              <option value="<?php echo $data['id_parameter'] ?>"selected><?php echo $parameter[$data['id_atribut']][$data['id_parameter']] ?></option>
             
              <?php
              for($w=1;$w<=count($parameter[$ini]);$w++){?>
                        <option value="<?php echo $w;?>"><?php echo $parameter[$ini][$w]?></option>
                    <?php }?>?>
            </select>
       
      </div>
           

      <?php
      }
      ?>
      <?php
      }
      ?>
      </div>
                 <div class="form-group" style="margin-top: 40px;"  align="center">
                  <a href="testing.php" class="btn btn-danger">Back</a>
                  <input type="submit" name="upload" value="Upload" class="btn btn-primary">
              </div>
              <?php	}
  ?>
              		</form>
              </div>
            </section>
          </div>
			
          
        </div>
        <!-- page end-->
      </section>
    </section>
    </div>
    </div>
   
 </div>
	</section>
	<!--main-section-end-->
	<!--main-section alabaster-end-->
</body>

</html>