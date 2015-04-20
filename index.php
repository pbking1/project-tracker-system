
<!DOCTYPE html>
<?php 
  require_once("db_connect.php");
  session_start();
  $error = NULL;

  if(isset($_SESSION['uid'])) {
    header( 'Location: /dajacinc/dev/dashboard.php' ) ;
  }

  if (isset($_POST['password'])) {
      $sql = "SELECT Password, Role FROM `T_USER` WHERE Username = '".$_POST['username']."' LIMIT 0,1";
      $result = mysqli_query($link, $sql);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

      // We have ourselves a user or projectmanager
      if ($row) {
          // If password is wrong, stop
          if ($_POST['password'] != $row['Password']) {
            $error =  "password is wrong!";
          }
          // Otherwise the user is now logged in
          else {
            $_SESSION["uid"] = $_POST['username'];
            if ($_POST['Role'] == 'User') {
              $_SESSION["usertype"] = 'user';  
            }
            if ($_POST['Role'] == 'ProjectManager') {
              $_SESSION["usertype"] = 'projectmanager';
            }
            header( 'Location: /dajacinc/dev/dashboard.php' ) ;
          }
      }

      // If the username is not found in users...
      if (!$row) {
        // Try to find an admin instead
        $sql = "SELECT password FROM `T_ADMIN` WHERE Username = '".$_POST['username']."' LIMIT 0,1";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        // Still can't find the user? something is wrong!
        if (!$row) {
          $error =  "username not found!";  
        }
        // Found ourselves an admin
        if ($row) {
          // If password is wrong, stop
          if ($_POST['password'] != $row['password']) {
            $error =  "password is wrong!";
          }
          // Otherwise the user is now logged in
          else {
            $_SESSION["uid"] = $_POST['username'];
            $_SESSION["usertype"] = 'admin';
            header( 'Location: /dajacinc/dev/dashboard.php' ) ;
          }
        }
      }

  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dajac Inc. - Login</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <link href="css/custom.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

      <!-- Sign In Form -->
      <?php 
        if (isset($error)) {
          echo "<div class='alert alert-warning' role='alert'>$error</div>";
        }
      ?>
      <form class="form-signin" role="form" action="index.php" method="POST">
        <h2 class="form-signin-heading"><img src="img/logo-dark.svg" id="signinlogo" width="50px" height="50px">Dajac Inc.</h2>
        <input type="text" name='username' class="form-control" placeholder="Username" required autofocus>
        <input type="password" name='password' class="form-control" placeholder="Password" required>
		<a href="#">Forgot your password?</a>
        <button style="padding-top: 10px;" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
      <!-- /Sign In Form -->

    </div> <!-- /container -->

  </body>
</html>
