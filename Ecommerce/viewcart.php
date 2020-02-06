<?php

session_start();
$connection = new mysqli("localhost","root","","userside");

if (isset($_GET['id'])){
    
    $id = $_GET['id'];
    unset($_SESSION['productcart'][$id]);
    unset($_SESSION['qtycart'][$id]);
}
if (isset($_SESSION['productcart']) && !empty($_SESSION['productcart'])){

echo "<table align='center' width='50%'>";

echo "<tr>";

echo "<br/><th>#</th>";
echo "<br/><th>Title</th>";
echo "<th>Price</th>";
echo "<th>Qty</th>";
echo "<th>Image</th>";
echo "<th>Total</th>";
echo "</tr>";


$i = 0;

$grangtotal = array();

foreach($_SESSION['productcart'] as $key => $value){
    $i++;
    $productq = mysqli_query($connection,"select * from tbl_product_master where pro_id='{$value}'") or  die (mysqli_error($connection));
    $productdetails = mysqli_fetch_array($productq);
    
    $qty = $_SESSION['qtycart'][$key];
    $subtotaltemp = $productdetails['pro_price'] * $qty;
    
  echo "<tr>";
  
  echo "<td>$i</td>";
  echo "<td>{$productdetails['pro_title']}</td>";
  echo "<td>{$productdetails['pro_price']}</td>";
  echo "<td>$qty</td>";
  echo "<td><img src='upload/{$productdetails['pro_imagepath']}' style='width:50px;'></td>";
  echo "<td>$subtotaltemp</td>";
  echo "<td><a href ='?id=$key'>Remove</a></td>";
  echo "</tr>";
  
  $grandtotal[]=$subtotaltemp;
    
    
    
}
$finalsum = array_sum($grandtotal);
echo "<tr>";

echo "<td></td>";
echo "<td></td>"; echo "<td></td>"; echo "<td></td>"; echo "<td></td>";
echo "<td>$finalsum</td>";



echo "</tr>";
echo "</table>";
echo "<a href ='productlisting.php'>Buy Products</a>";
} else{
    echo "cart is Empty";
    echo "<a href ='productlisting.php'>Buy Products</a>";
}

if (isset($_SESSION['userid'])){
   echo "<a href ='shipping.php'>checkout</a>";
}else{
     echo "<a href ='login.php'>First login</a>";
}

?>