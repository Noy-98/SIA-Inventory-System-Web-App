<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <title>SIA</title>
  </head>
  <body>

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

  
    <header class="header">
      <nav class="nav">
        <a href="#" class="nav_logo">Inventory System</a>

        <ul class="nav_items">
          <li class="nav_item">
            <a href="#" class="nav_link">Home</a>
            <a href="#" class="nav_link">About</a>
            <a href="#" class="nav_link">Contact</a>
          </li>
        </ul>

        <button class="button" id="form-open">Login</button>
      </nav>
    </header>

    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>
        
        <div class="form login_form">
          <form method="post" action="php/login.php" enctype="multipart/form-data">
            <h2>Login</h2>

            <div class="input_box">
              <input type="email" placeholder="Enter your email" name="email" required/>
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Enter your password" name="pass" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>

            <div class="option_field">
              <a href="/php/forgot_password.php" class="forgot_pw">Forgot password?</a>
            </div>

            <button class="button" type="submit" name="login">Login Now</button>

            <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
          </form>
        </div>

       
        <div class="form signup_form">
          <form method="post" action="php/signup.php" enctype="multipart/form-data">
            <h2>Signup</h2>
            
            <div class="input_box">
              <input type="text" placeholder="Full Name" name="name" required /> 
              <i class="uil uil-user user"></i>
            </div>  
            <div class="input_box">
              <input type="email" placeholder="Email" name="email" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Create password" name="pass" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Confirm password" name="cpass" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <a>Profile Picture</a>
            <div class="input_box">
              <input type="file" name="image" required class="box" accept="image/jpg, image/png, image/jpeg">
            </div>

            <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" id="check" required/>
                <label for="check">By Signing up on our website,<br> you agree to our Terms,<br> Cookie and Policy.</label>
              </span>
            </div>

            <button class="button" type="submit">Signup Now</button>

            <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
          </form>
        </div>
      </div>
    </section>

    <script src="/js/script.js"></script>
  </body>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  </html>
