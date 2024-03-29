<div class="container">
   <div class="header-wrapper">
      <!-- logo -->
      <div id="logo">
         <a href="index.php"> <h2> Catch-Food Online</h2> </a>
      </div>

      <!-- main menu start -->
      <ul id="main-menu">
         <li> <a class="menu-link active" href="index.php">Home</a> </li>

         <li> <a class="menu-link" href="food_results.php?pageno=1">Menu</a> </li>


         <?php if (strlen($_SESSION['fosuid']==0)) {?>
        <li> <a class="menu-link" href="registration.php">Sign up</a> </li>
         <li> <a class="menu-link" href="login.php">Login</a>
         <li> <a class="menu-link" href="track-order-on.php">Track Order</a> </li>
         <?php } ?>

         <?php if (strlen($_SESSION['fosuid']>0)) {?>
         <li><a class="menu-link" href="my-order.php"> My Orders
            </a> </li>
         <li><a class="menu-link" href="cart.php"> Cart </a>
         </li>
         <?php } ?>
      </ul>

      <!-- dropdown profile settings -->
      <?php if(isset($_SESSION['fosuid'])):?>
      <div class="dropdown">
         <a class="dropdown-toggle"><img src="images/profile-avatar2.png" alt=""></a>
         <div class="dropdown-menu">
            <a class="dropdown-item" href="changepassword.php">Setting</a>
            <a class="dropdown-item" href="profile.php">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Logout</a>
         </div>
      </div>
      <?php endif ?>
   </div>
</div>