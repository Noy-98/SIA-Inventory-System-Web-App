<?php
session_start();

include('config.php');

if (isset($_POST['change'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Validate email, password, and confirm password
    if (empty($email) || empty($password) || empty($cpassword)) {
        $error = "Please fill in all fields.";
        header("Location: ../php/change_password.php?error=" . urlencode($error));
        exit();
    }

    // Check if the new password and confirm password match
    if ($password !== $cpassword) {
        $error = "New password and confirm password do not match.";
        header("Location: ../php/change_password.php?error=" . urlencode($error));
        exit();
    }

    // Sanitize and validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
        header("Location: ../php/change_password.php?error=" . urlencode($error));
        exit();
    }

    // Hash the new password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update the password in the database
    $updateQuery = "UPDATE users_table SET password = ? WHERE email = ? AND date_and_time >= NOW() - INTERVAL 1 DAY";

    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $email);
    mysqli_stmt_execute($stmt);

    $affectedRows = mysqli_stmt_affected_rows($stmt);

    if ($affectedRows > 0) {
        $success = "Your password has been updated successfully.";
        header("Location: ../php/change_password.php?success=" . urlencode($success));
        exit();
    } else {
        $error = "Error updating password: " . mysqli_error($conn);
        header("Location: ../php/change_password.php?error=" . urlencode($error));
        exit();
    }
}
?>


