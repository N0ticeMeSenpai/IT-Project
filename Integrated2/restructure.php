<?php
    $con = mysqli_connect('127.0.0.1','root','');
    
    if(!$con){
        echo 'Not Connected To Server';
    }
    
    if(!mysqli_select_db($con,'sigma')){
        echo 'Not Selected';
    }
   

    $loan_idforR = mysqli_real_escape_string($con,$_POST['loan_idforR']);
    $search = mysqli_real_escape_string($con,$_POST['search']);

    $remaining = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as remaining_balance FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$loan_idforR'";
    $row = mysqli_fetch_assoc(mysqli_query($con,$remaining));

?>


<html>
	<head>
		<title>Restructuring</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			<br />
			<h2 align="center">RESTRUCTURING OF CLIENT</h2><br />
			<div class="form-group">
				<form name="add_due" id="add_due">
                    <input type=hidden name="loan_id" value='<?php echo $loan_idforR; ?>'>
					<div class="table-responsive">
						<table class="table table-bordered" id="dynamic_field">
                            <tr>
				    <td><input type="text" name="amount" class="form-control name_list" value='<?php echo $row['remaining_balance']; ?>'/></td>
                                <td>Remaining Balance</td>
							</tr>
                            <tr>
				                <td><input type="text" name="insurance" class="form-control name_list"/></td>
                                <td>Insurance</td>
							</tr>
							<tr>
								<td><input type="date" name="due[]" placeholder="Enter Due Date" class="form-control name_list" required/></td>
								<td><button type="button" name="date" id="add" class="btn btn-success">Add Due date</button></td>
							</tr>
						</table>
						<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
					</div>
				</form>
			</div>
		</div>

<form name='forSearch' action='search.php' method='POST'>
<input type=hidden name='search' value="<?php echo $search; ?>">  
</form>
</body>    



<script>
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="date" name="due[]" placeholder="Enter Due Date" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove" required>X</button></td></tr>');
	});
	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
	$('#submit').click(function(){		
		$.ajax({
			url:"interest.php",
			method:"POST",
			data:$('#add_due').serialize(),
			success:function(data)
			{
				alert(data);
				$('#add_due')[0].reset();
                document.forSearch.submit();
			}
		});
	});
});
    
</script>




