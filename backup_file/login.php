<?php
	$con = mysql_connect("localhost", "root", "root");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - Login</title>
  </head>

  <body>
    <div class="container">
      <form class="login" action="login.php" method="post">
        <input type="text" value="username" name="username"/>
        <input type="password" value="password" name="password"/>
        <button type="submit">Sign in</button>
      </form>
    </div> <!-- /container -->

  </body>
</html>
<?php
	$con = mysql_connect("localhost", "root", "root");
	//$flag = mysql_select_db("dajac", $con);
	//if($flag)
	//	echo "connect success";
	//$sql = "select * from T_USER";
	//$result = mysql_query($sql, $con);
	//$result1 = mysql_fetch_array($result);
	//echo $result1[User_ID];

	$flag2 = mysql_select_db("test", $con);
	$sql1 = "insert into T_USER (name, password) VALUES ('$_POST[username]', '$_POST[password]')";
	mysql_query($sql1, $con);
	mysql_close($con);
?>
