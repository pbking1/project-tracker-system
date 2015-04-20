<?php 
session_start();

  // Punch in the timecard on defined task and also let us know what page you're doing it from

  function punch($TaskID, $CallbackURL) {
    include "db_connect.php";
    $UserName = $_SESSION['uid'];
    //$CurrentDate = date("Y-m-d H:i:s");
    $CurrentDate = new DateTime();
    $CurrentDateString = $CurrentDate->format('Y-m-d H:i:s');
    
    // Get our currently active task, if it exists
    $sql = "SELECT * FROM T_TIMECARD where UserName = '$UserName'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    // Loop through the results, looking for an active task
    while ($row = mysqli_fetch_array($result)) {
      if ($row["Running"] == 1) {
        // A task is active!
        echo "found task";
        $RunningTaskID = $row["TaskID"];
        $CurrentTimeCardID = $row["TimeCardID"];
        // Get the last punch date...
        $LastDate = $row["Punch"];
        $LastDateObject = DateTime::createFromFormat('Y-m-d H:i:s', $LastDate);

        // and calculate hours inbetween
        $diff = $CurrentDate->diff($LastDateObject);
        $hours = $diff->h;
        $minutes = $diff->i;
        $addtotal = $hours + ($minutes/60);
        // Round to the nearest hundredth
        $addtotal = round($addtotal, 2);

        // Add that to the total hours and place it back in the database
        $NewTotalHours = $row["TotalHours"]+$addtotal;
        // Set that task to no longer be running
        $RunningTaskStatus = 0;
        // Write changes to database
        $sql = "CALL SP_PUNCH_TIMECARD($CurrentTimeCardID, '$UserName', $RunningTaskID, '$LastDate', $NewTotalHours, $RunningTaskStatus)";
        mysqli_query($link, $sql) or die(mysqli_error($link));
        if ($_GET['TaskID']=='clockout') {
            header('Location: '.$CallbackURL);
        }
      }
    }
    if ($_GET['TaskID']=='clockout') {
        header('Location: '.$CallbackURL);
    }
    // Get the clicked task from the database
    // Punch the task and set it to active

    // Get task we want to punch
    $sql = "SELECT * FROM T_TIMECARD where TaskID = $TaskID and UserName = '$UserName'";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));

    if (mysqli_num_rows($result) == 0) { // If timecard does not exist, create one
        $sql = "CALL SP_PUNCH_TIMECARD(NULL, '$UserName', $TaskID, '$CurrentDateString', 0, 1)"; 
    }
    else {
        $row = mysqli_fetch_array($result);
        $CurrentHours = $row['TotalHours'];
        $TimeCardIDToPunch = $row['TimeCardID'];
        $sql = "CALL SP_PUNCH_TIMECARD($TimeCardIDToPunch, '$UserName', $TaskID, '$CurrentDateString', $CurrentHours, 1)";
    }
    mysqli_query($link, $sql) or die(mysqli_error($link));
    // DONE
    // Return the user to the last page they were on
    header('Location: '.$CallbackURL);
  }

  punch($_GET['TaskID'], $_GET['CallbackURL']);
  echo "<h1>DONE</h1>";

?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

</body>
</html>

