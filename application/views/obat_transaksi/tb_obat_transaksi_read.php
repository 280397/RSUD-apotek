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

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <a href="<?= site_url('Obat_transaksi') ?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"> Kembali</i></a>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>No Faktur</label>
                                    <input type="text" class="form-control" value="<?php echo $no_faktur ?>" id="" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Distributor</label>
                                    <input type="text" class="form-control" value="<?php echo $distributor->nama_perusahaan ?>" id="" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control" value="<?php echo $tanggal; ?>" id="" readonly>
                                </div>

                            </div>
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-2" style="overflow-x:auto;">
                                        <thead>
                                            <tr>
                                                <th width="80px">No</th>
                                                <th>Nama Barang</th>
                                                <th>Kode Barang</th>
                                                <th>Exp Date</th>
                                                <th>Jumlah</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($nama as $key) { ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $key->nama_barang ?></td>
                                                    <td><?= $key->kode_barang ?></td>
                                                    <td><?= $key->exp ?></td>
                                                    <td><?= $key->jumlah ?></td>
                                                    <td><?= $key->harga ?></td>

                                                </tr>
                                            <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>