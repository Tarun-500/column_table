<?php
 include 'config.php';
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$users = array();
while($row = $result->fetch_assoc()) {
    $user_id = $row['id'];
    $custom_sql = "SELECT cc.column_class, ccv.value FROM custom_column_values ccv
                   JOIN custom_columns cc ON ccv.column_id = cc.id
                   WHERE ccv.user_id = $user_id";
    $custom_result = $conn->query($custom_sql);
    while($custom_row = $custom_result->fetch_assoc()) {
        $row[$custom_row['column_class']] = $custom_row['value'];
    }
    $users[] = $row;
}

echo json_encode($users);

$conn->close();