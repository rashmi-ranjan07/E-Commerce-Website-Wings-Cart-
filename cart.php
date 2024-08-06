<!--Connect FIle-->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" contents="IE=edge">
    <meta name="viewreport" contents="width=device-width, initial-scale=1.0">
    <title>Wings Cart-Cart Details</title>
    <!-- bootstrap CSS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file-->
    <link rel="stylesheet" href="style.css">
    <style>
        .logo{
            width:5%;
            height:5%;
        }
        .card-body {
   width: 100%;
   height: 200px;
   object-fit: contain;
}
        .cart_img{
            width:80px;
            height:80px;
        }
        </style>
   </head> 
   <body>
<!-- NAVBAR-->
<div class="container-fluid p-0">
    <!-- first child-->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
  <img src="./images/Logo2.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
    aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
           <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php
          cart_item();
          ?></sup></a>
        </li>
        </ul>
        </div>
        </div>
        </nav>
        </div>

        
<!-- calling cart function-->
<?php
cart();
?>
<!-- second child-->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <ul class="navbar-nav me-auto">

        <?php
        if(!isset($_SESSION['username'])){
            echo" <li class='nav-item'>
            <a class='nav-link' href='#'>Welcome Guest</a>
          </li>";
           }else{
            echo"<li class='nav-item'>
            <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
          </li>";
           }
       if(!isset($_SESSION['username'])){
        echo" <li class='nav-item'>
        <a class='nav-link' href='./users_area/user_login.php'>Login</a>
      </li>";
       }else{
        echo" <li class='nav-item'>
        <a class='nav-link' href='./users_area/logout.php'>Logout</a>
      </li>";

       }
        ?>
  </ul>
</nav>



<!--third child-->
<div class="bg-light">
   <h3 class= "text-center" >Hidden Store</h3>
   <p class= "text-center" >Communications is at the heart of e-commerce
   and community</p>
</div>

<!-- fourth child-table-->
<div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center">
           
            <tbody>
                <!-- php code to display dynamic data-->
                <?php
                global $con;
                $get_ip_add=getIPAddress();
                $total_price=0;
                $cart_query="SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
                $result=mysqli_query($con,$cart_query);
                $result_count=mysqli_num_rows($result);
                if($result_count>0){
                    echo" <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Remove</th>
                        <th colspan='2'>Operations</th>
                    </tr>
                </thead>";
                while($row=mysqli_fetch_array($result)){
                  $product_id=$row['product_id'];
                  $select_products="SELECT * FROM `products` where product_id='$product_id'";
                  $result_products=mysqli_query($con,$select_products);
                  while($row_product_price=mysqli_fetch_array($result_products)){
                    $product_price=array($row_product_price['product_price']);
                    $price_table=$row_product_price['product_price'];
                    $product_title=$row_product_price['product_title'];
                    $product_image1=$row_product_price['product_image1'];
                    $product_values=array_sum($product_price);
                    $total_price+=$product_values;
                ?>      
                <tr>
                    <td><?php echo $product_title?></td>
                    <td><img src="./admin_area/product_images/<?php echo $product_image1?>" alt="" class="cart_img"></td>
                    <td><input type="text" name="qty" class="form-input w-50"></td>
                    <?php
                    $get_ip_add=getIPAddress();
                    if(isset($_POST['update_cart'])){
                        $quantities=$_POST['qty'];
                        $update_cart="UPDATE `cart_details` SET quantity=$quantities WHERE ip_address='$get_ip_add'";
                        $result_products_quantity=mysqli_query($con,$update_cart);
                        $total_price=$total_price*$quantities;
                    }

                    ?>


                    <td><?php echo $price_table?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php  
                    echo $product_id?>"></td>
                    <td>
                       <!--<button class="bg-info px-3 py-2 border-0 mx-3">Update</button>-->
                       <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" 
                       name="update_cart">
                        <!--<button class="bg-info px-3 py-2 border-0 mx-3">Remove</button>-->
                        <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 mx-3" 
                       name="remove_cart">
                    </td>
                    
                </tr>
                <?php
                } 
                }
            }else{
                echo"<h2 class='text-center text-danger'>Cart is empty</h2>";
            }
                ?>
            </tbody>
        </table>
        <!--Subtotal-->
        <div class="d-flex mb-5">
            <?php
            $get_ip_add=getIPAddress();
            $cart_query="SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
            $result=mysqli_query($con,$cart_query);
            $result_count=mysqli_num_rows($result);
            if($result_count>0){
                echo "<h4 class='px-3'>Subtotal:<strong class='text-info'>$total_price/-</strong>
                </h4>
                <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' 
                       name='continue_shopping'>
                <button class='bg-secondary p-3 py-2 border-0'>
                <a href='./users_area/checkout.php' class='text-light'>Checkout</button></a>";
            }else{
                echo"<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' 
                name='continue_shopping'>";
            }
            if(isset($_POST['continue_shopping'])){
                echo "<script>window.open('index.php','_self')</script>";
            }
            ?>
            
        </div>

    </div>
</div>
</form>

<!-- function to remove item-->
<?php
function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart'])){
        foreach($_POST['removeitem'] as $remove_id){
            echo $remove_id;
            $delete_query="DELETE FROM `cart_details` where product_id=$remove_id";
            $run_delete=mysqli_query($con,$delete_query);
            if($run_delete){
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }

}
echo $remove_item=remove_cart_item();
?>

<!-- last child-->
<?php include("./includes/footer.php")?>




<!--Bootstrap JS link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
crossorigin="anonymous"></script>
   </body>
</html>