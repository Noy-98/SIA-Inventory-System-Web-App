<?php
session_start();

if(isset($_POST['login'])){
    include "../php/config.php";
    
    $email = $_POST['email'];
    $password = $_POST['pass'];
    
    $sql = "SELECT * FROM users_table WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            
            // Insert login session into the database
            $session_id = session_id(); // Generate a unique session ID
            $ipAddress = $_SERVER['REMOTE_ADDR'];
            $login_time = date("Y-m-d H:i:s"); // Get the current login time
            
            $insert_sql = "INSERT INTO login_logs (session_id, email, ip_address, login_time) VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("ssss", $session_id, $email, $ipAddress, $login_time);
            $insert_stmt->execute();
            
            if($row['user_type'] === 'admin'){
                header("Location: admin_dashboard.php"); // Redirect to admin.php for admin user
            } elseif($row['user_type'] === 'employee'){
                header("Location: employee_dashboard.php"); // Redirect to customer.php for customer user
            }
        } else {
            $error = "Invalid email or password";
            header("Location: ../index.php?error=$error");
        }
    } else {
        $error = "No user found";
        header("Location: ../index.php?error=$error");
    }
} else {
    header("Location: ../index.php");
}
?>





