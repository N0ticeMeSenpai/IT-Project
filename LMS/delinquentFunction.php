<?php 

function searchDelinquent(){


if(isset($_POST['submit-summary'])){

    
    $output='';
    $conn=mysqli_connect('localhost','root','','sigma');
    $search = mysqli_real_escape_string($conn, $_POST['summaryDelinquents']);
    $query = "SELECT loan.loan_id, first_name, middle_name, last_name, 
    bi_monthly, date_booked, maturity_date, delinquent_status,
    group_concat( DISTINCT(concat(co_first_name,' ',co_middle_name,' ',co_last_name)) separator '<br>') as co_names
    from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.loan_id = payment.loan_id
    inner join co_loan on loan.loan_id = co_loan.loan_id
    inner join co_borrower on co_borrower.co_borrower_id = co_loan.co_borrower_id
    WHERE registered_status='Approved' AND concat(first_name,middle_name,last_name) LIKE '%$search%'  group by loan.loan_id";

    $result = mysqli_query($conn, $query);

     while($row = mysqli_fetch_array($result))
      {      

          $id = $row['loan_id'];

          $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$id";
              $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
              $remaining = $rowRemain['rb'];
              if ($remaining!='0') {
                $output .=  '
                      <tr id='. $row['loan_id'] .'>  
                          <td><a href="Profile.php?loan_id='.$row["loan_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$remaining.'</td>
                          <td data-target="status">'.$row["bi_monthly"].'</td>
                          <td data-target="status">'.$row["co_names"].'</td>';
                          $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) AND loan.loan_id=$id ORDER by payment_info.payment_id ASC;";
                            $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));

            $output .=  '
                        <td data-target="status">'.$datePaidRemarks["date_paid"].'</td>
                        <td data-target="status">'.$row["date_booked"].'</td>
                        <td data-target="status">'.$row["maturity_date"].'</td>
                        <td data-target="status">'.$row["delinquent_status"].'</td>';
                        if ($_SESSION['user']['em_position']=='Operations Manager') {
                          if ($row["maturity_date"] < date('Y-m-d')) {
                                $output .='<td><a href="#" data-role="update" data-id='. $row['loan_id'] .'>Update</a></td>
                                      </tr>';
                        }
                }
             }          
          }
  
      return $output;  

      }
}

?>