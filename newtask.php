<?php 
include('nav.php'); 
include "db_connect.php";

//initialization of variables 
$ProjectID = "";
$ProjectName = "";
$ParentTaskID = "";
$TaskName = "";
$Notes = "";
$MantisID = "";
$Status = "";
$FlagReason = "";
$Active = "";
$PercentComplete = 0;

//Initialization of error variables 
$TaskNameError = "";
$MantisIDError = "";
$FlagReasonError = "";
$PercentCompleteError = ""; 


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Task</title>
  </head>
  <body>

<?php 
  if (isset($_GET['ProjectID'])) {
    $ProjectID = $_GET['ProjectID'];
    $sql = "SELECT *
        FROM T_PROJECT
        WHERE ProjectID = $ProjectID;";
    $Projects = mysqli_query($link, $sql) or die(mysqli_error($link));
    while ($row = mysqli_fetch_array($Projects, MYSQLI_ASSOC)) {
       $ProjectName = $row['ProjectName'];
    }
  }
  if (isset($_GET['ParentTaskID'])) {
    $ParentTaskID = $_GET['ParentTaskID'];
    $sql = "SELECT *
        FROM T_TASK
        WHERE TaskID = $ParentTaskID;";
    $Tasks = mysqli_query($link, $sql) or die(mysqli_error($link));
    while ($row = mysqli_fetch_array($Tasks, MYSQLI_ASSOC)) {
       $ParentTaskName = $row['TaskName'];
    }
  }
  else {
    $ParentTaskID = NULL;
  }

  if (isset($_POST['enter']))
  {
    //take the information submitted and verify inputs

    $TaskName =  trim($_POST['TaskName']);
    $ParentTaskID =  trim($_POST['ParentTaskID']);
    $ProjectID =  trim($_POST['ProjectID']);
    $Notes =  trim($_POST['Notes']);
    $MantisID =  trim($_POST['MantisID']);
    $Status =  trim($_POST['Status']);
    $FlagReason =  trim($_POST['FlagReason']);
    $Active =  trim($_POST['Active']);
    $PercentComplete =  trim($_POST['PercentComplete']);
    
    if($TaskName == "")$TaskNameError = '<span style="color:red">*</span>';
    if($MantisID == "")$MantisIDError = '<span style="color:red">*</span>';
    if($FlagReason == "")$FlagReasonError = '<span style="color:red">*</span>';

    if(($TaskName != "") && ($MantisID != "" )&& ($FlagReason != "")){
      
      $TaskName = mysqli_real_escape_string($link, $TaskName);
      $Notes = mysqli_real_escape_string($link, $Notes);
      $MantisID = mysqli_real_escape_string($link, $MantisID);
      $Status = mysqli_real_escape_string($link, $Status);
      $FlagReason = mysqli_real_escape_string($link, $FlagReason);
      
      $sql = "select count(*) as c from T_TASK where TaskName = '" . $TaskName. "'"; // 
      $result = mysqli_query($link, $sql) or die("Error in the consult.." . mysqli_error($link)); //send the query to the database or quit if cannot connect
    }
    
      $count = 0; 
      $field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
      $count = $field->c;
      
      if ($count != 0)
      { //Header ("Location:index.php?l=r") ;
          print "count is ".  $count;         
      }
      else{
        if ($ParentTaskID == "") {
          $ParentTaskID = "NULL";
        }
        $sql = "CALL SP_INSERT_TASK(NULL,$ParentTaskID,$ProjectID,'$TaskName','$Notes','$MantisID','$Status','$FlagReason',$Active,$PercentComplete)";
        $result= mysqli_query($link, $sql) or die(mysqli_error($link));
        // get ID of the task we just created
        $getID = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(`TaskID`) FROM `T_TASK`"));
        $NewTaskID = $getID[0];
        if ($NewTaskID == "") {
          die("CUSTOMER ID CANNOT BE EMPTY");
        }
        // and punch a new card for the current user since they created it
        header('Location: punch.php?TaskID='.$NewTaskID.'&CallbackURL=projectdetails.php?ProjectID='.$ProjectID.'');
      }
  }
?>  

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php echo $ProjectName; ?> - New Task</h1>

          <form role="form" action="newtask.php" method="post">
            <div class="form-group">
              <label for="ProjectName">Project</label>
              <input type="text" class="form-control" name="ProjectName"id="ProjectName" maxlength="10" value="<?php print $ProjectName; ?>" disabled>
            </div>
            <div class="form-group" style="visibility: hidden; height: 0px; margin: 0; padding: 0;">
              <input type="text" class="form-control" name="ProjectID"id="ProjectID" maxlength="10" value="<?php print $ProjectID; ?>">
            </div>
            <div class="form-group" style="visibility: hidden; height: 0px; margin: 0; padding: 0;">
              <input type="text" class="form-control" name="ParentTaskID"id="ParentTaskID" maxlength="10" value="<?php print $ParentTaskID; ?>">
            </div>
            <?php
            if (isset($_GET['ParentTaskID'])) {
                $html = 
                '
                <div class="form-group">
                  <label for="ParentTaskID">Parent Task</label>
                  <input type="text" class="form-control" name="ParentTaskName"id="ParentTaskName" value="'.$ParentTaskName.'"" disabled>
                </div>
                ';
                echo $html;
            }
            ?>
            <div class="form-group <?php if($TaskNameError != ""){print "has-error";}?>">
              <label for="TaskName">Task Name<?php print $TaskNameError; ?> </label>
              <input type="text" class="form-control" name="TaskName"id="TaskName" maxlength="10" value="<?php print $TaskName; ?>" placeholder="Enter a task name">
            </div>
            <div class="form-group">
              <label for="Notes">Notes</label>
              <textarea class="form-control" rows="3" name="Notes" id="Notes" placeholder="Any notes you wish to associate with this task" maxlength="40"><?php print $Notes; ?></textarea>
            </div>
            <div class="form-group <?php if($MantisIDError != ""){print "has-error";}?>">
              <label for="MantisID">Mantis ID<?php print $MantisIDError; ?> </label>
              <input type="text" class="form-control" name="MantisID"id="MantisID" maxlength="10" value="<?php print $MantisID; ?>" placeholder="Enter the task's MantisID">
            </div>
            <div class="form-group">
              <label for="Status">Task Status</label> <br />
              <select name="Status" class="form-control">
              <option value="Active">Active</option>
              <option value="Complete">Complete</option>
              <option value="OnHold">On Hold</option>
              </select>
            </div>
            <div class="form-group <?php if($PercentCompleteError != ""){print "has-error";}?>">
              <label for="PercentComplete">Percent Complete<?php print $PercentCompleteError; ?> </label>
              <input type="text" class="form-control" name="PercentComplete"id="PercentComplete" maxlength="10" value="<?php print $PercentComplete; ?>" placeholder="What percentage of this task is complete?">
            </div>
            <div class="form-group">
              <label for="Active">Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="1">Active</option>
              <option value="0" selected>Inactive</option>
              </select>
            </div>
            <div class="form-group <?php if($FlagReasonError != ""){print "has-error";}?>">
              <label for="FlagReason">Reason for Task<?php print $FlagReasonError; ?> </label>
              <textarea class="form-control" rows="3" name="FlagReason" id="FlagReason" placeholder="Briefly describe why the addition of this task is necessary" maxlength="30" ><?php print $FlagReason; ?></textarea>
            </div>

            <button name="enter" type="submit" class="btn btn-default">Add Task</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
