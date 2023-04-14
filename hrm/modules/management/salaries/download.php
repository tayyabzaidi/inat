<?php
// connect to the database

// retrieve the file from the database
$id = $_GET['id'];

$result = $pdo->query('SELECT * FROM salary WHERE id = 2');


// output the file data
echo $result[0]['slip'];
?>