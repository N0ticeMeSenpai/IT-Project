<?php

$output = '';  
$conn = mysqli_connect("localhost", "root", "", "sigma"); 
$date=$_POST['testDate'];



if(isset($_POST["generate_ActiveAccount"]))
 {
  $month = date("m",strtotime($date));
  $year = date("Y", strtotime($date));
  $sql = "SELECT  * FROM sigma.client inner join sigma.loan 
    ON client.client_id = loan.client_id inner join sigma.payment 
    ON loan.payment_id = payment.payment_id order by loan_type, date_paid ASC";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<table class="table" bordered="1"
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
	                      <td>'.$row['outstanding_balance'].'</td>
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
  $month = date("m",strtotime($date));
  $year = date("Y", strtotime($date));
  $sql = "SELECT  * FROM sigma.client inner join sigma.loan 
    ON client.client_id = loan.client_id inner join sigma.payment 
    ON loan.payment_id = payment.payment_id order by loan_type, date_paid ASC";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<table class="table" bordered="1"
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
                        <td>'.$row['outstanding_balance'].'</td>
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


 if(isset($_POST["generate_LegalAccount"]))
 {
  $month = date("m",strtotime($date));
  $year = date("Y", strtotime($date));
  $sql = "SELECT  * FROM sigma.client inner join sigma.loan 
    ON client.client_id = loan.client_id inner join sigma.payment 
    ON loan.payment_id = payment.payment_id order by loan_type, date_paid ASC";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<table class="table" bordered="1"
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
                        <td>'.$row['outstanding_balance'].'</td>
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

 if(isset($_POST["generate_DelinquentAccount"]))
 {
  $month = date("m",strtotime($date));
  $year = date("Y", strtotime($date));
  $sql = "SELECT  * FROM sigma.client inner join sigma.loan 
    ON client.client_id = loan.client_id inner join sigma.payment 
    ON loan.payment_id = payment.payment_id order by loan_type, date_paid ASC";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<table class="table" bordered="1"
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
                        <td>'.$row['outstanding_balance'].'</td>
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

 if(isset($_POST["generate_Bookings"]))
 {
  $month = date("m",strtotime($date));
  $year = date("Y", strtotime($date));
  $sql = "SELECT  * FROM sigma.client inner join sigma.loan 
    ON client.client_id = loan.client_id inner join sigma.payment 
    ON loan.payment_id = payment.payment_id order by loan_type, date_paid ASC";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<table class="table" bordered="1"
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
                        <td>'.$row['outstanding_balance'].'</td>
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

 if(isset($_POST["generate_excel"]))
 {
  $month = date("m",strtotime($date));
  $year = date("Y", strtotime($date));
  $sql = "SELECT  * FROM sigma.client inner join sigma.loan 
    ON client.client_id = loan.client_id inner join sigma.payment 
    ON loan.payment_id = payment.payment_id order by loan_type, date_paid ASC";

  $result = mysqli_query($conn, $sql);  
      
  

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '<table class="table" bordered="1"
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
                        <td>'.$row['outstanding_balance'].'</td>
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




  ?>