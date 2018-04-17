<?php
require 'mainHeader.html';

session_start();
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<html>
<body>
<form enctype="multipart/form-data" action="uploadImage.php" method="POST">
Image Title: <input type="text" name="img_title" /><br /><br />
Image Description: <input type="text" name="img_desc" /><br /><br />
Choose a file to upload: <input name="uploadedfile" type="file" /><br /><br />
<input name="submit" type="submit" value="submit" />
</form>
</body>
</html>
<div style="color: white !important;">
<?
error_reporting(E_ALL);
ini_set('display_errors',1);
include("dbConnect.php");

if (isset($_POST['submit'])) {
	$file = $_FILES['uploadedfile'];
	$img_title = $_POST["img_title"];
	$img_desc = $_POST["img_desc"];
	$img_name = $file["name"];
	

	if (($file["type"] == "image/gif" || $file["type"] == "image/jpeg" || $file["type"] == "image/pjpeg" ||$file["type"] == "image/png") && $file["size"] < 500000)	{
		if ($file["error"] > 0) {
			echo "Return Code:" . $file["error"] . "<br />";
		}
		else {
			$i = 1;
			$success = false; 
			$new_img_name = $img_name;
			
			while (!$success) {
				if (file_exists("uploads/" . $new_img_name)) {
					$i++;
					$new_img_name = "$i" . $img_name;
				}
				else {
					$success = true;
				}
			}

			move_uploaded_file($file["tmp_name"], "uploads/" . $new_img_name);
			echo "stored in: " . "uploads/" . $new_img_name;
			echo "<br/>";
			$userId = $_SESSION['currentUserID'];
			if ($conn->query("INSERT INTO User_Image(img_title,User_ID,img_desc,img_filename) VALUES('$img_title',$userId,'$img_desc','$new_img_name')")) {
				echo "1 row added";
			}
			else {
				die("An error" . $conn->errorInfo());
			}
		}
	}
	else {
		echo "Invalid file";
	}
}
?>

<?
return;
error_reporting(E_ALL);
ini_set('display_errors',1);
include("dbConnect.php");


if (isset($_POST["submit"])){
	$file = $_FILES['file'];
	
	$fileimg_name = $_FILES['file']['img_name'];
	$fileimg_title = $_FILES['file']['img_title'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];
	
	$fileExt = explode ('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array ('jpg', 'jpeg', 'png', 'pdf');
	
	if (in_Array($fileActualExt, $allowed)) {
		if ($fileError ===0){
			if ($fileSize < 1000000) {
			$fileNameNew = uniqid ('', true). ".".$fileActualExt;	
			
			$fileDestination = 'uploads/'.$fileNameNew;
			move_uploaded_file($fileTmpName, $fileDestination);
			header("Location: imageGallery?uploadsuccess");
			} else {
				echo "Your file was too big!";
			}
			
		} else {
			echo "There was an error uploading your file!";
		}
	} else {
	echo "You cannot upload files of this type";
	}
}
?>
</div>

<!-- Footer -->
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Find Us on Social Media</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/catherine.mccloskey.5203">
                  <i class="fa fa-fw fa-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-google-plus"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-linkedin"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fa fa-fw fa-dribbble"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Your Website 2018</small>
      </div>
    </div>