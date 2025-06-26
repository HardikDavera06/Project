<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/signin.css">
    <link rel="stylesheet" href="./css/boot.css">
    <link rel="stylesheet" href="./css/employe.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/toastr.min.js"></script>
    <title>EMPLOYE | ABOUT</title>
    <style>
        .head-titles {
            letter-spacing: 2px;
            height: 150px;
            width: 645px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 45px;
            color: #ab9f9f;
        }
    </style>
</head>

<?php
session_start();
require_once "nav.php";
require_once "config.php";
require_once "./assets/showMessage.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['admin_login']) || isset($_SESSION['admin_register'])) {
        if (isset($_SESSION['admin_name'])) { //*<---- If The Admin LoggedIn After Workout All Tasks ---->
            $admin_name = $_SESSION['admin_name'];
            $nm = trim($_POST['nm']);
            $mail = $_POST['mail'];
            $num = $_POST['con'];
            $insert = "INSERT INTO `contact_us`(`cu_name`, `cu_email`, `cu_number`,`admin`) VALUES ('$nm','$mail','$num','$admin_name')";
            $RUn = mysqli_query($con, $insert);
            if (mysqli_affected_rows($con) == 1) {
                ShowSuccess('Details Sended successfully', 'Admin!');
            }
        }
    } else {
        $_SESSION['redirect_for_without_login_feedback'] = 0; //* Without loggedIn sending feedback,So Redirect Admin Signin Page 
        ?>
        <script>
            window.location = "index2.php";
        </script>
        <?php
    }
}
?>

<body>
    <div class="head-titles">
        <p>FEEL FREE TO CONTACT US |</p>
    </div>
    <div class="wrapper mt-2" id="about_wrapper">
        <div class="title" title="Contact us"> Details</div>
        <form action="about.php" method="post">
            <div class="field">
                <input type="text" name="nm" id="nm" class="nm" title="Enter Name" required />
                <label for="nm">Enter Name</label>
            </div>

            <div class="field">
                <input type="email" name="mail" id="mail" class="Email" title="Enter mail" required />
                <label for="mail">Enter E-mail</label>
            </div>

            <div class="field">
                <input type="text" name="con" id="aboutContactNumber" minlength="10" maxlength="10" class="pass"
                    title="Enter contact no." required />
                <label for="con">Contact no.</label>
            </div>

            <div class="field">
                <input type="submit" value="SEND iT" name="button" title="click now" />
            </div>
        </form>
    </div>
    <?php include "footer.php"; ?> <!-- //* include footer -->

    <!--//* Source files for jqueryCDN and other CDN -->
    <script src="./js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="./css/toastr.css" />
    <script src="./js/script.js"></script>
</body>

</html>