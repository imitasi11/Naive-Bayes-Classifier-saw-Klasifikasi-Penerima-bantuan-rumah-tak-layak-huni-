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

	<!-- =======================================================
    Theme Name: Knight
    Theme URL: https://bootstrapmade.com/knight-free-bootstrap-theme/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
	======================================================= -->

	<?php
	session_start();

if(!empty($_SESSION['lat'])) {
    
}else{
            header("location:index.php");

}
$kecamatan="";
 $kecamatan=$_SESSION['alamat'];
		function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {  
    	$earth_radius = 6371;  
      
    	$dLat = deg2rad($latitude2 - $latitude1);  
    	$dLon = deg2rad($longitude2 - $longitude1);  
    	  
    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
    $c = 2 * asin(sqrt($a));  
    $d = $earth_radius * $c;  
      
   		 return $d;  
		}  

	$lokasi1Lat = $_SESSION['lat']; //garis bujur lokasi 1
	$lokasi1Lon = $_SESSION['long']; //garis lintang lokasi 1

	include "koneksi.php";

    $query_mysql =  mysqli_query($connect,"SELECT * FROM tb_tempat")or die(mysql_error());
	$xsd = 0;
    $xsmp = 0;
    $xsma = 0;

    while($data = mysqli_fetch_array($query_mysql)){
    
    $lokasi2Lat = $data['lat']; //garis bujur lokasi 2
	$lokasi2Lon = $data['lng']; //garis lintang lokasi 2
	$hasil = getDistance($lokasi1Lat,$lokasi1Lon, $lokasi2Lat, $lokasi2Lon);
	$tingkat = $data['tingkat'];

//save ke array
	
	if($tingkat == "sd"){
	$banksd[$xsd]=
	["id" => $data['id_tempat'],
	"nama"=> $data['nama_tempat'],
	"gambar"=> $data['gambar'],
	"tingkat"=> $data['tingkat'],
	"alamat"=> $data['lokasi'],
	"lat"=> $data['lat'],
	"long"=> $data['lng'],
	"hasil"=> $hasil];
	$xsd = $xsd+1;
	}
	else if($tingkat == "smp"){
	$banksmp[$xsmp]=
	["id" => $data['id_tempat'],
	"nama"=> $data['nama_tempat'],
	"gambar"=> $data['gambar'],
	"tingkat"=> $data['tingkat'],
	"alamat"=> $data['lokasi'],
	"lat"=> $data['lat'],
	"long"=> $data['lng'],
	"hasil"=> $hasil];
	$xsmp = $xsmp+1;
	}
	else{
	$banksma[$xsma]=
	["id" => $data['id_tempat'],
	"nama"=> $data['nama_tempat'],
	"tingkat"=> $data['tingkat'],
	"alamat"=> $data['lokasi'],
	"lat"=> $data['lat'],
	"gambar"=> $data['gambar'],
	"long"=> $data['lng'],
	"hasil"=> $hasil];
	$xsma = $xsma+1;
	};
    }

   
    $sql="SELECT * FROM tb_tempat";
    $result=mysqli_query($connect,$sql);
	$xxsd = 0;
    $xxsmp = 0;
    $xxsma = 0;

    while($datas = mysqli_fetch_array($result)){
    if($datas['kecamatan']==$_SESSION['alamat']){
    $lokasi2Lat = $datas['lat']; //garis bujur lokasi 2
	$lokasi2Lon = $datas['lng']; //garis lintang lokasi 2
	$hasil = getDistance($lokasi1Lat,$lokasi1Lon, $lokasi2Lat, $lokasi2Lon);
	$tingkat = $datas['tingkat'];

//save ke array
	
	if($tingkat == "sd"){
	$banksd1[$xxsd]=
	["id" => $datas['id_tempat'],
	"nama"=> $datas['nama_tempat'],
	"gambar"=> $datas['gambar'],
	"tingkat"=> $datas['tingkat'],
	"alamat"=> $datas['lokasi'],
	"lat"=> $datas['lat'],
	"long"=> $datas['lng'],
	"hasil"=> $hasil];
	$xxsd = $xxsd+1;
	}
	if($tingkat == "smp"){
	$banksmp1[$xxsmp]=
	["id" => $datas['id_tempat'],
	"nama"=> $datas['nama_tempat'],
	"gambar"=> $datas['gambar'],
	"tingkat"=> $datas['tingkat'],
	"alamat"=> $datas['lokasi'],
	"lat"=> $datas['lat'],
	"long"=> $datas['lng'],
	"hasil"=> $hasil];
	$xxsmp = $xxsmp+1;
	}
	if($tingkat == "sma"){
	$banksma1[$xxsma]=
	["id" => $datas['id_tempat'],
	"nama"=> $datas['nama_tempat'],
	"tingkat"=> $datas['tingkat'],
	"alamat"=> $datas['lokasi'],
	"lat"=> $datas['lat'],
	"gambar"=> $datas['gambar'],
	"long"=> $datas['lng'],
	"hasil"=> $hasil];
	$xxsma = $xxsma+1;
	}
    }}
//array sort
function disortseklur($sekolah_a, $sekolah_b) {
	if ($sekolah_a["hasil"]==$sekolah_b["hasil"]) return 0;
  return ($sekolah_a["hasil"]<$sekolah_b["hasil"])?-1:1;
}
if(!empty($banksd)){
usort($banksd, "disortseklur");
}
if(!empty($banksmp)){
usort($banksmp, "disortseklur");
}
if(!empty($banksma)){
	usort($banksma, "disortseklur");
}
if(!empty($banksd1)){
	usort($banksd1, "disortseklur");
}
if(!empty($banksmp1)){
	usort($banksmp1, "disortseklur");
}
if(!empty($banksma1)){
	usort($banksma1, "disortseklur");
}



//ambil 5
    for($i=0;$i<5;$i++){
    	$sd[$i][0]= $banksd[$i]["id"];
    	$sd[$i][1]= $banksd[$i]["nama"];
    	$sd[$i][2]= $banksd[$i]["tingkat"];
    	$sd[$i][3]= $banksd[$i]["alamat"];
    	$sd[$i][4]= $banksd[$i]["lat"];
    	$sd[$i][5]= $banksd[$i]["long"];
    	$sd[$i][6]= number_format($banksd[$i]["hasil"], 2);
    	$sd[$i][7]= $banksd[$i]["gambar"];

    	$smp[$i][0]= $banksmp[$i]["id"];
    	$smp[$i][1]= $banksmp[$i]["nama"];
    	$smp[$i][2]= $banksmp[$i]["tingkat"];
    	$smp[$i][3]= $banksmp[$i]["alamat"];
    	$smp[$i][4]= $banksmp[$i]["lat"];
    	$smp[$i][5]= $banksmp[$i]["long"];
    	$smp[$i][6]= number_format($banksmp[$i]["hasil"], 2);
    	$smp[$i][7]= $banksmp[$i]["gambar"];

    	$sma[$i][0]= $banksma[$i]["id"];
    	$sma[$i][1]= $banksma[$i]["nama"];
    	$sma[$i][2]= $banksma[$i]["tingkat"];
    	$sma[$i][3]= $banksma[$i]["alamat"];
    	$sma[$i][4]= $banksma[$i]["lat"];
    	$sma[$i][5]= $banksma[$i]["long"];
    	$sma[$i][6]= number_format($banksma[$i]["hasil"], 2);
    	$sma[$i][7]= $banksma[$i]["gambar"];
    
	}
	if(!empty($banksd1)){
	for($i=0;$i<count($banksd1);$i++){
		$sd1[$i][0]= $banksd1[$i]["id"];
    	$sd1[$i][1]= $banksd1[$i]["nama"];
    	$sd1[$i][2]= $banksd1[$i]["tingkat"];
    	$sd1[$i][3]= $banksd1[$i]["alamat"];
    	$sd1[$i][4]= $banksd1[$i]["lat"];
    	$sd1[$i][5]= $banksd1[$i]["long"];
    	$sd1[$i][6]= number_format($banksd1[$i]["hasil"], 2);
    	$sd1[$i][7]= $banksd1[$i]["gambar"];
	}
}
	if(!empty($banksmp1)){
	for($i=0;$i<count($banksmp1);$i++){
		$smp1[$i][0]= $banksmp1[$i]["id"];
    	$smp1[$i][1]= $banksmp1[$i]["nama"];
    	$smp1[$i][2]= $banksmp1[$i]["tingkat"];
    	$smp1[$i][3]= $banksmp1[$i]["alamat"];
    	$smp1[$i][4]= $banksmp1[$i]["lat"];
    	$smp1[$i][5]= $banksmp1[$i]["long"];
    	$smp1[$i][6]= number_format($banksmp1[$i]["hasil"], 2);
    	$smp1[$i][7]= $banksmp1[$i]["gambar"];
	}
}
	if(!empty($banksma1)){
	for($i=0;$i<count($banksma1);$i++){
		$sma1[$i][0]= $banksma1[$i]["id"];
    	$sma1[$i][1]= $banksma1[$i]["nama"];
    	$sma1[$i][2]= $banksma1[$i]["tingkat"];
    	$sma1[$i][3]= $banksma1[$i]["alamat"];
    	$sma1[$i][4]= $banksma1[$i]["lat"];
    	$sma1[$i][5]= $banksma1[$i]["long"];
    	$sma1[$i][6]= number_format($banksma1[$i]["hasil"], 2);
    	$sma1[$i][7]= $banksma1[$i]["gambar"];
	}
}





	//input user location
	//include koneksi
	//panggil database->harversine()-> array
	//array()-> SD,SMP,SMA
	//array-sort
	//if(!zonasi){ tampil array [1]-[5]}
	//else{ kelurahan == kelurahan array -> new array
	//tampil array [1]-[5] }


	//onclick pop-up
	//include koneksi
	//panggil database
	//tampil keterangan
	//cari jalur

	?>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

</head>

<body>
	
	<nav class="main-nav-outer" id="test">
		<!--main-nav-start-->
		<div class="container">
			<ul class="main-nav">
				<li><a href="#">Home</a></li>
				<li class="small-logo"><a href="#header"><img src="img/small-logo.png" alt=""></a></li>
				<li><a href="map.php?jenjang=">Map</a></li>
			</ul>
			<a class="res-nav_click" style="margin-right: 0px;" href="#"><i class="fa fa-bars"></i></a>
		</div>
	</nav>
	<!--main-nav-end-->


	<section class="main-section alabaster" style="min-height: 570px;background: white;">
		<!--main-section alabaster-start-->
		<div class="container" style="margin-top: -35px;">
		<div style="float: right" align="center">	
			<div style="display: inline-block;font-size: 15px;padding-top: 10px;">Kecamatan</div><br><label class="switch" style="display: inline-block;">
  <input name="kecamatan" id="kecamatan" type="checkbox" value="kec">
  <span class="slider round"></span>
</label>
</div><br>
			<h2>Rekomendasi Sekolah Negeri Salatiga</h2>
			<div class="inline-block">
				<ul class="Portfolio-nav wow fadeIn delay-02s">
					<li style="display: inline-block;"><a href="?jenjang=sd" <?php if($_GET['jenjang']=='sd') {echo "class='current'";}?> ><small>SD</small></a></li>
					<li style="display: inline-block;"><a href="?jenjang=smp" <?php if($_GET['jenjang']=='smp') {echo "class='current'";}?> ><small>SMP</small></a></li>
					<li style="display: inline-block;"><a href="?jenjang=sma" <?php if($_GET['jenjang']=='sma') {echo "class='current'";}?>><small>SMA</small></a></li>
					<li style="display: inline-block;"><a href="divide.php"><small>Reset Koordinat</small></a></li>
				</ul>
			</div>
		</div>

		<div class="container">
			<div class="desc" id="biasa" class="row">
				<?php

          $jenjang="";
          if($_GET['jenjang']=='sd'){
          	$jenjang="sd";?><div align="center" class="inline-block" style="">
					
					<h3>SD</h3>
							<p>Sekolah Dasar Negeri di sekitar anda.
								<?php

								?></p>
							<?php
							foreach($sd as $value){?>
								<div style="display:inline-block;margin-right: 20px;margin-top : 20px;">

									<p><a href="profil.php?id=<?php echo $value[0]; ?>"><img style="width: 150px;margin-right: 5px;" src="upload/<?php echo $value[1]; ?>.<?php echo $value[7];?>"></a>
								<h4><a href="#"><small><?php echo $value[1];?></small></a></h4>
								<?php echo $value[6];?> Km</p>
								</div>
								<?php 
								}
								?>

					
					
				</div><?php

          }elseif($_GET['jenjang']=='smp'){
          	$jenjang="smp";?>
				<div align="center" class="inline-block" style="">
					
					<h3>SMP</h3>
							<p>Sekolah Menengah Pertama Negeri di sekitar anda.</br>
							<?php
							foreach($smp as $value){?>
								<div style="display:inline-block;margin-right: 20px;margin-top : 20px;">

									<p><a href="profil.php?id=<?php echo $value[0]; ?>"><img style="width: 150px;margin-right: 5px;" src="upload/<?php echo $value[1]; ?>.<?php echo $value[7];?>"></a>
								<h4><a href="#"><small><?php echo $value[1];?></small></a></h4>
								<?php echo $value[6];?> Km</p>
								</div>
								<?php 
								}
								?>

					
					
				</div><?php
          }elseif($_GET['jenjang']=='sma'){
          	$jenjang="sma";?><div align="center" class="inline-block" style="">
					
					<h3>SMA</h3>
							<p>Sekolah Menengah Akhir Negeri di sekitar anda.</br><br>
							<?php
							foreach($sma as $value){?>
								<div style="display:inline-block;margin-right: 20px;margin-top : 20px;">

									<p><a href="profil.php?id=<?php echo $value[0]; ?>"><img style="width: 150px;margin-right: 5px;" src="upload/<?php echo $value[1]; ?>.<?php echo $value[7];?>"></a>
								<h4><a href="#"><small><?php echo $value[1];?></small></a></h4>
								<?php echo $value[6];?> Km</p>
								</div>
								<?php 
								}
								?>

					
					
				</div><?php
          }else{
          	?><div align="center" class="inline-block" style="">
					
					<h3>SMA</h3>
							<p>Sekolah Menengah Akhir Negeri di sekitar anda.</br><br>
							<?php
							foreach($sma as $value){?>
								<div style="display:inline-block;margin-right: 20px;margin-top : 20px;">

									<p><a href="profil.php?id=<?php echo $value[0]; ?>"><img style="width: 150px;margin-right: 5px;" src="upload/<?php echo $value[1]; ?>.<?php echo $value[7];?>"></a>
								<h4><a href="#"><small><?php echo $value[1];?></small></a></h4>
								<?php echo $value[6];?> Km</p>
								</div>
								<?php 
								}
								?>

					
					
				</div><?php
          }
          
          ?>
				
				
			</div>





						<div class="desc" id="kec" class="row">
				<?php

          $jenjang="";
          if($_GET['jenjang']=='sd'){
          	if(!empty($sd1)){
          	$jenjang="sd";?><div align="center" class="inline-block" style="">
					
					<h3>SD</h3>
							<p>Sekolah Dasar Negeri di sekitar anda.
								<?php

								?></p>
							<?php
							foreach($sd1 as $value){?>
								<div style="display:inline-block;margin-right: 20px;margin-top : 20px;">

									<p><a href="profil.php?id=<?php echo $value[0]; ?>"><img style="width: 150px;margin-right: 5px;" src="upload/<?php echo $value[1]; ?>.<?php echo $value[7];?>"></a>
								<h4><a href="#"><small><?php echo $value[1];?></small></a></h4>
								<?php echo $value[6];?> Km</p>
								</div>
								<?php 
								}}
								?>

					
					
				</div><?php

          }elseif($_GET['jenjang']=='smp'){
          	if(!empty($smp1)){
          	$jenjang="smp";?>
				<div align="center" class="inline-block" style="">
					
					<h3>SMP</h3>
							<p>Sekolah Menengah Pertama Negeri di sekitar anda.</br>
							<?php
							foreach($smp1 as $value){?>
								<div style="display:inline-block;margin-right: 20px;margin-top : 20px;">

									<p><a href="profil.php?id=<?php echo $value[0]; ?>"><img style="width: 150px;margin-right: 5px;" src="upload/<?php echo $value[1]; ?>.<?php echo $value[7];?>"></a>
								<h4><a href="#"><small><?php echo $value[1];?></small></a></h4>
								<?php echo $value[6];?> Km</p>
								</div>
								<?php 
								}}
								?>

					
					
				</div><?php
          }elseif($_GET['jenjang']=='sma'){
          	if(!empty($sma1)){
          	$jenjang="sma";?><div align="center" class="inline-block" style="">
					
					<h3>SMA</h3>
							<p>Sekolah Menengah Akhir Negeri di sekitar anda.</br><br>
							<?php
							foreach($sma1 as $value){?>
								<div style="display:inline-block;margin-right: 20px;margin-top : 20px;">

									<p><a href="profil.php?id=<?php echo $value[0]; ?>"><img style="width: 150px;margin-right: 5px;" src="upload/<?php echo $value[1]; ?>.<?php echo $value[7];?>"></a>
								<h4><a href="#"><small><?php echo $value[1];?></small></a></h4>
								<?php echo $value[6];?> Km</p>
								</div>
								<?php 
								}}
								?>

					
					
				</div><?php
          }else{if(!empty($sma1)){
          	?><div align="center" class="inline-block" style="">
					
					<h3>SMA</h3>
							<p>Sekolah Menengah Akhir Negeri di sekitar anda.</br><br>
							<?php
							foreach($sma1 as $value){?>
								<div style="display:inline-block;margin-right: 20px;margin-top : 20px;">

									<p><a href="profil.php?id=<?php echo $value[0]; ?>"><img style="width: 150px;margin-right: 5px;" src="upload/<?php echo $value[1]; ?>.<?php echo $value[7];?>"></a>
								<h4><a href="#"><small><?php echo $value[1];?></small></a></h4>
								<?php echo $value[6];?> Km</p>
								</div>
								<?php 
								}}
								?>

					
					
				</div><?php
          }
          
          ?>
				
				
			</div>





		</div>
	</section>
	<!--main-section alabaster-end-->



	<footer class="footer" style="margin-top: 20px;">
		<div class="col-lg-2 col-md-6 col-sm-6" style="float: right;">
					<ul class="Portfolio-nav wow fadeIn delay-02s">
						<div class="info_item">
							<li><a class="white_bg_btn" href="login.php">Login Admin</a></li>
						</div>
					</div>
				</div>
		<div class="container">
			<div class="container">
			<div class="footer-logo"><a href="#"><img src="img/logo.png" alt=""></a></div>
			<span class="copyright">Copyright &copy; <script>document.write(new Date().getFullYear());</script> Created by <a href="https://1cak.com" target="_blank">Fazjar Aji</a></span>
			
		</div>
			<div class="credits">
				<!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Knight
        -->
				Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
			</div>
		</div>
	</footer>


	<script type="text/javascript">
		$(document).ready(function() {
			var batas=3;
			var satu=1;
			var checked= 0;
			if(checked==0){
				$("div.desc").hide();
    			$("#biasa").show();
			}
    
    $("input[name$='kecamatan']").click(function() {
        var test = $(this).val();

        if ($("#" + test).is(':hidden')) {
        	$("div.desc").hide();
      $("#" + test).show();
    } else {
      $("#" + test).hide();
      $("#biasa").show();
    }



    });
});
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
