<?php
include 'Include/connection.php';

if(isset($_POST['id'])){
	
	$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
	$id = $_POST['id'];

	//  query to update data 
	 
	$result  = mysqli_query($conn, "UPDATE loan SET loan_remarks='$remarks' WHERE loan_id='$id'");

	if($result){
		echo 'data updated';
	}

}
?>