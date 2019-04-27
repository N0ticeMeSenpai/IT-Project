<?php

function Salary_Registered(){

    $output='';
    include './IncludeSalary/SalaryRegistered.php';
     while($row = mysqli_fetch_array($result))
      {       
                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["contact_no"].'</td>
                          <td>'.$row["payment_type"].'</td>
                          <td>'.$row["loan_balance"].'</td>
                          <td>'.$row["remaining_balance"].'</td>
                          <td>'.$row["date_booked"].'</td>
                          <td>'.$row["maturity_date"].'</td>
                     </tr>';

      }  
      return $output;  



}

function page_SalaryClientRegistered(){
  $output='';
  include './IncludeSalary/SalaryRegistered.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="OFListOfRegisteredClient.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function Business_Registered(){

    $output='';
    include 'IncludeBusiness/BusinessRegistered.php';
     while($row = mysqli_fetch_array($result))
      {       

                $output .=  '
                      <tr>  
                          <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                          <td>'.$row["contact_no"].'</td>
                          <td>'.$row["payment_type"].'</td>
                          <td>'.$row["loan_balance"].'</td>
                          <td>'.$row["remaining_balance"].'</td>
                          <td>'.$row["date_booked"].'</td>
                          <td>'.$row["maturity_date"].'</td>
                     </tr>';

      }  
      return $output;  



}

function page_BusinessClientRegistered(){
  $output='';
  include 'IncludeBusiness/BusinessRegistered.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="OFListOfRegisteredClient.php?BusinessPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

//---------------------------------------------------------Active Account--------------------------------------------------
function Salary_ActiveAccount(){

    $output='';
    include './IncludeSalary/SalaryActiveAccount.php';


         while($row = mysqli_fetch_array($result))
          {

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
          if ($remaining!='0') {
            $output .=  '
                  <tr id='. $row['client_id'] .'>  
                      <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                      <td>'.$remaining.'</td>';

                      $query1="SELECT group_concat(remarks) as remarks from loan
                        inner join payment on loan.loan_id = payment.loan_id
                        join payment_info on payment.payment_id = payment_info.payment_id
                        WHERE (maturity_date > (select curdate())) AND 
                        (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                        $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

              $output .=  '<td>'.$row1["remarks"].'</td>
                      <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                  </tr>';
            }
        }
      return $output;

}

function page_Salary(){
  $output='';
  include './IncludeSalary/SalaryActiveAccount.php';
  while($row = mysqli_fetch_array($result))
    {
    $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
    $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
    $remaining = $rowRemain['rb'];

    if ($remaining!='0') {
      for ($page=1;$page<=$number_of_pages;$page++) {
        $output .= '<li><a href="SORActiveAccount.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
      }
    }
  }
      return $output;
}

function Business_ActiveAccount(){

    $output='';
    include 'IncludeBusiness/BusinessActiveAccount.php';

     while($row = mysqli_fetch_array($result))
      {       
        
        if($_SESSION['user']['em_position']=='Operations Manager'){

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td><a href="#" data-role="update" data-id='. $row['client_id'] .'>Update</a></td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }

          }
          elseif ($_SESSION['user']['em_position']=='Office Staff') {

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }
          }      

        }  
      return $output;  
}

function page_Business(){
  $output='';
  include 'IncludeBusiness/BusinessActiveAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveAccount.php?BusinessPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}


//-----------------------------ActiveDelinquentAccount


function Salary_ActiveDelinquentAccount(){

    $output='';
    include './IncludeSalary/SalaryActiveDelinquentAccount.php';
     while($row = mysqli_fetch_array($result))
      {       
        
        if($_SESSION['user']['em_position']=='Operations Manager'){

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td><a href="#" data-role="update" data-id='. $row['loan_id'] .'>Update</a></td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }

          }
          elseif ($_SESSION['user']['em_position']=='Office Staff') {

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }
          }      

        }  
      return $output;

}

function page_ActiveDelinquentSalary(){
  $output='';
  include './IncludeSalary/SalaryActiveDelinquentAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveDelinquentAccount.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function Business_ActiveDelinquentAccount(){

    $output='';
    include 'IncludeBusiness/BusinessActiveDelinquentAccount.php';

     while($row = mysqli_fetch_array($result))
      {       
        
        if($_SESSION['user']['em_position']=='Operations Manager'){

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td><a href="#" data-role="update" data-id='. $row['client_id'] .'>Update</a></td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }

          }
          elseif ($_SESSION['user']['em_position']=='Office Staff') {

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }
          }      

        }
      return $output;  
}

function page_ActiveDelinquentBusiness(){
  $output='';
  include 'IncludeBusiness/BusinessActiveDelinquentAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveDelinquentAccount.php?BusinessPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

//---------------------------------------------- Active Legal Account--------------------------------------------------

function Salary_ActiveLegalAccount(){

    $output='';
    include './IncludeSalary/SalaryActiveLegalAccount.php';
     while($row = mysqli_fetch_array($result))
      {       
        
        if($_SESSION['user']['em_position']=='Operations Manager'){

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td><a href="#" data-role="update" data-id='. $row['client_id'] .'>Update</a></td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }

          }
          elseif ($_SESSION['user']['em_position']=='Office Staff') {

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }
          }      

        }  
      return $output;
}

function page_SalaryLegal(){
  $output='';
  include './IncludeSalary/SalaryActiveLegalAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveLegalAccount.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function Business_ActiveLegalAccount(){

    $output='';
    include 'IncludeBusiness/BusinessActiveLegalAccount.php';

     while($row = mysqli_fetch_array($result))
      {       
        
        if($_SESSION['user']['em_position']=='Operations Manager'){

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td><a href="#" data-role="update" data-id='. $row['client_id'] .'>Update</a></td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }

          }
          elseif ($_SESSION['user']['em_position']=='Office Staff') {

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }
          }      

        }    
      return $output;  
}

function page_BusinessLegal(){
  $output='';
  include 'IncludeBusiness/BusinessActiveLegalAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORActiveLegalAccount.php?BusinessPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

//------------------------ Delinquent Account------------------

function Salary_DelinquentAccount(){

 $output='';
    include './IncludeSalary/SalaryDelinquentAccount.php';
     while($row = mysqli_fetch_array($result))
      {       
        
        if($_SESSION['user']['em_position']=='Operations Manager'){

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td><a href="#" data-role="update" data-id='. $row['client_id'] .'>Update</a></td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }

          }
          elseif ($_SESSION['user']['em_position']=='Office Staff') {

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }
          }      

        }  
      return $output;

}

function page_DelinquentSalary(){
  $output='';
  include './IncludeSalary/SalaryDelinquentAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORDelinquentAccount.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

function Business_DelinquentAccount(){

    $output='';
    include 'IncludeBusiness/BusinessDelinquentAccount.php';

     while($row = mysqli_fetch_array($result))
      {       
        
        if($_SESSION['user']['em_position']=='Operations Manager'){

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td><a href="#" data-role="update" data-id='. $row['client_id'] .'>Update</a></td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }

          }
          elseif ($_SESSION['user']['em_position']=='Office Staff') {

            $sqlForRemain = "SELECT (loan_balance+COALESCE(SUM(fines),0)+COALESCE(SUM(interest),0)-COALESCE((SUM(amount_paid)),0)) as rb FROM payment JOIN payment_info ON payment_info.payment_id = payment.payment_id JOIN loan ON payment.loan_id=loan.loan_id WHERE status='updated' && payment.loan_id=".$row['loan_id']."";
                $rowRemain = mysqli_fetch_assoc(mysqli_query($conn,$sqlForRemain));  
                $remaining = $rowRemain['rb'];
                if ($remaining!='0') {
                  $output .=  '
                        <tr id='. $row['loan_id'] .'>  
                            <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                            <td>'.$remaining.'</td>';

                            $query1="SELECT group_concat(remarks) as remarks from loan
                              inner join payment on loan.loan_id = payment.loan_id
                              join payment_info on payment.payment_id = payment_info.payment_id
                              WHERE (maturity_date > (select curdate())) AND 
                              (loan.loan_type = 'Salary' AND loan.delinquent_status = 'Active') group by loan.loan_id";
                              $row1 = mysqli_fetch_assoc(mysqli_query($conn,$query1));

                    $output .=  '<td>'.$row1["remarks"].'</td>
                            <td class= "hidden-td" data-target="status">'.$row["delinquent_status"].'</td>
                        </tr>';
                  }
          }      

        }
      return $output;  
}

function page_DelinquentBusiness(){
  $output='';
  include 'IncludeBusiness/BusinessDelinquentAccount.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="SORDelinquentAccount.php?BusinessPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

//---------------------------------------List Of Pending-----------------------------

function PendingList(){

    $output='';
    include './IncludeSalary/SalaryPending.php';
     while($row = mysqli_fetch_array($result))
      {       
        $output .=  '
              <tr id='. $row['client_id'] .'>  
                  <td><a href="Profile.php?client_id='.$row["client_id"].'">'.$row["first_name"].' '.$row["middle_name"].' '.$row["last_name"].'</a></td>
                  <td>'.$row["contact_no"].'</td>
                  <td>'.$row["requested_amount"].'</td>
                  <td data-target="registered">'.$row["registered_status"].'</td>
                  <td>'.$row["registered_date"].'</td>
                  <td><a href="ClientLoan.php?client_id='.$row["client_id"].'">Approved</a></td>
                  <td><a href="ClientDenied.php?client_id='.$row["client_id"].'">Denied</a></td>

             </tr>';
      }  
      return $output;

}

function page_pending(){
  $output='';
  include './IncludeSalary/SalaryPending.php';
    for ($page=1;$page<=$number_of_pages;$page++) {
      $output .= '<li><a href="OPListOfPendingClient.php?SalaryPage=' . $page . '">' . $page . '</a></li>';
    }
    return $output;
}

?>