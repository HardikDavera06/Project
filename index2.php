<?php
session_start();
require_once "nav.php";
require_once "./assets/showMessage.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./css/boot.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="./js/jquery.min.js"></script>
   <script src="./js/toastr.min.js"></script>
   <title>EMPLOYE | HOME</title>
</head>

<body>
   <?php
   if (isset($_SESSION['redirect_for_without_login_feedback'])) {
      if ($_SESSION['redirect_for_without_login_feedback'] == 0) //* Without Login User, Enter Feedbacks
      {
         ShowInfo('Before SignIn, You can not sent feedbacks', 'Sorry!');
         $_SESSION['redirect_for_without_login_feedback']++; //* Increase Number, Because This Message Show Only One Time on Page
      }
   }
   ?>
   <?php
   if (isset($_SESSION['admin_register'])) {
      if ($_SESSION['admin_register'] == 1) {
         ShowSuccess('New Admin Registered!', 'Successfully');
         $_SESSION['admin_register']++;
      }
   }  

   $login = isset($_SESSION['admin_login']) ? "Admin" : "Employee";
   $inc = isset($_SESSION['admin_login']) ? "admin_login" : "emp_login";
   if (isset($_SESSION[$inc])){
      if ($_SESSION[$inc] == 1) {
         ShowSuccess($login.' LoggedIn!', 'Successfully');
         $_SESSION[$inc]++;
      }
   }

   ?>
   <div class="header-text">
      <div class="text">
         <p>WelCome to <b>NexGen</b></p>
         <p class="subconten"> We provide a software for handle admin or back-end works , Gives sorting features or
            another and
            improve funcationality to manage your bulk amount of data.</p>
      </div>
      <div class="imag">
         <img src="./assets/admin-removebg.png" class="admin" alt="adminImg" height="550" width="550">
      </div>
   </div>

   <!--//* Include Footer  -->
   <?php include "footer.php"; ?>

   <!--//*Source files for jqueryCDN and other CDN , toastr css-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
   <link rel="stylesheet" href="./css/toastr.css" />

</body>

</html>