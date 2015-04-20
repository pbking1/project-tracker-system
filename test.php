<?php
require_once "db_connect.php";

?>

 <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="test.css">
<title>Dajac Inc. - Report Test</title>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.3/css/jquery.dataTables.css">

<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
    var table = $('#userTable').DataTable({
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
    $('#userTable tbody').on( 'click', 'tr.group', function () {
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


<table id="userTable" class="display" cellspacing="0" width="100%">
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

</body>

</html>
