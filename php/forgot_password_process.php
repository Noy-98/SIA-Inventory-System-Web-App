<?php
session_start();

    if(isset($_POST['verify'])) {
        $email = $_POST['email'];
    }
    else {
        exit();
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../mail/Exception.php';
    require '../mail/PHPMailer.php';
    require '../mail/SMTP.php';
    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'yajaspacio@gmail.com';                     // SMTP username
        $mail->Password   = 'xnqtqyaiuxpketaa';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('yajaspacio@gmail.com', 'Noys Electronic Shop');
        $mail->addAddress($email);     // Add a recipient

        $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'),0,10);
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Password Reset';
        $mail->Body    = 'To reset your password click <a href="http://localhost/SIA/php/change_password.php?code='.$code.'">here </a>. </br>Reset your password in a day. Thank you!.';

        
        include "../php/config.php";

        $verifyQuery = $conn->query("SELECT * FROM users_table WHERE email = '$email'");

        if($verifyQuery->num_rows) {
            $codeQuery = $conn->query("UPDATE users_table SET code = '$code' WHERE email = '$email'");
                
            $mail->send();
            header("Location: ../index.php?success=Message has been sent, check your email");
        }else{
            $error = "your email is not valid";
            header("Location: ../index.php?error=$error");
        }
        $conn->close();
    
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit();
    }    
?>
