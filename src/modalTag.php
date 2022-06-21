<?php 

$tagsAll = query("SELECT * FROM tag", true);
$tableNames = '';
$tagNames = '';
foreach ($tagsAll as $key => $value) {
  $tableValue = $value['table_name'];
  $tagValue = $value['tag_name'];

  $tableNames .= "$tableValue,";
  $tagNames .= "$tagValue,";
}

$tagNames = explode(',', $tagNames);

if (isset($_POST['submit'])) {
    $tableName = $_POST['table-name'];
    $tag = str_replace(' ', '', $_POST['tag-name']);
    $query = "SELECT table_name FROM tag WHERE table_name = '$tableName'";
    $result = query($query, true);
    $countQuery = mysqli_affected_rows($conn);

    if ($countQuery > 0) {
      $query = "UPDATE tag SET table_name='$tableName', tag_name='$tag' WHERE table_name = '$tableName'";
      query($query, '');
    } else {
      $query = "INSERT INTO tag VALUES ('$tag', '$tableName');";
      $result = query($query, '');
    }

    if ($result >= 0) {
        echo "<script>alert('tag berhasil ditambahkan')</script>";
        header("Refresh:0");
    } else {
        echo "<script>alert('tag gagal ditambahkan')</script>";
    }
}

?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tag</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Table Name:</label>
                <select class="form-select" name="table-name" onchange="inputTag(event)">
                    <option>Pilih nama table</option>
                    <?php foreach($tables as $table) : ?>
                        <option value="<?= $table ?>"><?= $table?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3" id='tag-wrapper'>
                <label for="message-text" class="col-form-label">Tag tersedia:</label> <br>
                <?php foreach($tagNames as $index => $value) : ?>
                  <?php if($value == '') continue; ?>
                  <span id="tag" class="badge bg-primary"><i class="bi bi-tag"></i> <?= $value ?></span>
                <?php endforeach ?>
                
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Tag:</label>
                <input id="input-tag" type="text" class="form-control" name="tag-name">
                <div id="emailHelp" class="form-text">Untuk multiple tag, gunakan koma( , )</div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
    <?php foreach ($tagsAll as $key => $tag) : ?>
      <p id="<?= str_replace(' ', '', $tag['table_name']) ?>" hidden><?= $tag['tag_name'] ?></p>
    <?php endforeach ?>

  </div>
</div>