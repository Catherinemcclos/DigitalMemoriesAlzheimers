<!doctype HTML>
<html>
	<head>
	  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Digital Memories Alzhiemers</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/overwrite.css">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" />
  <!-- =======================================================
    Theme Name: Bikin
    Theme URL: https://bootstrapmade.com/bikin-free-simple-landing-page-template/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
  ======================================================= -->
<br>
<br>
<br>
<br>
<br>
<body> 
<header id="header">
    <nav class="navbar navbar-fixed-top" role="banner">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
          </button>
          <a class="navbar-brand" href="index.html">Digital Memories Alzheimers</a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="navbar-nav">
          <ul class="navbar-nav">
		  <li class="nav-item">
		  <a class="nav-link" href="userprofilepage.php">Profile</a>
		  </li>
		   <li class="nav-item">
                <a class="nav-link" href="digitalphotos.php">Digital Album</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cathDigitalJournal.php">Digital Journal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="calendar.php">Calendar</a>
            </li>
        </ul>
    </div>
</nav>
		<link rel="stylesheet" href="calendar.css">
	</head>
	<body>
		<section class="calendar">
			<section class="modifyEvent">
			<h2><a href="editCalendar.php">Add Event</a></h2>
		</section>
			<?php
			if (!isset($_SESSION["currentUser"])) 
     header("Location: login.php");
			include("dbConnect.php");
				// variables to hadle  retreiving information about the month and the days within
				$day = date('j'); //recieving todays date </
				$daysInMonth = date('t');
				$dayOfWeek = date('N');
				$curentMonth = date('m');
				$currentYear = date('Y');
				// variables to handle looping of calendar table
				$displayedDays = 30;
				$dateCount = 1;
				echo '<table>';
				// loop repeats the creation of cels where one cell per day for the table header loops as many times as stated in displayedDays variable
				do{
					// switch to change the day of week value from being a number to an english representation
					switch ($dayOfWeek) {
						case 1:
							$textDayOfWeek = 'Monday';
							break;
						case 2:
							$textDayOfWeek = 'Tuesday';
							break;
						case 3:
							$textDayOfWeek = 'Wendnesday';
							break;
						case 4:
							$textDayOfWeek = 'Thursday';
							break;
						case 5:
							$textDayOfWeek = 'Friday';
							break;
						case 6:
							$textDayOfWeek = 'Saturday';
							break;
						case 7:
							$textDayOfWeek = 'Sunday';
							break;
						
						default:
							echo "something is wrong";
							break;
					}
					// creates the table header
					$weekdaycount = $weekdaycount + 1; 
					echo '<th>'. $textDayOfWeek .'</th>';
					$dayOfWeek = $dayOfWeek +1;
					$dateCount = $dateCount +1;
					// resets the count to the start of the week so week value repeats from monday
					if ($dayOfWeek > 7) {
						$dayOfWeek = 1;
					}
						if ($weekdaycount > 6) {
						break;
					}
				}while ( $dateCount <= $displayedDays);
				// reset dateCount variable to zero so it can be used for the day cell
				$dateCount = 1;
			
				// starts table row outside of loop so it does not get repeated
				echo '<tr>';
			
					do{
						$weekcount = $weekcount +1;
				
						// queries to get information for the constructed day
						$sql = 'SELECT title, description FROM calendar WHERE eventDay ='. $day;
						//echo $day;
						$result = $conn->query($sql);
						// checks for errors in sql query
						if (!$result){
							echo "error";
							print_r($result->errInfo());
						}
						// set variables that pick up information from server to be null
						$eventTitle = null;
						$eventDescription = null;
						// assaigns retreived information to variables if information is present
						echo '<td><h3>'. $day. '</h3><div class="events">';
						foreach ($result as $row) {
							echo '<h4>'. $row['title']. '</h4></br><p>'. $row['description'] .'</p></br>';
						}
						echo "</div></td>";
						//echo $weekcount;
						
						if ($weekcount  % 7 == 0)
						{
						echo '</tr>';
						}
						// Increment day to diplay new value in each cell
						$day = $day + 1;
						// handles end of month to reset to first of month by changing the current month and the day order
						if($day > $daysInMonth){
							$day = 1;
							$curentMonth = $curentMonth + 1;
							if($currentMonth > 12){
								$currentMonth = 1;
								$currentYear = $currentYear + 1;
							}
						}
						// Increments date count so it stops creating table rows after it reaches the number of desired days displayed
						$dateCount = $dateCount +1;
					}while($dateCount <= $displayedDays);
				// ends table row
				echo '</tr>';
				// ends calendar table
				echo '</table>';
				// disconect from database
				$conn = null;
				
			?>
	</section>
	</body>
</html>