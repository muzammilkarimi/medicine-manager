<?php
$username = "root";
$password = "";
$server = 'localhost';
$db = 'med_man';

$con = mysqli_connect($server,$username,$password,$db);
if(!$con){
    die("connection Error");
}

?>