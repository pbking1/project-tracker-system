<?php
include('nav.php'); 
include "db_connect.php";

//initialization of variables 
$ClassName = "";
$Description = "";
$HourlyCost = "";
$ChargeThroughRate = "";
$Status = ""; 

//error variables 
$cnError = "";
$dError = "";
$hcError = "";
$ctrError = "";


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Dajac Inc. - New Class</title>

  </head>
  <body>

<?php 
	
	if (isset($_POST['enter']))
	{
		//take the information submitted by user
		$Edit =  trim($_POST['Edit']);
		$ClassID =  trim($_POST['ClassID']);
		$ClassName =  trim($_POST['ClassName']);
		$Description =  trim($_POST['Description']);
		$HourlyCost =  trim($_POST['HourlyCost']);
		$ChargeThroughRate =  trim($_POST['ChargeThroughRate']);
		$status = trim($_POST['active']);
	
		//makes sure that user enters all required data 
		if($ClassName == "")$ClassNameError = '<span style="color:red">*</span>';
		if($Description == "")$descriptionError = '<span style="color:red">*</span>';
		if($HourlyCost == "")$HourlyCostError = '<span style="color:red">*</span>';
		if($ChargeThroughRate == "")$ChargeThroughRateError = '<span style="color:red">*</span>';	
			
		
		if(($ClassNameError == "") && ($DescriptionError == "" )&& ($HourlyCostError == "") && ($ChargeThroughRateError == ""))
		{
	
			$ClassName = mysqli_real_escape_string($link, $ClassName);
			$Description = mysqli_real_escape_string($link, $Description);
			$HourlyCost = mysqli_real_escape_string($link, $HourlyCost);
			$ChargeThroughRate = mysqli_real_escape_string($link, $ChargeThroughRate);	
			$Status = mysqli_real_escape_string($link, $Status);
			
			$sql = "select count(*) as c from T_USER_CLASS where ClassName = '" . $ClassName. "'"; // email would be a better field to use 
			$result = mysqli_query($link, $sql) or die("Error in the consult.." . mysqli_error($link)); //send the query to the database or quit if cannot connect
			
			$count = 0; 
			$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
			$count = $field->c;
			
			if ($count != 0 && !$Edit)
			{	//Header ("Location:index.php?l=r") ;
					print "count is ".	$count;					
			}
			else{
				if ($Edit) {
					$sql = "CALL SP_INSERT_CLASS('$ClassID', '$ClassName', '$Description', $HourlyCost, $ChargeThroughRate, '$status')";
				}
				else {
					$sql = "CALL SP_INSERT_CLASS(NULL, '$ClassName', '$Description', $HourlyCost, $ChargeThroughRate, '$status')";
				}
			$result= mysqli_query($link, $sql) or die(mysqli_error($link));
			header('Location: /dajacinc/dev/manageusers.php');			
			}
			
			
		}
	}// end if 
	elseif (isset($_GET['ClassName'])) {
		$Edit = True;
		$ClassID =  trim($_GET['ClassID']);
		$ClassName =  trim($_GET['ClassName']);
		$Description =  trim($_GET['Description']);
		$HourlyCost =  trim($_GET['HourlyCost']);
		$ChargeThroughRate =  trim($_GET['ChargeThroughRate']);
		$Status =  trim($_GET['Status']);
	}
	

	
	
?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php if ($Edit) { echo 'Edit Class'; } else {echo 'New Class';} ?></h1>

          <form role="form" method="post" action="newclass.php">
            <div class="form-group <?php if($cnError != ""){print "has-error";}?>">
              <label for="exampleInputEmail1">Class Name <?php print $cnError; ?></label>
              <input type="text" name="ClassName" class="form-control" id="ClassName" placeholder="i.e. Engineer" value="<?php print $ClassName; ?>" maxlength="128">
            </div>
            <div class="form-group <?php if($dError != ""){print "has-error";}?>">
              <label for="exampleInputPassword1">Description <?php print $dError; ?></label>
              <textarea class="form-control" name="Description" id="Description" rows="3" placeholder="Briefly describe the class" maxlength="512" ><?php print $Description ; ?></textarea>
            </div>
            <div class="form-group <?php if($hcError != ""){print "has-error";}?>">
              <label for="exampleInputEmail1">Hourly Cost <?php print $hcError; ?> </label>
              <input type="text" class="form-control" name="HourlyCost"  id="HourlyCost" placeholder="Enter hourly cost in decimal format" value="<?php print $HourlyCost ; ?>">
            </div>
            <div class="form-group <?php if($ctrError != ""){print "has-error";}?>">
              <label for="exampleInputEmail1">Charge Through Rate<?php print $ctrError; ?></label>
              <input type="text" class="form-control" name="ChargeThroughRate"  id="ChargeThroughRate" placeholder="Enter charge through in decimal format" value="<?php print $ChargeThroughRate ; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Active/Inactive</label> <br />
              <select name="active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected >Inactive</option>
              </select>
            </div>
            <div class="form-group" style="visibility: hidden; height: 0px; margin: 0; padding: 0;">
              <input type="text" class="form-control" name="Edit"id="Edit" maxlength="10" value="<?php if ($Edit) {print 1; } else { print 0; }?>">
            </div>
            <div class="form-group" style="visibility: hidden; height: 0px; margin: 0; padding: 0;">
              <input type="text" class="form-control" name="ClassID"id="ClassID" maxlength="10" value="<?php if ($ClassID) {print $ClassID; } else { print ''; }?>">
            </div>

            <button name="enter" type="submit" class="btn btn-default"><?php if ($Edit) { echo 'Update Class'; } else {echo 'Add Class';} ?></button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>




