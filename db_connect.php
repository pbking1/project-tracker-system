<?php
/**
 * This file defines database connection. This file is included in any files that needs database connection
 * 
  */

$conn = mysql_connect("localhost","pengbin","pengbin");
mysql_select_db("pengbin_db", $conn);

?>