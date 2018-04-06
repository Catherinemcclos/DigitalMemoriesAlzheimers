<?php
include 'dbConnect.php';
$diaryID = $_GET['diaryID'];
$sql = 'DELETE FROM digitalDiary WHERE diaryID=:diaryID';
$statement = $conn->prepare($sql);
if ($statement->execute([':diaryID' => $diaryID])) {
  header("Location:digitaljournalindex.php");
  var_dump($diaryID);
}