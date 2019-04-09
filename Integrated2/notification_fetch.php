<?php

 function notification_data()
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * from client 
      inner join loan on client.client_id = loan.client_id 
      inner join payment on loan.client_id = payment.loan_id 
    WHERE maturity_date < (SELECT curdate()) 
      AND remaining_balance!='0'";

      $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($result))  
        {

  		      $output .= 
  		                 '<li class="list-group-item"><strong>'.$row["first_name"].' '.$row["last_name"].'</strong>
  		                    <br>Maturity date:  '.$row["maturity_date"].'
  		                    <br>Date Today:  '.date("Y-m-d").'
  		                 	  <br>Remaining Balance:'.$row["loan_balance"].' ';
        } 
      return $output;  
 }

 function count_data()  
 {  
      $output = '';
      $count = 0;
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * from client 
      inner join loan on client.client_id = loan.client_id 
      inner join payment on loan.loan_id = payment.loan_id 
      WHERE maturity_date < (SELECT curdate()) 
      AND remaining_balance!='0' 
      group by client.client_id";  
      $result = mysqli_query($conn, $sql);  
      
      while($row = mysqli_fetch_array($result))  
      {
		      $count++;

         $output .= '<span class="number">'.$count.'</span>';
      }  
      return $output;  
 }

  function count_delinquent()  
 {  
      $count = 0;
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * FROM loan
      inner join payment on loan.loan_id = payment.loan_id
      WHERE maturity_date < (SELECT curdate()) 
      AND remaining_balance!='0'";  
      $result = mysqli_query($conn, $sql);  
      
      while($row = mysqli_fetch_array($result))  
      {
       
		      $count++;

      }  
      return $count;  
 }

  function count_ActiveClient()  
 {  

      $count = 0;
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * FROM loan 
      inner join payment on loan.loan_id = payment.loan_id
      WHERE maturity_date > (SELECT curdate())
      AND remaining_balance!='0'";  
      $result = mysqli_query($conn, $sql);  
      
      while($row = mysqli_fetch_array($result))  
      {

		      $count++;

      }  
      return $count;  
 }


  function dashboard_maturity()  
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * from client 
      inner join loan on client.client_id = loan.client_id 
      inner join payment on loan.loan_id = payment.loan_id 
    WHERE maturity_date < (SELECT curdate()) 
      AND remaining_balance!='0'"; 
      $result = mysqli_query($conn, $sql);  
      

            while($row = mysqli_fetch_array($result))  
              {
                      $output .= 
                         '
                           <ul class="mq-comment">
                            <li class="left clearfix"><span class="mq-comment-img pull-left">
                                <div class="mq-comment-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">'.$row["first_name"].' '.$row["last_name"].'</strong>
                                        <small class="pull-right text-muted">
                                        </small>
                                    </div>
                                    <p>
                                       We are Informing you that this client already reach the maturity date and still did not pay their ramaining balance.
                                    </p>
                                </div>
                            </li>
                        </ul>  
                         ';

             }

      return $output;  
 }

   function dashboard_duedate()  
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * from client inner join loan on client.client_id = loan.client_id 
inner join payment on loan.loan_id = payment.loan_id WHERE due_date=(SELECT curdate());";
      $result = mysqli_query($conn, $sql);  
      

            while($row = mysqli_fetch_array($result))  
              {

                      $output .= 
                         '
                           <ul class="mq-comment">
                            <li class="left clearfix"><span class="mq-comment-img pull-left">
                                <div class="mq-comment-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">'.$row["first_name"].' '.$row["last_name"].'</strong>
                                        <small class="pull-right text-muted">
                                        </small>
                                    </div>
                                    <p>
                                       client already due
                                    </p>
                                </div>
                            </li>
                        </ul>  
                         ';


                   

             }  
      return $output;  
 }


 ?>