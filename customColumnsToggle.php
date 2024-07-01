<?php
header('Content-Type: application/json');
include 'config.php';

if (isset($_POST['user_id']) && isset($_POST['column_class']) && isset($_POST['is_visible'])) {
    $userId = $_POST['user_id'];
    $columnClass = $_POST['column_class'];
    $isVisible = $_POST['is_visible'];

    // Update the visibility in the database
    $query = "UPDATE custom_columns SET is_visible = ? WHERE user_id = ? AND column_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $isVisible, $userId, $columnClass);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}

$conn->close();
