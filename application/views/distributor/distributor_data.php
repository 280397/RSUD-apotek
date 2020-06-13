<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Distributor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Data Distributor</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Distributor</h4>
                            <div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createSupplier">
                                    Tambah
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="dist" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Nama Distributor</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Alamat</th>
                                            <th>Telp</th>
                                            <th>Kota</th>
                                            <th>Kode Pos</th>
                                            <th width="200px">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="createSupplier" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah distributor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo site_url('Distributor/create_action') ?>" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama_distributor">Nama Distributor *</label>
                        <input type="text" class="form-control" name="nama_distributor" id="nama_distributor" required autofocus />
                    </div>
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan *</label>
                        <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" required autofocus />
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" rows="3" name="alamat" id="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="telp">Telpon *</label>
                        <input type="text" class="form-control" name="telp" id="telp" required autofocus />
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota *</label>
                        <input type="text" class="form-control" name="kota" id="kota" required autofocus />
                    </div>
                    <div class="form-group">
                        <label for="kode_pos">Kode Pos *</label>
                        <input type="text" class="form-control" name="kode_pos" id="kode_pos" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>