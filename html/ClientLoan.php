<?php
	
	include "Include/connection.php";
    $id = mysqli_real_escape_string($conn,$_POST['client_id']);
    $sqlForRates = "SELECT * from rates";
    $rowRates = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRates));

    $sqlForAmount = "SELECT * from client WHERE client_id = $id";
    $rowAmount = mysqli_fetch_assoc(mysqli_query($conn,$sqlForAmount));


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
                <form method="post" action="ClientLoanAction.php">
                       <input type=hidden name="client_id" value='<?php echo $id?>'>
					<div class="table-responsive">
						<table class="table" id="dynamic_field">
							<tr>
								<td colspan="2"><h2 align="center">Add Loan</h2><br /><td>
							</tr>
                            <tr>
				                <td colspan="2">
				                	<label>Loan Amount</label>
				                	<input type="number" name="amount" value="<?php echo $rowAmount['requested_amount']?>" class="i-3 name_list"/>
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
                            <tr >
                            <td >Input Number of Dues<input id="forDate" onkeyup="addFields()" class="i-3 name_list" /></td>
                           
                            </tr>
                            
                            <tr><td>Due Dates<input type="date" onChange = "addFields()" value="<?php echo date('Y-m-d'); ?>" name="due[]" class="i-3 name_list"/></td></tr>
                            <tr id="container">
                                
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
							    			<input type="text" placeholder="First Name" class="i-3" name="co_first_name_one" id="co_first_name_one" pattern="{1,}">
							    		</div>
							    		<div class="col-sm-4">
							    			<input type="text" placeholder="Middle Name" class="i-3" name="co_middle_name_one" id="co_middle_name_one" pattern="{1,}" >
							    		</div>
							    		<div class="col-sm-4">
							    			<input type="text" placeholder="Last Name" class="i-3" name="co_last_name_one" id="co_last_name_one" pattern="{1,}" >
							    		</div>	
							    	</div>
									
							    	<div class="row">
				                       <div class="col-sm-5">
			                                <input type="text" placeholder="Present Address" class="i-3" name="co_address_one" id="co_address_one" pattern="{1,}" >
			                           </div>
										<div class="col-sm-3">
										    <input type="text" pattern="\d*" maxlength="11" placeholder="Contact Number" class="i-3" name="co_contact_no_one" id="co_contact_no" >
										</div>
							    	</div>
				                </td>
							</tr>
							<tr>
								<td>
									<h3 class="text-center"><i class="fa fa-angle-right"></i> CO BORROWER 1 WORK INFORMATION </h3>
									<div class="row">
							    		<div class="col-lg-6">
							    			<input type="text" class="i-3" placeholder="Business Address" name="co_business_address_one" id="co_business_address_one" pattern="{1,}" >
							    		</div>
							    		<div class="col-lg-6">
							    			<input type="text" class="i-3" placeholder="Name of Firm" name="co_name_of_firm_one" id="co_name_of_firm_one" pattern="{1,}" >
							    		</div>	
							    	</div>
									
							    	<div class="row">
					                    <div class="col-lg-6">
							    			<input type="text" class="i-3" placeholder="Position" name="co_position_one" id="co_position_one" pattern="{1,}" >
							    		</div>
								    	<div class="col-lg-6">
			                                <select name="co_employment_one">
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
							    			<input type="text" class="i-3" placeholder="First Name" name="co_first_name_two" id="co_first_name_two" pattern="{1,}" >
							    		</div>
							    		<div class="col-sm-4">
							    			<input type="text" class="i-3" placeholder="Middle Name" name="co_middle_name_two" id="co_middle_name_two" pattern="{1,}" >
							    		</div>
							    		<div class="col-sm-4">
							    			<input type="text" class="i-3" placeholder="Last Name" name="co_last_name_two" id="co_last_name_two" pattern="{1,}" >
							    		</div>	
							    	</div>
									
							    	<div class="row">
				                       <div class="col-sm-5">
			                                <input type="text" class="i-3" placeholder="Present Address" name="co_address_two" id="co_address_two" pattern="{1,}" >
			                           </div>
										<div class="col-sm-3">
										    <input type="text" pattern="\d*" maxlength="11" class="i-3" placeholder="Contact Number" name="co_contact_no_two" id="co_contact_no" >
										</div>
							    	</div>
				                </td>
							</tr>
							<tr>
								<td>
									<h3 class="text-center"><i class="fa fa-angle-right"></i> CO BORROWER 2 WORK INFORMATION</h3>
									<div class="row">
							    		<div class="col-lg-6">
							    			<input type="text" class="i-3" placeholder="Business Address" name="co_business_address_two" id="co_business_address_two" pattern="{1,}" >
							    		</div>
							    		<div class="col-lg-6">
							    			<input type="text" class="i-3" placeholder="Name of Firm" name="co_name_of_firm_two" id="co_name_of_firm_two" pattern="{1,}" >
							    		</div>	
							    	</div>
							    	<div class="row">
					                    <div class="col-lg-6">
							    			<input type="text" class="i-3" placeholder="Position" name="co_position_two" id="co_position_two" pattern="{1,}" >
							    		</div>
								    	<div class="col-lg-6">
			                                <select placeholder="Employment" name="co_employment_two">
			                                    <option>Employed</option>
			                                    <option>Own Business</option>
			                                </select>
				                        </div>
							    	</div>
								</td>
							</tr>
						</table>

						<input type="submit" name="submit" id="submit" class="btn mybtn2 i-3" style="background-color:#2a6752; color:white;" value="Submit" />
					</div>
                    </form>
			</div>
		</div>

<script>
	
    
 function addFields(){
         var k=1;

            var number = document.getElementById("forDate").value;
            var container = document.getElementById("container");
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            for (i=1;i<number;i++){

            function padNumber(number) {
                var string  = '' + number;
                string      = string.length < 2 ? '0' + string : string;
                return string;
            }
            
            date      = new Date(document.getElementsByName("due[]")[0].value);
            next_date = new Date(date.setDate(date.getDate() + 15*k));
            formatted = next_date.getUTCFullYear() + '-' + padNumber(next_date.getUTCMonth() + 1) + '-' + padNumber(next_date.getUTCDate());
		    k++;
                
                var input = document.createElement("input");
                input.type = "date";
                input.name = "due[]";
                input.value = formatted;
                input.className = "i-3 name_list"; 
                input.id = k;
                container.appendChild(input);
                
                $( "#"+k ).wrap( "<tr><td></td></tr>" );


            }

        }

    
</script>
</body>
</html>







































