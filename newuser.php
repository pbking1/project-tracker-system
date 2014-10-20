
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New User</title>
  </head>

  <body>

  <?php include('nav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New User</h1>

          <form role="form">
            <div class="form-group">
              <label for="FullName">Full Name</label>
              <input type="text" class="form-control" id="FullName" placeholder="i.e. John Smith">
            </div>
            <div class="form-group">
              <label for="UserName">Username</label>
              <input type="text" class="form-control" id="UserName" placeholder="i.e. johnsmith">
            </div>
            <div class="form-group">
              <label for="Password">Password</label>
              <input type="text" class="form-control" id="Password" placeholder="Enter a password for the user">
            </div>
            <div class="form-group">
              <label for="EmployeeID">Employee ID</label>
              <input type="text" class="form-control" id="EmployeeID" placeholder="The user's employee ID">
            </div>
            <div class="form-group">
              <label for="Class">Class</label> <br />
              <select name="Class" class="form-control">
              <option value="select" selected>Select a Class</option>
              <option value="engineer">Engineer</option>
              <option value="contractor">Contractor</option>
              </select>
            </div>
            <div class="form-group">
              <label for="Role">Role</label> <br />
              <select name="Role" class="form-control">
              <option value="select" selected>Select a Role</option>
              <option value="Admin">Admin</option>
              <option value="ProjectManager">Project Manager</option>
              <option value="User">User</option>
              </select>
            </div>
            <div class="form-group">
              <label for="Active">Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected>Inactive</option>
              </select>
            </div>

            <button type="submit" class="btn btn-default">Add User</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
