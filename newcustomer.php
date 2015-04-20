<?php
include('nav.php'); 
include "db_connect.php";

//initialization of variables 
$FirstName = "";
$LastName = "";
$Street = "";
$City = "";
$State = "";
$Zip = "";
$Notes = "";
$Active = "";

//error variables 
$FirstNameError = "";
$LastNameError = "";
$StreetError = "";
$CityError = "";
$StateError = "";
$ZipError = "";
$NotesError = "";

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
		$Edit =  trim($_POST['Edit']);
		$FirstName =  trim($_POST['FirstName']);
		$LastName =  trim($_POST['LastName']);
		$Notes =  trim($_POST['Notes']);
		$Street = trim($_POST['Street']);
		$City = trim($_POST['City']);
		$State = trim($_POST['State']);
		$Zip = trim($_POST['Zip']);
		$Notes = trim($_POST['Notes']);
		$Active = trim($_POST['Active']);
		
		//makes sure that user enters all required data 
		if($FirstName == "") {$FirstNameError = '<span style="color:red">*</span>';}
		if($LastName == "") {$LastNameError = '<span style="color:red">*</span>';}
		if($Street == ""){$notesError = '<span style="color:red">*</span>';}	
		if($City == ""){$notesError = '<span style="color:red">*</span>';}	
		if($State == ""){$notesError = '<span style="color:red">*</span>';}	
		if($Zip == ""){$notesError = '<span style="color:red">*</span>';}	
		if($Notes == ""){$notesError = '<span style="color:red">*</span>';}	
	
		if(($FirstNameError == "") && ($LastNameError == "") && ($StreetError == "") && ($CityError == "") && ($StateError == "") && ($ZipError == ""))
		{
			$FirstName = mysqli_real_escape_string($link, $FirstName);
			$LastName = mysqli_real_escape_string($link, $LastName);
			$Street = mysqli_real_escape_string($link, $Street);
			$City = mysqli_real_escape_string($link, $City);
			$State = mysqli_real_escape_string($link, $State);
			$Zip = mysqli_real_escape_string($link, $Zip);
			$Notes = mysqli_real_escape_string($link, $Notes);
			$Active = mysqli_real_escape_string($link, $Active);
			
			$sql = "select count(*) as c from T_CUSTOMER where FirstName = '" . $FirstName. "'"; // email would be a better field to use 
			$result = mysqli_query($link, $sql) or die("Error in the consult.." . mysqli_error($link)); //send the query to the database or quit if cannot connect
			
			$count = 0; 
			$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
			$count = $field->c;
			
			if ($count != 0 && !$Edit)
			{	Header ("Location: /dajacinc/dev/newcustomer.php") ;
					print "count is ".	$count;					
			}
			else{
			//$sql = "INSERT INTO T_CUSTOMER values(NULL , '".$CustomerName. "', '".$CustomerAddress . "', '" .$Notes."', '".$status."')";
			mysqli_autocommit($link, FALSE);
			$sql = "CALL SP_INSERT_CUSTOMER(NULL, '$FirstName', '$LastName', '$Notes', '$Active')";
			mysqli_query($link, $sql) or die(mysqli_error($link));

			// Grab the ID of the customer we just inserted
			if (!$Edit) {
				$getID = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(`CustomerID`) FROM `T_CUSTOMER`"));
				$CustomerID = $getID[0];
				if ($CustomerID == "") {
					die("CUSTOMER ID CANNOT BE EMPTY");
				}
			}
			// And use it to insert an address for the customer
			$sql = "CALL SP_INSERT_ADDRESS($CustomerID, '$Street', '$City', '$State', '$Zip')";
			mysqli_query($link, $sql) or die(mysqli_error($link));
			mysqli_commit($link);
			header('Location: /dajacinc/dev/managecustomers.php');			
			}
		}
	}
	elseif (isset($_GET['CustomerID'])) {
		$Edit = True;
		$CustomerID =  trim($_GET['CustomerID']);
		$FirstName =  trim($_GET['FirstName']);
		$LastName =  trim($_GET['LastName']);
		$Notes =  trim($_GET['Notes']);
		$Active =  trim($_GET['Active']);
		$Street =  trim($_GET['Street']);
		$City =  trim($_GET['City']);
		$State =  trim($_GET['State']);
		$Zip =  trim($_GET['Zip']);
	}
?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php if ($Edit) { echo 'Edit Customer'; } else {echo 'New Customer';} ?></h1>

          <form role="form" action="newcustomer.php" method="post">

            <div class="form-group <?php if($FirstNameError != ""){print "has-error";}?>">
              <label>First Name <?php print $FirstNameError; ?></label>
              <input type="text" class="form-control" name="FirstName" id="FirstName" placeholder="First Name"  value="<?php print $FirstName; ?>" maxlength="128">
            </div>
            <div class="form-group <?php if($LastNameError != ""){print "has-error";}?>">
              <label>Last Name <?php print $FirstNameError; ?></label>
              <input type="text" class="form-control" name="LastName" id="LastName" placeholder="Last Name"  value="<?php print $LastName; ?>" maxlength="128">
            </div>

            <h4>Address</h4>
            <div class="form-group <?php if($StreetError != ""){print "has-error";}?>">
              <label>Street <?php print $StreetError; ?></label>
              <input type="text" class="form-control" name="Street" id="Street" placeholder="Street Name"  value="<?php print $Street; ?>" maxlength="128">
            </div>
            <div class="form-group <?php if($CityError != ""){print "has-error";}?>">
              <label>City <?php print $CityError; ?></label>
              <input type="text" class="form-control" name="City" id="City" placeholder="City Name"  value="<?php print $City; ?>" maxlength="128">
            </div>
            <div class="form-group <?php if($StateError != ""){print "has-error";}?>">
              <label>State <?php print $StateError; ?></label>
              <input type="text" class="form-control" name="State" id="State" placeholder="State Name"  value="<?php print $State; ?>" maxlength="128">
            </div>
            <div class="form-group <?php if($ZipError != ""){print "has-error";}?>">
              <label>Zip <?php print $ZipError; ?></label>
              <input type="text" class="form-control" name="Zip" id="Zip" placeholder="Zipcode"  value="<?php print $Zip; ?>" maxlength="128">
            </div>

            <div class="form-group <?php if($NotesError != ""){print "has-error";}?>">
              <label>Notes <?php print $NotesError; ?></label>
              <input type="text" class="form-control" name="Notes" id="Notes" placeholder="Notes"  value="<?php print $Notes; ?>" maxlength="128">
            </div>
            <div class="form-group">
              <label>Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected>Inactive</option>
              </select>
            </div>
            <div class="form-group" style="visibility: hidden; height: 0px; margin: 0; padding: 0;">
              <input type="text" class="form-control" name="Edit"id="Edit" maxlength="10" value="<?php if ($Edit) {print 1; } else { print 0; }?>">
            </div>
            <div class="form-group" style="visibility: hidden; height: 0px; margin: 0; padding: 0;">
              <input type="text" class="form-control" name="CustomerID"id="CustomerID" maxlength="10" value="<?php if ($CustomerID) {print $CustomerID; } else { print ''; }?>">
            </div>

            <button name="enter" type="submit" class="btn btn-default"><?php if ($Edit) { echo 'Update Customer'; } else {echo 'Add Customer';} ?></button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
