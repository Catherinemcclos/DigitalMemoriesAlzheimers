<?php
include("dbConnect.php");
session_start();

/**
 * Restrict access to gallery only to logged in users
 */
if (!isset($_SESSION["currentUser"])) {
    header("Location: signIn.php");
    exit();
}

/**
 * Check which gallery we need to view, owner or shared one
 *
 * to share gallery with other user just set link to be like this imageGallery.php?user_id=OTHER_USER_ID [example imageGallery.php?user_id=7]
 */
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    /**
     * Check if user exists
     */
    $sql = "SELECT * FROM Users WHERE User_ID =".intval($userId);
    $result = $conn->query($sql);

    if (count($result) == 0) {
        /**
         * Redirect user to login
         *
         * You can set exit message here if you want or redirect to some other place.
         */
        header("Location: signIn.php");
        exit();
    }
} else {
    $userId = $_SESSION['currentUserID'];
}
?>
<!doctype html>
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
	<link href="css/style.css" rel="stylesheet"/>
</head>
<!-- =======================================================
  Theme Name: Bikin
  Theme URL: https://bootstrapmade.com/bikin-free-simple-landing-page-template/
  Author: BootstrapMade
  Author URL: https://bootstrapmade.com
======================================================= -->
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
                    <?php if ($userId == $_SESSION['currentUserID']): ?>
						<li class="nav-item">
							<a class="nav-link" href="imageGallery.php?user_id=<?php echo $userId; ?>">Link to share my
							                                                                           album</a>
						</li>
                    <?php endif; ?>
					<li class="nav-item">
						<a class="nav-link" href="cathDigitalJournal.php">Digital Journal</a>
					</li>
					<li class="nav-item">
						<a class="nav-link disabled" href="calendar.php">Calendar</a>
					</li>

				</ul>
			</div>
	</nav>
</header>
<h1 style="text-align: center">Image Gallery</h1>
<?php
/**
 * Get all images from gallery
 */
$sql = "SELECT * FROM User_Image WHERE User_ID =".intval($userId);
$result = $conn->query($sql);
?>
<table border="2" align="center">
	<thead>
	<th>Image Title</th>
	<th>Image Description</th>
	<th>Image</th>
	</thead>
	<tbody>
    <?php foreach ($result as $row) : ?>
		<td style="text-align: center"><?php echo $row["img_title"]; ?></td>
		<td style="text-align: center"><?php echo $row["img_desc"]; ?></td>
		<td style="text-align: center">
			<a href="/uploads/<?php echo $row["img_filename"]; ?>" target="_blank">
				<img src="/uploads/<?php echo $row["img_filename"]; ?>" style="width: 100px;height: 100px"/>
			</a>
		</td>
    <?php endforeach; ?>
	</tbody>
</table>
</body>