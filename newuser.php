
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New User</title>
  </head>

  <body>

  <?php include('nav.php'); require_once("db_connect.php");?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New User</h1>

          <form role="form" action="newuser.php" method="post">
            <div class="form-group">
              <label for="FullName">Full Name</label>
              <input name="fullname" type="text" class="form-control" id="FullName" placeholder="i.e. John Smith">
            </div>
            <div class="form-group">
              <label for="UserName">Username</label>
              <input name="username" type="text" class="form-control" id="UserName" placeholder="i.e. johnsmith">
            </div>
            <div class="form-group">
              <label for="Password">Password</label>
              <input name="pwd" type="text" class="form-control" id="Password" placeholder="Enter a password for the user">
            </div>
            <div class="form-group">
              <label for="EmployeeID">Employee ID</label>
              <input name="eid" type="text" class="form-control" id="EmployeeID" placeholder="The user's employee ID">
            </div>
            <div class="form-group">
              <label for="Class">Class</label> <br />
              <select name="class" class="form-control">
              <option value="select" selected>Select a Class</option>
              <option value="engineer">1</option>
              <option value="contractor">2</option>
              </select>
            </div>

            <button type="submit" class="btn btn-default">Add User</button>
          </form>
		<?php
			//$conn = mysql_connect("localhost", "root", "root");
			//mysql_select_db("dajac", $conn);
			$sql = "insert into T_USER (User_ID, Username, Fullname, password, Class_level, ProjectID, Employee_ID) values (4, '$_POST[username]', '$_POST[fullname]', '$_POST[pwd]', '$_POST[class]', 555, '$_POST[eid]')";
			mysql_query($sql, $conn);
		?>
        </div>
      </div>
    </div>
  </body>
</html>
