<?php

$output = '';  
include 'Include/connection.php';
$search = $_POST['choice'];




//=============================================================================================Active Account

if(isset($_POST["exportSchedule"]))
 {
  
  
   $sql = "SELECT client_id FROM client WHERE concat(first_name,' ',middle_name,' ',last_name) LIKE '%$search%' && registered_status = 'Approved'";
    $client_id = mysqli_fetch_assoc(mysqli_query($conn,$sql));

    
    $sql1 = "SELECT * FROM client join loan on client.client_id = loan.client_id where client.client_id='".$client_id['client_id']."';";
    $result2 = mysqli_query($conn,$sql1);
    $resultCheck2 = mysqli_num_rows($result2);
    if($resultCheck2 > 0){

    $output .= '<table class="table" border=1>
                    <tr>
                    <td colspan=7><strong><font size=2>NAME:</font></strong> 
                      '.$search.'
                      <td>
                    </tr>';
            While ($row1 = mysqli_fetch_assoc($result2)){
                $sql2 = "SELECT due_date,remaining_balance FROM payment WHERE loan_id='".$row1['loan_id']."' ORDER by due_date ASC";
                $result3 = mysqli_query($conn,$sql2);
                $resultCheck1 = mysqli_num_rows($result3);
                
             if($row1['loan_status'] == 'Normal' || $row1['loan_status'] =='Remove'){
            
              $output .= '<thead class="text-white">
                        <tr>
                        <th style="font-size: 15px " colspan=3>
                        <strong>Date Booked: </strong>'.$row1['date_booked'].'
                        </th>
                        <th style="font-size: 15px " colspan=2>
                        <strong>Bi-Monthly Payment:</strong>'.$row1['bi_monthly'].'
                        </th>
                        <th style="font-size: 15px " colspan=3>
                        <strong>Maturity Date:</strong>'.$row1['maturity_date'].'
                        </th>
                        </tr>';
                }else{
            $output .= '
                <thead class="text-white">
                    <tr><th> RESTRUCTURED<th></tr>
                    <tr>
                    <th style="font-size: 15px " colspan=3>
                    <strong>Date Booked: </strong>'.$row1['date_booked'].'
                    </th>
                    <th style="font-size: 15px " colspan=2>
                    <strong>Bi-Monthly Payment:</strong>'.$row1['bi_monthly'].'
                    </th>
                    <th style="font-size: 15px " colspan=3>
                    <strong>Maturity Date:</strong>'.$row1['maturity_date'].'
                    </th>
                    </tr>';
                }
                
                $output .= '
                    <tr>
                      <th class="my-bg">Date</th>
                      <th class="my-bg">Check # EW</th>
                      <th class="my-bg">Ref/OR#</th>
                      <th class="my-bg">Payment</th>
                      <th class="my-bg">Interest</th>
                      <th class="my-bg">Fines</th>
                      <th class="my-bg">Balance</th>
                      <th class="my-bg">Other Income</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">
                <tr>
                    <td></td> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>'.$row1['loan_balance'].'</td>
                </tr>';

                if($resultCheck1 > 0){
                    While ($row3 = mysqli_fetch_assoc($result3)){
                        $sqlForPayInfo = "SELECT payment.payment_id as pid,GROUP_CONCAT(payment_type) as payment_type,GROUP_CONCAT(check_no) as check_no,GROUP_CONCAT(ref_no) as ref_no,SUM(amount_paid) as amount_paid,SUM(interest) as interest,SUM(fines) as fines,GROUP_CONCAT(remarks) as remarks,SUM(other_income) as other_income FROM payment_info JOIN payment ON payment.payment_id = payment_info.payment_id WHERE (status ='updated' || status is NULL) && due_date='".$row3['due_date']."' && loan_id='".$row1['loan_id']."' group by payment.payment_id; ";
                        $rowForPayInfo = mysqli_fetch_assoc(mysqli_query($conn,$sqlForPayInfo));
                        
                        $sqlForCheck = "SELECT check_no from payment_info JOIN payment on payment.payment_id = payment_info.payment_id WHERE loan_id='".$row1['loan_id']."' && check_no IS NOT NULL && status= 'Updated'";
                    
                            $output .='
                            <tr>
                              <td>'.$row3['due_date'].'</td> 
                              <td>'.$rowForPayInfo['check_no'] .'</td>
                              <td>'.$rowForPayInfo['ref_no'].'</td>
                              <td>'.$rowForPayInfo['amount_paid'].'</td>
                              <td>'.$rowForPayInfo['interest'].'</td>
                              <td>'.$rowForPayInfo['fines'].'</td>
                              <td>'.$row3['remaining_balance'].'</td>
                              <td>'.$rowForPayInfo['other_income'].'</td>
                            </tr>
                            </tbody>  ';

                  }
                }
                $output .= '<tr/>';
            }
    }

      $output .= '</table>';
      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=$search.xls");
      echo $output;


  }

 
 ?>
