<?php

$connection = new mysqli("localhost","root","","userside");


$catquery = mysqli_query($connection," select *from tbl_category") or die (mysqli_error($connection));

while ($caterow = mysqli_fetch_array($catquery)){
    echo "<a href ='productlisting.php?catid={$caterow['category_id']}'>{$caterow['category_name']}</a> |"; 
}
?>
<form method="get">
    search :<input type="text" name="search">
    <input type="submit" value="search">
</form>
<form method="get">
    start Price :<input type="number" name="price1">
    End price :<input type="number" name ="price2">
    <input type ="submit" value="search">
    
    
    
</form>








<?php
if (isset($_GET['catid']))
{   $scatid =$_GET['catid'];
    $productselectq = mysqli_query($connection,"select * from tbl_product_master where category_id='{$scatid}'") or die (mysqli_error($connection));
}
else if (isset ($_GET['search'])){
    $search = $_GET['search'];
    
    $productselectq = mysqli_query($connection,"select * from tbl_product_master where pro_title like '%$search%'") or die (mysqli_error($connection));
    
}else if (isset ($_GET['price1']) && isset($_GET['price2'])){
    $price1 = $_GET['price1'];
    $price2 = $_GET['price2'];
    $productselectq = mysqli_query($connection,"select * from tbl_product_master where pro_price between $price1 and $price2") or die (mysqli_error($connection));
}




else{
    
    $productselectq = mysqli_query($connection,"select * from tbl_product_master") or die (mysqli_error($connection));
}
$count = mysqli_num_rows($productselectq);
if ($count<1){
    echo "No Records Found";
}
else{
    echo "$count Record found";
}



while($productrow = mysqli_fetch_array($productselectq)){
    echo "<br/><br/>".$productrow['pro_title'];
    echo "<br/>Rs.".$productrow['pro_price'];
    echo "<br/><br/><img  style ='width:100px;' src ='upload/{$productrow['pro_imagepath']}'>";
    
    echo "<br/><br/><br/><a href ='product_detail.php?pid={$productrow['pro_id']}'>Details</a>";
    
    
}














