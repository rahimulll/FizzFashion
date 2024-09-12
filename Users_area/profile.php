<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username']?></title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <style>
    body{
      overflow-x:hidden;
    }
    .profile_img{
    width: 100%;
    height: 100%;
    margin: auto;
    display: block;
}
   </style>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">


        <!-- first child -->
<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class="container-fluid">
        <img src="../images/logo.png" alt=""class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><b>Home</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../display_all.php"><b>Products</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><b>Contact</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><b>Total Price:</b><?php total_cart_price(); ?>/-</a>
                </li>
            </ul>
        </div>
        <form class="d-flex" action="../search_product.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
            </div>
        </form>
    </div>
</nav>



<!-- third child-->
<div class="bg-warning">
    <h3 class="text-center text-light"><b>Welcome <span class='text-success'><?php echo $_SESSION['username']?></span> to our online store <span class='text-danger'>FIZZ FASHION</span></b></h3>
    <p class="text-center text-dark">Communication is at the heart of E-commerce and community</p>
</div>


<!-- Forth child -->
<div class="row">
    <div class="col-md-2 p-0">
        <ul class="navbar-nav bg-secondary text-center">
                <li class="nav-item bg-info">
                    <a class="nav-link text-light" href="#"><h3>My Profile</h3></a>
                </li>
                <li class="nav-item bg-info">
                    <img src="../Images/user.png" class="profile_img" alt="">
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?my_orders"><h5>My Orders</h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php"><h5>Pending Orders</h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?edit_account"><h5>Edit Account</h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile.php?delete_account"><h5>Delete Account</h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="user_logout.php"><h5>Logout</h5></a>
                </li>
        </ul>
    </div>
    <!-- Edit orders -->

    <div class="col-md-10 text-center">
        <?php 
        get_user_order_details(); 
        
        if(isset($_GET['edit_account'])){
            include('edit_account.php');
        }

        if(isset($_GET['my_orders'])){
            include('my_orders.php');
        }

        if(isset($_GET['delete_account'])){
            include('delete_account.php');
        }
        ?>
    </div>


    <!-- last child-->
    <div class="container-fluid bg-info p-1 text-center footer m-auto">
<p>All rights reserved Designed By &copy;<b><a class="text-dark" href="../MyCV/index.php" target="_blank">RAHIMUL</b></a></p>
     </div> 
</div>

<!-- bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
