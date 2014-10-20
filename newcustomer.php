<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Customer</title>
  </head>
  <body>

    <?php include('nav.php'); ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New Customer</h1>

          <form role="form">
            <div class="form-group">
              <label for="exampleInputEmail1">Customer Name</label>
              <input type="text" class="form-control" id="CustomerName" placeholder="Enter customer name">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Customer Address</label>
              <textarea class="form-control" rows="3" id="CustomerAddress" placeholder="Enter the customer's address"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Notes</label>
              <textarea class="form-control" id="Notes" rows="5" placeholder=""></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected>Inactive</option>
              </select>
            </div>

            <button type="submit" class="btn btn-default">Add Customer</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
