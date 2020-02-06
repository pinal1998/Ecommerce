<?php

$connection = new mysqli("localhost","root","","userside");


if ($_POST)
    
{
    $name=$_POST['user_name'];
    $gender = $_POST['user_gender'];
    $mobile = $_POST['user_mobile'];
    $password =$_POST['user_password'];
    $email=$_POST['user_email'];
    
    $insertq = mysqli_query($connection,"insert into tbl_user (user_name,user_gender,user_mobile,user_password
     ,user_email)values('{$name}','{$gender}','{$mobile}','{$password}','{$email}')") or die (mysqli_error($connection));
   if ($insertq){
       echo "<script>alert('Registration success');</script>";
       header("location:login.php");
   }  else{
       echo "<script>alert('failed ');</script>";
   }    
    
} 
?>

<html>
    <body>
    <center>
    <titlte> REGISTRATION FORM  </titlte>
    
        <table colspan ="6" align ="center" bgcolor =" darkgray">
        <form method="post">
            
            
            <tr>
                <td>User Name</td>
                <td><input type="text"  name="user_name"  placeholder="Enter Your Name" required="true" ><br></td>
            </tr>
            
            
            <tr>
                <td> User gender</td>
                <td> <input type ="radio" name="user_gender" value="male">male
                    <input type = "radio" name="user_gender" value="female">female<br></td>
            </tr>
            
            <tr>
                <td>Contact No</td>
                <td><input type="number" name ="user_mobile" placeholder="Enter Your Number" required="true"></td>
            </tr>
            <tr>
                <td>User Password</td>
                <td><input type="password" name ="user_password" placeholder="Enter Your password" required="true"></td>
            </tr>
            <tr>
                <td> User Email</td>
                <td><input type="email" name="user_email" placeholder="Enter Your Email" required="true" ></td>
            </tr>       
                
            
                
                
     
            <td>  <input type ="submit" name="submit"></td>
        </table>
            </center>
        </form>
    </body>
</html>