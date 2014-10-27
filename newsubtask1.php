<?php 
include('nav.php'); 
include "dbconnect.php";

//initialization of variables 
$ParentTask = "";
$SubtaskName = "";
$MantisID = "";
$ReasonForTask = "";
$ActivityStatus = "";
$TaskStatus = "";
$SubTaskID = 10;

//Error variable initialization
$SubTaskNameError = "";
$MantisIDError = "";
$ReasonForTaskError = ""; 


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
		$ParentTask =  trim($_POST['ParentTask']);
		$SubtaskName =  trim($_POST['SubtaskName']);
		$MantisID =  trim($_POST['MantisID']);
		$ReasonForTask =  trim($_POST['ReasonForTask']);
		$ActivityStatus =  trim($_POST['Active']);
		$TaskStatus =  trim($_POST['TaskStatus']);
		
		if($SubtaskName == "")$SubTaskNameError = '<span style="color:red">*</span>';
		if($MantisID == "")$MantisIDError = '<span style="color:red">*</span>';
		if($ReasonForTask == "")$ReasonForTaskError = '<span style="color:red">*</span>';

		if(($SubtaskName != "") && ($MantisID != "" )&& ($ReasonForTask != "")){
			
			$ParentTask = mysqli_real_escape_string($con, $ParentTask);
			$SubtaskName = mysqli_real_escape_string($con, $SubtaskName);
			$MantisID = mysqli_real_escape_string($con, $MantisID);
			$ReasonForTask = mysqli_real_escape_string($con, $ReasonForTask);
			$TaskStatus = mysqli_real_escape_string($con, $TaskStatus);
			$ActivityStatus = mysqli_real_escape_string($con, $ActivityStatus);
			
			$sql = "select count(*) as c from T_SUBTASK where SubtaskName = '" . $SubtaskName. "'"; // 
			$result = mysqli_query($con, $sql) or die("Error in the consult.." . mysqli_error($con)); //send the query to the database or quit if cannot connect
		
		
			$count = 0; 
			$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
			$count = $field->c;
			
			if ($count != 0)
			{	//Header ("Location:index.php?l=r") ;
					print "count is ".	$count;					
			}
			else{
			$sql = "INSERT INTO T_SUBTASK values('".$SubTaskID."', '".$SubtaskName. "', '".$MantisID . "', '" .$ActivityStatus."', '".$TaskStatus."','".$ReasonForTaskError."')";
			$result= mysqli_query($con, $sql) or die(mysqli_error($con));
			header('Location: success.php');			
			}
		}
		
		
		
	}
?>		

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Widget X Development - Task #2 - New Subtask</h1>

          <form role="form" method="post" action="newsubtask.php">
            <div class="form-group">
              <label for="ParentTask">Parent Task</label>
              <input name="ParentTask" type="text" class="form-control" id="ParentTask" placeholder="Task #2" disabled>
            </div>
            <div class="form-group <?php if($SubTaskNameError != ""){print "has-error";}?>"">
              <label for="SubtaskName">Subtask Name<?php print $SubTaskNameError; ?> </label>
              <input name="SubtaskName"type="text" class="form-control" id="SubtaskName" value="<?php print $SubtaskName; ?>" placeholder="Enter subtask name" maxlength="10">
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
              <label for="TaskStatus">Task Status</label> <br />
              <select name="TaskStatus" class="form-control">
              <option value="active">Active</option>
              <option value="complete">Complete</option>
              <option value="onHold">On Hold</option>
              </select>
            </div>
            <div class="form-group <?php if($ReasonForTaskError != ""){print "has-error";}?>"">
              <label for="ReasonForTask">Reason for Task<?php print $ReasonForTaskError; ?> </label>
              <textarea name="ReasonForTask" class="form-control" rows="3" id="ReasonForTask" placeholder="Briefly describe why the addition of this task is necessary" maxlength="10"><?php print $ReasonForTask; ?></textarea>
            </div>

            <button name="enter" type="submit" class="btn btn-default">Add Task</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>

