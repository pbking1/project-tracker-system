<?php 
include('nav.php'); 
include "dbconnect.php";

//initialization of variables 
$TaskName = "";
$MantisID = "";
$ReasonForTask = "";
$ActivityStatus = "";
$ProjectStatus = "";

//Initialization of error variables 
$TaskNameError = "";
$MantisIDError = "";
$ReasonForTaskError = ""; 
$SubtaskID = 021;


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Customer</title>
  </head>
  <body>

<?php if (isset($_POST['enter']))
	{
		//take the information submitted and verify inputs
		$TaskName =  trim($_POST['TaskName']);
		$MantisID =  trim($_POST['MantisID']);
		$ReasonForTask =  trim($_POST['ReasonForTask']);
		
		if($TaskName == "")$TaskNameError = '<span style="color:red">*</span>';
		if($MantisID == "")$MantisIDError = '<span style="color:red">*</span>';
		if($ReasonForTask == "")$ReasonForTaskError = '<span style="color:red">*</span>';

		if(($TaskName != "") && ($MantisID != "" )&& ($ReasonForTask != "")){
			
			$TaskName = mysqli_real_escape_string($con, $TaskName);
			$MantisID = mysqli_real_escape_string($con, $MantisID);
			$ReasonForTask = mysqli_real_escape_string($con, $ReasonForTask);
			$ActivityStatus = mysqli_real_escape_string($con, $ActivityStatus);
			$ProjectStatus = mysqli_real_escape_string($con, $ProjectStatus);
			
			$sql = "select count(*) as c from T_TASK where TaskName = '" . $TaskName. "'"; // 
			$result = mysqli_query($con, $sql) or die("Error in the consult.." . mysqli_error($con)); //send the query to the database or quit if cannot connect
		}
		
			$count = 0; 
			$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
			$count = $field->c;
			
			if ($count != 0)
			{	//Header ("Location:index.php?l=r") ;
					print "count is ".	$count;					
			}
			else{
			$sql = "INSERT INTO T_TASK values('".$MantisID."', '".$TaskName. "', '".$ProjectStatus . "', '" .$SubtaskID."', '".$ReasonForTask."','".$ActivityStatus."')";
			$result= mysqli_query($con, $sql) or die(mysqli_error($con));
			header('Location: success.php');			
			}
	}
?>	

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Widget X Development - New Task</h1>

          <form role="form" action="newtask.php" method="post">
            <div class="form-group <?php if($TaskNameError != ""){print "has-error";}?>">
              <label for="TaskName">Task Name<?php print $TaskNameError; ?> </label>
              <input type="text" class="form-control" name="TaskName"id="TaskName" maxlength="10" value="<?php print $TaskName; ?>" placeholder="Enter a task name">
            </div>
            
			<div class="form-group">
				<label for="MantisID">MantisID</label><br />
				<select name="MantisID" class="form-control">
			<?php 
				$list = "";
				$sql = "SELECT Mantis_ID from T_PROJECT";
				$result = mysqli_query($con, $sql) or die(mysqli_error($con));
				print $sql;
					   
				while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
				{	
					$list = $list .'<option value ="'.$row["Mantis_ID"].'">'.$row["Mantis_ID"].'</option>' ;
				}

				print $list;
			?>	
				</select>
            </div>
            <div class="form-group">
              <label for="Active">Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected>Inactive</option>
              </select>
            </div>
            <div class="form-group">
              <label for="ProjectStatus">Project Status</label> <br />
              <select name="ProjectStatus" class="form-control">
              <option value="active">Active</option>
              <option value="complete">Complete</option>
              <option value="onHold">On Hold</option>
              </select>
            </div>
            <div class="form-group <?php if($ReasonForTaskError != ""){print "has-error";}?>">
              <label for="ReasonForTask">Reason for Task<?php print $ReasonForTaskError; ?> </label>
              <textarea class="form-control" rows="3" name="ReasonForTask" id="ReasonForTask" placeholder="Briefly describe why the addition of this task is necessary" maxlength="30" ><?php print $ReasonForTask; ?></textarea>
            </div>

            <button name="enter" type="submit" class="btn btn-default">Add Task</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
