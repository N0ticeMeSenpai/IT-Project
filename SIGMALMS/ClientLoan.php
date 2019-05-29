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
		<link rel="stylesheet" type="text/css" href="css/custom.css">
		<link rel="stylesheet" type="text/css" href="css/notification.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min2.css">
		<link rel="stylesheet" type="text/css" href="css/navigation.css">
		<link rel="stylesheet" type="text/css" href="css/navigation2.css">
		<link rel="stylesheet" type="text/css" href="css/registration.css">
		<link rel="stylesheet" type="text/css" href="css/table.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
		<script src="js/bootstrap.min.js"></script>
		<script src="js/ajax.js"></script>
	</head>
	<body>
		<div class="container2">
			<br />
			<br />
			<div class="form-group">
				<form name="add_due" id="add_due">
                    <input type=hidden name="client_id" value='<?php echo $id?>'>
					<div class="table-responsive">
						<table class="table" id="dynamic_field">
							<tr>
								<td colspan="2"><h2 align="center">Add Loan</h2><br /><td>
							</tr>
                            <tr>
				                <td colspan="2">
				                	<label>Loan Balance</label>
				                	<input type="text" name="amount" class="i-3 name_list"/>
				                </td>
							</tr>
                            <tr>
				                <td colspan="2">
				                	<label>Insurance</label>
				                	<input type="text" name="insurance" class="i-3 name_list" value="0"/>
				                </td>
							</tr>
				            <tr>
				                <td colspan="2">
				                	<label>Interest(%)</label>
				                	<input type="text" name="interest" class="i-3 name_list" value='<?php echo $rowRates['interest']?>'/></td>
							</tr>
                            <tr>
				                <td colspan="2">
				                <label>Service Handling Fee(%)</label>
				                <input type="text" name="shf" class="i-3 name_list" value='<?php echo $rowRates['service_handling_fee']?>'/></td>
							</tr>
                            <tr>
                                <td colspan="2">
                                <label>Loan Choice</label>
                                <select class="i-3" name="loan_class">
                                    <option value="Add">Add-On</option>
                                    <option value="Deducted">Deducted</option>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                	<label>Loan Type</label>
                                <select class="i-3" name="loan_type">
                                    <option value="Salary">Salary</option>
                                    <option value="Business">Business</option>
                                </select>
                                </td>
                            </tr>
							<tr>
								<td><input type="date" name="due[]" placeholder="Enter Due Date" class="i-3 name_list" required/></td>
								<td><button type="button" name="add" id="add" class="btn mybtn2" style="background-color:#000000; color:white;">Add More</button></td>
							</tr>
                            
						</table>
						<table class="table" id="dynamic_field">
							<tr>
								<td colspan="2"><h2 align="center">CO BORROWER 1</h2><br /><td>
							</tr>
							<tr>
				                <td colspan="2">
								<h3 class="text-center">CO BORROWER PERSONAL 1 INFORMATION</h3>
							    	<div class="row">
							    		<div class="col-sm-4">
							    			<input type="text" placeholder="Firstname" class="i-3" name="co_first_name_one" id="co_first_name_one" pattern="{1,}" required>
							    		</div>
							    		<div class="col-sm-4">
							    			<input type="text" placeholder="Middlename" class="i-3" name="co_middle_name_one" id="co_middle_name_one" pattern="{1,}" required>
							    		</div>
							    		<div class="col-sm-4">
							    			<input type="text" placeholder="Lastname" class="i-3" name="co_last_name_one" id="co_last_name_one" pattern="{1,}" required>
							    		</div>	
							    	</div>
									
							    	<div class="row">
				                       <div class="col-sm-5">
			                                <input type="text" placeholder="Address" class="i-3" name="co_address_one" id="co_address_one" pattern="{1,}" required>
			                           </div>
									   <div class="col-sm-4">
											<input type="text" placeholder="Relation" class="i-3" name="related_client_one" id="related_client_one" pattern="{1,}" required>
									   </div>
										<div class="col-sm-3">
										    <input placeholder="Contact number" type="text" class="i-3" name="co_contact_no_one" id="co_contact_no" required>
										</div>
							    	</div>
				                </td>
							</tr>
							<tr>
								<td>
									<h3 class="text-center"><i class="fa fa-angle-right"></i> CO BORROWER 1 WORK INFORMATION </h3>
									<div class="row">
							    		<div class="col-lg-6">
							    			<input type="text" placeholder="Business address" class="i-3" name="co_business_address_one" id="co_business_address_one" pattern="{1,}" required>
							    		</div>
							    		<div class="col-lg-6">
							    			<input type="text" placeholder="Firm name" class="i-3" name="co_name_of_firm_one" id="co_name_of_firm_one" pattern="{1,}" required>
							    		</div>	
							    	</div>
									
							    	<div class="row">
					                    <div class="col-lg-6">
							    			<input type="text" placeholder="Position" class="i-3" name="co_position_one" id="co_position_one" pattern="{1,}" required>
							    		</div>
								    	<div class="col-lg-6">
			                                <select name="co_employment_one">
			                                	<option selected disabled>---- Is he Employed or Own a Business? ----</option>
			                                    <option>Employed</option>
			                                    <option>Own Business</option>
			                                </select>
				                        </div>
							    	</div>
								</td>
							</tr>
						</table>
						<table class="table" id="dynamic_field">
							<tr>
								<td colspan="2"><h2 align="center">CO BORROWER 2</h2><br /><td>
							</tr>
							<tr>
				                <td colspan="2">
								<h3 class="text-center">CO BORROWER PERSONAL 2 INFORMATION</h3>
							    	<div class="row">
							    		<div class="col-sm-4">
							    			<input type="text" placeholder="Firstname" class="i-3" name="co_first_name_two" id="co_first_name_two" pattern="{1,}" required>
							    		</div>
							    		<div class="col-sm-4">
							    			<input type="text" placeholder="Middlename" class="i-3" name="co_middle_name_two" id="co_middle_name_two" pattern="{1,}" required>
							    		</div>
							    		<div class="col-sm-4">
							    			<input type="text" placeholder="Lastname" class="i-3" name="co_last_name_two" id="co_last_name_two" pattern="{1,}" required>
							    		</div>	
							    	</div>
									
							    	<div class="row">
				                       <div class="col-sm-5">
			                                <input type="text" placeholder="Address" class="i-3" name="co_address_two" id="co_address_two" pattern="{1,}" required>
			                           </div>
									   <div class="col-sm-4">
											<input type="text" placeholder="Relation" class="i-3" name="related_client_two" id="related_client_two" pattern="{1,}" required>
									   </div>
										<div class="col-sm-3">
										    <input placeholder="Contact number" type="text" class="i-3" name="co_contact_no_two" id="co_contact_no" required>
										</div>
							    	</div>
				                </td>
							</tr>
							<tr>
								<td>
									<h3 class="text-center"><i class="fa fa-angle-right"></i> CO BORROWER 2 WORK INFORMATION</h3>
									<div class="row">
							    		<div class="col-lg-6">
							    			<input type="text" placeholder="Business address" class="i-3" name="co_business_address_two" id="co_business_address_two" pattern="{1,}" required>
							    		</div>
							    		<div class="col-lg-6">
							    			<input type="text" placeholder="Firm name" class="i-3" name="co_name_of_firm_two" id="co_name_of_firm_two" pattern="{1,}" required>
							    		</div>	
							    	</div>
									
							    	<div class="row">
					                    <div class="col-lg-6">
							    			<input type="text" placeholder="Position" class="i-3" name="co_position_two" id="co_position_two" pattern="{1,}" required>
							    		</div>
								    	<div class="col-lg-6">
			                                <select name="co_employment_two">
			                                	<option selected disabled>---- Is he Employed or Own a Business? ----</option>
			                                    <option>Employed</option>
			                                    <option>Own Business</option>
			                                </select>
				                        </div>
							    	</div>
								</td>
							</tr>
						</table>

						<input type="button" name="submit" id="submit" class="btn mybtn2" style="background-color:#2a6752; color:white;" value="Submit" />
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
</body>
</html>







































