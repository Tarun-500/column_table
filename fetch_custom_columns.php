<?php
include 'config.php';

$userId = $_GET['user_id']; // Fetch user_id from URL

$sql = "SELECT column_name, column_class FROM custom_columns WHERE user_id = ? and is_visible=1";
$sql1 = "SELECT * FROM user_column WHERE user_id = ? and is_visible=1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();


$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$customColumns = array();
while ($row = $result->fetch_assoc()) {
    $customColumns[] = $row;
}

echo json_encode($customColumns);

$stmt->close();
$conn->close();
?>
