<?php

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'sigma');


// initialize variables
    $id = 0;
    $datePaid = "";
    $amtPaid = "";
    $paymentType = "";
    $accNumber = "";
    $checkNumber = "";
    $refNumber = "";
    $inter= "";
    $fines= "";
    $marks ="";
    $stats = "";
    $update = false;

//save
    if (isset($_POST['create'])) {
        $id = $_POST['id'];
        $datePaid = $_POST['datePaid'];
        $amtPaid = $_POST['amountPaid'];
        $paymentType = $_POST['paymentType'];
        $accNumber = $_POST['accountNo'];
        $checkNumber = $_POST['checkNo'];
        $refNumber = $_POST['refNo'];
        $inter = $_POST['interest'];
        $fines = $_POST['fines'];
        $marks = $_POST['remarks'];
        $stats = $_POST['status'];
        if($datePaid != ""){
        mysqli_query($db, "INSERT INTO payment_info (payment_id, amount_paid, payment_type, date_paid, account_number, check_no, ref_no, interest, fines, remarks, status) VALUES ((SELECT payment_id FROM payment WHERE payment_id=$id) , '$amtPaid', '$paymentType', '$datePaid', '$accNumber', '$checkNumber', '$refNumber', '$inter', '$fines', '$marks', '$stats')"); 
        header('location: EditPayment.php');
        }
    }
/*
    //Update Start
    if(isset($_POST['update'])){
        $payID = $_POST['payment_id'];
        $remainingBal = $_POST['remainingbalance']
        $datePaid = $_POST['datePaid'];
        $amtPaid = $_POST['amountPaid'];
        $paymentType = $_POST['paymentType'];
        $accNumber = $_POST['accountNo'];
        $checkNumber = $_POST['checkNo'];
        $refNumber = $_POST['refNo'];
        $marks = $_POST['remarks'];
        $stats = $_POST['status'];
        if($datePaid != ""){
        mysqli_query($db, "UPDATE payment INNER JOIN payment_info ON payment.payment_id=payment_info.payment_id SET payment.remaining_balance='$remainingBal', payment_info.date_paid='$datePaid', payment_info.amount_paid='$amtPaid', payment_info.payment_type='$paymentType', payment_info.account_number='accNumber', payment_info.check_no='checkNumber', payment_info.ref_no='$refNumber', payment_info.remarks='$marks', payment_info.status='$status' WHERE payment_id='$payID'"); 
        header('location: EditPayment.php');
        }
    }
    //Update End


/*
$db = mysqli_connect('localhost', 'root', '', 'itproject2');


// initialize variables
    $id = "";
    $datePaid = "";
    $amtPaid = "";
    $payType = "";
    $accNumber = "";
    $checkNumber = "";
    $refNumber = "";
    $marks ="";
    $stats ="";
//save
    if (isset($_POST['create'])) {
        $datePaid = $_POST['datePaid'];
        $amtPaid = $_POST['amountPaid'];
        $payType = $_POST['paymentType'];
        $accNumber = $_POST['accountNo'];
        $checkNumber = $_POST['checkNo'];
        $refNumber = $_POST['refNo'];
        $marks = $_POST['remarks'];
        $stats = $_POST['status'];

    if($datePaid != ""){
        mysqli_query($db, "INSERT INTO payment_info (date_paid, amount_paid, payment_type, account_number, check_no, ref_no, remarks, status) VALUES ('$datePaid', '$amtPaid', '$payType', '$accNumber', '$checkNumber', '$refNumber', '$marks', '$stats')"); 
        header('location: EditPayment.php');
    }
    }
*/
?>  