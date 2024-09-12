<!-- connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
$total = 0;
session_start();

// Handle cart updates
if (isset($_POST['update_cart'])) {
    global $con;
    $get_ip_add = getIPAddress();
    $total = 0;
    
    foreach ($_POST['qty'] as $product_id => $quantity) {
        $quantity = (int)$quantity;
        
        $update_cart = $con->prepare("UPDATE cart_details SET quantity=? WHERE ip_address=? AND product_id=?");
        $update_cart->bind_param("iis", $quantity, $get_ip_add, $product_id);
        $update_cart->execute();

        // Fetch the product details again to recalculate the total
        $select_products = "SELECT * FROM products WHERE product_id=?";
        $stmt = $con->prepare($select_products);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $product_price = $row['product_price'];
            $total += $product_price * $quantity;
        }
    }
}


// Total price calculation
function calculate_total_cart_price() {
    global $con;
    $get_ip_add = getIPAddress();
    $total_cart_price = 0;
    
    $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
            
            $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
            $result_products = mysqli_query($con, $select_products);
            
            if ($result_products) {
                while ($row_product_price = mysqli_fetch_array($result_products)) {
                    $product_price = $row_product_price['product_price'];
                    $total_cart_price += $product_price * $quantity;
                }
            }
        }
    }
    
    return $total_cart_price;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website - FIZZ FASHION - Cart Details</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
        .cart_img{
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="./images/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php"><b>Home</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php"><b>Products</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><b>Contact</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- calling cart function -->
        <?php
        cart();
        ?>

        <!-- third child-->
        <div class="bg-light">
            <h3 class="text-center text-dark"><b>Mens Store</b></h3>
            <p class="text-center">Communication is at the heart of E-commerce and community</p>
        </div>

        <!-- product details table -->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">
                        

<!-- php code to display dynamic data -->
<?php 
global $con;
$get_ip_add = getIPAddress();
$total_cart_price=0;
$cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
$result = mysqli_query($con, $cart_query);
$result_count=mysqli_num_rows($result);
if($result_count>0){
    echo "<thead>
 <tr>
    <th>Product Title</th>
    <th>Product Image</th>
    <th>Quantity</th>
    <th>Total Price</th>
    <th>Remove</th>
    <th colspan='2'>Operations</th>
 </tr>
</thead>

<tbody>";


if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        if ($result_products) {
            while ($row_product_price = mysqli_fetch_array($result_products)) {
                $product_price = $row_product_price['product_price'];
                $product_title = $row_product_price['product_title'];
                $product_image = $row_product_price['product_image1'];
                $product_id = $row_product_price['product_id'];
                $select_cart = "SELECT * FROM cart_details WHERE product_id='$product_id' AND ip_address='$get_ip_add'";
                $result_cart = mysqli_query($con, $select_cart);
                $row_cart = mysqli_fetch_array($result_cart);
                $quantity = $row_cart['quantity'];
?>
<tr>
    <td><?php echo $product_title?></td>
    <td><img src="./admin_area/product_images/<?php echo $product_image?>" alt="" class="cart_img"></td>
    <td><input type="text" name="qty[<?php echo $product_id ?>]" class="form-input w-50" value="<?php echo $quantity ?>"></td>
    <td><?php echo $product_price ?>/-</td>
    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
    <td>
        <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
        <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
    </td>
</tr>
<?php 
                }
            }
        }
    }
}
else{
    echo "<h2 class='text-center text-danger' > Cart is empty </h2>";
} 
?> 
</table>

<!-- Subtotal -->

<div class="d-flex mb-5">
    <?php 
    $get_ip_add = getIPAddress();
    $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    $result_count=mysqli_num_rows($result);
    if($result_count>0){
        echo "<h4 class='px-3'>Subtotal: <strong class='text-danger'> " . calculate_total_cart_price() . "/-</strong></h4>
        <input type='submit' value='Continue Shoping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shoping'>
        <button class='bg-secondary p-3 py-2 border-0'><a href='./users_area/checkout.php' class='text-decoration-none text-light'>Checkout<a/></button>";
    }
    else{
        echo "<input type='submit' value='Continue Shoping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shoping'>";
    }
    if(isset($_POST['continue_shoping'])){
        echo "<script>window.open('index.php','_self')</script>";
    }
    ?> 
            </div>
</form>
        </div>
    </div>


<!-- function to remove item -->
<?php 
function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart']) && isset($_POST['removeitem'])){
        foreach($_POST['removeitem'] as $remove_id){
            echo $remove_id;
            $delect_query="DELETE FROM `cart_details` WHERE product_id=$remove_id";
            $run_delect=mysqli_query($con,$delect_query);
            if($run_delect){
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }
}
remove_cart_item();
?>

    <!-- bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
