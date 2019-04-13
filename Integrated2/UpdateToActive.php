<?php
    
    $conn=mysqli_connect('localhost','root','','sigma');
    
    if(isset($_GET['client_id'])) {

        $id = $_GET['client_id'];
                
            $query="UPDATE client SET status='Active' client_id=$id";
            $update=mysqli_query($conn, $query);


    }

?>