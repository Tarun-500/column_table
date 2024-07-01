<?php
include 'config.php';

$userId = $_POST['user_id'];
$columnName = $_POST['column_name'];
$columnClass = $_POST['column_class'];
 echo $sql = "INSERT INTO custom_columns (user_id, column_name, column_class,is_visible) VALUES ($userId, '$columnName', '$columnClass',1)";
$stmt = $conn->prepare($sql);


if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
