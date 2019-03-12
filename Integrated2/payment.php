<?php


$con = mysqli_connect('127.0.0.1','root','');
    
    if(!$con){
        echo 'Not Connected To Server';
    }
    
    if(!mysqli_select_db($con,'sigma')){
        echo 'Not Selected';
    }
    $sql;
    $payment = $_POST['payment'];
    $date = $_POST['date'];
    $payment_type = $_POST['payment_type'];
    $loan_id = $_POST['loan_id'];
    $remarks = $_POST['remarks'];
    $choice = $_POST['choice'];
    $sql = "UPDATE payment SET date_paid='$date', amount_paid=$payment, payment_type='$payment_type',remarks='$remarks' WHERE loan_id='$loan_id' && due_date='$choice';";
    

    $sql1 = "SELECT due_date FROM payment WHERE loan_id='$loan_id';";
    $result = mysqli_query($con,$sql1);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        While ($row = mysqli_fetch_assoc($result)){
            $sql2 = "UPDATE payment SET remaining_balance=(SELECT (loan_balance-(SUM(amount_paid))) as remaining_balance FROM (SELECT * FROM payment) AS payment JOIN loan ON payment.loan_id=loan.loan_id WHERE due_date<='".$row['due_date']."' && payment.loan_id ='$loan_id') WHERE loan_id='$loan_id' && due_date='".$row['due_date']."'";
            
             if (mysqli_query($con, $sql) && mysqli_query($con,$sql2)) {
            header('Location: search.php');

            } else {
            echo "Error updating record: " . mysqli_error($con);
             } 
        }
    }


    
?>