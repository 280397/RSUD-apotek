<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengiriman</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pengiriman</a></div>
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
                                        <a href="<?= site_url('Pengiriman') ?>" class="btn btn-warning btn-flat"><i class="fa fa-undo"> Kembali</i></a>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>No SPB</label>
                                    <input type="text" class="form-control" value="<?php echo $no_spb ?>" id="" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Ruang Asal</label>
                                    <input type="text" class="form-control" value="<?php echo $ruang->nama_ruang ?>" id="" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Ruang Tujuan</label>
                                    <input type="text" class="form-control" value="<?php echo $ruang_tujuan->nama_ruang ?>" id="" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control" value="<?php echo $date; ?>" id="" readonly>
                                </div>

                            </div>
                            <?= $this->session->flashdata('message'); ?>
                            <div class="table-responsive"><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">Tambah</button>

                                <div class="float-right">

                                    <form action="<?= site_url('Pengiriman/simpan') ?>" method="post">

                                        <input type="hidden" name="no_spb" value="<?= $no_spb  ?>" />
                                        <input type="hidden" name="id_ruang" value="<?= $ruang->id_ruang ?>" />
                                        <input type="hidden" name="id_ruang_tujuan" value="<?= $ruang_tujuan->id  ?>" />
                                        <input type="hidden" name="date" value="<?= $date ?>" />
                                        <input type="hidden" name="rowid" value="<?= $key['rowid'] ?>" />
                                        <?php
                                        if ($this->cart->contents()) { ?>
                                            <button class="btn btn-success btn-xs">
                                                <i class="fas fa-save"> Simpan</i>
                                            </button>
                                        <?php
                                        } ?>
                                    </form>
                                </div>

                                <table class=" table table-striped mt-4" id="table">
                                    <thead>
                                        <input type="hidden" name="id" />
                                        <input type="hidden" name="no_spb" value="<?= $no_spb  ?>" />
                                        <input type="hidden" name="id_ruang" value="<?= $ruang->id_ruang ?>" />
                                        <input type="hidden" name="id_ruang_tujuan" value="<?= $ruang_tujuan->id  ?>" />
                                        <input type="hidden" name="date" value="<?= $date ?>" />
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th width="200px" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($this->cart->contents() as $key) { ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $key['name'] ?></td>
                                                <td><?= $key['price'] ?></td>
                                                <td><?= $key['qty'] ?></td>
                                                <td class="text-center">

                                                    <form action="<?= site_url('Pengiriman/delete_cart') ?>" method="post">
                                                        <input type="hidden" name="id" />
                                                        <input type="hidden" name="no_spb" value="<?= $no_spb  ?>" />
                                                        <input type="hidden" name="id_ruang" value="<?= $ruang->id_ruang ?>" />
                                                        <input type="hidden" name="id_ruang_tujuan" value="<?= $ruang_tujuan->id  ?>" />
                                                        <input type="hidden" name="date" value="<?= $date ?>" />
                                                        <input type="hidden" name="rowid" value="<?= $key['rowid'] ?>" />
                                                        <button onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs">
                                                            <i class="fas fa-trash"> Hapus</i>
                                                        </button>
                                                    </form>
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
<!-- Modal -->

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <table class=" table table-striped mt-4" id="table-1">
                                    <thead>
                                        <input type="hidden" name="id" />
                                        <input type="hidden" name="no_spb" value="<?= $no_spb  ?>" />
                                        <input type="hidden" name="id_ruang" value="<?= $ruang->id_ruang ?>" />
                                        <input type="hidden" name="id_ruang_tujuan" value="<?= $ruang_tujuan->id  ?>" />
                                        <input type="hidden" name="date" value="<?= $date ?>" />
                                        <tr>
                                            <th>id</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Dikirim</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($obat as $key => $data) { ?>
                                            <tr>
                                                <td><?= $data->id ?></td>
                                                <td><?= $data->kode_barang ?></td>
                                                <td><?= $data->nama ?></td>
                                                <td><?= $data->harga ?></td>
                                                <td><?= $data->stok ?></td>
                                                <td>
                                                    <form action="<?= site_url('Pengiriman/insertCart') ?>" method="post">
                                                        <input style="width: 80px;" type="number" class="form-control" name="jumlah" id="jumlah" required autofocus />

                                                </td>
                                                <td>
                                                    <input type="hidden" name="id" value="<?= $data->id ?>" />
                                                    <input type="hidden" name="no_spb" value="<?= $no_spb  ?>" />
                                                    <input type="hidden" name="id_ruang" value="<?= $ruang->id_ruang ?>" />
                                                    <input type="hidden" name="id_ruang_tujuan" value="<?= $ruang_tujuan->id  ?>" />
                                                    <input type="hidden" name="date" value="<?= $date ?>" />
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
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
    </div>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>