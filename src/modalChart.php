<div class="modal fade" id="modalChart" tabindex="-1" aria-labelledby="modalChartLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalChartLabel">Import Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="import.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Table <b style="color: red">*</b> </label>
                        <input type="text" class="form-control" id="title" name="title_table" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Pilih Tipe Grafik <b style="color: red">*</b></label>
                        <select name="chart_type" id="" class="form-control">
                            <option value="line">line</option>
                            <option value="pie">pie</option>
                            <option value="bar">bar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="UploadFiles" class="form-label">Upload Files</label>
                        <input type="file" class="form-control" id="UploadFiles" name="excel_file" accept="xlsx">
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>