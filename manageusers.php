<?php 
include 'nav.php'; 
include "db_connect.php";

?> 
 
 <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Dajac Inc. - Report Test</title>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.3/css/jquery.dataTables.css">
  
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
	$('#classTable').dataTable( {
		"pagingType": "full_numbers"
	} );
	$('#userTable').dataTable( {
		"pagingType": "full_numbers"
	} );
} );
</script>
</head>

<body>

<div class="container-fluid">
  	<div class="row">
	    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    <h1 class="page-header">Manage Users</h1>
			<table id="userTable" class="display table" cellspacing="0" width="100%">
			    <thead>
			        <tr>
			            <th>User Name</th>
			            <th>First Name</th>
			            <th>Last Name</th>
			            <th>EMail</th>
			            <th>Employee ID</th>
			            <th>Role</th>
			            <th>Class</th>	
			        </tr>
			    </thead>
			    <tbody>
			<?php 
				$list = "";
				$sql = "SELECT * FROM T_USER";
				$result = mysqli_query($link, $sql) or die(mysqli_error($link));
				
				   
				while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
				{	
						Print '<tr><td>'.$row["UserName"].'</td><td>'.$row["FirstName"].'</td><td>'.$row["LastName"].'</td><td>'.$row["Email"].'</td><td>'.$row["EmployeeID"].'</td><td>'.$row["Role"].'</td><td>'.$row["ClassID"].'</td>
						<td>
							<a href="newuser.php?
							UserName='.$row["UserName"].'
							&FirstName='.$row["FirstName"].'
							&LastName='.$row["LastName"].'
							&Email='.$row["Email"].'
							&EmployeeID='.$row["EmployeeID"].'
							&Role='.$row["Role"].'
							&ClassID='.$row["ClassID"].'
							"><i class="modifyicon fa fa-pencil"></i></a>
							<a href="#"><i class="modifyicon fa fa-times"></i></a>
						</td></tr>';
				
				}

							
						
			?>	

			    </tbody>
			</table>
			<form action="/dajacinc/dev/newuser.php">
    			<input type="submit" value="Add New User" class="btn btn-success">
			</form>
			<table id="classTable" class="display table" cellspacing="0" width="100%">
			    <thead>
			        <tr>
			            <th>ClassName</th>
			            <th>Description</th>
			            <th>Hourly Cost</th>
			            <th>Charge Through Rate</th>
			            <th>Active</th>
			        </tr>
			    </thead>
			    <tbody>
			<?php 
				$list = "";
				$sql = "SELECT * FROM T_USER_CLASS";
				$result = mysqli_query($link, $sql) or die(mysqli_error($link));
				
				   
				while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
				{	
						Print '<tr><td>'.$row["ClassName"].'</td><td>'.$row["Description"].'</td><td>'.$row["HourlyCost"].'</td><td>'.$row["ChargeThroughRate"].'</td><td>'.$row["Active"].'</td>
						<td>
							<a href="newclass.php?
							ClassID='.$row["ClassID"].'
							&ClassName='.$row["ClassName"].'
							&Description='.$row["Description"].'
							&HourlyCost='.$row["HourlyCost"].'
							&ChargeThroughRate='.$row["ChargeThroughRate"].'
							&Active='.$row["Active"].'
							"><i class="modifyicon fa fa-pencil"></i></a>
							<a href="#"><i class="modifyicon fa fa-times"></i></a>
						</td></tr>';
				
				}

							
						
			?>	

			    </tbody>
			</table>
			<form action="/dajacinc/dev/newclass.php">
    			<input type="submit" value="Add New Class" class="btn btn-success">
			</form>
		</div>
	</div>
</div>
</body>

</html> 
