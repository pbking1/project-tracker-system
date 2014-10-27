<?php session_start();
include('nav.php'); 
include "dbconnect.php";

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
		$ClassName =  trim($_POST['ClassName']);
		$Description =  trim($_POST['Description']);
		$HourlyCost =  trim($_POST['HourlyCost']);
		$ChargeThroughRate =  trim($_POST['ChargeThroughRate']);
		$status = trim($_POST['active']);
	
		//makes sure that user enters all required data 
		if($ClassName == "")$cnError = '<span style="color:red">*</span>';
		if($Description == "")$dError = '<span style="color:red">*</span>';
		if($HourlyCost == "")$hcError = '<span style="color:red">*</span>';
		if($ChargeThroughRate == "")$ctrError = '<span style="color:red">*</span>';	
			
		
		if(($ClassName != "") && ($Description != "" )&& ($HourlyCost != "") && ($ChargeThroughRate != ""))
		{
	
			$ClassName = mysqli_real_escape_string($con, $ClassName);
			$Description = mysqli_real_escape_string($con, $Description);
			$HourlyCost = mysqli_real_escape_string($con, $HourlyCost);
			$ChargeThroughRate = mysqli_real_escape_string($con, $ChargeThroughRate);	
			$Status = mysqli_real_escape_string($con, $Status);
			
			$sql = "select count(*) as c from T_USER_CLASS where Class_name = '" . $ClassName. "'"; // email would be a better field to use 
			$result = mysqli_query($con, $sql) or die("Error in the consult.." . mysqli_error($con)); //send the query to the database or quit if cannot connect
			
			$count = 0; 
			$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
			$count = $field->c;
			
			if ($count != 0)
			{	//Header ("Location:index.php?l=r") ;
					print "count is ".	$count;					
			}
			else{
			$sql = "INSERT INTO T_USER_CLASS values('".$ClassName."', '".$Description. "', '".$HourlyCost . "', '" .$ChargeThroughRate."', '".$status."')";
			$result= mysqli_query($con, $sql) or die(mysqli_error($con));
			header('Location: success.php');			
			}
			
			
		}
	}// end if 
		
	

	
	
?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New Class</h1>

          <form role="form" method="post" action="newclass.php">
            <div class="form-group <?php if($cnError != ""){print "has-error";}?>">
              <label for="exampleInputEmail1">Class Name <?php print $cnError; ?></label>
              <input type="text" name="ClassName" class="form-control" id="ClassName" placeholder="i.e. Engineer" value="<?php print $ClassName; ?>" maxlength="30">
            </div>
            <div class="form-group <?php if($dError != ""){print "has-error";}?>">
              <label for="exampleInputPassword1">Description <?php print $dError; ?></label>
              <textarea class="form-control" name="Description" id="Description" rows="3" placeholder="Briefly describe the class" maxlength="30" ><?php print $Description ; ?></textarea>
            </div>
            <div class="form-group <?php if($hcError != ""){print "has-error";}?>">
              <label for="exampleInputEmail1">Hourly Cost <?php print $hcError; ?> </label>
              <input type="text" class="form-control" name="HourlyCost"  id="HourlyCost" placeholder="Enter hourly cost in decimal format" value="<?php print $HourlyCost ; ?>" maxlength="3">
            </div>
            <div class="form-group <?php if($ctrError != ""){print "has-error";}?>">
              <label for="exampleInputEmail1">Charge Through Rate<?php print $ctrError; ?></label>
              <input type="text" class="form-control" name="ChargeThroughRate"  id="ChargeThroughRate" placeholder="Enter charge through in decimal format" value="<?php print $ChargeThroughRate ; ?>" maxlength="3">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Active/Inactive</label> <br />
              <select name="active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected >Inactive</option>
              </select>
            </div>

            <button name="enter" type="submit" class="btn btn-default">Add Class</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>




