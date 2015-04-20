<?php
include('nav.php'); 
include "db_connect.php";

$quotedPrice = 0;
$CostOfSales = 0;
$markup = 0;
$fixedadjustment = 0;
$totalrev = 0;
$discount = 0;
$grossProfit = 0;
$grossProfPer = 0;
//This query will help to create the table for formatting and to find the total ext cost.
$sql = "SELECT * FROM PROJECT_REPORT";
$result = mysqli_query($link, $sql) or die(mysqli_error($link));

?>

 <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="test.css">
<title>Dajac Inc. - Report Test</title>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">

<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {
    var table = $('#laborTable').DataTable({
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
    $('#laborTable tbody').on( 'click', 'tr.group', function () {
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
    $('#totalsTable').DataTable();
} );
</script>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Project Statistics</h1>
                <table id="laborTable" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Project Name</th>
                            <th>Total Cost</th>
                            <th>Gross Profit </th>
                            <th>Gross Profit Margin</th>
                            <th>% Complete (task)</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php

                //Creates table and the Cost of Sales
                 while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
                 {
                 $quantity = $row["SUM(TotalHours)"];
                 $CostOfSales = ($quantity*$row["HourlyCost"]);
                //The mark-up rate is based on the number of hours so the query result is used to find the correct rate


                if ($quantity < 80){
                 $markup = 10;
                } else if ($quantity > 160){
                 $markup = 5;
                } else{
                $markup = 120 + $quantity*(-0.25);
                 }// end Markup Loop
                //once the cost of sales is calculated, the following is easy to calculate
                $quotedPrice = $CostOfSales*$markup+$fixedadjustment;
                $totalrev = $quotedPrice-$discount;
                $grossProfit = $totalrev-$CostOfSales;
                $grossProfPer = ($grossProfit/$totalrev)*100;



                 Print "<tr><td>".$row["FirstName"]." ".$row["LastName"]."</td><td>".$row["Status"]."</td><td>".$row["ProjectName"]."   &nbsp&nbsp<b>Start Date: </b>".$row["StartDate"]." &nbsp<b>End Date: </b>".$row["EndDate"]."</td><td>".$CostOfSales."</td><td>".$grossProfit."</td><td>".$grossProfPer."</td><td>".($row["PCT_COMPLETED"]*100)."</td></tr>";

                 }//end while


                ?>

                </tbody>
            </table>

            <?php 
            $sql = "SELECT * FROM PROJECT_REPORT";
             $result = mysqli_query($link, $sql) or die(mysqli_error($link));
             $array = "['Project Name', 'Hours Logged']";


             while ($row = mysqli_fetch_array($result)) //get each row whose data is stored as an associative array
             {
             $array = $array.",['".$row["ProjectName"]."',".$row["TotalHours"]."]";
             }
            ?>

            <div id="chart_div" style="width: 900px; height: 500px;"></div>


            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                <script type="text/javascript">
                  google.load("visualization", "1", {packages:["corechart"]});
                  google.setOnLoadCallback(drawChart);
                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
             <?php print $array; ?>

                    ]);

                    var options = {
                      title: 'Project Hours Logged ',
                      vAxis: {title: 'Hours logged per Project',  titleTextStyle: {color: 'red'}}
                    };

                    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

                    chart.draw(data, options);
                  }
            </script>

        </div>
    </div>
</div>


</body>

</html>