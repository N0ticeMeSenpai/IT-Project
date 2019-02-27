<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "sample_delinquent");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM list_of_delinquents";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>id</th>  
                         <th>Name</th>  
                         <th>Coborrower1</th>  
       <th>Coborrower2</th>
       <th>Balance</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["id"].'</td>  
                         <td>'.$row["NAME"].'</td>  
                         <td>'.$row["COBORROWER1"].'</td>  
       <td>'.$row["COBORROWER2"].'</td>  
       <td>'.$row["BALANCE"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>
