<?php
include 'config.php';

$user_id = $_POST['user_id'];
$id = $_POST['id'];
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
if ($profile_image) {
    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
        $sql = "UPDATE users SET name='$name', nickname='$nickname', mobile='$mobile', email='$email', role='$role', address='$address', gender='$gender', profile_image='$target_file' WHERE id=$id";
    } else {
        $response['error'] = "Sorry, there was an error uploading your file.";
        echo json_encode($response);
        exit;
    }
} else {
    $sql = "UPDATE users SET name='$name', nickname='$nickname', mobile='$mobile', email='$email', role='$role', address='$address', gender='$gender' WHERE id=$id";
}

if ($conn->query($sql) === true) {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'custom_') === 0) {
            $column_class = str_replace('custom_', '', $key);
            $value = $conn->real_escape_string($value);
            $custom_sql = "UPDATE custom_column_values SET value='$value' WHERE user_id=$user_id AND column_class='$column_class'";
            $conn->query($custom_sql);
        }
    }
    $response['message'] = "Record updated successfully";
} else {
    $response['error'] = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
echo json_encode($response);
