<?php
include "../php/config.php";
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){
   // Validate and sanitize user input
   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_address = mysqli_real_escape_string($conn, $_POST['update_address']);
   $update_phone_num = mysqli_real_escape_string($conn, $_POST['update_phone_num']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   // Update profile information
   $update_query = "UPDATE `users_table` SET name = '$update_name', address = '$update_address', phone_number = '$update_phone_num', email = '$update_email' WHERE id = '$user_id'";
   mysqli_query($conn, $update_query) or die('Query failed');

   // Update password if provided
   $old_pass = $_POST['old_pass'];
   $new_pass = $_POST['new_pass'];
   $confirm_pass = $_POST['confirm_pass'];

   if(!empty($old_pass) || !empty($new_pass) || !empty($confirm_pass)){
      // Check if old password matches
      $password_query = "SELECT password FROM `users_table` WHERE id = '$user_id'";
      $result = mysqli_query($conn, $password_query) or die('Query failed');
      $row = mysqli_fetch_assoc($result);
      $db_password = $row['password'];

      if(!password_verify($old_pass, $db_password)){
         $error = "Old password does not match!";
         header("Location: ../php/employee_dashboard.php?error=$error");
         exit();

      } elseif($new_pass != $confirm_pass){
         $error = "Confirm password does not match!";
         header("Location: ../php/employee_dashboard.php?error=$error");
         exit();

      } else {
         // Hash and update the password
         $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);
         $update_password_query = "UPDATE `users_table` SET password = '$hashed_password' WHERE id = '$user_id'";
         mysqli_query($conn, $update_password_query) or die('Query failed');
         header("Location: ../php/employee_dashboard.php?success=Password updated successfully!");
         exit();
      }
   }

   // Update profile image if provided
   if(isset($_FILES['update_image']) && $_FILES['update_image']['error'] === UPLOAD_ERR_OK){
      $update_image = $_FILES['update_image']['name'];
      $update_image_size = $_FILES['update_image']['size'];
      $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
      $update_image_folder = '../upload/'.$update_image;

      // Validate file size
      if($update_image_size > 2000000){
         $error = "Image is too large";
         header("Location: ../php/employee_dashboard.php?error=$error");
         exit();
      } else {
         // Move uploaded file to destination folder
         if(move_uploaded_file($update_image_tmp_name, $update_image_folder)){
            // Update image path in the database
            $update_image_query = "UPDATE `users_table` SET image = '$update_image' WHERE id = '$user_id'";
            mysqli_query($conn, $update_image_query) or die('Query failed');
            header("Location: ../php/employee_dashboard.php?success=Image updated successfully!");
            exit();
         }
      }
   }

   // Handle and display messages
   if(isset($message)){
      foreach($message as $msg){
         echo $msg.'<br>';
      }
   }
}
?>
