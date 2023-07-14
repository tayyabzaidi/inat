<?php

$designation = $_SESSION['designation'];

$tripId = $_POST['tripId'];

$statusId = 1;

if (isset($_POST['approve']) && $designation == "DEPARTMENT HEAD")
    $statusId = 1;
else if ($designation == "DEPARTMENT HEAD")
    $statusId = 3;
else if (isset($_POST['approve']) && $designation == "HR MANAGER")
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

$pdo->bind('tripId', $tripId);
$pdo->bind('statusId', $statusId);

$success = $pdo->query("INSERT INTO `employee_trip_status`(`tripId`, `statusId`) VALUES (:tripId,:statusId)");


echo '<script>window.location.href="trip";</script>';
?>

<p></p>