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

        if ($month == date("m",strtotime($row["date_paid"])) && 
            $year == date("Y",strtotime($row["date_paid"]))){
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

        if ($month == date("m",strtotime($row["date_paid"])) && 
            $year == date("Y",strtotime($row["date_paid"]))){
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

        if ($month == date("m",strtotime($row["date_paid"])) && 
            $year == date("Y",strtotime($row["date_paid"]))){
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

        if ($month == date("m",strtotime($row["date_paid"])) && 
            $year == date("Y",strtotime($row["date_paid"]))){
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

        if ($month == date("m",strtotime($row["date_paid"])) && 
            $year == date("Y",strtotime($row["date_paid"]))){
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
    inner join payment_info on payment.payment_id = payment_info.payment_id";

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

        if ($month == date("m",strtotime($row["date_paid"])) && 
            $year == date("Y",strtotime($row["date_paid"]))){
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
    inner join payment_info on payment.payment_id = payment_info.payment_id";

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

        if ($month == date("m",strtotime($row["date_paid"])) && 
            $year == date("Y",strtotime($row["date_paid"]))){
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
    inner join payment_info on payment.payment_id = payment_info.payment_id";

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

        if ($month == date("m",strtotime($row["date_paid"])) && 
            $year == date("Y",strtotime($row["date_paid"]))){
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
    inner join payment_info on payment.payment_id = payment_info.payment_id";

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

        if ($month == date("m",strtotime($row["date_paid"])) && 
            $year == date("Y",strtotime($row["date_paid"]))){
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




  ?>