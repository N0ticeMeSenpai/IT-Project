<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
</head>

<body>
    <div id="content">
        <div class="post">
            <h2 class="title">Update Record</h2>
            <p class="meta"><em></em></p>
            <div class="entry">
                <form method="post">
                    Current Password: <br/>
                    <input type="password" name="oldpwd" />
                    <br/> <br/>
                        
                    New Password: <br/>
                    <input type="password" name="newpwd" />
                    <br/> <br/>
                        
                     Confirm New Password: <br/>
                    <input type="password" name="confirmpwd" />
                    <br/> <br/>
                         
                    <input type="submit" name="submit" value="Change password" />
                  </form>      
            </div>
        </div>
    </div>


<?php
    
    
    //Connect to the database
    $conn=mysqli_connect('localhost','root','','sigma');
    
  
    //this block of code is not being execuded.
    if(isset($_SESSION["username"])){
      $username = $_SESSION['username'];
    }
    
    
    if(isset($_POST['submit'])) {
       $oldpwd=$_POST['oldpwd'];
       $newpwd=$_POST['newpwd'];
       $confirmpwd=$_POST['confirmpwd'];

        $query = "SELECT password from employee WHERE username='ofstaff'"; //temp fix for ofstaff ONLY
        $result=mysqli_query($conn,$query); 
        
        while($row=mysqli_fetch_array($result)){
            $pass=$row['password'];
            
            if($pass==$oldpwd){
                
                if($newpwd==$confirmpwd){
                    $q="UPDATE employee SET password='$confirmpwd' WHERE username='ofstaff'"; //tempfix for ofstaff ONLY
                    $update=mysqli_query($conn,$q);
                    
                    if($update){
                        
                        echo "<script>alert['Successfully changed']</script>";
                    }else {
                        echo "<script>alert['New and Confirm password do not match']</script>";
                    }
                }else {
                    echo "<script>alert['Old password do not match!']</script>";
                }
            }else {
                echo"<script>alert['New and Confirm password do not match']</script>";
            }
        }
        
    }
        
?>
    
    
</body>

</html>