<?php
session_start();
$applicant = '';
$designation = '';
$department = '';
if (isset($_SESSION['designation']) || isset($_SESSION['department'])) {
    $designation = $_SESSION['designation'];
    $department = $_SESSION['department'];
}
if (isset($_SESSION['admin_name'])) {
    $applicant = $_SESSION['admin_name'];
} elseif (isset($_SESSION['emp_name'])) {
    $applicant = $_SESSION['emp_name'];
} else {
    header("Location:index2.php");
}
require_once "nav.php";
require_once 'config.php';
require_once './assets/showMessage.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Apply Leave</title>
    <link rel="stylesheet" href="./css/leave.css">
    <link rel="stylesheet" href="./css/boot.css">
    <link rel="stylesheet" href="./css/toastr.css" />
    <script src="./js/jquery.min.js"></script>
    <script src="./js/toastr.min.js"></script>
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['apply_leave_btn'])) {

        $leaveType = $_POST['leave_type'];
        $reason = $_POST['reason'];
        $fromDate = $_POST['from_date'];
        $toDate = $_POST['to_date'];

        if (strtotime($fromDate) > strtotime($toDate)) {
            ShowError('Enter Valid Dates', 'Oops!');
        } else {
            // Insert leave application into the database
            $insertLeave = "INSERT INTO `_leave_application` (`applicant`,`designation`,`department`,`leave_type`, `reason`, `from_date`, `to_date`) VALUES ('$applicant','$designation','$department','$leaveType', '$reason', '$fromDate', '$toDate')";
            if (mysqli_query($con, $insertLeave)) {
                ShowSuccess('Leave application submitted', 'Successfully!');
            } else {
                ShowError('Failed to submit leave application: ' . mysqli_error($con), 'Error');
            }
        }

    }
}
?>

<body>
    <?php
    if (isset($_GET['approve'])) {
        if ($_GET['approve']) {
            if (isset($_GET['status']) && $_GET['status'] && isset($_GET['id'])) {
                $leaveId = $_GET['id'] ?? null; // Assuming you pass leave_id in
                $status = $_GET['status'] ?? 0; // Assuming you pass leave_id in
                $updateLeave = "UPDATE `_leave_application` SET `status`='$status',`accepted_by`='$applicant' WHERE `id`='$leaveId'";
                $executeUpdate = mysqli_query($con, $updateLeave);
                if (mysqli_affected_rows($con) > 0) {
                    ShowSuccess('Leave application updated successfully', 'Success');
                }
            }
            if (isset($_SESSION['department']) && ($_SESSION['department'] == 'Administration')) {

                $getLeaves = "SELECT * FROM `_leave_application` WHERE `designation` != 'superadmin'";
                $execute = mysqli_query($con, $getLeaves);
                ?>
                <table class="container mt-5 table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Applicant</th>
                            <th>Leave Type</th>
                            <th>Leave Reason</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($execute)) {
                            ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $row['applicant'] ?></td>
                                <td><?= $row['leave_type'] ?></td>
                                <td><?= $row['reason'] ?></td>
                                <td><?= $row['from_date'] ?></td>
                                <td><?= $row['to_date'] ?></td>
                                <?php
                                if ($department == "Administration") {
                                    ?>
                                    <td>
                                        <?php
                                        if ($row['status'] == 1) {
                                            ?>
                                            <span class="badge bg-success p-2">Accepted</span>
                                        </td>
                                        <?php
                                        } else if ($row['status'] == 2) {
                                            ?>
                                            <span class="badge bg-danger p-2">Rejected</span>
                                            </td>
                                        <?php
                                        } else {
                                            ?>
                                            <a href="applyLeave.php?approve=true&id=<?= $row['id'] ?>&status=1"
                                                class="badge bg-success fs-6 text-decoration-none p-2">Accept</a>
                                            <a href="applyLeave.php?approve=true&id=<?= $row['id'] ?>&status=2"
                                                class="badge bg-danger fs-6 text-decoration-none p-2">Reject</a>
                                            </td>
                                        <?php
                                        }
                                }
                                ?>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } else {
                header("Location:index2.php");
            }
        } else {
            ?>
            <script>
                window.location.href = 'index2.php';
            </script>
            <?php
        }
    }
    if (isset($_GET['apply'])) {
        if ($_GET['apply']) {
            ?>
            <div class="apply-leave mt-5">
                <div class="container mt-5">
                    <h2>Leave Application</h2>
                    <form method="post" action="applyLeave.php?apply=true">
                        <label for="leave_type">Leave Type</label>
                        <select id="leave_type" name="leave_type" required>
                            <option value="">Select Leave Type</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Casual Leave">Casual Leave</option>
                            <option value="Earned Leave">Earned Leave</option>
                            <option value="Maternity Leave">Maternity Leave</option>
                            <option value="Other">Other</option>
                        </select>

                        <label for="reason">Leave Reason</label>
                        <textarea id="reason" name="reason" placeholder="Enter reason for leave" required></textarea>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="from_date">From Date</label>
                                <input type="date" id="from_date" name="from_date" min="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="to_date">To Date</label>
                                <input type="date" id="to_date" name="to_date" min="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>

                        <button type="submit" class="btn mt-3" name="apply_leave_btn">Apply Leave</button>
                    </form>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <script src="./js/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/toastr.css" />
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/script.js"></script>
</body>

</html>