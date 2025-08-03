<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPLOYE | REGISTRATION</title>
    <link rel="stylesheet" href="./css/employe.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/toastr.min.js"></script>
</head>

<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    header("Location:index2.php");
}
require_once 'config.php';
require_once 'nav.php';
require_once './assets/showMessage.php';

$inN = false;
$admin_name = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_employe'])) {
        if (isset($_SESSION['admin_login'])) { //* <---- Check Admin Is LoggedIn Or Not ---->
            if (isset($_SESSION['admin_name'])) {
                $admin_name = $_SESSION['admin_name'];
                $dateOfBirth = $_POST['dob'];
                $today = new DateTime();   // Current date
                $diff = date_diff(date_create($dateOfBirth), $today);  // Finds the difference
                $age = $diff->y;   // Gets the year difference (i.e., the age)

                if ($age >= 18) {

                    $eName = trim($_POST['unm']);
                    $empContact = $_POST['empContact'];
                    $empEmail = $_POST['empEmail'];
                    $package = $_POST['package'];
                    $password = $_POST['pwd'];
                    $depart = $_POST['dep'];
                    $Jdate = $_POST['jd'];
                    $designation = $_POST['designation'];

                    if ($Jdate != $dateOfBirth) {
                        $select = "SELECT email, contact  FROM _emp_regi WHERE email='$empEmail' OR contact='$empContact'
                                UNION
                                SELECT email, contact FROM _admin_regi WHERE email='$empEmail' OR contact='$empContact'"; //* <---- FOR CHECK DUPLICATE EMPLOYE ---->
                        $run = mysqli_query($con, $select);
                        $NumExitscheck = mysqli_num_rows($run);
                        if ($NumExitscheck > 0) {
                            ShowError('Employee Already Registed', 'Sorry!');
                        } else { //* <------ INSERT NEW EMPLOYES ------>
                            $Hashpwd = password_hash($password, PASSWORD_DEFAULT);
                            if ($depart == "Administration") {
                                $insert = "INSERT INTO `_admin_regi` (`name`,`password`,`Jdate`,`dob`,`package`,`contact`,`email`,`dep`,`designation`) VALUES ('$eName','$Hashpwd','$Jdate','$dateOfBirth','$package','$empContact','$empEmail','$depart','$designation') ";
                            } else {
                                $insert = "INSERT INTO `_emp_regi`(`Ename`, `contact`, `email`, `DOB`, `password`, `Jdate`, `dep`,`package`,`admin`,`designation`) VALUES ('$eName','$empContact','$empEmail','$dateOfBirth','$Hashpwd','$Jdate','$depart','$package','$admin_name','$designation')";
                            }
                            $Run = mysqli_query($con, $insert);
                            $inN = true;
                            if (!$Run)
                                die("Not Working" . mysqli_error($con));
                            if ($inN == true) {
                                ShowSuccess('Employe Registerd Successfully', 'Congrats!');
                            }
                        }
                    } else {
                        ShowError('Enter Valid Dates', 'Please!');
                    }
                } else {
                    ShowError('Enter Valid Date of Birth', 'Please!');
                }

            } else { //* <---- If Not Logged Then Redirect To Signin ----->
                $_SESSION['redirect_for_false_crendentials'] = 0;
                ?>
                <script>
                    window.location = "adminSignin.php";
                </script>
                <?php
            }
        } else {
            header("location:index2.php");
        }
    }
}
?>

<body>
    <div class="container mt-5">
        <form action="registration.php" method="post">
            <div class="title container mb-5">
                <h1 class="fw-semibold">Employe&nbsp; Registration</h1>
            </div>
            <label for="unm">&nbsp;Employe Name :</label>
            <input type="text" name="unm" class="in form-control mt-1 p-2" id="unm" placeholder="Enter Employe Name..."
                required>

            <div class="row">
                <div class="col-md-6">
                    <label for="employeeContact" class="mt-3 ">&nbsp;Employe Contact No. :</label>
                    <input type="text" name="empContact" maxlength="10" class="in form-control mt-1 p-2"
                        id="employeeContact" placeholder="Enter Employe Contact No..." required>
                </div>
                <div class="col-md-6">
                    <label for="empEmail" class="mt-3 ">&nbsp;Employe Email :</label>
                    <input type="email" name="empEmail" class="in form-control mt-1 p-2" id="empEmail"
                        placeholder="Enter Employe Email..." required>
                </div>
            </div>

            <label for="pwd" class="mt-3 ">&nbsp;Enter Password :</label>
            <input type="password" name="pwd" maxlength="8" minlength="6" class="in form-control mt-1 p-2" id="pwd"
                placeholder="Enter Password..." required>

            <div class="row">
                <div class="col-md-6">
                    <label for="jd" class="mt-3 ">&nbsp;Enter Joing Date :</label>
                    <input type="date" name="jd" class="in form-control mt-1 p-2" id="jd"
                        max="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="dob" class="mt-3 ">&nbsp;Enter Date of Birth :</label>
                    <input type="date" name="dob" class="in form-control mt-1 p-2" id="dob" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="dep" class="mt-3 "> &nbsp;Entre Department :</label>
                    <select name="dep" id="dep" class="in form-control mt-1 p-2">
                        <option value="Marketing">Marketing</option>
                        <option value="Sales">Sales</option>
                        <option value="Product">Product</option>
                        <option value="Human Resource">Human Resource</option>
                        <?php
                        if (isset($_SESSION['designation'])) {
                            if ($_SESSION['designation'] == "superadmin") {
                                ?>
                                <option value="Administration">Administration</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="designation" class="mt-3 "> &nbsp;Entre Designation :</label>
                    <input type="text" name="designation" class="in form-control mt-1 p-2" id="designation"
                        placeholder="Enter Designation..." required>
                </div>
            </div>

            <label for="package" class="mt-3 ">&nbsp;Enter Package :</label>
            <input type="text" name="package" maxlength="10" class="in form-control mt-1 p-2" id="package"
                placeholder="Enter Package..." required>

            <input type="submit" value="Add Employee" name="add_employe" class="addEmp btn fw-semibold mt-3 mb-5">
            <input type="reset" value="Clear" class="btn btn-sm btn-outline-dark fw-semibold btn-light mt-3 mb-5">
        </form>
    </div>
    <!--//* Include Footer  -->
    <?php include "footer.php"; ?>

    <!--//*Source files for jqueryCDN and other CDN , toastr css-->
    <script src="./js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./css/toastr.css" />
    <script src="./js/jquery.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>