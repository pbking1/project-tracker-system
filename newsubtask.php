
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Subtask</title>
  </head>

  <body>

    <?php include('nav.php'); require_once("db_connect.php");?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Widget X Development - Task #2 - New Subtask</h1>

          <form role="form" action="newsubtask.php" method="post">
            <div class="form-group">
              <label for="ParentTask">Parent Task ID</label>
              <input name="id" type="text" class="form-control" id="ParentTask" placeholder="Task #2" disabled>
            </div>
            <div class="form-group">
              <label for="SubtaskName">Subtask Name</label>
              <input name="name" type="text" class="form-control" id="SubtaskName" placeholder="Enter subtask name">
            </div>
            <div class="form-group">
              <label for="Material_ID">Material_ID</label>
              <input name="mid" type="text" class="form-control" id="Material_ID" placeholder="######">
            </div>
            <div class="form-group">
              <label for="Active">Active/Inactive</label> <br />
              <select name="active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected>Inactive</option>
              </select>
            </div>
            <div class="form-group">
              <label for="TaskStatus">Task Status</label> <br />
              <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="complete">Complete</option>
              <option value="onHold">On Hold</option>
              </select>
            </div>
            <div class="form-group">
              <label for="ReasonForTask">Reason for Task</label>
              <input name="reason" class="form-control" rows="3" id="ReasonForTask" placeholder="Briefly describe why the addition of this task is necessary"></input>
            </div>

            <button type="submit" class="btn btn-default">Add Task</button>
          </form>
          <?php
              $sql = "INSERT INTO T_SUBTASK (`Subtask_ID`,`SubtaskName`,`Material_ID`, `Active`,`Status`,`reason`) VALUES ('$_POST[id]', '$_POST[name]', '$_POST[mid]', '$_POST[active]', '$_POST[status]', '$_POST[reason]')";
             
              mysql_query($sql, $conn);
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
