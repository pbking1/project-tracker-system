<?php 
include 'nav.php'; 
include "db_connect.php";

?> 
 
 <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Dajac Inc. - Report Test</title>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.3/css/jquery.dataTables.css">
  
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
	$('#userTable').dataTable( {
		"pagingType": "full_numbers"
	} );
} );

$(document).ready(function() {
    var table = $('#timecardTable').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="6">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        }
    } );

    // Order by the grouping
    $('#timecardTable tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );
} );

$(document).ready(function() {
    $('#userTable').DataTable();
} );
</script>
</head>

<body>

<div class="container-fluid">
  	<div class="row">
	    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    	<h1 class="page-header">Manage Projects</h1>
			<table id="userTable" class="display" cellspacing="0" width="100%">
			    <thead>
			        <tr>
			            <th>Project Name</th>
			            <th>Start Date</th>
			            <th>End Date</th>
			            <th>Revision Letter</th>
			            <th>MantisID</th>
			            <th>CustomerID</th>
			            <th>Short Description</th>
			            <th>Long Description</th>
			            <th>Dajac Sales Associate</th>
			            <th>Local Pro Rate</th>
			            <th>Global Material Markup</th>
			            <th>Status</th>
			            <th>Active</th>
			        </tr>
			    </thead>
			    <tbody>
			<?php 
				$report = array("Project Name", "Start Date", "End Date", "Local Pro Rate", "Global Material Markup");
				$project = array(
					array(2, 042014,082014,3,123),
					array(1, 145,14,4,5)
					);

				$list = "";
				$sql = "SELECT * FROM T_PROJECT";
				$result = mysqli_query($link, $sql) or die(mysqli_error($link));
				
				while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
				{	
						Print "<tr><td>".$row["ProjectName"]."</td><td>".$row["StartDate"]."</td><td>".$row["EndDate"]."</td><td>".$row["RevisionLetter"]."</td><td>".$row["MantisID"]."</td><td>".$row["CustomerID"]."</td><td>".$row["ShortDescription"]."</td><td>".$row["LongDescription"]."</td><td>".$row["DajacSalesAssoc"]."</td><td>".$row["LocalProRate"]."</td><td>".$row["GlobalMaterialMarkup"]."</td><td>".$row["Status"]."</td><td>".$row["Active"]."</td></tr>";
				
				}

							
				
			
				//create the csv file if it doesn't exist
				$fp = fopen("csv/projectreport.csv", "w");  

				//write the file header
					fputcsv($fp, $report);

				//write the Report array into the csv file
				foreach($project as $fields)
				{
					fputcsv($fp, $fields);
					}

				//close the file handler
				fclose($fp);


			
		
			?>	

			    </tbody>
			</table>
			<form action="/dajacinc/dev/newproject.php">
    			<input type="submit" value="Add New Project" class="btn btn-success">
			
			Click <a href="http://corsair.cs.iupui.edu:20071/dajacinc/dev/csv/projectreport.csv">to download the Spreadsheet</a>
			</form>




			<br /><br /><br />
			<h1 class="page-header">Timecards</h1>
			<!-- TIMECARD TABLE -->
			<table id="timecardTable" class="display" cellspacing="0" width="100%">
			    <thead>
			        <tr>
			            <th>ProjectID</th>
			            <th>ProjectName</th>
			 <th>User Info</th>
			            <th>Status</th>
			            <th>TotalHours</th>
			        </tr>
			    </thead>
			    <tbody>
			<?php
			 $list = "";
			 $sql = "SELECT * FROM USER_REPORT";
			 $result = mysqli_query($link, $sql) or die(mysqli_error($link));


			 while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
			 {
			 Print "<tr><td>".$row["ProjectID"]."</td><td>".$row["ProjectName"]."</td><td>".$row["UserName"].": ".$row["FirstName"]. "  ".$row["LastName"]."/".$row["ClassName"]."</td><td>".$row["Status"]."</td><td>".$row["Sum(TotalHours)"]."</td></tr>";

			 }


			?>

			    </tbody>
			</table>


		</div>
	</div>
</div>
</body>

</html> 




















