<?php
$expenseId = $_POST["expenseId"];
// Connect to the database
$pdo->bind('id', $expenseId);
$result = $pdo->query(
    "SELECT attachment FROM attachment WHERE expenseId = :id"
);
for ($i = 0; $i < count($result); $i++) {

    // Convert the binary data to a base64-encoded string
    $rows[$i] = '0x' . bin2hex($result[$i]["attachment"]);
}
$json_array = array('result' => $rows);
$json = json_encode($json_array);
echo $json;

?>