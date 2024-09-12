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
    <title>Admin Registration</title>
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
    <div class="continer-fluid m-3">
        <h2 class="text-center mb-5"> New Admin Registration</h2>
        <div class="row d-flex justify-content-center ">
            <div class="col-lg-6 col-lg-5">
                <img src="../images/admin_registration.jpg" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-lg-4">
                <form action="" method="post">
                    <div class="form-outline w-50 m-auto mb-4">
                        <label for="username" class="form-label"><b>Username</b></label>
                        <input type="text" id="username" name="admin_adminname" placeholder="Enter your username" required="required" class="form-control">
                    </div>
                    <div class="form-outline w-50 m-auto mb-4">
                        <label for="email" class="form-label"><b>Email</b></label>
                        <input type="email" id="email" name="admin_email" placeholder="Enter your email" required="required" class="form-control">
                    </div>
                    <div class="form-outline w-50 m-auto mb-4">
                        <label for="password" class="form-label"><b>Password</b></label>
                        <input type="password" id="password" name="admin_password" placeholder="Enter your password" required="required" class="form-control">
                    </div>
                    <div class="form-outline w-50 m-auto mb-4">
                        <label for="confirm_password" class="form-label"><b>Confirm Password</b></label>
                        <input type="password" id="confirm_password" name="conf_admin_password" placeholder="Enter your confirm password" required="required" class="form-control">
                    </div>
                    <div class="form-outline w-50 m-auto mb-4">
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration" value="Register">
                        <p class="medium fw-bold mt-2 pt-1 ">Already have an account? <a class="text-danger" href="admin_login.php"><b>Login</b></a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- PHP code -->
<?php
if(isset($_POST['admin_registration'])){
    $admin_adminname = $_POST['admin_adminname'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);
    $conf_admin_password = $_POST['conf_admin_password'];

    // select query
    $select_query = "SELECT * FROM `admin_table` WHERE adminname='$admin_adminname' OR admin_email='$admin_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if($rows_count > 0){
        echo "<script>alert('Admin Name & Email already exist')</script>";
    } else if($admin_password != $conf_admin_password){
        echo "<script>alert('Password do not match')</script>";
    } else {
        //insert_query
        $insert_query = "INSERT INTO admin_table (adminname, admin_email, admin_password) 
                         VALUES ('$admin_adminname','$admin_email','$hash_password')";

        $sql_execute = mysqli_query($con, $insert_query);
        if($sql_execute){
            echo "<script>alert('Registration Successful')</script>";
        } else {
            die(mysqli_error($con));
        }
    }
}
?>
