<?php


session_start();

$connection= new mysqli("localhost","root","","userside");

if ($_POST)
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    $query=mysqli_query($connection,"select * from tbl_user where user_email='{$email}' and user_password='{$password}'") or
    die (mysqli_error($connection));
    
    $count=mysqli_num_rows($query);
    $row=mysqli_fetch_array($query);
    
    if ($count>0){
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        
        header("location:home.php");
    }else{
        echo "<script>alert('email & password not match.');</script>";
    }
    
}
?>
<html>
    <body>
    <center>
        <title>User Login </title>
            <table boder ="2" align="center" >
                <form method="post">
                    <tr>
            <td>Email </td>  
            <td><input type="text" name="email" placeholder="Enter Email" required="true"></td>
                    </tr>
                    <tr>
            <td>password</td>
            <td><input type ="password" name="password" placeholder="Enter Password" required="true"></td>
            
                    </tr>
                    <tr>
                        <td> <input type="submit" name="Login" value="login"> </td>
                    </tr>
                </form>
            </table>
          
    </center> 
    </body>
</html>