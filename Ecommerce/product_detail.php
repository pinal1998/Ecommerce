<?php

$connection = new mysqli("localhost","root","","userside");

$pid = $_GET['pid'];
 
$productq =mysqli_query($connection,"select *from tbl_product_master where pro_id ='{$pid}'") or die (mysqli_error($connection));

$count = mysqli_num_rows($productq);
if ($count <1){
    header ("location:productlisting.php");
}
 $productdetails = mysqli_fetch_array($productq);
 
 echo "<h3>{$productdetails['pro_title']}</h3>";
 echo "<img style='width:110px;' src='upload/{$productdetails['pro_imagepath']}'>";
 $oldprice  = $productdetails['pro_price'] + 150;
 
 echo "<br/>Price :Rs.<b>{$productdetails['pro_price']} Rs.<del>$oldprice</del></b>";
 echo "<br/>Details :{$productdetails['pro_detalis']}";
 
 $categoryq = mysqli_query($connection,"select category_name from  tbl_category where category_id ='{$productdetails['category_id']}'") or die (mysqli_error($connection));
 $categorynamerow = mysqli_fetch_array($categoryq);
 
 echo "<br/> category : {$categorynamerow['category_name']}";
 ?>
<form method = "get" action="cart_process.php ">
    
    <input type="hidden" name="pid" value="<?php echo $pid ?>">
    Qty :<input type="number" name="qty" min="1" max="10">
    
    <input type="submit" value="Add to cart">
    
    
</form>
 
 
 
 
 
 

