<?php
include 'nav.php'; 
include 'db_connect.php';

//ADD PROJECT ID

//initialization of variables 
$UserName = "";
$FirstName = "";
$LastName = "";
$Email = "";
$Password = "";
$EmployeeID = "";
$ClassID = "";
$RoleName = "";
$Active = "";

//error variables 
$UserNameError = "";
$FirstNameError = "";
$LastNameError = "";
$EmailError = "";
$PasswordError = "";
$EmployeeIDError = "";


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - New User</title>
  </head>
  <body>

<?php if (isset($_POST['enter']))
	{
		//take the information submitted and verify inputs
		$UserName =  trim($_POST['UserName']);
		$FirstName =  trim($_POST['FirstName']);
		$LastName =  trim($_POST['LastName']);
		$Email =  trim($_POST['Email']);
		$Password =  trim($_POST['Password']);
		$EmployeeID =  trim($_POST['EmployeeID']);
		$ClassID =  trim($_POST['ClassID']);
		$RoleName =  trim($_POST['RoleName']);
		$Active =  trim($_POST['Active']);
		$Edit = trim($_POST['Edit']);
		
		//makes sure that user enters all required data 
		if($UserName == "")$UserNameError = '<span style="color:red">*</span>';
		if($FirstName == "")$FirstNameError = '<span style="color:red">*</span>';
		if($LastName == "")$LastNameError = '<span style="color:red">*</span>';
		if($Email == "")$EmailError = '<span style="color:red">*</span>';
		if($Password == "")$PasswordError = '<span style="color:red">*</span>';
		if($EmployeeID == "")$EmployeeIDError = '<span style="color:red">*</span>';

		if ($Edit) {
			$PasswordError = "";
		}

		if(($UserNameError == "" ) && ($FirstNameError == "") && ($LastNameError == "") && ($EmailError == "") && ($PasswordError == "") && ($EmployeeIDError == ""))
		{
			$UserName = mysqli_real_escape_string($link, $UserName);
			$FirstName = mysqli_real_escape_string($link, $FirstName);
			$LastName = mysqli_real_escape_string($link, $LastName);
			$Email = mysqli_real_escape_string($link, $Email);
			$Password = mysqli_real_escape_string($link, $Password);
			$EmployeeID = mysqli_real_escape_string($link, $EmployeeID);
			$ClassID = mysqli_real_escape_string($link, $ClassID);
			$RoleName = mysqli_real_escape_string($link, $RoleName);
			
			$sql = "select count(*) as c from T_USER where EmployeeID = '" . $EmployeeID. "'"; // email would be a better field to use 
			$result = mysqli_query($link, $sql) or die("Error in the consult.." . mysqli_error($link)); //send the query to the database or quit if cannot connect
			
			$count = 0; 
			$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
			$count = $field->c;
			if ($count != 0 && !$Edit)
			{	//Header ("Location:index.php?l=r") ;
					print "count is ".	$count;					
			}
			else{
			$sql = "CALL SP_INSERT_USER('$UserName', '$FirstName', '$LastName', '$Email', '$Password', '$EmployeeID', '$RoleName', $ClassID, $Active)";
			mysqli_query($link, $sql) or die(mysqli_error($link));
			header('Location: /dajacinc/dev/manageusers.php');
			}
		} 
	}//endif
	elseif (isset($_GET['UserName'])) {
		$Edit = True;
		$UserName =  trim($_GET['UserName']);
		$FirstName =  trim($_GET['FirstName']);
		$LastName =  trim($_GET['LastName']);
		$Email =  trim($_GET['Email']);
		$EmployeeID =  trim($_GET['EmployeeID']);
		$ClassID =  trim($_GET['ClassID']);
		$RoleName =  trim($_GET['RoleName']);
		$Active =  trim($_GET['Active']);
	}
?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php if ($Edit) { echo 'Edit User'; } else {echo 'New User';} ?></h1>

          <form role="form" method="post" action="newuser.php">
            <div class="form-group <?php if($UserNameError != ""){print "has-error";}?>">
              <label for="UserName">Username <?php print $UserNameError; ?></label>
              <input type="text" class="form-control" name="UserName" id="UserName" placeholder="i.e. johnsmith" value="<?php print $UserName; ?>" maxlength="10">
            </div>
            <div class="form-group <?php if($FirstNameError != ""){print "has-error";}?>">
              <label>First Name <?php print $FirstNameError; ?></label>
              <input type="text" class="form-control" name="FirstName" id="FirstName" placeholder="i.e. John Smith" value="<?php print $FirstName; ?>" maxlength="128">
            </div>
            <div class="form-group <?php if($LastNameError != ""){print "has-error";}?>">
              <label>Last Name <?php print $LastNameError; ?></label>
              <input type="text" class="form-control" name="LastName" id="LastName" placeholder="i.e. John Smith" value="<?php print $LastName; ?>" maxlength="128">
            </div>
            <div class="form-group <?php if($EmailError != ""){print "has-error";}?>">
              <label for="FullName">Email <?php print $EmailError; ?></label>
              <input type="email" class="form-control" name="Email" id="Email" placeholder="i.e. John Smith" value="<?php print $Email; ?>" maxlength="50">
            </div>
            <div class="form-group <?php if($PasswordError != ""){print "has-error";}?>">
              <label for="Password">Password <?php print $PasswordError; ?></label>
              <input type="text" class="form-control" name="Password"id="Password" placeholder="<?php if ($Edit) { echo 'Enter a new password (If you want to change it)'; } else {echo 'Enter a password for the user';} ?>" value="<?php print $Password; ?>" maxlength="128">
            </div>
            <div class="form-group <?php if($EmployeeIDError != ""){print "has-error";}?>">
              <label for="EmployeeID">Employee ID <?php print $EmployeeIDError; ?></label>
              <input type="text" class="form-control" name="EmployeeID"id="EmployeeID" placeholder="The user's employee ID" value="<?php print $EmployeeID; ?>" maxlength="128">
            </div>
            <div class="form-group">
              <label for="Role">Role</label> <br />
              <select name="RoleName" class="form-control">
              <option value="ProjectManager" <?php if($Role == "ProjectManager"){print 'selected="selected"';}?>>Project Manager</option>
              <option value="User" <?php if($Role == "User"){print 'selected="selected"';}?>>User</option>
              </select>
            </div>
            <div class="form-group">
              <label for="ClassID">Class</label> <br />
              <select name="ClassID" class="form-control">
		<?php 
		$list = "";
		$sql = "SELECT * from T_USER_CLASS";
		$result = mysqli_query($link, $sql) or die(mysqli_error($link));
		print $sql;
       
		while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
		{	
		$list = $list .'<option value ="'.$row["ClassID"].'">'.$row["ClassName"].'</option>' ;
		}

		print $list;
		?>	
              </select>
            </div>
            <div class="form-group">
              <label for="Active">Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="1" <?php if($Active == "1"){print 'selected="selected"';}?>>Active</option>
              <option value="0" <?php if($Active == "0"){print 'selected="selected"';}?>>Inactive</option>
              </select>
            </div>
            <div class="form-group" style="visibility: hidden; height: 0px; margin: 0; padding: 0;">
              <input type="text" class="form-control" name="Edit"id="Edit" maxlength="10" value="<?php if ($Edit) {print 1; } else { print 0; }?>">
            </div>

            <button name="enter" type="submit" class="btn btn-default"><?php if ($Edit) { echo 'Update User'; } else {echo 'Add User';} ?></button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
