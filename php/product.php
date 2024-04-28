<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $productName = $_POST['productName'];
    $productPrice = $_POST['price'];
    $productQuantity = $_POST['quantity'];

    // Create a connection to the MySQL database
    include "../php/config.php";

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO product_table (name, price, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $productName, $productPrice, $productQuantity);

    // Execute the SQL statement
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../php/employee_dashboard.php?success=Record inserted successfully");
        exit();
    } else {
        $stmt->close();
        $conn->close();
        $error_message = "Could not add new record";
        header("Location: ../php/employee_dashboard.php?error=" . urlencode($error_message));
        exit();
    }
}
?>