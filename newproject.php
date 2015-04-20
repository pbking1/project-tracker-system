<?php 
include('nav.php'); 
include "db_connect.php";

//initialization of variables 
$ProjectName = "";
$ProjectColor = "";
$StartDate = "";
$EndDate = "";
$RevisionLetter = "";
$MantisID = "";
$CustomerID = "";
$ShortDescription = "";
$LongDescription = "";
$DajacSalesAssociate = "";
$LocalProRate = "0";
$GlobalMaterialMarkup = "0";
$Status = "";
$Active = "";
$AssignedUsers = "";


//Error variables initialization
$ProjectNameError = "";
$StartDateError = "";
$EndDateError = "";
$RevisionLetterError = "";
$MantisIDError = "";
$ShortDescriptionError = "";
$LongDescriptionError = "";
$DajacSalesAssociateError = "";
$LocalProRateError = "";
$GlobalMaterialMarkupError = "";
$StatusError = "";


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
    $ProjectColor =  trim($_POST['ProjectColor']);
    $StartDate =  trim($_POST['StartDate']);
    $EndDate =  trim($_POST['EndDate']);
		$RevisionLetter =  trim($_POST['RevisionLetter']);
		$MantisID =  trim($_POST['MantisID']);
    $CustomerID = trim($_POST['CustomerID']);;
		$ShortDescription =  trim($_POST['ShortDescription']);
		$LongDescription =  trim($_POST['LongDescription']);
    $DajacSalesAssociate =  trim($_POST['DajacSalesAssociate']);
    $LocalProRate =  trim($_POST['LocalProRate']);  
    $GlobalMaterialMarkup =  trim($_POST['GlobalMaterialMarkup']);
		$Status =  trim($_POST['ProjectStatus']);
    $Active =  trim($_POST['Active']);
		
		//makes sure that user enters all required data 
		if($ProjectName == "")$ProjectNameError = '<span style="color:red">*</span>';
    if($StartDate == "")$StartDateError = '<span style="color:red">*</span>';
    if($EndDate == "")$EndDateError = '<span style="color:red">*</span>';
		if($RevisionLetter == "")$RevisionLetterError = '<span style="color:red">*</span>';
		if($MantisID == "")$MantisIDError = '<span style="color:red">*</span>';
		if($ShortDescription == "")$ShortDescriptionError = '<span style="color:red">*</span>';
		if($LongDescription == "")$LongDescriptionError = '<span style="color:red">*</span>';
		if($GlobalMaterialMarkup == "")$GlobalMaterialMarkupError = '<span style="color:red">*</span>';
		if($LocalProRate == "")$locProRateError = '<span style="color:red">*</span>';
		
		
		if(($ProjectName != "") && ($RevisionLetter != "" )&& ($MantisID != "") && ($ShortDescription != "") && ($LongDescription != ""))
		{
			$ProjectName = mysqli_real_escape_string($link, $ProjectName);
      $ProjectColor = mysqli_real_escape_string($link, $ProjecColor);
      $StartDate = mysqli_real_escape_string($link, $StartDate);
      $EndDate = mysqli_real_escape_string($link, $EndDate);
			$RevisionLetter = mysqli_real_escape_string($link, $RevisionLetter);
			$MantisID = mysqli_real_escape_string($link, $MantisID);
			$ShortDescription = mysqli_real_escape_string($link, $ShortDescription);
			$LongDescription = mysqli_real_escape_string($link, $LongDescription);
			$GlobalMaterialMarkup = mysqli_real_escape_string($link, $GlobalMaterialMarkup);
			$CustomerID = mysqli_real_escape_string($link, $CustomerID);
			$LocalProRate = mysqli_real_escape_string($link, $LocalProRate);
			$DajacSalesAssociate = mysqli_real_escape_string($link, $DajacSalesAssociate);
			$ProjectStatus = mysqli_real_escape_string($link, $ProjectStatus);
			
			$sql = "select count(*) as c from T_PROJECT where ProjectName = '" . $ProjectName. "'"; // email would be a better field to use 
			$result = mysqli_query($link, $sql) or die("Error in the consult.." . mysqli_error($link)); //send the query to the database or quit if cannot connect
			
			$count = 0; 
			$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
			$count = $field->c;
			
			if ($count != 0)
			{	Header ("Location:newproject.php") ;
					print "count is ".	$count;
			}
			else{

      mysqli_autocommit($link, FALSE);
      // Place Users into the assigned_project table
      $sql = "CALL SP_INSERT_PROJECT(NULL, '$ProjectName', '$ProjectColor', '$StartDate', '$EndDate', '$RevisionLetter', '$MantisID', '$CustomerID', '$ShortDescription', '$LongDescription', '$DajacSalesAssociate', $LocalProRate, $GlobalMaterialMarkup, '$ProjectStatus', $Active)";
      mysqli_query($link, $sql) or die(mysqli_error($link));

      $getID = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(`ProjectID`) FROM `T_PROJECT`"));
      $ProjectID = $getID[0];
      if ($ProjectID == "") {
        die("PROJECT ID CANNOT BE EMPTY");
      }

      foreach($_POST['AssignedUsers'] as $AssignedUser) {
        echo $AssignedUser;
        $sql = "CALL SP_INSERT_ASSIGNMENT(NULL, '$AssignedUser', $ProjectID)";
        mysqli_query($link, $sql) or die(mysqli_error($link));
      }
      mysqli_commit($link);
      header('Location: /dajacinc/dev/manageprojects.php');

			}
		}
	}
?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New Project</h1>

          <form role="form" method="post" action="newproject.php">
            <div class="form-group <?php if($ProjectNameError != ""){print "has-error";}?>">
              <label for="ProjectName">Project Name<?php print $ProjectNameError; ?> </label>
              <input type="text" class="form-control" name="ProjectName" id="ProjectName" value="<?php print $ProjectName; ?>" placeholder="Name the project" maxlength="20">
            </div>
            <div>
              <label for="ProjectColor">Project Color<?php print $ProjectColorError; ?> </label>
              <input type='text' id="colorpicker" value="white" />
            </div>
            <div class="form-group <?php if($StartDateError != ""){print "has-error";}?>">
              <label for="StartDate">Project Start Date<?php print $StartDateError; ?> </label>
              <input type="text" name="StartDate" id="startdatepicker">
            </div>
            <div class="form-group <?php if($EndDateError != ""){print "has-error";}?>">
              <label for="StartDate">Project End Date<?php print $EndDateError; ?> </label>
              <input type="text" name="EndDate" id="enddatepicker">
            </div>
            <div class="form-group <?php if($RevisionLetterError != ""){print "has-error";}?>">
              <label for="RevisionLetter">Revision Letter<?php print $RevisionLetterError; ?> </label>
              <input type="text" class="form-control" name="RevisionLetter"id="RevisionLetter" value="<?php print $RevisionLetter; ?>" placeholder="A, B, C, etc." maxlength="10">
            </div>
            <div class="form-group <?php if($MantisIDError != ""){print "has-error";}?>">
              <label for="MantisID">MantisID<?php print $MantisIDError; ?> </label>
              <input type="text" name="MantisID"class="form-control" id="MantisID" value="<?php print $MantisID; ?>" placeholder="######" maxlength="10">
            </div>
            <div class="form-group ">
              <label for="Customer">Customer</label> <br />
              <select name="CustomerID" class="form-control">
				<?php 
				$list = "";
				$sql = "SELECT * from T_CUSTOMER";
				$result = mysqli_query($link, $sql) or die(mysqli_error($link));

				while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
				{	
				$list = $list .'<option value ="'.$row["CustomerID"].'">'.$row["FirstName"].' '.$row["LastName"].'</option>' ;
				}

				print $list;
				?>	
              </select>
            </div>
            <div class="form-group <?php if($ShortDescriptionError != ""){print "has-error";}?>">
              <label for="ShortDescription">Short Description<?php print $ShortDescriptionError; ?> </label>
              <input type="text" class="form-control" name="ShortDescription" id="ShortDescription" value="<?php print $ShortDescription; ?>" placeholder="Less than 128 characters" maxlength="20">
            </div>
            <div class="form-group <?php if($longDescriptionError != ""){print "has-error";}?>">
              <label for="LongDescription">Long Description<?php print $LongDescriptionError; ?> </label>
              <textarea class="form-control" rows="3" name="LongDescription" id="LongDescription" placeholder="Describe the project in its entirety" maxlength="40"><?php print $LongDescription; ?></textarea>
            </div>
            <div class="form-group">
              <label for="Active">Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="1">Active</option>
              <option value="0" selected>Inactive</option>
              </select>
            </div>
            <div class="form-group ">
              <label for="ProjectStatus">Project Status</label> <br />
              <select name="ProjectStatus" class="form-control">
              <option value="Active">Active</option>
              <option value="Completed">Completed</option>
              <option value="On Hold">On Hold</option>
              </select>
            </div>
            <div class="form-group">

            <label for="AssignedUsers">Assigned Users</label> <br />
              <?php 
              $list = "";
              $sql = "SELECT * from T_USER";
              $result = mysqli_query($link, $sql) or die(mysqli_error($link));

              while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
              { 
              $list = $list.'
              <div class="checkbox">
                <label>
                  <input value="'.$row["UserName"].'" name="AssignedUsers[]" type="checkbox"> '.$row["FirstName"].' '.$row["LastName"].'
                </label>
              </div>
              ';
              }

              print $list;
              ?>
            </div>
            <div class="form-group">
              <label for="DajacSalesAssociate">Dajac Sales Associate</label> <br />
              <select name="DajacSalesAssociate" class="form-control">
                <?php 
                $sql = "SELECT * from T_USER";
                $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                $list = "";
                while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
                { 
                $list = $list .'<option value ="'.$row["UserName"].'">'.$row["FirstName"].' '.$row["LastName"].'</option>' ;
                }

                print $list;
                ?>  
              </select>
            </div>
				

            <br />
            <h3 class="sub-header">Local Rate Overrides</h3>
            <div class="form-group <?php if($LocalProRateError != ""){print "has-error";}?>">
              <label for="LocalRateOverride">Local Project Rate <?php print $LocalProRateError; ?> </label>
              <input type="text" class="form-control" name="LocalProRate" id="LocalProRate" value="<?php print $LocalProRate; ?>" placeholder="Enter local rate in decimal format" maxlength="10">
            </div>
            <div class="form-group <?php if($GlobalMaterialMarkupError != ""){print "has-error";}?>">
              <label for="GlobalMaterialMarkup">Global Material Markup<?php print $GlobalMaterialMarkupError; ?> </label>
              <input type="text" class="form-control" name="GlobalMaterialMarkup"id="GlobalMaterialMarkup" value="<?php print $GlobalMaterialMarkup; ?>" placeholder="Enter material markup in decimal format" maxlength="10">
            </div>


            <button name="enter" type="submit" class="btn btn-default">Add Project</button>
          </form>

          <script>
          $(function() {
            $( "#startdatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
          });
          $(function() {
            $( "#enddatepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
          });
          </script>

          <script>
          $("#colorpicker").spectrum({
            color: "#FFF",
            showInput: true,
            className: "full-spectrum",
            showInitial: true,
            showPalette: true,
            showSelectionPalette: true,
            maxPaletteSize: 10,
            preferredFormat: "hex",
            localStorageKey: "spectrum.demo",
            showButtons: false,
            move: function (color) {
                
            },
            show: function () {
            
            },
            beforeShow: function () {
            
            },
            hide: function () {
              
            },
            change: function() {
                
            },
            palette: [
                ["#428BCA", "#5CB85C", "#5BC0DE", "#F0AD4E", "#D9534F",],
                ["#401F7C", "#2C2246", "#2A40A7", "#D1D4E4", "#14063A",],
                ["#E6B39A", "#E6CBA5", "#EDE3B4", "#8B9E9B", "#6D7578",],
            ]
        });
        </script>

        </div>
      </div>
    </div>
  </body>
</html>


