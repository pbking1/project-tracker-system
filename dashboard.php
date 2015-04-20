<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dajac Inc. - Dashboard</title>
  </head>

  <body>
  <?php include('nav.php'); include('db_connect.php'); ?>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1 style="margin-top:0;">Dashboard</h1>

      <h3 class="sub-header">Recent Tasks</h3>

      <!-- ///////////////////////// TASKS ///////////////////////// -->

      <?php
        $count = 0;
        $PunchedHTML = '';
        $LoggedInUserName = $_SESSION['uid'];

        $sql = "SELECT *
                FROM RECENT_TIMECARD
                WHERE UserName = '$LoggedInUserName'
                LIMIT 11";

        $Timecards = mysqli_query($link, $sql) or die(mysqli_error($link));

        // Print the beginning of our row DIV
        echo '<div class="row">';
        // Look through all assignments in DB for this user
          while ($Timecard = mysqli_fetch_array($Timecards, MYSQLI_ASSOC)) {
            $HoursHTML = '';
            $Punched = 0;
              $HoursHTML = '<span>Total Hours: '.$Timecard['TotalHours'].'</span>';
              if ($Timecard['Running'] == 1) {
                $PunchedHTML = '
                  <a href="punch.php?TaskID='.$Timecard["TaskID"].'&CallbackURL='.$_SERVER['REQUEST_URI'].'">
                  <br />
                    <button class="butn butn-success butn-striped active" type="button">
                      Clocked In
                    </button>
                  </a>
                ';
              }
              else {
                $PunchedHTML = '
                  <a href="punch.php?TaskID='.$Timecard["TaskID"].'&CallbackURL='.$_SERVER['REQUEST_URI'].'">
                  <br />
                      <button class="btn btn-primary" type="button">
                      Clock In
                    </button>
                  </a>
                ';
              }
              // If this is the first item, offset it
            if ($count == 0) {
              $printout = '
              <div class="col-md-2 col-md-offset-1">
                  <div class="dummy"></div>
                    <div class="tasktile"
                      <span><b>'.$Timecard["TaskName"].'</b></span><br />
                      '.$HoursHTML.'
                      '.$PunchedHTML.'
                    </div>
              </div>
              ';
              $count++;
              echo $printout;
            } // End IF

            // If this is the fifth item, start a new row
            elseif ($count == 5) {
              echo '</div>';
              echo '<div class="row">';
              $count = 0;
            }

            // Not a special case
            else {
              $printout = '
              <div class="col-md-2">
                  <div class="dummy"></div>
                    <div class="tasktile"
                      <span><b>'.$Timecard["TaskName"].'</b></span><br />
                      '.$HoursHTML.'
                      '.$PunchedHTML.'
                    </div>
              </div>
              ';
              $count++;
              echo $printout;
            }
          }
          echo "</div>";
      ?>


      <br />
      <h3 class="sub-header">Projects</h3>

      <!-- /////////////////////// PROJECTS //////////////////////// -->

      <?php
        $count = 0;

        $sql = "SELECT *
                FROM T_PROJECT;";

        $projects = mysqli_query($link, $sql) or die(mysqli_error($link));

        // Print the beginning of our row DIV
        echo '<div class="row">';
        // For each project in the database...
        while ($row = mysqli_fetch_array($projects, MYSQLI_ASSOC)) {
        // If this is the first item, offset it
          if ($count == 0) {
            $printout = '
            <div class="col-md-2 col-md-offset-1">
                <div class="dummy"></div>
                <a href="projectdetails.php?ProjectID='.$row["ProjectID"].'" class="tasktile">'.$row["ProjectName"].'</a>
            </div>
            ';
            $count++;
            echo $printout;
          } // End IF

          // If this is the fifth item, start a new row
          elseif ($count == 5) {
            echo '</div>';
            echo '<div class="row">';
            $count = 0;
          }

          // Not a special case
          else {
            $printout = '
            <div class="col-md-2">
                <div class="dummy"></div>
                <a href="projectdetails.php?ProjectID='.$row["ProjectID"].'" class="tasktile">'.$row["ProjectName"].'</a>
            </div>
            ';
            $count++;
            echo $printout;
          }
        } // End WHILE
        echo '</div>';

      ?>

    </div>
  </body>
</html>
