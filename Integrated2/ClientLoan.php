<?php
    $con = mysqli_connect('127.0.0.1','root','');
    
    if(!$con){
        echo 'Not Connected To Server';
    }
    
    if(!mysqli_select_db($con,'sigma')){
        echo 'Not Selected';
    }

    $id = mysqli_real_escape_string($con,$_GET['client_id']);
    $sqlForRates = "SELECT * from rates";
    $rowRates = mysqli_fetch_assoc(mysqli_query($con,$sqlForRates));


?>


<html>
	<head>
		<title>Add Loan</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			<br />
			<h2 align="center">Add Loan</h2><br />
			<div class="form-group">
				<form name="add_due" id="add_due">
                    <input type=hidden name="client_id" value='<?php echo $id?>'>
					<div class="table-responsive">
						<table class="table table-bordered" id="dynamic_field">
                            <tr>
				                <td><input type="text" name="amount" class="form-control name_list"/></td>
                                <td>Loan Balance</td>
							</tr>
                            <tr>
				                <td><input type="text" name="insurance" class="form-control name_list" value="0"/></td>
                                <td>Insurance</td>
							</tr>
				            <tr>
				                <td><input type="text" name="interest" class="form-control name_list" value='<?php echo $rowRates['interest']?>'/></td>
                                <td>Interest(%)</td>
							</tr>
                            <tr>
				                <td><input type="text" name="shf" class="form-control name_list" value='<?php echo $rowRates['service_handling_fee']?>'/></td>
                                <td>Service Handling Fee(%)</td>
							</tr>
                            <tr>
                                <td> 
                                <select class="i-2 form-control" name="loan_class">
                                    <option value="Add">Add-On</option>
                                    <option value="Deducted">Deducted</option>
                                </select>
                                </td>
                                <td>Loan Choice</td>
                            </tr>
                            <tr>
                                <td> 
                                <select class="i-2 form-control" name="loan_type">
                                    <option value="Salary">Salary</option>
                                    <option value="Business">Business</option>
                                </select>
                                </td>
                                <td>Loan Type</td>
                            </tr>
							<tr>
								<td><input type="date" name="due[]" placeholder="Enter Due Date" class="form-control name_list" required/></td>
								<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
							</tr>
                            
						</table>
						<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
					</div>
				</form>
			</div>
		</div> 
<form name='forSearch' action='SORActiveAccount.php' method='POST'>
</form>


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
			url:"ClientLoanAction.php",
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







































