<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Dajac Inc. - New Class</title>

  </head>
  <body>

<?php include('nav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New Class</h1>

          <form role="form">
            <div class="form-group">
              <label for="exampleInputEmail1">Class Name</label>
              <input type="text" class="form-control" id="ClassName" placeholder="i.e. Engineer">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea class="form-control" id="Description" rows="3" placeholder="Briefly describe the class"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Hourly Cost</label>
              <input type="text" class="form-control" id="HourlyCost" placeholder="Enter hourly cost in decimal format">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Charge Through Rate</label>
              <input type="text" class="form-control" id="ChargeThroughRate" placeholder="Enter charge through in decimal format">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Active/Inactive</label> <br />
              <select name="active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected>Inactive</option>
              </select>
            </div>

            <button type="submit" class="btn btn-default">Add Class</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
