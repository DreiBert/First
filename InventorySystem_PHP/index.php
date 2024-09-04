<?php
  // Start output buffering
  ob_start();
  
  // Include the load.php file which likely contains necessary functions and session handling
  require_once('includes/load.php');
  
  // Check if the user is logged in, if true, redirect to home.php
  if($session->isUserLoggedIn(true)) { 
    redirect('home.php', false);
  }
?>
<?php 
  // Include the header layout
  include_once('layouts/header.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Link to the main CSS file -->
  <style>
    /* Ensure the HTML and body take up the full height and have no margin */
    html, body {
      height: 100%;
      margin: 0;
    }
    /* Style for the login page container */
    .login-page {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding-top: 100px;
      background: transparent;
    }
    .login-form-container {
      width: 100%;
      max-width: 400px;
      border-radius: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      background-color: #fff;
    }
    @media (max-width: 768px) {
      .login-page {
        padding-top: 50px;
      }
      .login-form-container {
        padding: 15px;
      }
    }
    @media (max-width: 480px) {
      .login-page {
        padding-top: 20px;
      }
      .login-form-container {
        padding: 10px;
      }
    }
  </style>
</head>
<body>
<!-- Navigation bar with a fixed position at the top -->
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #088c2c; height: 90px; padding-top: 20px;">
  <div class="container">
    <!-- Logo image positioned within the navbar -->
    <img src="libs/images/dasmarinas logo.png" alt="Logo" style="height: 50px; width: auto; position: absolute; top: 20px; left: 20px;">
  </div>
</nav>
<!-- Login page container -->
<div class="login-page">
    <div class="login-form-container">
        <div class="text-center">
           <h1>Login</h1>
           <h4>Solo Parent Admission Form</h4>
         </div>
         <!-- Display any messages (e.g., errors, notifications) -->
         <?php echo display_msg($msg); ?>
         <!-- Login form -->
          <form method="post" action="auth.php" class="clearfix">
            <div class="form-group">
                  <label for="username" class="control-label">Username</label>
                  <!-- Input field for username -->
                  <input type="name" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="Password" class="control-label">Password</label>
                <!-- Input field for password -->
                <input type="password" name= "password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <!-- Submit button for the login form -->
                <button type="submit" class="btn btn-danger" style="border-radius:0%; width: 100%;">Login</button>
            </div>
        </form>
    </div>
</div>
<?php 
  // Include the footer layout
  include_once('layouts/footer.php'); 
?>
</body>
</html>