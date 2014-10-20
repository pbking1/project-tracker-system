
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Task</title>
  </head>

  <body>

    <?php include('nav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Widget X Development - New Task</h1>

          <form role="form">
            <div class="form-group">
              <label for="TaskName">Task Name</label>
              <input type="text" class="form-control" id="TaskName" placeholder="Enter a task name">
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
              <label for="ProjectStatus">Project Status</label> <br />
              <select name="ProjectStatus" class="form-control">
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
