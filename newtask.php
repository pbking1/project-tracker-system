
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Task</title>
  </head>

  <body>

    <?php include('nav.php'); require_once("db_connect.php");?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Widget X Development - New Task</h1>

          <form role="form" action="newtask.php" method="post">
            <div class="form-group">
              <label for="TaskName">Task Name</label>
              <input name="name" type="text" class="form-control" id="TaskName" placeholder="Enter a task name">
            </div>
            <div class="form-group">
              <label for="MantisID">MantisID</label>
              <input name="mid" type="text" class="form-control" id="MantisID" placeholder="######">
            </div>
            <div class="form-group">
              <label for="taskid">Task ID</label>
              <input name="id" type="text" class="form-control" id="TaskID" placeholder="######">
            </div>
            <div class="form-group">
              <label for="Active">Active/Inactive</label> <br />
              <select name="active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected>Inactive</option>
              </select>
            </div>
            <div class="form-group">
              <label for="ProjectStatus">Project Status</label> <br />
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
              $sql = "INSERT INTO T_TASK (`Mantis_ID`,`TaskName`, `Status`,`Subtask_ID`,`Flag_reason`,`Active`) VALUES ('$_POST[mid]', '$_POST[name]', '$_POST[status]', '$_POST[id]', '$_POST[reason]', '$_POST[active]')";
              //INSERT INTO `T_TASK` (`Mantis_ID`,`TaskName`, `Status`,`Subtask_ID`,`Flag_reason`,`Active`) VALUES (1, "asd","10", 10, "aaa", 0);
              mysql_query($sql, $conn);
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
