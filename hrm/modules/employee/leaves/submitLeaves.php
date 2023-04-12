<?php

$file = "testPhp.log";
$message = "This is a log message";
// Print the log message to a file
error_log($message . "\n", 3, $file);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $no_of_days = $_POST['no-of-days'];
    $leave_type = $_POST['leave-type'];
    $employeeId = $_POST['employeeId'];

    // print($_POST['no-of-days']); die();

    // echo $employeeId;
    $file = "testPhp.log";
    $message = "This is a log message";
    // Print the log message to a file
    error_log($message . "\n", 3, $file);

    // // Insert the data into the database
    $stmt = $pdo->prepare("INSERT INTO employee_leaves (emp_id, no_of_days, leave_type) VALUES (?, ?, ?)");
    $success = $stmt->execute([$employeeId, $no_of_days, $leave_type]);

    if ($success) {
        error_log("Data inserted successfully" . "\n", 3, $file);
    } else {
        error_log("Error inserting data: " . $stmt->errorInfo()[2] . "\n", 3, $file);
    }

    // Send a response to the client
    // header('Content-Type: application/json');
    echo json_encode(['status' => 'success']);
} else {
    // Send a response to the client
    // header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

?>