<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Dajac Inc. - New Class</title>

  </head>
  <body>

<?php include('nav.php'); require_once("db_connect.php");?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New Class</h1>

          <form role="form" action="newclass.php" method="post">
            <div class="form-group">
              <label for="exampleInputEmail1">Class Name</label>
              <input name="classname" type="text" class="form-control" id="ClassName" placeholder="i.e. Engineer">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <input name="des" class="form-control" id="Description" rows="3" placeholder="Briefly describe the class"></input>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Hourly Cost</label>
              <input name="cost" type="text" class="form-control" id="HourlyCost" placeholder="Enter hourly cost in decimal format">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Charge Through Rate</label>
              <input name="rate" type="text" class="form-control" id="ChargeThroughRate" placeholder="Enter charge through in decimal format">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Active/Inactive</label> <br />
              <select name="active" class="form-control">
              <option value="1">Active</option>
              <option value="0" selected>Inactive</option>
              </select>
            </div>

            <button type="submit" class="btn btn-default">Add Class</button>
          </form>
		<?php
			//$conn = mysql_connect("localhost", "root", "root");
			//mysql_select_db("dajac", $conn);
			$sql = "insert into T_USER_CLASS (Class_level, Username, Description, Hourly_cost, Charge_through_rate, Active) values ($_POST[classname] , 'cc', '$_POST[des]', $_POST[cost], $_POST[rate], '$_POST[active]')";
		//	$s = "insert into T_USER_CLASS(Class_level, Username, Description, Hourly_cost, Charge_through_rate, Active) values (0, 'cc', 'aaaa', 1, 1, 1)";
			mysql_query($sql, $conn);
		?>  
        </div>
      </div>
    </div>
  </body>
</html>
