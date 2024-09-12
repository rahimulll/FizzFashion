<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User-registration</title>
   <!-- Link to Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body{
      overflow-x:hidden;
    }
   </style>
</head>
<body>
  <div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2>
    <div id="message" class="text-danger">
      <?php
        if(isset($error_message)){
          echo $error_message;
        }
      ?>
    </div>
    <div class="row d-flex aling-items-center justify-content-center">
      <div class="col-lg-12 col-xl-6">
        <form action="" method="post" enctype="multipart/form-data">

        <!--user name field -->
        <div class="form-outline mb-4 ">
        <label for="user_username"class="form-label">Username</label>
        <input type="text" id="user_username" class="form-control" placeholder="Enter Your User Nmae " 
        autocomplete="off" required="required" name="user_username"/>
        </div>

        <!--user email field -->

        <div class="form-outline mb-4 ">

        <label for="user_email"class="form-label">User email</label>
        <input type="email" id="user_email" class="form-control" placeholder="Enter Your Email " 
        autocomplete="off" required="required" name="user_email"/>
        </div>
        
        <!--user password field -->

        <div class="form-outline mb-4 ">

        <label for="user_password"class="form-label">Password </label>
        <input type="password" id="user_password" class="form-control" placeholder="Enter Your Password " 
        autocomplete="off" required="required" name="user_password"/>
        </div>

        <!--Confirm password field -->
        <div class="form-outline mb-4 ">
        <label for="conf_user_password"class="form-label">Confirm Password </label>
        <input type="password" id="conf_user_password" class="form-control" placeholder="Retype Your Password " 
        autocomplete="off" required="required" name="conf_user_password"/>
        </div>

        <!--Address field -->
        <div class="form-outline mb-4 ">
        <label for="user_address"class="form-label">User Address</label>
        <input type="text" id="user_address" class="form-control" placeholder="Enter Your User Address " 
        autocomplete="off" required="required" name="user_address"/>
        </div>

        <!--Contact field -->
        <div class="form-outline mb-4 ">
        <label for="user_contact"class="form-label">Contact </label>
        <input type="text" id="user_contact" class="form-control" placeholder="Enter Your Contact Number " 
        autocomplete="off" required="required" name="user_contact"/>
        </div>
        <div class="mt-4 pt-2">
        <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_registration">
          <p class="small fw-bold mt-2 pt-1 mb-0">Already Have an Account <a href="user_login.php" class="text-danger">Login </a></p>

        </div>


        </form>
  
      </div>
    </div>
</div>
  
</body>
</html>

<!--php code-->
<?php
if(isset($_POST['user_registration'])){
  $user_username=$_POST['user_username'];
  $user_email=$_POST['user_email'];
  $user_password=$_POST['user_password'];
  $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
  $conf_user_password=$_POST['conf_user_password'];
  $user_address=$_POST['user_address'];
  $user_contact=$_POST['user_contact'];
  $user_ip=getIPAddress();


  // select query
  $select_query="Select * from `user_table` where username='$user_username' or user_email='$user_email'";
  $result=mysqli_query($con,$select_query);
  $rows_count=mysqli_num_rows($result);
  if($rows_count>0){
    echo"<script>aler('Username & Email already exist')</script>";
  }else if($user_password!=$conf_user_password){
    echo"<script>alert('Password do not match')</script>";
  }
  
  else{


    //insert_query
  $insert_query="INSERT INTO user_table (username,user_email,user_password,user_ip,user_address,user_mobile) 
  VALUES ('$user_username','$user_email','$hash_password','$user_ip','$user_address','$user_contact')";

  $sql_execute=mysqli_query($con,$insert_query);
  if($sql_execute){
    echo "<script>alert('Registration Successfull')</script>";
}else{
    die(mysqli_error($con));
}


}


  // selecting cart items
  $select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
  $result_cart=mysqli_query($con,$select_cart_items);
  $rows_count=mysqli_num_rows($result_cart);
  if($rows_count>0){
    $_SESSION['username']=$user_username;
    echo"<script>alert('You have items in your cart')</script>";
    echo"<script>window.open('checkout.php','_self')</script>";
  }else{
    echo"<script>window.open('../index.php','_self')</script>";
  }

}

 ?>