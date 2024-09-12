<?php
session_start();

global $con;

$get_pending_orders = "SELECT COUNT(*) AS pending_orders FROM user_orders WHERE order_status = 'pending'";
$result_query= mysqli_query($con,$get_pending_orders);
$row_query= mysqli_fetch_assoc($result_query);
$pending_orders = $row_query['pending_orders'];

echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$pending_orders</span> pending orders.</h3>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pending Orders</title>
</head>
<body>

  <?php include 'pending_orders.php'; ?>

</body>
</html>
