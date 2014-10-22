<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Project</title>
  </head>
  <body>

    <?php include('nav.php'); require_once("db_connect.php");?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New Project</h1>

          <form role="form" action="newproject.php" method="post">
            <div class="form-group">
              <label for="ProjectName">Project Name</label>
              <input name="name" type="text" class="form-control" id="ProjectName" placeholder="Name the project">
            </div>
            <div class="form-group">
              <label for="ProjectID">Project ID</label>
              <input name="id" type="text" class="form-control" id="ProjectID" placeholder="ID the project">
            </div>
            <div class="form-group">
              <label for="RevisionLetter">Revision Letter</label>
              <input name="rl" type="text" class="form-control" id="RevisionLetter" placeholder="A, B, C, etc.">
            </div>
            <div class="form-group">
              <label for="MantisID">MantisID</label>
              <input name="md" type="text" class="form-control" id="MantisID" placeholder="######">
            </div>
            <div class="form-group">
              <label for="Customer">Customer</label> <br />
              <select name="customer" class="form-control">
              <option value="inactive" selected>Select A Customer</option>
              <option value="active">Don Johnson</option>
              <option value="inactive">Mikey Mike</option>
              </select>
            </div>
            <div class="form-group">
              <label for="ShortDescription">Short Description</label>
              <input name="sd" type="text" class="form-control" id="ShortDescription" placeholder="Less than 128 characters">
            </div>
            <div class="form-group">
              <label for="LongDescription">Long Description</label>
              <textarea name="ld" class="form-control" rows="3" id="LongDescription" placeholder="Describe the project in its entirety"></textarea>
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
              <option value="completed">Completed</option>
              <option value="onHold">On Hold</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="DajacSalesAssociate">Dajac Sales Associate</label> <br />
              <select name="ds" class="form-control">
              <option value="select" selected>Select An Employee</option>
              <option value="active">Bobby Minen</option>
              <option value="inactive">Chris Krew</option>
              </select>
            </div>


            <br />
            <h3 class="sub-header">Local Rate Overrides</h3>
            <div class="form-group">
              <label for="LocalRateOverride">Local Project Rate</label>
              <input name="lr" type="text" class="form-control" id="LocalProjectRate" placeholder="Enter local rate in decimal format">
            </div>
            <div class="form-group">
              <label for="GlobalMaterialMarkup">Global Material Markup</label>
              <input name="gm" type="text" class="form-control" id="GlobalMaterialMarkup" placeholder="Enter material markup in decimal format">
            </div>


            <button type="submit" class="btn btn-default">Add Project</button>
          </form>
          <?php
                $sql = "INSERT INTO T_PROJECT (`ProjectName`,`ProjectID`,`Mantis_ID`,`CustomerName`,`ShortDiscription`,`LongDiscription`,`LocalProRate`,`GlobalMaterialMarkup`,`Active`,`Status`,`Revision_letter`,`Dajac_sales_acc_name`) VALUES (`$_POST[name]`, `$_POST[id]`, `$_POST[md]`, `$_POST[customer]`, `$_POST[sd]`, `$_POST[ld]`, `$_POST[lr]`, `$_POST[gm]`, `$_POST[active]`, `$_POST[status]`, `$_POST[rl]`, `$_POST[ds]`);";
                //$s = "INSERT INTO `T_PROJECT` (`ProjectName`,`ProjectID`,`Mantis_ID`,`CustomerName`,`ShortDiscription`,`LongDiscription`,`LocalProRate`,`GlobalMaterialMarkup`,`Active`,`Status`,`Revision_letter`,`Dajac_sales_acc_name`) VALUES ("aaaa", 111, 1, "vv", "hello a", "ddddddd", "10", "dd", "yes", "ok", "asdasdsad", "pb");";
                mysql_query($sql, $conn);
          ?> 
        </div>
      </div>
    </div>
  </body>
</html>
