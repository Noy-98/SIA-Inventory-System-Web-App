<?php 

if(isset($_POST['name']) && 
   isset($_POST['email']) &&  
   isset($_POST['pass']) &&
   isset($_POST['cpass'])){

    session_start();
    include "../php/config.php";

    $name = $_POST['name'];
    $email= $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    $data = "name=".$name."&email=".$email;

    $sql1 = "SELECT * FROM users_table WHERE email = '$email'";
    $result = mysqli_query($conn, $sql1);
    $rowCount = mysqli_num_rows($result);
    
    if ($rowCount>0) {
    	$em = "Email already exists!";
    	header("Location: ../index.php?error=$em&$data");
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $em = "Email is not valid";
      header("Location: ../index.php?error=$em&$data");
    }else if($pass!==$cpass){
    	$em = "Password does not match";
    	header("Location: ../index.php?error=$em&$data");
    }else {
      // hashing the password
      $pass = password_hash($pass, PASSWORD_DEFAULT);

      if (isset($_FILES['image']['name']) AND !empty($_FILES['image']['name'])) {
         
         
         $img_name = $_FILES['image']['name'];
         $tmp_name = $_FILES['image']['tmp_name'];
         $error = $_FILES['image']['error'];
         
         if($error === 0){
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_to_lc = strtolower($img_ex);

            $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs)){
               $new_img_name = uniqid($name, true).'.'.$img_ex_to_lc;
               $img_upload_path = '../upload/'.$new_img_name;
               move_uploaded_file($tmp_name, $img_upload_path);

               // Insert into Database
               $sql = "INSERT INTO users_table(name, email, password, image) 
                 VALUES(?,?,?,?)";
               $stmt = $conn->prepare($sql);
               $stmt->execute([$name, $email, $pass, $new_img_name]);

               header("Location: ../index.php?success=Your account has been created successfully");
            }else {
               $em = "You can't upload files of this type";
               header("Location: ../index.php?error=$em&$data");
            }
         }else {
            $em = "unknown error occurred!";
            header("Location: ../index.php?error=$em&$data");
         }

        
      }else {
       	$sql = "INSERT INTO users_table(name, email, password) 
       	        VALUES(?,?,?)";
       	$stmt = $conn->prepare($sql);
       	$stmt->execute([$name, $email, $pass]);

       	header("Location: ../index.php?success=Your account has been created successfully");
      }
    }


}else {
	header("Location: ../index.php?error=error");
}