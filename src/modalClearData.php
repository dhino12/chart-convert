<div class="modal fade" id="modalClearData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="clear.php" method="POST" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bersihkan Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Yakin hapus semua data ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" name="clear">Bersihkan</button>
            </div>
        </form>
    </div>
  </div>
</div>