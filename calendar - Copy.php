
<?php
//set your timezone 
date_default_timezone_set('Asis/Tokyo');

//get prev & next month 
if (isset($_GET['ym'])) {
$ym = $_GET['ym'];
} else {

//this month 
$ym = date ('Y-m');

}

//check format 
$timestamp = strtotime($ym, "-01");
if ($timestap === false){
$timestamp = time();
}

//Today 
$today =date('Y-m-d', time());

//for H3 title 
$html_title = date ('Y / m', $timestamp);

// Create prev & next month link 
$prev = date ('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date ('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

//Number of days in the month 
$day_count = date('t', $timestamp);

//0:Sun 1:Mon 2:Tue
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

//Create Calendar!!
$weeks =array();
$week = '';

//Add empty cell 
$week = str_repeat('<td></td>', $str);

for ($day = l; $day <=day_count; $day++, $str++){
$date = $ym. '-'.$day;

if ($today == $date) {
$week .='<td class="today">'.$day;

} else {
$week .= '<td>'.$day;
}
$week .= '<td>';

//End of the week or end of the month
if ($str % 7 == 6 || $day == $day_count) {

if($day == $day_count){
//Add empty cell 
$week .=str_repeat('<td></td>',6 - ($str % 7));

}

$weeks[] = '<tr>'.$week.'</tr>';

//Prepae for new week 

$week = '';
} 
}
?>

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
<!DOCTYPE html> 
<html lang="ja">
<head>
<meta charset="utf-8">
<title> Digital Memories Alzheimer's </title> 
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootsrapcdn.com/bootstrap/3.3.6/css/bootstrap.mon.css"
integrity="sha384-qmTJQASxBj1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgWPGmkzs7" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Noto:Sans:400,700' rel='stylesheet' type='text/css'>

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
<style>
.container {
font-family: 'Noto Sans', sans-serif;
margin-top:80px;

}
th {
height: 30px;
text-align: center;
font-weight:700;
}
height:100px;
}
.today{
backgrounf: orange;
}
th:nth-of-type(7),td:nth-of-type(7){
color:blue;
}
th:nth-of-type(1),td:nth-of-type(1){
color: red;
}
</style> 

</head> 
<body> 
<div class="container">
<h3<a href ="?ym=<?php echo $prev; ?>">&lt;</a><?php echo $html_title; ?><a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
<br>
<table class="table table-borderded">
<tr>
<th>S</th>
<th>M</th>
<th>T</th>
<th>W</th>
<th>T</th>
<th>F</th>
<th>S</th>
</tr>
<?php 

foreach ($weeks as $week){
echo $week;
}

?>

</table>
</div>
</body>
</html>