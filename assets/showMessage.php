<?php
function getQuery($role, $created_by)
{
    $query = "";
    if ($role == "superadmin") {
        $query = "
        SELECT 
        id,
        name AS full_name,
        Jdate,
        dob,
        package,
        contact,
        email,
        dep,
        designation,
        created_by
        FROM _admin_regi WHERE `dep`='Administration' AND `designation` != 'superadmin'

        UNION ALL

        SELECT 
        id,
        Ename AS full_name,
        Jdate,
        DOB AS dob,
        package,  
        contact,
        email,
        dep,
        designation,
        created_by
        FROM _emp_regi";
    } else {
        $query = "
        SELECT 
        id,
        name AS full_name,
        Jdate,
        dob,
        package,
        contact,
        email,
        dep,
        designation,
        created_by
        FROM _admin_regi WHERE `dep`='Administration' AND `designation` != 'superadmin' AND `created_by`='$created_by'

        UNION ALL

        SELECT 
        id,
        Ename AS full_name,
        Jdate,
        DOB AS dob,
        package,  
        contact,
        email,
        dep,
        designation,
        created_by
        FROM _emp_regi WHERE `created_by`='$created_by'
        ";
    }
    return $query;
}

function ShowError($msg, $subMsg)
{
    ?>
    <script>
        $(document).ready(function () {
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
            toastr.error("<?php echo $msg; ?>", "<?php echo $subMsg ?>");
        });
    </script>
    <?php
}
function ShowInfo($msg, $subMsg)
{
    ?>
    <script>
        $(document).ready(function () {
            toastr.options = {
                "closeButton": true,          // Show close button
                "debug": false,
                "newestOnTop": true,          // Keep the newest toastr on top
                "progressBar": true,          // Show progress bar
                "positionClass": "toast-top-right", // Positionof toastr
                "preventDuplicates": false,   // Allow multiple toastr messages
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",            // Auto close after 5s
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.info("<?php echo $msg; ?>", "<?php echo $subMsg ?>");
        });
    </script>
    <?php
}
function ShowSuccess($msg, $subMsg)
{
    ?>
    <script>
        $(document).ready(function () {
            toastr.options = {
                "closeButton": true,          // Show close button
                "debug": false,
                "newestOnTop": true,          // Keep the newest toastr on top
                "progressBar": true,          // Show progress bar
                "positionClass": "toast-top-right", // Positionof toastr
                "preventDuplicates": false,   // Allow multiple toastr messages
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",            // Auto close after 5s
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success("<?php echo $msg; ?>", "<?php echo $subMsg ?>");
        });
    </script>
    <?php
}
?>