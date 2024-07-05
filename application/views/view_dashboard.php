<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">LSP</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>
<section>
    <h4>Selamat datang di website proyek LSP POLINEMA</h4>
    <hr>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-email"></i>
                            </div>
                        </div>
                        <div class="col-9 align-self-center text-center">
                            <div class="m-l-10">
                                <h5 class="mt-0 round-inner">
                                    <?= $surat; ?>
                                </h5>
                                <p class="mb-0 text-muted">Jumlah Arsip</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="col-3 align-self-center">
                            <div class="round">
                                <i class="mdi mdi-view-list"></i>
                            </div>
                        </div>
                        <div class="col-9 text-center align-self-center">
                            <div class="m-l-10 ">
                                <h5 class="mt-0 round-inner">
                                    <?= $kategori; ?>
                                </h5>
                                <p class="mb-0 text-muted">Jumlah Kategori</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>