<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">LSP</a></li>
                    <li class="breadcrumb-item active">Arsip</li>
                </ol>
            </div>
            <h4 class="page-title">Arsip Surat</h4><br>
            <p class="text-muted font-14">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan <br>
                Klik "Lihat" pada kolom aksi untuk menampilkan surat
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th width="15%">Nomor Surat</th>
                    <th width="15%">Kategori</th>
                    <th width="30%">Judul</th>
                    <th width="15%">Waktu Pengarsipan</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <hr>
        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
            data-animation="bounce" data-target=".bs-example-modal-lg" onclick="delete_form(); delete_error();">
            <i class="ion-plus-circled"></i> Arsipkan Surat
        </button>
    </div>
</div>

<!-- Modal untuk arsipkan surat -->
<div class="modal fade bs-example-modal-lg" id="insert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Arsip Surat >> Unggah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p class="text-muted m-b-20 font-14">Unggah surat yang telah terbit pada form ini untuk diarsipkan<br>
                    Catatan : Gunakan file berformat PDF
                </p>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nomor Surat</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="nomor" name="nomor"
                            placeholder="Masukkan nomor surat">
                        <small class="text-danger pl-1" id="error-nomor"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Kategori</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control mb-3 custom-select" id="kategori" name="kategori">
                            <option value="">Pilih kategori</option>
                            <?php foreach ($select as $row): ?>
                                <option value="<?php echo $row->id; ?>">
                                    <?php echo $row->nama; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-danger pl-1" id="error-kategori"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="5" id="keterangan" name="keterangan"
                            placeholder="Masukkan keterangan"></textarea>
                        <small class="text-danger pl-1" id="error-keterangan"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">File surat (PDF)</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="file"
                                onchange="previewFilename('file')">
                            <label class="custom-file-label" for="file">Pilih file</label>
                        </div>
                        <small class="text-danger pl-1" id="error-file"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-2">
                    <button type="button" id="btn-success" onclick="insert_data()"
                        class="btn btn-outline-primary btn-block">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk hapus data -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title center" id="exampleModalLabel"><i class="mdi mdi-alert"></i> Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Apakah anda yakin ingin menghapus data ini?</h5>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-6">
                    <button type="button" id="btn-hapus" ata-dismiss="modal"
                        class="btn btn-outline-primary btn-block">Ya!</button>
                </div>
                <div class="col-lg-6">
                    <button type="button" id="btn-cancel" data-dismiss="modal"
                        class="btn btn-outline-danger btn-block">Tidak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk lihat surat -->
<div class="modal fade bs-example-modal-lg" id="lihat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Arsip Surat >> Lihat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nomor Surat</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="hidden" id="id" name="id" readonly>
                        <input class="form-control" type="text" id="nomor" name="nomor" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Kategori</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="kategori" name="kategori" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                        <textarea required class="form-control" rows="5" id="keterangan" name="keterangan"
                            readonly></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Waktu Unggah</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" id="waktu" name="waktu" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">File surat (PDF)</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file2" id="file2"
                                onchange="previewFilename('file2')">
                            <label class="custom-file-label" for="file2">Pilih file</label>
                        </div>
                        <small class="text-danger pl-1" id="error-file2"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <embed src="" type="application/pdf" width="100%" height="600" />
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-3">
                    <button type="button" id="btn-download" onclick="downloadFile($('#btn-download').data('file-name'))"
                        class="btn btn-outline-success btn-block">Unduh</button>
                </div>
                <div class="col-lg-3">
                    <button type="button" id="btn-update" onclick="update_data()"
                        class="btn btn-outline-primary btn-block">Update file</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>