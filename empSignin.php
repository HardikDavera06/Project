<?php
require "config.php";
session_start();
$ShowErr = true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EMPLOYE | SIGN IN</title>
    <link rel="stylesheet" href="./css/signin.css" />
    <link rel="stylesheet" href="./css/boot.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/toastr.min.js"></script>
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = $_POST['Anm'];
    $pwd = $_POST['pwd'];
    $select = "SELECT * FROM `_emp_regi` WHERE `Ename`='$userName'";
    $RUN = mysqli_query($con, $select);
    if (mysqli_num_rows($RUN) == 1) {
        $row = mysqli_fetch_assoc($RUN);
        if (password_verify($pwd, $row['password'])) //* <---- Password Validation ------>
        {
            $_SESSION['admin_login'] = 1; //* If Admin LoggedIn Display Success Message In Home Page
            $_SESSION['admin_name'] = $userName;
            header('location:index2.php');
        } else //* If Enter Wrong Password Display Error Message
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
                        "hideMethod": "hide"
                    }
                    toastr.error('Invalid password', 'SORRY !');
                });
            </script>
<?php
            if (isset($_SESSION['count_error'])) {
                $_SESSION['count_error']++; //* <---- Count The Limit Of False Entered Credentials ------>
                if ($_SESSION['count_error'] >= 2)
                    header('location:signup.php'); //* <---- Set The Limit For The Admin False Login ----->
            }
        }
    } else {
        $ShowErr = false;
    }
}
?>

<body>
    <div class="wrapper">
        <div class="title" title="sign in">SIGN IN</div>
        <form action="empSignin.php" method="post">
            <div class="field">
                <input type="text" name="Anm" id="Anm" title="Enter Admin Name" required autofocus />
                <label for="Anm">Enter Name</label>
            </div>
            <div class="field">
                <input type="password" name="pwd" id="pwd" minlength="6" maxlength="8" class="pass"
                    title="Enter password" required />
                <label for="pwd">Password</label>
            </div>
            <div class="field">
                <input type="submit" value="SIGN IN" class="check-btn" name="button" title="click now" />
            </div>
            <div class="pass-link">Go to <a href="index2.php" class="signup-link mx-1"> Home</a> Page.</div>
        </form>
    </div>

    <?php
    if ($ShowErr == false) {
        if (isset($_SESSION['count_error'])) {
            if ($_SESSION['count_error'] >= 2) //* <--- If Admin's SignIn Limits Are Over Redirect To SignIN --->
            {
                $_SESSION['upto_count_error'] = 0; //* <-- For Display Error Message Only One Time --->
                header('location:signup.php');
            }
            $_SESSION['count_error']++;
        }
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
                    "hideMethod": "hide"
                }
                toastr.error('Invalid Credentials', 'OOPS!');
            });
        </script>
    <?php } ?>

    <!-- //* CDN for toastr -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/toastr.css" />
</body>

</html>