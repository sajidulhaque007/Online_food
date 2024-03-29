<?php
session_start();
error_reporting(0);
include_once('includes/dbconnection.php');
if (strlen($_SESSION['fosuid']==0)) {
  header('location:logout.php');
  } else {
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
    <title>Catch-Food Online</title>
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/order.css" rel="stylesheet">
    <script language="javascript" type="text/javascript">
    var popUpWin = 0;

    function popUpWindow(URLStr, left, top, width, height) {
        if (popUpWin) {
            if (!popUpWin.closed) popUpWin.close();
        }
        popUpWin = open(URLStr, 'popUpWin',
            'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' +
            600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top +
            '');
    }
    </script>
</head>

<body>
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <?php include_once('includes/header.php');?>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">

            <!-- //results show -->
            <section class="restaurants-page">
                <div class="container">
                    <div class="order-row">
                        
                        <div class="order-detail">
                            <div class="restaurant-entry">

                                <?php
                                $uid=$_SESSION['fosuid'];
                                $query=mysqli_query($con,"select * from  tblorderaddresses  where UserId='$uid'");
                                $count=1;
                                while($row=mysqli_fetch_array($query))
                                { ?>
                                <div class="order-id">
                                    <div class="order">
                                        <div class="entry-logo">
                                            <a class="img-fluid"
                                                href="order-details.php?orderid=<?php echo $row['Ordernumber'];?>"><img
                                                    src="images/order2.jpg" width="120" height="100" alt="Order "></a>
                                        </div>
                                        <!-- end:Logo -->
                                        <div class="entry-dscr">
                                            <h5><a href="order-details.php?orderid=<?php echo $row['Ordernumber'];?>">Order
                                                    # <?php echo $row['Ordernumber'];?></a>&nbsp;<span
                                                    style="color: <?php echo $row['Payment'] != '' ? "blue":"gray"; ?>">(<?php echo $row['Payment'] != '' ? ($row['Payment'] == 'COD' ? "Cash On Delivery" : "Paid") :"Not Paid"; ?>)
                                            </h5>
                                            <p><b>Order Date :</b> <?php echo $row['OrderTime']?></p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item"><i class="fa fa-check"></i>
                                                    <?php $status=$row['OrderFinalStatus'];
                                                    if($status==''){
                                                     echo "Waiting for Restaurant confirmation";   
                                                    } else{
                                                    echo $status;
                                                    }

                                                    ?></li>
                                                <li class="list-inline-item"><i class="fa fa-motorcycle"></i>
                                                    <?php    
                                                    $link = "http"; 
                                                    $link .= "://"; 
                                                    $link .= $_SERVER['HTTP_HOST']; 
                                                    ?>
                                                    <a href="javascript:void(0);"
                                                        onClick="popUpWindow('trackorder.php?oid=<?php echo htmlentities($row['Ordernumber']);?>');"
                                                        title="Track order">Track Order</a></li>
                                            </ul>
                                        </div>
                                        <!-- end:Entry description -->
                                    </div>
                                    <div class="order-view">
                                        <div style="margin-left: 60px;" class="right-review">
                                            <a style="margin-bottom: 6px;"
                                                href="order-details.php?orderid=<?php echo $row['Ordernumber'];?>"
                                                class="btn theme-btn-dash">View Details</a>
                                            <a style="visibility: <?php echo $row['Payment'] == '' ? "visible":"hidden"; ?>;"
                                                href="payment.php?orderid=<?php echo $row['Ordernumber'];?>"
                                                class="btn theme-btn-dash">Pay Now</a>
                                        </div>
                                        <!-- end:right info -->
                                    </div>
                                </div>
                                <hr />
                                <?php } ?>
                                <!--end:row -->
                            </div>




                            <!--end:row -->
                        </div>
                        <!-- end:Restaurant entry -->

                        <!-- end:Restaurant entry -->
                    </div>
                </div>
        </div>
        </section>

        <!-- start: FOOTER -->
        <?php include('includes/footer.php');?>
        <!-- end:Footer -->
    </div>
    </div>
    <!--/end:Site wrapper -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <!-- font Awesome Icon Script -->
    <script src="https://kit.fontawesome.com/bdb42816d8.js" crossorigin="anonymous"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>
<?php } ?>