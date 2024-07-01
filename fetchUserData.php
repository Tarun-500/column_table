<?php
include 'config.php';

$user_id = $_GET['id'];
$response = [];

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $response = $result->fetch_assoc();
    // Fetch custom columns
    $custom_sql = "SELECT column_class, value FROM custom_column_values WHERE user_id = $user_id";
    $custom_result = $conn->query($custom_sql);
    while ($row = $custom_result->fetch_assoc()) {
        $response[$row['column_class']] = $row['value'];
    }
} else {
    $response['error'] = "User not found";
}

$conn->close();
echo json_encode($response);
