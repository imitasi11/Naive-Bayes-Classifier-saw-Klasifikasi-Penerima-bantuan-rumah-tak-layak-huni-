
<?php
//-- konfigurasi database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'db';
//-- koneksi ke database server dengan extension mysqli
$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)or die ("could not connect to mysql"); ;
//-- hentikan program dan tampilkan pesan kesalahan jika koneksi gagal
if ($db->connect_error) {
    die('Connect Error ('.$db->connect_errno.')'.$db->connect_error);
}

?>