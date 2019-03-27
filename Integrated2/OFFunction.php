<?php

function Salary_Registered(){

    $output='';
    include 'SalaryRegistered.php';
     while($row = mysqli_fetch_array($result))
      {       
                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["contact_no"].'</td>
                          <td>'.$row["payment_type"].'</td>
                          <td>'.$row["present_address"].'</td>
                          <td>'.$row["loan_balance"].'</td>
                          <td>'.$row["date_booked"].'</td>
                          <td>'.$row["maturity_date"].'</td>
                     </tr>';

      }  
      return $output;  



}

function Business_Registered(){

    $output='';
    include 'BusinessRegistered.php';
     while($row = mysqli_fetch_array($result))
      {       

                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["contact_no"].'</td>
                          <td>'.$row["payment_type"].'</td>
                          <td>'.$row["present_address"].'</td>
                          <td>'.$row["loan_balance"].'</td>
                          <td>'.$row["date_booked"].'</td>
                          <td>'.$row["maturity_date"].'</td>
                     </tr>';

      }  
      return $output;  



}

function searchRegisteredBusiness(){

if(isset($_POST['submit_RegisteredBusiness'])){

	$output = '';
	$conn=mysqli_connect('localhost','root','','sigma');
	$search = mysqli_real_escape_string($conn, $_POST['searchRegisteredBusiness']);
    $sql = "SELECT 
                *
            FROM
                client
        INNER JOIN
            loan ON client.client_id = loan.client_id
        WHERE (loan_type = 'Business' AND registered_status = 'Approve') AND
                (first_name = '$search'
                    OR last_name = '$search');";

    $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["contact_no"].'</td>
                  <td>'.$row["credit_type"].'</td>
                  <td>'.$row["address"].'</td>
                  <td>'.$row["bank_or_institution"].'</td>
                  <td>'.$row["loan_balance"].'</td>
                  <td>'.$row["date_booked"].'</td>
                  <td>'.$row["maturity_date"].'</td>
             </tr>';
        }


}  
return $output;  

}

function countRegisteredBusiness(){

if(isset($_POST['submit_RegisteredBusiness'])){

	$output = '';
	$conn=mysqli_connect('localhost','root','','sigma');
	$search = mysqli_real_escape_string($conn, $_POST['searchRegisteredBusiness']);
    $sql = "SELECT 
                *
            FROM
                client
        INNER JOIN
            loan ON client.client_id = loan.client_id
        WHERE (loan_type = 'Business' AND registered_status = 'Approve') AND
                (first_name = '$search'
                    OR last_name = '$search');";

    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);

    $output .= "There are ".$queryResult." results !";


}  
return $output;  

}

function searchRegisteredSalary(){

if(isset($_POST['submit_RegisteredSalary'])){

	$output = '';
	$conn=mysqli_connect('localhost','root','','sigma');
	$search = mysqli_real_escape_string($conn, $_POST['searchRegisteredSalary']);
    $sql = "SELECT 
                *
            FROM
                client
        INNER JOIN
            loan ON client.client_id = loan.client_id
        WHERE (loan_type = 'Salary' AND registered_status = 'Approve') AND
                (first_name = '$search'
                    OR last_name = '$search');";

    $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["contact_no"].'</td>
                  <td>'.$row["credit_type"].'</td>
                  <td>'.$row["address"].'</td>
                  <td>'.$row["bank_or_institution"].'</td>
                  <td>'.$row["loan_balance"].'</td>
                  <td>'.$row["date_booked"].'</td>
                  <td>'.$row["maturity_date"].'</td>
             </tr>';
        }


}  
return $output;  

}

function countRegisteredSalary(){

if(isset($_POST['submit_RegisteredSalary'])){

	$output = '';
	$conn=mysqli_connect('localhost','root','','sigma');
	$search = mysqli_real_escape_string($conn, $_POST['searchRegisteredSalary']);
    $sql = "SELECT 
                *
            FROM
                client
        INNER JOIN
            loan ON client.client_id = loan.client_id
        WHERE (loan_type = 'Salary' AND registered_status = 'Approve') AND
                (first_name = '$search'
                    OR last_name = '$search');";

    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);

    $output .= "There are ".$queryResult." results !";


}  
return $output;  

}

//-------------------------Active Account----------------
function Salary_ActiveAccount(){

    $output='';
    include 'SalaryActiveAccount.php';
     while($row = mysqli_fetch_array($result))
      {       
        $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["remaining_balance"].'</td>
                  <td>'.$row["remarks"].'</td>
             </tr>';
      }  
      return $output;

}

function page_Salary(){
  $output='';
  include 'SalaryActiveAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveAccount.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function Business_ActiveAccount(){

    $output='';
    include 'BusinessActiveAccount.php';

     while($row = mysqli_fetch_array($result))
      {       

                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["remaining_balance"].'</td>
                          <td>'.$row["remarks"].'</td>
                     </tr>';


      }  
      return $output;  
}

function page_Business(){
  $output='';
  include 'BusinessActiveAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveAccount.php?BusinessPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function searchActiveAccountBusiness(){

if(isset($_POST['submit_ActiveAccountBusiness'])){

  $output = '';
  $conn=mysqli_connect('localhost','root','','sigma');
  $search = mysqli_real_escape_string($conn, $_POST['searchActiveAccountBusiness']);
    $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    where client.loan_type = 'Business' AND (first_name = '$search' OR last_name='$search')";

    $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $output .=  '
                     <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["remaining_balance"].'</td>
                          <td>'.$row["remarks"].'</td>
                     </tr>';
        }


}  
return $output;  

}

function searchActiveAccountSalary(){

if(isset($_POST['submit_ActiveAccountSalary'])){

  $output = '';
  $conn=mysqli_connect('localhost','root','','sigma');
  $search = mysqli_real_escape_string($conn, $_POST['searchActiveAccountSalary']);
    $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    where client.loan_type = 'Salary' AND (first_name = '$search' OR last_name='$search')";

    $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["remaining_balance"].'</td>
                  <td>'.$row["remarks"].'</td>
             </tr>';
        }


}  
return $output;  

}

//-----------------------------ActiveDelinquentAccount

function Salary_ActiveDelinquentAccount(){

    $output='';
    include 'SalaryActiveDelinquentAccount.php';
     while($row = mysqli_fetch_array($result))
      {       
        $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["remaining_balance"].'</td>
                  <td>'.$row["remarks"].'</td>
             </tr>';
      }  
      return $output;

}

function page_ActiveDelinquentSalary(){
  $output='';
  include 'SalaryActiveDelinquentAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveDelinquentAccount.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function Business_ActiveDelinquentAccount(){

    $output='';
    include 'BusinessActiveDelinquentAccount.php';

     while($row = mysqli_fetch_array($result))
      {       

                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["remaining_balance"].'</td>
                          <td>'.$row["remarks"].'</td>
                     </tr>';

      }  
      return $output;  
}

function page_ActiveDelinquentBusiness(){
  $output='';
  include 'BusinessActiveDelinquentAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveDelinquentAccount.php?BusinessPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function searchActiveDelinquentBusiness(){

if(isset($_POST['submit_ActiveDelinquentBusiness'])){

  $output = '';
  $conn=mysqli_connect('localhost','root','','sigma');
  $search = mysqli_real_escape_string($conn, $_POST['searchActiveDelinquentBusiness']);
    $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    where client.loan_type = 'Business' AND (first_name = '$search' OR last_name='$search')";

    $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $output .=  '
                     <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["remaining_balance"].'</td>
                          <td>'.$row["remarks"].'</td>
                     </tr>';
        }


}  
return $output;  

}

function searchActiveDelinquentSalary(){

if(isset($_POST['submit_ActiveDelinquentSalary'])){

  $output = '';
  $conn=mysqli_connect('localhost','root','','sigma');
  $search = mysqli_real_escape_string($conn, $_POST['searchActiveDelinquentSalary']);
    $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    where client.loan_type = 'Salary' AND (first_name = '$search' OR last_name='$search')";

    $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["remaining_balance"].'</td>
                  <td>'.$row["remarks"].'</td>
             </tr>';
        }


}  
return $output;  

}

//------------------------------ Active Legal Account

function Salary_ActiveLegalAccount(){

    $output='';
    include 'SalaryActiveLegalAccount.php';
     while($row = mysqli_fetch_array($result))
      {       
        $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["remaining_balance"].'</td>
                  <td>'.$row["remarks"].'</td>
             </tr>';
      }  
      return $output;

}

function page_SalaryLegal(){
  $output='';
  include 'SalaryActiveLegalAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveLegalAccount.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function Business_ActiveLegalAccount(){

    $output='';
    include 'BusinessActiveLegalAccount.php';

     while($row = mysqli_fetch_array($result))
      {       

                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["remaining_balance"].'</td>
                          <td>'.$row["remarks"].'</td>
                     </tr>';


      }  
      return $output;  
}

function page_BusinessLegal(){
  $output='';
  include 'BusinessActiveLegalAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveLegalAccount.php?BusinessPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function searchActiveLegalAccountBusiness(){

if(isset($_POST['submit_ActiveLegalAccountBusiness'])){

  $output = '';
  $conn=mysqli_connect('localhost','root','','sigma');
  $search = mysqli_real_escape_string($conn, $_POST['searchActiveLegalAccountBusiness']);
    $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    where client.loan_type = 'Business' AND (first_name = '$search' OR last_name='$search')";

    $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $output .=  '
                     <tr>  
                         <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["remaining_balance"].'</td>
                          <td>'.$row["remarks"].'</td>
                     </tr>';
        }


}  
return $output;  

}

function searchActiveLegalAccountSalary(){

if(isset($_POST['submit_ActiveLegalAccountSalary'])){

  $output = '';
  $conn=mysqli_connect('localhost','root','','sigma');
  $search = mysqli_real_escape_string($conn, $_POST['searchActiveLegalAccountSalary']);
    $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    where client.loan_type = 'Salary' AND (first_name = '$search' OR last_name='$search')";

    $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["remaining_balance"].'</td>
                  <td>'.$row["remarks"].'</td>
             </tr>';
        }


}  
return $output;  

}

//------------------------ Delinquent Account------------------

function Salary_DelinquentAccount(){

    $output='';
    include 'SalaryDelinquentAccount.php';
     while($row = mysqli_fetch_array($result))
      {       
        $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["remaining_balance"].'</td>
                  <td>'.$row["remarks"].'</td>
             </tr>';
      }  
      return $output;

}

function page_DelinquentSalary(){
  $output='';
  include 'SalaryDelinquentAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORDelinquentAccount.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function Business_DelinquentAccount(){

    $output='';
    include 'BusinessDelinquentAccount.php';

     while($row = mysqli_fetch_array($result))
      {       

                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["remaining_balance"].'</td>
                          <td>'.$row["remarks"].'</td>
                     </tr>';

      }  
      return $output;  
}

function page_DelinquentBusiness(){
  $output='';
  include 'BusinessDelinquentAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORDelinquentAccount.php?BusinessPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function searchDelinquentBusiness(){

if(isset($_POST['submit_DelinquentBusiness'])){

  $output = '';
  $conn=mysqli_connect('localhost','root','','sigma');
  $search = mysqli_real_escape_string($conn, $_POST['searchDelinquentBusiness']);
    $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    where client.loan_type = 'Business' AND (first_name = '$search' OR last_name='$search')";

    $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $output .=  '
                     <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["remaining_balance"].'</td>
                          <td>'.$row["remarks"].'</td>
                     </tr>';
        }


}  
return $output;  

}

function searchDelinquentSalary(){

if(isset($_POST['submit_DelinquentSalary'])){

  $output = '';
  $conn=mysqli_connect('localhost','root','','sigma');
  $search = mysqli_real_escape_string($conn, $_POST['searchDelinquentSalary']);
    $sql = "SELECT * from client 
    inner join loan on client.client_id = loan.client_id 
    inner join payment on loan.client_id = payment.client_id 
    inner join payment_info on payment.payment_id = payment_info.payment_id
    where client.loan_type = 'Salary' AND (first_name = '$search' OR last_name='$search')";

    $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["remaining_balance"].'</td>
                  <td>'.$row["remarks"].'</td>
             </tr>';
        }


}  
return $output;  

}

//---------------------------------------List Of Pending-----------------------------

function Salary_Pending(){

    $output='';
    include 'SalaryPending.php';
     while($row = mysqli_fetch_array($result))
      {       
        $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["contact_no"].'</td>
                  <td>'.$row["requested_amount"].'</td>
                  <td>'.$row["registered_status"].'</td>
                  <td>'.$row["registered_date"].'</td>
                  <td><a href="OPRegisteredStatus.php?client_id='. $row['client_id'] .'">Update Registered Status<span class="glyphicon glyphicon-eye-open"></span></a><br>
                  <a href="OPDeleteSalaryClient.php?client_id='. $row['client_id'] .'">Delete Client Record<span class="glyphicon glyphicon-trash"></span></a>

                  </td>
             </tr>';
      }  
      return $output;

}

function page_pendingSalary(){
  $output='';
  include 'SalaryPending.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="OPListOfPendingClient.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function Business_Pending(){

    $output='';
    include 'BusinessPending.php';
     while($row = mysqli_fetch_array($result))
      {       
        $output .=  '
              <tr>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["contact_no"].'</td>
                  <td>'.$row["requested_amount"].'</td>
                  <td>'.$row["registered_status"].'</td>
                  <td>'.$row["registered_date"].'</td>
                  <td><a href="OPRegisteredStatus.php?client_id='. $row['client_id'] .'">Update Registered Status<span class="glyphicon glyphicon-eye-open"></span></a><br>
                  <a href="OPDeleteBusinessClient.php?client_id='. $row['client_id'] .'">Delete Client Record<span class="glyphicon glyphicon-trash"></span></a>

                  </td>
             </tr>';
      }  
      return $output;

}

function page_pendingBusiness(){
  $output='';
  include 'BusinessPending.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="OPListOfPendingClient.php?BusinessPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}


?>