<?php

$output = '';  
$conn = mysqli_connect("localhost", "root", "", "sigma"); 
$date=$_POST['testDate'];
$year = date("Y", strtotime($date));
$month = date("m",strtotime($date));



//=============================================================================================Active Account

if(isset($_POST["generate_ActiveAccount"]))
 {
  
  
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id
    WHERE (maturity_date > (select curdate())) 
    AND (loan.delinquent_status = 'Active' 
    AND registered_status='Approved') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<table class="table" bordered="1"
                    <tr>
                        <th colspan = "5">Active Account</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Loan Type</th>
                        <th>Date paid</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result))
      {

        $id = $row['loan_id'];
        $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$id'";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"])) &&
            $remaining!='0'){
            $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>
                        <td>'.$remaining.'</td>
                        <td>'.$row['loan_type'].'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date > (select curdate()) AND loan.loan_id=$id) AND
                        (loan.loan_type = 'Business' AND loan.delinquent_status = 'Active') ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='<td>'.$datePaidRemarks['date_paid'].'</td>
                        <td>'.$datePaidRemarks['remarks'].'</td>
                    </tr>';

        }
      }
      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


  }

 }

 //=============================================================================================Active Delinquent

if(isset($_POST["generate_ActiveDelinquent"]))
 {
  
  
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id
    WHERE (maturity_date < (select curdate())) 
    AND (loan.delinquent_status = 'Active' 
    AND registered_status='Approved') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<table class="table" bordered="1"
                    <tr>
                        <th colspan = "5">Active Delinquent</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Loan Type</th>
                        <th>Date paid</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result))
      {

        $id = $row['loan_id'];
        $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$id'";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"])) &&
            $remaining!='0'){
            $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>
                        <td>'.$remaining.'</td>
                        <td>'.$row['loan_type'].'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date < (select curdate()) AND loan.loan_id=$id) 
                        AND (loan.loan_type = 'Business' AND loan.delinquent_status = 'Active') ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='<td>'.$datePaidRemarks['date_paid'].'</td>
                        <td>'.$datePaidRemarks['remarks'].'</td>
                    </tr>';

        }
      }
      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


  }

 }

 //=============================================================================================Delinquent Account

if(isset($_POST["generate_DelinquentAccount"]))
 {
  
  
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id
    WHERE (maturity_date < (select curdate())) 
    AND (loan.delinquent_status = 'Inactive' 
    AND registered_status='Approved') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<table class="table" bordered="1"
                    <tr>
                        <th colspan = "5">Delinquent Account</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Loan Type</th>
                        <th>Date paid</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result))
      {

        $id = $row['loan_id'];
        $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$id'";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"])) &&
            $remaining!='0'){
            $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>
                        <td>'.$remaining.'</td>
                        <td>'.$row['loan_type'].'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date < (select curdate()) AND loan.loan_id=$id) AND
                        (loan.loan_type = 'Business' AND loan.delinquent_status = 'Inactive') ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='<td>'.$datePaidRemarks['date_paid'].'</td>
                        <td>'.$datePaidRemarks['remarks'].'</td>
                    </tr>';

        }
      }
      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


  }

 }

 //=============================================================================================Legal Account
if(isset($_POST["generate_LegalAccount"]))
 {
  
  
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id
    WHERE (maturity_date < (select curdate())) 
    AND (loan.delinquent_status = 'Legal' 
    AND registered_status='Approved') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  
      
  

    $output .= '<table class="table" bordered="1"
                    <tr>
                        <th colspan = "5">Legal Account</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Loan Type</th>
                        <th>Date paid</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result))
      {

        $id = $row['loan_id'];
        $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$id'";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"])) &&
            $remaining!='0'){
            $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>
                        <td>'.$remaining.'</td>
                        <td>'.$row['loan_type'].'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date < (select curdate()) AND loan.loan_id=$id) AND
                        (loan.loan_type = 'Business' AND loan.delinquent_status = 'Legal') ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='<td>'.$datePaidRemarks['date_paid'].'</td>
                        <td>'.$datePaidRemarks['remarks'].'</td>
                    </tr>';

        }
      }
      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


 }

 //================================================================= Summary of Bookings

 if(isset($_POST["generate_Bookings"]))
 {


  $query = "SELECT *  from client 
        INNER JOIN loan on client.client_id = loan.client_id
        INNER JOIN payment on payment.loan_id = loan.loan_id
        group by loan.loan_id";

        $result = mysqli_query($conn, $query);

      $output .= '<table class="table" bordered="1"
                    <tr>
                        <th colspan = "9">Summary of Bookings</th>
                    </tr>
                    <tr>
                        <th>Account name</th>
                        <th>Date Booked</th>
                        <th>Maturity date</th>
                        <th>Original amount</th>
                        <th>Net Proceeds</th>
                        <th>Interest earned</th>
                        <th>Service handling fee</th>
                        <th>Other Income</th>
                        <th>Loan Type</th>
                    </tr>';

     while($row = mysqli_fetch_array($result))
      {    
         
         $loan_id = $row['loan_id'];
        $sql ="SELECT first_name, last_name, middle_name, loan_type ,date_booked, maturity_date, original_amount, 
        loan_balance as net_proceeds, ROUND(original_amount * 0.05 * (COUNT(due_date)/2), 2) as Interest_earned, 
        original_amount*0.03 as service_handling_fee, insurance +coalesce((SELECT SUM(other_income) from payment_info WHERE payment.loan_id='$loan_id' && status='Updated'),0) as other_income  from client 
        INNER JOIN loan on client.client_id = loan.client_id
        INNER JOIN payment on payment.loan_id = loan.loan_id 
        WHERE loan.loan_id='$loan_id'";
        $rowSummary = mysqli_fetch_assoc(mysqli_query($conn,$sql));
         
        $output .=  '
              <tr>
                  <td>'.$rowSummary['first_name'].'  '.$rowSummary['middle_name'].' '.$rowSummary['last_name'].'</td>
                  <td>'.$rowSummary["date_booked"].'</td>
                  <td>'.$rowSummary["maturity_date"].'</td>
                  <td>'.$rowSummary["original_amount"].'</td>
                  <td>'.$rowSummary["net_proceeds"].'</td>
                  <td>'.$rowSummary["Interest_earned"].'</td>
                  <td>'.$rowSummary["service_handling_fee"].'</td>
                  <td>'.$rowSummary["other_income"].'</td>
                  <td>'.$rowSummary["loan_type"].'</td>
             </tr>';

      } 

        $output .= '</table>';
        header("Content-Type:application/xls");
        header("Content-Disposition: attachment; filename=download.xls");
        echo $output;


    }





//--------------------------------------Generate All report-----------------------------------------------------------------

 if(isset($_POST["generate_all"]))
 {
  
//==============================================Active Account
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id
    WHERE (maturity_date > (select curdate())) 
    AND (loan.delinquent_status = 'Active' 
    AND registered_status='Approved') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  
      

    $output .= '<table class="table" bordered="1"
                    <tr>
                        <th colspan = "5">Active Delinquent</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Loan Type</th>
                        <th>Date paid</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result))
      {

        $id = $row['loan_id'];
        $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$id'";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"])) &&
            $remaining!='0'){
            $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>
                        <td>'.$remaining.'</td>
                        <td>'.$row['loan_type'].'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date > (select curdate()) AND loan.loan_id=$id) AND
                        (loan.loan_type = 'Business' AND loan.delinquent_status = 'Active') ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='<td>'.$datePaidRemarks['date_paid'].'</td>
                        <td>'.$datePaidRemarks['remarks'].'</td>
                    </tr>';

        }
      }
//==============================================Active Delinquent
  $sql1 = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id
    WHERE (maturity_date < (select curdate())) 
    AND (loan.delinquent_status = 'Active' 
    AND registered_status='Approved') group by loan.loan_id";

  $result1 = mysqli_query($conn, $sql1);  
      
  


    $output .= '<table class="table" bordered="1"
                    <tr>
                        <th colspan = "5">Active Delinquent</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Loan Type</th>
                        <th>Date paid</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result1))
      {

        $id = $row['loan_id'];
        $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$id'";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"])) &&
            $remaining!='0'){
            $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>
                        <td>'.$remaining.'</td>
                        <td>'.$row['loan_type'].'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date < (select curdate()) AND loan.loan_id=$id) 
                        AND (loan.loan_type = 'Business' AND loan.delinquent_status = 'Active') ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='<td>'.$datePaidRemarks['date_paid'].'</td>
                        <td>'.$datePaidRemarks['remarks'].'</td>
                    </tr>';

        }
      }
//==============================================Delinquent
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id
    WHERE (maturity_date > (select curdate())) 
    AND (loan.delinquent_status = 'Inactive' 
    AND registered_status='Approved') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  
      
  

    $output .= '<table class="table" bordered="1"
                    <tr>
                        <th colspan = "5">Active Delinquent</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Loan Type</th>
                        <th>Date paid</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result))
      {

        $id = $row['loan_id'];
        $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$id'";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"])) &&
            $remaining!='0'){
            $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>
                        <td>'.$remaining.'</td>
                        <td>'.$row['loan_type'].'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date > (select curdate()) AND loan.loan_id=$id) AND
                        (loan.loan_type = 'Business' AND loan.delinquent_status = 'Inactive') ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='<td>'.$datePaidRemarks['date_paid'].'</td>
                        <td>'.$datePaidRemarks['remarks'].'</td>
                    </tr>';

        }
      }
  //=================================================== Legal Account
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id
    WHERE (maturity_date < (select curdate())) 
    AND (loan.delinquent_status = 'Legal' 
    AND registered_status='Approved') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  




      $output .= '
               <tr>
                    <th colspan = "5">Active Legal Account</th>
                </tr> 
                <tr>
                    <th>Name</th>
                    <th>Outstanding</th>
                    <th>Loan Type</th>
                    <th>Date paid</th>
                    <th>Remarks</th>
                </tr>';

      while ($row = mysqli_fetch_array($result))
      {

        $id = $row['loan_id'];
        $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$id'";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"])) &&
            $remaining!='0'){
            $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>
                        <td>'.$remaining.'</td>
                        <td>'.$row['loan_type'].'</td>';

                        $query1="SELECT * from loan
                        inner join payment on loan.loan_id = payment.loan_id
                        join payment_info on payment.payment_id = payment_info.payment_id
                        WHERE maturity_date > (select curdate()) AND payment.loan_id= '$id'
                        AND loan.delinquent_status = 'Active' group by payment.loan_id ORDER by payment_info.payment_id;";
                        $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1)); 
            $output .='<td>'.$row1['date_paid'].'</td>
                        <td>'.$row1['remarks'].'</td>
                    </tr>';

        }
      }

      //====================================================== List Of Delinquent
    $sql = "SELECT loan.loan_id, co_borrower.co_borrower_id,client.client_id ,concat(first_name,' ',last_name) as `account_name`,
        group_concat(distinct(concat(`co_first_name`, ' ', `co_last_name`)) separator '</td><td>') as group_name, 
        remaining_balance, maturity_date, registered_date from loan
        inner join client on client.client_id = loan.client_id
        inner join payment on payment.loan_id = loan.loan_id
        inner join co_borrower on client.client_id = co_borrower.client_id
        WHERE maturity_date < (select curdate()) group by loan.loan_id ORDER BY maturity_date DESC";

  $result = mysqli_query($conn, $sql);  


      $output .= '
               <tr>
                    <th colspan = "5">List of Delinquent</th>
                </tr> 
                <tr>
                    <th>Account Name</th>
                    <th>Co Borrower</th>
                    <th>Co Borrower 2</th>
                    <th>Balance</th>
                    <th>Date</th>
                </tr>';

      while ($row = mysqli_fetch_array($result))
      {
        $id = $row['loan_id'];
        $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id='$id'";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"])) &&
            $remaining!='0'){
            $output .='<tr>
                        <td>'.$row['account_name'].'</td>
                        <td>'.$row['group_name'].'</td>
                        <td>'.$remaining.'</td>';
                $query1="SELECT * from loan
                        inner join payment on loan.loan_id = payment.loan_id
                        join payment_info on payment.payment_id = payment_info.payment_id
                        WHERE maturity_date > (select curdate()) AND payment.loan_id= '$id'
                        AND loan.delinquent_status = 'Active' group by payment.loan_id ORDER by payment_info.payment_id;";
                        $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

            $output .='<td>'.$row1['remaining_balance'].'</td>
                        <td>'.$row1['maturity_date'].'</td>
                    </tr>';

        }
      }

      //=========================================================Bookings
      $query = "SELECT *  from client 
        INNER JOIN loan on client.client_id = loan.client_id
        INNER JOIN payment on payment.loan_id = loan.loan_id
        group by loan.loan_id";

        $result = mysqli_query($conn, $query);

      $output .= '<table class="table" bordered="1"
                    <tr>
                        <th colspan = "9">Summary of Bookings</th>
                    </tr>
                    <tr>
                        <th>Account name</th>
                        <th>Date Booked</th>
                        <th>Maturity date</th>
                        <th>Original amount</th>
                        <th>Net Proceeds</th>
                        <th>Interest earned</th>
                        <th>Service handling fee</th>
                        <th>Other Income</th>
                        <th>Loan Type</th>
                    </tr>';

     while($row = mysqli_fetch_array($result))
      {    
         
         $loan_id = $row['loan_id'];
        $sql ="SELECT first_name, last_name, middle_name, loan_type ,date_booked, maturity_date, original_amount, 
        loan_balance as net_proceeds, ROUND(original_amount * 0.05 * (COUNT(due_date)/2), 2) as Interest_earned, 
        original_amount*0.03 as service_handling_fee, insurance +coalesce((SELECT SUM(other_income) from payment_info WHERE payment.loan_id='$loan_id' && status='Updated'),0) as other_income  from client 
        INNER JOIN loan on client.client_id = loan.client_id
        INNER JOIN payment on payment.loan_id = loan.loan_id 
        WHERE loan.loan_id='$loan_id'";
        $rowSummary = mysqli_fetch_assoc(mysqli_query($conn,$sql));
         
        $output .=  '
              <tr>
                  <td>'.$rowSummary['first_name'].'  '.$rowSummary['middle_name'].' '.$rowSummary['last_name'].'</td>
                  <td>'.$rowSummary["date_booked"].'</td>
                  <td>'.$rowSummary["maturity_date"].'</td>
                  <td>'.$rowSummary["original_amount"].'</td>
                  <td>'.$rowSummary["net_proceeds"].'</td>
                  <td>'.$rowSummary["Interest_earned"].'</td>
                  <td>'.$rowSummary["service_handling_fee"].'</td>
                  <td>'.$rowSummary["other_income"].'</td>
                  <td>'.$rowSummary["loan_type"].'</td>
             </tr>';

      } 


      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


  }




  ?>