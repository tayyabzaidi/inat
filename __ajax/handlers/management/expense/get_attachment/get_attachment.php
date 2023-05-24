<?php
$expenseId = $_POST["foreignId"];
$type = $_POST["type"];
// Connect to the database
$pdo->bind('id', $expenseId);
$pdo->bind('category', $type);
$result = $pdo->query(
    "SELECT attachment FROM attachment WHERE foreignId = :id and `type` = :category"
);
for ($i = 0; $i < count($result); $i++) {

    // Convert the binary data to a base64-encoded string
    $rows[$i] = base64_encode($result[$i]["attachment"]);
}
$json_array = array('result' => $rows);
$json = json_encode($json_array);
echo $json;

?>