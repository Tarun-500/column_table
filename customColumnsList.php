<?php
header('Content-Type: application/json');
include 'config.php';

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Fetch all custom columns for the user
    $query = "SELECT column_class, column_name FROM custom_columns WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $columns = [];
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row;
    }

    echo json_encode($columns);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid user ID']);
}

$conn->close();
