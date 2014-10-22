<?php
// This imports a file containing all of our style sheets and javascript
include('import.php');
include ('authCheck.php');

// Print out the navigation HTML
$content = <<< NAV

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img src="img/logo.svg" id="navlogo" width="50px" height="50px">
          <a class="navbar-brand" href="#">Dajac Inc. Project Tracker</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">

            <!-- Top right navigation  -->
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="/dajacinc/dev/logout.php">Welcome <span style="color:white;">{$_SESSION['uid']}</span></a></li>
          </ul>
          <!--<form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>-->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="projects.php">Projects</a></li>

            <!-- Sidebar Navigation -->
            <li><a href="newuser.php">New User</a></li>
            <li><a href="newclass.php">New Class</a></li>
            <li><a href="newcustomer.php">New Customer</a></li>
          </ul>
          <!--
            <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>
          -->
        </div>
NAV;
echo $content;
?>