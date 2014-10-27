<?php session_start();
include('nav.php'); 
include "dbconnect.php";

//initialization of variables 
$FullName = "";
$UserName = "";
$Password = "";
$EmployeeID = "";
$Class = "";
$Role = "";
$Status = "";

//error variables 
$nameError = "";
$userNameError = "";
$PasswordError = "";
$EmpIdError = "";


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
		$FullName =  trim($_POST['FullName']);
		$UserName =  trim($_POST['UserName']);
		$Password =  trim($_POST['Password']);
		$EmployeeID =  trim($_POST['EmployeeID']);
		$Class =  trim($_POST['Class']);
		$Role =  trim($_POST['Role']);
		$Status =  trim($_POST['Active']);
		
		//makes sure that user enters all required data 
		if($FullName == "")$nameError = '<span style="color:red">*</span>';
		if($UserName == "")$userNameError = '<span style="color:red">*</span>';
		if($Password == "")$PasswordError = '<span style="color:red">*</span>';
		if($EmployeeID == "")$EmpIdError = '<span style="color:red">*</span>';	

		if(($FullName != "") && ($UserName != "" )&& ($Password != "") && ($EmployeeID != ""))
		{
			$FullName = mysqli_real_escape_string($con, $FullName);
			$UserName = mysqli_real_escape_string($con, $UserName);
			$Password = mysqli_real_escape_string($con, $Password);
			$EmployeeID = mysqli_real_escape_string($con, $EmployeeID);	
			$Class = mysqli_real_escape_string($con, $Class);	
			$Role = mysqli_real_escape_string($con, $Role);	
			$Status = mysqli_real_escape_string($con, $Status);	
			
			$sql = "select count(*) as c from T_USER where Employee_ID = '" . $EmployeeID. "'"; // email would be a better field to use 
			$result = mysqli_query($con, $sql) or die("Error in the consult.." . mysqli_error($con)); //send the query to the database or quit if cannot connect
			
			$count = 0; 
			$field = mysqli_fetch_object($result); //the query results are objects, in this case, one object
			$count = $field->c;
			if ($count != 0)
			{	//Header ("Location:index.php?l=r") ;
					print "count is ".	$count;					
			}
			else{
			$sql = "INSERT INTO T_USER values('".$EmployeeID."', '".$UserName. "', '".$FullName . "', '" .$Password."', '".$EmployeeID."', '".$EmployeeID."', '".$Class."')";
			$result= mysqli_query($con, $sql) or die(mysqli_error($con));				
			header('Location: success.php');
			}
			
			
			} 
	}//endif
?>	

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">New User</h1>

          <form role="form" method="post" action="newuser.php">
            <div class="form-group <?php if($nameError != ""){print "has-error";}?>" ">
              <label for="FullName">Full Name <?php print $nameError; ?></label>
              <input type="text" class="form-control" name="FullName" id="FullName" placeholder="i.e. John Smith" value="<?php print $FullName; ?>" maxlength="10">
            </div>
            <div class="form-group <?php if($userNameError != ""){print "has-error";}?>"">
              <label for="UserName">Username <?php print $userNameError; ?></label>
              <input type="text" class="form-control" name="UserName" id="UserName" placeholder="i.e. johnsmith" value="<?php print $UserName; ?>" maxlength="10">
            </div>
            <div class="form-group <?php if($PasswordError != ""){print "has-error";}?>"">
              <label for="Password">Password <?php print $PasswordError; ?></label>
              <input type="text" class="form-control" name="Password"id="Password" placeholder="Enter a password for the user" value="<?php print $Password; ?>" maxlength="10">
            </div>
            <div class="form-group <?php if($EmpIdError != ""){print "has-error";}?>"">
              <label for="EmployeeID">Employee ID <?php print $EmpIdError; ?></label>
              <input type="text" class="form-control" name="EmployeeID"id="EmployeeID" placeholder="The user's employee ID" value="<?php print $EmployeeID; ?>" maxlength="10">
            </div>
            <div class="form-group">
              <label for="Class">Class</label> <br />
              <select name="Class" class="form-control">
		<?php 
		$list = "";
		$sql = "SELECT Class_name from T_USER_CLASS";
		$result = mysqli_query($con, $sql) or die(mysqli_error($con));
		print $sql;
       
		while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
		{	
		$list = $list .'<option value ="'.$row["Class_name"].'">'.$row["Class_name"].'</option>' ;
		}

		print $list;
		?>	
              </select>
            </div>
            <div class="form-group">
              <label for="Role">Role</label> <br />
              <select name="Role" class="form-control">
              <option value="Admin" selected>Admin</option>
              <option value="ProjectManager">Project Manager</option>
              <option value="User">User</option>
              </select>
            </div>
            <div class="form-group">
              <label for="Active">Active/Inactive</label> <br />
              <select name="Active" class="form-control">
              <option value="active">Active</option>
              <option value="inactive" selected>Inactive</option>
              </select>
            </div>

            <button name="enter" type="submit" class="btn btn-default">Add User</button>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
