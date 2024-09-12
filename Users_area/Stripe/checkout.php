<?php
require_once 'vendor/autoload.php';
require_once '../../includes/connect.php';

use Stripe\Stripe;

Stripe::setApiKey('sk_test_51MpamWCsBhBFtdYWh6yrH0QX9OebmjaOPftEXSBR3hVzIetGjPfz0twuMXj4II9vcItfwQXGZsheisXhmiBCfEtJ00B3muUW0f');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $token = $_POST['stripeToken'];


    if (isset($_POST['invoice_number'])) {

        $invoice_number = $_POST['invoice_number'];
        $select_data = "Select * from `user_orders` where invoice_number=$invoice_number";
        $result = mysqli_query($con, $select_data);
        $row_fetch = mysqli_fetch_assoc($result);
        $invoice_number = $row_fetch['invoice_number'];
        $amount = $row_fetch['amount_due'];
        $order_id = $row_fetch['order_id'];
    }


    try {
        $charge = \Stripe\Charge::create([
            'amount' => $amount * 100,
            // Amount in cents
            'currency' => 'usd',
            'source' => $token,
        ]);

        if ($charge) {



            $insert_query = "insert into `user_payments` (order_id, invoice_number, amount, payment_mode) 
    values ($order_id, $invoice_number, $amount,'Stripe')";
            $result = mysqli_query($con, $insert_query);

            $update_orders = "update `user_orders` set order_status='Complete' where invoice_number=$invoice_number";
            $result_orders = mysqli_query($con, $update_orders);

            header("Location: http://localhost/FizzFashion/users_area/profile.php?my_orders");

        }




    } catch (\Stripe\Exception\CardException $e) {
        // Payment failed (e.g., declined)
        echo 'Payment failed: ' . $e->getMessage();
    }


    // 4242424242424242
}
?>