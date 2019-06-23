<?php
$conn =	mysqli_connect('sigma' , 'root' ,'','sigma');

if(!$conn){
	die('Connect Error: ' . mysqli_connect_error());
}
?>
