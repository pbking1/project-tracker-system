<!--
need to be list:
T_USER -> T_TIMECARD -> T_USER_CLASS
T_TASK -> T_PROJECT -> T_PROJECT_ASSIGNMENTS -> T_PROJECT_STATISTICS
T_PROJECT -> T_PROJECT_ASSIGNMENTS -> T_PROJECT_STATISTICS -> T_CUSTOMER -> T_ADDRESS -> T_TASK
T_CUSTOMER -> T_ADDRESS -> T_PROJECT -> T_PROJECT_ASSIGNMENTS -> T_PROJECT_STATISTICS
-->
<?php 
include('nav.php'); 
include "db_connect.php";
?>
<html>
	<head>
		<title>search</title>
	</head>
	<body>
		<div class="container-fluid">
  			<div class="row">
	    		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    		<h1 class="page-header">Search</h1>
					<form method="post" action="search.php" name="search">
						<label value="Enter the keyword:">Enter the keyword:</label>
						<label></label>
						<input name="search" type="text" value="" size="15"> <p></p>
						<label value="select the tag:">select the tag:</label>
						<select name="tags">
							<option value="Customer">Customer</option>
							<option value="Project">Project</option>
							<option value="Task">Task</option>
							<option value="User">User</option>
						</select><p></p>
						<input type="submit" value="Search"><p></p>
						<!--<label >T_USER(UserName) -> T_TIMECARD -> T_USER_CLASS</label><p></p>-->
						<!--<label >T_TASK(ProjectID) -> T_PROJECT -> T_PROJECT_ASSIGNMENTS -> T_PROJECT_STATISTICS</label><p></p>-->
						<!--<label >T_PROJECT(ProjectID) -> T_PROJECT_ASSIGNMENTS -> T_PROJECT_STATISTICS -> T_CUSTOMER -> T_ADDRESS -> T_TASK</label><p></p>-->
						<!--<label >T_CUSTOMER(CustomerID) -> T_ADDRESS -> T_PROJECT -> T_PROJECT_ASSIGNMENTS -> T_PROJECT_STATISTICS</label><p></p>-->

					</form>
	<?php
		$conn = mysqli_connect("localhost","acfelder","acfelder");
		mysqli_select_db($conn, "acfelder_db");
		$key_word = $_POST['search'];
		$tag1 = $_POST['tags'];
		if($tag1 == "User"){
			$sql = "select * from T_USER where UserName like '%".$key_word."%'";
			$result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
			print "Result:<br>";
			while($fields = mysqli_fetch_assoc($result)){
				print 	$fields["UserName"]. " ". $fields["FirstName"]. " ". $fields["LastName"]." " . $fields["Email"]." ". $fields["EmployeeID"]." ". $fields["Role"]." ". $fields["ClassID"]." ". $fields["Active"]."<br />";
				//print timecard
				$sql2 = "select * from T_TIMECARD where UserName in (select UserName from T_USER where UserName like '%".$key_word."%')";
				$result1 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
				print "Time card:<br>";
				while($fields = mysqli_fetch_assoc($result1)){
					print $fields["UserName"]. " " . $fields["TaskID"]. " ". $fields["Punch"]. " ". $fields["TotalHours"]. " ". $fields["Running"]. " <br />";
				}
				//print user class
				$sql3 = "select * from T_USER_CLASS where ClassID in (select ClassID from T_USER where ClassID in (select ClassID from T_USER where UserName like '%".$key_word."%'))";
				$result2 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
				print "user class :<br>";
				while($fields = mysqli_fetch_assoc($result2)){
					print $fields["ClassID"]. " " . $fields["ClassName"]. " ". $fields["Description"]. " ". $fields["HourlyCost"]. " ". $fields["ChargeThroughRate"]. " ". $fields["Active"]. " <br />";
				}
			}
			if (mysqli_num_rows($result) == 0) {
				echo "No matches found";
			}
		}
		if($tag1 == "Project"){
			$sql = "select * from T_PROJECT where ProjectID like '%".$key_word."%'";
			$result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
			print "Result:<br>";
			while($fields = mysqli_fetch_assoc($result)){
				print 	$fields["ProjectName"]. " " . $fields["ProjectID"]. " " .  $fields["RevisionLetter"]." " .$fields["MantisID"]." " . $fields["CustomerID"]." ".  $fields["ShortDescription"]." ".  $fields["LongDescription"]." ".  $fields["Active"]." ". $fields["Status"]." ".  $fields["DajacSalesAssoc"]." ". $fields["LocalProRate"]." ".  $fields["GlobalMaterialMarkup"]."<br />";
				//print T_PROJECT_ASSIGNMENTS
				$sql2 = "select * from T_PROJECT_ASSIGNMENTS where ProjectID in (select ProjectID from T_PROJECT where ProjectID like '%".$key_word."%')";
				$result1 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
				print "T_PROJECT_ASSIGNMENTS:<br>";
				while($fields = mysqli_fetch_assoc($result1)){
					print $fields["UserName"]. " " . $fields["ProjectID"] . " <br />";
				}
				//print T_PROJECT_STATISTICS
				$sql3 = "select * from T_PROJECT_STATISTICS where ProjectID in (select ProjectID from T_PROJECT where ProjectID like '%".$key_word."%')";
				$result2 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
				print "T_PROJECT_STATISTICS :<br>";
				while($fields = mysqli_fetch_assoc($result2)){
					print $fields["ProjectID"]. " " . $fields["Raw_Profit"]. " ". $fields["Total_Labor_hour"]. " ". $fields["Total_Labor_cost"]. " ". $fields["Total_Labor_value_quote"]. " ". $fields["Total_material_cost"].  " ". $fields["Total_material_value_quote"].  " ". $fields["Hour_used_pertask"].  " ". $fields["Hour_remain_pertask"]. " ". $fields["Hour_used_for_entireproject"].  " ". $fields["Hour_remain_for_entireproject"].  " <br />";
				}
				//print T_CUSTOMER
				$sql4 = "select * from T_CUSTOMER where CustomerID in (select CustomerID from T_PROJECT where ProjectID like '%".$key_word."%')";
				$result3 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
				print "T_CUSTOMER:<br>";
				while($fields = mysqli_fetch_assoc($result3)){
					print $fields["CustomerID"]. " " . $fields["FirstName"]. " ". $fields["LastName"]. " ". $fields["Notes"]. " ". $fields["Active"]. " <br />";
				}
				//print T_ADDRESS
				$sql5 = "select * from T_ADDRESS where CustomerID in (select CustomerID from T_PROJECT where ProjectID like '%".$key_word."%')";
				$result4 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
				print "T_ADDRESS :<br>";
				while($fields = mysqli_fetch_assoc($result4)){
					print $fields["CustomerID"]. " " . $fields["Street"]. " ". $fields["City"]. " ". $fields["State"]. " ". $fields["Zip"].  " <br />";
				}
				//print T_TASK
				$sql6 = "select * from T_TASK where ProjectID in (select ProjectID from T_PROJECT where ProjectID like '%".$key_word."%')";
				$result5 = mysqli_query($conn, $sql6) or die(mysqli_error($conn));
				print "T_TASK:<br>";
				while($fields = mysqli_fetch_assoc($result5)){
					print $fields["TaskID"]. " " . $fields["ProjectID"]. " ". $fields["TaskName"]. " ". $fields["Notes"]. " ". $fields["MantisID"]." ". $fields["Status"]." ". $fields["FlagReason"]." ". $fields["Active"]. " <br />";
				}
				
			}
			if (mysqli_num_rows($result) == 0) {
				echo "No matches found";
			}
		}
		if($tag1 == "Task"){
			$sql = "select * from T_TASK where TaskName like '%".$key_word."%'";
			$result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
			//$fields = mysqli_fetch_array($result);
			print "Result:<br>";
			while($fields = mysqli_fetch_assoc($result)){
				print 	$fields["TaskID"].  " " .$fields["TaskName"]. " " .$fields["ProjectID"]. " " .$fields["Notes"]." " .$fields["MantisID"]. " " .$fields["Status"]." " . $fields["FlagReason"]." ". $fields["Active"]." ";
				//print T_PROJECT
				$sql2 = "select * from T_PROJECT where ProjectID in (select ProjectID from T_TASK where ProjectID like '%".$key_word."%')";
				$result1 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
				print "T_PROJECT:<br>";
				while($fields = mysqli_fetch_assoc($result1)){
					print 	$fields["ProjectName"]. " " . $fields["ProjectID"]. " " .  $fields["RevisionLetter"]." " .$fields["MantisID"]." " . $fields["CustomerID"]." ".  $fields["ShortDescription"]." ".  $fields["LongDescription"]." ".  $fields["Active"]." ". $fields["Status"]." ".  $fields["DajacSalesAssoc"]." ". $fields["LocalProRate"]." ".  $fields["GlobalMaterialMarkup"]."<br />";
				}
				//print T_PROJECT_ASSIGNMENTS
				$sql3 = "select * from T_PROJECT_ASSIGNMENTS where ProjectID in (select ProjectID from T_TASK where ProjectID like '%".$key_word."%')";
				$result2 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
				print "T_PROJECT_ASSIGNMENTS :<br>";
				while($fields = mysqli_fetch_assoc($result2)){
					print $fields["UserName"]. " " . $fields["ProjectID"] . " <br />";
				}
				//print T_PROJECT_STATISTICS
				$sql4 = "select * from T_PROJECT_STATISTICS where ProjectID in (select ProjectID from T_TASK where ProjectID like '%".$key_word."%')";
				$result3 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
				print "T_PROJECT_STATISTICS:<br>";
				while($fields = mysqli_fetch_assoc($result3)){
					print $fields["ProjectID"]. " " . $fields["Raw_Profit"]. " ". $fields["Total_Labor_hour"]. " ". $fields["Total_Labor_cost"]. " ". $fields["Total_Labor_value_quote"]. " ". $fields["Total_material_cost"].  " ". $fields["Total_material_value_quote"].  " ". $fields["Hour_used_pertask"].  " ". $fields["Hour_remain_pertask"]. " ". $fields["Hour_used_for_entireproject"].  " ". $fields["Hour_remain_for_entireproject"].  " <br />";
				}
				
			}
			if (mysqli_num_rows($result) == 0) {
				echo "No matches found";
			}
		}
		if($tag1 == "Customer"){
			$sql = "select * from T_CUSTOMER where CustomerID like '%".$key_word."%'";
			$result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
			print "Result:<br>";
			while($fields = mysqli_fetch_assoc($result)){
				print $fields["CustomerID"]. " " . $fields["FirstName"]. " " . $fields["LastName"]." " . $fields["Notes"]." " . $fields["Active"]." ";
				//print T_ADDRESS
				$sql2 = "select * from T_ADDRESS where CustomerID in (select CustomerID from T_CUSTOMER where CustomerID like '%".$key_word."%')";
				$result1 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
				print "T_ADDRESS:<br>";
				while($fields = mysqli_fetch_assoc($result1)){
					print $fields["CustomerID"]. " " . $fields["Street"]. " ". $fields["City"]. " ". $fields["State"]. " ". $fields["Zip"].  " <br />";
				}
				//print T_PROJECT
				$sql3 = "select * from T_PROJECT where CustomerID in (select CustomerID from T_CUSTOMER where CustomerID like '%".$key_word."%')";
				$result2 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
				print "T_PROJECT :<br>";
				while($fields = mysqli_fetch_assoc($result2)){
					print 	$fields["ProjectName"]. " " . $fields["ProjectID"]. " " .  $fields["RevisionLetter"]." " .$fields["MantisID"]." " . $fields["CustomerID"]." ".  $fields["ShortDescription"]." ".  $fields["LongDescription"]." ".  $fields["Active"]." ". $fields["Status"]." ".  $fields["DajacSalesAssoc"]." ". $fields["LocalProRate"]." ".  $fields["GlobalMaterialMarkup"]."<br />";	
				}
				//print T_PROJECT_ASSIGNMENTS
				$sql4 = "select * from T_PROJECT_ASSIGNMENTS where ProjectID in (select ProjectID from T_PROJECT where CustomerID in (select CustomerID from T_CUSTOMER where CustomerID like '%".$key_word."%'))";
				$result3 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));
				print "T_PROJECT_ASSIGNMENTS:<br>";
				while($fields = mysqli_fetch_assoc($result3)){
					print $fields["UserName"]. " " . $fields["ProjectID"] . " <br />";
				}
				//print T_PROJECT_STATISTICS
				$sql5 = "select * from T_PROJECT_STATISTICS where ProjectID in (select ProjectID from T_PROJECT where CustomerID in (select CustomerID from T_CUSTOMER where CustomerID like '%".$key_word."%'))";
				$result4 = mysqli_query($conn, $sql5) or die(mysqli_error($conn));
				print "T_PROJECT_STATISTICS :<br>";
				while($fields = mysqli_fetch_assoc($result4)){
					print $fields["ProjectID"]. " " . $fields["Raw_Profit"]. " ". $fields["Total_Labor_hour"]. " ". $fields["Total_Labor_cost"]. " ". $fields["Total_Labor_value_quote"]. " ". $fields["Total_material_cost"].  " ". $fields["Total_material_value_quote"].  " ". $fields["Hour_used_pertask"].  " ". $fields["Hour_remain_pertask"]. " ". $fields["Hour_used_for_entireproject"].  " ". $fields["Hour_remain_for_entireproject"].  " <br />";
				}
			}
			if (mysqli_num_rows($result) == 0) {
				echo "No matches found";
			}
		}
	?>
					</div>
			</div>
		</div>
	</body>
</html>