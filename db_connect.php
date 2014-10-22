<?php
/**
 * This file defines database connection. This file is included in any files that needs database connection
 * 
  */

$con = mysqli_connect("localhost","pengbin","pengbin","pengbin_db");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 



?>