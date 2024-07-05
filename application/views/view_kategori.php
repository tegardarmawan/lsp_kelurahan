<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">LSP</a></li>
                    <li class="breadcrumb-item active">Kategori Surat</li>
                </ol>
            </div>
            <h4 class="page-title">Kelola Kategori Surat</h4><br>
            <p class="text-muted font-14">Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat <br>
                Klik "Tambah" untuk menambahkan kategori baru
            </p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="example" class="table table-hover table-bordered" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th width="10%">ID Kategori</th>
                    <th width="15%">Nama Kategori</th>
                    <th width="40%">Keterangan</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <hr>
        <!-- trigger button -->
        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
            data-animation="bounce" data-target=".bs-example-modal-lg" onclick="submit('tambah')">
            <i class="ion-plus-circled"></i> Tambah Kategori Baru
        </button>
    </div>
</div>

<!-- Modal untuk tambah/edit kategori -->
<div class="modal fade bs-example-modal-lg" id="insert" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel" name="title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p class="text-muted m-b-20 font-14">Tambahkan atau edit data kategori <br> Jika sudah selesai, jangan
                    lupa untuk mengklik tombol "Simpan"
                </p>
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-3 col-form-label">Nama Kategori</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="hidden" id="id" name="id">
                        <input class="form-control" type="text" id="nama" name="nama"
                            placeholder="Masukkan nama kategori">
                        <small class="text-danger pl-1" id="error-nama"></small>
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
            </div>
            <div class="modal-footer d-flex justify-content-start">
                <div class="col-lg-2">
                    <button type="button" id="btn-insert" onclick="insert_data()" class="btn btn-outline-primary btn-block">Simpan</button>
                    <button type="button" id="btn-update" onclick="edit_data()" class="btn btn-outline-primary btn-block">Simpan</button>
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

<script>
    var base_url = '<?php echo base_url() ?>';
    var _controller = '<?= $this->router->fetch_class() ?>';
</script>