<?php
include 'includes/session.php';
if (isset($_SESSION['never_admin']))
  header('location: home/');
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=0.70">
  <meta charset="utf-8">
  <title>ROYALPUPIL INTERNATIONAL SCHOOL</title>
  <link rel="icon" type="image/x-icon" href="./images/favicon.jpeg">
  <link rel='stylesheet' href='./loginscripts/index-bootstrap.min.css'>
  <link rel="stylesheet" href="./loginscripts/style.css">
</head>

<body>
  <form action="verify.php" method="post">
    <div class="container">
      <div id="login-box">
        <div class="logo">
          <img src="./login.jpeg" class="img img-responsive img-circle center-block" />
          <h1 class="logo-caption"><span class="tweak">L</span>og<span class="tweak">i</span>n</h1>
        </div><!-- /.logo -->
        <div class="controls">
          <input type="text" name="email" placeholder="Username" class="form-control" required />
          <br>
          
          <input type="password" name="password" placeholder="Password" class="form-control" required />
          <br>
          <?php
          if (isset($_SESSION['error'])) {
            echo "
          <div class='text-center' style='color:red;'>
            <p>" . $_SESSION['error'] . "</p> 
          </div>
        ";
            unset($_SESSION['error']);
          }
          ?>
          <button type="submit" class="btn btn-default btn-block btn-custom" name="login">Login</button>
        </div>
      </div>
    </div>
    <div id="particles-js"></div>
    <!-- partial -->
    <script src='./loginscripts/index-jquery-1.11.1.min.js'></script>
    <script src="./loginscripts/script.js"></script>

  </form>
</body>

</html>