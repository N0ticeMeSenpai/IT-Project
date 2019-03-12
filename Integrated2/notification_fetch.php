<?php

 function notification_data()
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * FROM loan inner join client ON client.client_id = loan.client_id";
      $result = mysqli_query($conn, $sql);  
      
      while($row = mysqli_fetch_array($result))  
      {
	      if ($row["maturity_date"] < date("Y-m-d")&&$row["loan_balance"]!=0){       
		      $output .= 
		                 '
		                      <li class="list-group-item"><strong>'.$row["first_name"].' '.$row["last_name"].'</strong>
		                      <br>
		                      Maturity date:  '.$row["maturity_date"].'
		                      <br>
		                 	  Date Today:  '.date("Y-m-d").'
		                 	  <br>
		                 	  Remaining Balance:'.$row["loan_balance"].' ';

         }
      }  
      return $output;  
 }

 function count_data()  
 {  
      $output = '';
      $count = 0;
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * from client inner join loan on client.client_id = loan.client_id inner join payment on loan.payment_id = payment.payment_id;";  
      $result = mysqli_query($conn, $sql);  
      
      while($row = mysqli_fetch_array($result))  
      {
	      if ($row["maturity_date"] < date("Y-m-d") && $row["loan_balance"] != 0){       
		      $count++;
         }
         $output .= '<span class="number">'.$count.'</span>';
      }  
      return $output;  
 }

  function count_delinquent()  
 {  
      $count = 0;
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * FROM loan";  
      $result = mysqli_query($conn, $sql);  
      
      while($row = mysqli_fetch_array($result))  
      {
	      if ($row["maturity_date"] < date("Y-m-d")&&$row["loan_balance"]!=0){       
		      $count++;
         }
      }  
      return $count;  
 }

  function count_ActiveClient()  
 {  

      $count = 0;
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * FROM loan";  
      $result = mysqli_query($conn, $sql);  
      
      while($row = mysqli_fetch_array($result))  
      {
	      if ($row["maturity_date"] > date("Y-m-d")&&$row["loan_balance"]!=0){       
		      $count++;
         }
      }  
      return $count;  
 }


  function dashboard_maturity()  
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * FROM loan inner join client ON client.client_id = loan.client_id"; 
      $result = mysqli_query($conn, $sql);  
      
      while($row = mysqli_fetch_array($result))  
      {
	      if ($row["maturity_date"] < date("Y-m-d")&&$row["loan_balance"]!=0){       
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
      }  
      return $output;  
 }

   function dashboard_duedate()  
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "sigma");  
      $sql = "SELECT * from client inner join loan on client.client_id = loan.client_id inner join payment on loan.payment_id = payment.payment_id;";
      $result = mysqli_query($conn, $sql);  
      
      while($row = mysqli_fetch_array($result))  
      {
         if ($row["due_date"] == date("Y-m-d")){       
            $output .= 
                       '<ul class="mq-comment">
                               <li class="left clearfix"><span class="mq-comment-img pull-left">
                                   <div class="mq-comment-body clearfix">
                                       <div class="header">
                                           <strong class="primary-font">'.$row["first_name"].' '.$row["last_name"].'</strong>
                                           <small class="pull-right text-muted">
                                           </small>
                                       </div>
                                       <p>
                                          This client are already due
                                       </p>
                                   </div>
                               </li>
                           </ul>
                       ';
         }
      }  
      return $output;  
 }


 ?>