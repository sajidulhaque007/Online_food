<?php
session_start();
error_reporting(0);
include_once 'includes/dbconnection.php';
if (strlen($_SESSION['fosuid'] == 0)) {
    header('location:logout.php');
} else {
//placing order

    if (isset($_POST['placeorder'])) {
//getting address
        $fnaobno = $_POST['flatbldgnumber'];
        $street = $_POST['streename'];
        $area = $_POST['area'];
        $lndmark = $_POST['landmark'];
        $city = $_POST['city'];
        $userid = $_SESSION['fosuid'];
//genrating order number
        $orderno = mt_rand(100000000, 999999999);
        $query = "update tblorders set OrderNumber='$orderno',IsOrderPlaced='1' where UserId='$userid' and IsOrderPlaced is null;";
        $query .= "insert into tblorderaddresses(UserId,Ordernumber,Flatnobuldngno,StreetName,Area,Landmark,City) values('$userid','$orderno','$fnaobno','$street','$area','$lndmark','$city');";

        $result = mysqli_multi_query($con, $query);
        if ($result) {

            echo '<script>alert("Your order placed successfully. Order number is "+"' . $orderno . '")</script>';
            echo "<script>window.location.href='my-order.php'</script>";

        }
    }

//Code deletion
    if (isset($_GET['delid'])) {
        $rid = $_GET['delid'];
        $query = mysqli_query($con, "delete from tblorders where ID='$rid'");
        echo '<script>alert("Food item deleted")</script>';
        echo "<script>window.location.href='cart.php'</script>";

    }

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Catch Food Online</title>
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/order.css" rel="stylesheet">
    <link href="css/order-detail.css" rel="stylesheet">
    <link href="css/cart.css" rel="stylesheet">
    <style>
    .qty {
        display: flex;
        margin-left: 8px;
        margin-right: 8px;
    }
    .qty button {
        background: var(--bg-secondary);
        outline: none;
        border: none;
        font-weight: bold;
        font-size: 20px;
        color: white;
    }
    .qty input {
        width: 28px;
        text-align: center;
        outline: none;
    }
    </style>
</head>

<body>
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <?php include_once 'includes/header.php';?>
            <!-- /.navbar -->
        </header>
        <div>

            <div class="container">
                <div class="order-row">
                    
                    <div class="mid-menu">
                        <div class="menu-widget">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                                    Your ORDERS  <a class="btn btn-link pull-right" href="#popular">

                                        <i class="fa fa-angle-down pull-right"></i>
                                    </a>
                                </h3>

                            </div>
                            <div class="order-collapse" id="1">

                                <?php
    $userid = $_SESSION['fosuid'];
    $query = mysqli_query($con, "select tblorders.ID as frid, tblorders.Quantity as pQty,tblfood.Image,tblfood.ItemName,tblfood.ItemDes,tblfood.ItemPrice,tblfood.ItemQty,tblorders.FoodId from tblorders join tblfood on tblfood.ID=tblorders.FoodId where tblorders.UserId='$userid' and tblorders.IsOrderPlaced is null");
    $num = mysqli_num_rows($query);
    if ($num > 0) {
        while ($row = mysqli_fetch_array($query)) {
            ?>

                                <div class="order-items">
                                    <div class="order-content">
                                        <div class="rest-logo pull-left">
                                            <a class="restaurant-logo pull-left" href="#"><img
                                                    src="admin/itemimages/<?php echo $row['Image'] ?>" width="100"
                                                    height="80" alt="<?php echo $row['ItemName'] ?>"></a>
                                        </div>
                                        <!-- end:Logo -->
                                        <div class="rest-descr">
                                            <h6><a
                                                    href="food-detail.php?fid=<?php echo $_SESSION['fid'] = $row['FoodId']; ?>"><?php echo $row['ItemName'] ?>
                                                    (<?php echo $row['ItemQty'] ?>) </a></h6>
                                            <p> <?php echo $row['ItemDes'] ?></p>
                                        </div>
                                        <!-- end:Description -->
                                    </div>
                                    <!-- end:col -->
                                    <div class="qty" >
                                        <button onclick="changeUnitQty(event, 's', <?php echo $row['FoodId'] ?>, <?php echo $total = $row['ItemPrice'] ?>)">&nbsp;&nbsp;-&nbsp;&nbsp;</button>
                                        <input type="text" oninput="changeUnitQty(event, 't', <?php echo $row['FoodId'] ?>, <?php echo $total = $row['ItemPrice'] ?>)" value="<?php echo $row['pQty'] ?>">
                                        <button onclick="changeUnitQty(event, 'a', <?php echo $row['FoodId'] ?>, <?php echo $total = $row['ItemPrice'] ?>)">&nbsp;+&nbsp;</button>
                                    </div>
                                    <div class="item-cart-info">
                                        <span class="order-price">Taka.<?php echo $total = $row['ItemPrice'] * $row['pQty'] ?>&nbsp;</span>
                                        <a style="margin-left: 10px;" href="cart.php?delid=<?php echo $row['frid']; ?>"
                                                onclick="return confirm('Do you really want to delete?');"><i
                                                    class="fa fa-trash" style="color: red;" aria-hidden="true" title=""></i></a>
                                    </div>
                                </div>
                                <!-- end:row -->

                                <?php
$grandtotal += $total;
        }

    } else {

        echo "You cart is empty.";
    }
    ?>


                            </div>
                            <!-- end:Collapse -->
                        </div>
                        <!-- end:Widget menu -->

                        <!--/row -->
                    </div>
                    <!-- end:Bar -->
                    <?php if ($num > 0) {?>
                    <div class="menu order-sidebar">
                        <form method="post">
                            <div>
                                <div class="sidebar-wrap">
                                    <div class="widget widget-cart">
                                        <div class="widget-heading">
                                            <h3 class="widget-title text-dark">
                                                Your Shopping Cart
                                            </h3>

                                        </div>
                                        <div class="">
                                            <div class="widget-body">

                                                <div class="form-group row no-gutter">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="flatbldgnumber"
                                                            placeholder="Flat or Building Number" class="form-control"
                                                            required="true">
                                                        <input type="text" name="streename" placeholder="Street Name"
                                                            class="form-control" required="true">
                                                        <input type="text" name="area" placeholder="Area"
                                                            class="form-control" required="true">
                                                        <!-- <input type="text" name="landmark" placeholder="Landmark if any"
                                                            class="form-control"> -->
                                                        <input type="text" name="city" placeholder="City"
                                                            class="form-control">

                                                    </div>
                                                </div>
                                            </div>
                                            <hr />


                                            <div class="widget-body">
                                                <div class="price-wrap">
                                                    <p>TOTAL</p>
                                                    <h3 id="grantTot" class="value"><strong><?php echo $grandtotal; ?></strong></h3>
                                                    <p>Free Shipping</p>
                                                    <button type="submit" name="placeorder"
                                                        class="btn theme-btn btn-lg">Place order</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end:Right Sidebar -->
                            </div>
                        </form>
                    </div>
                    <?php }?>
                    <!-- end:row -->
                </div>
                <!-- end:Container -->


            </div>
            <!-- start: FOOTER -->
            <?php include 'includes/footer.php';?>
            <!-- end:Footer -->
            <!-- end:page wrapper -->
        </div>
        <!--/end:Site wrapper -->

        <!-- Bootstrap core JavaScript
    ================================================== -->
        <script src="https://kit.fontawesome.com/bdb42816d8.js" crossorigin="anonymous"></script>
        <script src="js/jquery.min.js"></script>
        <!-- font Awesome Icon Script -->

        <script src="js/tether.min.js"></script>

        <script src="js/animsition.min.js"></script>

        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/headroom.js"></script>
        <script src="js/foodpicky.min.js"></script>
        <script>
        function changeUnitQty(e, p, foodId, unitPrice) {
            let uId = <?php echo $userid ?>;
            let qtyEl = event.target;
            let qty = 0;
            let priceEl = qtyEl.parentElement.nextElementSibling.firstElementChild;
            if(p == 'a') {
                qty = qtyEl.previousElementSibling.value = parseInt(qtyEl.previousElementSibling.value) + 1;
                priceEl.textContent = `Taka. ${unitPrice * qty}`
                reqUpdate(uId, foodId, qty);
            }
            else if(p == 's') {
                if(parseInt(qtyEl.nextElementSibling.value) >= 2) {
                    qty = qtyEl.nextElementSibling.value = parseInt(qtyEl.nextElementSibling.value) - 1;
                    priceEl.textContent = `Taka ${unitPrice * qty}`
                    reqUpdate(uId, foodId, qty);
                }
            }
            else {
                console.log(e.target)
                qty = parseInt(e.target.value);
                priceEl.textContent = `Taka ${unitPrice * qty}`
                reqUpdate(uId, foodId, qty);
            }
            let grandT = 0
            for(i = 0; i < $('.order-price').length; i++) {
                let v = parseInt($('.order-price')[i].textContent.replace(/[^0-9]/g, ''));
                grandT += v;
            }
            $('#grantTot').text(grandT);
        }
        function reqUpdate(uId, fId, qty) {
            fetch(`updateQty.php?uId=${uId}&fId=${fId}&qty=${qty}`)
            .then(res => res.text())
            .then(data => console.log(data))
            .catch(err => alert("Can't Updated the Quantity!"));
        }
        </script>
</body>

</html>
<?php }?>