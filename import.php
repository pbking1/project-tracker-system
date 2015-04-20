<?php
$content = <<< IMPORT
    <!-- Validation Script -->
    <script src="js/validate.js"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Color Picker -->
    <script src="js/spectrum.js"></script>
    <link rel='stylesheet' href='css/spectrum.css' />

	<!-- Import Bootstap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">

	<!-- Import custom css for this theme -->
	<link href="css/dashboard.css" rel="stylesheet">

	<!-- Custom CSS Overrides -->
    <link href="css/custom.css" rel="stylesheet">
IMPORT;
echo $content;
?>