<?php
session_start();
include "nav.php";
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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
   <title>EMPLOYE | HOME</title>
</head>

<body>
   <?php
   if (isset($_SESSION['redirect_for_false_crendentials'])) {
      if ($_SESSION['redirect_for_false_crendentials'] == 0) //* <---- Display Message If Admin Without LoggedIn, Register The Employee ---->
      {
   ?>
         <script>
            $(document).ready(function() {
               toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": true,
                  "preventDuplicates": true,
                  "onclick": null,
                  "showDuration": "100",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "show",
                  "hideMethod": "hide",
                  "positionclass": "toast-top-full-width"
               }
               toastr.info('Before SignIn, You can not register the employes', 'Sorry!');
            });
         </script>
      <?php
         $_SESSION['redirect_for_false_crendentials']++; //* Increase Number, Because This Message Show Only One Time At Page
      }
   }
   if (isset($_SESSION['redirect_for_without_login_feedback'])) {
      if ($_SESSION['redirect_for_without_login_feedback'] == 0) //* Without Login Admin, Entered Feedbacks
      {
      ?>
         <script>
            $(document).ready(function() {
               toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": true,
                  "preventDuplicates": true,
                  "onclick": null,
                  "showDuration": "100",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "show",
                  "hideMethod": "hide",
                  "positionclass": "toast-top-full-width"
               }
               toastr.info('Before SignIn, You can not sent feedbacks', 'Sorry!');
            });
         </script>
   <?php
         $_SESSION['redirect_for_without_login_feedback']++; //* Increase Number, Because This Message Show Only One Time At Page
      }
   }
   ?>
   <?php
   if (isset($_SESSION['admin_register'])) {
      if ($_SESSION['admin_register'] == 1) {
   ?>
         <script type="text/javascript">
            $(document).ready(function() {
               toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": true,
                  "preventDuplicates": true,
                  "onclick": null,
                  "showDuration": "100",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "show",
                  "hideMethod": "hide"
               }
               toastr.success('New Admin Registered!', 'Successfully');
            });
         </script>
      <?php
         $_SESSION['admin_register']++;
      }
   }
   if (isset($_SESSION['admin_login'])) {
      if ($_SESSION['admin_login'] == 1) {
      ?>
         <script type="text/javascript">
            $(document).ready(function() {
               toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": true,
                  "preventDuplicates": true,
                  "onclick": null,
                  "showDuration": "100",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "show",
                  "hideMethod": "hide"
               }
               toastr.success('Admin LoggedIn!', 'Successfully');
            });
         </script>
   <?php
         $_SESSION['admin_login']++;
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" />

</body>

</html>