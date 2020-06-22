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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                                    <i class="fas fa-plus"> Tambah</i>
                                </button>

                                <div class="float-right">

                                    <form action="<?= site_url('Obat_transaksi/simpan') ?>" method="post">

                                        <input type="hidden" name="no_faktur" value="<?= $no_faktur ?>" />
                                        <input type="hidden" name="id_distributor" value="<?= $distributor->id ?>" />
                                        <input type="hidden" name="tanggal" value="<?= $tanggal ?>" />
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

                                <table class=" table table-striped mt-4" id="table-1">
                                    <thead>
                                        <input type="hidden" name="id" />
                                        <input type="hidden" name="no_faktur" value="<?= $no_faktur ?>" />
                                        <input type="hidden" name="id_distributor" value="<?= $distributor->id ?>" />
                                        <input type="hidden" name="tanggal" value="<?= $tanggal ?>" />
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Nama Barang</th>
                                            <th>Kode Barang</th>
                                            <th>Exp Date</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th width="200px" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($this->cart->contents() as $key) { ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $key['name'] ?></td>
                                                <td><?= $key['kode_obat'] ?></td>
                                                <td><?= $key['exp'] ?></td>
                                                <td><?= $key['qty'] ?></td>
                                                <td><?= $key['price'] ?></td>
                                                <td class="text-center">

                                                    <form action="<?= site_url('Obat_transaksi/delete_cart') ?>" method="post">
                                                        <input type="hidden" name="no_faktur" value="<?= $no_faktur ?>" />
                                                        <input type="hidden" name="id_distributor" value="<?= $distributor->id ?>" />
                                                        <input type="hidden" name="tanggal" value="<?= $tanggal ?>" />
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
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('Obat_transaksi/insert') ?>" method="post">
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
                        <label for="exp">Exp Date</label>
                        <input type="date" class="form-control" name="exp" id="exp" required autofocus />
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah *</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah" required autofocus />
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga *</label><small> (Biarkan kosong jika harga tidak berubah)</small>
                        <input type="number" class="form-control" name="harga" id="harga" />

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" />
                        <input type="hidden" name="no_faktur" value="<?= $no_faktur ?>" />
                        <input type="hidden" name="id_distributor" value="<?= $distributor->id ?>" />
                        <input type="hidden" name="tanggal" value="<?= $tanggal ?>" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>