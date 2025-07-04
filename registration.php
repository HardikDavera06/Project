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
                $eName = trim($_POST['unm']);
                $password = $_POST['pwd'];
                $Jdate = $_POST['jd'];
                $depart = $_POST['dep'];

                //* <---- FOR CHECK DUPLICATE EMPLOYE ---->
                $select = "SELECT * FROM `_emp_regi` where `Ename`='$eName' AND `password`='$password' AND `admin`='$admin_name'";
                $run = mysqli_query($con, $select);
                $NumExitscheck = mysqli_num_rows($run);
                if ($NumExitscheck == 1) {
                    ShowError('Employe Already Existed', 'Admin!');
                } else {
                    //* <------ INSERT NEW EMPLOYES ------>
                    $insert = "INSERT INTO `_emp_regi`(`Ename`, `password`, `Jdate`, `dep`,`admin`) VALUES ('$eName','$password','$Jdate','$depart','$admin_name')";
                    $Run = mysqli_query($con, $insert);
                    $inN = true;
                    if (!$Run)
                        die("Not Working" . mysqli_error($con));
                    if ($inN == true) {
                        ShowSuccess('Employe Registerd Successfully', 'Admin!');
                    }
                }
            } else { //* <---- If Not Logged Then Redirect To Signin ----->
                $_SESSION['redirect_for_false_crendentials'] = 0;
?>
                <script>
                    window.location = "adminSignin.php";
                </script>
<?php
            }
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

            <label for="pwd" class="mt-3 ">&nbsp;Enter Password :</label>
            <input type="password" name="pwd" maxlength="8" minlength="6" class="in form-control mt-1 p-2" id="pwd"
                placeholder="Enter Password..." required>

            <label for="jd" class="mt-3 ">&nbsp;Enter Joing date :</label>
            <input type="date" name="jd" class="in form-control mt-1 p-2" id="jd" value="<?php echo date('Y-m-d'); ?>"
                min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required>

            <label for="dep" class="mt-3 "> &nbsp;Entre Department :</label>
            <select name="dep" id="dep" class="in form-control mt-1 p-2">
                <option value="Marketing">Marketing</option>
                <option value="Sales">Sales</option>
                <option value="Product">Product</option>
                <option value="Human_Resource">Human Resource</option>
                <option value="Admin">Admin</option>
            </select>

            <input type="submit" value="Add Employee" name="add_employe" class="addEmp btn fw-semibold mt-3 mb-5">
            <input type="reset" value="Clear" class="btn btn-sm btn-outline-dark fw-semibold btn-light mt-3 mb-5">
        </form>
    </div>
    <!--//* Include Footer  -->
    <?php include "footer.php"; ?>

    <!--//*Source files for jqueryCDN and other CDN , toastr css-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/toastr.css" />
    <script src="./js/jquery.min.js"></script>
</body>

</html>