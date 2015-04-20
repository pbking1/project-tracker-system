<?php
// This imports a file containing all of our style sheets and javascript
include('import.php');
include ('authCheck.php');
error_reporting(E_ERROR | E_PARSE);

// Print out the navigation HTML
$content = <<< NAV
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

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
          <a class="navbar-brand" href="dashboard.php">Dajac Inc. <span class="navbar-brand-after">Project Tracker</span></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">

            <!-- Top right navigation  -->
            <!--<li><a href="/dajacinc/dev/logout.php">Welcome <span style="color:white;">{$_SESSION['uid']}</span></a></li>-->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome <span style="color:white;">{$_SESSION['uid']}</span><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="/dajacinc/dev/logout.php">Logout</a></li>
                </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-right" action="search.php">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">

            <!-- Sidebar Navigation -->
            <li>
            <a href="punch.php?TaskID=clockout&CallbackURL={$_SERVER['REQUEST_URI']}">
              <button class="btn btn-warning clockoutbtn">
                Clock Out Of All Tasks
              </button>
            </a>
            </li>
            <li class="active"><a href="dashboard.php">Dashboard</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="manageusers.php">Manage Users</a></li>
            <li><a href="managecustomers.php">Manage Customers</a></li>
            <li><a href="manageprojects.php">Manage Projects</a></li>
            <li><a href="projectstatistics.php">Project Statistics</a></li>
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