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
    <link rel="stylesheet" href="../css/style3.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>
<body>
    <div id="container">
        <h2>Change Password</h2>
        <div id="line"></div>
        <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error']; ?>
          </div>
            <?php } ?>

            <?php if(isset($_GET['success'])){ ?>
            <div class="alert alert-success" role="alert">
            <?php echo $_GET['success']; ?>
          </div>
            <?php } ?>
        <form action="../php/change_password_process.php" method="POST" autocomplete="off">     
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="New Password" required><br>
            <input type="password" name="cpassword" placeholder="Confirm Password" required><br>
            <div class="captcha">
              <div class="g-recaptcha" data-sitekey="6LejaKsmAAAAAPMtQhgo1KR1vp5toV6vWU5PmcmL"></div>
            </div>
            <input type="submit" name="change" id="change" value="CHANGE">
        </form>
    </div>
    <script src="../js/script3.js"></script>
</body>
</html>