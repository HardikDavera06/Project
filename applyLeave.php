<?php
session_start();
$applicant = '';
$designation = '';
$department = '';
if (isset($_SESSION['designation']) || isset($_SESSION['department'])) {
    $designation = htmlspecialchars($_SESSION['designation']);
    $department = htmlspecialchars($_SESSION['department']);
}
if (isset($_SESSION['admin_name'])) {
    $applicant = htmlspecialchars($_SESSION['admin_name']);
} elseif (isset($_SESSION['emp_name'])) {
    $applicant = htmlspecialchars($_SESSION['emp_name']);
} else {
    header("Location:index2.php");
}
require_once 'config.php';

// Handle AJAX changeStatus request BEFORE any HTML output
if(isset($_GET['changeStatus']) && $_GET['changeStatus'] && isset($_GET['approve']) && $_GET['approve'] && isset($_GET['id']) && isset($_GET['changedStatus'])){
    $leaveId = mysqli_real_escape_string($con, $_GET['id']);
    $status = mysqli_real_escape_string($con, $_GET['changedStatus']);
    $updateStatus = "UPDATE `_leave_application` SET `status`='$status',`updated_by`='$applicant' WHERE `leave_id`='$leaveId'";
    $executeUpdate = mysqli_query($con,$updateStatus);
    if(mysqli_affected_rows($con) > 0){
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Status Updated Successfully']);
        exit;
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
        exit;
    }
}

require_once "nav.php";
require_once 'config.php';
require_once './assets/showMessage.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Apply Leave</title>
    <link rel="stylesheet" href="./css/leave.css">
    <link rel="stylesheet" href="./css/boot.css">
    <link rel="stylesheet" href="./css/toastr.css" />
    <script src="./js/jquery.min.js"></script>
    <script src="./js/toastr.min.js"></script>
</head>
<style>
    .editLeave,.dialog .editLeaveBtn {
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #ffffff;
        font-size: 15px;
        border: 0.5px solid #4158d0;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .editLeave:hover,.dialog .editLeaveBtn:hover {
        background: linear-gradient(-205deg, #c850c0, #4158d0);
        color: whitesmoke;
        transform: scale(0.98);
    }
</style>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['apply_leave_btn'])) {

        $leaveType = mysqli_real_escape_string($con,$_POST['leave_type']);
        $reason = mysqli_real_escape_string($con,$_POST['reason']);
        $fromDate = $_POST['from_date'];
        $toDate = $_POST['to_date'];

        if (strtotime($fromDate) > strtotime($toDate)) {
            ShowError('Enter Valid Dates', 'Oops!');
        } else {
            // Insert leave application into the database
            $insertLeave = "INSERT INTO `_leave_application` (`applicant`,`designation`,`department`,`leave_type`, `reason`, `from_date`, `to_date`) VALUES ('$applicant','$designation','$department','$leaveType', '$reason', '$fromDate', '$toDate')";
            if (mysqli_query($con, $insertLeave)) {
                ShowSuccess('Leave application submitted', 'Successfully!');
            }
        }
    }
    if(isset($_GET['leaveStatus']) || isset($_GET['approve']) ){
        if(isset($_POST['edit_leave_btn'])) {
            $leaveID = $_POST['leaveID'];
            $editLeaveType = mysqli_real_escape_string($con,$_POST['edit_leave_type']);
            $editReason = mysqli_real_escape_string($con,$_POST['edit_reason']);
            $editFromDate = $_POST['edit_from_date'];
            $editToDate = $_POST['edit_to_date'];

            if (strtotime($editFromDate) > strtotime($editToDate)) {
                ShowError('Enter Valid Dates', 'Oops!');
            } else {
                if(isset($_GET['approve'])){
                    $getEmpLeave = "SELECT * FROM `_leave_application` WHERE `leave_id`='$leaveID'";                   
                    $executeGet = mysqli_query($con,$getEmpLeave);
                    $fetchLeave = mysqli_fetch_assoc($executeGet);
                    $EmpApplicant = $fetchLeave['applicant'];
                    $designation = $fetchLeave['designation']; 
                    
                    // update Employee and admins leave application by superadmin
                    $updateLeave = "UPDATE `_leave_application` SET `leave_type`='$editLeaveType',`reason`='$editReason',`from_date`='$editFromDate',`to_date`='$editToDate',`updated_by`='$applicant' WHERE `leave_id`='$leaveID' AND `applicant`='$EmpApplicant' AND `designation`='$designation'";
                } else {
                    // Update own leave application in the database
                    $updateLeave = "UPDATE `_leave_application` SET `leave_type`='$editLeaveType',`reason`='$editReason',`from_date`='$editFromDate',`to_date`='$editToDate' WHERE `leave_id`='$leaveID' AND `applicant`='$applicant'";
                }

                if (mysqli_query($con, $updateLeave)) {
                    if (mysqli_affected_rows($con) > 0) {
                        ShowSuccess('Leave application updated successfully', 'Success');
                        ?>
                            <script>
                                window.location.reload();
                            </script>
                        <?php
                    }
                }

            }
        }
    }
}
?>

<body>

    <!-- //*  Edit Leave Modal -->

    <div class="modal fade" id="editLeaveModal" aria-labelledby="editLeaveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class=" modal-title fs-5 text-success" id="editLeaveModalLabel">Edit Leave</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="dialog modal-body container">
                    <form method="post" class="p-3 fw-semibold" id="editLeaveForm">
                        <input type="hidden" name="leaveID" id="leaveID">

                        <label for="edit_leave_type">Leave Type</label>
                        <select id="edit_leave_type" name="edit_leave_type" class="form-control" required>
                            <option value="">Select Leave Type</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Casual Leave">Casual Leave</option>
                            <option value="Earned Leave">Earned Leave</option>
                            <option value="Maternity Leave">Maternity Leave</option>
                            <option value="Other">Other</option>
                        </select>

                        <label for="edit_reason" class=" mt-3">Leave Reason</label>
                        <textarea id="edit_reason" name="edit_reason" class="form-control" placeholder="Enter reason for leave" required></textarea>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="edit_from_date" class="mt-3">From Date</label>
                                <input type="date" id="edit_from_date" class="form-control" name="edit_from_date" max="<?php echo date('Y-m-d'); ?>"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_to_date" class="mt-3">To Date</label>
                                <input type="date" id="edit_to_date" class="form-control" name="edit_to_date" min="<?php echo date('Y-m-d'); ?>"
                                    required>
                            </div>
                        </div>

                        <button type="submit" class="editLeaveBtn btn mt-4" name="edit_leave_btn">Edit Leave</button>
                        <input type="reset" value="Clear" class="btn btn-sm btn-light btn-outline-dark mt-4 mx-2">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- //* Leave Approve Module */ -->
    <?php
    if (isset($_GET['approve'])) {
        if ($_GET['approve']) {
            // Handle regular request (not changeStatus)
            if(isset($_GET['request']) && $_GET['request'] && (isset($_GET['status']) && isset($_GET['id']))){
                $leaveId = mysqli_real_escape_string($con, $_GET['id']);
                $status = mysqli_real_escape_string($con, $_GET['status']);
                $updateLeave = "UPDATE `_leave_application` SET `status`='$status',`accepted_by`='$applicant' WHERE `leave_id`='$leaveId'";
                $executeUpdate = mysqli_query($con, $updateLeave);

                if (mysqli_affected_rows($con) > 0) {
                    ShowSuccess('Leave application updated successfully', 'Success');
                    // Redirect to clear the URL parameters and prevent re-execution on refresh
                    echo '<script>setTimeout(function(){ window.location.href = "applyLeave.php?approve=true"; }, 100);</script>';
                    exit;
                }
            }

            //* Get Leave application based on admin */
            
            if (isset($_SESSION['department']) && ($_SESSION['department'] == 'Administration')) {
                if ($designation == "superadmin") {
                    $getLeaves = "SELECT * FROM `_leave_application` WHERE `designation` != 'superadmin' ORDER BY `leave_id` DESC";
                } else {
                    $getLeaves = "SELECT * FROM `_leave_application` l JOIN `_emp_regi` e ON e.`created_by` = (SELECT id FROM `_admin_regi` WHERE `name`='$applicant') WHERE l.`applicant` = e.`Ename` AND l.`designation` != 'superadmin'";
                }
                $execute = mysqli_query($con, $getLeaves);
                ?>
                <div class="tb container mt-5 mb-4" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <h1 class="fw-bolder mb-1" style="color: #7e22ce;">Leave&nbsp; Applications</h1>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index2.php" class="text-decoration-none text-secondary">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #7e22ce;">Leave Applications</li>
                    </ul>   
                </div>
                <div class="container border py-3 px-5 text-center rounded-4">
                    <table id="leaveApplication" class="container border my-2 table table-hover table-striped rounded-5 leaveApplication">
                        <thead class="text-center">
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
                                    <td><?= htmlspecialchars($row['applicant'], ENT_QUOTES, 'UTF-8');?></td>
                                    <td><?= htmlspecialchars($row['leave_type'], ENT_QUOTES, 'UTF-8');?></td>
                                    <td><?=  htmlspecialchars($row['reason'], ENT_QUOTES, 'UTF-8');?></td>
                                    <td><?= $row['from_date'] ?></td>
                                    <td><?= $row['to_date'] ?></td>
                                    <?php
                                    if ($department == "Administration") {
                                        ?>
                                        <td>
                                            <?php
                                            if ($row['status'] == 1) {
                                                ?>
                                                <span class="badge bg-success p-2 rounded-3" style="font-size:13px;">Accepted</span>
                                           
                                            <?php
                                            } else if ($row['status'] == 2) {
                                                ?>
                                                <span class="badge bg-danger p-2 rounded-3" style="font-size:13px;">Rejected</span>
                                                
                                            <?php
                                            } else {
                                                ?>
                                                <a href="applyLeave.php?approve=true&id=<?= $row['leave_id'] ?>&status=1&request=true"
                                                    class="btn btn-light btn-sm btn-outline-success rounded-3">Accept</a>
                                                <a href="applyLeave.php?approve=true&id=<?= $row['leave_id'] ?>&status=2&request=true"
                                                    class="btn btn-light btn-sm btn-outline-danger rounded-3">Reject</a>
                                                </td>
                                            <?php
                                            }
                                            if($row['status'] > 0){
                                            ?>
                                                <span class="text-secondary fs-5">|</span> <a class="btn btn-sm text-decoration-none btn-info fw-bolder btn-changeStatus" title="Change Status" onclick="changeStatus(<?=$row['leave_id'];?>,<?= $row['status']?>)"><i class="fa fa-arrows-rotate"></i></a>
                                                <button type="button" class="btn btn-sm text-decoration-none btn-info fw-bolder edit_emp_leave" data-leave-id="<?= htmlspecialchars($row['leave_id']) ?>" data-leave-type="<?= htmlspecialchars($row['leave_type']) ?>" data-reason="<?= htmlspecialchars($row['reason']) ?>" data-from="<?= htmlspecialchars($row['from_date']) ?>" data-to="<?= htmlspecialchars($row['to_date']) ?>" title="Edit Leave" data-bs-toggle="modal" data-bs-target="#editLeaveModal"><i class="fa fa-edit"></i></button>
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
                </div>
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

    //* Leave Status Module  */ 
    
    if (isset($_GET['leaveStatus'])) {
        if ($_GET['leaveStatus']) {
            if (isset($_GET['delete']) && $_GET['delete'] && isset($_GET['leave_id'])) {
                $leaveId = $_GET['leave_id'] ?? null;
                $deleteLeave = "DELETE FROM `_leave_application` WHERE `leave_id`='$leaveId'";
                $executeDelete = mysqli_query($con, $deleteLeave);
                if (mysqli_affected_rows($con) > 0) {
                    ShowSuccess('Leave application deleted successfully', 'Success');
                }
            }
            $showApplication = "SELECT * FROM `_leave_application` WHERE `applicant` = '$applicant'";
            $executeShow = mysqli_query($con, $showApplication);
            ?>
            <div class="tb container mt-5 mb-4"  style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <h1 class="fw-bolder mb-1" style="color: #7e22ce;">Leave&nbsp; Status</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index2.php" class="text-decoration-none text-secondary">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: #7e22ce;">Leave Status</li>
                </ul>
            </div>
            <div class="container border py-3 px-4 text-center rounded-4">
                <table id="leaveStatus" class="container border my-2 table table-hover table-striped rounded-5">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Applicant</th>
                            <th>Leave Type</th>
                            <th>Leave Reason</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        while ($fetchDetails = mysqli_fetch_assoc($executeShow)) {
                            ?>
                            <tr>
                                <td><?= $count; ?></td>
                                <td><?= htmlspecialchars($fetchDetails['applicant'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($fetchDetails['leave_type'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($fetchDetails['reason'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= $fetchDetails['from_date'] ?></td>
                                <td><?= $fetchDetails['to_date'] ?></td>
                                <td>
                                    <?php
                                    if ($fetchDetails['status'] == 0) {
                                        ?>
                                        <span class="badge bg-warning p-2 rounded-3" style="font-size:12px;">Pending!!</span>
                                    </td>
                                    <?php
                                    } else if ($fetchDetails['status'] == 1) {
                                        ?>
                                        <span class="badge bg-success p-2 rounded-3" style="font-size:12px;">Accepted</span>
                                        </td>
                                    <?php
                                    } else {
                                        ?>
                                        <span class="badge bg-danger p-2 rounded-3" style="font-size:12px;">Rejected</span>
                                        </td>
                                    <?php
                                    }
                                    ?>

                                <td>
                                    <?php
                                    if ($fetchDetails['status'] == 0) {
                                        ?>
                                        <button type="button" class="btn btn-sm rounded-3 px-3 edit_leave edit_emp_leave" data-leave-id="<?= htmlspecialchars($fetchDetails['leave_id']) ?>" data-leave-type="<?= htmlspecialchars($fetchDetails['leave_type']) ?>" data-reason="<?= htmlspecialchars($fetchDetails['reason']) ?>" data-from="<?= htmlspecialchars($fetchDetails['from_date']) ?>" data-to="<?= htmlspecialchars($fetchDetails['to_date']) ?>" title="Edit Leave" data-bs-toggle="modal" data-bs-target="#editLeaveModal">
                                            Edit
                                        </button>
                                        <a href="applyLeave.php?leaveStatus=true&delete=true&leave_id=<?= $fetchDetails['leave_id']; ?>"
                                            class="btn btn-sm btn-light btn-outline-danger fw-normal mx-3 rounded-3 "
                                            onclick="if(confirm('Are you sure you want to delete this leave application?')) return true;else return false;">
                                            Delete
                                        </a>
                                    </td>
                                    <?php
                                    } else {
                                        echo '<span class="text-muted p-2 badge bg-light border border-dark rounded-3 px-3" style="font-size:14px;">N/A</span> </td>';
                                    }
                                    ?>
                            </tr>
                            <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
    }

    //* Leave Apply Module  */ 
    
    if (isset($_GET['apply'])) {
        if ($_GET['apply']) {
            ?>
            <div class="apply-leave mt-5">
                <div class="container mt-5">
                    <h2>Leave Form</h2>
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
                                <input type="date" id="from_date" name="from_date" max="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="to_date">To Date</label>
                                <input type="date" id="to_date" name="to_date" min="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>

                        <button type="submit" class="btn mt-3 w-100" name="apply_leave_btn">Apply Leave</button>
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
    <script src="./js/dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable("#leaveApplication", {
            responsive: true,
        });

       new DataTable("#leaveStatus", {
            responsive: true,
        });

        
    </script>
    <script src="./js/script.js"></script>
</body>

</html>