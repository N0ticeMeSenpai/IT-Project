<?php

$output = '';  
$conn = mysqli_connect("localhost", "root", "", "sigma"); 
$date=$_POST['testDate'];
$year = date("Y", strtotime($date));
$month = date("m",strtotime($date));


if(isset($_POST["generate_ActiveAccount"]))
 {
  
  
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id 
    inner join payment_info 
    on payment.payment_id = payment_info.payment_id group by loan.loan_id";

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

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
            $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>';

                $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];  
                        
                $output .='<td>'.$remaining.'</td>
                        <td>'.$row['loan_type'].'</td>
                        <td>'.$row['date_paid'].'</td>
                        <td>'.$row['remarks'].'</td>
                    </tr>';

        }
      }
      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


  }

 }


if(isset($_POST["generate_ActiveDelinquent"]))
 {
  
  
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id";

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

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
          $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>  
                        <td>'.$row['remaining_balance'].'</td>
                        <td>'.$row['loan_type'].'</td>
                        <td>'.$row['date_paid'].'</td>
                        <td>'.$row['remarks'].'</td>
                    </tr>';

        }
      }
      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


  }

 }

//---------------------------------------Generate Legal
 if(isset($_POST["generate_LegalAccount"]))
 {
  
  
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
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

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
          $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>  
                        <td>'.$row['remaining_balance'].'</td>
                        <td>'.$row['loan_type'].'</td>
                        <td>'.$row['date_paid'].'</td>
                        <td>'.$row['remarks'].'</td>
                    </tr>';

        }
      }
      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


  }

 }

//------------------------------------Delinquent

 if(isset($_POST["generate_DelinquentAccount"]))
 {
  
  
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id";

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

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
          $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>  
                        <td>'.$row['remaining_balance'].'</td>
                        <td>'.$row['loan_type'].'</td>
                        <td>'.$row['date_paid'].'</td>
                        <td>'.$row['remarks'].'</td>
                    </tr>';

        }
      }
      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


  }

 }
//---------------------------------------------generate Booking
 if(isset($_POST["generate_Bookings"]))
 {
  
  
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<table class="table" bordered="1"
                    <tr>
                        <th colspan = "5">Summary of Bookings</th>
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

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
          $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>  
                        <td>'.$row['remaining_balance'].'</td>
                        <td>'.$row['loan_type'].'</td>
                        <td>'.$row['date_paid'].'</td>
                        <td>'.$row['remarks'].'</td>
                    </tr>';

        }
      }
      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


  }

 }

//--------------------------------------Generate All report-----------------------------------------------------------------

 if(isset($_POST["generate_all"]))
 {
  
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id 
    group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  
      

    $output .= '<table class="table" bordered="1">
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

      while ($row = mysqli_fetch_assoc($result))
      {

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
          $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>  
                        <td>'.$row['remaining_balance'].'</td>
                        <td>'.$row['loan_type'].'</td>
                        <td>'.$row['date_paid'].'</td>
                        <td>'.$row['remarks'].'</td>
                    </tr>';

        }
      }

  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id 
    group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  


      $output .= '
               <tr>
                    <th colspan = "5">Delinquent Account Account</th>
                </tr> 
                <tr>
                    <th>Name</th>
                    <th>Outstanding</th>
                    <th>Loan Type</th>
                    <th>Date paid</th>
                    <th>Remarks</th>
                </tr>';

      while ($row = mysqli_fetch_assoc($result))
      {

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
          $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>  
                        <td>'.$row['remaining_balance'].'</td>
                        <td>'.$row['loan_type'].'</td>
                        <td>'.$row['date_paid'].'</td>
                        <td>'.$row['remarks'].'</td>
                    </tr>';

        }
      }

        $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  


      $output .= '
               <tr>
                    <th colspan = "5">Active Delinquent Account Account</th>
                </tr> 
                <tr>
                    <th>Name</th>
                    <th>Outstanding</th>
                    <th>Loan Type</th>
                    <th>Date paid</th>
                    <th>Remarks</th>
                </tr>';

      while ($row = mysqli_fetch_assoc($result))
      {

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
          $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>  
                        <td>'.$row['remaining_balance'].'</td>
                        <td>'.$row['loan_type'].'</td>
                        <td>'.$row['date_paid'].'</td>
                        <td>'.$row['remarks'].'</td>
                    </tr>';

        }
      }

  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    group by loan.loan_id";

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

      while ($row = mysqli_fetch_assoc($result))
      {

        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
          $output .='<tr>
                        <td>'.$row['first_name']." ".$row['last_name'].'</td>  
                        <td>'.$row['remaining_balance'].'</td>
                        <td>'.$row['loan_type'].'</td>
                        <td>'.$row['date_paid'].'</td>
                        <td>'.$row['remarks'].'</td>
                    </tr>';

        }
      }

    $sql = "SELECT co_borrower.co_borrower_id,client.client_id ,concat(first_name,' ',last_name) as `account_name`,
        group_concat(distinct(concat(`co_first_name`, ' ', `co_last_name`)) separator '</td><td>') as group_name, 
        remaining_balance, maturity_date, registered_date from loan
        inner join client on client.client_id = loan.client_id
        inner join payment on payment.loan_id = loan.loan_id
        inner join co_borrower on client.client_id = co_borrower.client_id
        WHERE maturity_date < (select curdate()) AND remaining_balance!=0 group by loan.loan_id ORDER BY maturity_date DESC";

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
          if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
              $output .='<tr>
                            <td>'.$row['account_name'].'</td>  
                            <td>'.$row['group_name'].'</td>
                            <td>'.$row['remaining_balance'].'</td>
                            <td>'.$row['maturity_date'].'</td>
                        </tr>';
            }

      }




      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=download.xls");
      echo $output;


  }




  ?>