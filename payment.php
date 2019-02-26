<?php


$con = mysqli_connect('127.0.0.1','root','');
    
    if(!$con){
        echo 'Not Connected To Server';
    }
    
    if(!mysqli_select_db($con,'sigma')){
        echo 'Not Selected';
    }

    $payment = $_POST['payment'];
    $date = $_POST['date'];
    $payment_type = $_POST['payment_type'];
    $loan_id = $_POST['loan_id'];
    $sql = "INSERT INTO `payment`(`payment_id`, `date_paid`, `amount_paid`, `payment_type`, `account_number`, `check_no`, `ref_no`, `interest`, `fines`, `loan_id`) VALUES ('2','$date','$payment','$payment_type','1','1','1','0','0','$loan_id')";
    if(!mysqli_query($con,$sql)){
        echo 'Not Inserted';
    }else{
        echo 'Inserted';
    }
    
?>