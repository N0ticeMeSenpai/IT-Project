<?php
    $conn = mysqli_connect('127.0.0.1','root','');
    
	include 'Include/connection.php';
   

    $loan_idforR = mysqli_real_escape_string($conn,$_POST['loan_idforR']);
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    $client_id = mysqli_real_escape_string($conn,$_POST['client_id']);

    $remaining = "SELECT CEILING((loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0))) as remaining_balance FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$loan_idforR'";
    $row = mysqli_fetch_assoc(mysqli_query($conn,$remaining));

?>


<html>
	<head>
		<title>Restructuring</title>
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
		<div class="container">
			<br />
			<br />
			<h2 align="center">RESTRUCTURING OF CLIENT</h2><br />
			<div class="form-group">
				<form name="add_due" id="add_due">
                    <input type=hidden name="loan_id" value='<?php echo $loan_idforR; ?>'>
                    <input type=hidden name="client_id" value='<?php echo $client_id; ?>'>
					<div class="table-responsive">
						<table class="table" id="dynamic_field">
                            <tr>
				                <td colspan="2">
				                	<label>Outstanding Balance</label>
				                	<input type="number" name="amount" min="1000" class="i-3 name_list" value='<?php echo $row['remaining_balance']; ?>'/>
				                </td>
							</tr>
                            <tr>
				                <td colspan="2">
				                	<label>Insurance</label>
				                	<input type="text" name="insurance" class="i-3 name_list" value="0"/>
				                </td>
							</tr>
                
							<tr >
                            <td >Input Number of Dues<input id="forDate" onkeyup="addFields()" class="i-3 name_list" required/></td>
                           
                            </tr>
                            
                            <tr><td>Due Dates<input type="date" onChange = "addFields()" value="<?php echo date('Y-m-d'); ?>" name="due[]" class="i-3 name_list"/></td></tr>
                            <tr id="container">
                                
                            </tr>
						</table>
						<input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
					</div>
				</form>
			</div>
		</div>

<form name='forSearch' action='search.php' method='POST'>
<input type=hidden name='loan_id' value="<?php echo $loan_idforR; ?>">  
</form>
</body>    




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
$(document).ready(function(){
	
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


</html>

