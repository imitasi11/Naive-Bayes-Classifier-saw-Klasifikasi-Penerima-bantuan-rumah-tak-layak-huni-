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

	<!-- =======================================================
    Theme Name: Knight
    Theme URL: https://bootstrapmade.com/knight-free-bootstrap-theme/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
	======================================================= -->
<?php 
$nomer=1;
$jml_atribut=0;
$isi=array();
include "koneksi.php";

$count=1;

$sql = 'SELECT * FROM tb_atribut ORDER BY id_atribut' ;
$result = $db->query($sql);
//-- menyiapkan variable penampung berupa array
$atribut=array();
$noatribut=array();
//-- melakukan iterasi pengisian array untuk tiap record data yang didapat
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $noatribut[$count]=$row['id_atribut'];
    $jml_atribut=$jml_atribut+1 ;
    $count=$count+1;
    }
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
//-- query untuk mendapatkan semua data training di tabel nbc_responden dan nbc_data
$sql = 'SELECT * FROM tb_data a JOIN tb_responden b USING(id_responden) ORDER BY b.id_responden';
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

?>
<style type="text/css">
	.change{
		text-transform: capitalize;
	}
</style>
</head>

<body>
	<nav class="main-nav-outer" id="test">
		<!--main-nav-start-->
	<a style="float: right;margin-right: 5%;margin-top: 13px;" class="btn btn-danger" href="login.php">Logout</a>
		
		<div class="container">

			<ul class="main-nav">

				<li><a href="#">Training</a></li>
				<li class="small-logo"><a href="#header"><img style="width: 70px;" src="img/small-logo.png" alt=""></a></li>
				<li><a href="testing.php">Testing</a></li>
			</ul>
			<a class="res-nav_click" style="margin-right: 0px;" href="#"><i class="fa fa-bars"></i></a>
		</div>
	</nav>
<section class="main-section paddind" id="Portfolio">
		<!--main-section-start-->
		<div class="container" style="margin-top: -50px;">
			<h2>Data Training</h2>
			<h6>List Table Data Training</h6>
	
	<?php 
	if(isset($_GET['berhasil'])){
		echo "<p>".$_GET['berhasil']." Data berhasil di tambahkan.</p>";
	}
	?>
 
	<div class="c-logo-part" style=" width:1179px; background-image: url('img/pw_maze_black.png');">
		<!--c-logo-part-start-->
		<div class="container">      
        <form action="training.php" method="get"style="display: inline-block;">
        	<table>
        		<tr>
        			<td>
        	<input  class="form-control" type="text" placeholder="Search. . ." name="cari">
        	</td><td><button  style="margin-left: 10px;"class="btn btn-success">Refresh</button>
        	</td><td><a  style="margin-left: 10px;"class="btn btn-primary" href="tambah.php">Tambah</a>
        	</td>
        	</table>
        </form>
    </div>
    </div>
    <?php 
if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
}else{
	$cari = "";
}
?>
    <div class="table-responsive" style="width: 1179px;">

	<div style="height: 370px;overflow-y: scroll;">
	<table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Responden</th>
                    <?php 
                        //-- menampilkan header table
                        for($i=2;$i<=$jml_atribut;$i++){ 
                            echo "<th style='text-align:center'>{$atribut[$noatribut[$i]]}</th>";
                        }
                        ?>
                        <th style="text-align:center"><?php echo $atribut[$noatribut[1]];?></th>
                        <th colspan="2" align="center" style="text-align:center">Aksi</th>
                  </tr>
                </thead>
                   <tbody>
                        <?php
                        
                        //-- menampilkan data secara literal
                        foreach($data as $id_responden=>$dt_atribut){
                        if(isset($cari)){
						if($cari=="")
						{
							echo "<tr><td>{$responden[$id_responden]}</td>";
                            for($i=2;$i<=$jml_atribut;$i++){ 
                                echo "<td>{$parameter[$noatribut[$i]][$dt_atribut[$noatribut[$i]]]}</td>";
                            }
                            
                            echo "<td>{$parameter[1][$dt_atribut[1]]}</td>";
                        ?>  <td><a class="btn btn-primary" href="edit.php?id=<?php echo $id_responden; ?>">edit</a></td>
                            <td><a class="btn btn-danger" href="training/hapus.php?id=<?php echo $id_responden; ?>">delete</a></td></tr><?php
						}else{
							$word = ucfirst($cari);
							$wrd = lcfirst($cari);
						
						
						if($responden[$id_responden]==$cari||$responden[$id_responden]==$word||$responden[$id_responden]==$wrd){
                         
                            echo "<tr><td>{$responden[$id_responden]}</td>";
                            for($i=2;$i<=$jml_atribut;$i++){ 
                                echo "<td>{$parameter[$noatribut[$i]][$dt_atribut[$noatribut[$i]]]}</td>";
                            }
                            
                            echo "<td>{$parameter[1][$dt_atribut[1]]}</td>";
                        ?>  <td><a class="btn btn-primary" href="edit.php?id=<?php echo $id_responden; ?>">edit</a></td>
                            <td><a class="btn btn-danger" href="training/hapus.php?id=<?php echo $id_responden; ?>">delete</a></td></tr> <?php

                            }
                            }
                            }
						}

                        ?>
                  </tr>
                </tbody>
              </table>
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