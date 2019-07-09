<?php

$output = '';  
include 'Include/connection.php';
$date=$_POST['testDate'];
$myDate = date("F",strtotime($date));
$myDate2 = date("F Y",strtotime($date));
$year = date("Y", strtotime($date));
$month = date("m",strtotime($date));

 //=============================================================================================Legal Account
if(isset($_POST["AgingRecievable"]))
 {
  
    $output='';
    $count1=0;
    $count2=0;
    $count3=0;
    $count4=0;
    $count5=0;
    $count6=0;
    $count7=0;
    $count8=0;
    $count9=0;
    $count10=0;
    $count11=0;
    $count12=0;
    include ('./Include/connection.php');
    $query = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    WHERE loan.delinquent_status = 'Active'
    AND registered_status='Approved' AND loan_status!='Remove' group by loan.loan_id";
     $result = mysqli_query($conn, $query);
    
    $output .= '<table border=1 class="table">
                  <thead class="text-white">
                      <tr>
                        <th colspan = "7" style="font-size:20px;">Aging of Recievable</th>
                      </tr>
                      <tr>
                        <th colspan = "7" style="font-size:15px;">'.date("l, F j, Y").'</th>
                      </tr>
                      <tr>
                          <th class="my-bg text-white">Account Name(moving)</th>
                          <th class="my-bg text-white" >30 Days</th>
                          <th class="my-bg text-white" >60 Days</th>
                          <th class="my-bg text-white" >90 Days</th>
                          <th class="my-bg text-white" >120 Days</th>
                          <th class="my-bg text-white">Date Paid</th>
                          <th class="my-bg text-white" >Remarks</th>
                      </tr>
                  </thead>';
    while($row = mysqli_fetch_array($result))
      {   
      $id = $row['loan_id'];
      $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(other_income),0) + COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$id";
                  $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                  $remaining = $rowRemain['rb'];

          if ($remaining>'0'){

                          $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) AND loan.loan_id=$id AND loan.delinquent_status = 'Active' ORDER by payment_info.payment_id ASC;";
                            $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));
                            $date_paid=$datePaidRemarks['date_paid'];
                            $remarks=$row['maturity_date'];

          if (!empty($date_paid)) {
            
                $query2="SELECT DATE_ADD('$date_paid', INTERVAL 30 DAY) as date_paid FROM sigma.payment_info";
                $interval1 = mysqli_fetch_assoc(mysqli_query($conn,$query2));
                $query3="SELECT DATE_ADD('$date_paid', INTERVAL 60 DAY) as date_paid FROM sigma.payment_info";
                $interval2 = mysqli_fetch_assoc(mysqli_query($conn,$query3));
                $query4="SELECT DATE_ADD('$date_paid', INTERVAL 90 DAY) as date_paid FROM sigma.payment_info";
                $interval3 = mysqli_fetch_assoc(mysqli_query($conn,$query4));
                $query5="SELECT DATE_ADD('$date_paid', INTERVAL 120 DAY) as date_paid FROM sigma.payment_info";
                $interval4 = mysqli_fetch_assoc(mysqli_query($conn,$query5));
                $remarking = htmlspecialchars($remarks);
                $first_name = htmlspecialchars($row["first_name"]);
                $middle_name = htmlspecialchars($row["middle_name"]);
                $last_name = htmlspecialchars($row["last_name"]);


              if ($interval1['date_paid'] >= date("Y-m-d")) {

            $output .='<tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td>'.$remaining.'</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';
              $count1+=$remaining;
              
              }elseif ($interval2['date_paid'] >= date("Y-m-d") AND date("Y-m-d") > $interval1['date_paid']){
              
              $output .=' <tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td></td>
                          <td>'.$remaining.'</td>
                          <td></td>
                          <td></td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';
              $count2+=$remaining;

              }elseif($interval3['date_paid'] >= date("Y-m-d") AND date("Y-m-d") > $interval2['date_paid']){
              
              $output .=' <tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td></td>
                          <td></td>
                          <td>'.$remaining.'</td>
                          <td></td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';             
              $count3+=$remaining;
              }else{
              
              $output .=' <tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>'.$remaining.'</td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';
              $count4+=$remaining;
              }
            }
          }
        }
        $output .='<tr></tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>'.$count1.'</td>
                        <td>'.$count2.'</td>
                        <td>'.$count3.'</td>
                        <td>'.$count4.'</td>
                        <td></td>
                        <td></td>
                    </tr>
                  </table>';

    $query = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    WHERE (maturity_date < (select curdate())
    AND loan.delinquent_status = 'Inactive')
    AND registered_status='Approved' AND loan_status!='Remove' group by loan.loan_id";
     $result = mysqli_query($conn, $query);
    
    $output .= '
              <table border=1 class="table">
                  <tr>
                  </tr>
                  <thead class="text-white">
                      <tr>
                          <th class="my-bg text-white">Account Name (Not Moving)</th>
                          <th class="my-bg text-white" >30 Days</th>
                          <th class="my-bg text-white" >60 Days</th>
                          <th class="my-bg text-white" >90 Days</th>
                          <th class="my-bg text-white" >120 Days</th>
                          <th class="my-bg text-white">Date Paid</th>
                          <th class="my-bg text-white" >Remarks</th>
                      </tr>
                  </thead>';
    while($row = mysqli_fetch_array($result))
      {   
      $id = $row['loan_id'];
      $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(other_income),0) + COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$id";
                  $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                  $remaining = $rowRemain['rb'];

          if ($remaining>'0'){

                          $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) AND loan.loan_id=$id AND loan.delinquent_status = 'Inactive' ORDER by payment_info.payment_id ASC;";
                            $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));
                            $date_paid=$datePaidRemarks['date_paid'];
                            $remarks=$row['maturity_date'];

          if (!empty($date_paid)) {

                $query6="SELECT DATE_ADD('$date_paid', INTERVAL 30 DAY) as date_paid FROM sigma.payment_info";
                $interval5 = mysqli_fetch_assoc(mysqli_query($conn,$query6));
                $query7="SELECT DATE_ADD('$date_paid', INTERVAL 60 DAY) as date_paid FROM sigma.payment_info";
                $interval6 = mysqli_fetch_assoc(mysqli_query($conn,$query7));
                $query8="SELECT DATE_ADD('$date_paid', INTERVAL 90 DAY) as date_paid FROM sigma.payment_info";
                $interval7 = mysqli_fetch_assoc(mysqli_query($conn,$query8));
                $query9="SELECT DATE_ADD('$date_paid', INTERVAL 120 DAY) as date_paid FROM sigma.payment_info";
                $interval8 = mysqli_fetch_assoc(mysqli_query($conn,$query9));
                $first_name = htmlspecialchars($row["first_name"]);
                $middle_name = htmlspecialchars($row["middle_name"]);
                $last_name = htmlspecialchars($row["last_name"]);

              if ($interval5['date_paid'] >= date("Y-m-d")) {

            $output .='<tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td>'.$remaining.'</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';
              $count5+=$remaining;
              
              }elseif ($interval6['date_paid'] >= date("Y-m-d") AND date("Y-m-d") > $interval5['date_paid']){
              
              $output .=' <tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td></td>
                          <td>'.$remaining.'</td>
                          <td></td>
                          <td></td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';
              $count6+=$remaining;

              }elseif($interval7['date_paid'] >= date("Y-m-d") AND date("Y-m-d") > $interval6['date_paid']){
              
              $output .=' <tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td></td>
                          <td></td>
                          <td>'.$remaining.'</td>
                          <td></td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';             
              $count7+=$remaining;
              }else{
              
              $output .=' <tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>'.$remaining.'</td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';
              $count8+=$remaining;
              }
            }
          }
        }
        $output .='<tr></tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>'.$count5.'</td>
                        <td>'.$count6.'</td>
                        <td>'.$count7.'</td>
                        <td>'.$count8.'</td>
                        <td></td>
                        <td></td>
                    </tr>
                  </table>';

//==========================================================================================Legal
    $query = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    WHERE loan.delinquent_status = 'Legal'
    AND registered_status='Approved' AND loan_status!='Remove' group by loan.loan_id";
     $result = mysqli_query($conn, $query);
    
    $output .= '<table border=1 class="table">
                  <tr>
                  </tr>
                  <thead class="text-white">
                      <tr>
                          <th class="my-bg text-white">Account Name (Legal)</th>
                          <th class="my-bg text-white" >30 Days</th>
                          <th class="my-bg text-white" >60 Days</th>
                          <th class="my-bg text-white" >90 Days</th>
                          <th class="my-bg text-white" >120 Days</th>
                          <th class="my-bg text-white">Date Paid</th>
                          <th class="my-bg text-white" >Remarks</th>
                      </tr>
                  </thead>';
    while($row = mysqli_fetch_array($result))
      {   
      $id = $row['loan_id'];
      $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(other_income),0) + COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$id";
                  $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                  $remaining = $rowRemain['rb'];

          if ($remaining>'0'){

                          $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) AND loan.loan_id=$id AND loan.delinquent_status = 'Legal' ORDER by payment_info.payment_id ASC;";
                            $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));
                            $date_paid=$datePaidRemarks['date_paid'];
                            $remarks=$row['maturity_date'];


          if (!empty($date_paid)) {

                $query10="SELECT DATE_ADD('$date_paid', INTERVAL 30 DAY) as date_paid FROM sigma.payment_info";
                $interval9 = mysqli_fetch_assoc(mysqli_query($conn,$query10));
                $query11="SELECT DATE_ADD('$date_paid', INTERVAL 60 DAY) as date_paid FROM sigma.payment_info";
                $interval10 = mysqli_fetch_assoc(mysqli_query($conn,$query11));
                $query12="SELECT DATE_ADD('$date_paid', INTERVAL 90 DAY) as date_paid FROM sigma.payment_info";
                $interval11 = mysqli_fetch_assoc(mysqli_query($conn,$query12));
                $query13="SELECT DATE_ADD('$date_paid', INTERVAL 120 DAY) as date_paid FROM sigma.payment_info";
                $interval12 = mysqli_fetch_assoc(mysqli_query($conn,$query13));
                $first_name = htmlspecialchars($row["first_name"]);
                $middle_name = htmlspecialchars($row["middle_name"]);
                $last_name = htmlspecialchars($row["last_name"]);

              if ($interval9['date_paid'] >= date("Y-m-d")) {

            $output .='<tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td>'.$remaining.'</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';
              $count9+=$remaining;
              
              }elseif ($interval10['date_paid'] >= date("Y-m-d") AND date("Y-m-d") > $interval9['date_paid']){
              
              $output .=' <tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td></td>
                          <td>'.$remaining.'</td>
                          <td></td>
                          <td></td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';
              $count10+=$remaining;

              }elseif($interval11['date_paid'] >= date("Y-m-d") AND date("Y-m-d") > $interval10['date_paid']){
              
              $output .=' <tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td></td>
                          <td></td>
                          <td>'.$remaining.'</td>
                          <td></td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';             
              $count11+=$remaining;
              }else{
              
              $output .=' <tr>
                          <td>'.$first_name.' '.$middle_name.' '.$last_name.'</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>'.$remaining.'</td>
                          <td>'.$date_paid.'</td>
                          <td>'.$row["loan_remarks"].'</td>
                      </tr>';
              $count12+=$remaining;
              }
            }
          }
        }
        $output .='<tr></tr>
                  <tr>
                      <td>TOTAL</td>
                      <td>'.$count9.'</td>
                      <td>'.$count10.'</td>
                      <td>'.$count11.'</td>
                      <td>'.$count12.'</td>
                      <td></td>
                      <td></td>
                  </tr>';


        $sum1 = $count1 + $count5 + $count9;
        $sum2 = $count2 + $count6 + $count10;
        $sum3 = $count3 + $count7 + $count11;
        $sum4 = $count4 + $count8 + $count12;
        $totalSum=$sum1+$sum2+$sum3+$sum4;
        $output .='
                  <tr></tr>
                  <tr>
                      <td>TOTAL</td>
                      <td>'.$sum1.'</td>
                      <td>'.$sum2.'</td>
                      <td>'.$sum3.'</td>
                      <td>'.$sum4.'</td>
                      <td>'.$totalSum.'<td>
                  </tr>
                </table>';



      header("Content-Type:application/xls");
      header("Content-Disposition: attachment; filename=AgingOfReceivables.xls");
      echo $output;


 }

 //================================================================= Summary of Bookings

 if(isset($_POST["generate_Bookings"]))
 {


  $query = "SELECT *  from client 
        INNER JOIN loan on client.client_id = loan.client_id
        group by loan.loan_id";

        $result = mysqli_query($conn, $query);

      $output .= '
                  <table>
                    <tr>
                        <th align="left" colspan = "10">
                          <font size=5 face=algerian>
                            <b>SFS SIGMA CREDIT INCORPORATION</b>
                          </font>
                        </th>
                    </tr>
                    <tr>
                        <th align="left" colspan = "10">
                          <font size=4 face=arial>
                            <b><i>SUMMARY OF BOOKINGS -for the month of '.$myDate2.'</i></b>
                          </font>
                        </th>
                    </tr>
                  </table>
                  <table border=1 class="table">
                    <tr>
                        <th>Account name</th>
                        <th>Date Booked</th>
                        <th>Maturity date</th>
                        <th>Original amount</th>
                        <th>Net Proceeds</th>
                        <th>Interest earned(1 Month)</th>
                        <th>Interest earned(3 Month)</th>
                        <th>Service handling fee</th>
                        <th>Other Income</th>
                        <th>Loan Type</th>
                    </tr>';

     while($row = mysqli_fetch_array($result))
      {    
         
         $loan_id = $row['loan_id'];
        $sql ="SELECT first_name, last_name, middle_name, loan_type ,date_booked, maturity_date, original_amount, 
        loan_balance as net_proceeds, ROUND(original_amount * 0.05 * (COUNT(due_date)/2), 2) as Interest_earned_1,
          ROUND(original_amount * 0.15 * (COUNT(due_date)/2), 2) as Interest_earned_3,
        original_amount*0.03 as service_handling_fee, insurance +coalesce((SELECT SUM(other_income) from payment_info WHERE payment.loan_id='$loan_id' && status='Updated'),0) as other_income  from client 
        INNER JOIN loan on client.client_id = loan.client_id
        INNER JOIN payment on payment.loan_id = loan.loan_id 
        WHERE loan.loan_id='$loan_id'";
        $rowSummary = mysqli_fetch_assoc(mysqli_query($conn,$sql));
        
        $first_name = htmlspecialchars($rowSummary["first_name"]);
        $middle_name = htmlspecialchars($rowSummary["middle_name"]);
        $last_name = htmlspecialchars($rowSummary["last_name"]);
        
        if ($month == date("m",strtotime($row["registered_date"])) && 
            $year == date("Y",strtotime($row["registered_date"]))){
            $output .=  '
              <tr>
                  <td>'.$first_name.'  '.$middle_name.' '.$last_name.'</td>
                  <td>'.$rowSummary["date_booked"].'</td>
                  <td>'.$rowSummary["maturity_date"].'</td>
                  <td>'.$rowSummary["original_amount"].'</td>
                  <td>'.$rowSummary["net_proceeds"].'</td>
                  <td>'.$rowSummary["Interest_earned_1"].'</td>
                  <td>'.$rowSummary["Interest_earned_3"].'</td>
                  <td>'.$rowSummary["service_handling_fee"].'</td>
                  <td>'.$rowSummary["other_income"].'</td>
                  <td>'.$rowSummary["loan_type"].'</td>
             </tr>';

        }

      } 

        $output .= '</table>';
        header("Content-Type:application/xls");
        header("Content-Disposition: attachment; filename=SummaryOfBookings-".$myDate.".xls");
        echo $output;


    }





//--------------------------------------Generate Summary report-----------------------------------------------------------------

 if(isset($_POST["SummaryOfRecievable"]))
 {
  
//==============================================Active Account
    $count = 0;
    $count1 = 0;
    $count2 = 0;
    $count3 = 0;
    $count4 = 0;
   $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    WHERE (maturity_date > (select curdate())) 
    AND (loan.delinquent_status = 'Active' 
    AND registered_status='Approved' AND loan_status!='Remove') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  
      

    $output .= '<table class="table" border=1
                    <tr>
                        <th colspan = "3">SUMMARY OF RECEIVABLE</th>
                    </tr>
                    <tr>
                        <th colspan = "3">'.date("d-M-Y").'</th>
                    </tr>
                    <tr>
                        <th colspan = "3">Active Account</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result))
      {

      $id = $row['loan_id'];
      $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(other_income),0) + COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$id";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                $first_name = htmlspecialchars($row["first_name"]);
                $middle_name = htmlspecialchars($row["middle_name"]);
                $last_name = htmlspecialchars($row["last_name"]);
                $loan_remarks = htmlspecialchars($row["loan_remarks"]);

          if ($remaining > 0) {
            $output .='<tr> 
                        <td>'.$first_name." ".$last_name.'</td>
                        <td>'.$remaining.'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date > (select curdate()) AND loan.loan_id=$id) AND loan.delinquent_status = 'Active' ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='<td>'.$loan_remarks.'</td>
                    </tr>';
          $count+=$remaining;
          $count1+=$remaining;
        }
      }
          $output.="
            <tr>
                <td>TOTAL:</td>
                <td>".$count1."</td>
                <td></td>
            </tr>";
     
//==============================================Active Delinquent
  $sql1 = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    WHERE (maturity_date < (select curdate())) 
    AND (loan.delinquent_status = 'Active' 
    AND registered_status='Approved' AND loan_status!='Remove') group by loan.loan_id";

  $result1 = mysqli_query($conn, $sql1);  
      
  


    $output .= '<table class="table" border=1
                    <tr>
                    </tr>
                    <tr>
                        <th colspan = "3">Active Delinquent</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result1))
      {

      $id = $row['loan_id'];
      $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(other_income),0) + COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$id";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

                $first_name = htmlspecialchars($row["first_name"]);
                $middle_name = htmlspecialchars($row["middle_name"]);
                $last_name = htmlspecialchars($row["last_name"]);
                $loan_remarks = htmlspecialchars($row["loan_remarks"]);
          
          if ($remaining > 0) {
            $output .='<tr>
                        <td>'.$first_name." ".$last_name.'</td>
                        <td>'.$remaining.'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date < (select curdate()) AND loan.loan_id=$id) AND loan.delinquent_status = 'Active' ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='<td>'.$loan_remarks.'</td>
                    </tr>';
          $count+=$remaining;
          $count2+=$remaining;
        }
      }
     $output.="
            <tr>
                <td>TOTAL:</td>
                <td>".$count2."</td>
                <td></td>
            </tr>";
//==============================================Delinquent
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    WHERE (maturity_date < (select curdate())) 
    AND (loan.delinquent_status = 'Inactive' 
    AND registered_status='Approved' AND loan_status!='Remove') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  
      
  

    $output .= '<table class="table" border=1>
                    <tr>
                    </tr>
                    <tr>
                        <th colspan = "3">Delinquent</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result))
      {

      $id = $row['loan_id'];
      $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(other_income),0) + COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$id";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

                $first_name = htmlspecialchars($row["first_name"]);
                $middle_name = htmlspecialchars($row["middle_name"]);
                $last_name = htmlspecialchars($row["last_name"]);
                $loan_remarks = htmlspecialchars($row["loan_remarks"]);

            if ($remaining > 0) {
            $output .='<tr>
                        <td>'.$first_name." ".$last_name.'</td>
                        <td>'.$remaining.'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date > (select curdate()) AND loan.loan_id=$id) AND loan.delinquent_status = 'Inactive' ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='
                        <td>'.$loan_remarks.'</td>
                    </tr>';
          $count+=$remaining;
          $count3+=$remaining;
        }
      }
     $output.="
            <tr>
                <td>TOTAL:</td>
                <td>".$count3."</td>
                <td></td>
            </tr>";
  //=================================================== Legal Account
  $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    WHERE (maturity_date < (select curdate())) 
    AND (loan.delinquent_status = 'Legal' 
    AND registered_status='Approved' AND loan_status!='Remove') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  
      
  

    $output .= '<table class="table" border=1>
                    <tr>
                    </tr>
                    <tr>
                        <th colspan = "3">Legal</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Outstanding</th>
                        <th>Remarks</th>
                    </tr>';

      while ($row = mysqli_fetch_array($result))
      {

      $id = $row['loan_id'];
      $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(other_income),0) + COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$id";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];

                $first_name = htmlspecialchars($row["first_name"]);
                $middle_name = htmlspecialchars($row["middle_name"]);
                $last_name = htmlspecialchars($row["last_name"]);
                $loan_remarks = htmlspecialchars($row["loan_remarks"]);

            if ($remaining > 0) {
            $output .='<tr>
                        <td>'.$first_name." ".$last_name.'</td>
                        <td>'.$remaining.'</td>';

                        $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $id && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$id) && (maturity_date > (select curdate()) AND loan.loan_id=$id) AND loan.delinquent_status = 'Legal' ORDER by payment_info.payment_id ASC;";
                          $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

            $output .='<td>'.$loan_remarks.'</td>
                    </tr>';
          
          $count+=$remaining;
          $count4+=$remaining;
        }
      }
     $output.="
            <tr>
                <td>TOTAL:</td>
                <td>".$count4."</td>
                <td></td>
            </tr>";
     $output.="
            <tr>
            </tr>
            <tr>
                <td>TOTAL:</td>
                <td>".$count."</td>
                <td></td>
            </tr>";

      //====================================================== List Of Delinquent

      $output .= '</table>';
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment; filename=SummaryOfReceivables.xls");
      echo $output;


  }


 if(isset($_POST["generate_Delinquents"])) {

        $sql = "SELECT * from client 
                    inner join loan on client.client_id = loan.client_id 
                    WHERE (maturity_date < (select curdate()) 
                    AND registered_status='Approved' AND loan_status!='Remove') group by loan.loan_id";

  $result = mysqli_query($conn, $sql);  


      $output .= '<table class="table" border=1>
                   <tr>
                        <th colspan = "3">List of Delinquent</th>
                    </tr> 
                    <tr>
                        <th>Account Name</th>
                        <th>Co Borrower</th>
                        <th>Co Borrower 2</th>
                        <th>Balance</th>
                        <th>Date</th>
                    </tr>';

    while ($id = mysqli_fetch_assoc($result)) {

      $loanID = $id['loan_id'];

        $query1 = "SELECT loan.loan_id as loan, client.client_id 
        as client,concat(first_name,' ',last_name) as `account_name`,
        maturity_date from loan
        inner join client on client.client_id = loan.client_id
        inner join payment on payment.loan_id = loan.loan_id
        WHERE loan.loan_id = '$loanID' group by loan.loan_id ORDER BY account_name";

      $result1 = mysqli_query($conn, $query1);
      
  
      while($row = mysqli_fetch_assoc($result1))
      { 

      $id = $row['loan'];
      $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(other_income),0) + COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=$id";
          $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
          $remaining = $rowRemain['rb'];

          if ($remaining > 0){
            $output.='
                  <tr>  
                  <td>'.$row["account_name"].'</td>';
 
                  $forCoBorrower = "SELECT co_borrower.co_borrower_id,concat(co_first_name,co_last_name) as name from co_borrower 
                  join co_loan on co_borrower.co_borrower_id = co_loan.co_borrower_id
                  where co_loan.loan_id ='".$row['loan']."'";
                  $coBorrower = mysqli_query($conn, $forCoBorrower);
                  $number_of_results = mysqli_num_rows($coBorrower);
                  while($index = mysqli_fetch_array($coBorrower)){
                    if($number_of_results == 1){

              $output.='
                    <td>'.$index['name'].'</td>
                    <td></td>';

                  }else{

                $output.='
                    <td>'.$index['name'].'</td>';

                  }
            }

            if (empty($number_of_results)) {

            $output.='<td></td>
                      <td></td>';
          }
              $query1="SELECT date_paid,remarks from payment_info JOIN payment ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE payment.loan_id = $loanID && date_paid IS NOT NULL && date_paid=(SELECT MAX(date_paid) from payment_info JOIN payment ON payment_info.payment_id=payment.payment_id WHERE loan_id=$loanID) && (maturity_date > (select curdate()) AND loan.loan_id=$loanID) ORDER by payment_info.payment_id ASC;";
              $datePaidRemarks = mysqli_fetch_assoc(mysqli_query($conn,$query1));  

          $output.='<td>'.$remaining.'</td> 
                    <td>'.$row["maturity_date"].'</td>
             </tr>';
        }
      }
    }

      $output .= '</table>';
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment; filename=List Of Delinquents.xls");
      echo $output;
  }




  ?>
