<?php
// connect to the database

// retrieve the file from the database
$id = $_GET['id'];
$sql = 'SELECT * FROM salary WHERE id = 4';
$result = $conn->query($sql);

echo '------------------------';
// set the download headers
header("Content-Disposition: attachment; filename=" . $result['date']);
header("Content-Type: application/pdf");
header("Content-Length: " . strlen($result['slip']));

// output the file data
echo $result['slip'];
?>