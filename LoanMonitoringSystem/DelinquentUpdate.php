<?php
include 'Include/connection.php';

if(isset($_POST['id'])){
	
	$status = $_POST['status'];
	$id = $_POST['id'];

	//  query to update data 
	 
	$result  = mysqli_query($connection , "UPDATE loan SET delinquent_status='$status' WHERE loan_id='$id'");

	if($result){
		echo 'data updated';
	}

}
?>
