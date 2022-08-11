<div class="modal fade" id="modalExport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content"> 
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Export Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Export semua data sebagai ? <br>
            <div id="emailHelp" class="form-text">Note : Data yang diexport kedalam excel hanya berupa data tabel</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="exportPDF.php">
                <button type="submit" class="btn btn-danger" name="clear">Export PDF</button>
            </a>
            <a href="exportExcel.php">
                <button type="submit" class="btn btn-success" name="clear">Export Excel</button>
            </a>
        </div> 
    </div>
  </div>
</div>