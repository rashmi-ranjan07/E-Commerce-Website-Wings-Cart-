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
    <title>Wings Cart</title>
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
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Products</a>
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
        <li class="nav-item">
        <a class="nav-link" href="#">Total Price:<?php
          total_cart_price();
          ?>/-</a>
        </li>
        </ul>
        <form class= "d-flex" action="search_product.php" method="get">
          <input class="form-control me-2" type="search" placeholder="Search" 
          aria-label="Search" name="search_data">
          <input type="submit" value="Search" class="btn btn-outline-light" 
          name="search_data_product">
        </form>
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




<!--fourth child-->
<div class="row p-1">
  <div class="col-md-10">
    <!-- products -->
      <div class="row">
  <!--fetching products-->
  <?php
  //calling function
  search_product();
  get_unique_categories();
  get_unique_brands();
  ?>
       
<!--row end-->
</div>
<!--column end-->
</div>
  <div class="col-md-2 bg-secondary p-0">
    <!--Brands to be displayed-->
  <u1 class="navbar-nav me-auto text-center">
    <li class="nav-item bg-info">
<a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
</li>
<?php
//calling function
getbrands();
?>
</u1>
<!-- Categories to be displayed-->
<u2 class="navbar-nav me-auto text-center">
    <li class="nav-item bg-info">
<a href="#" class="nav-link text-light"><h4>Categories</h4></a>
</li>
<?php
//function calling
getcategories();
?>
</u2>
</div>
</div>
</div>
<!-- last child-->
<div class="bg-info p-3 text-center">
    <p>All rights reserved @-Designed by Ranjan-2023</p>
</div> 
  




<!--Bootstrap JS link-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
crossorigin="anonymous"></script>
   </body>
</html>