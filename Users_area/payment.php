<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

$user_ip = getIPAddress();
$get_user = "Select * from `user_table` where user_ip='$user_ip'";
$result = mysqli_query($con, $get_user);
$run_query = mysqli_fetch_array($result);
$user_id = $run_query['user_id'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            overflow-x: hidden;
        }

        .payment_img {
            width: 110%;
            margin: auto;
            display: block;
        }
    </style>

</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">


        <div class="container">
            <h2 class="text-center text-info">Payment Options</h2>
            <div class="row d-flex justify-content-center align-items-center my-5">

                <div class="col-md-6">
                    <a href="order.php?user_id=<?php echo $user_id ?>">
                        <h2 class="text-center">Order Now</h2>
                    </a>
                </div>
            </div>
        </div>




        <!-- last child-->
        <?php
        include("../includes/footer.php")
        ?>
        <!-- bootstrap JS link -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>