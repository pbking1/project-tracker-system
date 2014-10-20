
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - Tasks</title>
  </head>

  <body>

  <?php include('nav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Widget X Development</h1>

          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-2"><button type="submit" class="btn btn-success">Clock-in</button></div>
                <div class="col-md-10 vcenter">Task #1 - A Task with no subtasks</div>
              </div>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">Task #2 - A task with subtasks</div>
            <div class="panel-body">
            
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-2"><button type="submit" class="btn btn-success">Clock-in</button></div>
                    <div class="col-md-10 vcenter">subtask #3</div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-2"><button type="submit" class="btn btn-danger">Clock-out</button></div>
                    <div class="col-md-10 vcenter">subtask #3</div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-2"><button type="submit" class="btn btn-success">Clock-in</button></div>
                    <div class="col-md-10 vcenter">subtask #3</div>
                  </div>
                </div>
              </div>
              <a href="newsubtask.php">
              <div class="panel panel-success">
                <div class="panel-heading">
                  Add new subtask...
                </div>
              </div>
              </a>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-2"><button type="submit" class="btn btn-success">Clock-in</button></div>
                <div class="col-md-10 vcenter">Task #3 - A Task with no subtasks</div>
              </div>
            </div>
          </div>

              <a href="newtask.php">
              <div class="panel panel-success">
                <div class="panel-heading">
                  Add new task...
                </div>
              </div>
              </a>


        </div>
      </div>
    </div>
  </body>
</html>
