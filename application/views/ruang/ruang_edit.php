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

                                    <div class="form-group">
                                        <label for="nama_ruang">Nama Ruang *</label>
                                        <input type="text" class="form-control" name="nama_ruang" value="<?= $nama_ruang ?>" id="nama_ruang" required autofocus>
                                        <?= form_error('satuan', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                    <a href="<?php echo site_url('Ruang') ?>" class="btn btn-default">Cancel</a>
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