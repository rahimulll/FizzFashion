<?php
include('.././includes/connect.php');
include('.././functions/common_function.php');

if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
}

$user_id= 1;

// getting total items and total price of all items
$get_ip_address=getIPAddress();
$total_price=0;
$cart_query_price="Select * from `cart_details` where ip_address='$get_ip_address'";
$result_cart_price=mysqli_query($con,$cart_query_price);

$invoice_number=mt_rand();
$status='pending';

$count_products=mysqli_num_rows($result_cart_price);

while($row_price=mysqli_fetch_array($result_cart_price)){
    $product_id=$row_price['product_id'];
    $select_product="Select * from `products` where product_id=$product_id";
    $run_price=mysqli_query($con,$select_product);

    while($row_product_price=mysqli_fetch_array($run_price)){
        $product_price=array($row_product_price['product_price']);
        $product_values=array_sum($product_price);
        $total_price+=$product_values;
    }
}


// getting quantity from cart
$get_cart="select * from `cart_details`";
$run_cart=mysqli_query($con,$get_cart);
$get_item_quantity=mysqli_fetch_array($run_cart);
$quantity=$get_item_quantity['quantity'];
if($quantity==0){

    $quantity=1;
    $subtotal=$total_price;
}else{
    $quantity=$quantity;
    $subtotal=$total_price*$quantity;
}

$insert_orders="Insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) values ($user_id,$subtotal,$invoice_number,$count_products,NOW(),'$status')";

$result_query=mysqli_query($con,$insert_orders);


// orders pending
$insert_pending_orders="Insert into `orders_pending` (user_id,invoice_number,product_id,quantity,order_status) values ($user_id,$invoice_number, $product_id,$quantity,'$status')";

$result_pending_orders=mysqli_query($con,$insert_pending_orders);


// delete items from cart
$empty_cart="Delete from `cart_details` where ip_address='$get_ip_address'";

$result_delete=mysqli_query($con,$empty_cart);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Stripe Payment Example</title>
</head>

<body>
    <form action="checkout.php" method="post">

        <input type="hidden" name="user_id" id="user_id" value="<?php $user_id ?>" required> <br> 
        <input type="hidden" name="subtotal" id="subtotal" value="<?php $subtotal ?>" required> <br> 
        <input type="hidden" name="invoice_number" id="invoice_number" value="<?php $invoice_number ?>" required> <br> 
        <input type="hidden" name="count_products" id="count_products" value="<?php $count_products ?>" required> <br> 
        <input type="hidden" name="order_date" id="order_date" value="<?php $order_date ?>" required> <br> 
        <input type="hidden" name="status" id="status" value="<?php $status ?>" required> <br> 
        <input type="hidden" name="amount" id="amount" value="<?php total_cart_price(); ?>" required> <br> 

        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_51MpamWCsBhBFtdYWZZtKeD7QVBS9hQZB3AXFwNSctiRwEhkRJAaJ3w1diGBaNXUgJZHG4AlX0eqtrkDUMn0zgihV00GRkyM4hj"
            data-amount="<?php total_cart_price(); ?>" data-name="Fizz Fashion" data-description="Payment By Stripe">
            </script>
    </form>
</body>

</html>