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

<?php

//-- query untuk mendapatkan semua data training di tabel nbc_responden dan nbc_data
$sql = 'SELECT * FROM tb_data_test a JOIN tb_responden_test b USING(id_responden) ORDER BY b.id_responden';
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$data=array();
$responden=array();
$id_responden=0;
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    if($id_responden!=$row['id_responden']){
        $responden[$row['id_responden']]=$row['responden'];
        $data[$row['id_responden']]=array();
        $id_responden=$row['id_responden'];
    }
    $data[$row['id_responden']][$row['id_atribut']]=$row['id_parameter'];
}
//print_r($data);
//-- menampilkan data training dalam bentuk tabel

?>
<body>
	
	<!--main-nav-end-->
<section class="main-section paddind" id="Portfolio">
		<!--main-section-start-->
		<div class="container" style="margin-top: -50px;">
			<h2>Tambah data training</h2>
			<h6>Form Input Data Training</h6>
	
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
                     <form action="training/input-aksi.php" method="post" enctype="multipart/form-data">   
                  <div class="form-group">
                    <label>Nama Responden</label>
                    <input type="text" class="form-control" name="nama" id="exampleInputEmail1" placeholder="Nama Responden">
                  </div>
            
      <div style="display: inline-block;" align="center">
      <?php
      for ($i=1; $i<=$jml_atribut ; $i++) { 
      ?>
      <div style="display:inline;width: 220px; float: left;margin-right: 52px;margin-top:  23px;">
      <?php echo $atribut[$noatribut[$i]];
              $ini=$noatribut[$i];
        ?>
            <?php echo '<select class="form-control input-sm m-bot15" name="'.$ini.'">' ?>

             
              <?php
              if($ini==1){
               for($w=0;$w<count($parameter[$ini]);$w++){?>
                        <option value="<?php echo $w;?>"><?php echo $parameter[$ini][$w]?></option>
                    <?php }	

              }else{
              for($w=1;$w<=count($parameter[$ini]);$w++){?>
                        <option value="<?php echo $w;?>"><?php echo $parameter[$ini][$w]?></option>
                    <?php }}?>
            </select>
       
      </div>
           

      <?php
      }
      ?>
      </div>
                  <div class="form-group" align="center">
                  
                  <input type="submit" style="margin-top: 30px;" name="upload" value="Upload" class="btn btn-primary">
              </div>
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
	<script type="text/javascript">
		$(document).ready(function(e) {

			$('#test').scrollToFixed();
			$('.res-nav_click').click(function() {
				$('.main-nav').slideToggle();
				return false

			});

      $('.Portfolio-box').magnificPopup({
        delegate: 'a',
        type: 'image'
      });

		});
	</script>

	<script>
		wow = new WOW({
			animateClass: 'animated',
			offset: 100
		});
		wow.init();
	</script>


	<script type="text/javascript">
		$(window).load(function() {

			$('.main-nav li a, .servicelink').bind('click', function(event) {
				var $anchor = $(this);

				$('html, body').stop().animate({
					scrollTop: $($anchor.attr('href')).offset().top - 102
				}, 1500, 'easeInOutExpo');
				/*
				if you don't want to use the easing effects:
				$('html, body').stop().animate({
					scrollTop: $($anchor.attr('href')).offset().top
				}, 1000);
				*/
				if ($(window).width() < 768) {
					$('.main-nav').hide();
				}
				event.preventDefault();
			});
		})
	</script>

	<script type="text/javascript">
		$(window).load(function() {


			var $container = $('.portfolioContainer'),
				$body = $('body'),
				colW = 375,
				columns = null;


			$container.isotope({
				// disable window resizing
				resizable: true,
				masonry: {
					columnWidth: colW
				}
			});

			$(window).smartresize(function() {
				// check if columns has changed
				var currentColumns = Math.floor(($body.width() - 30) / colW);
				if (currentColumns !== columns) {
					// set new column count
					columns = currentColumns;
					// apply width to container manually, then trigger relayout
					$container.width(columns * colW)
						.isotope('reLayout');
				}

			}).smartresize(); // trigger resize to set container width
			$('.portfolioFilter a').click(function() {
				$('.portfolioFilter .current').removeClass('current');
				$(this).addClass('current');

				var selector = $(this).attr('data-filter');
				$container.isotope({

					filter: selector,
				});
				return false;
			});

		});
	</script>
</body>

</html>