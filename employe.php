<?php
session_start();
$created_by = '';
if (isset($_SESSION['admin_name']) || isset($_SESSION['designation'])) {
  $created_by = $_SESSION['admin_name'];
  $designationFromLogin = $_SESSION['designation'];
} else {
  header("Location:index2.php");
}
require_once "nav.php";
require_once "config.php";
require_once "./assets/showMessage.php";

$Del = false;
$upN = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EMPLOYE | EMPLOYE</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
  <link rel="stylesheet" href="./css/employe.css" />
  <script src="./js/jquery.min.js"></script>
  <script src="./js/toastr.min.js"></script>
</head>

<body>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updatePasswordBtn'])) { //* <-- Script for update password -->
      $id = $_POST['passwordID'];
      $department = $_POST['department'];
      $updated_password = $_POST['forgetPassword'];
      $confirm_pswd = $_POST['confirmPassword'];
      $getTable = ($department == "Administration") ? "_admin_regi" : "_emp_regi";

      if ($updated_password == $confirm_pswd) {

        $passwordExistence = "SELECT * FROM `$getTable` WHERE `id`='$id'";
        $executeExistence = mysqli_query($con, $passwordExistence);
        $column = mysqli_fetch_assoc($executeExistence);

        if (password_verify($updated_password, $column['password'])) { //* Check exitence of password into db's table
          ShowError('Please Try Another Password', 'Sorry!');
        } else {
          $hash_update_pswd = password_hash($updated_password, PASSWORD_DEFAULT);
          $updateQuery = "UPDATE `$getTable` SET `password`='$hash_update_pswd',`updated_by`='$created_by' WHERE `id`='$id'"; //* Update password
          $uptPasswordExecute = mysqli_query($con, $updateQuery);
          if (mysqli_affected_rows($con) == 1) {
            ShowSuccess('Password Updated', 'Successfully!');
          }
        }

      } else {
        ShowError("Password didn't match", "Oops!");
      }
    }

    if (isset($_POST['sno'])) {

      $dateOfBirth1 = $_POST['dob1'];
      $date = $_POST['jd1'];
      $diff = date_diff(date_create($dateOfBirth1), date_create($date));  // Finds the difference
      $age = $diff->y;   // Gets the year difference (i.e., the age)
  
      if ($age >= 18) {
        $sno = $_POST['sno'];
        $Name = $_POST['unm1'];
        $depa = $_POST['dep1'];
        $pac = $_POST['package1'];
        $designation1 = $_POST['designation1'];
        $empContact1 = $_POST['empContact1'];
        $empEmail1 = $_POST['empEmail1'];

        $targetTable = ($depa == "Administration") ? "_admin_regi" : "_emp_regi";
        $deleteFromTable = ($depa == "Administration") ? "_emp_regi" : "_admin_regi";
        $nameField = ($depa == "Administration") ? "name" : "Ename";

        if (isset($_POST['delete'])) { //* <----- Script For Delete The Employee ------->
          $delete = "DELETE FROM `$targetTable` WHERE id = '$sno'";
          $RUn = mysqli_query($con, $delete);
          if ($RUn)
            $Del = true;
          if ($Del == true) {
            ShowSuccess('Employe Deleted successfully', 'Admin!');
          }
        } else {
          if (isset($_POST['updateBtn'])) { //* <----- Script For Update The Employee -------> 
            $checkExistence = "SELECT * FROM `$targetTable` WHERE `id`='$sno'";
            $executeExistenceCheck = mysqli_query($con, $checkExistence);
            if (mysqli_num_rows($executeExistenceCheck) > 0) {
              $updateEmployee = "UPDATE `$targetTable` SET `$nameField` = '$Name',`Jdate` = '$date', `dob`='$dateOfBirth1',`package` = '$pac',`contact`='$empContact1', `email`='$empEmail1',`designation`='$designation1',`updated_by`='$created_by' WHERE `$targetTable`.`id` = '$sno'";
              $updateExecute = mysqli_query($con, $updateEmployee);
            } else {
              $Hashpwd = password_hash('NEXGEN@123', PASSWORD_DEFAULT);
              $insertNew = "INSERT INTO `$targetTable` (`$nameField`,`password`,`Jdate`,`dob`,`package`,`contact`,`email`,`dep`,`designation`,`created_by`) VALUES ('$Name','$Hashpwd','$date','$dateOfBirth1','$pac','$empContact1','$empEmail1','$depa','$designation1','$created_by') ";
              $insertExecute = mysqli_query($con, $insertNew);
              if (mysqli_affected_rows($con) == 1) {
                $deleteFromAnother = "DELETE FROM `$deleteFromTable` WHERE `id` = '$sno'";
                $deleteExecute = mysqli_query($con, $deleteFromAnother);
              }
            }
            ShowSuccess('Employee Updated', 'Successfully!');
          }
        }
      } else {
        ShowError('Enter Valid Date of Birth', 'Please!');
      }
    }
  }
  ?>

  <!--//* Show Forget Password Modal  -->
  <div class="modal fade" id="forgetPasswordModal" aria-labelledby="forgetPasswordModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class=" modal-title fs-5 text-success" id="forgetPasswordModal">Forget Password</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="dialog modal-body container">
          <form action="employe.php" method="post" class="form p-3 fw-semibold">
            <input type="hidden" name="department" id="department">
            <input type="hidden" name="passwordID" id="passwordID">

            <label for="forgetPassword" class="text-dark"> Password :</label>
            <input type="password" name="forgetPassword" class="form-control" id="forgetPassword" maxlength="8"
              minlength="6" required>

            <label for="confirmPassword" class="text-dark mt-3"> Confirm Password:</label>
            <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" maxlength="8"
              minlength="6" required>

            <button name="updatePasswordBtn" class="update_Btn fw-semibold mt-4 btn-sm rounded-2"
              id="updatePasswordBtn">
              Forget Password
            </button>
            <button type="reset" class="btn btn-light btn-outline-dark btn-sm mx-2">clear</button>

          </form>
        </div>
      </div>
    </div>
  </div>


  <!--//* Show Edit Emlpoyee Modal ------->
  <div class="modal fade" id="EDITmodal" aria-labelledby="EDITmodal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class=" modal-title fs-5 text-success" id="EDITmodal">Employe Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="dialog modal-body container">
          <form action="employe.php" method="post" class="form p-3 fw-semibold">
            <input type="hidden" name="sno" id="sno">

            <label for="unm1" class="text-dark"> Employe Name :</label>
            <input type="text" name="unm1" class="form-control" id="unm1">

            <div class="row">
              <div class="col-md-6">
                <label for="empEmail1" class="mt-3 text-dark"> Employee Email :</label>
                <input type="email" name="empEmail1" class="form-control" id="empEmail1">
              </div>
              <div class="col-md-6">
                <label for="empContact1" class="mt-3 text-dark"> Employee Contact No. :</label>
                <input type="text" name="empContact1" maxlength="10" class="form-control" id="empContact1">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="jd1" class="mt-3 text-dark"> Joing date :</label>
                <input type="date" name="jd1" class="form-control" id="jd1" value="<?php echo date('Y-m-j'); ?>"
                  required>
              </div>
              <div class="col-md-6">
                <label for="dob1" class="mt-3 text-dark"> Date of Birth :</label>
                <input type="date" name="dob1" class="form-control" id="dob1" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="dep1" class="mt-3 text-dark"> Department :</label>
                <select name="dep1" id="dep1" class="form-control">
                  <?php
                  if (isset($_SESSION['designation'])) {
                    if ($_SESSION['designation'] == "superadmin") {
                      ?>
                  <option value="Administration">Administration</option>
                  <?php
                    }
                  }
                  ?>
                  <option value="Marketing">Marketing</option>
                  <option value="Sales">Sales</option>
                  <option value="Product">Product</option>
                  <option value="Human_Resource">Human Resource</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="designation1" class="mt-3 text-dark"> Designation :</label>
                <input type="text" name="designation1" class="form-control" id="designation1" required>
              </div>
            </div>

            <label for="package1" class="mt-3 ">&nbsp;Package :</label>
            <input type="text" name="package1" maxlength="10" class="form-control mt-1 p-2" id="package1" required>

            <button name="updateBtn" class="update_Btn fw-semibold mt-4 mx-2 px-4 btn-sm rounded-2" id="editID">
              Edit
            </button>
            <?php if (isset($_SESSION['designation']) && $_SESSION['designation'] == "superadmin") { ?>
            <button class="btn btn-danger btn-sm fw-3 rounded-2 " name="delete" id="editDelete"
              style="letter-spacing:1px;">
              Delete
            </button>
            <?php } ?>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div>
    <div class="tb container mt-5 mb-5">
      <h1 class="fw-semibold mb-1">Employes&nbsp; Detail</h1>
    </div>
    <table class="container table table-hover table-striped">
      <thead>
        <tr>
          <th>Serial No.</th>
          <th>Name</th>
          <th>Email</th>
          <th>Contact No.</th>
          <th>Joing Date</th>
          <th>Date of Birth</th>
          <th>Department</th>
          <th>Designation</th>
          <th>Package</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $select = getQuery($designationFromLogin, $created_by);
        $Run1 = mysqli_query($con, $select);
        if (!$Run1)
          die("Not Working" . mysqli_error($con));
        $n = 1;
        while ($row = mysqli_fetch_assoc($Run1)) {
          ?>
        <tr>
          <td>
            <?php echo $n; ?>
          </td>
          <td>
            <?php echo $row['full_name']; ?>
          </td>
          <td>
            <?php echo $row['email']; ?>
          </td>
          <td>
            <?php echo $row['contact']; ?>
          </td>
          <td>
            <?php echo $row['Jdate']; ?>
          </td>
          <td>
            <?php echo $row['dob']; ?>
          </td>
          <td>
            <?php echo $row['dep']; ?>
          </td>
          <td>
            <?php echo $row['designation']; ?>
          </td>
          <td>
            <?php echo $row['package']; ?>
          </td>
          <td class="text-center">
            <div class="row">
              <div class="col-md-6">
                <button class="editData btn" id="<?php echo $row['id']; ?>">Profile</button>
              </div>
              <div class="col-md-6">
                <button class="forgetPassword btn" id="<?php echo $row['id']; ?>">Forget</button>
              </div>
            </div>
          </td>

        </tr>
        <?php
        $n++;
        }
        ?>
      </tbody>
    </table>
  </div>

  <!--//* Source files for jqueryCDN and other CDN -->
  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
  <link rel="stylesheet" href="./css/toastr.css" />
  <script src="./js/script.js"></script>

</body>

</html>