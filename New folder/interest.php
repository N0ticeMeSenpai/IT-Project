<?php
    $con = mysqli_connect('127.0.0.1','root','');
    
    if(!$con){
        echo 'Not Connected To Server';
    }
    
    if(!mysqli_select_db($con,'sigma')){
        echo 'Not Selected';
    }

$number = count($_POST["due"]);
$due = mysqli_real_escape_string($con,$_POST['due']['0']);
$loan_id = mysqli_real_escape_string($con,$_POST['loan_id']);
$amount = mysqli_real_escape_string($con,$_POST['amount']);
$insurance = mysqli_real_escape_string($con,$_POST['insurance']);
$client_id = mysqli_real_escape_string($con,$_POST['client_id']);


 $sqlForRates = "SELECT * from rates";
    $rowRates = mysqli_fetch_assoc(mysqli_query($con,$sqlForRates));
   
$loan = "SELECT * from loan where loan_id = '$loan_id'";
    $row = mysqli_fetch_assoc(mysqli_query($con,$loan));
$balance = $amount + ($amount*($rowRates['interest']/100)*($number/2));

$bi_monthly = ($amount+($amount*($rowRates['interest']/100)*($number/2)))/$number;

$queryForLoan = "INSERT INTO loan(interest_rate,loan_class,client_id,date_booked,maturity_date,bi_monthly,loan_balance,original_amount,insurance,delinquent_status,loan_type,loan_status) VALUES(".$row['interest_rate'].",'".$row['loan_class']."',$client_id,curdate(),'".$_POST["due"][$number-1]."',$bi_monthly,ceiling($balance),$amount,$insurance,'".$row['delinquent_status']."','".$row['loan_type']."','Restructured')";

 mysqli_query($con,$queryForLoan);

 $sqlForID = "SELECT MAX(loan_id) as loan_id from loan";
    $rowID = mysqli_fetch_assoc(mysqli_query($con,$sqlForID));

if($number > 0)
{
	for($i=0; $i<$number; $i++)
	{
		if(trim($_POST["due"][$i] == ''))
		{
                        $number--;
		}else{
            $sql = "INSERT INTO payment(due_date,loan_id,date_modified) VALUES('".mysqli_real_escape_string($con, $_POST["due"][$i])."',".$rowID['loan_id'].",CURDATE())";
            
			if (!mysqli_query($con,$sql)) {
            echo "Error: " . mysqli_error($con);

            }  
        }

	}
    
     $queryforStatus = "UPDATE loan SET loan_status='Remove' WHERE loan_id=$loan_id";
    if (!mysqli_query($con,$queryforStatus)) {
            echo "Error: " . mysqli_error($con);

     }      
	echo "Added interest is: ",($amount*($rowRates['interest']/100)*($number/2));
}
else
{
	echo "Please Enter Due Date";
}

