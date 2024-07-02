<?php
include 'config.php';

$name = $_POST['name'];
$nickname = $_POST['nickname'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$role = $_POST['role'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$profile_image = $_FILES['profile_image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($profile_image);

$response = [];

if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
    $sql = "INSERT INTO users (name, nickname, mobile, email, role, address, gender, profile_image) VALUES ('$name', '$nickname', '$mobile', '$email', '$role', '$address', '$gender', '$target_file')";
    if ($conn->query($sql) === true) {
        $user_id = $conn->insert_id;
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'custom_') === 0) {
                $column_class = str_replace('custom_', '', $key);
                
                // Check if the custom column exists
                $custom_sql = "SELECT id FROM custom_columns WHERE column_class = '$column_class'";
                $custom_result = $conn->query($custom_sql);
                
                if ($custom_result->num_rows == 0) {
                    // Insert the custom column if it doesn't exist
                    $column_name = ucfirst(str_replace('_', ' ', $column_class)); 
                    $insert_custom_column_sql = "INSERT INTO custom_columns (column_name, column_class, is_visible) VALUES ('$column_name', '$column_class', 1)";
                    $conn->query($insert_custom_column_sql);
                    $column_id = $conn->insert_id;
                } else {
                    $custom_row = $custom_result->fetch_assoc();
                    $column_id = $custom_row['id'];
                }
                
                // Insert the custom column value
                $value = $conn->real_escape_string($value);
                $insert_value_sql = "INSERT INTO custom_column_values (user_id, column_id, column_class, value) VALUES ($user_id, $column_id, '$column_class', '$value')";
                $conn->query($insert_value_sql);
            }
        }
        $response['message'] = "New record created successfully";
    } else {
        $response['error'] = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $response['error'] = "Sorry, there was an error uploading your file.";
}

$conn->close();
echo json_encode($response);
