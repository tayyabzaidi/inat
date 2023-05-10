<?php
$comment = $_POST['comment'];

// Get the value of the idField field
$idField = $_POST['idField'];
$pdo->bind('reason', $comment);
$pdo->bind('id', $idField);
$result = $pdo->query("UPDATE salary set discrepancy_reason=:reason where id=:id");
echo "Comment saved successfully";

?>