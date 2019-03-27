<?php 

function getDelinquent(){

    $output='';

    $conn=mysqli_connect('localhost','root','','sigma');
    $query = "SELECT * from loan
              inner join client on client.client_id = loan.client_id 
              inner join occupation on client.client_id = occupation.client_id 
              inner join payment on payment.loan_id = loan.loan_id
              inner join co_borrower on occupation.co_borrower_id = co_borrower.co_borrower_id
              ORDER BY maturity_date DESC";

    $result = mysqli_query($conn, $query);

     while($row = mysqli_fetch_array($result))
      {       
          if ($row["maturity_date"] < date("Y-m-d")&&$row["remaining_balance"]!='0'){

                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["co_first_name"].' '.$row["co_last_name"].'</td>
                          <td>'.$row["loan_balance"].'</td>
                          <td>'.$row["maturity_date"].'</td>
                     </tr>';
          }


      }  
      return $output;  



}

function searchDelinquent(){


if(isset($_POST['submit-delinquents'])){

    
    $output='';
    $conn=mysqli_connect('localhost','root','','sigma');
    $search = mysqli_real_escape_string($conn, $_POST['searchDelinquents']);
    $query = "SELECT * from loan
              inner join client on client.client_id = loan.client_id 
              inner join occupation on client.client_id = occupation.client_id 
              inner join co_borrower on occupation.co_borrower_id = co_borrower.co_borrower_id 
              WHERE (first_name = '$search' OR last_name = '$search') order by maturity_date;";

    $result = mysqli_query($conn, $query);

     while($row = mysqli_fetch_array($result))
      {       
          if ($row["maturity_date"] < date("Y-m-d") && $row["loan_balance"] != '0'){

                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["co_first_name"].' '.$row["co_last_name"].'</td> 
                          <td>'.$row["loan_balance"].'</td>  
                          <td>'.$row["maturity_date"].'</td>
                     </tr>';
          }


      }  
      return $output;  

      }
}
?>