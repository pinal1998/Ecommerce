<?php

session_start();
$connection = new mysqli("localhost","root","","userside");

if($_POST){
    $name =$_POST['text1'];
    $mobile =$_POST['text2'];
    $address =$_POST['text3'];
    $userid =$_SESSION['userid'];
    $currentdate = date('d-m-y');
    
    
    $ordermasterq = mysqli_query($connection,"insert into order_master (order_date,userid,order_status,shippingname,shippingmobile,shippingaddress) values('{$currentdate}','{$userid}','pending','{$name}','{$mobile}','{$address}')") or die (mysqli_error($connection));
    $orderid = mysqli_insert_id($connection);
    
    foreach($_SESSION['productcart'] as $key => $value){
        
    $productq = mysqli_query($connection,"select * from tbl_product_master where pro_id='{$value}'") or  die (mysqli_error($connection));
    $productdetails = mysqli_fetch_array($productq);
    $qty =$_SESSION['qtycart'][$key];
   
    
   $orderq =  mysqli_query($connection,"insert into order_details (order_id,pro_id,qty,pro_price)values('{$orderid}','{$value}','{$qty}',
        '{$productdetails['pro_price']}')") or die (mysqli_error($connection));
        
    
    }
    unset ($_SESSION['productcart']);
    unset ($_SESSION['']);
    unset ($_SESSION['qtycart']);
    
    echo "<script>alert('Thanks order placed');window.location=productlisting.php';</script>";
}

?>
<html>
    <body>
        <form method="post">
            
            <h1>Shipping Info</h1>
                
            
            Name : <input type="text" name="text1">
            <br/>
            Mobile No : <input type="text" name="text2">
            <br/>
            Address : <textarea name="text3"></textarea>
            <br/>
            <input type="submit">
        </form>
    </body>
</html>


