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
	    <h1 class="page-header">Manage Customers</h1>
			<table id="userTable" class="display" cellspacing="0" width="100%">
			    <thead>
			        <tr>
			            <th>FirstName</th>
			            <th>LastName</th>
			            <th>Notes</th>
			            <th>Street</th>
			            <th>City</th>
			            <th>State</th>
			            <th>Zip</th>
			        </tr>
			    </thead>
			    <tbody>
			<?php 
				$list = "";
				$sql = "SELECT * FROM CUSTOMER_REPORT1";
				$result = mysqli_query($link, $sql) or die(mysqli_error($link));
				
				   
				while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
				{	
						Print '<tr><td>'.$row["FirstName"].'</td><td>'.$row["LastName"].'</td><td>'.$row["Notes"].'</td><td>'.$row["Street"].'</td><td>'.$row["City"].'</td><td>'.$row["State"].'</td><td>'.$row["Zip"].'</td>
						<td>
							<a href="newcustomer.php?
							CustomerID='.$row["CustomerID"].'
							&FirstName='.$row["FirstName"].'
							&LastName='.$row["LastName"].'
							&Notes='.$row["Notes"].'
							&Active='.$row["Active"].'
							&Street='.$row["Street"].'
							&City='.$row["City"].'
							&State='.$row["State"].'
							&Zip='.$row["Zip"].'
							"><i class="modifyicon fa fa-pencil"></i></a>
							<a href="#"><i class="modifyicon fa fa-times"></i></a>
						</td></tr>';
				
				}

							
						
			?>	

			    </tbody>
			</table>
			<form action="/dajacinc/dev/newcustomer.php">
    			<input type="submit" value="Add New Customer" class="btn btn-success">
			</form>
		</div>
	</div>
</div>
</body>

</html> 





















