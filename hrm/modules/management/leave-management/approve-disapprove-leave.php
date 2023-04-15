<?php

$leaveStatusId = $_POST['leaveStatusId'];

$comments = $_POST['comments'];
$statusId = 1;

if (!isset($_POST['approve']))
    $statusId = 3;

$success = $pdo->query("INSERT INTO employee_leave_status (leaveId,statusId,comments) VALUES ('" . $leaveStatusId . "', '" . $statusId . "', '" . $comments . "')");


echo '<script>window.location.href="leave-management";</script>';
?>

<p></p>