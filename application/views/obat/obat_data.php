<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Obat Data</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Obat Data</a></div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Obat Data</h4>
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
                                <table class="table table-striped" id="obat" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Kode</th>
                                            <th>Kode Siva</th>
                                            <th>Nama Barang</th>
                                            <th>Generik</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Insert At</th>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('Obat/create_action') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode">Kode *</label>
                        <input type="text" class="form-control" name="kode" id="kode" placeholder="" required autofocus />
                    </div>
                    <div class="form-group">
                        <label for="kode_siva">Kode Siva *</label>
                        <input type="text" class="form-control" name="kode_siva" id="kode_siva" placeholder="" autofocus />
                    </div>
                    <div class="form-group">
                        <label for="nama_obat">Nama Barang *</label>
                        <input type="text" class="form-control" name="nama_obat" id="nama_obat" placeholder="" required autofocus />
                    </div>
                    <div class="form-group">
                        <label class="d-block">Generik *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="generik" name="generik" value="Ya">
                            <label class="form-check-label" for="generik">
                                Ya
                            </label>
                        </div>

                    </div>
                    <div class=" form-group">
                        <label for="satuan">Satuan *</label>
                        <select name="satuan" id="satuan" class="form-control" required="required" autofocus="autofocus">
                            <option value="">--Pilih Satuan--</option>
                            <?php foreach ($satuan as $key => $data) { ?>
                                <option value="<?= $data->id ?>"><?= $data->satuan ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga *</label>
                        <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" required autofocus />
                    </div>

                    <input type="hidden" name="id" />
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?php echo site_url('Obat') ?>" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>