<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pembelian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pembelian</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pembelian</h4>
                            <!-- <div>
                                <?php echo anchor(site_url('Obat/create'), 'Create', 'class="btn btn-primary"'); ?>
                            </div> -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createObat">
                                Tambah
                            </button>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="obat_transaksi" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Distributor</th>
                                            <th>No Faktur</th>
                                            <th>Jumlah Item</th>
                                            <th>Tanggal</th>
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
<div class="modal fade" id="createObat" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('Obat_transaksi/create_action') ?>" method="post">
                <div class="modal-body">

                    <!-- <div class="form-group">
                        <label for="id_distributor">Id Distributor *</label>
                        <input type="text" class="form-control" name="id_distributor" id="id_distributor" />
                    </div> -->
                    <div class="form-group">
                        <label for="id_distributor">Distributor *</label>
                        <select name="id_distributor" id="id_distributor" class="form-control" required="required" autofocus="autofocus">
                            <option value="">--Pilih Dsitributor--</option>
                            <?php foreach ($distributor as $key => $data) { ?>
                                <option value="<?= $data->id ?>"><?= $data->nama_perusahaan ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_faktur">No Faktur</label>
                        <input type="text" class="form-control" name="no_faktur" id="no_faktur" required autofocus />
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal *</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" required autofocus />
                    </div>

                    <input type="hidden" name="id" />
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?php echo site_url('Obat_transaksi') ?>" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>