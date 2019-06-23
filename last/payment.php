<?php


    include 'Include/connection.php';

    $sql;
    $payment = mysqli_real_escape_string($conn,$_POST['payment']);
    $date = mysqli_real_escape_string($conn,$_POST['date']);
    $payment_type = mysqli_real_escape_string($conn,$_POST['payment_type']);
    $loan_id = mysqli_real_escape_string($conn,$_POST['loan_id']);
    $remarks = mysqli_real_escape_string($conn,$_POST['remarks']);
    $choice = mysqli_real_escape_string($conn,$_POST['choice']);
    $search = mysqli_real_escape_string($conn,$_POST['search']);
    $account = mysqli_real_escape_string($conn,$_POST['accNum']);
    $check = mysqli_real_escape_string($conn,$_POST['checkNum']);
    $ref = mysqli_real_escape_string($conn,$_POST['refNum']);
    $add = 0;

    

    //for rates
    $sqlForRates = "SELECT * from rates";
    $rowRates = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRates));

    $sqlForPay = "SELECT * from payment WHERE loan_id = $loan_id && due_date = '$choice'";
    $rowPay = mysqli_fetch_assoc(mysqli_query($conn,$sqlForPay));


    

    //for Late Payment
    $sqlForLate = "SELECT bi_monthly FROM loan WHERE loan_id='$loan_id'";
    $row1 = mysqli_fetch_assoc(mysqli_query($conn,$sqlForLate));
    $bi_monthly = $row1['bi_monthly'];

    $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$loan_id";
    $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));    
        



  //for Advance Payment
    $sqlForAdvance = "SELECT if(SUM(amount_paid)-($bi_monthly*(SELECT COUNT(DISTINCT(payment.payment_id)) from payment_info JOIN payment ON payment.payment_id = payment_info.payment_id WHERE loan_id = $loan_id && amount_paid != 0)+(SUM(fines)+SUM(interest)))>0,SUM(amount_paid)-($bi_monthly*(SELECT COUNT(DISTINCT(payment.payment_id)) from payment_info JOIN payment ON payment.payment_id = payment_info.payment_id WHERE loan_id = $loan_id && amount_paid != 0)+(SUM(fines)+SUM(interest)+other_income)),0) as `AP` from payment_info join payment ON payment_info.payment_id = payment.payment_id WHERE loan_id='$loan_id' && status='updated'";

    $row2 = mysqli_fetch_assoc(mysqli_query($conn,$sqlForAdvance));
    $AP = $row2['AP'];
    $lack = $row1['bi_monthly'] * ($rowRates['penalty_lack']/100);

    $sqlForLack = "SELECT if(coalesce(SUM(amount_paid),0)-($bi_monthly*(SELECT COUNT(DISTINCT(payment.payment_id)) from payment_info JOIN payment ON payment.payment_id = payment_info.payment_id WHERE loan_id = $loan_id && amount_paid != 0)+(coalesce(SUM(fines),0)+coalesce(SUM(interest),0)+coalesce(SUM(amount_paid),0)))<=0,($bi_monthly*(SELECT COUNT(DISTINCT(payment.payment_id)) from payment_info JOIN payment ON payment.payment_id = payment_info.payment_id WHERE loan_id = $loan_id && amount_paid != 0)+(coalesce(SUM(fines),0)+coalesce(SUM(interest),0)+coalesce(SUM(other_income),0)))-coalesce(SUM(amount_paid),0),0) as `lack` from payment_info join payment ON payment_info.payment_id = payment.payment_id WHERE loan_id='$loan_id' && status='updated'";

        $rowLack = mysqli_fetch_assoc(mysqli_query($conn,$sqlForLack));

    $lackPayment = $rowLack['lack'];

    
    if($rowPay['remaining_balance'] == 0){
        $add = $bi_monthly;
    }
/**  
    if($AP+$payment > ($bi_monthly+$row2['fines']+$row2['interest'])){
        
        $sql = "INSERT INTO `payment_info`(`payment_id`, `date_paid`, `amount_paid`, `payment_type`, `remarks`,`account_number`,`check_no`,`ref_no`) VALUES ((SELECT payment_id FROM (SELECT * FROM payment) AS `payment` WHERE loan_id='$loan_id' && due_date='$choice') ,'$date',$bi, '$payment_type' ,'$remarks','$account','$check','$ref');";
        if(!mysqli_query($conn,$sql)){
            echo "Error: " . mysqli_error($conn);
        }
        if($advance <= $bi_monthly){
             $sqlAdvanceInsert = "INSERT into payment_info (`payment_id`,`payment_type`,`remarks`,`amount_paid`,`account_number`,`check_no`,`ref_no`) VALUES ((SELECT payment_id+1 FROM (SELECT * FROM payment) AS `payment` WHERE loan_id='$loan_id' && due_date='$choice'),'$payment_type','Over payment from past due', $advance,'$account','$check','$ref')";   
             if(!mysqli_query($conn,$sqlAdvanceInsert)){
                 echo "Error: " . mysqli_error($conn);
             }
        }else{
            $ctr = 1;
            while($advance > $bi_monthly){
            $sqlForAdvanceWithFines = "SELECT SUM(amount_paid) as `AP`,fines,SUM(interest) as interest from payment_info join payment ON payment_info.payment_id = payment.payment_id WHERE loan_id='$loan_id' && status='updated' && payment.payment_id=(SELECT payment_id+$ctr FROM (SELECT * FROM payment) AS `payment` WHERE loan_id='$loan_id' && due_date='$choice');";
            $rowAdvanceWithFines = mysqli_fetch_assoc(mysqli_query($conn,$sqlForAdvanceWithFines)); 
                
            $biAdvance = ($bi_monthly+$rowAdvanceWithFines['fines']+$rowAdvanceWithFines['interest'])-$rowAdvanceWithFines['AP'];    
            $sqlAdvanceInsert = "INSERT into payment_info (`payment_id`,`payment_type`,`remarks`,`amount_paid`,`account_number`,`check_no`,`ref_no`) VALUES ((SELECT payment_id+$ctr FROM (SELECT * FROM payment) AS `payment` WHERE loan_id='$loan_id' && due_date='$choice'),'$payment_type','Over payment from past due', CEILING($biAdvance),'$account','$check','$ref')";
            $advance = $advance - $biAdvance;
            $ctr++;
                if(!mysqli_query($conn,$sqlAdvanceInsert)){
                 echo "Error: " . mysqli_error($conn);
                }            
            }
            $sqlAdvanceInsert = "INSERT into payment_info (`payment_id`,`payment_type`,`remarks`,`amount_paid`,`account_number`,`check_no`,`ref_no`) VALUES ((SELECT payment_id+$ctr FROM (SELECT * FROM payment) AS `payment` WHERE loan_id='$loan_id' && due_date='$choice'),'$payment_type','Over payment from past due', $advance,'$account','$check','$ref') ";
            if(!mysqli_query($conn,$sqlAdvanceInsert)){
                 echo "Error: " . mysqli_error($conn);
             }
        }
        
        
        
        
    //for Lacking Payment 
    
    }else**/ 
    if($payment+$AP < ($lackPayment + $add) && ($payment+$AP < $rowRemain['rb'])){
    
    $sqlLackingInsert = "INSERT INTO `payment_info`(`payment_id`, `date_paid`, `amount_paid`, `payment_type`, `remarks`, `fines`,`account_number`,`check_no`,`ref_no`) VALUES ((SELECT payment_id FROM (SELECT * FROM payment) AS `payment` WHERE loan_id='$loan_id' && due_date='$choice'),'$date',$payment,'$payment_type', 'Payment was Lacking(Penalty)',CEILING($lack),'$account','$check','$ref');";
        if(!mysqli_query($conn, $sqlLackingInsert)){
            echo "Error: " . mysqli_error($conn);
        }
        
    }else{
    $sql = "INSERT INTO `payment_info`(`payment_id`, `date_paid`, `amount_paid`, `payment_type`, `remarks`,`account_number`,`check_no`,`ref_no`) VALUES ((SELECT payment_id FROM (SELECT * FROM payment) AS `payment` WHERE loan_id='$loan_id' && due_date='$choice'),'$date',$payment,'$payment_type','$remarks','$account','$check','$ref');";
        if(!mysqli_query($conn, $sql)){
            echo "Error: " . mysqli_error($conn);
        }
            
    }







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
 
?>
<html> 
<body>
<form name='forSearch' action='search.php' method='POST'>
<input type=hidden name='loan_id' value="<?php echo $loan_id; ?>">  
</form>
</body>    

<script type='text/javascript'>
document.forSearch.submit();
</script>
</html>