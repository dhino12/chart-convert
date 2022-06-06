<div class="modal fade" id="modalTable" tabindex="-1" aria-labelledby="modalTableLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTableLabel">Membuat Table</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titleTable" class="form-label">Judul Table <b style="color: red;">*</b></label>
                        <input type="text" class="form-control" id="titleTable" accept="xlsx" required>
                    </div>
                    <div class="mb-3">
                        <label for="columnTotal" class="form-label">Jumlah Kolom</label>
                        <input type="number" class="form-control" id="columnTotal" accept="xlsx">
                    </div>
                    <div class="mb-3">
                        <label for="rowsTotal" class="form-label">Jumlah Baris</label>
                        <input type="number" class="form-control" id="rowsTotal">
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" name="submit" class="btn btn-primary" id="submit" data-bs-dismiss="modal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>