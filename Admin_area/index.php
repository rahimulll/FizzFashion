<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style> 
    .body{
      overflow-x:hidden;
    }
    .img-fluid{
        width: 1500px;
        height: 650px;
        object-fit: contain;
    } 

    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center ">
            <div class="col-lg-6 col-lg-5">
                <img src="../images/admin_login.jpg" alt="Admin Login" class="img-fluid">
            </div>
            <div class="col-lg-6 col-lg-4">
                <form action="" method="post">
                    <div class="form-outline w-50 m-auto mb-4">
                        <label for="username" class="form-label"><b>Username</b></label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required="required" class="form-control">
                    </div>
                    <div class="form-outline w-50 m-auto mb-4">
                        <label for="password" class="form-label"><b>Password</b></label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required="required" class="form-control">
                        <p class="message"> <a href="#" class="text-info mt-2 pt-2">Forgot password</a></p>
                    </div>
                    <div class="form-outline w-50 m-auto mb-4">
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                        <p class="medium fw-bold mt-2 pt-1 ">Don't have an account? <a class="text-success" href="admin_registration.php"><b>Register</b></a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<!-- Php code -->
<?php
if(isset($_POST['admin_login'])){
    $admin_adminname=$_POST['username'];
    $admin_password=$_POST['password'];

    $select_query="SELECT * FROM `admin_table` WHERE adminname='$admin_adminname'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);

    if($row_count>0){
        if(password_verify($admin_password, $row_data['admin_password'])){
            $_SESSION['adminname']=$admin_adminname;
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('admin_profile.php' , '_self')</script>";
        } else {
            echo "<script>alert('Invalid Password')</script>";
        }
    } else {
        echo "<script>alert('Invalid Admin Name')</script>";
    }
}
?>
