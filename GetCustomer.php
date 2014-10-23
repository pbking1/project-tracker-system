<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
      $_SESSION['timeout'] = time();
	
	//if this is a page that requires login always perform this session verification
	require_once "inc/sessionVerify.php";

	require_once "dbconnect.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Process Query Strings</title>
	<style type = "text/css">
  		h1, h2 {
    		text-align: center;
  		}

		table {
    		border-top: double;
    		border-bottom: double;
    		border-right: blank
		}

		td, th { border: 1px solid }
	</style>

	</head>

	<body>
		Session and Array Demo

		<br/><br/>

		<?php
			$name = "";
			$address = "";
			$note = "";
			$Active = "";


			//retrieve all the information from the user from the database
			//always check if the session variable exists before using it for the first time on this page. 
			if (isset($_SESSION['email']))
				$sql = "select * from T_CUSTOMER where CustomerName = '".$_SESSION['email']."'";
			//else Header ("Location:logout.php") ;
print $sql;
			$result = mysqli_query($con, $sql) or die(mysqli_error($con)); //send the query to the database or quit if cannot connect
			$fields = mysqli_fetch_array($result);
			
			print "Your information is entered into the database. <br/><br/>";

			print "Customer Name is  ".$fields["CustomerName"]. " Customer Address is ". $fields["CustomerAddress"]. " Some Notes ". $fields["Notes"]. " Is Customer Active". $fields["Active"]."<br />";

			
			
			
		?>
	
		</form>
		<br/><br/>
		<a href="login.php">Login</a>

	</body>
</html>


