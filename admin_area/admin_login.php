<?php
include('../includes/connect.php');
include("../functions/common_function.php");
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- bootstrap css 1ink -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">
    

    <!-- Font Awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" 
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body{
        overflow: hidden;
    }
    .logo{
        width: 80%;
        height: 100%;
    }
</style>

</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center ">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/Logo1.png" alt="Admin Registration" class="img-fluid logo">
            </div>
    
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username"
                         placeholder="Enter your username" required="required" class="form-control">
                    </div>
                   
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" id="password" name="password"
                         placeholder="Enter your password" required="required" class="form-control">
                    </div>
                    
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration" value="Login">
                    <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="admin_registration.php" class="link-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['admin_login'])){
    $admin_name=$_POST['admin_name'];
    $admin_password=$_POST['admin_password'];

    $select_query="SELECT * FROM `admin_table` WHERE admin_name='$admin_name'";
    $result=mysqli_query($con,$select_query);
    $row_data=mysqli_fetch_assoc($result);
    $row_count=mysqli_num_rows($result);
    
    if($row_count>0){
        $_SESSION['admin_name']=$admin_name;
          if(password_verify($admin_password,$row_data['admin_password'])){
            echo"<script>alert('Login Successful')</script>";
           
        }else{
        echo"<script>alert('Invalid Credentials')</script>";
    }
}else{
    echo"<script>alert('Invalid Credentials')</script>";
   }
}



?>