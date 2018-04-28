<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
 * Check if we need to add user to shared users
 */
if(isset($_POST['share_user_id'])){
	if(isset($_POST['action']) && $_POST['action']=='share_with'){
        $sqlAddShare = "INSERT INTO user_gallery_shares(user_id, shared_user_id) VALUES(".$_SESSION["currentUserID"].", ".intval($_POST['share_user_id']).")";
        //echo $sqlAddShare;

        $conn->query($sqlAddShare);
	}
} else if(isset($_GET['share_user_id'])){
    if(isset($_GET['action']) && $_GET['action']=='remove_share'){
        $sqlRemoveShare = "DELETE FROM user_gallery_shares where user_id =".$_SESSION["currentUserID"]." and  shared_user_id=".intval($_GET['share_user_id']);

        $conn->query($sqlRemoveShare);
    }
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
    $sql = "SELECT count(*) FROM Users WHERE User_ID =".intval($userId);
    $resultCount = $conn->query($sql)->fetchColumn();

    if ($resultCount ==0) {
        /**
         * Redirect user to login
         *
         * You can set exit message here if you want or redirect to some other place.
         */
        header("Location: signIn.php");
        exit();
    }

    /**
     * Check if user is allowed to access gallery
     */
    $sqlShareDWith = "SELECT count(*) FROM user_gallery_shares WHERE user_gallery_shares.shared_user_id =".$_SESSION["currentUserID"]." and user_id=".intval($userId);
//    echo $sqlShareDWith;exit();


    $resultSharedWithCount = $conn->query($sqlShareDWith)->fetchColumn();

    if($resultSharedWithCount==0){
        /**
         * You can set exit message here if you want or redirect to some other place.
         */
        echo "Not allowed";
        exit();
    }
} else {
    $userId = $_SESSION['currentUserID'];
}

require 'mainHeader.html';
?>
<style>
        body {
            font-family: Verdana, sans-serif;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        .row > .column {
            padding: 0 8px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
            width: 25%;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.75);
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            width: 90%;
            max-width: 1200px;
        }

        /* The Close Button */
        .close {
            color: white;
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 35px;
            font-weight: bold;
        }

            .close:hover,
            .close:focus {
                color: #999;
                text-decoration: none;
                cursor: pointer;
            }

        .mySlides {
            display: none;
        }

        .cursor {
            cursor: pointer
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

            /* On hover, add a black background color with a little bit see-through */
            .prev:hover,
            .next:hover {
                background-color: rgba(0, 0, 0, 0.8);
            }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        img {
            margin-bottom: -4px;
        }

        .caption-container {
            text-align: center;
            background-color: black;
            padding: 2px 16px;
            color: white;
        }

        .demo {
            opacity: 0.6;
        }

            .active,
            .demo:hover {
                opacity: 1;
            }

        img.hover-shadow {
            transition: 0.3s
        }

        .hover-shadow:hover {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
        }
    </style>

<?php
    echo "<center><h1>Image Gallery</h1></center>";
    echo "<div class=\"image-gallery-page-container\">";
    $userId = $_SESSION['currentUserID'];
    $sql="SELECT * FROM User_Image WHERE USER_ID = 10";
    $result = $conn->query($sql);
    $i = 1;

    foreach($result as $row){
        $data[]= $row;
    }
    echo "<div class=\"image-gallery-container\">";
    echo "<div class=\"row\">";

    $i = 1;
    foreach($data as $row)
    {
        $img_Title=$row["img_title"];
        $img_filename=$row["img_filename"];
	
        echo "    <div class=\"column\">";
        echo "        <img src=\"./uploads/". $img_filename . "\" style=\"width:100%\" onclick=\"openModal();currentSlide(". $i .")\" class=\"hover-shadow cursor\" alt=\"". $img_Title ."\" />";
        echo "    </div>";
        $i++;
    }
    $total = $i;
    echo "</div>";

    echo "  <div id=\"myModal\" class=\"modal\">";
    echo "        <span class=\"close cursor\" onclick=\"closeModal()\">&times;</span>";
    echo "        <div class=\"modal-content\">";

    $i = 1;
    foreach($data as $row)
    {
        $img_Title=$row["img_title"];
        $img_desc=$row["img_desc"];
        $img_filename=$row["img_filename"];

        echo "            <div class=\"mySlides\">";
        echo "                <div class=\"numbertext\">".$i." / ".$total."</div>";
        echo "                <img src=\"./uploads/".$img_filename."\" style=\"width:100%\" />";
        echo "<div style='text-align: right;'>";
        echo "<a style='display: inline-block; padding: 10px;' href=\"deleteGalleryImage.php?id=". $row["imageID"] . "\">Remove</a>";
        echo "</div>";
        echo "        </div>";
        $i++;
    }
    echo "            <a class=\"prev\" onclick=\"plusSlides(-1)\">&#10094;</a>";
    echo "            <a class=\"next\" onclick=\"plusSlides(1)\">&#10095;</a>";

    echo "            <div class=\"caption-container\">";
    echo "                <p id=\"caption\"></p>";
    echo "            </div>";

    $i = 1;
    foreach($data as $row)
    {
        $img_Title=$row["img_title"];
        $img_filename=$row["img_filename"];

        echo "            <div class=\"column\">";
        echo "                <img class=\"demo cursor\" src=\"./uploads/".$img_filename."\" style=\"width:100%\" onclick=\"currentSlide(".$i.")\" alt=\"".$img_Title."\"  />";
        echo "            </div>";
        $i++;
    }
    echo "        </div>";
    echo "    </div>";
    echo "  </div>";

    ?>

    <script>
        function openModal() {
            document.getElementById('myModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>

<div style="clear: both;display: block"></div>

<style>
    .image-gallery-page-container {
        display: flex;
        margin: 50px 50px 0 50px ;
    }

    .image-gallery-container {
        max-width: 70%;
    }

    .shared-imgs-container {
        width: 30%;
    }

    .table-field {
        padding: 5px 10px;
    }
</style>
<div class="shared-imgs-container">
<!-- <h1 style="text-align: center">Image Gallery</h1> -->
<?php if ($userId == $_SESSION['currentUserID']): ?>
	<div style="clear: both;position: relative;float: left;width: 100%;">
		<h2>Gallery shared with</h2>
	    <?php
	    /**
	     * Get all users that are allowed to use this gallery
	     */
	    $sqlShares = "SELECT * FROM user_gallery_shares inner join Users on Users.User_ID=user_gallery_shares.shared_user_id WHERE user_gallery_shares.user_id =".intval($userId);
	    $resultShares = $conn->query($sqlShares);
	    ?>
		<table>
			<thead>
				<th>Name</th>
				<th>Action</th>
			</thead>
			<tbody>
            <?php foreach ($resultShares as $rowShare) : ?>
				<tr>
					<td style="text-align: center"><?php echo $rowShare["Name"]; ?></td>
					<td class="table-field" style="text-align: center">
						<a href="?action=remove_share&share_user_id=<?php echo $rowShare["shared_user_id"]; ?>" target="_blank">
							Remove share
						</a>
					</td>
				</tr>
            <?php endforeach; ?>
			</tbody>
		</table>
		<h3>Share gallery with user:</h3>
        <?php
        /**
         * Get all users to share with
         */
        $sqlShareUser = "SELECT * FROM Users where User_ID not in(select shared_user_id  from user_gallery_shares where user_id=".intval($userId).")";
        $resultSharesUser = $conn->query($sqlShareUser);
        ?>
		<form action="imageGallery.php" method="post">
			<label>Name</label>
			<select name="share_user_id">
                <?php foreach ($resultSharesUser as $rowShareUser) : ?>
					<option value="<?php echo $rowShareUser["User_ID"]; ?>"><?php echo $rowShareUser["Name"]; ?></option>
                <?php endforeach; ?>
			</select>
			<input type="hidden" name="action" value="share_with" />
			<button type="submit">Add user</button>
		</form>
	</div>
<?php endif; ?>

<?php if ($userId == $_SESSION['currentUserID']): ?>
	<div style="clear: both;position: relative;float: left;width: 100%;margin-top: 5px;">
		<h2>Galleries shared with me</h2>
        <?php
        /**
         * Get all users that are allowed to use this gallery
         */
        $sqlShares = "SELECT * FROM user_gallery_shares inner join Users on Users.User_ID=user_gallery_shares.shared_user_id WHERE user_gallery_shares.shared_user_id =".intval($userId);
        $resultShares = $conn->query($sqlShares);
        ?>
		<table border="2" cellpadding="2">
			<thead>
			<th style="padding: 5px;">Name</th>
			<th style="padding: 5px;">Link</th>
			</thead>
			<tbody>
            <?php foreach ($resultShares as $rowShare) : ?>
				<tr>
					<td style="text-align: center; padding: 5px;"><?php echo $rowShare["Name"]; ?></td>
					<td style="text-align: center; padding: 5px;">
						<a href="imageGallery.php?user_id=<?php echo $rowShare["user_id"]; ?>" target="_blank">
							View gallery
						</a>
					</td>
				</tr>
            <?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php endif; ?>

<!-- <div style="clear: both;position: relative;float: left;width: 100%;margin-top: 45px;">
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
        <th>Actions</th>
		</thead>
		<tbody>
        <?php foreach ($result as $row) : ?>
        <?php echo $row["img_filename"]; ?>
			<tr>
				<td style="text-align: center"><?php echo $row["img_title"]; ?></td>
				<td style="text-align: center"><?php echo $row["img_desc"]; ?></td>
				<td style="text-align: center">
					<a href="uploads/<?php echo $row["img_filename"]; ?>" target="_blank">
						<img src="uploads/<?php echo $row["img_filename"]; ?>" style="width: 100px;height: 100px"/>
					</a>
                </td>
                <td style="text-align: center; padding: 0 10px;">
                    <a href="deleteGalleryImage.php?id=<?php echo $row["imageID"]; ?>">Remove</a>
                </td>
			</tr>
        <?php endforeach; ?>
		</tbody>
	</table>
</div> -->
    </div>
</div>
</body>
</html>