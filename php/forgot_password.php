<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="/css/style3.css">
</head>
<body>
    <div id="container">
        <h2>Enter your Email</h2>
        <div id="line"></div>
        <form action="../php/forgot_password_process.php " method="POST" autocomplete="off">     
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="submit" name="verify" value="Verify">
        </form>
    </div>
</body>
</html>