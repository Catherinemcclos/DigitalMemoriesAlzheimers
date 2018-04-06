<?php
require 'dbConnect.php';
$sql = 'SELECT * FROM digitalDiary';
$statement = $conn->prepare($sql);
$statement->execute();
$digitalDiary = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
<?php require 'digitaljournalheader.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>All Diary Enteries</h2>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>Diary ID</th>
          <th>Diary Title</th>
          <th>Date</th>
          <th>Content</th>
		  <th>Action</th>
        </tr>
        <?php foreach($digitalDiary as $diary_Entry): ?>
          <tr>
            <td><?= $diary_Entry->diaryID; ?></td>
            <td><?= $diary_Entry->diary_title; ?></td>
            <td><?= $diary_Entry->diary_date; ?></td>
			<td><?= $diary_Entry->diaryEntry; ?></td>
            <td>
              <a href="editdigitaljournalentry.php?id=<? $digital_Entry->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="deletediaryentry.php?id=<?= $digital_Entry->id ?>" class='btn btn-danger'>Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>



