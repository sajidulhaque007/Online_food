<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login']))
  {
    $emailcon=$_POST['emailcont'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbluser where  (Email='$emailcon' || MobileNumber='$emailcon') && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['fosuid']=$ret['ID'];
     header('location:changepassword.php');
    }
    else{
    $msg="Invalid Details.";
    }
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
    <title>Catch-Food Online</title>
   
    <!-- animation css -->
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
    <link href="css/register.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <style>
        input{ color:black!important;}
    </style>
<body>
     <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
         <!--header starts-->
         <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <?php include('includes/header.php');?>
            <!-- /.navbar -->

         </header>
         <div class="page">
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="main-wrapper">
                     <!-- REGISTER -->
                     <div class="form-wrapper">
                        <div class="widget">
                           <div class="widget-body">
                              <p style="font-size:16px; color:white" align="center"> <?php if($msg){
                                                                                    echo $msg;
                                                                                  }  ?> </p>
                              <form action="track-order-search.php" name="trackorder" method="post" class="form">
                                 <div class="">
                                    <div class="form-group">
                                       <label for="exampleInputEmail1">Order Number</label>
                                        <input type="text" name="ordernumber" id="ordernumber" class="form-control" placeholder="Your Order Number"
                                        required="true" >
                                    </div> </div>
                                                    
                                 
                                 <div class="">
                                    <div class="">
                                      <button type="submit" name="login" class="custom-btn"><i class="ft-user"></i>Track </button>
                                    </div>
                   
                                 </div>
                              </form>
                           </div>
                           <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                     </div>
                     <!-- WHY? -->
                    <div class="side-wrapper">
                        <h4 class="section-title">Track using order number.</h4>
                        <hr>
                        <img src="images/track-order2.png" alt="" class="img-fluid">
                        <p></p>
                   
                   
                        <!-- end:Panel -->
                        <h4 class="">For Customer Support</h4>
                        <p> <a href="contact.php" class="custom-btn; color= white " >contact us</a> </p>
                     </div>
                     <!-- /WHY? -->
                  </div>
               </div>
            </section>
            
            <!-- start: FOOTER -->
           <?php include('includes/footer.php');?>
            <!-- end:Footer -->
         </div>
         <!-- end:page wrapper -->
      </div>
      <!--/end:Site wrapper -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>