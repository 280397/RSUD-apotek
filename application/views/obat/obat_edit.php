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
                                        <label for="kode">Kode *</label>
                                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $kode ?>" placeholder="" required autofocus />
                                    </div>
                                    <div class="form-group">
                                        <label for="kode_siva">Kode Siva *</label>
                                        <input type="text" class="form-control" name="kode_siva" id="kode_siva" value="<?= $kode_siva ?>" placeholder="" autofocus />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_obat">Nama Obat *</label>
                                        <input type="text" class="form-control" name="nama_obat" id="nama_obat" value="<?= $nama_obat ?>" placeholder="" required autofocus />
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">Generik *</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="generik" name="generik" value="Ya" <?php echo ($generik == 'Ya' ? 'checked' : ''); ?>>
                                            <label class="form-check-label" for="generik">
                                                Ya
                                            </label>
                                        </div>

                                    </div>
                                    <div class=" form-group">
                                        <label for="satuan">Satuan *</label>
                                        <select name="satuan" id="satuan" class="form-control" required="required" autofocus="autofocus">
                                            <option value="">--Pilih Satuan--</option>
                                            <?php foreach ($o_satuan as $key => $data) { ?>
                                                <!-- <option value="<?= $data->id ?>"><?= $data->satuan ?></option> -->
                                                <option value="<?= $data->id  ?>" <?= $data->id  == $satuan ? "selected" : null ?>><?= $data->satuan ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga *</label>
                                        <input type="number" class="form-control" name="harga" id="harga" value="<?= $harga ?>" placeholder="Harga" required autofocus />
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                    <a href="<?php echo site_url('Obat') ?>" class="btn btn-default">Cancel</a>
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