<?php
$connection = new mysqli("localhost","root","","userside");
if (isset($_POST['submitbtn']))
{
    $pro_title	 = $_POST['pro_title']; 
    $pro_detalis = $_POST['pro_detalis'];
    $pro_price	 = $_POST['pro_price'];
    $pro_imagepath = $_FILES['pro_imagepath']['name'];
    $category_id = $_POST['category_id'];
    $qty = $_POST['qty'];
    $is_active = $_POST['is_active'];
   
    
    $insertq = mysqli_query($connection,"insert into tbl_product_master(pro_title,pro_detalis,pro_price,pro_imagepath,
        category_id,qty,is_active,is_delete) values ('{$pro_title}','{$pro_detalis}','{$pro_price}','{$pro_imagepath	}',
        '{$category_id}','{$qty}','{$is_active}','0')") or die (mysqli_error($connection));
        
    if($insertq){
     $fileupload = move_uploaded_file($_FILES['pro_imagepath']['tmp_name'],"upload/".$pro_imagepath);
     if($fileupload){
         echo "<script>alert('product added')</script>";
     }
        
    }    
        
            
            
    
    
    
}

?>
<html>
    
    <body>
        <form method="post" enctype="multipart/form-data">
            <h1>Product Insert</h1>
                
            <table>
                <tr>
                    <td>product Title </td>
                    <td><input type="text" name="pro_title" placeholder="Enter title" ></td>
                </tr>
                 <tr>
                    <td>product details </td>
                    <td><textarea name="pro_detalis"></textarea>
                </tr>
                 <tr>
                    <td>product price </td>
                    <td><input type="text" name="pro_price" placeholder="Enter price" ></td>
                    
                </tr>
                 <tr>
                    <td>Image </td>
                    <td><input type="file" name="pro_imagepath"  ></td>
                </tr>
                 <tr>
                    <td>sub category </td>
                    <td>
                        <?php
                        $categoryq = mysqli_query($connection,"select *from tbl_category") or die (mysqli_error($connection));
                        echo "<select name ='category_id'>";
                        while ($caterow = mysqli_fetch_array($categoryq)){
                            echo "<option value = '{$caterow['category_id']}'> {$caterow['category_name']}</option>";
                        }
                        echo "</select>";
                        ?>
                    </td>
                
                 <tr>
                    <td>product Qty </td>
                    <td><input type="text" name="qty" placeholder="Enter qty" ></td>
                </tr>
                </tr>
                <td>Is_Active</td>
                <td><select name="is_active">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    
                    </select></td>
           
               
           
           </tr> 
           <tr>
               <td></td>
               <td><input type="submit" name="submitbtn" value="Add product"></td>
           </tr>
        </table>
        </form>
    </body>
    
</html>