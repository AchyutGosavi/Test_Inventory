<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asset_inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if record already exists
$sql_check = "SELECT * FROM assets WHERE employee_id = ? AND asset_tag = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ss", $_POST['employee_id'], $_POST['asset_tag']);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    // Record exists, update it
    $sql_update = "UPDATE assets SET employee_name = ?, cpu_no = ?, service_tag = ?, purchase_date = ?, issued_status = ?, issued_date = ?, verification_status = ? WHERE employee_id = ? AND asset_tag = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssssss", $_POST['employee_name'], $_POST['cpu_no'], $_POST['service_tag'], $_POST['purchase_date'], $_POST['issued_status'], $_POST['issued_date'], $_POST['verification_status'], $_POST['employee_id'], $_POST['asset_tag']);
    
    if ($stmt_update->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $stmt_update->error;
    }

    $stmt_update->close();
} else {
    // Record does not exist, insert it
    $sql_insert = "INSERT INTO assets (employee_name, employee_id, cpu_no, asset_tag, service_tag, purchase_date, issued_status, issued_date, verification_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sssssssss", $_POST['employee_name'], $_POST['employee_id'], $_POST['cpu_no'], $_POST['asset_tag'], $_POST['service_tag'], $_POST['purchase_date'], $_POST['issued_status'], $_POST['issued_date'], $_POST['verification_status']);
    
    if ($stmt_insert->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt_insert->error;
    }

    $stmt_insert->close();
}

$stmt_check->close();
$conn->close();
?>