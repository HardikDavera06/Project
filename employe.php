<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
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
    if (isset($_POST['sno'])) {
      $dateOfBirth1 = $_POST['dob1'];
      $today = new DateTime();   // Current date
      $diff = date_diff(date_create($dateOfBirth1), $today);  // Finds the difference
      $age = $diff->y;   // Gets the year difference (i.e., the age)
      if ($age >= 18) {
        $sno = $_POST['sno'];
        $Name = $_POST['unm1'];
        $pass = $_POST['pwd1'];
        $date = $_POST['jd1'];
        $depa = $_POST['dep1'];
        $pac = $_POST['package1'];
        $designation1 = $_POST['designation1'];
        $empContact1 = $_POST['empContact1'];
        $empEmail1 = $_POST['empEmail1'];

        if (isset($_POST['delete'])) { //* <----- Script For Delete The Employee ------->
          $id = $_POST['delete'];
          $delete = "DELETE FROM _emp_regi WHERE id = '$id'";
          $RUn = mysqli_query($con, $delete);
          if ($RUn)
            $Del = true;
          if ($Del == true) {
            ShowSuccess('Employe Deleted successfully', 'Admin!');
          }
        } else {
          if (isset($_POST['updateBtn'])) { //* <----- Script For Update The Employee -------> 
            if ($designation1 == 'Admin') {
              if ($depa != "Administration")
                ShowError('You can not change department and designation of admin', 'Sorry!');
              $adminUpdate = "UPDATE `_admin_regi` SET `name` = '$Name', `password` = '$pass',`Jdate` = '$date', `dob`='$dateOfBirth1',`package` = '$pac',`contact`='$empContact1', `email`='$empEmail1' WHERE `_admin_regi`.`id` = '$sno'";
              $RUN = mysqli_query($con, $adminUpdate);
            } else {
              $update = "UPDATE `_emp_regi` SET `Ename` = '$Name', `contact`='$empContact1', `email`='$empEmail1', `DOB`='$dateOfBirth1',`password` = '$pass',`Jdate` = '$date',`dep` = '$depa' , `package` = '$pac',`designation`='$designation1' WHERE `_emp_regi`.`id` = '$sno'";
              $RUN = mysqli_query($con, $update);
              $upN = true;
            }
            if (!$RUN)
              die("Not Working" . mysqli_error($con));
            if ($upN == true) {
              ShowSuccess('Information Updated successfully', 'Admin!');
            }
          }
        }
      } else {
        ShowError('Enter Valid Date of Birth', 'Admin!');
      }

    }

  }
  ?>
  <!--//* Show Modal ------->
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
                <label for="empContact1" class="mt-3 text-dark"> Employee Contact No. :</label>
                <input type="text" name="empContact1" maxlength="10" class="form-control" id="empContact1">
              </div>
              <div class="col-md-6">
                <label for="empEmail1" class="mt-3 text-dark"> Employee Email :</label>
                <input type="email" name="empEmail1" class="form-control" id="empEmail1">
              </div>
            </div>

            <label for="pwd1" class="mt-3 text-dark"> Password :</label>
            <input type="text" name="pwd1" maxlength="8" minlength="6" class="form-control mt-1" id="pwd1">

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
                  <option value="Marketing">Marketing</option>
                  <option value="Sales">Sales</option>
                  <option value="Product">Product</option>
                  <option value="Human_Resource">Human Resource</option>
                  <option value="Administration">Administration</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="designation1" class="mt-3 text-dark"> Designation :</label>
                <input type="text" name="designation1" class="form-control" id="designation1" required>
              </div>
            </div>

            <label for="package1" class="mt-3 ">&nbsp;Package :</label>
            <input type="text" name="package1" maxlength="10" class="form-control mt-1 p-2" id="package1" required>

            <button name="updateBtn" class="update_Btn fw-semibold my-3 mx-2 px-4 btn-sm rounded-2" id="editID">
              Edit
            </button>
            <button class="btn btn-danger btn-sm fw-3 rounded-2 " name="delete" id="editDelete"
              style="letter-spacing:1px;">
              Delete
            </button>
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
          <th>Password</th>
          <th>Email</th>
          <th>Contact No.</th>
          <th>Joing Date</th>
          <th>Date of Birth</th>
          <th>Department</th>
          <th>Designation</th>
          <th>Package</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $select = "
SELECT 
  id,
  name AS full_name,
  password,
  Jdate,
  dob,
  package,
  contact,
  email,
  dep,
  designation,
  NULL AS admin
FROM _admin_regi WHERE `designation`='admin' OR `designation`='Admin'

UNION ALL

SELECT 
  id,
  Ename AS full_name,
  password,
  Jdate,
  DOB AS dob,
  package,
  contact,
  email,
  dep,
  designation,
  admin
FROM _emp_regi
";
        ;
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
            <?php echo $row['password']; ?>
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
            <button class="editData btn" id="<?php echo $row['id']; ?>">Profile</button>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
  <link rel="stylesheet" href="./css/toastr.css" />
  <script src="./js/script.js"></script>

</body>

</html>