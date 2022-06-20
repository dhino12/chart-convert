<?php 

if (isset($_POST['submit'])) {
    $tableName = $_POST['table-name'];
    $tag = $_POST['tag-name'];
    $result = query("INSERT INTO tag VALUES ($tag, $tableName)", '');

    if ($result >= 0) {
        echo "<script>alert('tag berhasil ditambahkan')</script>";
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
                <select class="form-select" name="table-name" aria-label="Default select example">
                    <option selected>Pilih nama table</option>
                    <?php foreach($tables as $table) : ?>
                        <option value=<?= $table ?>><?= $table?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Tag:</label>
                <input type="text" class="form-control" name="tag-name">
                <div id="emailHelp" class="form-text">Untuk multiple tag, gunakan koma( , )</div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>