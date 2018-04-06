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