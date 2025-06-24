<?php
session_start();
require_once "config.php";
require_once "./assets/showMessage.php";

$signup = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EMPLOYE | SIGN UP </title>
   <link rel="stylesheet" href="./css/signup.css">
   <link rel="stylesheet" href="./css/boot.css">
   <script src="./js/jquery.min.js"></script>
   <script src="./js/toastr.min.js"></script>
</head>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $aname = trim($_POST['Anm']);
   $pwd = $_POST['pwd'];
   $rpwd = $_POST['Rpwd'];
   $Email = $_POST['email'];
   $coN = $_POST['contact'];
   $role = $_POST['role'];

   //* <--- Check Admin Already Registered Or Not--> 
   $selectQuery = "SELECT * FROM _admin_regi where `name`= '$aname' AND `contact`='$coN' OR `email`='$Email'";
   $run = mysqli_query($con, $selectQuery);
   $NumExistscheck = mysqli_num_rows($run);
   if ($NumExistscheck == 1) {
      ShowError('Admin Already Existed', 'OOPS!');
   } else {
      // * <--- Insert New Admin -->
      if ($pwd == $rpwd) {
         $Hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
         $HashRpwd = password_hash($rpwd, PASSWORD_DEFAULT);
         $insert = "INSERT INTO `_admin_regi` (`name`, `password`, `re_type_password` , `contact`, `email`,`role`) VALUES ('$aname', '$Hashpwd', '$HashRpwd' , '$coN', '$Email','$role')";
         $run = mysqli_query($con, $insert);
         if (!$run)
            die("not working" . mysqli_error($con));
         if (mysqli_affected_rows($con) == 1) {
            header("location:index2.php");
            $_SESSION['admin_register'] = 1; //* <-- Use For Display Message On Page For Success Register
            $_SESSION['admin_name'] = $aname; //* Store The New Admin Name
         }
      } else {
         ShowError('Passwords Do Not Match', 'ERROR!');
      }
   }
}

?>

<body>
   <div class="wrapper">
      <div class="title" title="SIGN UP">
         SIGN UP
      </div>
      <form action="signup.php" method="post">
         <input type="hidden" value="admin" name="role">
         <div class="field" title="Add Admin name">
            <input type="text" id="Anm" name="Anm" required autofocus>
            <label for="Anm">Enter Full Name</label>
         </div>
         <div class="row">
            <div class="col-6">
               <div class="field" title="Add Password">
                  <input type="password" minlength="6" id="pwd" maxlength="8" id="pass" name="pwd" required>
                  <label for="pwd">Password</label>
               </div>
            </div>
            <div class="col-6">
               <div class="field" title="Add Password">
                  <input type="password" minlength="6" id="rpwd" maxlength="8" id="rpass" name="Rpwd" required>
                  <label for="rpwd">Confirm Password</label>
               </div>
            </div>
         </div>
         <div class="field" title="Add Email">
            <input type="email" name="email" id="email" required>
            <label for="email">Email</label>
         </div>

         <div class="row">
            <div class="col-md-3">
               <div class="field" title="Add contact">
                  <input type="text" name="contact" id="contact1" value="+91 " disabled>
               </div>
            </div>
            <div class="col-md-9">
               <div class="field" title="Add contact">
                  <input type="text" name="contact" id="signupContact" maxlength="10" id="contact" required>
                  <label for="contact">Contact Number</label>
               </div>
            </div>
         </div>

         <div class="field" title="click now">
            <input type="submit" value="SIGN UP">
         </div>
         <div class="signup-link" title="Sign in now">
            Already a admin? <a href="adminSignin.php">SignIn now</a>
         </div>
      </form>
   </div>

   <!-- //* CDN for toastr -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
   <link rel="stylesheet" href="./css/toastr.css" />
   <script src="./js/script.js"></script>
</body>

</html>