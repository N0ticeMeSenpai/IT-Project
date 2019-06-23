
<?php
include "Include/connection.php";

$number = $_POST["number"];
$due = mysqli_real_escape_string($conn,$_POST['result']['0']);
$client_id = mysqli_real_escape_string($conn,$_POST['client_id']);
$amount = mysqli_real_escape_string($conn,$_POST['amount']);
$interest = mysqli_real_escape_string($conn,$_POST['interest']);
$mat_date = mysqli_real_escape_string($conn, $_POST['mat_date']);
$loan_class = mysqli_real_escape_string($conn,$_POST['loan_class']);
$shf = mysqli_real_escape_string($conn,$_POST['shf']);
$insurance = mysqli_real_escape_string($conn,$_POST['insurance']);
$loan_type = mysqli_real_escape_string($conn,$_POST['loan_type']);
    $co_first_name_one = mysqli_real_escape_string($conn, $_POST['co_first_name_one']);
    $co_middle_name_one = mysqli_real_escape_string($conn, $_POST['co_middle_name_one']);
    $co_last_name_one = mysqli_real_escape_string($conn, $_POST['co_last_name_one']);
    $co_contact_no_one = mysqli_real_escape_string($conn, $_POST['co_contact_no_one']);
    $co_address_one = mysqli_real_escape_string($conn, $_POST['co_address_one']);
    $co_business_address_one = mysqli_real_escape_string($conn, $_POST['co_business_address_one']);
    $co_name_of_firm_one = mysqli_real_escape_string($conn, $_POST['co_name_of_firm_one']);
    $co_employment_one = mysqli_real_escape_string($conn, $_POST['co_employment_one']);
    $co_position_one = mysqli_real_escape_string($conn, $_POST['co_position_one']);

    //Co Borrower _two Table    
    $co_first_name_two = mysqli_real_escape_string($conn, $_POST['co_first_name_two']);
    $co_middle_name_two = mysqli_real_escape_string($conn, $_POST['co_middle_name_two']);
    $co_last_name_two = mysqli_real_escape_string($conn, $_POST['co_last_name_two']);
    $co_contact_no_two = mysqli_real_escape_string($conn, $_POST['co_contact_no_two']);
    $co_address_two = mysqli_real_escape_string($conn, $_POST['co_address_two']);
    $co_business_address_two = mysqli_real_escape_string($conn, $_POST['co_business_address_two']);
    $co_name_of_firm_two = mysqli_real_escape_string($conn, $_POST['co_name_of_firm_two']);
    $co_employment_two = mysqli_real_escape_string($conn, $_POST['co_employment_two']);
    $co_position_two = mysqli_real_escape_string($conn, $_POST['co_position_two']);

    
        
    $stmt = $conn->prepare("INSERT INTO co_borrower
                (co_first_name, co_last_name, co_middle_name,
                 co_contact_no, co_address,
                  co_business_address,
                 co_name_of_firm, co_employment,
                 co_position)
             VALUES (?, ?, ?,?, ?, ?,?, ?, ?)");
    $stmt->bind_param("sssssssss", $co_first_name_one,$co_last_name_one,$co_middle_name_one,
                 $co_contact_no_one, $co_address_one,
                  $co_business_address_one,
                 $co_name_of_firm_one, $co_employment_one, 
                 $co_position_one);
    $stmt2 = $conn->prepare("INSERT INTO co_borrower
                (co_first_name, co_last_name, co_middle_name,
                 co_contact_no, co_address,
                  co_business_address,
                 co_name_of_firm, co_employment,
                 co_position)
             VALUES (?, ?, ?,?, ?, ?,?, ?, ?)");
    $stmt2->bind_param("sssssssss", $co_first_name_two,$co_last_name_two,$co_middle_name_two,
                 $co_contact_no_two, $co_address_two,
                  $co_business_address_two,
                 $co_name_of_firm_two, $co_employment_two, 
                 $co_position_two);


    $co_bow_1 = mysqli_query($conn,"SELECT co_first_name, co_last_name, co_middle_name FROM co_borrower WHERE co_first_name = '$co_first_name_one' && co_last_name = '$co_last_name_one' && co_middle_name = '$co_middle_name_one'");
    
    $co_bow_2 = mysqli_query($conn,"SELECT co_first_name, co_last_name, co_middle_name FROM co_borrower WHERE co_first_name = '$co_first_name_two' && co_last_name = '$co_last_name_two' && co_middle_name = '$co_middle_name_two'");
   


    if($loan_class=="Add"){
            $loan_balance = $amount+($amount * ($interest/100) * ($number/2)) + ($amount * ($shf/100));
    }else if($loan_class=="Deducted"){
            $loan_balance = $amount;
    }
    $queryForLoan = "INSERT INTO loan(loan_balance,date_booked,maturity_date,client_id,bi_monthly,interest_rate,loan_class,original_amount,insurance,loan_type,delinquent_status,loan_remarks) VALUES(CEILING($loan_balance),CURDATE(),'".$mat_date."',$client_id,CEILING($loan_balance/$number),$interest,'".$loan_class."',$amount,$insurance,'".$loan_type."','Active',NULL)";
    if (!mysqli_query($conn,$queryForLoan)) {
            echo "Error: " . mysqli_error($conn);

            }

     $sqlForID = "SELECT MAX(loan_id) as loan_id from loan";
    $rowID = mysqli_fetch_assoc(mysqli_query($conn,$sqlForID));
    $loan_id = $rowID['loan_id'];

     if(mysqli_num_rows($co_bow_1) >= 1){
        $sql5 = "INSERT INTO co_loan (loan_id,co_borrower_id) VALUES($loan_id,(SELECT co_borrower_id from co_borrower WHERE co_first_name = '$co_first_name_one' && co_middle_name='$co_middle_name_one' && co_last_name='$co_last_name_one'))";
         mysqli_query($conn, $sql5);
    }else{
            if(!empty($co_first_name_one) && !empty($co_middle_name_one) && !empty($co_last_name_one)){
                 $stmt->execute();


         $sqlForCoBow = "SELECT co_borrower_id from co_borrower WHERE co_first_name = '$co_first_name_one' && co_middle_name='$co_middle_name_one' && co_last_name='$co_last_name_one'";
        $CoBow = mysqli_fetch_assoc(mysqli_query($conn,$sqlForCoBow));
        $co_borrower_id = $CoBow['co_borrower_id'];
                
         $sql5 = "INSERT INTO co_loan (loan_id,co_borrower_id) VALUES($loan_id,$co_borrower_id)";
         if (!mysqli_query($conn,$sql5)) {
            echo "Error: " . mysqli_error($conn);

            }
            }

     } 
         
         
    if(mysqli_num_rows($co_bow_2) >= 1){
         $sql6 = "INSERT INTO co_loan (loan_id,co_borrower_id) VALUES($loan_id,(SELECT co_borrower_id from co_borrower WHERE co_first_name = '$co_first_name_two' && co_middle_name='$co_middle_name_two' && co_last_name='$co_last_name_two'))";
             mysqli_query($conn, $sql6);
    }else{
            if(!empty($co_first_name_two) && !empty($co_middle_name_two) && !empty($co_last_name_two)){
                    $stmt2->execute();

            
          $sqlForCoBow2 = "SELECT co_borrower_id from co_borrower WHERE co_first_name = '$co_first_name_two' && co_middle_name='$co_middle_name_two' && co_last_name='$co_last_name_two'";
        $CoBow2 = mysqli_fetch_assoc(mysqli_query($conn,$sqlForCoBow2));
        $co_borrower_id2 = $CoBow2['co_borrower_id'];
        
        $sql6 = "INSERT INTO co_loan (loan_id,co_borrower_id) VALUES($loan_id,$co_borrower_id2)";
             if (!mysqli_query($conn,$sql6)) {
            echo "Error: " . mysqli_error($conn);

            }
            }
    }     
if($number > 0)
{
    for($i=0; $i<$number; $i++)
	{
		if(trim($_POST["result"][$i] == ''))
		{
                        $number--;
		}else{
            $sql = "INSERT INTO payment(due_date,loan_id,date_modified) VALUES('".mysqli_real_escape_string($conn, $_POST["result"][$i])."',$loan_id,CURDATE())";
            
			if (!mysqli_query($conn,$sql)) {
            echo "Error: " . mysqli_error($conn);

            }  
        }

	}

    $result  = mysqli_query($conn , "UPDATE client SET registered_status='Approved' WHERE client_id='$client_id'");
    
    $sql1 = "SELECT due_date FROM payment WHERE loan_id='$loan_id' && payment_id IN (SELECT payment_id FROM payment_info WHERE status='updated' && loan_id='$loan_id');";
    $result = mysqli_query($conn,$sql1);
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck > 0){
        While ($row = mysqli_fetch_assoc($result)){

            $sql2 = "UPDATE payment SET remaining_balance=(SELECT CEILING((loan_balance+SUM(fines)+SUM(interest)+SUM(other_income)-(SUM(amount_paid)))) as remaining_balance FROM (SELECT * FROM payment) AS `payment` JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE due_date <= '".$row['due_date']."' && payment.loan_id='$loan_id' && status='updated') WHERE loan_id='$loan_id' && due_date='".$row['due_date']."'";
            
             if (!mysqli_query($conn,$sql2)) {
            echo "Error: " . mysqli_error($conn);

            }
        }
    }
}


?>
<html> 
<body>
<form name='forSearch' action='SORActiveAccount.php' method='POST'>
</form>
</body>    

<script type='text/javascript'>
document.forSearch.submit();
</script>
</html>

