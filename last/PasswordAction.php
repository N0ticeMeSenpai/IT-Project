 <?php



$conn = mysqli_connect('localhost' , 'root' ,'' ,'sigma');

$username = $_POST['username'];
$password = $_POST['password'];
$newpassword = $_POST['newpassword'];
$confirmnewpassword = $_POST['confirmnewpassword'];


$query = "SELECT password FROM employee WHERE username ='$username'";

$result = mysqli_query($conn, $query);

$fetch = mysqli_fetch_assoc(mysqli_query($conn,$query));

 if(empty($result)){
    
        echo "The username you entered does not exist";
    
    }else if($password != $fetch['password']) {

        echo "You entered an incorrect password";
    
    }elseif($newpassword==$confirmnewpassword){
        
        $sql=mysqli_query($conn, "UPDATE employee SET password='$newpassword' where username='$username'");
        echo "Congratulations You have successfully changed your password";
        
   }else{
       
         echo "Passwords do not match";
       
       }
      
?>