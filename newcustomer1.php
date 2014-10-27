<?php session_start();
include('nav.php'); 
include "dbconnect.php";

//initialization of variables 
$CustomerName = "";
$CustomerAddress = "";
$Notes = "";
$status = "";

//error variables 
$nameError = "";
$addressError = "";
$notesError = "";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New Customer</title>
  </head>
  <body>

<?php if (isset($_POST['enter']))
	{
		//take the information submitted and verify inputs
		$CustomerName =  trim($_POST['CustomerName']);
		$CustomerAddress =  trim($_POST['CustomerAddress']);
		$Notes =  trim($_POST['Notes']);
		$status = trim($_POST['Active']);
		
		//makes sure that user enters all required data 
		if($CustomerName == "") {$nameError = '<span style="color:red">*</span>';}
		if($CustomerAddress == "") {$addressError = '<span style="color:red">*</span>';}
		if($Notes == ""){$notesError = '<span style="color:red">*</span>';}		
	
		if(($CustomerName != "") && ($CustomerAddress != "" )&& ($Notes != "") )
		{
			$CustomerName = mysqli_real_escape_string($con, $CustomerName);
			$CustomerAddress = mysqli_real_escape_string($con, $CustomerAddress);
			$Notes = mysqli_real_escape_string($con, $Notes);
			$status = mysqli_real_escape_string($con, $status);
			
			$sql = "select count(*) as c from T_CUSTOMER where CustomerName = '" . $CustomerName. "'"; // email would be a better field to use 
			$result = mysqli_query($con, $sql) or die("Error in the consult.." . mysqli_error($con)); //send the query to the database or quit if cannot connect
			
			$count = 0; 
			$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
			$count = $field->c;
			
			if ($count != 0)
			{	Header ("Location:newcustomer.php") ;
					print "count is ".	$count;					
			}
			else{
			$sql = "INSERT INTO T_CUSTOMER values(NULL , '".$CustomerName. "', '".$CustomerAddress . "', '" .$Notes."', '".$status."')";
			$result= mysqli_query($con, $sql) or die(mysqli_error($con));
			header('Location: success.php');			
			}
		}
	}
?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New Customer</h1>

          <form role="form" action="newcustomer.php" method="post">
		  
            <div class="form-group <?php if($nameError != ""){print "has-error";}?>">
              <label for="exampleInputEmail1">Customer Name <?php print $nameError; ?></label>
              <input type="text" class="form-control" name="CustomerName" id="CustomerName" placeholder="Enter customer name"  value="<?php print $CustomerName; ?>" maxlength="10">
            </div>
            <div class="form-group <?php if($addressError != ""){print "has-error";}?>">
              <label for="exampleInputPassword1">Customer Address <?php print $addressError; ?></label>
              <textarea class="form-control" rows="3" name="CustomerAddress" id="CustomerAddress" placeholder="Enter the customer's address" maxlength="10" ><?php print $CustomerAddress; ?></textarea>
            </div>
            <div class="form-group <?php if($notesError != ""){print "has-error";}?>">
              <label for="exampleInputPassword1">Notes <?php print $notesError; ?></label>
              <textarea class="form-control"  name="Notes" rows="5" placeholder="Enter notes here" maxlength="30"><?php print $Notes; ?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected>Inactive</option>
              </select>
            </div>

            <button name="enter" type="submit" class="btn btn-default">Add Customer</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
