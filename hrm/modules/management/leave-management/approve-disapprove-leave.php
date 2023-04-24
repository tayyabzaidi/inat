<?php


echo $_SESSION['designation'];

$designation = $_SESSION['designation'];

$leaveStatusId = $_POST['leaveStatusId'];

$comments = $_POST['comments'];
$statusId = 1;

if (isset($_POST['approve']) && $designation == "DEPARTMENT HEAD")
    $statusId = 1;
else if ($designation == "DEPARTMENT HEAD")
    $statusId = 3;
else if (isset($_POST['approve']) &&  $designation == "HR MANAGER")
    $statusId = 5;
else if ($designation == "HR MANAGER")
    $statusId = 6;
else if (isset($_POST['approve']) && $designation == "Operational Manager")
    $statusId = 7;
else if ($designation == "Operational Manager")
    $statusId = 8;
else if (isset($_POST['approve']) && $designation == "GENERAL MANAGER")
    $statusId = 9;
else if ($designation == "GENERAL MANAGER")
    $statusId = 10;


$success = $pdo->query("INSERT INTO employee_leave_status (leaveId,statusId,comments) VALUES ('" . $leaveStatusId . "', '" . $statusId . "', '" . $comments . "')");


echo '<script>window.location.href="leave-management";</script>';
?>

<p></p>