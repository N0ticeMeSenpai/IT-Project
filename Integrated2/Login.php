<?php
session_start();
$conn=mysqli_connect('localhost','root','','sigma');

//Getting Input value
if(isset($_POST['login'])){
    
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']); 
    $_SESSION['last_time'] = time();
    
        //Checking Login Detail
        $result=mysqli_query($conn,"SELECT * FROM employee WHERE username='$username' AND password='$password';");
    
        $row=mysqli_fetch_assoc($result);
        $count=mysqli_num_rows($result);
    
        if($count==1){
            
            $_SESSION['user']=array(
                'username'=>$row['username'],
                'password'=>$row['password'],
                'em_position'=>$row['em_position']
            );
            
            $em_position=$_SESSION['user']['em_position'];
            //Redirecting User Based on Role
            switch($em_position){
                case 'Operations Manager':
                    header('location:AdminDashboard.php');
                    break;
                case 'Office Staff':
                    header('location:dashboard.php');
                    break;
            }
        }else{
            $error='Your Username or Password are not Found';
        }
}
?>
<!DOCTYPE html>
<html>

    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>

    <body>
        <div class="container-fluid no-padding">
            <div class="container">
                <div class="login-page">
                    <div class="form">
                       
                        <img class="my-img pb-3" src="img/sigma.png">
                        <form class="login-form" method="POST">
                            <input type="text" placeholder="username" name="username" required/>
                            <input type="password" placeholder="password" name="password" required/>
                            
                            <button name="login" >login</button>
                        </form>
                        <?php if(isset($error)){ echo $error; }?>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
