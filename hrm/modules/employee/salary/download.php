<?php
// connect to the database

// retrieve the file from the database
$id = $_GET['id']; // assuming you have an id parameter in the URL
$sql = "SELECT * FROM salary WHERE id = $id";
$result = $conn->query($sql);

// set the download headers
header("Content-Disposition: attachment; filename=" . $result['date']);
header("Content-Type: application/pdf");
header("Content-Length: " . strlen($result['slip']));

// output the file data
echo $result['slip'];
?>