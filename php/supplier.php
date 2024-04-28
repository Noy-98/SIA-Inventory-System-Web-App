<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $supplierName = $_POST['supplierName'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phone_num'];
    $url = $_POST['url'];

    // Create a connection to the MySQL database
    include "../php/config.php";

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO supplier_table (name, address, phone, url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $supplierName, $address, $phoneNumber, $url);

    // Execute the SQL statement
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../php/admin_dashboard.php?success2=Record inserted successfully");
        exit();
    } else {
        $stmt->close();
        $conn->close();
        $error_message = "Could not add new record";
        header("Location: ../php/admin_dashboard.php?error2=" . urlencode($error_message));
        exit();
    }
}
?>

