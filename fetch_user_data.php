<?php
header('Content-Type: application/json');

include 'config.php';
// Fetch user data
$sql = "SELECT *  FROM users";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
         $sql1 = "SELECT custom_column_value.value, custom_columns.column_name 
       FROM users  
        LEFT JOIN  custom_column_value ON custom_column_value.user_id = users.id 
       LEFT JOIN custom_columns ON custom_columns.id = custom_column_value.custom_column_id 
      
       WHERE custom_column_value.user_id = '" . $row['id'] . "'";
$result1 = $conn->query($sql1);

if ($result->num_rows > 0) {
    while($row1 = $result1->fetch_assoc()) {
        
        $row[$row1['column_name']] = $row1['value'];
    }
}
$users[] = $row;
    }
}

echo json_encode($users);

$conn->close();
?>
