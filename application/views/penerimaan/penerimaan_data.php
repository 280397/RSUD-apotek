<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Penerimaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Data Penerimaan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <h4>Data Penerimaan</h4>
                            <div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table class="table table-striped" id="penerimaan" style="overflow-x:auto;">
                                    <thead>
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Tanggal</th>
                                            <th>No SPB</th>
                                            <th>Ruang Asal</th>
                                            <th>Ruang Tujuan</th>
                                            <th>Jumlah Item</th>
                                            <th>Diterima</th>
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
<div class="modal fade" id="createpeng" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('Pengiriman/create_action') ?>" method="post">
                <div class="modal-body">


                    <div class="form-group">
                        <label for="no_spb">No SPB</label>
                        <input type="text" class="form-control" name="no_spb" id="no_spb" required autofocus />
                    </div>
                    <div class="form-group">
                        <label for="id_ruang">Ruang Asal</label>
                        <input type="hidden" name="id_ruang" id="id_ruang" value="<?= $ru->id_ruang ?>" />
                        <input type="text" class="form-control" value="<?= $ru->nama_ruang ?>" readonly />

                    </div>
                    <div class="form-group">
                        <label for="id_ruang_tujuan">Ruang Tujuan *</label>
                        <select name="id_ruang_tujuan" id="id_ruang_tujuan" class="form-control" required="required" autofocus="autofocus">
                            <option value="">--Pilih Ruang--</option>
                            <?php foreach ($ruang as $key => $data) { ?>
                                <option value="<?= $data->id ?>"><?= $data->nama_ruang ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal *</label>
                        <input type="date" class="form-control" name="date" id="date" value="<?= date('Y-m-d') ?>" required autofocus />
                    </div>

                    <input type="hidden" name="id" />
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?php echo site_url('Pengiriman') ?>" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>