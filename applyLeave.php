<?php
require_once "nav.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Apply Leave</title>
    <style>
        .apply-leave .container {
            max-width: 420px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(126, 34, 206, 0.08);
            padding: 32px 28px;
        }

        .apply-leave h2 {
            color: #7e22ce;
            text-align: center;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .apply-leave label {
            display: block;
            margin-bottom: 8px;
            color: #7e22ce;
            font-weight: 500;
        }

        .apply-leave select,
        .apply-leave input[type="date"],
        .apply-leave textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 15px;
            background: #fafaff;
            color: #333;
            transition: border-color 0.2s;
        }

        .apply-leave select:focus,
        .apply-leave input:focus,
        .apply-leave textarea:focus {
            border-color: #7e22ce;
            outline: none;
        }

        .apply-leave textarea {
            resize: vertical;
            min-height: 60px;
            max-height: 140px;
        }

        .apply-leave .btn {
            width: 100%;
            background: #7e22ce;
            color: #fff;
            border: none;
            padding: 12px 0;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .apply-leave .btn:hover {
            background: #6b1bb1;
        }
    </style>
</head>

<body>
    <div class="apply-leave">
        <div class="container">
            <h2>Leave Application Form</h2>
            <form method="post" action="">
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

                <label for="from_date">From Date</label>
                <input type="date" id="from_date" name="from_date" required>

                <label for="to_date">To Date</label>
                <input type="date" id="to_date" name="to_date" required>

                <button type="submit" class="btn">Apply Leave</button>
            </form>
        </div>
    </div>
</body>

</html>