<?php
require 'dbConnect.php';
$sql = 'SELECT * FROM digitalDiary';
$statement = $conn->prepare($sql);
$statement->execute();
$digitalDiary = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
<?php require 'digitalJournal2.php'; ?>
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
          <th>Action</th>
        </tr>
        <?php foreach($digitalDiary as $diaryEntry): ?>
          <tr>
            <td><?= $diaryEntry->diaryID; ?></td>
            <td><?= $diaryEntry->diary_title; ?></td>
            <td><?= $diaryEntry->diary_date; ?></td>
			<td><?= $diaryEntry->diaryEntry; ?></td>
            <td>
              <a href="edit.php?id=<?= $digitalDiary->diaryID ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?id=<?= $person->diaryID ?>" class='btn btn-danger'>Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>