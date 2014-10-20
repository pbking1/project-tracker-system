
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Subtask</title>
  </head>

  <body>

    <?php include('nav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Widget X Development - Task #2 - New Subtask</h1>

          <form role="form">
            <div class="form-group">
              <label for="ParentTask">Parent Task</label>
              <input type="text" class="form-control" id="ParentTask" placeholder="Task #2" disabled>
            </div>
            <div class="form-group">
              <label for="SubtaskName">Subtask Name</label>
              <input type="text" class="form-control" id="SubtaskName" placeholder="Enter subtask name">
            </div>
            <div class="form-group">
              <label for="MantisID">MantisID</label>
              <input type="text" class="form-control" id="MantisID" placeholder="######">
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
            <div class="form-group">
              <label for="ReasonForTask">Reason for Task</label>
              <textarea class="form-control" rows="3" id="ReasonForTask" placeholder="Briefly describe why the addition of this task is necessary"></textarea>
            </div>

            <button type="submit" class="btn btn-default">Add Task</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
