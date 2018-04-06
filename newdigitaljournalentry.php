<?php
include("dbConnect.php");
$message = '';
if (isset ($_POST['diary_title'])  && isset($_POST['diaryEntry']) ) {

  $diary_title = $_POST['diary_title'];
  $diaryEntry = $_POST['diaryEntry'];
  $sql = 'INSERT INTO digitalDiary(diary_title, diaryEntry) VALUES(:diary_title, :diaryEntry)';
  $statement = $conn->prepare($sql);
  if ($statement->execute([':diary_title' => $diary_title, ':diaryEntry' => $diaryEntry])) {
  $message = 'data inserted successfully';
 }
}
?>
<?php require 'digitaljournalheader.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a new Entry</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
        <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="diary_title">Diary Title</label>
          <input type="text" name="diary_title" id="diary_title" class="form-control">
        </div>
        <div class="form-group">
          <label for="diaryEntry">Diary Entry</label>
          <input type="text" name="diaryEntry" id="diaryEntry" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a new Entry</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>

