<?php
include 'config.php';

$user_id = $_POST['user_id'];
$column_name = $_POST['column_name'];
$column_class = $_POST['column_class'];

// Check if column already exists for the user
$stmt = $pdo->prepare("SELECT id FROM custom_columns WHERE user_id = ? AND column_class = ?");
$stmt->execute([$user_id, $column_class]);
$existingColumn = $stmt->fetchColumn();

if (!$existingColumn) {
    // Insert new custom column
    $stmt = $pdo->prepare("INSERT INTO custom_columns (user_id, column_name, column_class, is_visible, is_editable) VALUES (?, ?, ?, 1, 1)");
    $stmt->execute([$user_id, $column_name, $column_class]);
    $custom_column_id = $pdo->lastInsertId();

    // Insert default value into custom_column_value (assuming empty for now)
    $stmt = $pdo->prepare("INSERT INTO custom_column_value (custom_column_id, user_id, value) VALUES (?, ?, '')");
    $stmt->execute([$custom_column_id, $user_id]);

    echo "Custom column added successfully.";
} else {
    echo "A column with this name already exists.";
}