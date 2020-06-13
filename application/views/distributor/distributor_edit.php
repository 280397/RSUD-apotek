<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $page ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="#">Forms</a></div>
                <div class="breadcrumb-item"><?= $page ?></div>
            </div>
        </div>

        <div class="section-body col-xs-12">
            <h2 class="section-title"><?= $page ?></h2>
            <p class="section-lead">

            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="<?php echo $action; ?>" method="post">
                            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                                <div class="card-body">

                                    <!-- <div class="form-group">
                                        <label for="satuan">satuan *</label>
                                        <input type="text" class="form-control" name="_satuan" value="<?= $satuan ?>" id="_satuan" required autofocus>
                                        <?= form_error('satuan', '<small class="text-danger">', '</small>'); ?>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="nama_distributor">Nama Distributor *</label>
                                        <input type="text" class="form-control" name="nama_distributor" id="nama_distributor" value="<?php echo $nama_distributor; ?>" required autofocus />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_perusahaan">Nama Perusahaan *</label>
                                        <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" value="<?php echo $nama_perusahaan; ?>" required autofocus />
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" rows="3" name="alamat" id="alamat"><?php echo $alamat; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="telp">Telp *</label>
                                        <input type="text" class="form-control" name="telp" id="telp" value="<?php echo $telp; ?>" required autofocus />
                                    </div>
                                    <div class="form-group">
                                        <label for="kota">Kota *</label>
                                        <input type="text" class="form-control" name="kota" id="kota" placeholder="Kota" value="<?php echo $kota; ?>" required autofocus />
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_pos">Kode Pos</label>
                                        <input type="text" class="form-control" name="kode_pos" id="kode_pos" value="<?php echo $kode_pos; ?>" />
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                    <a href="<?php echo site_url('Distributor') ?>" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>
<?php $this->load->view('dist/_partials/footer'); ?>