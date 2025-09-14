<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="./css/nav1.css">
    <link rel="stylesheet" href="./css/boot.css">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>EMPLOYE | NAVBAR</title>
</head>

<body>
    <?php
    $department = '';
    if (isset($_SESSION['admin_name']))
        $userName = $_SESSION['admin_name'];
    if (isset($_SESSION['emp_name']))
        $userName = $_SESSION['emp_name'];
    if (isset($_SESSION['department'])) {
        $department = $_SESSION['department'];
    }

    $table = ($department == "Administration") ? "_admin_regi" : "_emp_regi";

    $tblNameColumn = ($department == "Administration") ? "name" : "Ename";
    $select = '';
    if (isset($_SESSION['admin_login']) || isset($_SESSION['emp_login'])) {
        $select = "SELECT * FROM `$table` WHERE `$tblNameColumn`='$userName'";
        $select_query = $con->query($select);
        if (mysqli_num_rows($select_query) > 0) {
            $row1 = mysqli_fetch_assoc($select_query);
        } else {
            header("Location: logout.php");
        }
    }
    ?>
    <!--//* Modal For Display The Admin's Details -->
    <div class="modal fade" id="navModal" tabindex="-1" aria-labelledby="navModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class=" modal-title fs-5 text-success" id="navModal">Admin Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="dialog modal-body container">
                    <form method="post" action="nav.php" class="form p-3 fw-semibold">

                        <label for="AdName" class="text-dark"> Admin Name :</label>
                        <input type="text" name="AdName" value="<?php echo $row1[$tblNameColumn]; ?>"
                            class=" nav-inp form-control" id="AdName" disabled>

                        <label for="CONTACT" class="mt-3 text-dark"> Contact Number</label>
                        <input type="text" name="CONTACT" maxlength="15" minlength="15"
                            value="<?php echo $row1['contact']; ?>" class="nav-inp form-control mt-1" id="CONTACT"
                            disabled>

                        <label for="mail" class="mt-3 text-dark"> E-Mail :</label>
                        <input type="text" name="mail" class="nav-inp form-control"
                            value="<?php echo $row1['email']; ?>" id="mail" disabled>

                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger mt-3"><a href="logout.php"
                                class="text-decoration-none text-light">Log Out</a></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <nav class="nav-head sticky-top py-2 shadow-sm rounded navbar navbar-expand-lg w-100">
        <div class="container-fluid w-100">
            <a class="txt navbar-brand fw-semibold" href="index2.php">NexGen</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link linkU" href="index2.php" aria-current="page">Home</a>
                    </li>
                    <?php
                    // //* <-- If Admin LoggedIn Then Show Admin's Details -->
                    if (isset($_SESSION['admin_login'])) {
                        ?>
                        <li class="nav-item mx-2">
                            <a class="nav-link linkU" href="registration.php" aria-current="page">Registration</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link linkU" href="employe.php" aria-current="page">Employes List</a>
                        </li>
                    <?php } ?>

                    <!--//* If Admin LoggedIn Then Show Admin's Details  -->
                    <?php if (isset($_SESSION['admin_login']) || isset($_SESSION['emp_login'])) { ?>
                        <div class="dropdown">
                            <li class="nav-link linkU dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Leave
                            </li>

                            <ul class="p-2 dropdown-menu">
                                <li>
                                    <a class="nav-link linkU" href="applyLeave.php?apply=true" aria-current="page">Apply
                                        Leave</a>
                                </li>
                                <?php if ($department == "Administration") { ?>
                                    <li>
                                        <a class="nav-link linkU" href="applyLeave.php?approve=true" aria-current="page"
                                            style="font-size:16px">
                                            Leave Application</a>
                                    </li>
                                <?php } ?>
                                <li class="nav-item">
                                    <a class="nav-link linkU" href="applyLeave.php?leaveStatus=true"
                                        aria-current="page">Leave
                                        Status</a>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>

                    <li class="nav-item mx-2">
                        <a class="nav-link linkU" href="about.php" aria-current="page">Contact Us</a>
                    </li>
                </ul>
                <?php
                if (isset($_SESSION['admin_login']) || isset($_SESSION['emp_login'])) { //* <-- If Admin LoggedIn Then Show Admin's Details -->
                    ?>
                    <div class="mx-2 user-profile">
                        <div class="navUsers name">
                            <span><?php echo $userName; ?></span>
                            <span><?php echo $_SESSION['designation']; ?></span>
                        </div>
                        <div>
                            <i class="navUsers fa-sharp fa-solid fa-circle-user fa-2xl" style="color: #7e22ce;"></i>
                        </div>
                    </div>
                    <?php
                } else { //* <--- If Not Login, Show The Login Buttons ---->
                    ?>
                    <div class="login-register">
                        <a href="adminSignin.php" class="login-nav-btn btn">Admin Login</a>
                        <a href="empSignin.php" class="regi-nav-btn btn ">Employe Login</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </nav>

    <script src="./js/script.js"></script>
</body>

</html>