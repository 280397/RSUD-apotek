<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Penerimaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Penerimaan</a></div>
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
                                        <a href="<?= site_url('Penerimaan') ?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"> Kembali</i></a>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>No SPB</label>
                                    <input type="text" class="form-control" value="<?php echo $no_spb ?>" id="" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Ruang Asal</label>
                                    <input type="text" class="form-control" value="<?php echo $ruang->asal ?>" id="" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Ruang Tujuan</label>
                                    <input type="text" class="form-control" value="<?php echo $ruang_tujuan->tujuan ?>" id="" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control" value="<?php echo $date; ?>" id="" readonly>
                                </div>

                            </div>
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive">
                                <table class=" table table-striped mt-4" id="table-1">
                                    <thead>
                                        <input type="hidden" name="id" />
                                        <input type="hidden" name="no_spb" value="<?= $no_spb  ?>" />
                                        <input type="hidden" name="id_ruang" value="<?= $ruang->id_ruang ?>" />
                                        <input type="hidden" name="id_ruang_tujuan" value="<?= $ruang_tujuan->id  ?>" />
                                        <input type="hidden" name="date" value="<?= $date ?>" />
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th width="200px" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($penerimaan as $key) { ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $key->nama ?></td>
                                                <td><?= $key->jumlah ?></td>
                                                <td>
                                                    <?php
                                                    if ($key->status == 2) { ?>
                                                        <?= "Diterima" ?>
                                                    <?php
                                                    } ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($key->status == 1) { ?>
                                                        <form action="<?= site_url('Penerimaan/terima') ?>" method="post">
                                                            <input type="hidden" name="id_pengiriman" value="<?= $key->id_pengiriman ?>" />
                                                            <input type="hidden" name="kode_barang" value="<?= $key->kode_barang ?>" />
                                                            <input type="hidden" name="stok" value="<?= $key->jumlah ?>" />
                                                            <button onclick="return confirm('Apakah anda yakin?')" class="btn btn-primary btn-xs">
                                                                <i class="fas fa-share"> Terima</i>
                                                            </button>
                                                        </form>
                                                    <?php
                                                    } ?>
                                                </td>
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
    </section>
</div>
<!-- Modal tambah -->
<!-- <div class="modal fade" id="createpeng" tabindex="-1" role="dialog" aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Form Tambah Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('Pengiriman/insertCart') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang *</label>
                        <select name="nama_barang" id="nama_barang" class="form-control" required="required" autofocus="autofocus">
                            <option value="">--Pilih Nama Barang--</option>
                            <?php foreach ($obat as $key => $data) { ?>
                                <option value="<?= $data->id ?>"><?= $data->nama_obat ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah *</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" required autofocus />
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="id" />
                        <input type="hidden" name="no_spb" value="<?= $no_spb  ?>" />
                        <input type="hidden" name="id_ruang" value="<?= $ruang->id_ruang ?>" />
                        <input type="hidden" name="id_ruang_tujuan" value="<?= $ruang_tujuan->id  ?>" />
                        <input type="hidden" name="date" value="<?= $date ?>" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div> -->

<?php $this->load->view('dist/_partials/footer'); ?>