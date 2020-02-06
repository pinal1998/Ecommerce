<?php
session_start();

echo "hi".$_SESSION['username'];
if (isset($_SESSION['user_name']))
{
    header("location:login.php");
}

 

echo "<a href='shipping.php'>checkout</a> ";
//echo "<a href ='changepassword.php'>change password</a> |";
//echo "<a href='forgotpassword.php'>forgot password</a>";



?>



