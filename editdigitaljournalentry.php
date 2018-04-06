<?php
require 'dbConnect.php';
$diaryID = $_GET['diaryID'];
$sql = 'SELECT * FROM digitalDiary WHERE diaryID=:diaryID';
$statement = $conn->prepare($sql);
$statement->execute([':diaryID' => $diaryID ]);
$dairyEntry = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['diary_title'])  && isset($_POST['diaryEntry']) ) {
  $digital_title = $_POST['diary_title'];
  $diaryEntry = $_POST['diaryEntry'];
  $sql = 'UPDATE digitalDiary SET digital_title=:digital_title, diaryEntry=:diaryEntry WHERE diaryID=:diaryID';
  $statement = $conn->prepare($sql);
  if ($statement->execute([':digital_title' => digital_title, ':diaryEntry' => $diaryEntry, ':diaryID' => diaryID])) {
    header("Location:digitaljournalindex.php");
  }
}
 ?>
<?php require 'digitaljournalheader.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update Diary</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="digital_title">Diary Title</label>
          <input value="<?= $diaryEntry->digital_title; ?>" type="text" name="digital_title" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="diaryEntry">Diary Entry</label>
          <input type="diaryEntry" value="<?= $diaryEntry->diaryEntry; ?>" name="diaryEntry" id="diaryEntry" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update Entry</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>

