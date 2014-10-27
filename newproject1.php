<?php 
include('nav.php'); 
include "dbconnect.php";

//initialization of variables 
$ProjectName = "";
$RevisionLetter = "";
$MantisID = "";
$Customer = "";
$ShortDescription = "";
$LongDescription = "";
$ActivityStatus = "";
$ProjectStatus = "";
$SalesEmployee = "";
$LocalProjectRate = "";
$GlobalMaterialMarkup = "";
$AssignedUsers = "";
$CustomerID = "";


//Error variables initialization
$projNameError = "";
$revLetterError = "";
$ManIDError = "";
$shortDescriptionError = ""; 
$longDescriptionError = ""; 
$locProRateError = ""; 
$globMatRateError = ""; 
$mikesonChecked = "unchecked"; 
$smithChecked = "unchecked"; 
$JohnsonChecked = "unchecked"; 


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
		$ProjectName =  trim($_POST['ProjectName']);
		$RevisionLetter =  trim($_POST['RevisionLetter']);
		$MantisID =  trim($_POST['MantisID']);
		$GlobalMaterialMarkup =  trim($_POST['GlobalMaterialMarkup']);
		$LocalProjectRate =  trim($_POST['LocalProjectRate']);	
		$ShortDescription =  trim($_POST['ShortDescription']);
		$LongDescription =  trim($_POST['LongDescription']);
		
		$Customer =  trim($_POST['Customer']);
		$ActivityStatus =  trim($_POST['Active']);
		$ProjectStatus =  trim($_POST['ProjectStatus']);
		$SalesEmployee =  trim($_POST['DajacSalesAssociate']);
		
		//makes sure that user enters all required data 
		if($ProjectName == "")$projNameError = '<span style="color:red">*</span>';
		if($RevisionLetter == "")$revLetterError = '<span style="color:red">*</span>';
		if($MantisID == "")$ManIDError = '<span style="color:red">*</span>';
		if($ShortDescription == "")$shortDescriptionError = '<span style="color:red">*</span>';
		if($LongDescription == "")$longDescriptionError = '<span style="color:red">*</span>';
		if($GlobalMaterialMarkup == "")$globMatRateError = '<span style="color:red">*</span>';
		if($LocalProjectRate == "")$locProRateError = '<span style="color:red">*</span>';
		
		//makes sure that the check boxes are checked before obtaining the value
		//once the value is obtained, the values are sent to the AssignedUsers variable
		if (filter_has_var(INPUT_POST, "Mikeson")){
			$AssignedUsers .= filter_input(INPUT_POST, "Mikeson");
		}
		if (filter_has_var(INPUT_POST, "Smith")){
			$AssignedUsers .= filter_input(INPUT_POST, "Smith");

		}
		if (filter_has_var(INPUT_POST, "Johnson")){
			$AssignedUsers .= filter_input(INPUT_POST, "Johnson");
		}	
		
		if(($ProjectName != "") && ($RevisionLetter != "" )&& ($MantisID != "") && ($ShortDescription != "") && ($LongDescription != "") && ($GlobalMaterialMarkup != "" )&& ($LocalProjectRate != ""))
		{
			$ProjectName = mysqli_real_escape_string($con, $ProjectName);
			$RevisionLetter = mysqli_real_escape_string($con, $RevisionLetter);
			$MantisID = mysqli_real_escape_string($con, $MantisID);
			$ShortDescription = mysqli_real_escape_string($con, $ShortDescription);
			$LongDescription = mysqli_real_escape_string($con, $LongDescription);
			$GlobalMaterialMarkup = mysqli_real_escape_string($con, $GlobalMaterialMarkup);
			$Customer = mysqli_real_escape_string($con, $Customer);
			$ActivityStatus = mysqli_real_escape_string($con, $ActivityStatus);
			$LocalProjectRate = mysqli_real_escape_string($con, $LocalProjectRate);
			$SalesEmployee = mysqli_real_escape_string($con, $SalesEmployee);
			$ProjectStatus = mysqli_real_escape_string($con, $ProjectStatus);
			
			$sql = "select count(*) as c from T_PROJECT where ProjectName = '" . $ProjectName. "'"; // email would be a better field to use 
			$result = mysqli_query($con, $sql) or die("Error in the consult.." . mysqli_error($con)); //send the query to the database or quit if cannot connect
			
			$count = 0; 
			$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
			$count = $field->c;
			
			if ($count != 0)
			{	Header ("Location:newproject.php") ;
					print "count is ".	$count;					
			}
			else{
			$sql = "INSERT INTO T_PROJECT values('".$ProjectName."','".$ProjectName."','".$RevisionLetter."','".$MantisID."','".$CustomerID."','".$ShortDescription."','".$LongDescription."','".$ActivityStatus."','".$ProjectStatus."','".$SalesEmployee."', '".$LocalProjectRate. "', '".$GlobalMaterialMarkup . "')";
			$result= mysqli_query($con, $sql) or die(mysqli_error($con));
			header('Location: success.php');			
			}
		}
	}
		
?>		

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New Project</h1>

          <form role="form" method="post" action="newproject.php">
            <div class="form-group <?php if($projNameError != ""){print "has-error";}?>">
              <label for="ProjectName">Project Name<?php print $projNameError; ?> </label>
              <input type="text" class="form-control" name="ProjectName" id="ProjectName" value="<?php print $ProjectName; ?>" placeholder="Name the project" maxlength="20">
            </div>
            <div class="form-group <?php if($revLetterError != ""){print "has-error";}?>">
              <label for="RevisionLetter">Revision Letter<?php print $revLetterError; ?> </label>
              <input type="text" class="form-control" name="RevisionLetter"id="RevisionLetter" value="<?php print $RevisionLetter; ?>" placeholder="A, B, C, etc." maxlength="10">
            </div>
            <div class="form-group <?php if($ManIDError != ""){print "has-error";}?>">
              <label for="MantisID">MantisID<?php print $ManIDError; ?> </label>
              <input type="text" name="MantisID"class="form-control" id="MantisID" value="<?php print $MantisID; ?>" placeholder="######" maxlength="10">
            </div>
            <div class="form-group ">
              <label for="Customer">Customer</label> <br />
              <select name="Customer" class="form-control">
				<?php 
				$list = "";
				$sql = "SELECT CustomerName from T_CUSTOMER";
				$result = mysqli_query($con, $sql) or die(mysqli_error($con));
				print $sql;
			   
				while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
				{	
				$list = $list .'<option value ="'.$row["CustomerName"].'">'.$row["CustomerName"].'</option>' ;
				}

				print $list;
				?>	
              </select>
            </div>
            <div class="form-group <?php if($shortDescriptionError != ""){print "has-error";}?>">
              <label for="ShortDescription">Short Description<?php print $shortDescriptionError; ?> </label>
              <input type="text" class="form-control" name="ShortDescription" id="ShortDescription" value="<?php print $ShortDescription; ?>" placeholder="Less than 128 characters" maxlength="20">
            </div>
            <div class="form-group <?php if($longDescriptionError != ""){print "has-error";}?>">
              <label for="LongDescription">Long Description<?php print $longDescriptionError; ?> </label>
              <textarea class="form-control" rows="3" name="LongDescription" id="LongDescription" placeholder="Describe the project in its entirety" maxlength="40"><?php print $LongDescription; ?></textarea>
            </div>
            <div class="form-group">
              <label for="Active">Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected>Inactive</option>
              </select>
            </div>
            <div class="form-group ">
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
                  <input <?php print $mikesonChecked; ?> value="Mikeson" name="Mikeson"type="checkbox"> Mike Mikeson
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input <?php print $smithChecked; ?> value="Smith" name="Smith"type="checkbox"> John Smith
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input <?php print $JohnsonChecked; ?> value="Johnson" name="Johnson" type="checkbox"> Cassie Johnson
                </label>
              </div>
            </div>
            <div class="form-group ">
              <label for="DajacSalesAssociate">Dajac Sales Associate</label> <br />
              <select name="DajacSalesAssociate" class="form-control">
              <option value="Minen">Bobby Minen</option>
              <option value="Krew">Chris Krew</option>
              </select>
            </div>
				

            <br />
            <h3 class="sub-header">Local Rate Overrides</h3>
            <div class="form-group <?php if($locProRateError != ""){print "has-error";}?>">
              <label for="LocalRateOverride">Local Project Rate <?php print $locProRateError; ?> </label>
              <input type="text" class="form-control" name="LocalProjectRate" id="LocalProjectRate" value="<?php print $LocalProjectRate; ?>" placeholder="Enter local rate in decimal format" maxlength="10">
            </div>
            <div class="form-group <?php if($globMatRateError != ""){print "has-error";}?>">
              <label for="GlobalMaterialMarkup">Global Material Markup<?php print $globMatRateError; ?> </label>
              <input type="text" class="form-control" name="GlobalMaterialMarkup"id="GlobalMaterialMarkup" value="<?php print $GlobalMaterialMarkup; ?>" placeholder="Enter material markup in decimal format" maxlength="10">
            </div>


            <button name="enter" type="submit" class="btn btn-default">Add Project</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>


