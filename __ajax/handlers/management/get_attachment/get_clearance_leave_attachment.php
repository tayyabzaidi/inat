<?php
$id = $_POST["id"];
// Connect to the database
$pdo->bind('id', $id);

$result = $pdo->query(
    "SELECT el.clearance from employee_leaves el where id = :id"
);
for ($i = 0; $i < count($result); $i++) {

    // Convert the binary data to a base64-encoded string
    $rows[$i] = base64_encode($result[$i]["attachment"]);
}
$json_array = array('result' => $rows);
$json = json_encode($json_array);
echo $json;
