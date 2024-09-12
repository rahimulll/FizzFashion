<!-- connect file -->
<?php
include('../includes/connect.php');
session_start();
if (isset($_GET['order_id'])) {


    $order_id = $_GET['order_id'];
    $select_data = "Select * from `user_orders` where order_id=$order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $_SESSION['invoice_number'] = $invoice_number;
    $amount_due = $row_fetch['amount_due'];
    $_SESSION['amount_due'] = $amount_due;

    $order_id = $row_fetch['order_id'];
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $_SESSION['invoice_number'] = $invoice_invoicenumber;
    $amount = $_POST['amount'];
    $_SESSION['amount'] = $amount;
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "insert into `user_payments` (order_id, invoice_number, amount, payment_mode) 
    values ($order_id, $invoice_number, $amount,'$payment_mode')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
        echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
        echo "<script>window.open('profile.php?my_orders', '_self')</script>";
    }
    $update_orders = "update `user_orders` set order_status='Complete' where order_id=$order_id";
    $result_orders = mysqli_query($con, $update_orders);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            .stripe-button-el {
  width: 100%;
  height: 100px;
}
        </style>
</head>

<body class="bg-secondary">
    <h1 class="text-center text-info"><b>Confirm Payment</b></h1>
    <div class="container my-5">
        <form action="" method="Post">
            <div class="form-outline my-4 text-center w-50 m-auto">

                <input type="text" class="form-control w-50 m-auto" name="invoice_number"
                    value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <b><label for="" class="text-light">Amount</label></b>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <option>Bkash</option>
                    <option>Nogod</option>
                    <option>Roket</option>
                    <option>DBBL</option>
                    <option>Net Banking</option>
                    <option>Cash on Delivery</option>
                </select>

            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>


    <div class="col-md-4 py-5 mx-auto text-center">

    <h2 class="text-white"> If You want to pay by card with stripe then pay here </h2>
        <form action="./stripe/checkout.php" method="post">


            <input type="hidden" class="form-control w-50 m-auto" name="invoice_number"
                value="<?php echo $invoice_number ?>">

            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51MpamWCsBhBFtdYWZZtKeD7QVBS9hQZB3AXFwNSctiRwEhkRJAaJ3w1diGBaNXUgJZHG4AlX0eqtrkDUMn0zgihV00GRkyM4hj"
                data-amount="<?php $amount ?>" data-name="Fizz Fashion" data-description="Payment By Stripe">
                </script>
        </form>
    </div>

</body>

</html>