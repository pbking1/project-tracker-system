<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Customer</title>
  </head>
  <body>

    <?php include('nav.php'); require_once("db_connect.php");?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New Customer</h1>

          <form role="form" action="newcustomer.php" method="post">
            <div class="form-group">
              <label for="exampleInputEmail1">Customer Name</label>
              <input name="name" type="text" class="form-control" id="CustomerName" placeholder="Enter customer name" value="aa">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Customer Address</label>
			  <!--textarea name="address" class="form-control" rows="3" id="CustomerAddress" placeholder="Enter the customer's address" value="bb"></textarea-->
			  <input name="address" type="text" class="form-control"  value="bb">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Notes</label>
			  <!--textarea name="note" class="form-control" id="Notes" rows="5" placeholder="" value="cc"></textarea-->
			  <input name="note" type="text" class="form-control" value="cc">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="yes">Active</option>
              <option value="no" selected>Inactive</option>
              </select>
            </div>

            <button type="submit" class="btn btn-default">Add Customer</button>
          </form>
	<?php
	//$conn = mysql_connect("localhost", "root", "root");
	//mysql_select_db("dajac", $conn);
	$sql = "insert into T_CUSTOMER (CustomerName, CustomerAddress, Notes, Active) values ('$_POST[name]','$_POST[address]','$_POST[note]','$_POST[Active]')";
	mysql_query($sql, $conn);
	mysql_close($conn);
	?>
        </div>
      </div>
    </div>
  </body>
</html>
