<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Project</title>
  </head>
  <body>

    <?php include('nav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New Project</h1>

          <form role="form">
            <div class="form-group">
              <label for="ProjectName">Project Name</label>
              <input type="text" class="form-control" id="ProjectName" placeholder="Name the project">
            </div>
            <div class="form-group">
              <label for="RevisionLetter">Revision Letter</label>
              <input type="text" class="form-control" id="RevisionLetter" placeholder="A, B, C, etc.">
            </div>
            <div class="form-group">
              <label for="MantisID">MantisID</label>
              <input type="text" class="form-control" id="MantisID" placeholder="######">
            </div>
            <div class="form-group">
              <label for="Customer">Customer</label> <br />
              <select name="Customer" class="form-control">
              <option value="inactive" selected>Select A Customer</option>
              <option value="active">Don Johnson</option>
              <option value="inactive">Mikey Mike</option>
              </select>
            </div>
            <div class="form-group">
              <label for="ShortDescription">Short Description</label>
              <input type="text" class="form-control" id="ShortDescription" placeholder="Less than 128 characters">
            </div>
            <div class="form-group">
              <label for="LongDescription">Long Description</label>
              <textarea class="form-control" rows="3" id="LongDescription" placeholder="Describe the project in its entirety"></textarea>
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
              <option value="completed">Completed</option>
              <option value="onHold">On Hold</option>
              </select>
            </div>
            <div class="form-group">
            <label for="AssignedUsers">Assigned Users</label> <br />
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Mike Mikeson
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox"> John Smith
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Cassie Johnson
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="DajacSalesAssociate">Dajac Sales Associate</label> <br />
              <select name="DajacSalesAssociate" class="form-control">
              <option value="select" selected>Select An Employee</option>
              <option value="active">Bobby Minen</option>
              <option value="inactive">Chris Krew</option>
              </select>
            </div>


            <br />
            <h3 class="sub-header">Local Rate Overrides</h3>
            <div class="form-group">
              <label for="LocalRateOverride">Local Project Rate</label>
              <input type="text" class="form-control" id="LocalProjectRate" placeholder="Enter local rate in decimal format">
            </div>
            <div class="form-group">
              <label for="GlobalMaterialMarkup">Global Material Markup</label>
              <input type="text" class="form-control" id="GlobalMaterialMarkup" placeholder="Enter material markup in decimal format">
            </div>


            <button type="submit" class="btn btn-default">Add Project</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
