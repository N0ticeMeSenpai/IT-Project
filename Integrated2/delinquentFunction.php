<?php 

function getDelinquent(){

    $output='';
    $myrow= '';

    $conn=mysqli_connect('localhost','root','','sigma');
    $query = "SELECT * from loan
          inner join client on client.client_id = loan.client_id
          inner join payment on payment.loan_id = loan.loan_id
          inner join co_borrower on client.client_id = co_borrower.client_id
        WHERE maturity_date < (select curdate()) AND remaining_balance!=0 ORDER BY maturity_date DESC";

    $result = mysqli_query($conn, $query);

      while ($id = mysqli_fetch_array($result)) {
        $myrow .='</a></td><td><a href="co_profile.php?co_borrower_id='.$id["co_borrower_id"].'">';

        $query = "SELECT co_borrower.co_borrower_id,client.client_id ,concat(first_name,' ',last_name) as `account_name`,
        group_concat(concat(`co_first_name`, ' ', `co_last_name`) separator '$myrow') as group_name, remaining_balance, maturity_date from loan
        inner join client on client.client_id = loan.client_id
        inner join payment on payment.loan_id = loan.loan_id
        inner join co_borrower on client.client_id = co_borrower.client_id
        WHERE maturity_date < (select curdate()) AND remaining_balance!=0 group by client.client_id ORDER BY maturity_date DESC";

         $result = mysqli_query($conn, $query);
          
              while($row = mysqli_fetch_array($result))
              {
                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["account_name"].'</a></td>
                          <td><a href="co_profile.php?co_borrower_id='.$row["co_borrower_id"].'">'.$row["group_name"].'</a></td>
                          <td>'.$row["remaining_balance"].'</td>
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