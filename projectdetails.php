<?php 
include 'nav.php'; 
include "db_connect.php";

?> 
 
 <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>Dajac Inc. - Project Details</title>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.3/css/jquery.dataTables.css">
  
<?php 
	include 'db_connect.php';

	$ProjectID = $_GET['ProjectID'];

    $sql = "SELECT *
            FROM T_TASK
            WHERE ProjectID = ".$ProjectID.";";

    $Tasks = mysqli_query($link, $sql) or die(mysqli_error($link));

    $sql = "SELECT *
            FROM T_PROJECT
            WHERE ProjectID = ".$ProjectID.";";

    $Project = mysqli_query($link, $sql) or die(mysqli_error($link));
    $Project = mysqli_fetch_array($Project, MYSQLI_ASSOC)
?>

</head>

<body>

<div class="container-fluid">
  	<div class="row">
	    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    	<h1 class="page-header"><?php echo $Project["ProjectName"]; ?> - Project Details</h1>
			<?php
			$LoggedInUserName = $_SESSION['uid'];
			$sql = "SELECT *
            	    FROM T_TIMECARD
                	WHERE UserName = '$LoggedInUserName';";
        	$Timecards = mysqli_query($link, $sql) or die(mysqli_error($link));
			$count = 0;

			echo '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
			while ($Task = mysqli_fetch_array($Tasks, MYSQLI_ASSOC)) {
				$count++;
				// RENDER OUR MAIN TASK
				if ($Task['ParentTaskID'] == "") {
					echo '
				  	<div class="task panel panel-default">
				    	<div class="panel-heading" role="tab" id="heading'.$count.'">
				      		<h4 class="panel-title">
				        		<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$count.'" aria-expanded="false" aria-controls="collapse'.$count.'">

					        		<div class="row">
									  	<div class="col-md-2">'.$Task['TaskName'].'</div>
									  	<div class="col-md-1">';

									  		// CHECK TIMECARDS FOR THIS TASK
											mysqli_data_seek($Timecards,0);
								            while ($Timecard = mysqli_fetch_array($Timecards, MYSQLI_ASSOC)) {
								                if ($Timecard['TaskID']==$Task['TaskID']) {
								                  	if ($Timecard['Running'] == 1) {
														echo '
														<a href="">
										  					<button class="butn butn-success butn-striped active" type="button">
																Clocked In
															</button>
														</a>
														';
								                  	}
								                  	else {
														echo '
														<a href="punch.php?TaskID='.$Task["TaskID"].'&CallbackURL='.$_SERVER['REQUEST_URI'].'">
										  					<button class="btn btn-primary" type="button">
																Clock In
															</button>
														</a>
														';
								                  	}
								                }
								             }

										echo '
									  	</div>
									  	<div class="col-md-1"></div>
									  	<div class="col-md-7">
			          						<div class="progress">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.$Task['PercentComplete'].'%;">
								    				'.$Task['PercentComplete'].'%
								  				</div>
											</div>
										</div>
										<div class="col-md-1">
											<button class="modifytask btn btn-default btn-xs">Edit</button>
											<button class="modifytask btn btn-danger btn-xs">Delete</button>
										</div>
									</div>

				        		</a>
				      		</h4>
				    	</div>
						<div id="collapse'.$count.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$count.'">
						      <div class="list-group">
						';
						 
						 			// RENDER ALL SUBTASKS UNDER THIS TASK   
						   			$sql = "SELECT *
            								FROM T_TASK
						            		WHERE ProjectID = ".$ProjectID.";";
									$SubTasks = mysqli_query($link, $sql) or die(mysqli_error($link));
						      		while ($SubTask = mysqli_fetch_array($SubTasks, MYSQLI_ASSOC)) {
							      		if ($SubTask['ParentTaskID'] == $Task['TaskID']) {
								      		echo '
								      		<li class="list-group-item">
								        		<div class="row">
												  	<div class="col-md-2">'.$SubTask['TaskName'].'</div>
												  	<div class="col-md-1">';
		  												mysqli_data_seek($Timecards,0);
											            while ($Timecard = mysqli_fetch_array($Timecards, MYSQLI_ASSOC)) {
											                if ($Timecard['TaskID']==$SubTask['TaskID']) {
											                  	if ($Timecard['Running'] == 1) {
																	echo '
																	<a href="">
													  					<button class="butn butn-success butn-striped active" type="button">
																			Clocked In
																		</button>
																	</a>
																	';
											                  	}
											                  	else {
																	echo '
																	<a href="punch.php?TaskID='.$SubTask["TaskID"].'&CallbackURL='.$_SERVER['REQUEST_URI'].'">
													  					<button class="btn btn-primary" type="button">
																			Clock In
																		</button>
																	</a>
																	';
											                  	}
											                }
											             }
											        echo '
											  		</div>
												  	<div class="col-md-1"></div>
												  	<div class="col-md-7">
						          						<div class="progress">
															<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.$SubTask['PercentComplete'].'%;">
											    				'.$SubTask['PercentComplete'].'%
											  				</div>
														</div>
													</div>
													<div class="col-md-1">
														<button class="modifytask btn btn-default btn-xs">Edit</button>
														<button class="modifytask btn btn-danger btn-xs">Delete</button>
													</div>
												</div>
								      		</li>
								      		';
							      		}
						      		}
						      		echo '
						      		<a href="newtask.php?ProjectID='.$ProjectID.'&ParentTaskID='.$Task['TaskID'].'">
							      		<li class="list-group-item subtask-list progress-bar-info progress-bar-striped">
							        		<div class="row">
											  	<div class="col-md-4"></div>
											  	<div class="center col-md-4">Add A New Sub Task</div>
												<div class="col-md-4"></div>
											</div>
							      		</li>
						      		</a>
						      		';

					echo '
						      </div>
					    </div>
					</div>
					';
				} //ENDIF
		    } //ENDWHILE
		    // ADD NEW PARENT TASK
		    echo '
		    <a href="newtask.php?ProjectID='.$ProjectID.'">
				<div class="task panel panel-default">
			    	<div class="panel-heading progress-bar-info progress-bar-striped subtask-list" role="tab" id="heading'.$count.'">
			      		<h4 class="panel-title">

				        		<div class="row">
								  	<div class="col-md-4"></div>
								  	<div class="center col-md-4">Add A New Task</div>
									<div class="col-md-4"></div>
								</div>

			      		</h4>
			    	</div>
				</div>
			</a';
			echo '</div>';
			?>
		</div>
	</div>
</div>
</body>

</html> 










