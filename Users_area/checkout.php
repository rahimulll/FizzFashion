<!-- connect file -->
<?php
include('../includes/connect.php');

session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page - FIZZ FASHION</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
    body{
      overflow-x:hidden;
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
            </ul>
        </div>
        <form class="d-flex" action="../search_product.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
            </div>
        </form>
    </div>
</nav>



<!-- second child -->
<nav class="navbar-nav p-0 me-auto bg-warning">
    <ul class="navbae-nav me-auto" style="list-style:none">

    <?php     
// Username on Navbar

if(!isset($_SESSION['username'])){
  echo "
        <li class='nav-item'>
        <a class='nav-link text-danger' href='./users_area/user_registration.php'><b>Welcome Guest</b></a>
        </li>";
}else{
  echo "
        <li class='nav-item'>
        <a class='nav-link text-danger' href='./users_area/profile.php'><b>Welcome ".$_SESSION['username']."</b></a>
        </li>";}

// Login/Logout Button on Navbar

  if(!isset($_SESSION['username'])){
    echo "
          <li class='nav-item'>
          <a class='nav-link text-dark' href='./user_login.php'><b>Login</b></a>
          </li>";
  }else{
    echo "
          <li class='nav-item'>
          <a class='nav-link text-dark' href='user_logout.php'><b>Logout</b></a>
          </li>";}
?>
    </ul>
</nav>



<!-- third child-->
<div class="bg-light">
    <h3 class="text-center text-dark"><b>Mens Store</b></h3>
    <p class="text-center">Communication is at the heart of E-commerce and community</p>
</div>




<!-- fourth child -->
<div class="row px-3">
    <div class="col-md-12">

        <!-- products -->
        <div class="row">
        <?php
            if(!isset($_SESSION['username'])){

                include('user_login.php');
              
            }else{
                include('payment.php');
            }
        ?>
        </div>

        <!-- col end -->
    </div>
</div>

<!-- bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
