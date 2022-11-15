<?php 

include "../koneksi.php";
$jalan=0;
$number=0;
$satu=1;
$count=1;

$layak = 0;
$tidaklayak = 0;

$probtidaklayak= 0;
$problayak= 0;
$jml_atribut= 0;
$sum = 0;
$tambah= 0;

$well="";
$isi=array();
$sql = 'SELECT * FROM tb_atribut order by id_atribut';
$result = $db->query($sql);
$noatribut=array();
$atribut=array();
foreach ($result as $row) {
    $atribut[$row['id_atribut']]=$row['atribut'];
    $noatribut[$count]=$row['id_atribut'];
    $jml_atribut=$jml_atribut+1 ;
    $count=$count+1;
    }
$sql = 'SELECT * FROM tb_parameter ORDER BY id_atribut,id_parameter';
$result = $db->query($sql);
$parameter=array();
$id_atribut=0;
foreach ($result as $row) {
    if($id_atribut!=$row['id_atribut']){
        $parameter[$row['id_atribut']]=array();
        $id_atribut=$row['id_atribut'];
    }
    $parameter[$row['id_atribut']][$row['nilai']]=$row['parameter'];
}
$sql = 'SELECT * FROM tb_data a JOIN tb_responden b USING(id_responden) ORDER BY b.id_responden';
$result = $db->query($sql);
$data=array();
$responden=array();
$id_responden=0;
foreach ($result as $row) {
    if($id_responden!=$row['id_responden']){
        $responden[$row['id_responden']]=$row['responden'];
        $data[$row['id_responden']]=array();
        $id_responden=$row['id_responden'];
    }
    $data[$row['id_responden']][$row['id_atribut']]=$row['id_parameter'];
}
foreach($data as $id_responden=>$dt_atribut){
   

    if($dt_atribut[1]=='1'){
        $layak=$layak+1;
    }else{
        $tidaklayak=$tidaklayak+1;
    }
      $sum = $sum+1;

}
//class probabilities
$problayak=$layak/$sum;
$probtidaklayak=$tidaklayak/$sum;
//condition probabilities
foreach ($data as $value){
    for($i=2;$i<=$jml_atribut;$i++){
        //filter layak atau tidak
        $j=$i-1;
        if($value[1]==1){
            if($value[$i]==1){
                if(!isset($isi[2][$j][1])){
                    $isi[2][$j][1]=1;
                }else{
                    $isi[2][$j][1]++;
                }
            }
            if($value[$i]==2){
                if(!isset($isi[2][$j][2])){
                    $isi[2][$j][2]=1;
                }else{
                    $isi[2][$j][2]++;
                }
            }
            if($value[$i]==3){
               if(!isset($isi[2][$j][3])){
                    $isi[2][$j][3]=1;
                }else{
                    $isi[2][$j][3]++;
                }
            }
            if($value[$i]==4){
              if(!isset($isi[2][$j][4])){
                    $isi[2][$j][4]=1;
                }else{
                    $isi[2][$j][4]++;
                }
            }
        }else if($value[1]==0){
            if($value[$i]==1){
              if(!isset($isi[1][$j][1])){
                    $isi[1][$j][1]=1;
                }else{
                    $isi[1][$j][1]++;
                }
            }
            if($value[$i]==2){
               if(!isset($isi[1][$j][2])){
                    $isi[1][$j][2]=1;
                }else{
                    $isi[1][$j][2]++;
                }
            }
            if($value[$i]==3){
               if(!isset($isi[1][$j][3])){
                    $isi[1][$j][3]=1;
                }else{
                    $isi[1][$j][3]++;
                }
            }
            if($value[$i]==4){
               if(!isset($isi[1][$j][4])){
                    $isi[1][$j][4]=1;
                }else{
                    $isi[1][$j][4]++;
                }
            }
        }
    
    }
}



for($x=1;$x<=2;$x++){
    for($y=2;$y<=$jml_atribut;$y++){
        for($z=1;$z<=4;$z++){
            $y1=$y-1;
            if($x==1){
                $lort=$tidaklayak;
            }else{
                $lort=$layak;
            }
            if(!isset($isi[$x][$y1][$z])){

                $isi[$x][$y1][$z]=0;

            }else{
                $isi[$x][$y1][$z]=$isi[$x][$y1][$z]/$lort;
            }
            
        }
    }
}
///////////////////////////////////////////


$tampung=array();

$id = $_POST['id'];
$nama = $_POST['nama'];

$training=array();
$training[0] = $nama;
for($i=2;$i<=$jml_atribut;$i++){
	$number=$i-$satu;
	$tampung[$i] = $_POST[$noatribut[$i]];
	$training[$number] = $_POST[$noatribut[$i]];
}

//////////////////////
////////////////////
for($i=1;$i<count($training);$i++){
    $training1[$i]=$isi[1][$i][$training[$i]];
    $training2[$i]=$isi[2][$i][$training[$i]];
}
//perkalian isi array, bandingkan, tulis hasil
$jumlaht1=$probtidaklayak;
$jumlaht2=$problayak;
$hasilt=0;

for($a=1; $a<=count($training1); $a++){
$lort=$tidaklayak;
if($training1[$a]==0){
    for($g=1;$g<=count($training1);$g++){
        if($training1[$g]!=0){
                $training1[$g]=(($training1[$g]*$lort)+1)/($lort+count($training1));
        }else{
            $training1[$a]=1/($lort+count($training1));
        }
                    
    }
  $training1[$a]=1/($lort+count($training1));
}
}

for($a=1; $a<=count($training2); $a++){
$lort=$layak;
if($training2[$a]==0){
    for($g=1;$g<=count($training2);$g++){
        if($training2[$g]!=0){
                $training2[$g]=(($training2[$g]*$lort)+1)/($lort+count($training2));
        }else{
            $training2[$a]=1/($lort+count($training2));
        }
                    
    }
  $training2[$a]=1/($lort+count($training2));
}
}

$hitungpercent2=($jumlaht2/($jumlaht2+$jumlaht1))*100;
$hitungpercent2=number_format($hitungpercent2, 2);
$hitungpercent1=($jumlaht1/($jumlaht2+$jumlaht1))*100;
$hitungpercent1=number_format($hitungpercent1, 2);
$jumlahpersen=$hitungpercent2+$hitungpercent1;


for($a=1; $a<=count($training1); $a++){
$jumlaht1=$jumlaht1*$training1[$a];
}
for($a=1; $a<=count($training2); $a++){
$jumlaht2=$jumlaht2*$training2[$a];
}
$kurang=0;
$kurang=$jumlaht2-$jumlaht1;
if($kurang>=0){
    $hasilt=1;
    $tampung[1]=$hasilt;
}else{
    $hasilt=0;
    $tampung[1]=$hasilt;
}

/////////////////////



for($i=1;$i<=$jml_atribut;$i++){
    $query_mysql = "UPDATE tb_data_test SET id_parameter ='$tampung[$i]' WHERE id_responden='$id' AND id_atribut='$noatribut[$i]'";
    $result = $db->query($query_mysql);
    if($result){

    }
    
}
$querys_mysql = "UPDATE tb_responden_test SET responden ='$nama' WHERE id_responden='$id'";
$resultname= $db->query($querys_mysql);
if($resultname){
                
}
 header('Location: ../testing.php');


?>