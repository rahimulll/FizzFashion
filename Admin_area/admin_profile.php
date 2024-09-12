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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <style> 
    body{
      overflow-x:hidden;
    }
    .admin_image{
    width: 100px;
    object-fit: contain;
    }
    .footer{
    position: absolute;
    bottom: 0;
    }
    .product_img{
        width: 100px;
        object-fit: contain;
    }
    </style>
</head>
<body>
    <!-- navbar -->
<div class="comtainer-fluid p-0">
    <!-- first child -->
    <nav class="navbar nabar-expabd-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="../images/logo.png" alt="" class="logo">
            <nav class="navbar nabar-expabd-lg">
    <ul class="navbae-nav me-auto" style="list-style:none">

    <?php
       if(!isset($_SESSION['adminname'])){
       echo "<li class='nav-item'>
            <a class='nav-link text-danger' href='#'><b>Welcome Guest</b></a></li>";
        }else{
            echo "<li class='nav-item'>
            <a class='nav-link text-danger' href='#'><b>Welcome ".$_SESSION['adminname']."</b></a></li>";
        }


        if(!isset($_SESSION['adminname'])){
            echo "<li class='nav-item'>
           <a class='nav-link text-light' href='index.php'><b>Login</b></a></li>";
        }else{
            echo "<li class='nav-item'>
            <a class='nav-link text-light' href='admin_logout.php'><b>Logout</b></a></li>";
        }

    ?>
    </ul>
            </nav>
        </div>
    </nav>

    <!-- second child -->
    <div class="bg-light">
        <h3 class="text-center text-light bg-dark p-2"><b>Manage Details</b></h3>
    </div>

    <!-- third child -->
    <div class="row">
        <div class="col-md-12 bg-secondary p-1 d-flex aling-items-center">
            <div class="p-3">
                <a href="#"><img src="../images/admin_image.png" alt="" class="admin_image"></a>
                <p class="text-light text-center"><b>Admin</b></p>
            </div>
            <!-- button*10>a.nav-link.text-light.bg-info.my-1 -->
            <div class="button text-center">
                <button class="my-5"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Products</a></button>
                <button><a href="admin_profile.php?view_products" class="nav-link text-light bg-info my-1">View Products</a></button>
                <button><a href="admin_profile.php?insert_category" class="nav-link text-light bg-info my-1">Insert Categories</a></button>
                <button><a href="admin_profile.php?view_category" class="nav-link text-light bg-info my-1">View Categories</a></button>
                <button><a href="admin_profile.php?insert_brands" class="nav-link text-light bg-info my-1">Insert Brands</a></button>
                <button><a href="admin_profile.php?view_brands" class="nav-link text-light bg-info my-1">View Brands</a></button>
                <button><a href="admin_profile.php?list_orders" class="nav-link text-light bg-info my-1">All Order</a></button>
                <button><a href="admin_profile.php?" class="nav-link text-light bg-info my-1">All Payments</a></button>
                <button><a href="admin_profile.php?" class="nav-link text-light bg-info my-1">List Users</a></button>
                <button><a href="admin_logout.php" class="nav-link text-light bg-info my-1">Logout</a></button>
            </div>
        </div>
    </div>



    <!-- forth child -->
    <div class="container my-3">
        <?php   
        if(isset($_GET['insert_category'])){
                include('insert_categories.php');
        }
        if(isset($_GET['insert_brands'])){
            include('insert_brands.php');
        }


        if(isset($_GET['view_products'])){
            include('view_products.php');
        }
        if(isset($_GET['view_category'])){
            include('view_category.php');
        }
        if(isset($_GET['view_brands'])){
            include('view_brands.php');
        }


        if(isset($_GET['edit_products'])){
            include('edit_products.php');
        }
        if(isset($_GET['edit_category'])){
            include('edit_category.php');
        }
        if(isset($_GET['edit_brands'])){
            include('edit_brands.php');
        }


        if(isset($_GET['delete_product'])){
            include('delete_product.php');
        }
        if(isset($_GET['delete_category'])){
            include('delete_category.php');
        }
        if(isset($_GET['delete_brands'])){
            include('delete_brands.php');
        }

        if(isset($_GET['list_orders'])){
            include('list_orders.php');
        }

        ?>
    </div>




    <!-- last child-->
    <?php include("../includes/footer.php")?>

<!-- bootstrap Js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>