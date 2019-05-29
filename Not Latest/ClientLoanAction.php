<?php
session_start();
//Checking User Logged or Not
if(empty($_SESSION['user'])){
    header('location:Login.php');
}


//timeout after 5 sec
if(isset($_SESSION['user'])) {
    if((time() - $_SESSION['last_time']) > 1800) {
      header("location:logout.php");  
    }
}


//Restrict User or Moderator to Access Admin.php page
if($_SESSION['user']['em_position']=='Office Staff'){
    header('location:Profile.php');
}
?>

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
$client_id = mysqli_real_escape_string($con,$_POST['client_id']);
$amount = mysqli_real_escape_string($con,$_POST['amount']);
$interest = mysqli_real_escape_string($con,$_POST['interest']);
$mat_date = mysqli_real_escape_string($con, $_POST["due"][$number-1]);
$loan_class = mysqli_real_escape_string($con,$_POST['loan_class']);
$shf = mysqli_real_escape_string($con,$_POST['shf']);
$insurance = mysqli_real_escape_string($con,$_POST['insurance']);


    if($loan_class=="Add"){
            $loan_balance = $amount+($amount * ($interest/100) * ($number/2)) + ($amount * ($shf/100)) -($insurance);
    }else if($loan_class=="Deducted"){
            $loan_balance = $amount-($amount * ($interest/100) * ($number/2)) - ($amount * ($shf/100)) -($insurance);
    }
    $queryForLoan = "INSERT INTO loan(loan_balance,date_booked,maturity_date,client_id,bi_monthly,interest_rate,loan_class,original_amount,insurance) VALUES(CEILING($loan_balance),CURDATE(),'".$mat_date."',$client_id,($loan_balance/$number),$interest,'".$loan_class."',$amount,$insurance)";
    if (!mysqli_query($con,$queryForLoan)) {
            echo "Error: " . mysqli_error($con);

            }

    $sqlForID = "SELECT loan_id from loan WHERE client_id='".$client_id."' && loan_balance =CEILING(".$loan_balance.") && date_booked=CURDATE() && maturity_date='".$mat_date."'";
    $rowRates = mysqli_fetch_assoc(mysqli_query($con,$sqlForID));
    $loan_id = $rowRates['loan_id'];

if($number > 0)
{
	for($i=0; $i<$number; $i++)
	{
		if(trim($_POST["due"][$i] == ''))
		{
                        $number--;
		}else{
            $sql = "INSERT INTO payment(due_date,loan_id,date_modified) VALUES('".mysqli_real_escape_string($con, $_POST["due"][$i])."',$loan_id,CURDATE())";

			if (!mysqli_query($con,$sql)) {
            echo "Error: " . mysqli_error($con);

            }  
        }

	}

    $result  = mysqli_query($con , "UPDATE client SET registered_status='Approved', date_modified = current_date() WHERE client_id='$client_id'");
	echo "Successfully added";
}
else
{
	echo "Please Enter Due Date";
}

